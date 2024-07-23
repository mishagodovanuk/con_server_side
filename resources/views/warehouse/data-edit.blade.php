@extends('layouts.admin')
@section('title','Редагування складу')
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/maps/leaflet.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/maps/map-leaflet.css'))}}">

@endsection
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
@endsection

@section('table-js')
    @include('layouts.table-scripts')

    <script type="text/javascript">
        // Ініціалізуємо таби
        $('#tabs').jqxTabs({
            width: '100%',
            height: '100%'
        });

        // При зміні активного табу
        $('#tabs').on('selected', function (event) {
            var index = event.args.item; // Отримуємо індекс активного табу
            window.dispatchEvent(new Event('resize'));
            // Перевіряємо індекс і показуємо/ховаємо кнопку
            if (index === 0) {
                $('#update-main-data').show();
                $('#update-location-data').hide();
                $('#graphic_save').hide();
            } else if (index === 1) {
                $('#update-main-data').hide();
                $('#update-location-data').show();
                $('#graphic_save').hide();
            } else if (index === 2) {
                $('#update-main-data').hide();
                $('#update-location-data').hide();
                $('#graphic_save').show();
            }
        });
    </script>
    <script src="{{asset('assets/js/utils/loader-for-tabs.js')}}"></script>
@endsection

@section('content')
    <div id="jqxLoader"></div>
    <div class="px-2" id="edit-card" data-id="{{$warehouse->id}}">

        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start align-self-md-stretch">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item">
                            <a class="link-secondary" href="/warehouse">Склади</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-secondary"
                               href="{{"/warehouse/".$warehouse->id}}">Перегляд складу {{ $warehouse->email}} </a>
                        </li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Редагування складу
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">
                <button data-bs-toggle="modal" id="cancel_button" data-bs-target="#cancel_edit_user" type="submit"
                        class="btn btn-flat-secondary">
                    Скасувати
                </button>

                <button class="btn btn-green" id="update">
                    Зберегти
                </button>
            </div>
        </div>

        <div class="locations-tabs mb-3 invisible" id="tabs">
            <ul class="d-flex ">
                <li>Основні дані</li>
                <li>Локація</li>
                <li>Графік роботи</li>
            </ul>

            <div id="block_1" class="row mx-0">
                <div class="col-12">
                    <div class="card-body my-25">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="warehouseName">Назва складу</label>
                                <input type="email" class="form-control" value="{{$warehouse->name}}" id="name"
                                       name="name"
                                       placeholder="Введіть назву складу">
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="u_company select2-hide-search">Компанія</label>
                                <select class="select2 form-select" data-id="{{$warehouse->company_id}}" data-dictionary="company" id="company"
                                        data-placeholder="Оберіть компанію">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="u_type select2-hide-search">Склад ERP</label>
                                <select class="select2 form-select hide-search" id="erp-warehouse"
                                        data-id="@json($warehouse->warehouseERP->pluck('id'))" data-dictionary="warehouse_erp"
                                        data-placeholder="Оберіть cклад/склади в ERP системі">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="u_type select2-hide-search">Тип складу</label>
                                <select class="select2 form-select hide-search" id="type"
                                        data-id="{{$warehouse->type_id}}" data-dictionary="warehouse_type"
                                        data-placeholder="Оберіть тип складу">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="city select2-hide-search">Країна</label>
                                <select class="select2 form-select" data-id="{{$warehouse->address->country_id}}" data-dictionary="country"
                                        id="country"
                                        data-placeholder="Оберіть країну">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="u_city select2-hide-search">Населений пункт</label>
                                <select class="select2 form-select" id="settlement" 
                                data-id="{{$warehouse->address->settlement_id}}"  data-dictionary="settlement"
                                        data-placeholder="Оберіть населений пункт">
                                    <option value=""></option>

                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="u_street select2-hide-search">Вулиця</label>
                                <select class="select2 form-select" id="street" data-placeholder="Оберіть вулицю"  data-id="{{$warehouse->address->street_id}}" data-dictionary="street"  >
                                    
                                    <option value=""></option>

                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="u_number">Номер будинку</label>
                                <input type="text" class="form-control" value="{{$warehouse->address->building_number}}"
                                       id="building_number" name="u_number" placeholder="Вкажіть номер будинку">
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="u_number">Підказка до адреси</label>
                                <input type="text" class="form-control" value="{{$warehouse->addition_to_address}}"
                                       id="address_hint" name="address_hint"
                                       placeholder="Вкажіть додаткову інформацію для адреси">
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="u_pib select2-hide-search">Контактна особа</label>
                                <select class="select2 form-select" id="user" data-id="{{$warehouse->user_id}}"  data-dictionary="user"
                                        data-placeholder="Оберіть контактну особу">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div id="main-data-message"></div>

                        </div>
                        <!--/ form -->
                    </div>
                </div>

            </div>

            <div id="block_2" class="row mx-0">

                <div class="h-100 my-25">
                    <div class="">
                        <div class="row mx-0 px-0">
                            <!-- Draggable Marker With Popup Starts -->
                            <div class="col-12 col-md-5 mt-1 mt-md-0 px-0 pe-md-2">
                                <div class="pb-2">
                                    <h5 class="fw-normal">Координати або назва локації</h5>

                                    <div class="d-flex justify-content-between gap-1">

                                        <div class="d-flex flex-column" style="flex: 3;">
                                            <input type="text" class="form-control" id="map-input" name=""
                                                   placeholder="Вкажіть координати або назву локації" value="" required
                                                   data-msg="Please enter last name">
                                        </div>

                                    </div>
                                    <p class="mt-1 message_add" id="messageAdd"></p>
                                    <p class="mt-1 message_addError" id="messageAddError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-md-7 pe-0  ps-0">
                                <div class="">
                                    <div class="card-body">
                                        <div id="map" style="height: 400px; border-radius: 6px;"></div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div id="main-location-message" class="mt-1"></div>


                        <!-- /Draggable Marker With Popup Ends -->
                    </div>
                </div>

            </div>

            <div id="block_3" class="row mx-0 p-0">

                <div class="row mx-0 p-0 ">
                    <div class="px-0 col-12 col-lg-8">
                        <div class="card mb-0">
                            <div class="card-body" style="padding-top: 2.2rem">

                                <div class="row mx-0 gap-1 justify-content-between">
                                    <div class="col-auto" style="margin-top: 3.5rem">
                                        <div class="d-flex flex-column" style="gap: 2.3rem">
                                            <span>Пн</span>
                                            <span>Вт</span>
                                            <span>Ср</span>
                                            <span>Чт</span>
                                            <span>Пт</span>
                                            <span>Сб</span>
                                            <span>Нд</span>
                                        </div>
                                    </div>
                                    <div class="col-9 col-sm-10 col-md-10 col-lg-4 flex-grow-1">
                                        <h5 class="mb-2">Робочі години</h5>
                                        <div class="d-flex flex-column gap-1">
                                            @foreach($warehouse->schedule as $row)
                                                <div class="d-flex two-input-for-schedule">
                                                    <div>
                                                        <input {{$row->is_day_off ? 'disabled' : ''}} type="text"
                                                               id="{{$row->weekday}}-1"
                                                               class="form-control flatpickr-time text-start"
                                                               value="{{$row->start_at}}"
                                                               placeholder="00:00"/>
                                                    </div>

                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}"
                                                         alt="line">

                                                    <div>
                                                        <input {{$row->is_day_off ? 'disabled' : ''}} type="text"
                                                               id="{{$row->weekday}}-2"
                                                               class="form-control flatpickr-time text-start"
                                                               value="{{$row->end_at}}"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-auto col-md-1 wrapper d-block d-lg-none"
                                         style="margin-top: 2.4rem">
                                        <div class="d-flex flex-column" style="gap: 2.3rem">
                                            <span>Пн</span>
                                            <span>Вт</span>
                                            <span>Ср</span>
                                            <span>Чт</span>
                                            <span>Пт</span>
                                            <span>Сб</span>
                                            <span>Нд</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-7 col-md-8 col-lg-4 flex-grow-1">
                                        <h5 class="mb-2">Обід</h5>
                                        <div class="d-flex flex-column gap-1">
                                            @foreach($warehouse->schedule as $row)
                                                <div class="d-flex two-input-for-schedule">
                                                    <div>
                                                        <input {{$row->is_day_off ? 'disabled' : ''}} type="text"
                                                               id="{{$row->weekday}}-3"
                                                               class="form-control flatpickr-time text-start"
                                                               value="{{$row->break_start_at}}"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input {{$row->is_day_off ? 'disabled' : ''}} type="text"
                                                               id="{{$row->weekday}}-4"
                                                               class="form-control flatpickr-time text-start"
                                                               value="{{$row->break_end_at}}"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-auto order-2">
                                        <h5 class="" style="margin-bottom: 2rem">Вихідні</h5>
                                        <div class="d-flex flex-column mt-1" style="gap: 2.35rem">
                                            @foreach($warehouse->schedule as $row)
                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <input
                                                            {{$row->is_day_off ? 'checked' : ''}} class="form-check-input mt-0"
                                                            type="checkbox"
                                                            id="{{$row->weekday}}-check">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-3">
                                    <div class="p-0 px-1 row mx-0">
                                        <hr class="" style="border-top: 2px solid">
                                        @if(count($patterns))
                                            <div class="mt-1 p-0">
                                                <div class="row mx-0 mb-1">
                                                    <label class="d-flex align-items-center ps-0 col-5"
                                                           for="select_pattern">Використати
                                                        шаблони</label>
                                                    <div class="col-7 pe-0">
                                                        <select class=" select2 hide-search form-select"
                                                                id="select_pattern"
                                                                data-placeholder="Виберіть шаблон">
                                                            <option value=""></option>
                                                            @foreach($patterns as $pattern)
                                                                <option class="graphic-pattern"
                                                                        data-pattern="{{$pattern->schedule}}"
                                                                        value="{{$pattern->schedule}}">{{$pattern->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        @else
                                            <div style="display: none"></div>
                                        @endif

                                        <div class="col-5 d-flex align-items-center p-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                       id="schedule_pattern">
                                                <label class="form-check-label" for="schedule_pattern">Зберегти
                                                    даний
                                                    графік
                                                    як
                                                    шаблон</label>
                                            </div>
                                        </div>

                                        <div class="col-7 pe-0">
                                            <input type="text" class="form-control" id="pattern" name="pattern"
                                                   placeholder="Введіть назву шаблону">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0 col-lg-4 bg-light-secondary">
                        <div class="card bg-transparent box-shadow-0" id="condition-list" style="min-height: 300px">
                            <div class="card-header row mx-0 px-0" id="card-header-conditions">
                                <h4 class="col-auto mb-0 fw-bolder">Спеціальні умови</h4>
                                <p class="text-center d-none">Додані спеціальні умови до вашого графіку будуть </br>
                                    відображатися тут</p>
                                <div class="col-2">
                                    <button class="btn btn-outline-primary float-end d-flex" data-bs-toggle="modal"
                                            data-bs-target="#animation" id="add-special-condition"><i
                                            data-feather="plus" class="mr-1"></i>Додати
                                    </button>
                                </div>
                            </div>
                            @foreach($warehouse->conditions as $condition)
                                @php
                                    $iteration = $condition->id
                                @endphp

                                <div class="record border-bottom pb-1 row mx-0 mt-1" id="record_{{$iteration}}">
                                    <div class="col-10">

                                        <div class="d-flex flex-wrap ">
                                            <div class="w-100" style="margin-bottom: 5px">
                                            <span class="f-15 fw-bold"
                                                  id="condition_{{$iteration}}">{{$condition->type->name}}</span>
                                            </div>

                                            <div class="d-flex align-items-center mb-1"><img style="margin-right:5px"
                                                                                             src="{{asset('assets/icons/calendar-chosen.svg')}}">
                                                @if($condition->date_to)
                                                    <div><span class="f-15"
                                                               id="date_from_{{$iteration}}">{{$condition->date_from}}</span>
                                                        - <span class="f-15"
                                                                id="date_from_{{$iteration}}">{{$condition->date_to}}</span>
                                                    </div>
                                                @else
                                                    <span class="f-15"
                                                          id="date_{{$iteration}}">{{$condition->date_from}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        @if($condition->work_from && $condition->work_to)
                                            <div style="margin-bottom:4px">Робочий день: <span class="hours f-15 "
                                                                                               id="work_from_{{$iteration}}">{{$condition->work_from}}</span>-<span
                                                    class="hours f-15"
                                                    id="work_to_{{$iteration}}">{{$condition->work_to}}</span></div>
                                        @endif
                                        @if($condition->break_from && $condition->break_to)
                                            <div>Обід: <span class="hours f-15"
                                                             id="break_from_{{$iteration}}">{{$condition->break_from}}</span>-<span
                                                    class="hours f-15"
                                                    id="break_to_{{$iteration}}">{{$condition->break_to}}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-2 row mx-0 align-self-start ps-0">
                                        <button class="btn edit-condition-back p-0 w-50"
                                                id="edit-condition-{{$iteration}}"
                                                data-condition="{{$iteration}}">
                                            <img src="http://127.0.0.1/assets/icons/edit.svg"></button>
                                        <button class="btn p-0 delete-condition-back w-50"
                                                data-condition="{{$iteration}}"
                                                id="delete-condition-{{$iteration}}"><img
                                                src="http://127.0.0.1/assets/icons/deleteGrey.svg"></button>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal text-start" id="animation" tabindex="-1" aria-labelledby="myModalLabel6"
                     aria-hidden="true">
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
                                                    @if($exception->key !== 'hospital')
                                                        {{-- Тут перевіряємо значення "key" --}}
                                                        <option data-id="{{$exception->id}}"
                                                                value="{{$exception->name}}">{{$exception->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="select_period"
                                                   value="one_day">
                                            <label class="form-check-label" for="one_day">Один день</label>
                                        </div>
                                        <div class="form-check" style="margin-top: 5px">
                                            <input class="form-check-input" type="radio" name="select_period"
                                                   value="period"
                                                   checked>
                                            <label class="form-check-label" for="period">Період часу</label>
                                        </div>
                                    </div>
                                    <div style="display: none" id="one_day" class="col-12 mt-1">

                                        <input type="text"
                                               class="form-control one_day flatpickr-basic flatpickr-input"
                                               name="one_day" required placeholder="YYYY-MM-DD" readonly="readonly">

                                    </div>
                                    <div id="period" style="display:flex;" class="col-12 mt-1">
                                        <div style="width: 45%;padding-right: 0">
                                            <input type="text" id="date-1"
                                                   class="form-control date-1 flatpickr-basic flatpickr-input"
                                                   required
                                                   placeholder="YYYY-MM-DD" readonly="readonly">
                                        </div>
                                        <img class="align-self-center"
                                             style="width: 45px;height: 2px; padding-left: 12px; padding-right: 12px;"
                                             src="{{asset('assets/icons/line-schedule.svg')}}">
                                        <div style="width: 45%;padding-left: 0">
                                            <input type="text" id="date-2"
                                                   class="form-control date-2 flatpickr-basic flatpickr-input"
                                                   required
                                                   placeholder="YYYY-MM-DD" readonly="readonly">
                                        </div>
                                    </div>
                                    <div id="work-schedule">
                                        <p class="f-15 fw-bold mt-1 mb-1">Робочий день</p>
                                        <div class="col-12 d-flex two-input-for-schedule-inmodal">
                                            <div style="width: 45%;padding-right: 0">
                                                <input type="text" id="work_from"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                            <img class="align-self-center"
                                                 style="width: 45px;height: 2px; padding-left: 12px; padding-right: 12px;"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}">
                                            <div style="width: 45%;padding-left: 0">
                                                <input type="text" id="work_to"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                        </div>
                                        <p class="f-15 fw-bold mt-1 mb-1">Обід</p>
                                        <div class="col-12 d-flex two-input-for-schedule-inmodal">
                                            <div style="width: 45%;padding-right: 0">
                                                <input type="text" id="break_from"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                            <img class="align-self-center"
                                                 style="width: 45px;height: 2px; padding-left: 12px; padding-right: 12px;"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}">
                                            <div style="width: 45%;padding-left: 0">
                                                <input type="text" id="break_to"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-1">
                                        <div class="d-flex float-end">
                                            <button class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати
                                            </button>
                                            <button class="btn btn-primary" disabled="true" id="condition_submit">
                                                Зберегти
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal text-start" id="edit-modal" tabindex="-1" aria-labelledby="myModalLabel6"
                     aria-hidden="true">
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
                                                    @if($exception->key !== 'hospital')
                                                        {{-- Тут перевіряємо значення "key" --}}
                                                        <option data-id="{{$exception->id}}"
                                                                value="{{$exception->name}}">{{$exception->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="edit_select_period"
                                                   value="one_day">
                                            <label class="form-check-label" for="edit_one_day">Один день</label>
                                        </div>
                                        <div class="form-check" style="margin-top: 5px">
                                            <input class="form-check-input" type="radio" name="edit_select_period"
                                                   value="period"
                                                   checked="">
                                            <label class="form-check-label" for="period">Період часу</label>
                                        </div>
                                    </div>
                                    <div style="display: none" id="edit_one_day" class="col-12 mt-1">

                                        <input type="text"
                                               class="form-control edit_one_day flatpickr-basic flatpickr-input"
                                               name="edit_one_day"
                                               required placeholder="YYYY-MM-DD" readonly="readonly">

                                    </div>
                                    <div id="edit_period" style="display:flex;" class="col-12 mt-1">
                                        <div style="width: 45%;padding-right: 0">
                                            <input type="text" id="edit_date-1"
                                                   class="form-control date-1 flatpickr-basic flatpickr-input"
                                                   required
                                                   placeholder="YYYY-MM-DD" readonly="readonly">
                                        </div>
                                        <img class="align-self-center"
                                             style="width: 45px;height: 2px; padding-left: 12px; padding-right: 12px;"
                                             src="{{asset('assets/icons/line-schedule.svg')}}">
                                        <div style="width: 45%;padding-left: 0">
                                            <input type="text" id="edit_date-2"
                                                   class="form-control date-2 flatpickr-basic flatpickr-input"
                                                   required
                                                   placeholder="YYYY-MM-DD" readonly="readonly">
                                        </div>
                                    </div>
                                    <div id="work-schedule-edit">
                                        <p class="f-15 fw-bold mt-1 mb-1">Робочий день</p>
                                        <div class="col-12 d-flex two-input-for-schedule-inmodal">
                                            <div style="width: 45%;padding-right: 0">
                                                <input type="text" id="edit_work_from"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                            <img class="align-self-center"
                                                 style="width: 45px;height: 2px; padding-left: 12px; padding-right: 12px;"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}">
                                            <div style="width: 45%;padding-left: 0">
                                                <input type="text" id="edit_work_to"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                        </div>
                                        <p class="f-15 fw-bold mt-1 mb-1">Обід</p>
                                        <div class="col-12 d-flex two-input-for-schedule-inmodal">
                                            <div style="width: 45%;padding-right: 0">
                                                <input type="text" id="edit_break_from"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                            <img class="align-self-center"
                                                 style="width: 45px;height: 2px; padding-left: 12px; padding-right: 12px;"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}">
                                            <div style="width: 45%;padding-left: 0">
                                                <input type="text" id="edit_break_to"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <div class="d-flex float-end">
                                            <button class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати
                                            </button>
                                            <button class="btn btn-primary" id="edit_condition_submit">Зберегти
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>


        </div>


        <div class="modal text-start" id="cancel_edit_user" tabindex="-1" aria-labelledby="myModalLabel6"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder">
                            Скасувати редагування складу
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Ви точно впевнені що хочете вийти з редагування? <br> Внесені зміни
                                не
                                збережуться.
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати
                                    </button>
                                    <a class="btn btn-primary" href="{{"/warehouse/1"}}">Підтвердити</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection

@section('page-script')

    <script>

        let conditions = {!! json_encode($warehouse->conditions) !!}
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

    <script>
        var coordinates = {!! ($warehouse->coordinates) !!};

        $(document).ready(function () {
            $('#add-special-condition').on('click', function () {
                $('#work-schedule').addClass('d-none');
            });
        });

        $(document).ready(function () {
            $('#condition_name').on('change', function () {
                var selectedOption = $(this).find('option:selected').val();
                if (['Вихідний', 'Лікарняний', 'Державний вихідний'].includes(selectedOption)) {
                    $('#work-schedule').addClass('d-none');
                } else {
                    $('#work-schedule').removeClass('d-none');
                }
            });
        });

        $(document).ready(function () {
            $('#edit_condition_name').on('change', function () {
                var selectedOption = $(this).find('option:selected').val();
                if (['Вихідний', 'Лікарняний', 'Державний вихідний'].includes(selectedOption)) {
                    $('#work-schedule-edit').addClass('d-none');
                } else {
                    $('#work-schedule-edit').removeClass('d-none');
                }
            });
        });
    </script>
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>

    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>

    <script src="{{asset('js/scripts/maps/map-leaflet.js')}}"></script>
    <script src="{{asset('vendors/js/maps/leaflet.min.js')}}"></script>


    <script src="{{asset('assets/js/utils/locationWarehouseMaps.js')}}"></script>

    <script src="{{asset('assets/js/entity/location/warehouse.js')}}"></script>

   
@endsection
