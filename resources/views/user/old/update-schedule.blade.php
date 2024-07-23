@extends('layouts.admin')
@section('title','')
@section('page-style')
    <script src="{{asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js'))}}"></script>


    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">
@endsection
@section('content')
    <div class="row mx-0">
        <div class="ps-0" style="width: 60.4%">
            <div class="card mt-2">
                <div class="card-body my-25">
                    <div class="row">
                        <span class="offset-1 col-5 work-graphic-title">Робочий день</span>
                        <span class="col-4 work-graphic-title">Обід</span>
                        <span class="col-2 work-graphic-title float-end text-end">Вихідні</span>
                    </div>
                    @foreach($user->schedule as $row)
                        <div class="row mt-2">
                            <span class="col-1 work-graphic-title align-self-center">Пн</span>
                            <div style="width: 16.5%;padding-right: 0">
                                <input {{$row->is_day_off ? 'disabled' : ''}} type="text" id="{{$row->weekday}}-1"
                                       class="form-control flatpickr-time text-start"
                                       value="{{$row->start_at}}" placeholder="00:00"/>
                            </div>
                            <img class="align-self-center" style="width: 45px;height: 2px"
                                 src="{{asset('assets/icons/line.svg')}}">
                            <div style="width: 16.5%;padding-left: 0">
                                <input type="text" id="{{$row->weekday}}-2"
                                       class="form-control flatpickr-time text-start"
                                       {{$row->is_day_off ? 'disabled' : ''}} value="{{$row->end_at}}"
                                       placeholder="00:00"/>
                            </div>

                            <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                                <input type="text" id="{{$row->weekday}}-3"
                                       class="form-control flatpickr-time text-start"
                                       {{$row->is_day_off ? 'disabled' : ''}} value="{{$row->break_start_at}}"
                                       placeholder="00:00"/>
                            </div>
                            <img class="align-self-center" style="width: 45px;height: 2px"
                                 src="{{asset('assets/icons/line.svg')}}">
                            <div style="width: 16.5%;padding-left: 0">
                                <input type="text" id="{{$row->weekday}}-4"
                                       class="form-control flatpickr-time text-start"
                                       {{$row->is_day_off ? 'disabled' : ''}} value="{{$row->break_end_at}}"
                                       placeholder="00:00"/>
                            </div>
                            <div style="width: 11%" class="align-self-center text-center">
                                <input class="form-check-input" {{$row->is_day_off ? 'checked' : ''}}
                                type="checkbox" id="{{$row->weekday}}-check">
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-3">
                        <div style="margin-left: 10%" class="width-40-per p-0">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="schedule_pattern">
                                <label class="form-check-label" for="schedule_pattern">Зберегти даний графік як
                                    шаблон</label>
                            </div>
                            <div class="mt-1">
                                <label class="form-label font-small-4" for="pattern">Назва шаблону</label>
                                <input type="text" class="form-control" id="pattern" name="pattern"
                                       placeholder="Введіть назву шаблону">
                            </div>
                        </div>
                        <div style="padding: 0; margin-left: 18%;width: 30%">
                            <button class="btn btn-green float-end" id="graphic_save">
                                Зберегти
                            </button>
                        </div>
                    </div>
                    @if(count($patterns))
                        <hr style="border-top: 2px solid">
                        <div class="mt-1" style="margin-left: 11%">
                            <ul style="list-style: none;padding-left: 0;margin-left: 0">
                                <li class="mb-1"><span class="font-medium-1 fw-bold">Використати шаблони</span></li>
                                @foreach($patterns as $pattern)
                                    <li>
                                        <button style="padding-left: 0;margin-left: 0"
                                                data-pattern="{{$pattern->schedule}}"
                                                class="btn btn-link graphic-pattern font-medium-1 fw-bold">{{$pattern->name}}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div style="display: hide"></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="pe-0" style="width: 39.6%">
            <div class="card mt-2" style="min-height: 300px">
                <div class="card-body" id="condition-list">
                    <div class="row mb-1">
                        <div class="col-6 work-graphic-title align-self-center">Спец. умови</div>
                        <div class="col-6">
                            <button class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#animation">Добавити
                            </button>
                        </div>
                    </div>
                    @foreach($user->conditions as $condition)
                        @php
                            $iteration = $loop->iteration - 1
                        @endphp
                        <div class="record row mt-1" id="record_{{$iteration}}">
                            <div class="col-5 align-self-center">
                                @if($condition->date_to)
                                    <div><span class="f-15"
                                               id="date_from_{{$iteration}}">{{$condition->date_from}}</span>
                                        - <span class="f-15"
                                                id="date_from_{{$iteration}}">{{$condition->date_to}}</span>
                                    </div>
                                @else
                                    <div><span class="f-15"
                                               id="date_{{$iteration}}">{{$condition->date_from}}</span></div>
                                @endif
                                @if($condition->work_from && $condition->work_to)
                                    <div>Робочий день: <span class="hours f-15 fw-bolder"
                                                             id="work_from_{{$iteration}}">{{$condition->work_from}}</span>-<span
                                            class="hours f-15 fw-bolder"
                                            id="work_to_{{$iteration}}">{{$condition->work_to}}</span></div>
                                @endif
                                @if($condition->break_from && $condition->break_to)
                                    <div>Обід: <span class="hours f-15 fw-bolder"
                                                     id="break_from_{{$iteration}}">{{$condition->break_from}}</span>-<span
                                            class="hours f-15 fw-bolder"
                                            id="break_to_{{$iteration}}">{{$condition->break_to}}</span></div>
                                @endif

                            </div>
                            <div class="col-5 align-self-center"><span class="float-end f-15"
                                                                       id="condition_{{$iteration}}">{{$condition->type->name}}</span>
                            </div>
                            <div class="col-2 row align-self-center">
                                <button class="btn p-0 edit-condition w-50" onclick="editCondition({{$iteration}})"
                                        id="edit-condition-{{$iteration}}"
                                        data-condition="{{$iteration}}">
                                    <img src="http://127.0.0.1/assets/icons/edit.svg"></button>
                                <button class="btn p-0 delete-condition w-50" onclick="deleteCondition({{$iteration}})"
                                        id="delete-condition-{{$iteration}}"><img
                                        src="http://127.0.0.1/assets/icons/delete.svg"></button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal text-start" id="animation" tabindex="-1" aria-labelledby="myModalLabel6" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="card popup-card">
                    <div class="popup-header">
                        Добавити спец. умову
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 mb-2">
                                <label class="form-label" for="condition_name">Назва
                                    умови</label>
                                <select class="select2 hide-search form-select" id="condition_name"
                                        data-placeholder="Виберіть умову">
                                    <option id="condition_none" value=""></option>
                                    @foreach($exceptions as $exception)
                                        <option data-id="{{$exception->id}}"
                                                value="{{$exception->name}}">{{$exception->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="select_period" value="one_day">
                                <label class="form-check-label" for="one_day">Один день</label>
                            </div>
                            <div class="form-check" style="margin-top: 5px">
                                <input class="form-check-input" type="radio" name="select_period" value="period"
                                       checked>
                                <label class="form-check-label" for="period">Період часу</label>
                            </div>
                        </div>
                        <div style="display: none" id="one_day" class="col-12 mt-1">

                            <input type="text" class="form-control one_day flatpickr-basic flatpickr-input"
                                   name="one_day" required placeholder="YYYY-MM-DD" readonly="readonly">

                        </div>
                        <div id="period" style="display:flex;" class="col-12 mt-1">
                            <div style="width: 45%;padding-right: 0">
                                <input type="text" id="date-1"
                                       class="form-control date-1 flatpickr-basic flatpickr-input" required
                                       placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                            <img class="align-self-center" style="width: 45px;height: 2px"
                                 src="{{asset('assets/icons/line.svg')}}">
                            <div style="width: 45%;padding-left: 0">
                                <input type="text" id="date-2"
                                       class="form-control date-2 flatpickr-basic flatpickr-input" required
                                       placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                        </div>
                        <p class="f-15 fw-bold mt-1 mb-1">Робочий день</p>
                        <div class="col-12 d-flex">
                            <div style="width: 45%;padding-right: 0">
                                <input type="text" id="work_from" class="form-control flatpickr-time text-start"
                                       placeholder="00:00"/>
                            </div>
                            <img class="align-self-center" style="width: 45px;height: 2px"
                                 src="{{asset('assets/icons/line.svg')}}">
                            <div style="width: 45%;padding-left: 0">
                                <input type="text" id="work_to" class="form-control flatpickr-time text-start"
                                       placeholder="00:00"/>
                            </div>
                        </div>
                        <p class="f-15 fw-bold mt-1 mb-1">Обід</p>
                        <div class="col-12 d-flex">
                            <div style="width: 45%;padding-right: 0">
                                <input type="text" id="break_from" class="form-control flatpickr-time text-start"
                                       placeholder="00:00"/>
                            </div>
                            <img class="align-self-center" style="width: 45px;height: 2px"
                                 src="{{asset('assets/icons/line.svg')}}">
                            <div style="width: 45%;padding-left: 0">
                                <input type="text" id="break_to" class="form-control flatpickr-time text-start"
                                       placeholder="00:00"/>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <div class="d-flex float-end">
                                <button class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати</button>
                                <button class="btn btn-primary" disabled="true" id="condition_submit">Зберегти</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal text-start" id="edit-modal" tabindex="-1" aria-labelledby="myModalLabel6" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="card popup-card">
                    <div class="popup-header">
                        Редагувати спец. умову
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 mb-2">
                                <label class="form-label" for="edit_condition_name">Назва
                                    умови</label>
                                <select class="select2 hide-search form-select" id="edit_condition_name"
                                        data-placeholder="Виберіть умову">
                                    @foreach($exceptions as $exception)
                                        <option data-id="{{$exception->id}}"
                                                value="{{$exception->name}}">{{$exception->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="edit_select_period" value="one_day">
                                <label class="form-check-label" for="edit_one_day">Один день</label>
                            </div>
                            <div class="form-check" style="margin-top: 5px">
                                <input class="form-check-input" type="radio" name="edit_select_period" value="period"
                                       checked="">
                                <label class="form-check-label" for="period">Період часу</label>
                            </div>
                        </div>
                        <div style="display: none" id="edit_one_day" class="col-12 mt-1">

                            <input type="text"
                                   class="form-control edit_one_day flatpickr-basic flatpickr-input" name="edit_one_day"
                                   required placeholder="YYYY-MM-DD" readonly="readonly">

                        </div>
                        <div id="edit_period" style="display:flex;" class="col-12 mt-1">
                            <div style="width: 45%;padding-right: 0">
                                <input type="text" id="edit_date-1"
                                       class="form-control date-1 flatpickr-basic flatpickr-input" required
                                       placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                            <img class="align-self-center" style="width: 45px;height: 2px"
                                 src="{{asset('assets/icons/line.svg')}}">
                            <div style="width: 45%;padding-left: 0">
                                <input type="text" id="edit_date-2"
                                       class="form-control date-2 flatpickr-basic flatpickr-input" required
                                       placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                        </div>
                        <p class="f-15 fw-bold mt-1 mb-1">Робочий день</p>
                        <div class="col-12 d-flex">
                            <div style="width: 45%;padding-right: 0">
                                <input type="text" id="edit_work_from" class="form-control flatpickr-time text-start"
                                       placeholder="00:00"/>
                            </div>
                            <img class="align-self-center" style="width: 45px;height: 2px"
                                 src="{{asset('assets/icons/line.svg')}}">
                            <div style="width: 45%;padding-left: 0">
                                <input type="text" id="edit_work_to" class="form-control flatpickr-time text-start"
                                       placeholder="00:00"/>
                            </div>
                        </div>
                        <p class="f-15 fw-bold mt-1 mb-1">Обід</p>
                        <div class="col-12 d-flex">
                            <div style="width: 45%;padding-right: 0">
                                <input type="text" id="edit_break_from" class="form-control flatpickr-time text-start"
                                       placeholder="00:00"/>
                            </div>
                            <img class="align-self-center" style="width: 45px;height: 2px"
                                 src="{{asset('assets/icons/line.svg')}}">
                            <div style="width: 45%;padding-left: 0">
                                <input type="text" id="edit_break_to" class="form-control flatpickr-time text-start"
                                       placeholder="00:00"/>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <div class="d-flex float-end">
                                <button class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати</button>
                                <button class="btn btn-primary" id="edit_condition_submit">Зберегти</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('page-script')
    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{asset('assets/js/edit-schedule.js')}}"></script>
    <script>
        let conditions = {!! json_encode($user->conditions) !!}
            let
        exceptions = {!! json_encode($exceptions) !!}
            let
        exceptionsArray = []
        for (let i = 0; i < exceptions.length; i++) {
            exceptionsArray[exceptions[i].id] = exceptions[i].name
        }

        window.onload = function () {
            schedule()
        }
    </script>
@endsection
