@extends('layouts.admin')
@section('title','Склад')
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">

<link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
<link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
<link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
<link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">

<link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/maps/leaflet.min.css'))}}">
<link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/maps/map-leaflet.css'))}}">

<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
@endsection
@section('before-style')
<link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css" />
@endsection

@section('table-js')
@include('layouts.table-scripts')
<script type="text/javascript">
    // Ініціалізуємо таби
    $('#tabs').jqxTabs({
        width: '100%',
        height: '100%'
    });
</script>
@endsection

@section('content')

<div class="px-2">

    <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
        <div class=" align-self-start">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-slash">
                    <li class="breadcrumb-item">
                        <a class="link-secondary" href="/warehouse">Склади</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="link-secondary" href="">Перегляд складу Bolero</a>
                    </li>
                    <li class="breadcrumb-item fw-bolder active" aria-current="page">Редагування складу
                    </li>
                </ol>
            </nav>
        </div>
        <div class=" d-flex gap-1 align-self-end ">
            <button data-bs-toggle="modal" id="cancel_button" data-bs-target="#cancel_edit_user" type="submit" class="btn btn-flat-secondary">
                Скасувати
            </button>
            <button type="submit" class="btn btn-green">
                Зберегти
            </button>
        </div>
    </div>

    <div class="locations-tabs mb-3" id="tabs">
        <ul class="d-flex ">
            <li>Основні дані</li>
            <li>Локація</li>
            <li>Графік роботи</li>
        </ul>

        <div id="block_1" class="row mx-0">
            <div class="col-12">
                <div class="card-body my-25">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="warehouseName">Назва складу</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Введіть назву складу">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="u_company select2-hide-search">Компанія</label>
                            <select class="select2 form-select" id="company" data-placeholder="Оберіть компанію">
                                <option value=""></option>
                                @foreach($companies as $company)
                                <option value="{{$company->id}}" {{$warehouse->company_id=== $company->id
                            ?'selected' : ''}}>{{$company->company->name ?? $company->company->surname.' '.
                            $company->company->first_name.' '.$company->company->patronymic}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="u_type select2-hide-search">Склад ERP</label>
                            <select class="select2 form-select hide-search" id="erp-warehouse" data-placeholder="Оберіть cклад/склади в ERP системі">
                                <option value=""></option>
                                @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="u_type select2-hide-search">Тип складу</label>
                            <select class="select2 form-select hide-search" id="type" data-placeholder="Оберіть тип складу">
                                <option value=""></option>
                                @foreach($types as $type)
                                <option value="{{$type->id}}" {{$warehouse->type_id=== $type->id
                            ?'selected' : ''}}>{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="city select2-hide-search">Країна</label>
                            <select class="select2 form-select" id="country" data-placeholder="Оберіть країну">
                                <option value=""></option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" {{$warehouse->address->country_id === $country->id
                            ? 'selected' : ''}}>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="u_city select2-hide-search">Населений пункт</label>
                            <select class="select2 form-select" id="settlement" data-placeholder="Оберіть населений пункт">
                                <option value=""></option>
                                @foreach($settlements as $settlement)
                                <option value="{{$settlement->id}}" {{$warehouse->address->settlement_id=== $settlement->id
                            ?'selected' : ''}}>{{$settlement->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="u_street select2-hide-search">Вулиця</label>
                            <select class="select2 form-select" id="street" data-placeholder="Оберіть вулицю">
                                <option value=""></option>
                                @foreach($streets as $street)
                                <option value="{{$street->id}}" {{$warehouse->address->street_id=== $street->id
                            ?'selected' : ''}}>{{$street->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="u_number">Номер будинку</label>
                            <input type="text" class="form-control" value="{{$warehouse->address->building_number}}" id="building_number" name="u_number" placeholder="Вкажіть номер будинку">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="u_pib select2-hide-search">Контактна особа</label>
                            <select class="select2 form-select" id="user" data-placeholder="Оберіть контактну особу">
                                <option value=""></option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}" {{$warehouse->user_id=== $user->id
                            ?'selected' : ''}}>{{$user->surname.' '.$user->name.' '.$user->patronimyc}}</option>
                                @endforeach
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
                    <div class="row px-1">
                        <!-- Draggable Marker With Popup Starts -->
                        <div class="col-12 col-sm-12 col-md-7 col-lg-7 pe-2 ps-0">
                            <div class="">
                                <div class="card-body">
                                    <div id="map" style="height: 400px; border-radius: 6px;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-5 col-sm-5 px-0">
                            <div class="pb-2">
                                <div class="d-flex justify-content-between gap-1">
                                    <div class="d-flex flex-column" style="flex: 3;">
                                        <label class="form-label f-14">Координати або назва локації</label>
                                        <input type="text" class="form-control" id="map-input" name="" placeholder="Вкажіть координати або назву локації" value="" required data-msg="Please enter last name">
                                    </div>
                                    <div class="d-flex flex-column justify-content-end">
                                        <button class="btn btn-outline-primary" id="submit" type="button">Додати локацію</button>
                                    </div>
                                </div>
                                <p class="mt-1 message_add" id="messageAdd"></p>
                            </div>
                        </div>
                    </div>

                    <!-- /Draggable Marker With Popup Ends -->
                </div>
            </div>

        </div>

        <div id="block_3" class="row p-0">
            <div>
                <div class="">

                    <div class="d-flex">
                        <div class="px-3" style="width: 60.4%; padding-top: 22px; padding-bottom: 22px;">

                            <div class=" my-25">
                                <div class="row">
                                    <span class="offset-1 col-5 work-graphic-title">Робочі години</span>
                                    <span class="col-4 work-graphic-title">Обід</span>
                                    <span class="col-2 work-graphic-title float-end text-end">Вихідні</span>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-1 work-graphic-title align-self-center">Пн</span>
                                    <div style="width: 16.5%;padding-right: 0">
                                        <input type="text" id="Monday-1" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Monday-2" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>

                                    <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                                        <input type="text" id="Monday-3" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Monday-4" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <div style="width: 11%" class="align-self-center text-center">
                                        <input class="form-check-input" type="checkbox" id="Monday-check">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-1 work-graphic-title align-self-center">Вт</span>
                                    <div style="width: 16.5%;padding-right: 0">
                                        <input type="text" id="Tuesday-1" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Tuesday-2" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>

                                    <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                                        <input type="text" id="Tuesday-3" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Tuesday-4" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <div style="width: 11%" class="align-self-center text-center">
                                        <input class="form-check-input" type="checkbox" id="Tuesday-check">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-1 work-graphic-title align-self-center">Ср</span>
                                    <div style="width: 16.5%;padding-right: 0">
                                        <input type="text" class="form-control flatpickr-time text-start" id="Wednesday-1" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" class="form-control flatpickr-time text-start" id="Wednesday-2" placeholder="00:00" />
                                    </div>

                                    <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                                        <input type="text" class="form-control flatpickr-time text-start" id="Wednesday-3" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" class="form-control flatpickr-time text-start" id="Wednesday-4" placeholder="00:00" />
                                    </div>
                                    <div style="width: 11%" class="align-self-center text-center">
                                        <input class="form-check-input" type="checkbox" id="Wednesday-check">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-1 work-graphic-title align-self-center">Чт</span>
                                    <div style="width: 16.5%;padding-right: 0">
                                        <input type="text" id="Thursday-1" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Thursday-2" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>

                                    <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                                        <input type="text" id="Thursday-3" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Thursday-4" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <div style="width: 11%" class="align-self-center text-center">
                                        <input class="form-check-input" type="checkbox" id="Thursday-check">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-1 work-graphic-title align-self-center">Пт</span>
                                    <div style="width: 16.5%;padding-right: 0">
                                        <input type="text" id="Friday-1" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Friday-2" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>

                                    <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                                        <input type="text" id="Friday-3" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Friday-4" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <div style="width: 11%" class="align-self-center text-center">
                                        <input class="form-check-input" type="checkbox" id="Friday-check">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-1 work-graphic-title align-self-center">Сб</span>
                                    <div style="width: 16.5%;padding-right: 0">
                                        <input type="text" id="Saturday-1" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Saturday-2" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>

                                    <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                                        <input type="text" id="Saturday-3" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Saturday-4" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <div style="width: 11%" class="align-self-center text-center">
                                        <input class="form-check-input" type="checkbox" id="Saturday-check">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <span class="col-1 work-graphic-title align-self-center">Нд</span>
                                    <div style="width: 16.5%;padding-right: 0">
                                        <input type="text" id="Sunday-1" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Sunday-2" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>

                                    <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                                        <input type="text" id="Sunday-3" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 16.5%;padding-left: 0">
                                        <input type="text" id="Sunday-4" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <div style="width: 11%" class="align-self-center text-center">
                                        <input class="form-check-input" type="checkbox" id="Sunday-check">
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex gap-1">
                                        <div class="d-flex align-items-center" style="flex:2">
                                            <label class="form-label" for="select2-hide-search" style="font-size: 15px; color: rgb(0, 0, 0);">Використати шаблон</label>
                                        </div>
                                        <div class="d-flex" style="flex: 3;">
                                            <select class="hide-search form-select" id="select2-hide-search">
                                                <option value="common" selected>Стандартний шаблон</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <div class="d-flex align-items-center" style="flex: 2;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="" />
                                                <label class="form-check-label" for="inlineCheckbox1">Зберегти даний графік як шаблон</label>
                                            </div>
                                        </div>
                                        <div class="d-flex" style="flex: 3;">
                                            <input type="text" class="form-control" id="basicInput" placeholder="Введіть назву шаблону" style="color: rgb(0, 0, 0);" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="" style="width: 39.6%; background-color: rgba(168, 170, 174, 0.08);">
                            <div class="" style="min-height: 300px">
                                <div class="" id="condition-list">
                                    <div class="row mb-1 px-2 pt-2">
                                        <div class="col-6 work-graphic-title align-self-center">
                                            <h4 class="">Спеціальні умови</h4>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#animation"><i data-feather="plus" style="margin-right: 5px;"></i> Додати
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

        <!-- Modal -->
        <div class="modal text-start" id="animation" tabindex="-1" aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="card popup-card">
                        <div class="popup-header" style="color: #4B465C;">
                            Добавити спец. умову
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 mb-2">
                                    <label class="form-label" for="condition_name">Назва
                                        умови</label>
                                    <select class="select2 hide-search form-select" id="condition_name" data-placeholder="Виберіть умову">
                                        <option id="condition_none" value=""></option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="select_period" value="one_day">
                                    <label class="form-check-label" for="one_day">Один день</label>
                                </div>
                                <div class="form-check" style="margin-top: 5px">
                                    <input class="form-check-input" type="radio" name="select_period" value="period" checked>
                                    <label class="form-check-label" for="period">Період часу</label>
                                </div>
                            </div>
                            <div style="display: none" id="one_day" class="col-12 mt-1">

                                <input type="text" class="form-control one_day flatpickr-basic flatpickr-input" name="one_day" required placeholder="YYYY-MM-DD" readonly="readonly">

                            </div>
                            <div id="period" style="display:flex;" class="col-12 mt-1">
                                <div style="width: 45%;padding-right: 0">
                                    <input type="text" id="date-1" class="form-control date-1 flatpickr-basic flatpickr-input" required placeholder="YYYY-MM-DD" readonly="readonly">
                                </div>
                                <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                <div style="width: 45%;padding-left: 0">
                                    <input type="text" id="date-2" class="form-control date-2 flatpickr-basic flatpickr-input" required placeholder="YYYY-MM-DD" readonly="readonly">
                                </div>
                            </div>
                            <div id="work-schedule">
                                <p class="f-15 fw-bold mt-1 mb-1">Робочий день</p>
                                <div class="col-12 d-flex">
                                    <div style="width: 45%;padding-right: 0">
                                        <input type="text" id="work_from" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 45%;padding-left: 0">
                                        <input type="text" id="work_to" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                </div>
                                <p class="f-15 fw-bold mt-1 mb-1">Обід</p>
                                <div class="col-12 d-flex">
                                    <div style="width: 45%;padding-right: 0">
                                        <input type="text" id="break_from" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 45%;padding-left: 0">
                                        <input type="text" id="break_to" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
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
                        <div class="popup-header" style="color: #4B465C;">
                            Редагувати спец. умову
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 mb-2">
                                    <label class="form-label" for="edit_condition_name">Назва
                                        умови</label>
                                    <select class="select2 hide-search form-select" id="edit_condition_name" data-placeholder="Виберіть умову">

                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="edit_select_period" value="one_day">
                                    <label class="form-check-label" for="edit_one_day">Один день</label>
                                </div>
                                <div class="form-check" style="margin-top: 5px">
                                    <input class="form-check-input" type="radio" name="edit_select_period" value="period" checked="">
                                    <label class="form-check-label" for="period">Період часу</label>
                                </div>
                            </div>
                            <div style="display: none" id="edit_one_day" class="col-12 mt-1">

                                <input type="text" class="form-control edit_one_day flatpickr-basic flatpickr-input" name="edit_one_day" required placeholder="YYYY-MM-DD" readonly="readonly">

                            </div>
                            <div id="edit_period" style="display:flex;" class="col-12 mt-1">
                                <div style="width: 45%;padding-right: 0">
                                    <input type="text" id="edit_date-1" class="form-control date-1 flatpickr-basic flatpickr-input" required placeholder="YYYY-MM-DD" readonly="readonly">
                                </div>
                                <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                <div style="width: 45%;padding-left: 0">
                                    <input type="text" id="edit_date-2" class="form-control date-2 flatpickr-basic flatpickr-input" required placeholder="YYYY-MM-DD" readonly="readonly">
                                </div>
                            </div>
                            <div id="work-schedule-edit">
                                <p class="f-15 fw-bold mt-1 mb-1">Робочий день</p>
                                <div class="col-12 d-flex">
                                    <div style="width: 45%;padding-right: 0">
                                        <input type="text" id="edit_work_from" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 45%;padding-left: 0">
                                        <input type="text" id="edit_work_to" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                </div>
                                <p class="f-15 fw-bold mt-1 mb-1">Обід</p>
                                <div class="col-12 d-flex">
                                    <div style="width: 45%;padding-right: 0">
                                        <input type="text" id="edit_break_from" class="form-control flatpickr-time text-start" placeholder="00:00" />
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px" src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 45%;padding-left: 0">
                                        <input type="text" id="edit_break_to" class="form-control flatpickr-time text-start" placeholder="00:00" />
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


    </div>


    <div class="modal text-start" id="cancel_edit_user" tabindex="-1" aria-labelledby="myModalLabel6" aria-hidden="true">
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
<script src="{{asset('vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>

<script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>

<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>
<script src="{{asset('js/scripts/maps/map-leaflet.js')}}"></script>

<script src="{{asset('vendors/js/maps/leaflet.min.js')}}"></script>

<script src="{{asset('assets/js/utils/locationWarehouseMaps.js')}}"></script>

<script src="{{asset('assets/js/warehouse.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#condition_name').on('change', function() {
            var selectedOption = $(this).find('option:selected').val();
            if (selectedOption === 'Вихідний') {
                $('#work-schedule').addClass('d-none');
            } else {
                $('#work-schedule').removeClass('d-none');
            }
        });
    });

    $(document).ready(function() {
        $('#edit_condition_name').on('change', function() {
            var selectedOption = $(this).find('option:selected').val();
            if (selectedOption === 'Вихідний') {
                $('#work-schedule-edit').addClass('d-none');
            } else {
                $('#work-schedule-edit').removeClass('d-none');
            }
        });
    });
</script>
@endsection
