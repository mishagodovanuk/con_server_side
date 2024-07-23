@extends('layouts.admin')
@section('title','Створення користувача')
@section('page-style')
    <script src="{{asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js'))}}"></script>


    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">
@endsection
@section('content')
    <div class="px-2">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a class="link-secondary" href="/">Користувачі</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Додавання нового користувача
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mx-0">
            <div class="col-12 col-sm-2 col-lg-2 col-xl-2 col-xxl-2 previous-step p-0">
                <div class="previous-step-title" style="display: none"><img style="margin-right: 0.5rem"
                                                                            src="{{asset('assets/icons/arrow-left.svg')}}">
                    Попередній крок
                </div>
            </div>
            <div
                class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 flex-column flex-lg-row d-flex align-items-center align-items-lg-start align-self-center justify-content-center"
                style="padding: 0">
                <label class="offset-0 offset-lg-1 create-user-step ms-0 ms-lg-2">1</label>
                <div class="align-self-center step-title">Основні дані</div>

                <div class="align-self-center text-center"><img src="{{asset('assets/icons/chevron-right.svg')}}">
                </div>

                <label class="create-user-step user-step-disabled ms-0 ms-lg-2">2</label>
                <div class="align-self-center step-title">Робочі дані</div>

                <div class="align-self-center text-center"><img src="{{asset('assets/icons/chevron-right.svg')}}">
                </div>

                <label class="create-user-step user-step-disabled ms-0 ms-lg-2">3</label>
                <div class="align-self-center step-title">Графік роботи</div>

            </div>

            <div class="col-12 col-sm-2 col-lg-2 col-xl-2 col-xxl-2 p-0 mt-1 mt-sm-0">
                <button class="btn btn-green float-end" id="create_user" style="display: none;">
                    Додати користувача
                </button>
                <button class="btn btn-green float-end d-flex align-items-center gap-50" id="next_step">Наступний
                    крок <img src="{{asset('assets/icons/arrow-right.svg')}}">
                </button>
            </div>
        </div>

        <div id="block_1" class=" row mx-0 px-0">
            <div class="card col-12 px-0">
                <div class="card-header px-2">
                    <h4 class="card-title fw-bolder">Особисті дані</h4>
                </div>
                <div class="card-body my-25 p-50">
                    <!-- header section -->
                    <div class="d-flex p-1">
                        <a id="account-upload-img-btn" type="button" href="#" class="me-25">
                            <img src="{{ $user && $user->avatar_type ? asset('file/uploads/user/avatars/'.$user->id.'.'.$user->avatar_type)
            : asset('assets/images/avatar_empty.png')  }}" id="account-upload-img"
                                 class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">
                        </a>
                        <!-- upload and reset button -->
                        <div class="d-flex align-items-end mb-1 ms-1">
                            <div>
                                <label for="account-upload"
                                       {{$user ? 'style=color:var(--bs-btn-disabled-color);pointer-events:none;background-color:var(--bs-btn-disabled-bg);border-color:var(--bs-btn-disabled-border-color);opacity:var(--bs-btn-disabled-opacity);' : ''}}
                                       class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                                <input type="file" id="account-upload" name="avatar" hidden=""
                                       {{$user ? 'disabled' : ''}}
                                       accept="image/jpeg, image/png, image/gif">
                                <button type="submit" id="account-reset"
                                        class="btn btn-sm btn-outline-secondary mb-75 waves-effect" {{$user ? 'disabled' : ''}}>
                                    Видалити
                                </button>
                                <p class="mb-0 text-secondary">Формати JPG, GIF або PNG</p>
                                <p class="mb-0 text-secondary">Розмір не більше 800kB </p>
                            </div>
                        </div>
                        <!--/ upload and reset button -->
                    </div>
                    <!--/ header section -->
                    <div class="mt-2 pt-50">
                        <input hidden value="{{$user ? 0 : 1}}" id="new_user" name="new_user">
                        <div class="row mx-0">
                            <div class="col-12 col-md-6 col-lg-6 mb-1">
                                <label class="form-label" for="accountLastName">Прізвище</label>
                                <input type="text" class="form-control" id="accountLastName" name="surname"
                                       placeholder="Вкажіть ваше прізвище" value="{{$user ? $user->surname : ''}}"
                                       {{$user ? 'disabled' : ''}} required data-msg="Please enter last name">
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mb-1">
                                <label class="form-label" for="accountFirstName">Ім’я</label>
                                <input type="text" class="form-control" value="{{$user ? $user->name : ''}}"
                                       {{$user ? 'disabled' : ''}}  id="accountFirstName" name="name" required
                                       placeholder="Вкажіть ваше ім’я" data-msg="Please enter first name">
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mb-1">
                                <label class="form-label" for="accountPatronymic">По батькові</label>
                                <input type="text" class="form-control" value="{{$user ? $user->patronymic : ''}}"
                                       {{$user ? 'disabled' : ''}}  id="accountPatronymic" name="patronymic"
                                       required
                                       placeholder="Вкажіть ваше ім’я по батькові" data-msg="Please enter patronymic">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-1 position-relative">
                                <label class="form-label" for="birthday">Дата народження</label>
                                <input type="text" id="birthday"
                                       class="form-control flatpickr-basic flatpickr-input validateDateInput"
                                       {{$user ? 'style=background-color:#efefef;' : ''}}
                                       required placeholder="РРРР-ММ-ДД" value="{{$user ? $user->birthday : ''}}"
                                       {{$user && $user->birthday ? 'disabled' : ''}}  name="birthday"
                                       oninput="validateDate(this,18)">
                                <span class="cursor-pointer text-secondary position-absolute top-50"
                                      style="right : 27px;pointer-events: none;"><i data-feather="calendar"></i></span>
                            </div>


                            <div class="col-12 col-md-6 col-lg-6 mb-1">
                                <label class="form-label" for="accountEmail">Адреса електронної пошти</label>
                                <input type="email" class="form-control" id="accountEmail" name="email" required
                                       autocomplete="disable-autocomplete" value="{{array_key_exists('email',$_GET) ? $_GET['email']
                                        : ($user ? $user->email : '') }}"
                                       {{$user ? 'disabled' : ''}}  placeholder="example@gmail.com">

                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-1">
                                <label class="form-label" for="phone">Номер телефону</label>
                                <input id="phone" type="tel" required class="form-control"
                                       name="phone" value="{{array_key_exists('phone',$_GET) ? $_GET['phone']
                                        : ($user ? $user->phone : '') }}" {{$user ? 'disabled' : ''}}
                                       placeholder="+380666666666" oninput="limitInputToNumbersWithPlus(this,13)">
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-1">
                                <label class="form-label" for="select2-hide-search">Стать</label>
                                <select class="select2 hide-search form-select" id="sex" {{$user ? 'disabled' : ''}}
                                data-placeholder="Оберіть стать">
                                    <option value=""></option>
                                    <option {{$user ? (!$user->sex ? 'selected' : '') : '' }} value="0">Чоловік</option>
                                    <option {{$user ? ($user->sex ? 'selected' : '') : '' }}  value="1">Жінка</option>
                                </select>
                            </div>

                            <div class="row mx-0 col-12 col-md-6 mb-1">
                                <div class="col-12 p-0 col-md-8">
                                    <label class="form-label">Тимчасовий пароль</label>
                                    <div class="input-group form-password-toggle input-group-merge">
                                        <input {{$user ? 'disabled': ''}} type="password" class="form-control" required
                                               id="password"
                                               name="password"
                                               autocomplete="no-autocomplete_"
                                               placeholder="Придумайте тимчасовий пароль">
                                        <div class="input-group-text cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                 viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round" class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="col-12 flex-grow-1 col-md-4 ps-0 ps-md-1 mt-1 mt-md-0 pe-0 d-flex align-items-end">
                                    <button {{$user ? 'disabled': ''}} id="generate-password"
                                            class="btn btn-outline-primary w-100">Згенерувати
                                        пароль
                                    </button>
                                </div>

                            </div>

                            <div class="mt-1" id="private-data-message"></div>

                        </div>
                    </div>
                    <!--/ form -->
                </div>
            </div>
        </div>

        <div id="block_2" style="display: none" class="row mx-0 px-0">
            <div class="card  col-12 px-0">
                <div class="card-header">
                    <h4 class="card-title fw-bolder">Робочі дані</h4>
                </div>
                <div class="card-body my-25 pb-0">
                    <div class="row">


                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Компанія</label>
                            <select class="select2 hide-search form-select" id="company" data-dictionary="company"
                                    data-placeholder="Оберіть компанію, до якої належить користувач">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Роль в системі</label>
                            <select class="select2 hide-search form-select" id="role"
                                    data-placeholder="Оберіть роль">
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Посада в компанії</label>
                            <select class="select2 hide-search form-select" id="position"
                                    data-placeholder="Оберіть посаду">
                                <option value=""></option>
                                @foreach($positions as $position)
                                    <option value="{{$position->key}}">{{$position->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="row mx-0 px-0" id="driver_block" style="display: none">
                            <div class="col-12 col-md-3 mb-1">
                                <label class="form-label" for="driving_license_number">Номер посвідчення водія</label>
                                <input type="text" class="form-control" id="driving_license_number"
                                       oninput="validateDriverLicense(this,9)"
                                       placeholder="ААА000000"
                                       data-msg="Please enter">
                            </div>

                            <div class="col-12 col-md-3 mb-1 position-relative">
                                <label class="form-label" for="driving_license_number_term">Термін дії водійського
                                    посвідчення</label>
                                <input type="text" class="form-control flatpickr-basic flatpickr-input"
                                       required placeholder="РРРР.ММ.ДД" name="driving_license_number_term"
                                       readonly="readonly"
                                       id="driving_license_number_term"
                                > <span class="cursor-pointer text-secondary position-absolute top-50"
                                        style="right : 27px;pointer-events: none;"><i
                                        data-feather="calendar"></i></span>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label for="driving_license" class="form-label">Завантажити посвідчення водія</label>
                                <input class="form-control" data-buttonText="Вибрати файл" type="file"
                                       id="driving_license"/>
                            </div>


                            <div class="col-12 col-md-3 mb-1">
                                <label class="form-label" for="health_book_number">Номер особової медичної
                                    книжки</label>
                                <input type="text" class="form-control" placeholder="000000" id="health_book_number"
                                       style="text-transform: uppercase"
                                       data-msg="Please enter">
                            </div>

                            <div class="col-12 col-md-3 mb-1 position-relative">
                                <label class="form-label" for="health_book_number_term">Термін дії особової медичної
                                    книжки</label>
                                <input type="text" id="health_book_number_term"
                                       class="form-control flatpickr-basic flatpickr-input"
                                       required placeholder="РРРР.ММ.ДД" name="health_book_number_term"
                                       readonly="readonly"
                                > <span class="cursor-pointer text-secondary position-absolute top-50"
                                        style="right : 27px;pointer-events: none;"><i
                                        data-feather="calendar"></i></span>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label for="health_book" class="form-label">Завантажити санітарну книжку</label>
                                <input class="form-control" data-buttonText="Вибрати файл" type="file"
                                       id="health_book"/>
                            </div>

                            <div class="col-12 col-sm-3 mb-1 ">
                            </div>
                        </div>
                        <div id="work-data-message"></div>
                    </div>
                </div>
            </div>

        </div>

        <div id="block_3" style="display: none" class="row mx-0 p-0">
            <div class="card p-0 mt-2">
                <div class="card-header p-2 pt-3 ps-3 row mx-0">
                    <div class=" d-flex justify-content-between align-items-center px-0">
                        <h4 class="card-title col-9 fw-semibold">Графік роботи</h4>
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
                                                <div>
                                                    <input type="text" id="Friday-2"
                                                           class="form-control flatpickr-time text-start"
                                                           placeholder="00:00" value="18:00"/>
                                                </div>
                                            </div>

                                            <div class="d-flex two-input-for-schedule ">
                                                <div>
                                                    <input type="text" id="Saturday-1"
                                                           class="form-control flatpickr-time text-start"
                                                           placeholder="00:00"/>
                                                </div>
                                                <img class="align-self-center" style="padding: 0 12px"
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
                                                <div>
                                                    <input type="text" id="Saturday-2"
                                                           class="form-control flatpickr-time text-start"
                                                           placeholder="00:00"/>
                                                </div>
                                            </div>

                                            <div class="d-flex  two-input-for-schedule">
                                                <div class="d-flex">
                                                    <input type="text" id="Sunday-1"
                                                           class="form-control flatpickr-time text-start"
                                                           placeholder="00:00"/>
                                                </div>
                                                <img class="align-self-center" style="padding: 0 12px"
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
                                                <div>
                                                    <input type="text" id="Friday-4"
                                                           class="form-control flatpickr-time text-start"
                                                           placeholder="00:00" value="14:00"/>
                                                </div>
                                            </div>

                                            <div class="d-flex  two-input-for-schedule">
                                                <div>
                                                    <input type="text" id="Saturday-3"
                                                           class="form-control flatpickr-time text-start"
                                                           placeholder="00:00"/>
                                                </div>
                                                <img class="align-self-center" style="padding: 0 12px"
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                            data-bs-target="#animation">Додати
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
                                            <option data-id="{{$exception->id}}"
                                                    value="{{$exception->name}}">{{$exception->name}}</option>
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
                                <img class="align-self-center" style="width: 45px;height: 2px"
                                     src="{{asset('assets/icons/line-schedule.svg')}}">
                                <div style="width: 45%;padding-left: 0">
                                    <input type="text" id="date-2"
                                           class="form-control date-2 flatpickr-basic flatpickr-input" required
                                           placeholder="РРРР-ММ-ДД" readonly="readonly">
                                </div>
                            </div>
                            <div id="work-schedule">
                                <p class="f-15 fw-bold mt-1 mb-1">Робочий день</p>
                                <div class="col-12 d-flex two-input-for-schedule-inmodal">
                                    <div style="width: 45%;padding-right: 0">
                                        <input type="text" id="work_from" class="form-control flatpickr-time text-start"
                                               placeholder="00:00"/>
                                    </div>
                                    <img class="align-self-center" style="width: 45px;height: 2px"
                                         src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                    <img class="align-self-center" style="width: 45px;height: 2px"
                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                    <div style="width: 45%;padding-left: 0">
                                        <input type="text" id="break_to" class="form-control flatpickr-time text-start"
                                               placeholder="00:00"/>
                                    </div>
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
                                        @foreach($exceptions as $exception)
                                            <option data-id="{{$exception->id}}"
                                                    value="{{$exception->name}}">{{$exception->name}}</option>
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
                                <img class="align-self-center" style="width: 45px;height: 2px"
                                     src="{{asset('assets/icons/line-schedule.svg')}}">
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
                                    <img class="align-self-center" style="width: 45px;height: 2px"
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
                                    <img class="align-self-center" style="width: 45px;height: 2px"
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
@endsection
@section('page-script')
    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/entity/user/create-user.js')}}"></script>

    <script src="{{asset('vendors/js/forms/cleave/cleave.min.js')}}"></script>
    <script src="{{asset('vendors/js/forms/cleave/addons/cleave-phone.us.js')}}"></script>
    <script src="{{asset('js/scripts/forms/form-input-mask.js')}}"></script>

    <script>
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
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementsByClassName('validateDateInput')[0];
            const dateInputTwo = document.getElementsByClassName('validateDateInput')[1];
            const minAge = 18;

            validateDate(dateInput, minAge);
            validateDate(dateInputTwo, minAge);
        });
    </script>

@endsection
