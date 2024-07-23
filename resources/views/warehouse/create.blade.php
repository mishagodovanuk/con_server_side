@extends('layouts.admin')
@section('title','')
@section('page-style')
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/maps/leaflet.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/maps/map-leaflet.css'))}}">

@endsection
@section('content')
    <div class="row mx-2">
        <div class="align-self-start pb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-slash">
                    <li class="breadcrumb-item">
                        <a class="link-secondary" href="/warehouse">Склади</a>
                    </li>
                    <li class="breadcrumb-item fw-bolder active" aria-current="page">Додавання складу
                    </li>
                </ol>
            </nav>
        </div>

        <div class="col-12 col-sm-2 col-lg-2 col-xl-2 col-xxl-2 previous-step p-0">
            <div class="previous-step-title" style="display: none"><img style="margin-right: 0.5rem"
                                                                        src="{{asset('assets/icons/arrow-left.svg')}}"
                                                                        alt="arrow">
                Попередній крок
            </div>
        </div>
        <div
            class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 d-flex align-self-center justify-content-center"
            style="padding: 0">
            <label class="offset-1 create-user-step">1</label>
            <div class="align-self-center step-title">Основні дані</div>

            <div class="align-self-center text-center"><img src="{{asset('assets/icons/chevron-right.svg')}}"
                                                            alt="chevron">
            </div>

            <label class="create-user-step user-step-disabled">2</label>
            <div class="align-self-center step-title">Локація</div>

            <div class="align-self-center text-center"><img src="{{asset('assets/icons/chevron-right.svg')}}"
                                                            alt="chevron">
            </div>

            <label class="create-user-step user-step-disabled">3</label>
            <div class="align-self-center step-title">Графік роботи</div>

            <!-- <img src="{{asset('assets/icons/chevron-right.svg')}}"> -->

            <!-- <label class="create-user-step user-step-disabled">4</label>
                <div class="align-self-center step-title">Мапа складу</div> -->

        </div>

        <div class="col-12 col-sm-2 col-lg-2 col-xl-2 col-xxl-2" style="padding: 0">
            <button class="btn btn-green float-end" id="create" style="display: none;">
                Зберегти
            </button>
            <button class="btn btn-green float-end" id="next_step" style="width: 201px;">Наступний
                крок <img style="margin-left: 5px" src="{{asset('assets/icons/arrow-right.svg')}}" alt="arrow">
            </button>
        </div>
    </div>



    <div id="block_1" class="row mx-0">
        <div class="card col-12">
            <div class="card-header">
                <h4 class="card-title mt-1 fw-bolder">Основні дані</h4>
            </div>
            <div class="card-body my-25">
                <!-- header section -->

                <!--/ header section -->
                <div class="row">

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="warehouseName">Назва складу</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Введіть назву складу">
                    </div>

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="u_company select2-hide-search">Компанія</label>
                        <select class="select2 form-select" id="company" data-dictionary="company" data-placeholder="Оберіть компанію">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="u_type select2-hide-search">Склад ERP</label>
                        <select class="select2 form-select hide-search" id="erp-warehouse" data-dictionary="warehouse_erp"
                                data-placeholder="Оберіть cклад/склади в ERP системі">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="u_type select2-hide-search">Тип складу</label>
                        <select class="select2 form-select hide-search" id="type" data-dictionary="warehouse_type" data-placeholder="Оберіть тип складу">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="city select2-hide-search">Країна</label>
                        <select class="select2 form-select" id="country" data-dictionary="country" data-placeholder="Оберіть країну">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="u_city select2-hide-search">Населений пункт</label>
                        <select class="select2 form-select" id="settlement" data-dictionary="settlement" data-placeholder="Оберіть населений пункт">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="u_street select2-hide-search">Вулиця</label>
                        <select class="select2 form-select" id="street" data-dictionary="street"  data-placeholder="Оберіть вулицю">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="u_number">Номер будинку</label>
                        <input type="text" class="form-control" id="building_number" name="u_number"
                               placeholder="Вкажіть номер будинку">
                    </div>

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="u_number">Підказка до адреси</label>
                        <input type="text" class="form-control" id="address_hint" name="address_hint"
                               placeholder="Вкажіть номер будинку">
                    </div>

                    <div class="col-12 col-md-6 mb-1">
                        <label class="form-label" for="u_pib">Контактна особа</label>
                        <select class="select2 form-select" id="user" data-dictionary="user" data-placeholder="Оберіть контактну особу">
                            <option value=""></option>
                        </select>
                    </div>

                    <div id="main-data-message"></div>

                </div>
                <!--/ form -->
            </div>
        </div>

    </div>

    <div id="block_2" style="display: none" class="row mx-0">

        <div class="card-body h-100 my-25">
            <div class="card">
                <div class="pt-2 ps-2">
                    <h4 class="fw-bolder mb-1">Локація</h4>
                </div>
                <div class="row mx-0">
                    <!-- Draggable Marker With Popup Starts -->
                    <div class="col-12 col-md-5 mt-1 mt-md-0 px-0 pe-md-2">
                        <div class="pb-2 ps-2">
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
                            <div class="card-body ps-0 pt-0">
                                <div id="map" style="height: 400px; border-radius: 6px;"></div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- /Draggable Marker With Popup Ends -->
            </div>
        </div>

    </div>

    <div id="block_3" style="display: none" class="row mx-0">
        <div class="card p-0 mt-2">
            <div class="card-header p-2 pt-3 ps-3 row mx-0">
                <div class=" d-flex justify-content-between align-items-center px-0">
                    <h4 class="card-title col-9 fw-bold">Графік роботи</h4>
                </div>
            </div>
            <div class="card-body row mx-0 p-0">
                <div class="ps-0 col-12 col-lg-8">
                    <div class="card">
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
                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Monday-1"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="09:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Monday-2"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="18:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Tuesday-1"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="09:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Tuesday-2"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="18:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" class="form-control flatpickr-time text-start"
                                                       id="Wednesday-1"
                                                       placeholder="00:00" value="09:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" class="form-control flatpickr-time text-start"
                                                       id="Wednesday-2"
                                                       placeholder="00:00" value="18:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Thursday-1"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="09:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Thursday-2"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="18:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Friday-1"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="09:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Friday-2"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="18:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex  two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Saturday-1"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Saturday-2"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div class="d-flex">
                                                <input type="text" id="Sunday-1"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Sunday-2"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-auto col-md-1 wrapper d-block d-lg-none" style="margin-top: 2.4rem">
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
                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Monday-3"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="13:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Monday-4"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="14:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Tuesday-3"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="13:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Tuesday-4"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="14:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" class="form-control flatpickr-time text-start"
                                                       id="Wednesday-3"
                                                       placeholder="00:00" value="13:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" class="form-control flatpickr-time text-start"
                                                       id="Wednesday-4"
                                                       placeholder="00:00" value="14:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Thursday-3"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="13:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Thursday-4"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="14:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Friday-3"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="13:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Friday-4"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00" value="14:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Saturday-3"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Saturday-4"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                        </div>

                                        <div class="d-flex two-input-for-schedule">
                                            <div>
                                                <input type="text" id="Sunday-3"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                            <div>
                                                <input type="text" id="Sunday-4"
                                                       class="form-control flatpickr-time text-start"
                                                       placeholder="00:00"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto order-2">
                                    <h5 class="" style="margin-bottom: 2rem">Вихідні</h5>
                                    <div class="d-flex flex-column mt-1" style="gap: 2.35rem">
                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <input class="form-check-input mt-0" type="checkbox"
                                                       id="Monday-check">
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <input class="form-check-input" type="checkbox" id="Tuesday-check">
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <input class="form-check-input" type="checkbox"
                                                       id="Wednesday-check">
                                            </div>
                                        </div>


                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <input class="form-check-input" type="checkbox" id="Thursday-check">
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <input class="form-check-input" type="checkbox" id="Friday-check">
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <input class="form-check-input" type="checkbox" id="Saturday-check"
                                                       checked>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <input class="form-check-input" type="checkbox" id="Sunday-check"
                                                       checked>
                                            </div>
                                        </div>

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
                                            <input class="form-check-input" type="checkbox" id="schedule_pattern">
                                            <label class="form-check-label" for="schedule_pattern">Зберегти даний
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
                                {{--                                    TODO id="graphic_save"--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-0 col-lg-4 bg-light-secondary">
                    <div class="card bg-transparent" id="condition-list" style="min-height: 300px">
                        <div class="card-header row mx-0 px-0" id="card-header-conditions">
                            <h4 class="col-auto mb-0 fw-bolder">Спеціальні умови</h4>
                            <p class="text-center d-none">Додані спеціальні умови до вашого графіку будуть </br>
                                відображатися тут</p>
                            <div class="col-2">
                                <button class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                                        data-bs-target="#animation" id="add-special-condition">Додати
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <input class="form-check-input" type="radio" name="select_period" value="period"
                                       checked>
                                <label class="form-check-label" for="period">Період часу</label>
                            </div>
                        </div>
                        <div style="display: none" id="one_day" class="col-12 mt-1">

                            <input type="text" class="form-control one_day flatpickr-basic flatpickr-input"
                                   name="one_day" required placeholder="РРРР-ММ-ДД" readonly="readonly">

                        </div>
                        <div id="period" style="display:flex;" class="col-12 mt-1">
                            <div style="width: 45%;padding-right: 0">
                                <input type="text" id="date-1"
                                       class="form-control date-1 flatpickr-basic flatpickr-input" required
                                       placeholder="РРРР-ММ-ДД" readonly="readonly">
                            </div>
                            <img class="align-self-center"
                                 style="width: 45px;height: 2px; padding-left: 12px; padding-right: 12px;"
                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                            <div style="width: 45%;padding-left: 0">
                                <input type="text" id="date-2"
                                       class="form-control date-2 flatpickr-basic flatpickr-input" required
                                       placeholder="РРРР-ММ-ДД" readonly="readonly">
                            </div>
                        </div>
                        <div class="d-none" id="work-schedule">
                            <p class="f-15 fw-bold mt-1 mb-1">Робочий день</p>
                            <div class="col-12 d-flex two-input-for-schedule-inmodal">
                                <div style="width: 45%;padding-right: 0">
                                    <input type="text" id="work_from" class="form-control flatpickr-time text-start"
                                           placeholder="00:00"/>
                                </div>
                                <img class="align-self-center"
                                     style="width: 45px;height: 2px; padding-left: 12px; padding-right: 12px;"
                                     src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                <div style="width: 45%;padding-left: 0">
                                    <input type="text" id="work_to" class="form-control flatpickr-time text-start"
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
                                     src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                <div style="width: 45%;padding-left: 0">
                                    <input type="text" id="break_to" class="form-control flatpickr-time text-start"
                                           placeholder="00:00"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <div class="d-flex float-end">
                                <button class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати</button>
                                <button class="btn btn-primary" disabled="disabled" id="condition_submit">Зберегти
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

                            <input type="text" id="edit_one_day"
                                   class="form-control one-day edit_one_day flatpickr-basic flatpickr-input"
                                   name="edit_one_day"
                                   required placeholder="РРРР-ММ-ДД" readonly="readonly">

                        </div>
                        <div id="edit_period" style="display:flex;" class="col-12 mt-1">
                            <div style="width: 45%;padding-right: 0">
                                <input type="text" id="edit_date-1"
                                       class="form-control date-1 flatpickr-basic flatpickr-input" required
                                       placeholder="РРРР-ММ-ДД" readonly="readonly">
                            </div>
                            <img class="align-self-center"
                                 style="width: 45px;height: 2px; padding-left: 12px; padding-right: 12px;"
                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                            <div style="width: 45%;padding-left: 0">
                                <input type="text" id="edit_date-2"
                                       class="form-control date-2 flatpickr-basic flatpickr-input" required
                                       placeholder="РРРР-ММ-ДД" readonly="readonly">
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
                                     src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
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
                                     src="{{asset('assets/icons/line-schedule.svg')}}" alt="line-schedule">
                                <div style="width: 45%;padding-left: 0">
                                    <input type="text" id="edit_break_to"
                                           class="form-control flatpickr-time text-start"
                                           placeholder="00:00"/>
                                </div>
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

    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>

    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script> var marker = null;</script>
    <script src="{{asset('js/scripts/maps/map-leaflet.js')}}"></script>

    <script src="{{asset('vendors/js/maps/leaflet.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            $("#settlement, #street, #building_number").change(function () {

                var settlement = $("#settlement option:selected").text();
                var street = $("#street option:selected").text();
                var buildingNumber = $("#building_number").val();

                if (settlement && street && buildingNumber) {
                    // Об'єднуємо значення через пробіл і записуємо в #map-input
                    var combinedValue = settlement + " " + street + " " + buildingNumber;
                    $("#map-input").val(combinedValue);
                    // setTimeout(function() {
                    //         $("#map-input").blur();
                    //     }, 3000);

                }
            });

        });
    </script>
    <script src="{{asset('assets/js/utils/locationWarehouseMaps.js')}}"></script>
    <script>const conditions = [];</script>
    <script src="{{asset('assets/js/entity/location/warehouse.js')}}"></script>

    <script>

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

@endsection
