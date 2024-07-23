@extends('layouts.admin')
@section('title','Контроль залишків')
@section('page-style')
@endsection
@section('before-style')
    <script src="{{asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js'))}}"></script>


    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">
@endsection

@section('content')
    <div class="container-fluid px-3">
        <div class="row" style="column-gap: 144px">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xxl-3 px-0"
                 style="min-width: 208px; max-width: fit-content">
                @include('layouts.setting')
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xxl-9 px-0" style="max-width: 798px">
                <div class="tab-content card pb-0">

                    <div role="tabpanel" class="tab-pane mb-0 active" id="vertical-pill-4"
                         aria-labelledby="stacked-pill-4"
                         aria-expanded="true">
                        <div id="all-rule">
                            <div class="p-2 pb-50 d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="fw-bolder mb-0">
                                        Правила проведення
                                    </h4>
                                    <p class="fs-5 mt-50">Умови при яких накладні не будуть проводитися</p>
                                </div>
                                <button class="btn btn-outline-primary" id="createNewRules">Створити правило</button>
                            </div>

                            <div class="p-2 pt-0 d-flex justify-content-between align-items-center">
                                <div class="col-6">
                                    <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon-search2"><i
                                            data-feather="search"></i></span>
                                        <input type="text" class="form-control ps-1" placeholder="Пошук"
                                               aria-label="Search..."
                                               aria-describedby="basic-addon-search2" id="searchTypeRules"/>
                                    </div>
                                </div>

                                <button data-bs-toggle="dropdown" id="filter-rule-button"

                                        href="javascript:void(0);"
                                        class="btn btn-flat-secondary dropdown-toggle">
                                    Фільтри
                                </button>

                                <div id="filterDropdown" class="dropdown-menu dropdown-menu-end mt-2"
                                     aria-labelledby="filter-rule-button">
                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 460px!important;">
                                        <div class="modal-content">
                                            <div class="card popup-card p-2">
                                                <h4 class="fw-bolder">
                                                    Фільтри
                                                </h4>
                                                <div class="card-body row mx-0 p-0">

                                                    <p class="my-2 p-0"> Фільтрація по:
                                                    </p>

                                                    <div class="p-0 mb-2 d-flex justify-content-between"
                                                         id="radioFilterBlock">
                                                        <div class="form-check form-check-primary">
                                                            <input type="radio" id="radioTypeAllFilter"
                                                                   name="radioTypeAllFilter"
                                                                   class="form-check-input" checked/>
                                                            <label class="form-check-label" for="radioTypeAllFilter">Усім</label>
                                                        </div>

                                                        <div class="form-check form-check-primary ">
                                                            <input type="radio" id="radioTypeClientsFilter"
                                                                   name="radioTypeClientsFilter"
                                                                   class="form-check-input"/>
                                                            <label class="form-check-label"
                                                                   for="radioTypeClientsFilter">По типу клієнта</label>
                                                        </div>

                                                        <div class="form-check form-check-primary ">
                                                            <input type="radio" id="radioTypeSpecificClientsFilter"
                                                                   name="radioTypeSpecificClientsFilter"
                                                                   class="form-check-input"/>
                                                            <label class="form-check-label"
                                                                   for="radioTypeSpecificClientsFilter">По конкретному
                                                                клієнту</label>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-column col-12 mb-1 p-0"
                                                         id="filter-rule-type-block">
                                                        <label class="form-label mb-0 col-5"
                                                               for="select2-hide-search">Тип</label>
                                                        <div class="row mx-0 flex-grow-1 justify-content-end mt-50">
                                                            <div class="col-12 px-0">
                                                                <select class="select2 hide-search form-select"
                                                                        id="filter-rule-type"
                                                                        data-placeholder="Оберіть тип">
                                                                    <option value=""></option>
                                                                    <option value="1">Усі</option>
                                                                    <option value="2">Магазини</option>
                                                                    <option value="3">Дистрибʼютори</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-column   col-12 mb-1 p-0"
                                                         id="filter-rule-clients-block">
                                                        <label class="form-label mb-0 col-5"
                                                               for="select2-hide-search">Клієнт</label>
                                                        <div class="row mx-0 flex-grow-1 justify-content-end mt-50">
                                                            <div class="col-12 px-0">
                                                                <select class="select2 hide-search form-select"
                                                                        id="filter-rule-clients"
                                                                        data-placeholder="Оберіть клієнта">
                                                                    <option value=""></option>
                                                                    <option value="1">Усі</option>
                                                                    <option value="2">ПРАЙМ ТЕРРА ТОВ</option>
                                                                    <option value="3">Ярич</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-column  col-12 mb-1 p-0"
                                                         id="filter-rule-goods-block">
                                                        <label class="form-label mb-0 col-5"
                                                               for="select2-hide-search">Товар</label>
                                                        <div class="row mx-0 flex-grow-1 justify-content-end mt-50">
                                                            <div class="col-12 px-0">
                                                                <select class="select2 hide-search form-select"
                                                                        id="filter-rule-goods"
                                                                        data-placeholder="Оберіть товар">
                                                                    <option value=""></option>
                                                                    <option value="1">Усі</option>
                                                                    <option value="2">Печенька</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-column   col-12 mb-1 p-0"
                                                         id="filter-rule-status-block">
                                                        <label class="form-label mb-0 col-5"
                                                               for="select2-hide-search">Статус правил</label>
                                                        <div class="row mx-0 flex-grow-1 justify-content-end mt-50">
                                                            <div class="col-12 px-0">
                                                                <select class="select2 hide-search form-select"
                                                                        id="filter-rule-status"
                                                                        data-placeholder="Оберіть статус правила">
                                                                    <option value=""></option>
                                                                    <option value="1">Усі</option>
                                                                    <option value="2"> Тільки активні</option>
                                                                    <option value="3"> Тільки неактивні</option>
                                                                    <option value="4"> Тільки активні і неактивні
                                                                    </option>
                                                                    <option value="5"> Тільки архівовані</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 p-0 mt-1">
                                                        <div class="d-flex float-end gap-1">
                                                            <button id="cancelFilterRules" type="button"
                                                                    class="btn btn-flat-primary">Скинути
                                                                фільтри
                                                            </button>
                                                            <button id="submitFilterRules" class="btn btn-primary">
                                                                Застосувати
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div id="selected-type">
                                <div class="pt-0">
                                    <div class="card-body px-0 py-0">
                                        <div style="max-height: 445px; overflow-y: auto;">
                                            <div>
                                                <ul id="list-rule" class="list-group"></ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-none" id="create-rule">

                            <div class="tab-title d-flex justify-content-between type-card-margin mt-2 mb-1">

                                <div class="d-flex align-items-center gap-1">
                                    <button class="btn back-to-all-rule"><i data-feather='arrow-left'></i>
                                    </button>

                                    <div class="d-flex flex-column">
                                        <h4 class="mb-0 fw-bolder">Створення нового правила</h4>
                                        <p class="mb-0">Налаштування правила по виключенню певних партій</p>
                                    </div>

                                </div>
                                <div>
                                    <button type="button" id="createNewRule" class="btn btn-primary disabled">Зберегти
                                    </button>
                                </div>
                            </div>

                            <hr class="mb-0">
                            <div>
                                <div class="row mx-0 px-2">

                                    <div class="p-0 mt-2">
                                        <h5 class="fw-bold p-0">Для кого діє правило</h5>
                                        <div class="ps-3 radioTypeRuleBlock">
                                            <div class="form-check form-check-primary mt-1">
                                                <input type="radio" id="radioTypeClients" name="radioTypeClients"
                                                       class="form-check-input" checked/>
                                                <label class="form-check-label" for="radioTypeClients">Для типу
                                                    клієнтів</label>
                                            </div>
                                            <div class="form-check form-check-primary mt-1">
                                                <input type="radio" id="radioSpecificClients"
                                                       name="radioSpecificClients"
                                                       class="form-check-input"/>
                                                <label class="form-check-label" for="radioSpecificClients">Для
                                                    конкретного
                                                    клієнта</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-0 mt-2">
                                        <h5 class="fw-bold p-0">Умови правила</h5>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Умова типу клієнтів</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="rule-type-client"
                                                            data-placeholder="Оберіть умову">
                                                        <option value=""></option>
                                                        <option value="1">Якщо тип клієнта відповідає критерію</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Тип клієнтів</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="type-client"
                                                            data-placeholder="Оберіть тип">
                                                        <option value=""></option>
                                                        <option value="1">Дистрибʼютор</option>
                                                        <option value="2">Магазин</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Товар</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="goods"
                                                            data-placeholder="Оберіть товар">
                                                        <option value=""></option>
                                                        <option value="1">Печиво "Марія "Yarych" 2.2 кг 11*200 г
                                                        </option>
                                                        <option value="2">Печиво "Хаха "Yarych" 2.2 кг 11*200 г</option>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Умова серії</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="rule-series"
                                                            data-placeholder="Оберіть умову">
                                                        <option value=""></option>
                                                        <option value="1">Якщо серія відповідає критерію</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Тип вибірки партії</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="type-samples-party"
                                                            data-placeholder="Оберіть тип">
                                                        <option value=""></option>
                                                        <option value="1">По усій серії</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label col-5" for="contentRule">Вміст правила</label>
                                            <input type="text" class="form-control" id="contentRule" name="contentRule"
                                                   placeholder="Суть правила (для усіх правил залиште пустим)" required
                                                   data-msg="Please enter last name">
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label col-5">Період дії</label>
                                            <input type="text" id="periodFrom"
                                                   class="form-control flatpickr-basic flatpickr-input"
                                                   required placeholder="РРРР.ММ.ДД" name="periodFrom"
                                                   readonly="readonly">
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line">
                                            <input type="text" id="periodTo"
                                                   class="form-control flatpickr-basic flatpickr-input"
                                                   required placeholder="РРРР.ММ.ДД" name="periodTo"
                                                   readonly="readonly">
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="d-none" id="edit-view-rule">

                            <div class="tab-title d-flex justify-content-between type-card-margin mt-2 mb-1">

                                <div class="d-flex align-items-center gap-1">
                                    <button class="btn back-to-all-rule-1"><i data-feather='arrow-left'></i>
                                    </button>

                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center gap-1">
                                            <h4 id="title-rule" class="mb-0 fw-bolder">Перегляд правила №2393</h4>
                                            <span id="status-rule"
                                                  class="px-75 py-50 gap-25 badge  d-inline-flex align-items-center"><img
                                                    src="{{asset('assets/icons/notes.svg')}}"
                                                    alt="notes">Активна</span>
                                        </div>


                                        <p class="mb-0">Налаштування правила по виключенню певних партій</p>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <button type="button" id="saveEdit"
                                            class="btn btn-primary disabled">Зберегти зміни
                                    </button>
                                    <div class="nav-item nav-search list-unstyled"><a class="nav-link nav-link-grid">
                                            <img class="nav-img" src="{{asset('assets/icons/dots-icon.svg')}}"
                                                 alt="dots-icon">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-0">
                            <div>
                                <div class="row mx-0 px-2">

                                    <div class="p-0 mt-2">
                                        <h5 class="fw-bold p-0">Для кого діє правило</h5>
                                        <div class="ps-3 ">
                                            <div class="form-check form-check-primary mt-1">
                                                <input type="radio" id="radioTypeClientsView"
                                                       name="radioTypeClientsView"
                                                       class="form-check-input"/>
                                                <label class="form-check-label" for="radioTypeClientsView">Для типу
                                                    клієнтів</label>
                                            </div>
                                            <div class="form-check form-check-primary mt-1">
                                                <input type="radio" id="radioSpecificClientsView"
                                                       name="radioSpecificClientsView"
                                                       class="form-check-input"/>
                                                <label class="form-check-label" for="radioSpecificClientsView">Для
                                                    конкретного
                                                    клієнта</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-0 mt-2">
                                        <h5 class="fw-bold p-0">Умови правила</h5>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Умова типу клієнтів</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="rule-type-client-view"
                                                            data-placeholder="Оберіть умову">
                                                        <option value=""></option>
                                                        <option value="1">Якщо тип клієнта відповідає критерію</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Тип клієнтів</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="type-client-view"
                                                            data-placeholder="Оберіть тип">
                                                        <option value=""></option>
                                                        <option value="1">Дистрибʼютор</option>
                                                        <option value="2">Магазин</option>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Товар</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="goods-view"
                                                            data-placeholder="Оберіть товар">
                                                        <option value=""></option>
                                                        <option value='1'>Печиво
                                                            "Марія "Yarych" 2.2 кг 11*200 г
                                                        <option value='2'>Печиво
                                                            "Хахха "Yarych" 2.2 кг 11*200 г
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Умова серії</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="rule-series-view"
                                                            data-placeholder="Оберіть умову">
                                                        <option value=""></option>
                                                        <option value="1">Якщо серія відповідає критерію</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label mb-0 col-5"
                                                   for="select2-hide-search">Тип вибірки партії</label>
                                            <div class="row mx-0 flex-grow-1 justify-content-end">
                                                <div class="col-12 px-0">
                                                    <select class="select2 hide-search form-select"
                                                            id="type-samples-party-view"
                                                            data-placeholder="Оберіть тип">
                                                        <option value=""></option>
                                                        <option value="1">По усій серії</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label col-5" for="contentRuleView">Вміст правила</label>
                                            <input type="text" class="form-control" id="contentRuleView"
                                                   name="contentRuleView"
                                                   placeholder="Суть правила (для усіх правил залиште пустим)" required
                                                   data-msg="Please enter last name">
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center col-12 mb-1 ps-3">
                                            <label class="form-label col-5">Період дії</label>
                                            <input type="text" id="periodFromView"
                                                   class="form-control flatpickr-basic flatpickr-input"
                                                   required placeholder="РРРР.ММ.ДД" name="periodFrom"
                                                   readonly="readonly">
                                            <img class="align-self-center" style="padding: 0 12px"
                                                 src="{{asset('assets/icons/line-schedule.svg')}}" alt="line">
                                            <input type="text" id="periodToView"
                                                   class="form-control flatpickr-basic flatpickr-input"
                                                   required placeholder="РРРР.ММ.ДД" name="periodTo"
                                                   readonly="readonly">
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal text-start" id="archive_regulation" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder">
                            Архівування правила № <span class="titleRuleModal"></span>
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Ви впевнені що хочете заархівувати це правило?
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-link cancel-btn"
                                            data-dismiss="modal">Скасувати
                                    </button>

                                    <button type="submit" id="archiveRule"
                                            class="btn btn-primary">
                                        Підтвердити
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal text-start" id="no_archive_regulation" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder">
                            Розархівування правила №<span class="titleRuleModal"></span>
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Ви впевнені що хочете розархівувати це правило?
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-link cancel-btn"
                                            data-dismiss="modal">Скасувати
                                    </button>
                                    <button id="unzippingRule" type="submit"
                                            class="btn btn-primary">
                                        Підтвердити
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal text-start" id="delete_regulation" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder">
                            Видалення правила № <span class="titleRuleModal"></span>
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Ви впевнені що хочете видалити це правило?
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-link cancel-btn"
                                            data-dismiss="modal">Скасувати
                                    </button>
                                    <button type="button" class="btn btn-primary" id="deleteRule">Підтвердити</button>
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

    <script>
        $('.cancel-btn').on('click', function () {
            $('.modal').modal('hide')
        });
    </script>

    <script>
        // Отримуємо дропдаун-меню за його ідентифікатор
        const dropdownMenu = document.getElementById('filterDropdown');

        // Додаємо обробник події для дропдаун-меню
        dropdownMenu.addEventListener('click', function (event) {
            // Зупиняємо подальше поширення події "click" всередині дропдаун-меню
            event.stopPropagation();
        });
    </script>

    <script src="{{asset('assets/js/entity/residue-control/residue-control.js')}}"></script>
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>

    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>
@endsection
