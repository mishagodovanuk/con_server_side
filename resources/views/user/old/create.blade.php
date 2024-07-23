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
    <div class="row mx-2">
        <div class="col-12 col-sm-2 col-lg-2 col-xl-2 col-xxl-2 previous-step p-0">
            <div class="previous-step-title" style="display: none"><img style="margin-right: 0.5rem"
                                                                        src="{{asset('assets/icons/arrow-left.svg')}}">
                Попередній крок
            </div>
        </div>
        <div
            class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 d-flex align-self-center justify-content-center"
            style="padding: 0">
            <label class="offset-1 create-user-step">1</label>
            <div class="align-self-center step-title">Основні дані</div>

            <div class="align-self-center text-center"><img src="{{asset('assets/icons/chevron-right.svg')}}">
            </div>

            <label class="create-user-step user-step-disabled">2</label>
            <div class="align-self-center step-title">Графік роботи</div>

        </div>

        <div class="col-12 col-sm-2 col-lg-2 col-xl-2 col-xxl-2" style="padding: 0">
            <button class="btn btn-green float-end" id="create_user" style="display: none;">
                Добавити користувача
            </button>
            <button class="btn btn-green float-end" id="next_step" style="width: 201px;">Наступний
                крок <img style="margin-left: 5px" src="{{asset('assets/icons/arrow-right.svg')}}">
            </button>
        </div>
    </div>
    <div id="block_1" class="row mx-0">
        <div class="card col-12">
            <div class="card-header">
                <h4 class="card-title">Особисті дані</h4>
            </div>
            <div class="card-body my-25">
                <!-- header section -->
                <div class="d-flex">
                    <a href="#" class="me-25">
                        <img src="{{ asset('assets/images/avatar_empty.png') }}" id="account-upload-img"
                             class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">
                    </a>
                    <!-- upload and reset button -->
                    <div class="d-flex align-items-end mb-1 ms-1">
                        <div>
                            <label for="account-upload"
                                   class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                            <input type="file" id="account-upload" name="avatar" hidden=""
                                   accept="image/jpeg, image/png, image/gif">
                            <button type="submit" id="account-reset"
                                    class="btn btn-sm btn-outline-secondary mb-75 waves-effect">Видалити
                            </button>
                            <p class="mb-0">Формати JPG, GIF або PNG</p>
                            <p class="mb-0">Розмір не більше 800kB </p>
                        </div>
                    </div>
                    <!--/ upload and reset button -->
                </div>
                <!--/ header section -->
                <div class="mt-2 pt-50">
                    <div class="row">
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountLastName">Прізвище</label>
                            <input type="text" class="form-control" id="accountLastName" name="surname"
                                   placeholder="Вкажіть ваше прізвище" required data-msg="Please enter last name">
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountFirstName">Ім’я</label>
                            <input type="text" class="form-control" id="accountFirstName" name="name" required
                                   placeholder="Вкажіть ваше ім’я" data-msg="Please enter first name">
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountPatronymic">По батькові</label>
                            <input type="text" class="form-control" id="accountPatronymic" name="patronymic" required
                                   placeholder="Вкажіть ваше ім’я по батькові" data-msg="Please enter patronymic">
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="fp-default">Дата народження</label>
                            <input type="text" id="fp-default" class="form-control flatpickr-basic flatpickr-input"
                                   required placeholder="РРРР.ММ.ДД" name="birthday" readonly="readonly">
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountEmail">Адреса електронної пошти</label>
                            <input type="email" class="form-control" id="accountEmail" name="email" required
                                   placeholder="example@gmail.com">
                        </div>

                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountPhoneNumber">Номер телефону</label>
                            <input id="phone" type="tel" required class="form-control account-number-mask" name="phone"
                                   placeholder="+380666666666">
                        </div>

                        <div class="col-4">
                            <label class="form-label">Тимчасовий пароль</label>
                            <input type="text" class="form-control" required id="password" name="password"
                                   autocomplete="off" placeholder="Придумайте тимчасовий пароль">
                        </div>
                        <div class="col-3 align-self-center" style="margin-top: 8px">
                            <button id="generate-password" class="btn btn-outline-primary">Згенерувати пароль</button>
                        </div>

                        <div id="private-data-message"></div>

                    </div>
                </div>
                <!--/ form -->
            </div>
        </div>

        <div class="card mt-1 col-12">
            <div class="card-header">
                <h4 class="card-title">Робочі дані</h4>
            </div>
            <div class="card-body my-25">
                <div class="row">

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="select2-hide-search">Посада/Роль</label>
                        <select class="select2 hide-search form-select" id="position"
                                data-placeholder="Виберіть посаду / роль">
                            <option value=""></option>
                            @foreach($positions as $position)
                                <option value="{{$position->key}}">{{$position->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="select2-hide-search">Підрозділ</label>
                        <select class="select2 hide-search form-select" id="unit" data-placeholder="Виберіть підрозділ">
                            <option value=""></option>
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="select2-hide-search">Бригада</label>
                        <select class="select2 hide-search form-select" id="brigade"
                                data-placeholder="Виберіть бригаду">
                            <option value=""></option>
                            @foreach($brigades as $brigade)
                                <option value="{{$brigade->id}}">{{$brigade->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="code">Код користувача</label>
                        <input type="text" class="form-control" id="code" name="code" required
                               placeholder="XXXXXXXXXXXXXXXX">
                    </div>

                    <div class="col-8">
                        <button type="button" style="box-shadow: none" id="generate-code"
                                class="btn generate-code-button me-1">
                            Згенерувати новий код
                        </button>
                    </div>

                    <div class="row" id="driver_block" style="display: none">
                        <div style="width: 34%" class="mb-1">
                            <label class="form-label" for="driving_license_number">Номер посвідчення водія</label>
                            <input type="text" class="form-control" id="driving_license_number" placeholder="ААА000000"
                                   data-msg="Please enter">
                        </div>

                        <div style="width: 34%" class="mb-1">
                            <label for="driving_license" class="form-label">Завантажити посвідчення водія</label>
                            <input class="form-control" data-buttonText="Вибрати файл" type="file"
                                   id="driving_license"/>
                        </div>

                        <div class="col-12 col-sm-3 mb-1 ">
                        </div>

                        <div style="width: 34%" class="mb-1">
                            <label class="form-label" for="health_book_number">Номер особової медичної книжки</label>
                            <input type="text" class="form-control" placeholder="000000" id="health_book_number"
                                   style="text-transform: uppercase"
                                   data-msg="Please enter">
                        </div>

                        <div style="width: 34%" class="mb-1">
                            <label for="health_book" class="form-label">Завантажити санітарну книжку</label>
                            <input class="form-control" data-buttonText="Вибрати файл" type="file" id="health_book"/>
                        </div>

                        <div class="col-12 col-sm-3 mb-1 ">
                        </div>
                    </div>
                    <div id="work-data-message"></div>
                </div>
            </div>
        </div>

    </div>
{{--    <div id="block_2" style="display: none" class="row mx-0">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <h4 class="card-title">Пароль</h4>--}}
{{--            </div>--}}


{{--            <div class="card-body my-25">--}}


{{--                <div class="row">--}}

{{--                    <div class="col-4 mb-1">--}}
{{--                        <label class="form-label" for="passwordEmail">Логін</label>--}}
{{--                        <input type="text" class="form-control" id="login"--}}
{{--                               placeholder="Придумайте логін для користувача" autocomplete="off" required>--}}
{{--                    </div>--}}

{{--                    <div class="col-4">--}}
{{--                        <label class="form-label">Тимчасовий пароль</label>--}}
{{--                        <input type="text" class="form-control" required id="password" name="password"--}}
{{--                               autocomplete="off" placeholder="Придумайте тимчасовий пароль">--}}
{{--                    </div>--}}
{{--                    <div class="col-3 align-self-center" style="margin-top: 8px">--}}
{{--                        <button id="generate-password" class="btn btn-outline-primary">Згенерувати пароль</button>--}}
{{--                    </div>--}}
{{--                    <div id="change-password-message"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="card mt-1">--}}
{{--            <div class="card-header">--}}
{{--                <h4 class="card-title">Пароль (планшет)</h4>--}}
{{--            </div>--}}
{{--            <div class="card-body my-25">--}}
{{--                <div class="row">--}}

{{--                    <div class="col-4">--}}
{{--                        <label class="form-label" for="pinEmail">Логін (планшет)</label>--}}
{{--                        <input type="text" class="form-control" id="tab-login" name="tab_login"--}}
{{--                               placeholder="Придумайте логін для користувача" autocomplete="off" required>--}}
{{--                    </div>--}}

{{--                    <div class="col-4 mb-1">--}}

{{--                        <label class="form-label">Пін код</label>--}}
{{--                        <input type="text" class="form-control" id="tab-password" required name="pin" autocomplete="off"--}}
{{--                               placeholder="Придумайте тимчасовий пінкод">--}}
{{--                    </div>--}}

{{--                    <div class="col-3 align-self-center" style="margin-top: 8px">--}}
{{--                        <button id="generate-pin" class="btn btn-outline-primary">Згенерувати пін код</button>--}}
{{--                    </div>--}}
{{--                    <div id="change-pin-message"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div id="block_2" style="display: none" class="row mx-0">
        <div class="ps-0" style="width: 60.4%">
            <div class="card mt-2">
                <div class="card-body my-25">
                    <div class="row">
                        <span class="offset-1 col-5 work-graphic-title">Робочий день</span>
                        <span class="col-4 work-graphic-title">Обід</span>
                        <span class="col-2 work-graphic-title float-end text-end">Вихідні</span>
                    </div>
                    <div class="row mt-2">
                        <span class="col-1 work-graphic-title align-self-center">Пн</span>
                        <div style="width: 16.5%;padding-right: 0">
                            <input type="text" id="Monday-1" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Monday-2" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>

                        <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                            <input type="text" id="Monday-3" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Monday-4" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <div style="width: 11%" class="align-self-center text-center">
                            <input class="form-check-input" type="checkbox" id="Monday-check">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <span class="col-1 work-graphic-title align-self-center">Вт</span>
                        <div style="width: 16.5%;padding-right: 0">
                            <input type="text" id="Tuesday-1" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Tuesday-2" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>

                        <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                            <input type="text" id="Tuesday-3" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Tuesday-4" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <div style="width: 11%" class="align-self-center text-center">
                            <input class="form-check-input" type="checkbox" id="Tuesday-check">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <span class="col-1 work-graphic-title align-self-center">Ср</span>
                        <div style="width: 16.5%;padding-right: 0">
                            <input type="text" class="form-control flatpickr-time text-start" id="Wednesday-1"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" class="form-control flatpickr-time text-start" id="Wednesday-2"
                                   placeholder="00:00"/>
                        </div>

                        <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                            <input type="text" class="form-control flatpickr-time text-start" id="Wednesday-3"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" class="form-control flatpickr-time text-start" id="Wednesday-4"
                                   placeholder="00:00"/>
                        </div>
                        <div style="width: 11%" class="align-self-center text-center">
                            <input class="form-check-input" type="checkbox" id="Wednesday-check">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <span class="col-1 work-graphic-title align-self-center">Чт</span>
                        <div style="width: 16.5%;padding-right: 0">
                            <input type="text" id="Thursday-1" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Thursday-2" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>

                        <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                            <input type="text" id="Thursday-3" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Thursday-4" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <div style="width: 11%" class="align-self-center text-center">
                            <input class="form-check-input" type="checkbox" id="Thursday-check">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <span class="col-1 work-graphic-title align-self-center">Пт</span>
                        <div style="width: 16.5%;padding-right: 0">
                            <input type="text" id="Friday-1" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Friday-2" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>

                        <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                            <input type="text" id="Friday-3" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Friday-4" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <div style="width: 11%" class="align-self-center text-center">
                            <input class="form-check-input" type="checkbox" id="Friday-check">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <span class="col-1 work-graphic-title align-self-center">Сб</span>
                        <div style="width: 16.5%;padding-right: 0">
                            <input type="text" id="Saturday-1" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Saturday-2" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>

                        <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                            <input type="text" id="Saturday-3" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Saturday-4" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <div style="width: 11%" class="align-self-center text-center">
                            <input class="form-check-input" type="checkbox" id="Saturday-check">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <span class="col-1 work-graphic-title align-self-center">Нд</span>
                        <div style="width: 16.5%;padding-right: 0">
                            <input type="text" id="Sunday-1" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Sunday-2" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>

                        <div style="width: 16.5%;padding-right: 0; margin-left: 3%">
                            <input type="text" id="Sunday-3" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <img class="align-self-center" style="width: 45px;height: 2px"
                             src="{{asset('assets/icons/line.svg')}}">
                        <div style="width: 16.5%;padding-left: 0">
                            <input type="text" id="Sunday-4" class="form-control flatpickr-time text-start"
                                   placeholder="00:00"/>
                        </div>
                        <div style="width: 11%" class="align-self-center text-center">
                            <input class="form-check-input" type="checkbox" id="Sunday-check">
                        </div>
                    </div>
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
                        <div style="display: none" id="one_day" class="col-12 mt-1">

                            <input type="text" id="edit_one_day"
                                   class="form-control one-day flatpickr-basic flatpickr-input" name="edit_one_day"
                                   required placeholder="YYYY-MM-DD" readonly="readonly">

                        </div>
                        <div id="period" style="display:flex;" class="col-12 mt-1">
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
    <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/entity/user/create-user.js')}}"></script>



    <script>
        window.onload = () => {
            flatpickr('#fp-default')
            $("#phone").mask("+380999999999");

        }
    </script>

@endsection
