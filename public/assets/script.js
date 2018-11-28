const COMMON_ERROR = 'Please try again or later'

$.notify.defaults({
    style: 'bootstrap',
    position: 'top center',
    autoHideDelay: 5000,
    arrowSize: 200
})

let http = axios.create({
    baseURL: '/api'
})

// filter status
let filters = {
    all(works) {
        return works
    },
    planing(works) {
        return works.filter(work => {
            return work.status == 1
        })
    },
    doing(works) {
        return works.filter(work => {
            return work.status == 2
        })
    },
    completed(works) {
        return works.filter(work => {
            return work.status == 3
        })
    }
}

let todo = new Vue({
    data: {
        // all works have loaded
        allWork: [],
        statuses: [],

        isShowSelectWeek: false,
        currentWeek: 0,
        selectWeek: 0,
        currentMonth: 0,
        selectMonth: 0,
        currentYear: 0,
        currentDay: 0,

        // filter `status` of work -> all, planing, doing and completed
        filter: 'all',

        // chose view for displaying
        visibility: 'all',

        // for create a new work
        workName: '',
        startDate: null,
        endDate: null
    },
    watch: {
        allWork: {
            handler(value) {
                return value
            },
            deep: true
        },
        // Watch show or hide select week on nav bar
        visibility(value) {
            this.isShowSelectWeek = (value === 'week')

            return value
        }
    },
    computed: {
        filteredWorks() {
            if (filters[this.filter]) {
                return filters[this.filter](this.allWork)
            }
        }
    },
    methods: {
        fetchWorks(url) {
            console.log('fetch url', url)
            http.get(url).then(response => {
                this.allWork = response.data.works
                this.statuses = response.data.status
            }).catch(_ => {
                this.notify(COMMON_ERROR, 'error')
            })
        },
        switchArea(e) {
            console.log('switch')

            let viewElement = $(e.target).parents('.work').find('.view-area')
            let editElement = $(e.target).parents('.work').find('.edit-area')

            if (editElement.hasClass('show')) {
                // Hide edit area and display view
                editElement.removeClass('show')
                editElement.addClass('hide')

                viewElement.removeClass('hide')
                viewElement.addClass('show')
            } else {
                // Hide view area and display edit
                editElement.removeClass('hide')
                editElement.addClass('show')

                viewElement.removeClass('show')
                viewElement.addClass('hide')
            }
        },
        async editWork(e, work) {
            let workId      = work.workId
            let workName    = work.workName
            let startDate   = work.startDate
            let endDate     = work.endDate
            let status      = work.status

            if (workName === '') {
                this.notify('Please enter the valid work\'s name', 'warn')
                return false
            }

            $(e.target).addClass('disabled')

            let response = await http.put('/work', {
                workId, workName,
                startDate, endDate, status
            }).catch(error => {
                this.notify(COMMON_ERROR, 'error')
            })

            if (response.data.result) {
                this.allWork[this.allWork.indexOf(work)] = work
                this.switchArea(e)
                this.notify(response.data.message, 'success')
            } else {
                this.notify(response.data.message, 'error')
            }

            $(e.target).removeClass('disabled')
        },
        async deleteWork(e, work) {
            $(e.target).addClass('disabled')

            let workId = work.workId

            let response = await http.delete('/work', { params : { workId } })
                .catch(error => {
                    this.notify(COMMON_ERROR, 'error')
                })

            if (response.data.result) {
                this.allWork.splice(this.allWork.indexOf(work), 1)
                this.notify(response.data.message, 'success')
            } else {
                $.notify(response.data.message, 'error');
            }

            $(e.target).removeClass('disabled')
        },
        async addWork(e) {
            e.preventDefault();
            $(e.target).addClass('disabled')

            if (this.workName === '') {
                this.notify('Please enter the valid work\'s name', 'warn')
                return false;
            }

            let response = await http.post('/work', {
                workName: this.workName,
                startDate: this.startDate,
                endDate: this.endDate
            })
            .catch(_ => {
                this.notify(COMMON_ERROR, 'error')
            })

            if (response.data.result) {
                this.allWork.unshift(response.data.data)
                this.workName = ''
                this.startDate = null
                this.endDate = null
                this.notify(response.data.message, 'success')
            } else {
                this.notify(response.data.message, 'error')
            }

            $(e.target).removeClass('disabled')
        },
        markCompleteWork(e, work) {
            //let targetClasses = e.target.parentElement.parentElement.classList
            let workTarget = $(e.target).parents('.work')

            let index = this.allWork.indexOf(work)
            let workId  = work.workId
            let status  = work.status

            if (workTarget.hasClass('completed')) {
                status = 2
                // Fake react very fast
                workTarget.removeClass('completed')
            } else {
                status = 3
                // Fake react very fast
                workTarget.addClass('completed')
            }

            http.patch('/work', { workId, status })
                .then(response => {
                    if (response.data.result) {
                        if (status == 3) {
                            this.allWork[index].status = 3
                        } else {
                            this.allWork[index].status = 2
                        }

                        this.notify(response.data.message, 'success')
                    } else {
                        e.target.checked = false
                        workTarget.removeClass('completed')
                        this.notify(response.data.message, 'error')
                    }
                })
                .catch(error => {
                    e.target.checked = false
                    workTarget.removeClass('completed')
                    this.notify(COMMON_ERROR, 'error')
                })
        },
        all() {
            this.fetchWorks('/works')
        },
        today() {
            let date = new Date().getDateString()

            this.fetchWorks('/works-today?date=' + date)
        },
        week() {
            let week = this.selectWeek
            let year = this.currentYear

            if (week === 0) {
                week = date.getWeek()
            }

            this.fetchWorks(`/works-week?week=${week}&year=${year}`)
        },
        month() {
            let month = this.selectMonth
            let year = this.currentYear

            this.fetchWorks(`/works-month?month=${month}&year=${year}`)
        },
        notify(message, type) {
            $.notify(message, type);
        }
    },
    mounted() {
        console.log('mounted visibility is', this.visibility)
        
        let date = new Date()
        this.currentWeek = date.getWeek()
        this.currentMonth = date.getMonth() + 1
        this.currentYear = date.getWeekYear()
        this.currentDay = date.getDate() + '/' + this.currentMonth

        this.selectWeek = this.currentWeek
        this.selectMonth = this.currentMonth

        this[this.visibility]()
    }
})

function onHashChangeListener() {
    let hashFilter = window.location.hash.replace(/\#?/, '')

    console.log('hashFilter', hashFilter)

    if (hashFilter === 'all'
        || hashFilter === 'today'
        || hashFilter === 'week'
        || hashFilter === 'month') {
        todo.visibility = hashFilter
        todo.isShowSelectWeek = (hashFilter === 'week')
    }
}

window.addEventListener('hashchange', onHashChangeListener)

onHashChangeListener()

todo.$mount('#todo')