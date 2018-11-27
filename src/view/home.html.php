<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.css">
</head>
<style>
    .works-panel .list li {
        position: relative;
        font-size: 1.2rem;
        padding: 1.3rem 0.5rem;
        border-bottom: 1px solid #ededed;
        list-style: none;
    }

    .works-panel .list li:last-child {
        border-bottom: none;
    }

    .works-panel .list li .edit-area,
    .works-panel .list li .view-area {
        display: flex;
    }

    .works-panel .list li .view-area .options {
        margin-right: 0;
        margin-left: auto;
        align-self: flex-end;
    }

    /***************************************************
        Mark complete
    ****************************************************/
    .works-panel .list li .view-area .mark-complete {
        display: flex;
        align-self: center;
    }
    .works-panel .list li .view-area .mark-complete label {
        padding: 1rem 1rem 1rem 2.5rem;
        transition: color 0.4s;
    }
    .works-panel .list li .view-area .mark-complete .toggle {
        text-align: center;
        width: 2.2rem;
        height: auto;
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto 0;
        -webkit-appearance: none;
        appearance: none;
    }
    .works-panel .list li .view-area .mark-complete .toggle {
        opacity: 0;
    }
    .works-panel .list li .view-area .mark-complete .toggle + label {
        background-image: url('data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%2240%22%20height%3D%2240%22%20viewBox%3D%22-10%20-18%20100%20135%22%3E%3Ccircle%20cx%3D%2250%22%20cy%3D%2250%22%20r%3D%2250%22%20fill%3D%22none%22%20stroke%3D%22%23ededed%22%20stroke-width%3D%223%22/%3E%3C/svg%3E');
        background-repeat: no-repeat;
        background-position: center left;
    }
    .works-panel .list li .view-area .mark-complete .toggle:checked + label {
        background-image: url('data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%2240%22%20height%3D%2240%22%20viewBox%3D%22-10%20-18%20100%20135%22%3E%3Ccircle%20cx%3D%2250%22%20cy%3D%2250%22%20r%3D%2250%22%20fill%3D%22none%22%20stroke%3D%22%23bddad5%22%20stroke-width%3D%223%22/%3E%3Cpath%20fill%3D%22%235dc2af%22%20d%3D%22M72%2025L42%2071%2027%2056l-4%204%2020%2020%2034-52z%22/%3E%3C/svg%3E');
    }

    .works-panel .work.completed .view-area .view label,
    .works-panel .work.completed .view-area .view .information .date {
        text-decoration: line-through;
    }

    /******************************************************
    End mark complete
    ******************************************************/

    .works-panel .list li .view-area label {
        line-height: 1.2;
        margin-bottom: unset;
        transition: color 0.4s;
    }

    .information {
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        color: #a5a5a5;
        font-weight: 500;
    }

    .information span {
        font-size: .95rem;
    }

    /*********************************
    Edit area
    **********************************/
    .work .edit-area .edit input,
    .work .edit-area .edit select {
        -webkit-appearance: none;
        outline: none;
        font-size: 1.2rem;
        border-radius: .1rem;
        border: 0;
        width: 100%;
        border-bottom: 1px solid #9c9898;
    }

    .work .edit-area .edit .information input,
    .work .edit-area .edit .information select {
        /* border: 1px solid #cecece; */
        font-size: 1rem;
    }

    .work .edit-area .edit .information label {
        line-height: 1.5rem;
    }

    .work .edit-area .edit .information select {
        line-height: 1.6rem;
    }

    .work .edit-area .edit .information label {
        font-size: 1rem;
        width: 100%;
    }

    .work .edit-area .cancel-edit {
        display: flex;
    }

    .work .edit-area .btn {
        outline: none;
        width: 4.5rem;
        height: 100%;
        border-radius: 0;
        font-weight: 500;
        color: white;
        text-align: center;
        font-size: 1rem;
    }

    .work .edit-area .submit-edit .btn.btn-edit {
        margin-left: .5rem;
        background-color: limegreen;
    }

    .work .edit-area .cancel-edit .btn.btn-cancel {
        margin-right: .5rem;
        /* border-radius: 50%;
        height: 50%;
        width: 3.3rem;
        align-self: center; */
        background-color: orangered;
    }

    .work .edit-area {
    }

    .work .view-area {
        
    }

    /*********************************
    
    **********************************/
    .hide {
        display: none !important;
    }
    .show {
        display: block;
    }

    .disabled, .disabled > * {
        pointer-events: none;
    }
