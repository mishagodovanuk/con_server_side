@extends('layouts.admin')
@section('title','Редагування користувача')
@section('page-style')

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

    {{--    Лоадер для табів --}}
    <script src="{{asset('assets/js/utils/loader-for-tabs.js')}}"></script>

@endsection
@section('content')

    <div id="jqxLoader"></div>

    <div class="px-2">

        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item">
                            <a class="link-secondary" href="/">Користувачі</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-secondary"
                               href="{{"/user/show/".$user->id}}">Перегляд {{$user->surname.' '.$user->name.' '.$user->patronymic}} </a>
                        </li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Редагування профілю користувача
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">
                <button data-bs-toggle="modal" id="cancel_button" data-bs-target="#cancel_edit_user" type="submit"
                        class="btn btn-flat-secondary">
                    Скасувати
                </button>

                <button type="button" id="save" class="btn btn-green">
                    Зберегти
                </button>
            </div>
        </div>

        <div id="tabs" class="tabs-user invisible">
            <ul class="d-flex ">
                <li>Особисті дані</li>
                <li>Робочі дані</li>
                <li>Графік роботи</li>
            </ul>
            <div>
                <div class="card-body my-25">
                    <!-- header section -->
                    <div class="d-flex p-2">
                        <a href="#" class="me-25">
                            <img src="{{ $user->avatar_type ? '/file/uploads/user/avatars/'.$user->id.'.'.$user->avatar_type
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
                                        class="btn btn-sm btn-outline-secondary text-secondary mb-75 waves-effect">
                                    Видалити
                                </button>
                                <p class="mb-0 text-secondary">Формати JPG, GIF або PNG</p>
                                <p class="mb-0 text-secondary">Розмір не більше 800kB </p>
                            </div>
                        </div>
                        <!--/ upload and reset button -->

                    </div>

                    <!--/ header section -->
                    <div class="px-75 pb-2">
                        <div class="row mx-0">
                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="accountLastName">Прізвище</label>
                                <input {{$user->id == Auth::id() ? '' : 'disabled'}} type="text" class="form-control"
                                       id="accountLastName" name="surname"
                                       placeholder="Вкажіть ваше прізвище" value="{{$user->surname}}" required
                                       data-msg="Please enter last name">
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="accountFirstName">Ім’я</label>
                                <input {{$user->id == Auth::id() ? '' : 'disabled'}} type="text" class="form-control"
                                       id="accountFirstName" name="name"
                                       value="{{$user->name}}" required placeholder="Вкажіть ваше ім’я"
                                       data-msg="Please enter first name">
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="accountPatronymic">По батькові</label>
                                <input {{$user->id == Auth::id() ? '' : 'disabled'}} type="text" class="form-control"
                                       id="patronymic" name="patronymic"
                                       value="{{$user->patronymic}}" required
                                       placeholder="Вкажіть ваше ім’я по батькові"
                                       data-msg="Please enter patronymic">
                            </div>

                            <div class="col-12 col-md-6 mb-1 position-relative">
                                <label class="form-label" for="fp-default">Дата народження</label>
                                <input {{$user->id == Auth::id() ? '' : 'disabled'}} type="text" id="birthday"
                                       {{$user->id != Auth::id() ? 'style=background-color:#efefef;' : ''}}
                                       class="form-control flatpickr-basic flatpickr-input validateDateInput"
                                       value="{{$user->birthday}}" required placeholder="РРРР-ММ-ДД" name="birthday"
                                       readonly="readonly" oninput="validateDate(this,18)">
                                <span class="cursor-pointer text-secondary position-absolute top-50"
                                      style="right : 27px;pointer-events: none;"><i
                                        data-feather="calendar"></i></span>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="accountEmail">Адреса електронної пошти</label>
                                <input {{$user->id == Auth::id() ? '' : 'disabled'}} type="email" class="form-control"
                                       id="accountEmail" name="email" required
                                       value="{{$user->email}}" placeholder="example@gmail.com">
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="phone">Номер телефону</label>
                                <input {{$user->id == Auth::id() ? '' : 'disabled'}} id="phone" type="tel" required
                                       class="form-control"
                                       name="phone"
                                       value="{{$user->phone}}" placeholder="+380666666666"
                                       oninput="limitInputToNumbersWithPlus(this,13)">
                            </div>

                            <div id="private-data-message"></div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="sex select2-hide-search">Стать</label>
                                <select {{$user->id == Auth::id() ? '' : 'disabled'}} class="select2 form-select"
                                        id="sex"
                                        data-placeholder="Оберіть стать">
                                    <option value=""></option>
                                    <option {{$user ? (!$user->sex ? 'selected' : '') : '' }} value="0">Чоловік</option>
                                    <option {{$user ? ($user->sex ? 'selected' : '') : '' }}  value="1">Жінка</option>
                                </select>
                            </div>

                            <div class="row mx-0 col-12 col-md-6 mb-1">
                                <!-- <div class="col-12 p-0 col-md-8">
                                    <label class="form-label">Старий пароль</label>
                                    <div class="input-group form-password-toggle input-group-merge">
                                        <input type="password" class="form-control" required name="password"
                                               autocomplete="off"
                                               placeholder="Введіть ваш старий пароль">
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
                                </div> -->
                                <div
                                    class="col-12 flex-grow-1 col-md-4 ps-0 mt-1 mt-md-0 pe-0 d-flex align-items-end">
                                    <button data-bs-toggle="modal" id="cancel_button"
                                            data-bs-target="#edit_user_pass"
                                            type="submit"
                                            class="w-100 btn btn-outline-primary ">
                                        Змінити пароль
                                    </button>
                                </div>
                            </div>

                            <div id="change-password-message"></div>
                            <div class="alert-data-message"></div>

                            <div class="modal text-start" id="edit_user_pass" tabindex="-1"
                                 aria-labelledby="myModalLabel6" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                                    <div class="modal-content">
                                        <div class="card popup-card p-4">
                                            <h2 class="fw-bolder text-center">
                                                Змінити пароль
                                            </h2>
                                            <div class="card-body row mx-0 p-0">
                                                <div class="col-12 mb-1">

                                                    <label class="form-label">Старий пароль</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="password" class="form-control" required
                                                               name="password" id="old-password"
                                                               autocomplete="off"
                                                               placeholder="Введіть ваш старий пароль">
                                                        <div class="input-group-text cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                 height="14"
                                                                 viewBox="0 0 24 24"
                                                                 fill="none" stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round"
                                                                 stroke-linejoin="round"
                                                                 class="feather feather-eye">
                                                                <path
                                                                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12  mb-1">
                                                    <label class="form-label">Новий пароль</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="password" class="form-control"
                                                               name="new_password"
                                                               placeholder="Придумайте новий пароль" required
                                                               autocomplete="off">
                                                        <div class="input-group-text cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                 height="14"
                                                                 viewBox="0 0 24 24"
                                                                 fill="none" stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round"
                                                                 stroke-linejoin="round"
                                                                 class="feather feather-eye">
                                                                <path
                                                                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-1">
                                                    <label class="form-label">Повторіть новий пароль</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="password" class="form-control" required
                                                               name="confirm_password"
                                                               placeholder="Повторіть новий пароль"
                                                               autocomplete="off">
                                                        <div class="input-group-text cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                 height="14"
                                                                 viewBox="0 0 24 24"
                                                                 fill="none" stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round"
                                                                 stroke-linejoin="round"
                                                                 class="feather feather-eye">
                                                                <path
                                                                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="change-password-message"></div>

                                                <div class="col-12 mt-1">
                                                    <div class="d-flex float-end">
                                                        <button type="button" class="btn btn-link cancel-btn"
                                                                data-dismiss="modal">Скасувати
                                                        </button>
                                                        <button type="button" id="change-password"
                                                                class="btn btn-primary"
                                                        >Змінити пароль
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


                    <!--/ form -->
                </div>
            </div>
            <div class="p-2">
                <form autocomplete="off">
                    <div class="card-body my-25">
                        <div class="row mx-0">

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="select2-hide-search">Компанія</label>
                                <select class="select2 hide-search form-select" id="company_id"
                                        data-id="{{$user->company_id}}" data-dictionary="company"
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
                                        <option
                                            value="{{$role->name}}"
                                            {{$user->workingData->role[0]->id === $role->id ? 'selected' : ''}}>
                                            {{$role->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-1">
                                <label class="form-label" for="select2-hide-search">Посада в компанії</label>
                                <select class="select2 hide-search form-select" id="position"
                                        data-placeholder="Оберіть посаду">
                                    <option value=""></option>
                                    @foreach($positions as $position)
                                        <option
                                            value="{{$position->key}}" {{$user->position_id === $position->id ? 'selected' : ''}}>
                                            {{$position->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <hr class="my-1">
                            <div class="row mx-0 p-0" id="driver_block"
                                 style="{{$user->workingData->position && $user->workingData->position->key ==='driver' ? '' : 'display:none'}}">
                                <div class="col-12 col-md-3 mb-1">
                                    <label class="form-label" for="driving_license_number">Номер посвідчення
                                        водія</label>
                                    <input type="text" class="form-control" id="driving_license_number"
                                           placeholder="ААА000000" oninput="validateDriverLicense(this,9)"

                                           value="{{$user->driving_license_number}}" data-msg="Please enter">
                                </div>

                                <div class="col-12 col-md-3 mb-1 position-relative">
                                    <label class="form-label" for="driver_license_date">Термін дії
                                        водійського
                                        посвідчення</label>
                                    <input type="text" class="form-control flatpickr-basic flatpickr-input"
                                           required placeholder="РРРР.ММ.ДД" readonly="readonly"
                                           id="driver_license_date" value="{{$user->workingData->driver_license_date}}"

                                    > <span class="cursor-pointer text-secondary position-absolute top-50"
                                            style="right : 27px;pointer-events: none;"><i
                                            data-feather="calendar"></i></span>
                                </div>


                                <div class="col-12 col-md-6 mb-1">
                                    <label for="driving_license" class="form-label">Завантажити посвідчення
                                        водія</label>
                                    <input class="form-control" data-buttonText="Вибрати файл" type="file"
                                           id="driving_license"/>
                                </div>

                                <div class="col-12 col-md-3 mb-1">
                                    <label class="form-label" for="health_book_number">Номер особової медичної
                                        книжки</label>
                                    <input type="text" class="form-control" placeholder="000000"
                                           id="health_book_number"
                                           style="text-transform: uppercase" value="{{$user->health_book_number}}"
                                           data-msg="Please enter">
                                </div>

                                <div class="col-12 col-md-3 mb-1  position-relative">
                                    <label class="form-label" for="health_book_date">Термін дії особової
                                        медичної
                                        книжки</label>
                                    <input type="text" class="form-control flatpickr-basic flatpickr-input"
                                           required placeholder="РРРР.ММ.ДД" readonly="readonly"
                                           id="health_book_date" value="{{$user->workingData->health_book_date}}"
                                    > <span class="cursor-pointer text-secondary position-absolute top-50"
                                            style="right : 27px;pointer-events: none;"><i
                                            data-feather="calendar"></i></span>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label for="health_book" class="form-label">Завантажити санітарну книжку</label>
                                    <input class="form-control"
                                           data-buttonText="Вибрати файл" type="file" id="health_book"/>
                                </div>


                            </div>

                            <div id="work-data-message"></div>
                            <div class="alert-data-message"></div>

                        </div>

                    </div>
                </form>

                <input hidden="" id="need_file" value="true">
            </div>
            <div>
                <div class="row mx-0">
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


                                    @if(count($user->workingData->schedule))
                                        <div class="col-9 col-sm-10 col-md-10 col-lg-4 flex-grow-1">
                                            <h5 class="mb-2">Робочі години</h5>
                                            <div class="d-flex flex-column gap-1">
                                                @foreach($user->workingData->schedule as $row)
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
                                                @foreach($user->workingData->schedule as $row)
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
                                                @foreach($user->workingData->schedule as $row)
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


                                    @else
                                        <div class="col-9 col-sm-10 col-md-10 col-lg-4 flex-grow-1">
                                            <h5 class="mb-2">Робочі години</h5>
                                            <div class="d-flex flex-column gap-1">
                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text" id="Monday-1"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text" id="Monday-2"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text" id="Tuesday-1"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text" id="Tuesday-2"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text"
                                                               class="form-control flatpickr-time text-start"
                                                               id="Wednesday-1"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text"
                                                               class="form-control flatpickr-time text-start"
                                                               id="Wednesday-2"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text" id="Thursday-1"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text" id="Thursday-2"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text" id="Friday-1"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text" id="Friday-2"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
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

                                                <div class="d-flex">
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
                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text" id="Monday-3"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text" id="Monday-4"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text" id="Tuesday-3"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text" id="Tuesday-4"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text"
                                                               class="form-control flatpickr-time text-start"
                                                               id="Wednesday-3"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text"
                                                               class="form-control flatpickr-time text-start"
                                                               id="Wednesday-4"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text" id="Thursday-3"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text" id="Thursday-4"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div>
                                                        <input type="text" id="Friday-3"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                    <img class="align-self-center" style="padding: 0 12px"
                                                         src="{{asset('assets/icons/line-schedule.svg')}}">
                                                    <div>
                                                        <input type="text" id="Friday-4"
                                                               class="form-control flatpickr-time text-start"
                                                               placeholder="00:00"/>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
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

                                                <div class="d-flex">
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
                                                        <input class="form-check-input" type="checkbox"
                                                               id="Tuesday-check">
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
                                                        <input class="form-check-input" type="checkbox"
                                                               id="Thursday-check">
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="Friday-check">
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="Saturday-check">
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="Sunday-check">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                </div
                                @endif
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
                        <div class="alert-data-message"></div>
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
                                        data-bs-target="#animation"><i data-feather="plus" class="mr-1"></i>Додати
                                </button>
                            </div>
                        </div>
                        @foreach($user->conditions as $condition)
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
                                    <img class="align-self-center" style="width: 45px;height: 2px"
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
                                        <img class="align-self-center" style="width: 45px;height: 2px"
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
                                        <img class="align-self-center" style="width: 45px;height: 2px"
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
                                    <img class="align-self-center" style="width: 45px;height: 2px"
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


    <div class="modal text-start" id="cancel_edit_user" tabindex="-1"
         aria-labelledby="myModalLabel6" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
            <div class="modal-content">
                <div class="card popup-card p-2">
                    <h4 class="fw-bolder">
                        Скасувати редагування користувача
                    </h4>
                    <div class="card-body row mx-0 p-0">

                        <p class="my-2 p-0"> Ви точно впевнені що хочете вийти з редагування? <br> Внесені зміни
                            не
                            збережуться.
                        </p>

                        <div class="col-12">
                            <div class="d-flex float-end">
                                <button type="button" class="btn btn-link cancel-btn"
                                        data-dismiss="modal">Скасувати
                                </button>
                                <a class="btn btn-primary" href="{{"/user/show/".$user->id}}">Підтвердити</a>
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
    <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>

    <script src="{{asset('assets/js/entity/user/account.settings.js')}}"></script>

    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>

    <script>
        var user_id = {!! $user->id !!};
        let conditions = {!! json_encode($user->workingData->conditions) !!};
        console.log(conditions)
        let exceptions = {!! json_encode($exceptions) !!};
        let exceptionsArray = []
        for (let i = 0; i < exceptions.length; i++) {
            exceptionsArray[exceptions[i].id] = exceptions[i].name
        }

        window.onload = function () {
            schedule()
            flatpickr('#fp-default')
            $("#phone").mask("+380999999999");

            @if($user->workingData->position && $user->workingData->position->key === 'driver')

            const fileInput = document.querySelector('#health_book');

            const myFile = new File([''], '{!! $healthBookFile->name !!}', {
                type: 'text/plain',
                lastModified: new Date(),
            });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(myFile);
            fileInput.files = dataTransfer.files;

            const fileInput2 = document.querySelector('#driving_license');

            const myFile2 = new File([''], '{!! $drivingLicenseFile->name !!}', {
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
    <script src="{{asset('assets/js/entity/user/edit-schedule.js')}}"></script>

@endsection
