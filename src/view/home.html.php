<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To do app</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.css">
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <div id="todo" class="container mt-5">
        <div class="row" v-cloak>
            <div class="col-md-8 col-12">
                <section>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a :class="['nav-link', { active : visibility === 'all'}]"
                                href="#all" v-on:click="all">All</a>
                        </li>
                        <li class="nav-item">
                            <a :class="['nav-link', { active : visibility === 'today'}]"
                                href="#today" v-on:click="today">Today <span class="badge badge-secondary">({{ currentDay }})</span></a>
                        </li>
                        <li class="nav-item">
                            <a :class="['nav-link', { active : visibility === 'week'}]"
                                href="#week" v-on:click="week">Week <span class="badge badge-secondary">({{ currentWeek }})</span></a>
                        </li>
                        <li class="nav-item">
                            <a :class="['nav-link', { active : visibility === 'month'}]"
                                href="#month" v-on:click="month">Month <span class="badge badge-secondary">({{ currentMonth }})</span></a>
                        </li>
                    </ul>
                </section>
                <section>
                    <div class="input-group mt-2">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="filterWorks">Filter works</label>
                        </div>
                        <select class="custom-select" id="filterWorks" v-model="filter">
                            <option value="all">All</option>
                            <option value="notComplete">Planing and Doing</option>
                            <option value="planing">PLaning</option>
                            <option value="doing">Doing</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </section>
                <section v-show="isShowSelectWeek">
                    <div class="input-group mt-3">
                        <select class="form-control select" v-model="selectWeek">
                            <option :value="selectWeek - (10 - n)" v-for="n in 10" v-if="(selectWeek - (10 - n)) > 0">
                                {{ selectWeek - (10 - n) }}</option>
                            <option :value="selectWeek + n" v-for="n in 10" v-if="(selectWeek + n) < 54">
                                {{ selectWeek + n }}</option>
                        </select>
                        <select class="form-control select" v-model="selectYear">
                            <option :value="selectYear - (3 - n)" v-for="n in 3">
                                {{ selectYear - (3 - n) }}</option>
                            <option :value="selectYear + n" v-for="n in 3">
                                {{ selectYear + n }}</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" v-on:click="week">Filter</button>
                        </div>
                    </div>
                </section>
                <section v-show="isShowSelectMonth">
                    <div class="input-group mt-3">
                        <select class="form-control select" v-model="selectMonth">
                            <option :value="n" v-for="n in 12">
                                {{ n }}</option>
                        </select>
                        <select class="form-control select" v-model="selectYear">
                            <option :value="selectYear - (3 - n)" v-for="n in 3">
                                {{ selectYear - (3 - n) }}</option>
                            <option :value="selectYear + n" v-for="n in 3">
                                {{ selectYear + n }}</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" v-on:click="month">Filter</button>
                        </div>
                    </div>
                </section>
                <section class="works-panel">
                    <ul class="list px-0 mx-0" v-if="filteredWorks.length">
                        <li v-for="work in filteredWorks"
                            :key="work.workId"
                            :class="['work', { completed: work.status == 3 }]">

                            <div class="edit-area hide">
                                <div class="cancel-edit">
                                    <button type="button" v-on:click="switchArea" class="btn btn-cancel">Cancel</button>
                                </div>
                                <div class="edit" v-on:dblclick="switchArea">
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

                            <div class="view-area show">
                                <div class="mark-complete" v-on:click="markCompleteWork($event, work)">
                                    <input type="checkbox" class="toggle"
                                        :checked="work.status == 3"/>
                                    <label></label>
                                </div>
                                <div class="view" v-on:dblclick="switchArea">
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
                    <!-- Display message when empty work -->
                    <div class="mt-3" v-else>
                        <div class="alert alert-warning text-center" role="alert">
                            No works for you to do!
                        </div>
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
<script src="/assets/script.js"></script>
</html>
