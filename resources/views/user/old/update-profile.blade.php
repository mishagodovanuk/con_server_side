@extends('layouts.admin')
@section('title','')
@section('page-style')
    <script src="{{asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js'))}}"></script>

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">


    <script src="{{asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js'))}}"></script>


    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">

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
    </script>
@endsection
@section('content')
    <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
        <div class=" align-self-start">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-slash">
                    <li class="breadcrumb-item"><a href="#" style="color: #4B465C;">Товари</a></li>
                    <li class="breadcrumb-item fw-bolder active" aria-current="page">Перегляд товару</li>
                </ol>
            </nav>
        </div>
        <div class=" d-flex gap-1 align-self-end ">
            <button type="submit" class="btn btn-flat-primary">
                Зберегти як чорновик
            </button>
            <button type="submit" class="btn btn-green">
                Зберегти
            </button>
        </div>
    </div>

    <div id="tabs">
        <ul class="d-flex ">
            <li>Особисті дані</li>
            <li>Робочі дані</li>
            <li>Графік роботи</li>
        </ul>

        <div>
            <div class="card-body my-25">
                <!-- header section -->

                <div class="d-flex">
                    <a href="#" class="me-25">
                        <img src="{{ $user->avatar_type ? asset('uploads/user/avatars/'.$user->id.'.'.$user->avatar_type)
        : asset('assets/images/avatar_empty.png') }}" id="account-upload-img" class="uploadedAvatar rounded me-50"
                             alt="profile image" height="100" width="100">
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
                                   placeholder="Вкажіть ваше прізвище" value="{{$user->surname}}" required
                                   data-msg="Please enter last name">
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountFirstName">Ім’я</label>
                            <input type="text" class="form-control" id="accountFirstName" name="name"
                                   value="{{$user->name}}" required placeholder="Вкажіть ваше ім’я"
                                   data-msg="Please enter first name">
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountPatronymic">По батькові</label>
                            <input type="text" class="form-control" id="patronymic" name="patronymic"
                                   value="{{$user->patronymic}}" required placeholder="Вкажіть ваше ім’я по батькові"
                                   data-msg="Please enter patronymic">
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="fp-default">Дата народження</label>
                            <input type="text" id="fp-default" class="form-control flatpickr-basic flatpickr-input"
                                   value="{{$user->birthday}}" required placeholder="РРРР-ММ-ДД" name="birthday"
                                   readonly="readonly">
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountEmail">Адреса електронної пошти</label>
                            <input type="email" class="form-control" id="accountEmail" name="email" required
                                   value="{{$user->email}}" placeholder="example@gmail.com">
                        </div>

                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountPhoneNumber">Номер телефону</label>
                            <input id="phone" type="tel" required class="form-control account-number-mask" name="phone"
                                   value="{{$user->phone}}" placeholder="+380666666666">
                        </div>
                        <div id="private-data-message"></div>

                        <div class="col-12">
                            <div class="float-end">
                                <button type="button" id="private-data"
                                        class="btn btn-green mt-1 waves-effect waves-float waves-light">
                                    Зберегти
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ form -->
            </div>
        </div>
        <div>
            <form autocomplete="off">
                <div class="card-body my-25">
                    <div class="row">

                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="select2-hide-search">Посада/Роль</label>
                            <select class="select2 hide-search form-select" id="position"
                                    data-placeholder="Виберіть посаду / роль">
                                <option value=""></option>
                                @foreach($positions as $position)
                                    <option
                                        value="{{$position->key}}" {{$user->position_id === $position->id ? 'selected' : ''}}>
                                        {{$position->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="select2-hide-search">Підрозділ</label>
                            <select class="select2 hide-search form-select" id="unit"
                                    data-placeholder="Виберіть підрозділ">
                                <option value=""></option>
                                @foreach($units as $unit)
                                    <option
                                        value="{{$unit->id}}" {{$user->unit_id === $unit->id ? 'selected' : ''}}>{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="select2-hide-search">Бригада</label>
                            <select class="select2 hide-search form-select" id="brigade"
                                    data-placeholder="Виберіть бригаду">
                                <option value=""></option>
                                @foreach($brigades as $brigade)
                                    <option
                                        value="{{$brigade->id}}" {{$user->brigade_id === $position->id ? 'selected' : ''}}>
                                        {{$brigade->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="code">Код користувача</label>
                            <input type="text" class="form-control" value="{{$user->key_pass_card}}" id="code"
                                   name="code"
                                   required
                                   placeholder="XXXXXXXXXXXXXXXX">
                        </div>

                        <div class="col-8">
                            <button type="button" style="box-shadow: none" id="generate-code"
                                    class="btn generate-code-button me-1">
                                Згенерувати новий код
                            </button>
                        </div>

                        <div class="row" id="driver_block"
                             style="{{$user->position->key ==='driver' ? '' : 'display: none'}}">
                            <div style="width: 34%" class="mb-1">
                                <label class="form-label" for="driving_license_number">Номер посвідчення водія</label>
                                <input type="text" class="form-control" id="driving_license_number"
                                       placeholder="ААА000000"
                                       value="{{$user->driving_license_number}}" data-msg="Please enter">
                            </div>

                            <div style="width: 34%" class="mb-1">
                                <label for="driving_license" class="form-label">Завантажити посвідчення водія</label>
                                <input class="form-control" data-buttonText="Вибрати файл" type="file"
                                       id="driving_license"/>
                            </div>

                            <div class="col-12 col-sm-3 mb-1 ">
                            </div>

                            <div style="width: 34%" class="mb-1">
                                <label class="form-label" for="health_book_number">Номер особової медичної
                                    книжки</label>
                                <input type="text" class="form-control" placeholder="000000" id="health_book_number"
                                       style="text-transform: uppercase" value="{{$user->health_book_number}}"
                                       data-msg="Please enter">
                            </div>

                            <div style="width: 34%" class="mb-1">
                                <label for="health_book" class="form-label">Завантажити санітарну книжку</label>
                                <input class="form-control"
                                       data-buttonText="Вибрати файл" type="file" id="health_book"/>
                            </div>

                            <div class="col-12 col-sm-3 mb-1 ">
                            </div>
                        </div>
                        <div id="work-data-message"></div>
                        <div class="col-12">
                            <div class="float-end">
                                <button type="button" id="working_data"
                                        class="btn btn-green mt-1 waves-effect waves-float waves-light">
                                    Зберегти
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

            <div class="card-body my-25">


                <div class="row">

                    <div class="col-12 col-sm-12 mb-1 row">

                        <div class="col-4">
                            <label class="form-label" for="passwordEmail">Логін</label>
                            <input type="email" class="form-control" id="passwordEmail" name="email"
                                   placeholder="Введіть ваш логін користувача" required>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">

                        <label class="form-label">Старий пароль</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input type="password" class="form-control" required name="password" autocomplete="off"
                                   placeholder="Введіть ваш старий пароль">
                            <div class="input-group-text cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Новий пароль</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input type="password" class="form-control" name="new_password"
                                   placeholder="Придумайте новий пароль" required autocomplete="off">
                            <div class="input-group-text cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Повторіть новий пароль</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input type="password" class="form-control" required name="confirm_password"
                                   placeholder="Повторіть новий пароль" autocomplete="off">
                            <div class="input-group-text cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div id="change-password-message"></div>

                    <div class="col-12">
                        <div class="float-end">
                            <button type="button" id="change-password"
                                    class="btn btn-green mt-1 waves-effect waves-float waves-light">
                                Зберегти
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body my-25">
                <div class="row">
                    <div class="col-12 col-sm-12 mb-1 row">
                        <div class="col-4">
                            <label class="form-label" for="pinEmail">Логін</label>
                            <input type="email" class="form-control" id="pinEmail" name="email"
                                   placeholder="Введіть ваш логін користувача" required>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">

                        <label class="form-label">Старий пінкод</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input type="password" class="form-control" required name="pin" autocomplete="off"
                                   placeholder="Введіть ваш старий пінкод">
                            <div class="input-group-text cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Новий пінкод</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input type="password" class="form-control" required name="new_pin" autocomplete="off"
                                   placeholder="Придумайте новий пінкод">
                            <div class="input-group-text cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Повторіть новий пінкод</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input type="password" class="form-control" required name="confirm_pin"
                                   placeholder="Повторіть новий пінкод" autocomplete="off">
                            <div class="input-group-text cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div id="change-pin-message"></div>
                    <div class="col-12">
                        <div class="float-end">
                            <button id="change-pin" type="button"
                                    class="btn btn-green mt-1 waves-effect waves-float waves-light">
                                Зберегти
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
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
                                        <input {{$row->is_day_off ? 'disabled' : ''}} type="text"
                                               id="{{$row->weekday}}-1"
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
{{--                            @if(count($patterns))--}}
{{--                                <hr style="border-top: 2px solid">--}}
{{--                                <div class="mt-1" style="margin-left: 11%">--}}
{{--                                    <ul style="list-style: none;padding-left: 0;margin-left: 0">--}}
{{--                                        <li class="mb-1"><span class="font-medium-1 fw-bold">Використати шаблони</span>--}}
{{--                                        </li>--}}
{{--                                        @foreach($patterns as $pattern)--}}
{{--                                            <li>--}}
{{--                                                <button style="padding-left: 0;margin-left: 0"--}}
{{--                                                        data-pattern="{{$pattern->schedule}}"--}}
{{--                                                        class="btn btn-link graphic-pattern font-medium-1 fw-bold">{{$pattern->name}}--}}
{{--                                                </button>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            @else--}}
{{--                                <div style="display: none"></div>--}}
{{--                            @endif--}}
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
                                        <button class="btn p-0 edit-condition w-50"
                                                onclick="editCondition({{$iteration}})"
                                                id="edit-condition-{{$iteration}}"
                                                data-condition="{{$iteration}}">
                                            <img src="http://127.0.0.1/assets/icons/edit.svg"></button>
                                        <button class="btn p-0 delete-condition w-50"
                                                onclick="deleteCondition({{$iteration}})"
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
{{--                                            @foreach($exceptions as $exception)--}}
{{--                                                <option data-id="{{$exception->id}}"--}}
{{--                                                        value="{{$exception->name}}">{{$exception->name}}</option>--}}
{{--                                            @endforeach--}}
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
                                        <input type="text" id="break_from"
                                               class="form-control flatpickr-time text-start"
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
                                        <button class="btn btn-primary" disabled="true" id="condition_submit">Зберегти
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
{{--                                            @foreach($exceptions as $exception)--}}
{{--                                                <option data-id="{{$exception->id}}"--}}
{{--                                                        value="{{$exception->name}}">{{$exception->name}}</option>--}}
{{--                                            @endforeach--}}
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
                                        <input type="text" id="edit_work_from"
                                               class="form-control flatpickr-time text-start"
                                               placeholder="00:00"/>
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px"
                                         src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 45%;padding-left: 0">
                                        <input type="text" id="edit_work_to"
                                               class="form-control flatpickr-time text-start"
                                               placeholder="00:00"/>
                                    </div>
                                </div>
                                <p class="f-15 fw-bold mt-1 mb-1">Обід</p>
                                <div class="col-12 d-flex">
                                    <div style="width: 45%;padding-right: 0">
                                        <input type="text" id="edit_break_from"
                                               class="form-control flatpickr-time text-start"
                                               placeholder="00:00"/>
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px"
                                         src="{{asset('assets/icons/line.svg')}}">
                                    <div style="width: 45%;padding-left: 0">
                                        <input type="text" id="edit_break_to"
                                               class="form-control flatpickr-time text-start"
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
        </div>
        <input hidden="" id="need_file" value="true">

    </div>

@endsection
@section('page-script')
    <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
    <script>
        var user_id = {!! $user->id !!}

            window.onload = () => {
            flatpickr('#fp-default')
            $("#phone").mask("+380999999999");

            @if($user->position->key === 'driver')

            const fileInput = document.querySelector('#health_book');

            const myFile = new File([''], '{!! $user->surname.'_'.$user->name.'.'.$user->health_book_doctype !!}', {
                type: 'text/plain',
                lastModified: new Date(),
            });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(myFile);
            fileInput.files = dataTransfer.files;

            const fileInput2 = document.querySelector('#driving_license');

            const myFile2 = new File([''], '{!! $user->surname.'_'.$user->name.'.'.$user->driving_license_doctype !!}', {
                type: 'text/plain',
                lastModified: new Date(),
            });

            const dataTransfer2 = new DataTransfer();
            dataTransfer2.items.add(myFile2);
            fileInput2.files = dataTransfer2.files;

            $('#need_file').val('false')
            @endif
        }
    </script>
    <script src="{{asset('assets/js/account.settings.js')}}"></script>

    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{asset('assets/js/edit-schedule.js')}}"></script>
{{--    <script>--}}
{{--        let conditions = {!! json_encode($user->conditions) !!}--}}
{{--            let--}}
{{--        exceptions = {!! json_encode($exceptions) !!}--}}
{{--            let--}}
{{--        exceptionsArray = []--}}
{{--        for (let i = 0; i < exceptions.length; i++) {--}}
{{--            exceptionsArray[exceptions[i].id] = exceptions[i].name--}}
{{--        }--}}

{{--        window.onload = function () {--}}
{{--            schedule()--}}
{{--        }--}}
{{--    </script>--}}
@endsection

{{--@extends('layouts.admin')--}}
{{--@section('title','')--}}
{{--@section('page-style')--}}
{{--    <script src="{{asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js'))}}"></script>--}}

{{--    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">--}}

{{--    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">--}}

{{--@endsection--}}


{{--@section('table-js')--}}
{{--    --}}
{{--    <script type="text/javascript">--}}
{{--        // Ініціалізуємо таби--}}
{{--        $('#tabs').jqxTabs({--}}
{{--            width: '100%',--}}
{{--            height: '100%'--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    <div class="card mx-2 mt-2">--}}
{{--        <div class="card-header">--}}
{{--            <h4 class="card-title">Особисті дані</h4>--}}
{{--        </div>--}}
{{--        <div class="card-body my-25">--}}
{{--            <!-- header section -->--}}

{{--            <div class="d-flex">--}}
{{--                <a href="#" class="me-25">--}}
{{--                    <img src="{{ $user->avatar_type ? asset('uploads/user/avatars/'.$user->id.'.'.$user->avatar_type)--}}
{{--        : asset('assets/images/avatar_empty.png') }}" id="account-upload-img" class="uploadedAvatar rounded me-50"--}}
{{--                         alt="profile image" height="100" width="100">--}}
{{--                </a>--}}
{{--                <!-- upload and reset button -->--}}
{{--                <div class="d-flex align-items-end mb-1 ms-1">--}}
{{--                    <div>--}}
{{--                        <label for="account-upload"--}}
{{--                               class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>--}}
{{--                        <input type="file" id="account-upload" name="avatar" hidden=""--}}
{{--                               accept="image/jpeg, image/png, image/gif">--}}
{{--                        <button type="submit" id="account-reset"--}}
{{--                                class="btn btn-sm btn-outline-secondary mb-75 waves-effect">Видалити--}}
{{--                        </button>--}}
{{--                        <p class="mb-0">Формати JPG, GIF або PNG</p>--}}
{{--                        <p class="mb-0">Розмір не більше 800kB </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!--/ upload and reset button -->--}}
{{--            </div>--}}
{{--            <!--/ header section -->--}}
{{--            <div class="mt-2 pt-50">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="accountLastName">Прізвище</label>--}}
{{--                        <input type="text" class="form-control" id="accountLastName" name="surname"--}}
{{--                               placeholder="Вкажіть ваше прізвище" value="{{$user->surname}}" required--}}
{{--                               data-msg="Please enter last name">--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="accountFirstName">Ім’я</label>--}}
{{--                        <input type="text" class="form-control" id="accountFirstName" name="name"--}}
{{--                               value="{{$user->name}}" required placeholder="Вкажіть ваше ім’я"--}}
{{--                               data-msg="Please enter first name">--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="accountPatronymic">По батькові</label>--}}
{{--                        <input type="text" class="form-control" id="patronymic" name="patronymic"--}}
{{--                               value="{{$user->patronymic}}" required placeholder="Вкажіть ваше ім’я по батькові"--}}
{{--                               data-msg="Please enter patronymic">--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="fp-default">Дата народження</label>--}}
{{--                        <input type="text" id="fp-default" class="form-control flatpickr-basic flatpickr-input"--}}
{{--                               value="{{$user->birthday}}" required placeholder="РРРР-ММ-ДД" name="birthday"--}}
{{--                               readonly="readonly">--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="accountEmail">Адреса електронної пошти</label>--}}
{{--                        <input type="email" class="form-control" id="accountEmail" name="email" required--}}
{{--                               value="{{$user->email}}" placeholder="example@gmail.com">--}}
{{--                    </div>--}}

{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="accountPhoneNumber">Номер телефону</label>--}}
{{--                        <input id="phone" type="tel" required class="form-control account-number-mask" name="phone"--}}
{{--                               value="{{$user->phone}}" placeholder="+380666666666">--}}
{{--                    </div>--}}
{{--                    <div id="private-data-message"></div>--}}

{{--                    <div class="col-12">--}}
{{--                        <div class="float-end">--}}
{{--                            <button type="button" id="private-data"--}}
{{--                                    class="btn btn-green mt-1 waves-effect waves-float waves-light">--}}
{{--                                Зберегти--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!--/ form -->--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="card mx-2 mt-3">--}}
{{--        <div class="card-header">--}}
{{--            <h4 class="card-title">Робочі дані</h4>--}}
{{--        </div>--}}
{{--        <form autocomplete="off">--}}
{{--            <div class="card-body my-25">--}}
{{--                <div class="row">--}}

{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="select2-hide-search">Посада/Роль</label>--}}
{{--                        <select class="select2 hide-search form-select" id="position"--}}
{{--                                data-placeholder="Виберіть посаду / роль">--}}
{{--                            <option value=""></option>--}}
{{--                            @foreach($positions as $position)--}}
{{--                                <option value="{{$position->key}}" {{$user->position_id === $position->id ? 'selected' : ''}}>--}}
{{--                                    {{$position->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="select2-hide-search">Підрозділ</label>--}}
{{--                        <select class="select2 hide-search form-select" id="unit" data-placeholder="Виберіть підрозділ">--}}
{{--                            <option value=""></option>--}}
{{--                            @foreach($units as $unit)--}}
{{--                                <option value="{{$unit->id}}" {{$user->unit_id === $unit->id ? 'selected' : ''}}>{{$unit->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="select2-hide-search">Бригада</label>--}}
{{--                        <select class="select2 hide-search form-select" id="brigade"--}}
{{--                                data-placeholder="Виберіть бригаду">--}}
{{--                            <option value=""></option>--}}
{{--                            @foreach($brigades as $brigade)--}}
{{--                                <option value="{{$brigade->id}}" {{$user->brigade_id === $position->id ? 'selected' : ''}}>--}}
{{--                                    {{$brigade->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="col-12 col-sm-4 mb-1">--}}
{{--                        <label class="form-label" for="code">Код користувача</label>--}}
{{--                        <input type="text" class="form-control" value="{{$user->key_pass_card}}" id="code" name="code" required--}}
{{--                               placeholder="XXXXXXXXXXXXXXXX">--}}
{{--                    </div>--}}

{{--                    <div class="col-8">--}}
{{--                        <button type="button" style="box-shadow: none" id="generate-code"--}}
{{--                                class="btn generate-code-button me-1">--}}
{{--                            Згенерувати новий код--}}
{{--                        </button>--}}
{{--                    </div>--}}

{{--                    <div class="row" id="driver_block" style="{{$user->position->key ==='driver' ? '' : 'display: none'}}">--}}
{{--                        <div style="width: 34%" class="mb-1">--}}
{{--                            <label class="form-label" for="driving_license_number">Номер посвідчення водія</label>--}}
{{--                            <input type="text" class="form-control" id="driving_license_number" placeholder="ААА000000"--}}
{{--                                   value="{{$user->driving_license_number}}" data-msg="Please enter">--}}
{{--                        </div>--}}

{{--                        <div style="width: 34%" class="mb-1">--}}
{{--                            <label for="driving_license" class="form-label">Завантажити посвідчення водія</label>--}}
{{--                            <input class="form-control" data-buttonText="Вибрати файл" type="file"--}}
{{--                                  id="driving_license"/>--}}
{{--                        </div>--}}

{{--                        <div class="col-12 col-sm-3 mb-1 ">--}}
{{--                        </div>--}}

{{--                        <div style="width: 34%" class="mb-1">--}}
{{--                            <label class="form-label" for="health_book_number">Номер особової медичної книжки</label>--}}
{{--                            <input type="text" class="form-control" placeholder="000000" id="health_book_number"--}}
{{--                                   style="text-transform: uppercase" value="{{$user->health_book_number}}"--}}
{{--                                   data-msg="Please enter">--}}
{{--                        </div>--}}

{{--                        <div style="width: 34%" class="mb-1">--}}
{{--                            <label for="health_book" class="form-label">Завантажити санітарну книжку</label>--}}
{{--                            <input class="form-control"--}}
{{--                            data-buttonText="Вибрати файл" type="file" id="health_book"/>--}}
{{--                        </div>--}}

{{--                        <div class="col-12 col-sm-3 mb-1 ">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="work-data-message"></div>--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="float-end">--}}
{{--                            <button type="button" id="working_data" class="btn btn-green mt-1 waves-effect waves-float waves-light">--}}
{{--                                Зберегти--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

{{--    <div class="card mx-2 mt-3">--}}
{{--        <div class="card-header">--}}
{{--            <h4 class="card-title">Зміна паролю</h4>--}}
{{--        </div>--}}


{{--        <div class="card-body my-25">--}}


{{--            <div class="row">--}}

{{--                <div class="col-12 col-sm-12 mb-1 row">--}}

{{--                    <div class="col-4">--}}
{{--                        <label class="form-label" for="passwordEmail">Логін</label>--}}
{{--                        <input type="email" class="form-control" id="passwordEmail" name="email"--}}
{{--                               placeholder="Введіть ваш логін користувача" required>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-12 col-sm-4 mb-1">--}}

{{--                    <label class="form-label">Старий пароль</label>--}}
{{--                    <div class="input-group form-password-toggle input-group-merge">--}}
{{--                        <input type="password" class="form-control" required name="password" autocomplete="off"--}}
{{--                               placeholder="Введіть ваш старий пароль">--}}
{{--                        <div class="input-group-text cursor-pointer">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"--}}
{{--                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                                 stroke-linejoin="round" class="feather feather-eye">--}}
{{--                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>--}}
{{--                                <circle cx="12" cy="12" r="3"></circle>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-12 col-sm-4 mb-1">--}}
{{--                    <label class="form-label">Новий пароль</label>--}}
{{--                    <div class="input-group form-password-toggle input-group-merge">--}}
{{--                        <input type="password" class="form-control" name="new_password"--}}
{{--                               placeholder="Придумайте новий пароль" required autocomplete="off">--}}
{{--                        <div class="input-group-text cursor-pointer">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"--}}
{{--                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                                 stroke-linejoin="round" class="feather feather-eye">--}}
{{--                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>--}}
{{--                                <circle cx="12" cy="12" r="3"></circle>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-12 col-sm-4 mb-1">--}}
{{--                    <label class="form-label">Повторіть новий пароль</label>--}}
{{--                    <div class="input-group form-password-toggle input-group-merge">--}}
{{--                        <input type="password" class="form-control" required name="confirm_password"--}}
{{--                               placeholder="Повторіть новий пароль" autocomplete="off">--}}
{{--                        <div class="input-group-text cursor-pointer">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"--}}
{{--                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                                 stroke-linejoin="round" class="feather feather-eye">--}}
{{--                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>--}}
{{--                                <circle cx="12" cy="12" r="3"></circle>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div id="change-password-message"></div>--}}

{{--                <div class="col-12">--}}
{{--                    <div class="float-end">--}}
{{--                        <button type="button" id="change-password"--}}
{{--                                class="btn btn-green mt-1 waves-effect waves-float waves-light">--}}
{{--                            Зберегти--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="card mx-2 mt-3 mb-5">--}}
{{--        <div class="card-header">--}}
{{--            <h4 class="card-title">Зміна пінкоду (планшет)</h4>--}}
{{--        </div>--}}
{{--        <div class="card-body my-25">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12 col-sm-12 mb-1 row">--}}
{{--                    <div class="col-4">--}}
{{--                        <label class="form-label" for="pinEmail">Логін</label>--}}
{{--                        <input type="email" class="form-control" id="pinEmail" name="email"--}}
{{--                               placeholder="Введіть ваш логін користувача" required>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-12 col-sm-4 mb-1">--}}

{{--                    <label class="form-label">Старий пінкод</label>--}}
{{--                    <div class="input-group form-password-toggle input-group-merge">--}}
{{--                        <input type="password" class="form-control" required name="pin" autocomplete="off"--}}
{{--                               placeholder="Введіть ваш старий пінкод">--}}
{{--                        <div class="input-group-text cursor-pointer">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"--}}
{{--                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                                 stroke-linejoin="round" class="feather feather-eye">--}}
{{--                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>--}}
{{--                                <circle cx="12" cy="12" r="3"></circle>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-12 col-sm-4 mb-1">--}}
{{--                    <label class="form-label">Новий пінкод</label>--}}
{{--                    <div class="input-group form-password-toggle input-group-merge">--}}
{{--                        <input type="password" class="form-control" required name="new_pin" autocomplete="off"--}}
{{--                               placeholder="Придумайте новий пінкод">--}}
{{--                        <div class="input-group-text cursor-pointer">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"--}}
{{--                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                                 stroke-linejoin="round" class="feather feather-eye">--}}
{{--                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>--}}
{{--                                <circle cx="12" cy="12" r="3"></circle>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-12 col-sm-4 mb-1">--}}
{{--                    <label class="form-label">Повторіть новий пінкод</label>--}}
{{--                    <div class="input-group form-password-toggle input-group-merge">--}}
{{--                        <input type="password" class="form-control" required name="confirm_pin"--}}
{{--                               placeholder="Повторіть новий пінкод" autocomplete="off">--}}
{{--                        <div class="input-group-text cursor-pointer">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"--}}
{{--                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                                 stroke-linejoin="round" class="feather feather-eye">--}}
{{--                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>--}}
{{--                                <circle cx="12" cy="12" r="3"></circle>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="change-pin-message"></div>--}}
{{--                <div class="col-12">--}}
{{--                    <div class="float-end">--}}
{{--                        <button id="change-pin" type="button"--}}
{{--                                class="btn btn-green mt-1 waves-effect waves-float waves-light">--}}
{{--                            Зберегти--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <input hidden="" id="need_file" value="true">--}}
{{--@endsection--}}
{{--@section('page-script')--}}
{{--    <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        var user_id =  {!! $user->id !!}--}}

{{--        window.onload = () => {--}}
{{--            flatpickr('#fp-default')--}}
{{--            $("#phone").mask("+380999999999");--}}

{{--            @if($user->position->key === 'driver')--}}

{{--            const fileInput = document.querySelector('#health_book');--}}

{{--            const myFile = new File([''], '{!! $user->surname.'_'.$user->name.'.'.$user->health_book_doctype !!}', {--}}
{{--                type: 'text/plain',--}}
{{--                lastModified: new Date(),--}}
{{--            });--}}

{{--            const dataTransfer = new DataTransfer();--}}
{{--            dataTransfer.items.add(myFile);--}}
{{--            fileInput.files = dataTransfer.files;--}}

{{--            const fileInput2 = document.querySelector('#driving_license');--}}

{{--            const myFile2 = new File([''], '{!! $user->surname.'_'.$user->name.'.'.$user->driving_license_doctype !!}', {--}}
{{--                type: 'text/plain',--}}
{{--                lastModified: new Date(),--}}
{{--            });--}}

{{--            const dataTransfer2 = new DataTransfer();--}}
{{--            dataTransfer2.items.add(myFile2);--}}
{{--            fileInput2.files = dataTransfer2.files;--}}

{{--            $('#need_file').val('false')--}}
{{--            @endif--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script src="{{asset('assets/js/account.settings.js')}}"></script>--}}
{{--@endsection--}}