</style>
<body>
    <div id="todo" class="container mt-5">
        <div class="row">
            <div class="col-md-8 col-12">
                <section>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a :class="['nav-link', { active : hashFilter === 'all'}]" href="#all">All</a>
                    </li>
                    <li class="nav-item">
                        <a :class="['nav-link', { active : hashFilter === 'today'}]" href="#today">Today</a>
                    </li>
                    <li class="nav-item">
                        <a :class="['nav-link', { active : hashFilter === 'week'}]" href="#week">Week</a>
                    </li>
                    <li class="nav-item">
                        <a :class="['nav-link', { active : hashFilter === 'month'}]" href="#month">Month</a>
                    </li>
                    <li class="nav-item">
                        <a :class="['nav-link', { active : hashFilter === 'completed'}]" href="#completed">Completed</a>
                    </li>
                    <li class="nav-item">
                        <a :class="['nav-link', { active : hashFilter === 'doing'}]" href="#doing">Doing</a>
                    </li>
                    <li class="nav-item">
                        <a :class="['nav-link', { active : hashFilter === 'plaining'}]" href="#plaining">Plaining</a>
                    </li>
                </ul>
                </section>
                <section class="works-panel">
                    <div v-if="filteredWorks">
                        <ul class="list" v-show="filteredWorks.length">
                            <li v-for="work in filteredWorks"
                                :key="work.workId"
                                :class="['work', { completed: work.status == 3 }]">

                                <div class="edit-area hide" v-on:dblclick="switchArea">
                                    <div class="cancel-edit">
                                        <button type="button" v-on:click="switchArea" class="btn btn-cancel">Cancel</button>
                                    </div>
                                    <div class="edit">
                                        <input type="text" v-model.trim="work.workName">
                                        <div class="information mt-2">
                                            <div class="date mr-3">
                                                <label>Start </label>
                                                <input type="date" v-model="work.startDate">
                                            </div>
                                            <div class="date mr-3">
                                                <label>Dealine </label>
                                                <input type="date" v-model="work.endDate">
                                            </div>
                                            <div class="status">
                                                <label>Status </label>
                                                <select v-model="work.status">
                                                    <option :value="key" :key="key" v-for="(status, key) in statuses">
                                                        {{ status }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-edit">
                                        <button type="button" v-on:click="editWork($event, work)" class="btn btn-edit">Edit</button>
                                    </div>
                                </div>

                                <div class="view-area show" v-on:dblclick="switchArea">
                                    <div class="mark-complete" v-on:click="markCompleteWork($event, work)">
                                        <input type="checkbox" class="toggle"
                                            :checked="work.status == 3"/>
                                        <label></label>
                                    </div>
                                    <div class="view">
                                        <div>
                                            <label>{{ work.workName }}</label>
                                        </div>
                                        <div class="information mt-2">
                                            <div class="date mr-3">
                                                <span>Start: </span>
                                                <span>{{ work.startDate }}</span>
                                            </div>
                                            <div class="date mr-3">
                                                <span>Dealine: </span>
                                                <span>{{ work.endDate }}</span>
                                            </div>
                                            <div class="status">
                                                <span>{{ statuses[work.status] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="options">
                                        <a href="#" v-on:click.stop.prevent="switchArea">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a href="#" v-on:click.stop.prevent="deleteWork($event, work)">
                                            <i class="far fa-trash-alt" ></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div v-else>
                    
                    </div>
                </section>
            </div>
            <div class="col-md-4 col-12">
                <form v-on:submit.prevent>
                    <div class="form-group">
                        <label for="workNameInput">Work name</label>
                        <input type="text"
                            class="form-control"
                            placeholder="Hey, enter your work here"
                            v-model.trim="workName" />
                    </div>
                    <div class="form-group">
                        <label for="startDateInput">Start date</label>
                        <input type="date"
                            class="form-control"
                            v-model="startDate"/>
                    </div>
                    <div class="form-group">
                        <label for="endDateInput">End date</label>
                        <input type="date"
                            class="form-control"
                            v-model="endDate">
                    </div>
                    <button type="submit"
                        class="btn btn-primary float-right"
                        v-on:click="addWork">Create</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
<script src="/assets/date-helper.js"></script>
<script>
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

    let todo = new Vue({
        el: '#todo',
        data: {
            allWork: [],
            statuses: [],
            hashFilter: 'all',
            
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
            }
        },
        computed: {
            filteredWorks() {
                return this[this.hashFilter](this.allWork)
            }
        },
        methods: {
            fetchWorks() {
                http.get('/works').then(response => {
                    this.allWork = response.data.works
                    this.statuses = response.data.status
                }).catch(error => {
                    this.notify(COMMON_ERROR, 'error')
                })
            },
            fetchWork(workId) {
                http.get(
                    '/work',
                    {
                        params : { workId }
                    }
                ).then(response => {
                    console.log(response)
                }).catch(error => {
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
                .catch(error => {
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

                console.log(workTarget.hasClass('completed'))

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
            today() {

            },
            week() {
                console.log(new Date('2018-9-32').getWeek())
            },
            month() {

            },
            all() {
                return this.allWork
            },
            plaining() {
                return this.allWork.filter(work => {
                    return work.status == 1
                })
            },
            doing() {
                return this.allWork.filter(work => {
                    return work.status == 2
                })
            },
            completed() {
                return this.allWork.filter(work => {
                    return work.status == 3
                })
            },
            notify(message, type) {
                $.notify(message, type);
            }
        },
        created() {
            this.fetchWorks()
        }
    })

    function onHashChangeListener() {
        let hashFilter = window.location.hash.replace(/\#?/, '')

        if (todo[hashFilter]) {
            todo.hashFilter = hashFilter
        }
    }

    window.addEventListener('hashchange', onHashChangeListener)

    onHashChangeListener()
</script>
</html>
