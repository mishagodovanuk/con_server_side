@extends('layouts.admin')
@section('title','Створення контракту')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
@endsection

@section('content')
    <div class="mb-2 mx-2 px-0">
        <!-- навігація з кнопками та діями головними -->
        <div class=" d-flex justify-content-between align-items-center">
            <div class="">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/contracts" style="color: #4B465C;">Договори</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Створення нового договору
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="contract-actions d-flex align-items-center gap-2">
                <div>
                    <div class="btn-group d-flex  gap-1">
                        <button class="btn btn-flat-secondary rounded" disabled id="btn-reject" href="#">
                            Скасувати
                        </button>
                        <button class="btn btn-primary rounded" disabled id="btn-save" href="#">Зберегти</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- контент -->
        <div class="row mx-0 mt-2 ">
            <div class="col-12 col-md-12 col-lg-5 pe-0 ps-0">
                <div class="card p-2 mb-1">
                    <h4 class="card-title fw-bolder pt-0 ">Договір за порядком в таблиці №{{$contractId}}</h4>
                    <div class="row mb-1">
                        <div class="col-7">
                            <label class="form-label" for="typeContract">Тип договору</label>
                            <select class="select2 form-select" name="typeContract" id="typeContract"
                                    data-placeholder="Оберіть тип договору">
                                <option value=""></option>
                                <option value="0">Договір на торгові послуги</option>
                                <option value="1">Договір на складські послуги</option>
                                <option value="2">Договір на транспортні послуги</option>
                            </select>
                        </div>
                        <div class="col-5 ps-0">
                            <label class="form-label" for="side">Сторона</label>
                            <select class="select2 form-select" name="side" id="side" data-placeholder="Замовник">
                                <option value=""></option>
                                <option value="0">Замовник</option>
                                <option value="1">Постачальник</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="yourCompany">Ваша компанія</label>
                        <select class="select2 form-select" name="yourCompany" id="yourCompany"
                                data-placeholder="Оберіть компанію">
                            <option value=""></option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="contractor">Контрагент</label>
                        <select class="select2 form-select" name="contractor" id="contractor"
                                data-placeholder="Оберіть компанію">
                            <option value=""></option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1 position-relative">
                        <label class="form-label" for="validityPeriod">Термін дії договору до</label>
                        <input type="text" id="validityPeriod" class="form-control flatpickr-basic flatpickr-input"
                               required
                               placeholder="Вкажіть дату закінчення договору" name="group" readonly="readonly">
                        <span class="cursor-pointer text-secondary position-absolute top-50"
                              style="right : 27px;pointer-events: none;"><i data-feather="calendar"></i></span>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" id="contractSigned"/>
                        <label class="form-check-label" for="contractSigned">Договір вже підписано</label>
                    </div>
                    <div class="mb-1 position-relative">
                        <label class="form-label" for="dateSigningContract">Дата підписання договору</label>
                        <input type="text" id="dateSigningContract" class="form-control flatpickr-basic flatpickr-input"
                               required placeholder="Вкажіть дату підписання договору" name="group" readonly="readonly">
                        <span class="cursor-pointer text-secondary position-absolute top-50"
                              style="right : 27px;pointer-events: none;"><i data-feather="calendar"></i></span>
                    </div>
                    <div class="">
                        <label class="form-label" for="fileInput">Завантажити файли договору</label>
                        <input type="file" class="form-control" id="fileInput">
                    </div>
                </div>
            </div>


            <div class="col-12  col-lg-6 pe-0 ps-lg-1 ps-0 " style="flex-grow: 1;">
                <div class="col-xl-12 col-lg-12 h-100">
                    <div class="card h-100">
                        <div class="ps-2 pt-2">
                            <h4 class="fw-bolder">Регламенти</h4>
                        </div>
                        <div class="contract-view-tables h-100">
                            <!-- початкові умови -->
                            <div id="initialConditions" class="d-none h-100">
                                <hr>
                                <div class="h-100 d-flex flex-column justify-content-center px-2">
                                    <h4 class="text-center fw-bolder">Для початку оберіть тип договору і вашу
                                        сторону</h4>
                                    <p class="mb-0 text-center">Після цього ви зможете обрати регламент для договору</p>
                                </div>
                            </div>

                            <!-- відсутні регламенти -->
                            <div id="missingRegulations" class="d-none h-100">
                                <hr>
                                <div class="h-100 d-flex flex-column align-items-center justify-content-center px-2">
                                    <h4 class="fw-bolder">Немає доступних регламентів</h4>
                                    <p class="text-center">
                                        Створіть регламенти для “Договір на <span id="missingRegulationsTitleType">шаблон</span>
                                        послуги” <br>
                                        для сторони “<span id="missingRegulationsTitleSide">Шаблон</span>”
                                    </p>
                                    <button id="create-regulation-missing" type="button" data-bs-toggle="modal"
                                            data-bs-target="#createNewRegulationModal" class="btn btn-outline-primary">
                                        <i data-feather="plus" class="me-25"></i>
                                        <span>Створити регламент</span>
                                    </button>

                                </div>
                            </div>

                            <!-- регламенти -->
                            <div id="retail-list-regulations" class="d-none h-100">
                                <div class="p-2 pb-0 mb-2">
                                    <h2 class="f-15 fw-bolder mb-1">
                                        <span id="retail-list-regulations-type-text">Шаблон</span> регламенти
                                        (<span id="retail-list-regulations-side">Шаблон</span>)
                                    </h2>
                                    <div class="input-group input-group-merge mb-2" style="max-width: 350px">
                                        <span class="input-group-text"><i data-feather="search"></i></span>
                                        <input type="text" class="form-control ps-2" placeholder="Пошук"
                                               id="search-retail-regulation"/>
                                    </div>
                                </div>

                                <hr class="mb-0">
                                <ul class="container-for-market-list list-s-none">

                                </ul>
                            </div>

                            <!-- один регламент-->
                            <div id="one-retail-regulation" class="d-none h-100">
                                <div class="p-2 pb-0 d-flex justify-content-between align-items-center"
                                     style="height: 60px">
                                    <h2 class="f-15 fw-bolder">
                                        <a href="#" class="text-black"
                                           id="link-to-back-retail-list">
                                            <i data-feather="arrow-left" class="me-25 cursor-pointer"></i>
                                        </a>
                                        <span id="one-regulation-name">
                                            Для магазинів
                                        </span>

                                        <span>
                                           (<span id="one-regulation-side-regulation">Шаблон</span> послуг)
                                        </span>

                                    </h2>
                                    <button class="d-none btn btn-outline-primary btn-sm" id="btn-cancel-changes">
                                        Відмінити
                                        зміни
                                    </button>
                                </div>
                                <hr class="mb-0">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header  px-1" id="">
                                            <button class="accordion-button fw-bolder f-15" style="color:#4B465C;"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#accordionOne"
                                                    aria-expanded="true" aria-controls="accordionOne">
                                                1. Назва і батьківський регламент
                                            </button>
                                        </h2>
                                        <div id="accordionOne" class="accordion-collapse collapse show"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body px-2 ps-3">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <input type="text" class="form-control" id="nameRetail" required
                                                               placeholder="Введіть назву регламенту">
                                                    </div>
                                                    <div class="col-12 col-sm-6 mb-1">
                                                        <div class="mb-1">
                                                            <select class="select2 form-select" id="parentRegulation"
                                                                    data-placeholder="Батьківський регламент">
                                                                <option value=""></option>
                                                                <option value="parent">Батьківський регламент</option>
                                                                @foreach($regulations as $regulation)
                                                                    <option
                                                                            value="{{$regulation->id}}">{{$regulation->name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item ">
                                        <h2 class="accordion-header  px-1" id="">
                                            <button class="accordion-button fw-bolder f-15" style="color:#4B465C;"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#accordionTwo"
                                                    aria-expanded="true" aria-controls="accordionTwo">
                                                2. Налаштування регламенту
                                            </button>
                                        </h2>
                                        <div id="accordionTwo" class="accordion-collapse collapse"
                                             aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body px-2 ">


                                                <div
                                                        class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                    <p class="f-15 m-0" style="color: #A5A3AE;">Тип палет
                                                    </p>
                                                    <div style="width: 260px">
                                                        <select class="select2 form-select" id="typePallet"
                                                                data-placeholder="Тип палет">
                                                            <option value=""></option>
                                                            @foreach($typePallets as $key => $value)
                                                                <option value="{{$key}}">{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div
                                                        class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                    <p class="f-15 m-0" style="color: #A5A3AE;">Висота палет
                                                    </p>
                                                    <div class="input-group" style="width: 260px">
                                                        <input type="number" class="form-control" id="heightPallet">
                                                        <span class="input-group-text">см</span>
                                                    </div>


                                                </div>
                                                <div
                                                        class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                    <p class="f-15 m-0" style="color: #A5A3AE;">Залишковий
                                                        термін
                                                    </p>
                                                    <div class="input-group" style="width: 260px">
                                                        <input type="number" class="form-control" id="remainingTerm">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div
                                                        class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                    <p class="f-15 m-0" style="color: #A5A3AE;">Палетний лист
                                                    </p>
                                                    <div class="form-check form-switch"><input type="checkbox"
                                                                                               class="form-check-input"
                                                                                               id="palletLatter"></div>
                                                </div>
                                                <div
                                                        class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                    <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити збірні
                                                        палети
                                                    </p>
                                                    <div class="form-check form-switch"><input type="checkbox"
                                                                                               class="form-check-input"
                                                                                               id="allowPrefabricatedPallets">
                                                    </div>
                                                </div>
                                                <div
                                                        class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                    <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                        сендвіч-палету
                                                    </p>
                                                    <div class="form-check form-switch"><input type="checkbox"
                                                                                               class="form-check-input"
                                                                                               id="allowSendwichPallet">
                                                    </div>
                                                </div>
                                                <div
                                                        class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                    <p class="f-15 m-0" style="color: #A5A3AE;">Стікерування
                                                    </p>
                                                    <div class="form-check form-switch"><input type="checkbox"
                                                                                               class="form-check-input"
                                                                                               id="labeling"></div>
                                                </div>
                                                <div
                                                        class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                    <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити проведення
                                                    </p>
                                                    <div class="form-check form-switch"><input type="checkbox"
                                                                                               class="form-check-input"
                                                                                               id="allowCondacting">
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
        </div>

    </div>

    <!-- amendments to the regulations-->
    <div class="modal fade" id="amendedChangesModal" tabindex="-1" aria-labelledby="amendedChangesModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 580px">

            <div class=" modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="p-4 pt-2">
                    <h2 class="mb-0 mt-0 text-center fw-bolder">Внесено зміни до регламенту</h2>
                    <div class="p-2">
                        <p class="mb-1 text-start">Ви внесли зміни в цей регламент при додаванні до цього договору.
                            Бажаєте
                            оновити
                            цей регламент, або створити новий тип?</p>
                    </div>
                    <form class="d-flex justify-content-end" method="" action="#">
                        <a class="btn btn-outline-primary mr-2 text-primary" data-bs-toggle="modal"
                           data-bs-target="#createNewRegulationModal" id="btn-create-new-regulation-in-modal">
                            Створити новий регламент
                        </a>
                        <button type="button" class="btn btn-primary" id="update-regulation">
                            Оновити
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- create new regulation-->
    <div class="modal fade" id="createNewRegulationModal" tabindex="-1" aria-labelledby="createNewRegulationModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 580px">

            <div class=" modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="p-4 pt-2">
                    <h2 class="mb-1 mt-0 text-center  fw-bolder">Створення нового регламенту</h2>
                    <p class="mb-1 text-center">Вкажіть назву і за потреби оберіть батьківський регламент</p>
                    <form class=" pt-2" method="" action="#">
                        <div class="mb-1"><label class="form-label" for="nameRetailInModal">Назва регламенту </label>
                            <input type="text" class="form-control" id="nameRetailInModal" required
                                   placeholder="Вкажіть назву">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="parentRegulationInModal">Батьківський регламент (за потреби)
                            </label>
                            <select class="select2 form-select" name="parentRegulationInModal"
                                    id="parentRegulationInModal"
                                    data-placeholder="Оберіть батьківський регламент">
                                <option value=""></option>
                                <option selected value="parent">Батьківський регламент</option>
                                @foreach($regulations as $regulation)
                                    <option value="{{$regulation->id}}">{{$regulation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary " id="create-regulation">
                                Створити
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>

    <script type="module" src="{{asset('assets/js/entity/contract/contract-create.js')}}"></script>

@endsection
