@extends('layouts.empty')
@section('title','Onboarding')
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/css/intlTelInput.css"
    />

@endsection
@section('before-style')

@endsection

@section('content')
    <div class="container-fluid personal-info-user py-0 d-flex align-items-center" style="height:100vh"
         id="personal-info-user">
        <div class="card my-0">
            <div class="row mx-0">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 px-2 py-3">
                    <div class="row mx-0">
                        <div class="navbar-header col-md-12 col-12">
                            <ul class="nav navbar-nav navbar-brand">
                                <li class="nav-item  d-flex">
                                    <div class=" align-self-center px-0">
                                        <img width="30px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}">
                                    </div>
                                    <div class="col-9 px-0">
                                        <h3 style="margin-top: 8px; margin-left: 6px; font-weight: bold"
                                            class="brand-txt">CONSOLID</h3>
                                    </div>

                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12 col-12 my-2">
                            <h2 class="fw-bolder">
                                Вітаємо в CONSOLID!
                            </h2>
                            <div>
                                Заповніть ваші персональні дані щоб продовжити
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 mb-1">
                            <label class="form-label" for="user-name">Ім’я</label>
                            <input type="text" class="form-control" id="name"
                                   placeholder="Вкажіть ваше ім’я">
                        </div>

                        <div class="col-12 col-sm-12 mb-1">
                            <label class="form-label" for="user-last-name">Прізвище</label>
                            <input type="text" class="form-control" id="surname"
                                   placeholder="Вкажіть ваше прізвище">
                        </div>

                        <div class="col-12 col-sm-12 mb-1">
                            <label class="form-label" for="user-patronymic">По батькові</label>
                            <input type="text" class="form-control" id="_patronymic"
                                   placeholder="Вкажіть ваше ім’я по батькові">
                        </div>

                        <div class="col-12 col-sm-12 mb-1">
                            <label class="form-label" for="_email">Електронна адреса</label>
                            <input type="email" class="form-control" id="_email"
                                   placeholder="Введіть електронну адресу" {{Auth::user()->email ? 'value='.Auth::user()->email.' disabled' : 'data-required="true"'}}>
                        </div>

                        <!-- <div class="col-12 col-sm-12 mb-1">
                            <label class="form-label" for="phone-number">Телефон</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text border-end-line"
                                      style="border-right-width: 2px">+380</span>
                                <input type="text" class="form-control phone-number-mask" maxlength="11"
                                       placeholder="546 784 5489" style="padding-left: 10px"
                                       id="phone" {{Auth::user()->phone ? 'value='.substr(Auth::user()->phone, 4).' disabled' : ''}}/>
                            </div>
                        </div> -->

                        <div class="col-12 col-sm-12 mb-1 inpSelectNumCountry">
                            <div class="mb-1 d-flex flex-column ">
                                <label class="form-label" for="phone">Телефон</label>
                                <input class="form-control input-number-country" id="phone" name=""
                                       aria-describedby="phone"
                                       autofocus=""/>

                            </div>
                        </div>


                        <div
                            class="d-md-block d-lg-none col-12 col-sm-12 mb-1 d-flex justify-content-center align-items-center flex-column">

                            <h4 class="align-self-start mt-2 fw-bolder">Для чого нам ці дані?</h4>
                            <p>Ваші персональні дані необхідні нам для того щоб ми могли звʼязатися з вами в разі
                                потреби.
                                Ми не будемо їх розголошувати! </p>
                            <a data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#"
                               class="link-primary align-self-start fw-bolder">Зв'язатися з
                                нами</a>
                        </div>

                        <div class="col-12 col-sm-12">
                            <button id="next-find-company"
                                    class="next-find-company btn disabled btn-green py-0 float-end">
                                Далі
                                <img style="margin-left: 5px" src="{{asset('assets/icons/arrow-right.svg')}}">
                            </button>
                        </div>

                    </div>
                </div>

                <div class="col-4 d-none d-sm-none d-md-none d-lg-block col-sm-4 col-md-4 col-lg-4 col-xxl-4 px-3"
                     style="background-color: #D9B41408">
                    <div class="d-flex justify-content-center align-items-center h-100 flex-column">
                        <img class="" src="{{asset('assets/icons/onboarding-info.svg')}}">
                        <h4 class="align-self-start mt-2 fw-bolder">Для чого нам ці дані?</h4>
                        <p>Ваші персональні дані необхідні нам для того щоб ми могли звʼязатися з вами в разі потреби.
                            Ми не будемо їх розголошувати! </p>
                        <a data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#"
                           class="link-primary align-self-start fw-bolder">Зв'язатися з нами</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid d-none find-company py-0 d-flex align-items-center" style="height:100vh"
         id="find-company">
        <div class="card my-0">
            <div class="row mx-0" style="height: 851px">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 px-2 py-3">
                    <div class="row mx-0 h-100 justify-content-between flex-column">

                        <div class="col-md-12 col-12">
                            <div class="navbar-header col-md-12 col-12">
                                <ul class="nav navbar-nav navbar-brand">
                                    <li class="nav-item  d-flex">
                                        <div class=" align-self-center px-0">
                                            <img width="30px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}">
                                        </div>
                                        <div class="col-9 px-0">
                                            <h3 style="margin-top: 8px; margin-left: 6px; font-weight: bold"
                                                class="brand-txt">CONSOLID</h3>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="col-md-12 col-12 my-2">
                                    <h2 class="fw-bolder">
                                        Додати компанію
                                    </h2>
                                    <div>
                                        Якщо компанія вже зареєстрована в CONSOLID введіть її назву, ЄДРПОУ, ІПН або
                                        країну
                                        реєстрації в пошуку та виберіть зі списку або створіть нову компанію.
                                    </div>
                                </div>

                                <div class="col-md-12 col-12 mb-1">
                                    <div class="input-group inpSelectCountry ">
                                        <input id="searchCompany" type="text" class="form-control "
                                               placeholder="Вкажіть назву, ЄДРПОУ, ІПН або країну реєстрації"
                                               aria-describedby="button-addon2"/>

                                        <button class="btn btn-outline-primary" id="searchCompanyButton" type="button">
                                            <i
                                                style="margin-right: 10px"
                                                data-feather='search'></i> Шукати
                                        </button>
                                    </div>
                                </div>

                                <div id="searchCompanyResult" class="col-12 col-sm-12 ">
                                    <div class="d-flex flex-column align-items-center justify-content-center"
                                         style="height: 414px">

                                        <div id="findCompany"
                                             class="d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{asset('assets/icons/onboarding-search.svg')}}">
                                            <h4 class="fw-bolder">Знайдіть компанію</h4>
                                            <p class="text-secondary text-center"
                                               style="max-width: 390px; opacity: 0.7!important;">
                                                Введіть в пошуку назву
                                                компанії, ЄДРПОУ або ІПН
                                            </p>
                                        </div>

                                        <div id="notFoundCompany"
                                             class="d-none d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{asset('assets/icons/onbording-search-question.svg')}}">
                                            <h4 class="fw-bolder">За вашим запитом нічого не знайдено</h4>
                                            <p class="text-secondary text-center"
                                               style="max-width: 390px; opacity: 0.7!important;">
                                                Перевірте правильність
                                                вказаних данних або
                                                створіть нову компанію</p>
                                        </div>

                                        <button class="btn btn-primary float-end mt-1 d-none" id="create-new-company"
                                                type="button">
                                            <img
                                                class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">
                                            Створити
                                            нову
                                            компанію
                                        </button>

                                    </div>
                                </div>

                                <div id="listFindCompany" class="col-12 col-sm-12 d-none ">
                                    <p id="countCompanyItem" class="mb-0">Найдено X результати</p>
                                    <div class="d-flex flex-column"
                                         style="max-height: 476px; overflow-y: auto">
                                        <div class="row mx-0" id="listItemCompany"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 d-flex justify-content-between align-items-center">
                            <button class="btn btn-flat-secondary float-start" id="back-personal-info"
                                    style="padding-top:10px!important ;padding-bottom:10px!important ;">
                                <img style="margin-right: 0.5rem" src="{{asset('assets/icons/arrow-left.svg')}}">
                                Назад
                            </button>
                            <p id="onbording-link-proposition"
                               class="p-0 m-0 d-none"
                            > Не знайшли свою компанію? <a href="#" id="create-new-company-link">Створити нову</a></p>
                        </div>
                    </div>
                </div>

                <div class="d-none d-sm-none d-md-none d-lg-block col-4 col-sm-4 col-md-4 col-lg-4 col-xxl-4 px-3"
                     style="background-color: #D9B41408">
                    <div class="d-flex justify-content-center align-items-center h-100 flex-column">
                        <img width="100%" style="max-width: max-content"
                             src="{{asset('assets/icons/onboarding-company.svg')}}">
                        <h4 class="align-self-start mt-2 fw-bolder">Як це працює?</h4>
                        <p>Компанії створені вами або іншими користувачами, що не мають адміністратора можна додати до
                            вашого робочого середовища, якщо в компанії вже є адміністратор то ви можете надісати запит
                            на долучення до неї. </p>
                        <a data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#"
                           class="link-primary align-self-start fw-bolder">Зв'язатися з нами</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid d-none create-company py-0 d-flex align-items-center" style="height:100vh"
         id="create-company">
        <div class="card my-0">
            <div class="row mx-0" style="height: 851px">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 px-2 py-3">
                    <div class="row mx-0 h-100 justify-content-between flex-column">
                        <div class="navbar-header col-md-12 col-12">
                            <ul class="nav navbar-nav navbar-brand">
                                <li class="nav-item  d-flex">
                                    <div class=" align-self-center px-0">
                                        <img width="30px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}">
                                    </div>
                                    <div class="col-9 px-0">
                                        <h3 style="margin-top: 8px; margin-left: 6px; font-weight: bold"
                                            class="brand-txt">CONSOLID</h3>
                                    </div>

                                </li>
                            </ul>
                        </div>

                        <div class="col-md-12 col-12 my-2">
                            <h2 class="fw-bolder">
                                Нова компанія
                            </h2>
                        </div>


                        <div class=" col-md-12 col-12" style="overflow-y: auto; max-height: 600px">

                            <div class="col-md-12 col-12">


                                <div class="d-flex row mx-0">
                                    <div class="col-6 ps-0">
                                        <div class="card onboarding-radio-card radio-card  mb-0 tab-active"
                                             style="width: auto!important;">
                                            <div class="card-body" id="tab_1" data-tab="1">
                                                <div class="text-center">
                                                    <img src="{{asset('assets/icons/User.svg')}}" id="tab-icon-1"
                                                         class="tab-filter">
                                                </div>
                                                <div class="text-center">
        <span class="f-15 fw-6">
          Фізична особа
        </span>
                                                </div>
                                                <div class="text-center">
                                                    <input class="form-check-input" type="radio" name="tabs"
                                                           value="tab1"
                                                           checked>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card onboarding-radio-card radio-card  mb-0"
                                             style="width: auto!important;">
                                            <div class="card-body" id="tab_2" data-tab="2">
                                                <div class="text-center">
                                                    <img src="{{asset('assets/icons/office.svg')}}" id="tab-icon-2">
                                                </div>
                                                <div class="text-center">
        <span class="f-15 fw-6">
          Юридична особа
        </span>
                                                </div>
                                                <div class="text-center">
                                                    <input class="form-check-input" type="radio" name="tabs"
                                                           value="tab2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="" id="data_tab_1">
                                    <div class="card mb-0">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Основні дані</h4>
                                        </div>
                                        <div class="card-body my-25 px-0 pb-0">
                                            <!-- header section -->

                                            <div class="d-flex">
                                                <a href="#" class="me-25">
                                                    <img src="{{asset('assets/icons/empty-company.svg') }}"
                                                         id="company-upload-img1" class="uploadedAvatar rounded me-50"
                                                         alt="profile image" height="100" width="100">
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="d-flex align-items-end mb-1 ms-1">
                                                    <div>
                                                        <label for="company-upload1"
                                                               class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                                                        <input type="file" id="company-upload1" name="avatar" hidden=""
                                                               accept="image/jpeg, image/png, image/gif">
                                                        <button type="button" id="company-reset"
                                                                class="btn btn-sm btn-outline-secondary mb-75 waves-effect">
                                                            Видалити
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

                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <label class="form-label" for="accountFirstName">Ім’я</label>
                                                        <input type="text" class="form-control" id="first_name"
                                                               name="name"
                                                               required placeholder="Вкажіть ім’я"
                                                               data-msg="Please enter first name">
                                                    </div>

                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <label class="form-label" for="accountLastName">Прізвище</label>
                                                        <input type="text" class="form-control" id="last_name"
                                                               name="surname" placeholder="Вкажіть прізвище" required
                                                               data-msg="Please enter last name">
                                                    </div>

                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <label class="form-label" for="accountPatronymic">По
                                                            батькові</label>
                                                        <input type="text" class="form-control" id="patronymic"
                                                               name="patronymic" required
                                                               placeholder="Вкажіть ім’я по батькові"
                                                               data-msg="Please enter patronymic">
                                                    </div>
                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <label class="form-label" for="fp-default">ІПН</label>
                                                        <input type="text" class="form-control" required id="ipn"
                                                               oninput="limitInputToNumbers(this,10)"
                                                               name="ipn"
                                                               placeholder="0000000000">
                                                    </div>
                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <label class="form-label" for="email">e-mail</label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                               required placeholder="example@gmail.com">
                                                    </div>
                                                    <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="select2-hide-search">Категорія компанії</label>
                                    <select class="hide-search form-select" id="category" data-dictionary="company_category" data-placeholder="Вкажіть категорію вашої компанії">
                                        <option value=""></option>

                                    </select>
                            </div>

                                                    <div id="private-data-message"></div>

                                                </div>
                                            </div>
                                            <!--/ form -->
                                        </div>
                                    </div>

                                    <div class="card mb-0">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Фактична адреса</h4>
                                        </div>

                                        <div class="card-body px-0 pb-0">
                                            <div class="row">

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label"
                                                               for="select2-hide-search">Країна</label>
                                                        <select class="select2 form-select" id="country" data-dictionary="country"
                                                                id="select2-hide-search"
                                                                data-placeholder="Виберіть країну">
                                                            <option value=""></option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="select2-hide-search">Населений
                                                            пункт</label>
                                                        <select class="select2 form-select" id="city" data-dictionary="settlement"
                                                                data-placeholder="Виберіть населений пункт">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label"
                                                               for="select2-hide-search">Вулиця/Проспект</label>
                                                        <select class="select2 form-select" id="street" data-dictionary="street"
                                                                data-placeholder="Виберіть вулицю/ проспект">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="code">Номер будинку</label>
                                                    <input type="text" class="form-control" id="building_number"
                                                           name="building_number" required autocomplete="off"
                                                           placeholder="Вкажіть номер будинку">
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="code">Квартира</label>
                                                    <input type="text" class="form-control" id="flat" name="flat"
                                                           required
                                                           autocomplete="off" placeholder="Вкажіть номер квартири">
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="code">GLN</label>
                                                    <input type="text" class="form-control" id="gln" name="gln" required
                                                           oninput="limitInputToNumbers(this,13)"
                                                           autocomplete="off" placeholder="0000000000000">
                                                </div>


                                                <div id="address-message"></div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="card mb-0">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Реквізити</h4>
                                        </div>


                                        <div class="card-body my-25 px-0 pb-0">

                                            <div class="row">

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="bank">Банк</label>
                                                    <input type="text" class="form-control" id="bank"
                                                           placeholder="Вкажіть назву банка" required>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="iban">IBAN</label>
                                                    <input type="text" class="form-control" id="iban"
                                                           oninput="maskNumbersPlusLatin(this,29)"
                                                           placeholder="UA000000000000000000000000000" required>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="mfo">МФО</label>
                                                    <input type="text" class="form-control" id="mfo" required
                                                           oninput="limitInputToNumbers(this,6)"
                                                           placeholder="000000">
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label"
                                                               for="select2-hide-search">Валюта</label>
                                                        <select class="select2 form-select" id="currency" data-dictionary="currencies"
                                                                data-placeholder="Виберіть валюту">
                                                            <option value=""></option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="requisite-message"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="card mb-0">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Про компанію</h4>
                                        </div>
                                        <div class="card-body my-25 px-0 pb-0">
                                            <div class="row">
                                                <div class="col-12 col-sm-12 mb-1">
                                                <textarea class="form-control" id="about" rows="5"
                                                          placeholder="Напишіть короткий опис про компанію"></textarea>
                                                </div>

                                                <div id="about-message"></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="" id="data_tab_2" style="display: none">


                                    <div class="card mb-0 mt-1">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="fp-default select2-hide-search">Вид юридичної
                                                особи</label>
                                            <select class="hide-search form-select" id="legal_entity"
                                                    data-placeholder="Виберіть вид юридичної особи">
                                                <option value=""></option>
                                                @foreach($legalTypes as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>


                                        <div class="card-header px-0">
                                            <h4 class="card-title">Основні дані</h4>
                                        </div>
                                        <div class="card-body my-25 px-0 pb-0">
                                            <!-- header section -->

                                            <div class="d-flex">
                                                <a href="#" class="me-25">
                                                    <img src="{{asset('assets/icons/empty-company.svg') }}"
                                                         id="company-upload-img2" class="uploadedAvatar rounded me-50"
                                                         alt="profile image" height="100" width="100">
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="d-flex align-items-end mb-1 ms-1">
                                                    <div>
                                                        <label for="company-upload2"
                                                               class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                                                        <input type="file" id="company-upload2" name="avatar" hidden=""
                                                               accept="image/jpeg, image/png, image/gif">
                                                        <button type="submit" id="company-reset2"
                                                                class="btn btn-sm btn-outline-secondary mb-75 waves-effect">
                                                            Видалити
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

                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <label class="form-label" for="edrpou">ЄДРПОУ</label>
                                                        <input type="text" class="form-control" id="edrpou"
                                                               oninput="limitInputToNumbers(this,8)"
                                                               name="edrpou"
                                                               required placeholder="0000000"
                                                               data-msg="Please enter first name">
                                                    </div>

                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <label class="form-label" for="email_2">e-mail</label>
                                                        <input type="email" class="form-control" id="email_2"
                                                               name="email"
                                                               required data-msg="Please enter last name"
                                                               placeholder="example@gmail.com">
                                                    </div>

                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <label class="form-label" for="company_name">Назва
                                                            компанії</label>
                                                        <input type="text" class="form-control" id="company_name"
                                                               name="patronymic" required
                                                               placeholder="Вкажіть назву компанії"
                                                               data-msg="Please enter patronymic">
                                                    </div>

                                                    <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="select2-hide-search">Категорія компанії</label>
                                    <select class="hide-search form-select" id="company_category" data-dictionary="company_category" data-placeholder="Вкажіть категорію вашої компанії">
                                        <option value=""></option>

                                    </select>
                            </div>

                                                    <div id="private-data-message2"></div>

                                                </div>
                                            </div>
                                            <!--/ form -->
                                        </div>
                                    </div>

                                    <div class="card mb-0">
                                        <div class="card-header justify-content-normal px-0">
                                            <h4 class="card-title">Платник ПДВ</h4>
                                            <input type="checkbox" class="form-check-input" id="pdv">
                                        </div>

                                        <div class="card-body my-25 px-0 pb-0">

                                            <div class="row">

                                                <div class="col-12 col-sm-12 mb-1">
                                                    <label class="form-label" for="passwordEmail">Номер ІПН</label>
                                                    <input oninput="limitInputToNumbers(this,10)" type="text"
                                                           class="form-control" id="ipn_2"
                                                           placeholder="000000000" disabled>
                                                </div>


                                                <div class="col-12 col-sm-12 mb-1">
                                                    <label for="reg_doc" class="form-label">Свідоцтво
                                                        реєстрації</label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="file" id="reg_doc" disabled>
                                                        <button class="btn btn-outline-primary disabled-btn-c"
                                                                id="reg_doc-reset" type="button" disabled><i
                                                                data-feather="x"></i></button>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 mb-1">
                                                    <label for="ust_doc" class="form-label">Установчі
                                                        документи</label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="file" id="ust_doc" disabled>
                                                        <button class="btn btn-outline-primary disabled-btn-c"
                                                                id="ust_doc-reset" type="button" disabled><i
                                                                data-feather="x"></i></button>
                                                    </div>
                                                </div>


                                                <div id="pdv-message"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-0">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Фактична адреса</h4>
                                        </div>
                                        <div class="card-body px-0 pb-0">
                                            <div class="row">

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label"
                                                               for="select2-hide-search">Країна</label>
                                                        <select class="select2 form-select" id="country_2" data-dictionary="country"
                                                                data-placeholder="Виберіть країну">
                                                            <option value=""></option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="select2-hide-search">Населений
                                                            пункт</label>
                                                        <select class="select2 form-select" id="city_2" data-dictionary="settlement"
                                                                data-placeholder="Виберіть населений пункт">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="select2-hide-search">Вулиця /
                                                            Проспект</label>
                                                        <select class="select2 form-select" id="street_2" data-dictionary="street"
                                                                data-placeholder="Виберіть вулицю / проспект">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="code">Номер будинку</label>
                                                    <input type="text" class="form-control" id="building_number_2"
                                                           name="buidling_number" required autocomplete="off"
                                                           placeholder="Вкажіть номер будинку">
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="code">Квартира</label>
                                                    <input type="text" class="form-control" id="flat_2" name="flat"
                                                           required
                                                           autocomplete="off" placeholder="Вкажіть номер квартири">
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="gln_2">GLN</label>
                                                    <input type="text" class="form-control" id="gln_2" name="gln"
                                                           oninput="limitInputToNumbers(this,13)"
                                                           required
                                                           autocomplete="off" placeholder="0000000000000">
                                                </div>

                                                <div id="address-message2"></div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="card mb-0">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Юридична Адреса</h4>
                                        </div>
                                        <div class="card-body px-0 pb-0">
                                            <div class="row">
                                                <div class="col-12 mb-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="matchingAddress" value="unchecked">
                                                        <label class="form-check-label" for="matchingAddress">Співпадає
                                                            з фактичною адресою</label>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="u_country">Країна</label>
                                                        <select class="select2 form-select" id="u_country" data-dictionary="country"
                                                                data-placeholder="Виберіть країну">
                                                            <option value=""></option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="u_city select2-hide-search">Населений
                                                            пункт</label>
                                                        <select class="select2 form-select" id="u_city" data-dictionary="settlement"
                                                                data-placeholder="Виберіть населений пункт">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="u_street select2-hide-search">Вулиця
                                                            / Проспект</label>
                                                        <select class="select2 form-select" id="u_street" data-dictionary="street"
                                                                data-placeholder="Виберіть вулицю / проспект">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="u_building_number">Номер
                                                        будинку</label>
                                                    <input type="text" class="form-control" id="u_building_number"
                                                           name="buidling_number" required autocomplete="off"
                                                           placeholder="Вкажіть номер будинку">
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="code">Квартира</label>
                                                    <input type="text" class="form-control" id="u_flat" name="flat"
                                                           required
                                                           autocomplete="off" placeholder="Вкажіть номер квартири">
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="u_gln">GLN</label>
                                                    <input type="text" class="form-control" id="u_gln" name="gln"
                                                           oninput="limitInputToNumbers(this,13)"
                                                           required
                                                           autocomplete="off" placeholder="0000000000000">
                                                </div>

                                                <div id="u-address-message"></div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="card mb-0">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Реквізити</h4>
                                        </div>


                                        <div class="card-body my-25 px-0 pb-0">
                                            <div class="row">

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="bank_2">Банк</label>
                                                    <input type="text" class="form-control" id="bank_2"
                                                           placeholder="Вкажіть назву банка" required>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="iban_2">IBAN</label>
                                                    <input type="text" class="form-control" id="iban_2"
                                                           oninput="maskNumbersPlusLatin(this,29)"
                                                           placeholder="UA000000000000000000000000000" required>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <label class="form-label" for="mfo_2">МФО</label>
                                                    <input type="text" class="form-control" placeholder="000000"
                                                           oninput="limitInputToNumbers(this,6)"

                                                           id="mfo_2"
                                                           required>
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="mb-1">
                                                        <label class="form-label"
                                                               for="select2-hide-search">Валюта</label>
                                                        <select class="select2 form-select" id="currency_u" data-dictionary="currencies"
                                                                data-placeholder="Виберіть валюту">
                                                            <option value=""></option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="requisite-message2"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="card mb-0">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Про компанію</h4>
                                        </div>
                                        <div class="card-body my-25 px-0 pb-0">
                                            <div class="row">
                                                <div class="col-12 col-sm-12 mb-1">
                                                <textarea class="form-control" id="about_2" rows="5"
                                                          placeholder="Напишіть короткий опис про компанію"></textarea>
                                                </div>

                                                <div id="about_company_message_2"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="col-12 col-sm-12 d-flex justify-content-between">
                            <button class="btn btn-flat-secondary float-start" id="back-find-company"
                                    style="padding-top:10px!important ;padding-bottom:10px!important ;">
                                <img style="margin-right: 0.5rem" src="{{asset('assets/icons/arrow-left.svg')}}">
                                Назад
                            </button>

                            <button id="onboarding_save" type="button"
                                    class="btn btn-green me-1">
                                Створити
                            </button>

                            <button id="onboarding_save_2" type="button"
                                    class="d-none btn btn-green me-1">
                                Створити
                            </button>

                            <button id="edit_save" type="button"
                                    class="d-none btn btn-green me-1">
                                Редагувати
                            </button>

                            <button id="edit_save_2" type="button"
                                    class="d-none btn btn-green me-1">
                                Редагувати
                            </button>
                        </div>
                    </div>
                </div>

                <div class="d-none d-sm-none d-md-none d-lg-block col-4 col-sm-4 col-md-4 col-lg-4 col-xxl-4 px-3"
                     style="background-color: #D9B41408">
                    <div class="d-flex justify-content-center align-items-center h-100 flex-column">
                        <img width="100%" style="max-width: max-content"
                             src="{{asset('assets/icons/onboarding-company.svg')}}">
                        <h4 class="align-self-start mt-2 fw-bolder">Як це працює?</h4>
                        <p>Компанії створені вами або іншими користувачами, що не мають адміністратора можна додати до
                            вашого робочого середовища, якщо в компанії вже є адміністратор то ви можете надісати запит
                            на долучення до неї. </p>
                        <a data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#"
                           class="link-primary align-self-start fw-bolder">Зв'язатися з нами</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid d-none create-workspace py-0 d-flex align-items-center" style="height:100vh"
         id="create-workspace">
        <div class="card my-0">
            <div class="row mx-0" style="height: 851px">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 px-2 py-3">
                    <div class="row mx-0 h-100 justify-content-between flex-column">

                        <div class="col-md-12 col-12">
                            <div class="navbar-header col-md-12 col-12">
                                <ul class="nav navbar-nav navbar-brand">
                                    <li class="nav-item  d-flex">
                                        <div class=" align-self-center px-0">
                                            <img width="30px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}">
                                        </div>
                                        <div class="col-9 px-0">
                                            <h3 style="margin-top: 8px; margin-left: 6px; font-weight: bold"
                                                class="brand-txt">CONSOLID</h3>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="col-md-12 col-12 my-2">
                                    <h2 class="fw-bolder">
                                        Створити робоче середовище
                                    </h2>
                                    <div>
                                        Ця компанія не знаходиться в жодному робочому середовищі, ви повинні створити
                                        для неї нове робоче середовище.
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 ">
                                    <div class="d-flex flex-column"
                                         style="max-height: 476px; overflow-y: auto">
                                        <div class="row mx-0">
                                            <a class="col-12 px-0 border onboarding-item-company mt-1"
                                               style="border-radius: 6px">
                                                <div class="row mx-0">
                                                    <div class="col-auto p-0">
                                                        <div class="p-0"
                                                             style="background-color: #A8AAAE14; width: 138px">
                                                            <img width="138px" height="138px" id="company-img"
                                                                 src="{{asset('assets/icons/building-community.svg')}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-9 py-1 flex-grow-1">
                                                        <div class="d-flex align-items-center" style="gap: 12px">
                                                            <h4 class="fw-bolder mb-0" id="title-company"></h4>
                                                            <span
                                                                class="badge badge-light-primary">Без адміністратора</span>
                                                        </div>

                                                        <div class="d-flex align-items-center mt-1"
                                                             style="gap: 5px; font-size: 15px!important;"
                                                             id="title-payment-details">

                                                        </div>

                                                        <div class="d-flex align-items-center "
                                                             style="gap: 5px; margin-top: 6px; font-size: 15px!important;">
                                                            <p class="mb-0 fw-normal">Країна реєстрації:</p>
                                                            <p class="fw-bold mb-0" id="title-country"></p>
                                                        </div>

                                                        <div class="d-flex align-items-center "
                                                             style="gap: 5px; margin-top: 6px; font-size: 15px!important;">
                                                            <p class="mb-0 fw-normal">Додана в CONSOLID:</p>
                                                            <p class="fw-bold mb-0">{{ now()->format('d.m.Y') }}</p>
                                                            <p class="mb-0 fw-normal">користувачем</p>
                                                            <p class="fw-bold mb-0" id="full-name-user">
                                                                <!-- {{Auth::user()->surname.' '.mb_strtoupper(mb_substr(Auth::user()->name,0,1))
                                                            .'.'.mb_strtoupper(mb_substr(Auth::user()->patronymic,0,1))}} -->
                                                        </p>
                                                        </div>

                                                    </div>
                                                </div>


                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 d-flex justify-content-between">
                            <button class="btn btn-flat-secondary float-start" id="back-create-new-company"
                                    style="padding-top:10px!important ;padding-bottom:10px!important ;">
                                <img style="margin-right: 0.5rem" src="{{asset('assets/icons/arrow-left.svg')}}">
                                Назад
                            </button>


                            <a id="condition_submit"
                               class="btn btn-green py-0 float-end"
                               style="padding-top:10px!important ;padding-bottom:10px!important ;">
                                Розпочати
                                <img style="margin-left: 5px" src="{{asset('assets/icons/arrow-right.svg')}}">
                            </a>


                        </div>
                    </div>
                </div>

                <div class="d-none d-sm-none d-md-none d-lg-block col-4 col-sm-4 col-md-4 col-lg-4 col-xxl-4 px-3"
                     style="background-color: #D9B41408">
                    <div class="d-flex justify-content-center align-items-center h-100 flex-column">
                        <img width="100%" style="max-width: max-content"
                             src="{{asset('assets/icons/onboarding-company.svg')}}">
                        <h4 class="align-self-start mt-2 fw-bolder">Як це працює?</h4>
                        <p>Компанії створені вами або іншими користувачами, що не мають адміністратора можна додати до
                            вашого робочого середовища, якщо в компанії вже є адміністратор то ви можете надісати запит
                            на долучення до неї. </p>
                        <a data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#"
                           class="link-primary align-self-start fw-bolder">Зв'язатися з нами</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid d-none send-join py-0 d-flex align-items-center" style="height:100vh" id="send-join">
        <div class="card my-0">
            <div class="row mx-0" style="height: 851px">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 px-2 py-3">
                    <div class="row mx-0 h-100 justify-content-between flex-column">

                        <div class="col-md-12 col-12">
                            <div class="navbar-header col-md-12 col-12">
                                <ul class="nav navbar-nav navbar-brand">
                                    <li class="nav-item  d-flex">
                                        <div class=" align-self-center px-0">
                                            <img width="30px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}">
                                        </div>
                                        <div class="col-9 px-0">
                                            <h3 style="margin-top: 8px; margin-left: 6px; font-weight: bold"
                                                class="brand-txt">CONSOLID</h3>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="col-md-12 col-12 my-2">
                                    <h2 class="fw-bolder">
                                        Надіслати запит на долучення
                                    </h2>
                                    <div>
                                        Ця компанія вже знаходить в робочому средовищі. Ви можете надіслати запит на
                                        долучення до цього робочого середовища.
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 ">
                                    <div class="d-flex flex-column"
                                         style="max-height: 476px; overflow-y: auto">
                                        <div class="row mx-0">
                                            <a class="col-12 px-0 border onboarding-item-company mt-1"
                                               style="border-radius: 6px" id="request-company-card">


                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 d-flex justify-content-between">
                            <button class="btn btn-flat-secondary float-start" id="back-find-company-2"
                                    style="padding-top:10px!important ;padding-bottom:10px!important ;">
                                <img style="margin-right: 0.5rem" src="{{asset('assets/icons/arrow-left.svg')}}">
                                Назад
                            </button>

                            <button data-bs-toggle="modal" data-bs-target="#animation-2"
                                    class="btn btn-green py-0 float-end" id="send-request"
                                    user-id="{{Auth::id()}}"
                                    style="padding-top:10px!important ;padding-bottom:10px!important ;">
                                Надіслати
                                <img style="margin-left: 5px" src="{{asset('assets/icons/arrow-right.svg')}}">
                            </button>

                            <div class="modal text-start" id="animation-2" tabindex="-1" aria-labelledby="myModalLabel6"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header pt-4">
                                        </div>
                                        <div class="card popup-card">
                                            <div class="popup-header">
                                                Ваш запит надіслано
                                            </div>
                                            <div class="card-body px-4 pb-4">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 mb-1">
                                                        <p>Очікуйте на підтвердження від адміністратора</p>
                                                    </div>
                                                    <div class="col-12 mt-1">
                                                        <div class="d-flex float-end">

                                                            <a href="{{route('workspace.index')}}"
                                                               class="btn btn-primary" id="condition_apply_submit">
                                                                Зрозуміло
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="d-none d-sm-none d-md-none d-lg-block col-4 col-sm-4 col-md-4 col-lg-4 col-xxl-4 px-3"
                     style="background-color: #D9B41408">
                    <div class="d-flex justify-content-center align-items-center h-100 flex-column">
                        <img width="100%" style="max-width: max-content"
                             src="{{asset('assets/icons/onboarding-company.svg')}}">
                        <h4 class="align-self-start mt-2 fw-bolder">Як це працює?</h4>
                        <p>Компанії створені вами або іншими користувачами, що не мають адміністратора можна додати до
                            вашого робочого середовища, якщо в компанії вже є адміністратор то ви можете надісати запит
                            на долучення до неї. </p>
                        <a data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#"
                           class="link-primary align-self-start fw-bolder">Зв'язатися з нами</a>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <!-- = модалка "зв‘язатись з адміністратором" -->
    <div class="modal fade" id="modalForSendSupport" tabindex="-1" aria-labelledby="twoFactorAuthTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 mx-50">
                    <form id="feedback-form" class="auth-login-form w-100 h-100 d-flex flex-column px-2">
                        <h3 class=" mb-1" id="twoFactorAuthTitle">Звʼязатись з адміністратором</h3>
                        <p class=" mb-1">
                            Вкажіть електронну адресу або номер телефону за якими ми зможемо звʼязатись з вами
                            найближчим часом.
                        </p>
                        <div class="mb-2 input-email-group">
                            <label class="form-label" for="feedBackEmailInp">Електронна адреса</label>
                            <input class="form-control" id="feedBackEmailInp" type="text" name="login"
                                   placeholder="example@email.com" aria-describedby="feedBackEmailInp"
                                   autofocus="" tabindex="1" style="margin-bottom:5px;"/>
                            <a href="#" class="text-secondary text-decoration-underline link-to-numberInput">Використати
                                номер телефону</a>
                        </div>
                        <!-- КАсСТОМІЗОВАНИЙ ІНПУТ для номеру телефону різних країн -->

                        <div class="input-number-group inpSelectNumCountry"
                             style="padding-top: 2px; margin-bottom : 7px;">
                            <div class="mb-1 d-flex flex-column ">
                                <label class="form-label" for="feedBackEmailInpOnbording">Телефон</label>
                                <input class="form-control input-number-country" id="feedBackEmailInpOnbording" type=""
                                       name="login"
                                       aria-describedby="feedBackEmailInpOnbording"
                                       autofocus=""/>
                                <a href="#" class="text-secondary text-decoration-underline link-to-emailInput"
                                   style="margin-top:5px;">Увійти використовуючи e-mail</a>
                            </div>
                        </div>
                        <!-- end input -->
                        <div class="">
                            <p class="m-0">Або звʼяжіться самостійно</p>
                            <ul class="">
                                <li>
                                    <p class="m-0"> Номер телефону: <a class="fw-medium-c text-secondary "
                                                                       href="tel:+38000000 тут ввести коректний номер">+38
                                            (088) 888 88 88</a></p>
                                </li>
                                <li>
                                    <p class="m-0"> Електронна адреса: <a class="fw-medium-c text-secondary"
                                                                          href="mailto: abc@example.com тут ввести коректний мейл">example@email.com</a>
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <button id="nextStepAuth" class="btn btn-primary float-end mt-3" type="submit">
                            <span class="me-50">Надіслати</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- = -->

@endsection

@section('page-script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/js/intlTelInput.min.js"></script>

    <script type="module">
        import {inputSelectCountry} from '{{asset('assets/js/utils/inputSelectCountry.js')}}';

        inputSelectCountry('#feedBackEmailInpOnbording');
        inputSelectCountry('#phone');
    </script>

<script type="module">
    import {selectDictionaries} from '{{asset('assets/js/utils/selectDictionaries.js')}}';
        selectDictionaries()
</script>
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <!-- <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script> -->
    <!-- <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script> -->

    <script src="{{asset('vendors/js/forms/cleave/cleave.min.js')}}"></script>
    <script src="{{asset('vendors/js/forms/cleave/addons/cleave-phone.us.js')}}"></script>
    <script src="{{asset('js/scripts/forms/form-input-mask.js')}}"></script>
    <script src="{{asset('assets/js/entity/onboarding/onboarding.js')}}"></script>
    <script src="{{asset('assets/js/entity/company/company.js')}}"></script>
    <script src="{{asset('assets/js/utils/validationInputs.js')}}"></script>

@endsection
