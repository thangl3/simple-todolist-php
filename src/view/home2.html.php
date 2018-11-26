<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
</head>
<style>
    /* .toggle-all {
        text-align: center;
        border: none; Mobile Safari
        opacity: 0;
        position: absolute;
    }

    .toggle-all + label {
        width: 60px;
        height: 34px;
        font-size: 0;
        position: absolute;
        top: -52px;
        left: -13px;
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .toggle-all + label:before {
        content: '❯';
        font-size: 22px;
        color: #e6e6e6;
        padding: 10px 27px 10px 27px;
    }

    .toggle-all:checked + label:before {
        color: #737373;
    } */

    .works-panel .list li {
        position: relative;
        display: flex;
        font-size: 1.2rem;
        padding: 1rem 0.5rem;
        border-bottom: 1px solid #ededed;
        list-style: none;
    }

    .works-panel .list li:last-child {
        border-bottom: none;
    }

    /***************************************************
        Mark complete
    ****************************************************/
    .works-panel .list .mark-complete {
        display: flex;
        align-self: center;
    }

    .works-panel .list li .mark-complete label {
        padding: 1rem 1rem 1rem 2.5rem;
        transition: color 0.4s;
    }
    .works-panel .list li .mark-complete .toggle {
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

    .works-panel .list li .mark-complete .toggle {
        opacity: 0;
    }

    .works-panel .list li .mark-complete .toggle + label {
        background-image: url('data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%2240%22%20height%3D%2240%22%20viewBox%3D%22-10%20-18%20100%20135%22%3E%3Ccircle%20cx%3D%2250%22%20cy%3D%2250%22%20r%3D%2250%22%20fill%3D%22none%22%20stroke%3D%22%23ededed%22%20stroke-width%3D%223%22/%3E%3C/svg%3E');
        background-repeat: no-repeat;
        background-position: center left;
    }

    .works-panel .list li .mark-complete .toggle:checked + label {
        background-image: url('data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%2240%22%20height%3D%2240%22%20viewBox%3D%22-10%20-18%20100%20135%22%3E%3Ccircle%20cx%3D%2250%22%20cy%3D%2250%22%20r%3D%2250%22%20fill%3D%22none%22%20stroke%3D%22%23bddad5%22%20stroke-width%3D%223%22/%3E%3Cpath%20fill%3D%22%235dc2af%22%20d%3D%22M72%2025L42%2071%2027%2056l-4%204%2020%2020%2034-52z%22/%3E%3C/svg%3E');
    }

    /******************************************************
    End mark complete
    ******************************************************/

    .works-panel .list li label {
        line-height: 1.2;
        margin-bottom: unset;
        transition: color 0.4s;
    }

    .datetime {
        display: flex;
        justify-content: flex-end;
        color: #a5a5a5;
        font-weight: 500;
    }

    .datetime .date span {
        font-size: .95rem;
    }
</style>
<body>
    <div class="container todo mt-5">
        <div class="row">
            <div class="col-md-8 col-12">
                <section>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#all">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#today">Today</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#week">Week</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#month">Month</a>
                    </li>
                </ul>
                </section>
                <section class="works-panel" v-show="works.length">
                    <ul class="list">
                        <li class="work" v-for="work in works" :key="work.workId">
                            <div class="mark-complete">
                                <input class="toggle" type="checkbox" />
                                <label></label>
                            </div>
                            <div class="view">
                                <label>{{ work.workName }}</label>
                                <div class="datetime mt-2">
                                    <div class="date mr-3">
                                        <span>Start: </span>
                                        <span>{{ work.startDate }}</span>
                                    </div>
                                    <div class="date">
                                        <span>Dealine: </span>
                                        <span>{{ work.endDate }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="options">
                                <!-- <input class="edit" type="text" v-model="work.workName"> -->
                            </div>
                        </li>
                    </ul>
                </section>
            </div>
            <div class="col-md-4 col-12">
                <form action="/create" method="POST">
                    <div class="form-group">
                        <label for="workNameInput">Work name</label>
                        <input type="text"
                            autofocus autocomplete="on"
                            class="form-control"
                            placeholder="Hey, enter your work here"
                            v-model="workName" />
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    var app = new Vue({
        data: {
            works: [],
            workName: '',
            startDate: null,
            endDate: null
        },
        created() {
            this.fetchWorks();
        },
        methods: {
            addWork(e) {
                e.preventDefault();

                let workName = this.workName && this.workName.trim()

                if (workName === '') {
                    return false;
                }

                axios.post('/create', {
                    'workName' : workName,
                    'startDate': this.startDate,
                    'endDate' : this.endDate
                }).then(response => {
                    console.log(response.data);
                }).catch(error => {
                    console.log(error);
                })
            },
            fetchWorks() {
                axios.get('/works').then(response => {
                    this.works = response.data.works
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    })

    function onHashChange () {
        console.log('change route')
    }

    window.addEventListener('hashchange', onHashChange)

    // mount
    app.$mount('.todo')

</script>
</html>