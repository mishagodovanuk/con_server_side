@extends('layouts.admin')
@section('title','')
@section('page-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/css/intlTelInput.css"/>
    <script src="{{asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js'))}}"></script>

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.0/cropper.min.css"
          integrity="sha512-gNSHyKCA9X3fCDdTd5UxyNaSznSyGtR9pwf5YwSp7haDRz6Gqor0nY20POCYLseXq5n/FGAEogNp7G0d56d3jg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <style>
        .label {
            cursor: pointer;
        }

        .progress {
            display: none;
            margin-bottom: 1rem;
        }

        .alert {
            display: none;
        }

        .img-container img {
            max-width: 100%;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid d-none" id="create-company-page">
        <!-- контейнер з навігацією  -->
        <div class="px-2 mb-1 ">
            <div class="d-flex justify-content-between ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/company" style="color: #4B465C;">Компанії</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Додавання нової
                            компанії
                        </li>

                    </ol>
                </nav>
                <div class="d-flex justify-content-between  ">
                    <button class="btn btn-flat-secondary float-start mr-1 " id="link-to-search-page"> Скасувати
                    </button>

                    <button id="save" type="button" class="btn btn-primary saveBtn-1">
                        Зберегти
                    </button>
                    <button id="save_2" type="button" class="btn btn-primary d-none saveBtn-2">
                        Зберегти
                    </button>
                </div>

            </div>

        </div>

        <div class="d-flex mx-2">
            <div class="card radio-card tab-active tabsActiveStatus tab1 ">
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
            <div class="card radio-card tabsActiveStatus tab2" style="margin-left: 35px">
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
                    <h4 class="card-title">Основні дані</h4>
                </div>
                <div class="card-body my-25">
                    <!-- header section -->

                    {{--                    <div class="d-flex">--}}
                    {{--                        <label class="label" data-toggle="tooltip" title="Change your avatar">--}}
                    {{--                            <img src="{{asset('assets/icons/empty-company.svg') }}" id="avatar"--}}
                    {{--                                 class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">--}}
                    {{--                            <input type="file" class="sr-only" id="input" name="image" accept="image/*">--}}
                    {{--                        </label>--}}
                    {{--                        <!-- upload and reset button -->--}}
                    {{--                        <div class="d-flex align-items-end mb-1 ms-1">--}}
                    {{--                            <div>--}}
                    {{--                                <label for="company-upload1-cropper"--}}
                    {{--                                       class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>--}}
                    {{--                                <input type="file" id="company-upload1-cropper" name="avatar" hidden=""--}}
                    {{--                                       accept="image/jpeg, image/png, image/gif">--}}


                    {{--                                <button type="submit" id="company-reset"--}}
                    {{--                                        class="btn btn-sm btn-outline-secondary mb-75 waves-effect">Видалити--}}
                    {{--                                </button>--}}
                    {{--                                <p class="mb-0">Формати JPG, GIF або PNG</p>--}}
                    {{--                                <p class="mb-0">Розмір не більше 800kB </p>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}

                    {{--                        <!--/ upload and reset button -->--}}
                    {{--                    </div>--}}

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
                    {{--                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"--}}
                    {{--                         aria-hidden="true">--}}
                    {{--                        <div class="modal-dialog" role="document">--}}
                    {{--                            <div class="modal-content">--}}
                    {{--                                <div class="modal-header">--}}
                    {{--                                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>--}}
                    {{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--                                        <span aria-hidden="true">&times;</span>--}}
                    {{--                                    </button>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="modal-body">--}}
                    {{--                                    <div class="img-container">--}}
                    {{--                                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="modal-footer">--}}
                    {{--                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel--}}
                    {{--                                    </button>--}}
                    {{--                                    <button type="button" class="btn btn-primary" id="crop">Crop</button>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

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
                                       oninput="limitInputToNumbers(this,10)"
                                       placeholder="0000000000">
                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="email">e-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                       placeholder="example@gmail.com">
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
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-title">Адреса</h4>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="select2-hide-search">Країна</label>
                                <select class="select2 form-select" id="country" id="select2-hide-search" data-dictionary="country"
                                        data-placeholder="Виберіть країну">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="select2-hide-search">Населений пункт</label>
                                <select class="select2 form-select" id="city" data-dictionary="settlement"
                                        data-placeholder="Виберіть населений пункт">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="select2-hide-search">Вулиця/Проспект</label>
                                <select class="select2 form-select" id="street" data-dictionary="street"
                                        data-placeholder="Виберіть вулицю/ проспект">
                                    <option value=""></option>
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
                                   oninput="limitInputToNumbers(this,13)"
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
                            <input type="text" class="form-control" id="bank" placeholder="Вкажіть назву банка"
                                   required>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="iban">IBAN</label>
                            <input type="text" class="form-control" id="iban"
                                   placeholder="UA000000000000000000000000000" oninput="maskNumbersPlusLatin(this,29)"
                                   required>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="mfo">МФО</label>
                            <input type="text" class="form-control" id="mfo" required placeholder="000000"
                                   oninput="limitInputToNumbers(this,6)">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="select2-hide-search">Валюта</label>
                                <select class="select2 form-select" id="currency" data-dictionary="currencies" data-placeholder="Виберіть валюту">
                                    <option value=""></option>

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


        </div>

        <div class="mx-2" id="data_tab_2" style="display: none">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Основні дані</h4>
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
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="company_name">Назва компанії</label>
                                <input type="text" class="form-control" id="company_name" name="patronymic" required
                                       placeholder="Вкажіть назву компанії" data-msg="Please enter patronymic">
                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="fp-default select2-hide-search">Тип юридичної
                                    особи</label>
                                <select class="hide-search form-select" id="legal_entity"
                                        data-placeholder="Виберіть тип юридичної особи">
                                    <option value=""></option>
                                    @foreach($legalTypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="edrpou">ЄДРПОУ</label>
                                <input type="text" class="form-control" id="edrpou" name="edrpou" required
                                       oninput="limitInputToNumbers(this,8)"
                                       placeholder="0000000" data-msg="Please enter first name">
                            </div>

                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="email_2">e-mail</label>
                                <input type="email" class="form-control" id="email_2" name="email" required
                                       data-msg="Please enter last name" placeholder="example@gmail.com">
                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="select2-hide-search">Категорія компанії</label>
                                    <select class="hide-search form-select" id="company_category" data-dictionary="company_category"  data-placeholder="Вкажіть категорію вашої компанії">
                                        <option value=""></option>
                                    </select>
                            </div>


                            <div id="private-data-message2"></div>

                        </div>
                    </div>
                    <!--/ form -->
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
                            <label class="form-label" for="ipn_2">Номер ІПН</label>
                            <input type="text" class="form-control" id="ipn_2" placeholder="000000000" disabled
                                   oninput="limitInputToNumbers(this,10)">

                        </div>


                        <div class="col-12 col-sm-6 mb-1">
                            <label for="reg_doc" class="form-label">Свідоцтво реєстрації</label>
                            <div class="input-group">
                                <input class="form-control" type="file" id="reg_doc" disabled>
                                <button class="btn btn-outline-primary input-group-btn disabled-btn-c" disabled
                                        id="reg_doc-reset" type="button"><i data-feather="x"></i></button>
                            </div>
                        </div>

                        <div class="col-12 offset-sm-6 col-sm-6 mb-1">
                            <label for="ust_doc" class="form-label">Установчі документи</label>
                            <div class="input-group">
                                <input class="form-control" type="file" id="ust_doc" disabled>
                                <button class="btn btn-outline-primary input-group-btn disabled-btn-c" disabled
                                        id="ust_doc-reset" type="button"><i data-feather="x"></i></button>
                            </div>
                        </div>


                        <div id="pdv-message"></div>
                    </div>
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
                                <select class="select2 form-select" id="country_2" data-dictionary="country" data-placeholder="Виберіть країну">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="select2-hide-search">Населений пункт</label>
                                <select class="select2 form-select" id="city_2" data-dictionary="settlement"
                                        data-placeholder="Виберіть населений пункт">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="select2-hide-search">Вулиця / Проспект</label>
                                <select class="select2 form-select" id="street_2" data-dictionary="street"
                                        data-placeholder="Виберіть вулицю / проспект">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="code">Номер будинку</label>
                            <input type="text" class="form-control" id="building_number_2" name="buidling_number"
                                   required
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
                                   oninput="limitInputToNumbers(this,13)"
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
                        <div class="col-12 mb-1">
                            <input class="form-check-input" type="checkbox" id="matchingAddress" value="unchecked"/>
                            <label class="form-check-label" for="matchingAddress">Співпадає з фактичною адресою</label>
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="u_country">Країна</label>
                                <select class="select2 form-select" id="u_country" data-dictionary="country" data-placeholder="Виберіть країну">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="u_city select2-hide-search">Населений пункт</label>
                                <select class="select2 form-select" id="u_city" data-dictionary="settlement"
                                        data-placeholder="Виберіть населений пункт">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="u_street select2-hide-search">Вулиця / Проспект</label>
                                <select class="select2 form-select" id="u_street" data-dictionary="street"
                                        data-placeholder="Виберіть вулицю / проспект">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="u_building_number">Номер будинку</label>
                            <input type="text" class="form-control" id="u_building_number" name="buidling_number"
                                   required
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
                                   oninput="limitInputToNumbers(this,13)"
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
                            <label class="form-label" for="bank_2">Банк</label>
                            <input type="text" class="form-control" id="bank_2" placeholder="Вкажіть назву банка"
                                   required>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="iban_2">IBAN</label>
                            <input type="text" class="form-control" id="iban_2"
                                   placeholder="UA000000000000000000000000000" oninput="maskNumbersPlusLatin(this,29)"
                                   required>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="mfo_2">МФО</label>
                            <input type="text" class="form-control" placeholder="000000" id="mfo_2" required
                                   oninput="limitInputToNumbers(this,6)">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <div class="mb-1">
                                <label class="form-label" for="select2-hide-search">Валюта</label>
                                <select class="select2 form-select" id="currency_u" data-dictionary="currencies" data-placeholder="Виберіть валюту">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div id="requisite-message2"></div>
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


        </div>
    </div>

    <!-- модал верифікації компанії -->

    <div class="modal fade" id="verificationRequest" tabindex="-1" aria-labelledby="verificationRequest"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 737px">
            <div class=" modal-content" style="padding: 67px">
                <h2 class="text-center mb-2">Запит на верифікацію</h2>
                <p class="fw-semibold mb-2">Дані які нам необхідно верифікувати</p>
                <div id="data-in-verificationModal"></div>

                <div class="mb-1 d-flex align-items-center">
                    <p class="mr-1 my-0"> Свідоцтва реєстрації:</p>
                    <div class="fw-bold d-flex align-items-center gap-1">
                        <img src="{{asset('assets/icons/file-upload.svg')}}" alt="file-upload">
                        <a class="link-secondary text-decoration-underline" download href="3"> file_example.pdf </a>
                    </div>
                </div>
                <div class="mb-1 d-flex align-items-center">
                    <p class="mr-1 my-0">Установчі документи:</p>
                    <div class="fw-bold d-flex align-items-center gap-1">
                        <img src="{{asset('assets/icons/file-upload.svg')}}" alt="file-upload">
                        <a class="link-secondary text-decoration-underline" download href="3"> file_example.pdf </a>
                    </div>
                </div>
                <div class="rounded p-1 my-2 titlesStatus" style="background-color: #F1F1F2">
                    <p class="m-0 p-0 title-1">Верифікація даних може зайняти від кількох годин до 3-х робочих днів. Як
                        тільки буде прийнято рішення про верифікацію вам прийде повідомлення, і на сторінці компанії ви
                        зможете продивитись детальну інформацію про результат верифікації </p>

                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">

                        Скасувати
                    </button>
                    <a class="btn btn-primary" href="/company">
                        Надіслати запит</a>
                </div>

            </div>
        </div>
    </div>

    <!-- Search company -->
    <div class="container-fluid px-3 " id="search-company-page">
        <!-- контейнер з навігацією  -->
        <div class="d-flex justify-content-between flex-column  flex-sm-column flex-md-row flex-lg-row flex-xxl-row">
            <div class=" pb-1 pt-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/company" style="color: #4B465C;">Компанії</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Додати компанію
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!-- = -->
        <!--  контейнер пошук компанії -->
        <div class="card p-1 pt-2 mx-auto my-auto " id="find-company" style="max-width: 916px; min-height: 675px;">

            <div class="row mx-0 h-100 justify-content-between flex-column">

                <div class="col-md-12 col-12">
                    <div class="col-12 ">
                        <h2 class="mb-2 fw-bolder">Додати компанію</h2>
                        <p class=" col-sm-12 col-lg-9 col-md-9">
                            Якщо компанія вже зареєстрована в CONSOLID введіть її назву, ЄДРПОУ, ІПН або
                            країну
                            реєстрації в пошуку та виберіть зі списку або створіть нову компанію.
                        </p>

                    </div>

                    <div class="col-md-12 col-12 mb-1">
                        <div class="input-group inpSelectCountry ">
                            <input id="searchCompanyInpCountry" type="text" class="form-control "
                                   placeholder="Вкажіть назву, ЄДРПОУ, ІПН або країну реєстрації"
                                   aria-describedby="button-addon2"/>

                            <button class="btn btn-outline-primary" id="searchCompanyButton" type="button">
                                <i style="margin-right: 10px" data-feather='search'></i> Шукати
                            </button>
                        </div>
                    </div>

                    <div id="searchCompanyResult" class="col-12 col-sm-12 ">
                        <div class="d-flex flex-column align-items-center justify-content-center" style="height: 414px">

                            <div id="findCompany" class="d-flex flex-column align-items-center justify-content-center">
                                <img src="{{asset('assets/icons/onboarding-search.svg')}}">
                                <h4 class="fw-bolder">Знайдіть компанію</h4>
                                <p class="text-secondary text-center" style="max-width: 390px; opacity: 0.7!important;">
                                    Введіть в пошуку назву
                                    компанії, ЄДРПОУ або ІПН
                                </p>
                            </div>

                            <div id="notFoundCompany"
                                 class="d-none d-flex flex-column align-items-center justify-content-center">
                                <img src="{{asset('assets/icons/onbording-search-question.svg')}}">
                                <h4 class="fw-bolder">За вашим запитом нічого не знайдено</h4>
                                <p class="text-secondary text-center" style="max-width: 390px; opacity: 0.7!important;">
                                    Перевірте правильність
                                    вказаних данних або
                                    створіть нову компанію</p>
                            </div>

                            <button class="btn btn-primary float-end mt-1 d-none" id="create-new-company" type="button"
                                    data-bs-toggle="modal" data-bs-target="#statusCompany">
                                <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">
                                Створити
                                нову
                                компанію
                            </button>

                        </div>
                    </div>

                    <div id="listFindCompany" class="col-12 col-sm-12 d-none ">
                        <p id="countCompanyItem" class="mb-0">Найдено X результати</p>
                        <div class="d-flex flex-column" style="height: 400px; overflow-y: auto; margin-bottom: 10px;">
                            <div class="row mx-0" id="listItemCompany"></div>
                        </div>
                    </div>


                </div>


                <div class="col-12 col-sm-12 d-flex justify-content-end align-items-center">
                    <p id="onbording-link-proposition" class="p-0 m-0 d-none"> Не знайшли свою компанію? <a
                            data-bs-toggle="modal" data-bs-target="#statusCompany" href="#">Створити нову</a></p>
                </div>

            </div>


        </div>

        <!-- контейнер з вибраною компанією -->
        <div class="card p-1 pt-2 mx-auto my-auto  d-none chosen-company" id="send-join"
             style="max-width: 916px; height: 675px;">

            <div class="row mx-0 h-100 justify-content-between flex-column">
                <div class="">
                    <div class="col-12 ">
                        <h2 class="mb-2">Додати компанію</h2>
                        <p class=" col-sm-12 col-lg-9 col-md-9">
                            Ця компанія вже знаходить в робочому средовищі. Ви можете надіслати запит на долучення до
                            цього
                            робочого середовища.
                        </p>

                    </div>
                    <div class="col-12 col-sm-12 ">
                        <div class="d-flex flex-column" style="max-height: 476px; overflow-y: auto">
                            <div class="row mx-0">
                                <a class="col-12 px-0 border onboarding-item-company mt-1" style="border-radius: 6px"
                                   id="request-company-card">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 d-flex justify-content-between align-items-center">
                    <button class="btn btn-flat-secondary float-start" id="back-find-company-2"
                            style="padding-top:10px!important ;padding-bottom:10px!important ;">
                        <img style="margin-right: 0.5rem" src="{{asset('assets/icons/arrow-left.svg')}}">
                        Назад
                    </button>
                    <button class="btn btn-primary" id="add-to-company-list"><i data-feather="plus" class="mr-1"></i>
                        Додати до списку компаній
                    </button>
                </div>

            </div>


        </div>


    </div>


    <!-- модал статус компанії -->
    <div class="modal fade" id="statusCompany" tabindex="-1" aria-labelledby="statusCompany" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md ">
            <div class="modal-content p-3 border">


                <h2 class="text-center mb-1">Статус компанії</h2>
                <p>Для продовження оберіть, яке відношення до вас має створювана компанія</p>
                <div class="d-flex " id="statusCompanyCheckboxes">
                    <div class="form-check mr-2">
                        <input class="form-check-input" type="radio" name="checkStatusCompany" id="myCompanyCheck"
                               checked>
                        <label class="form-check-label" for="myCompanyCheck">
                            Моя компанія
                        </label>
                    </div>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="checkStatusCompany" id="contractorCheck">
                        <label class="form-check-label" for="contractorCheck">
                            Контрагент
                        </label>
                    </div>
                </div>
                <div class="rounded p-1 my-2 titlesStatus" style="background-color: #F1F1F2">
                    <p class="m-0 p-0 title-1">Після створення своєї компанії, для неї необхідно буде пройти верифікацію
                    </p>
                    <p class="d-none m-0 p-0 title-2">При створенні контрагента ви не матимете прав адміністратора у цій
                        компанії</p>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">

                        Скасувати
                    </button>
                    <a class="btn btn-primary" href="#" id="link-to-create-page" data-bs-dismiss="modal"
                       aria-label="Close">
                        Продовжити</a>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/js/intlTelInput.min.js"></script>
    <script src="{{asset('assets/js/entity/company/search-company.js')}}"></script>
    <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/entity/company/company.js')}}"></script>
    {{--    <script src="{{asset('assets/js/utils/cropper.js')}}"></script>--}}

    <script>
        $(document).ready(function () {
            $('#link-to-create-page').on('click', function () {
                $('#create-company-page').removeClass('d-none');
                $('#search-company-page').addClass('d-none');
            });

            $('#link-to-search-page').on('click', function () {
                $('#search-company-page').removeClass('d-none');
                $('#create-company-page').addClass('d-none');
            });

        });

    </script>

    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>--}}
    {{--    --}}

@endsection
