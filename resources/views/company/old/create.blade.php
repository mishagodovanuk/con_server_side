@extends('layouts.admin')
@section('title','')
@section('page-style')
    <script src="{{asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js'))}}"></script>

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">

@endsection
@section('content')
    <div class="d-flex mx-2">
        <div class="card radio-card tab-active">
            <div class="card-body" id="tab_1" data-tab="1">
                <div class="text-center">
                    <img src="{{asset('assets/icons/User.svg')}}" id="tab-icon-1" class="tab-filter">
                </div>
                <div class="text-center">
        <span class="f-15 fw-6">
          Фізична особа
        </span>
                </div>
                <div class="text-center">
                    <input class="form-check-input" type="radio" name="tabs" value="tab1" checked>
                </div>
            </div>
        </div>
        <div class="card radio-card" style="margin-left: 35px">
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
                    <input class="form-check-input" type="radio" name="tabs" value="tab2">
                </div>
            </div>
        </div>
    </div>


    <div class="mx-2" id="data_tab_1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Особисті дані</h4>
            </div>
            <div class="card-body my-25">
                <!-- header section -->

                <div class="d-flex">
                    <a href="#" class="me-25">
                        <img src="{{asset('assets/icons/empty-company.svg') }}" id="company-upload-img1"
                             class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">
                    </a>
                    <!-- upload and reset button -->
                    <div class="d-flex align-items-end mb-1 ms-1">
                        <div>
                            <label for="company-upload1"
                                   class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                            <input type="file" id="company-upload1" name="avatar" hidden=""
                                   accept="image/jpeg, image/png, image/gif">
                            <button type="submit" id="company-reset"
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

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountFirstName">Ім’я</label>
                            <input type="text" class="form-control" id="first_name" name="name" required
                                   placeholder="Вкажіть ім’я" data-msg="Please enter first name">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountLastName">Прізвище</label>
                            <input type="text" class="form-control" id="last_name" name="surname"
                                   placeholder="Вкажіть прізвище" required data-msg="Please enter last name">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountPatronymic">По батькові</label>
                            <input type="text" class="form-control" id="patronymic" name="patronymic" required
                                   placeholder="Вкажіть ім’я по батькові" data-msg="Please enter patronymic">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="fp-default">ІПН</label>
                            <input type="text" class="form-control" required id="ipn" name="ipn"
                                   placeholder="0000000000">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountEmail">Емейл</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                   placeholder="example@gmail.com">
                        </div>

                        <div id="private-data-message"></div>

                    </div>
                </div>
                <!--/ form -->
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Адреса</h4>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label" for="select2-hide-search">Країна</label>
                            <select class="select2 form-select" id="country" id="select2-hide-search"
                                    data-placeholder="Виберіть країну">
                                <option value=""></option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label" for="select2-hide-search">Населений пункт</label>
                            <select class="select2 form-select" id="city" data-placeholder="Виберіть населений пункт">
                                <option value=""></option>
                                @foreach($settlements as $settlement)
                                    <option value="{{$settlement->id}}">{{$settlement->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label" for="select2-hide-search">Вулиця/Проспект</label>
                            <select class="select2 form-select" id="street"
                                    data-placeholder="Виберіть вулицю/ проспект">
                                <option value=""></option>
                                @foreach($streets as $street)
                                    <option value="{{$street->id}}">{{$street->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="code">Номер будинку</label>
                        <input type="text" class="form-control" id="building_number" name="building_number" required
                               autocomplete="off" placeholder="Вкажіть номер будинку">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="code">Квартира</label>
                        <input type="text" class="form-control" id="flat" name="flat" required autocomplete="off"
                               placeholder="Вкажіть номер квартири">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="code">GLN</label>
                        <input type="text" class="form-control" id="gln" name="gln" required autocomplete="off"
                               placeholder="0000000000000">
                    </div>


                    <div id="address-message"></div>
                </div>

            </div>

        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Реквізити</h4>
            </div>


            <div class="card-body my-25">


                <div class="row">

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="bank">Банк</label>
                        <input type="text" class="form-control" id="bank" placeholder="Вкажіть назву банка" required>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="iban">IBAN</label>
                        <input type="text" class="form-control" id="iban" placeholder="UA000000000000000000000000000"
                               required>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="mfo">МФО</label>
                        <input type="text" class="form-control" id="mfo" required placeholder="000000">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label"
                                   for="select2-hide-search">Валюта</label>
                            <select class="select2 form-select" id="currency"
                                    data-placeholder="Виберіть валюту">
                                <option value=""></option>
                                <option value="UAH">UAH</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="ZLT">ZLT</option>
                            </select>
                        </div>
                    </div>

                    <div id="requisite-message"></div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Про компанію</h4>
            </div>
            <div class="card-body my-25">
                <div class="row">
                    <div class="col-12 col-sm-6 mb-1">
                        <textarea class="form-control" id="about" rows="5"
                                  placeholder="Напишіть короткий опис про компанію"></textarea>
                    </div>

                    <div id="about-message"></div>
                </div>
            </div>
        </div>

        <button id="save" type="button" class="btn btn-green me-1 mb-5 waves-effect waves-float waves-light">
            Зберегти
        </button>
    </div>

    <div class="mx-2" id="data_tab_2" style="display: none">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Особисті дані</h4>
            </div>
            <div class="card-body my-25">
                <!-- header section -->

                <div class="d-flex">
                    <a href="#" class="me-25">
                        <img src="{{asset('assets/icons/empty-company.svg') }}" id="company-upload-img2"
                             class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">
                    </a>
                    <!-- upload and reset button -->
                    <div class="d-flex align-items-end mb-1 ms-1">
                        <div>
                            <label for="company-upload2"
                                   class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                            <input type="file" id="company-upload2" name="avatar" hidden=""
                                   accept="image/jpeg, image/png, image/gif">
                            <button type="submit" id="company-reset2"
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

                        <div class="col-12 col-sm-12 mb-1">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="3PLOperator">
                                <label class="form-check-label">3PL Оператор</label>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="edrpou">ЄДРПОУ</label>
                            <input type="text" class="form-control" id="edrpou" name="edrpou" required
                                   placeholder="0000000" data-msg="Please enter first name">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="email_2">Емейл</label>
                            <input type="email" class="form-control" id="email_2" name="email" required
                                   data-msg="Please enter last name" placeholder="example@gmail.com">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="company_name">Назва компанії</label>
                            <input type="text" class="form-control" id="company_name" name="patronymic" required
                                   placeholder="Вкажіть назву компанії" data-msg="Please enter patronymic">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="fp-default select2-hide-search">Вид юридичної особи</label>
                            <select class="hide-search form-select" id="legal_entity"
                                    data-placeholder="Виберіть вид юридичної особи">
                                <option value=""></option>
                                @foreach($legalTypes as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div id="private-data-message2"></div>

                    </div>
                </div>
                <!--/ form -->
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Фактична адреса</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label" for="select2-hide-search">Країна</label>
                            <select class="select2 form-select" id="country_2" data-placeholder="Виберіть країну">
                                <option value=""></option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label" for="select2-hide-search">Населений пункт</label>
                            <select class="select2 form-select" id="city_2" data-placeholder="Виберіть населений пункт">
                                <option value=""></option>
                                @foreach($settlements as $settlement)
                                    <option value="{{$settlement->id}}">{{$settlement->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label" for="select2-hide-search">Вулиця / Проспект</label>
                            <select class="select2 form-select" id="street_2"
                                    data-placeholder="Виберіть вулицю / проспект">
                                <option value=""></option>
                                @foreach($streets as $street)
                                    <option value="{{$street->id}}">{{$street->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="code">Номер будинку</label>
                        <input type="text" class="form-control" id="building_number_2" name="buidling_number" required
                               autocomplete="off" placeholder="Вкажіть номер будинку">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="code">Квартира</label>
                        <input type="text" class="form-control" id="flat_2" name="flat" required autocomplete="off"
                               placeholder="Вкажіть номер квартири">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="code">GLN</label>
                        <input type="text" class="form-control" id="gln_2" name="gln" required autocomplete="off"
                               placeholder="0000000000000">
                    </div>

                    <div id="address-message2"></div>
                </div>

            </div>

        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Юридична Адреса</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label" for="u_country">Країна</label>
                            <select class="select2 form-select" id="u_country" data-placeholder="Виберіть країну">
                                <option value=""></option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label" for="u_city select2-hide-search">Населений пункт</label>
                            <select class="select2 form-select" id="u_city" data-placeholder="Виберіть населений пункт">
                                <option value=""></option>
                                @foreach($settlements as $settlement)
                                    <option value="{{$settlement->id}}">{{$settlement->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label" for="u_street select2-hide-search">Вулиця / Проспект</label>
                            <select class="select2 form-select" id="u_street"
                                    data-placeholder="Виберіть вулицю / проспект">
                                <option value=""></option>
                                @foreach($streets as $street)
                                    <option value="{{$street->id}}">{{$street->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="u_building_number">Номер будинку</label>
                        <input type="text" class="form-control" id="u_building_number" name="buidling_number" required
                               autocomplete="off" placeholder="Вкажіть номер будинку">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="code">Квартира</label>
                        <input type="text" class="form-control" id="u_flat" name="flat" required autocomplete="off"
                               placeholder="Вкажіть номер квартири">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="code">GLN</label>
                        <input type="text" class="form-control" id="u_gln" name="gln" required autocomplete="off"
                               placeholder="0000000000000">
                    </div>

                    <div id="u-address-message"></div>
                </div>

            </div>

        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Реквізити</h4>
            </div>


            <div class="card-body my-25">


                <div class="row">

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="passwordEmail">Банк</label>
                        <input type="text" class="form-control" id="bank_2" placeholder="Вкажіть назву банка" required>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="passwordEmail">IBAN</label>
                        <input type="text" class="form-control" id="iban_2" placeholder="UA000000000000000000000000000"
                               required>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="passwordEmail">МФО</label>
                        <input type="text" class="form-control" placeholder="000000" id="mfo_2" required>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <div class="mb-1">
                            <label class="form-label"
                                   for="select2-hide-search">Валюта</label>
                            <select class="select2 form-select" id="currency_u"
                                    data-placeholder="Виберіть валюту">
                                <option value=""></option>
                                <option value="UAH">UAH</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="ZLT">ZLT</option>
                            </select>
                        </div>
                    </div>

                    <div id="requisite-message2"></div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header justify-content-normal">
                <h4 class="card-title">Платник ПДВ</h4>
                <input type="checkbox" class="form-check-input" id="pdv">
            </div>

            <div class="card-body my-25">

                <div class="row">

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="passwordEmail">Номер ІПН</label>
                        <input type="text" class="form-control" id="ipn_2" placeholder="000000000" disabled>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label for="  formFileMultiple" class="form-label">Свідоцтво реєстрації</label>
                        <input class="form-control" type="file" id="reg_doc" disabled>
                    </div>

                    <div class="col-12 offset-sm-6 col-sm-6 mb-1">
                        <label for="formFileMultiple" class="form-label">Установчі документи</label>
                        <input class="form-control" type="file" id="ust_doc" disabled>
                    </div>

                    <div id="pdv-message"></div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Про компанію</h4>
            </div>
            <div class="card-body my-25">
                <div class="row">
                    <div class="col-12 col-sm-6 mb-1">
                        <textarea class="form-control" id="about_2" rows="5"
                                  placeholder="Напишіть короткий опис про компанію"></textarea>
                    </div>

                    <div id="about_company_message_2"></div>
                </div>
            </div>
        </div>

        <button id="save_2" type="button" class="btn btn-green me-1 mb-5 waves-effect waves-float waves-light">
            Зберегти
        </button>
    </div>

@endsection
@section('page-script')
    <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/company.js')}}"></script>

    <script>

    </script>
@endsection
