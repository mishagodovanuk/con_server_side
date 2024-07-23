@extends('layouts.admin')
@section('title','Створення типу документу')
@section('page-style')
@endsection
@section('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/dragula.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
    <!-- END: Page CSS-->
@endsection

@section('table-js')
    @include('layouts.table-scripts')
    <script type="text/javascript">
        // Ініціалізуємо таби
        $('#tabs-preview').jqxTabs({
            width: '100%',
            height: '100%'
        });
    </script>

    <script type="text/javascript">
        // Ініціалізуємо таби
        $('#tabs-preview2').jqxTabs({
            width: '100%',
            height: '100%'
        });
    </script>

    <script type="module" src="{{asset('assets/js/grid/document-type/preview-document-type.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/document-type/preview-document-type-container.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/document-type/preview-document-type-service.js')}}"></script>
@endsection


@section('content')
    <div class="create-type-container">
        <div class="create-type-header d-flex justify-content-between px-2">
            <div class="breadcrumb-nav d-flex align-items-center mb-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a class="link-secondary" href="/document-type/">Налаштування</a>
                        </li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Створення типу документу</li>
                    </ol>
                </nav>
            </div>
            <div class="header-options d-flex mb-1">
                <div id="document-preview-button2">
                    <div class="d-flex align-items-center btn btn-flat-secondary" id="document-preview-button"
                         style="margin-right: 34px; padding-top: 10px; padding-bottom: 10px">
                        <div class="nav-item nav-search">
                            <img style="margin-right: 8px" class="nav-img"
                                 src="{{asset('assets/icons/external-link.svg')}}" alt="external-link">
                            Попередній перегляд
                        </div>
                    </div>
                </div>
                <div>
                    <div class="nav-item nav-search list-unstyled"><a class="nav-link nav-link-grid">
                            <img class="nav-img" src="{{asset('assets/icons/dots-icon.svg')}}" alt="dots-icon">
                        </a>
                    </div>
                </div>

                <!-- Document Preview Modal start -->
                <div class="modal fade text-start" id="preview-modal-large" tabindex="-1"
                     aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="preview-modal-body">
                                <div class="mx-2 px-0">

                                    <div class="row mx-0 preview-layout" id="modal-content">
                                        <div class="row d-flex px-0" id="maindata-actions" style="column-gap:24px;">
                                            <div class="col-md-7 col-sm-12 px-0" style="flex-grow: 1;"
                                                 id="main-data-container">
                                                <div class="card">
                                                    <div class="card-body px-0"
                                                         style="padding-top: 15px; padding-bottom: 15px;margin-top: 8px;"
                                                         id="document-preview-header-data">
                                                        <div class="">
                                                            <div class="document-preview-main-data-title"></div>
                                                            <div class="d-flex gap-1">
                                                                <div class="" style="flex: 1;">
                                                                    <div class="document-preview-main-data gap-1" id="">
                                                                    </div>
                                                                </div>
                                                                <div class="preview-layout-1-4" style="flex: 1;">
                                                                    <div class="document-preview-main-data2 gap-1">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="custom-blocks d-flex flex-column"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-3 px-0"
                                                 id="actions-container">
                                                <div class="card px-2 py-1 mb-1">
                                                    <div class="card-body p-0 pb-2">
                                                        <div class="row">
                                                            <div class="col-12 mt-1">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="pb-1 fw-bolder">Дії з документом</h4>
                                                                    <a id="edit_condition_submit" class="btn btn-green">
                                                                        Редагування
                                                                    </a>
                                                                    <button class="btn btn-outline-secondary mt-1">
                                                                        Видалення
                                                                    </button>
                                                                    <button class="btn btn-outline-secondary mt-1">
                                                                        Копіювання
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <div id="main-data-message"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="preview-table-tabs px-0" id="tabs-preview">
                                            <ul class="d-flex ">
                                                <li id="nomenclature-tab-preview">Товар</li>
                                                <li id="container-tab-preview">Тара</li>
                                                <li id="services-tab-preview">Послуги</li>
                                            </ul>

                                            <div class=" p-0" id="nomenclature-container">
                                                <div class="card-grid" style="position: relative;">
                                                    <div class="table-block" id="skuPreviewDataTable"></div>
                                                </div>
                                            </div>

                                            <div class="p-0" id="container-preview-table">
                                                <div class="card-grid" style="position: relative;">
                                                    <div class="table-block" id="container-table-preview"></div>
                                                </div>
                                            </div>

                                            <div class=" p-0" id="services-preview-table">
                                                <div class="card-grid" style="position: relative;">
                                                    <div class="table-block" id="service-table-preview"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Preview layout2 -->
                                    <div class="row mx-0 preview-layout2" style="column-gap:24px; display: none;">

                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="card">
                                                <div class="card-body px-0">
                                                    <div class="d-flex">
                                                        <div class="" style="flex: 1;">
                                                            <div class="document-preview-header-layout-2 gap-1">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-12 col-sm-12 flex-grow-1">
                                            <div class="px-0">
                                                <div class="card px-2 py-1 mb-1">
                                                    <div class="card-body p-0 pb-2">
                                                        <div class="row">
                                                            <div class="col-12 mt-1">
                                                                <h4 class="fw-bolder">Дії з документом</h4>
                                                                <div
                                                                    class="d-flex flex-wrap flex-row justify-content-between gap-1">
                                                                    <a id="edit_condition_submit"
                                                                       class="btn btn-green flex-grow-1 mt-1">
                                                                        Редагування
                                                                    </a>
                                                                    <button
                                                                        class="btn btn-outline-secondary flex-grow-1 mt-1">
                                                                        Видалення
                                                                    </button>
                                                                    <button
                                                                        class="btn btn-outline-secondary flex-grow-1 mt-1">
                                                                        Копіювання
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <div id="main-data-message"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="preview-table-tabs px-0" id="tabs-preview2">
                                                <ul class="d-flex ">
                                                    <li id="nomenclature-tab-preview2">Товар</li>
                                                    <li id="container-tab-preview2">Тара</li>
                                                    <li id="services-tab-preview2">Послуги</li>
                                                </ul>

                                                <div class=" p-0" id="nomenclature-container2">
                                                    <div class="card-grid" style="position: relative;">
                                                        <div class="table-block" id="skuPreview2DataTable"></div>
                                                    </div>
                                                </div>

                                                <div class="p-0" id="container-preview-table2">
                                                    <div class="card-grid" style="position: relative;">
                                                        <div class="table-block" id="container-table-preview2"></div>
                                                    </div>
                                                </div>

                                                <div class=" p-0" id="services-preview-table2">
                                                    <div class="card-grid" style="position: relative;">
                                                        <div class="table-block" id="service-table-preview2"></div>
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
                <!-- Document Preview Modal end -->

            </div>
        </div>
        <div class="create-type-body card mx-2">
            <div class="create-type-title d-flex row flex-row mx-0 justify-content-between mt-2 mb-1 px-2">
                <div class="d-flex align-items-center col-12 ps-0 col-md-auto">
                    <h4 class="fw-bolder">Створити новий тип документу</h4>
                </div>
                <div class="col-12 gap-1 col-md-auto pe-0 d-flex justify-content-end">
                    <button type="button" id="draft-save" class="btn btn-flat-primary">Зберегти як чернетку</button>
                    <button type="submit" id="doctype-save" class="btn btn-primary">Зберегти</button>
                </div>
            </div>


            <div class="d-flex row align-items-end mx-0">
                <div class="col-12  col-md-6 ps-0">
                    <div class="create-type-input px-2">
                        <div class="col-12 col-md-12 col-lg-10">
                            <div class="mb-1">
                                <div id="document-type-name-error" class="d-none text-danger mb-1">Заповніть ім'я</div>
                                <input type="text" class="form-control" id="document-type-name"
                                       placeholder="Назва типу документу"/>
                            </div>
                        </div>
                    </div>
                    <div class="create-type-input px-2 d-flex  flex-wrap">

                        <div class="mb-1 col-12 col-md-5 col-lg-5 pe-50">
                            <label class="form-label" for="document-kind">Вид документа</label>
                            <select class="select2 form-select hide-search" id="document-kind"
                                    data-placeholder="Виберіть вид документу">
                                <option value=""></option>
                                <option value="1">Прихідний</option>
                                <option value="2">Розхідний</option>
                                <option value="3">Змішаний</option>
                                <option value="4">Нейтральний</option>
                            </select>
                        </div>

                        <div class="mb-1 col-12 col-md-5 col-lg-5 ps-50">
                            <label class="form-label" for="document-type-print-form">Друкована форма</label>
                            <select class="select2 form-select hide-search" id="document-type-print-form"
                                    data-placeholder="Виберіть друковані форми">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                    </div>
                </div>

                <ul class="col-12  col-md-6 type-layouts d-flex list-unstyled gap-1 justify-content-end px-2">

                    <li class="nav-item nav-search "><a id="active-layout-1" data-value="1"
                                                        class="nav-link nav-link-grid active-layout layout-selector"
                                                        data-layout="layout-1">
                            <img class="" src="{{asset('assets/icons/type/layout-1.svg')}}" alt="layout-1">
                        </a>
                    </li>
                    <li class="nav-item nav-search "><a id="active-layout-2" data-value="2"
                                                        class="nav-link nav-link-grid disable-layout layout-selector"
                                                        data-layout="layout-2">
                            <img class="" src="{{asset('assets/icons/type/layout-2.svg')}}" alt="layout-2">
                        </a>
                    </li>
                    <li class="nav-item nav-search "><a id="active-layout-3" data-value="3"
                                                        class="nav-link nav-link-grid disable-layout layout-selector"
                                                        data-layout="layout-3">
                            <img class="" src="{{asset('assets/icons/type/layout-3.svg')}}" alt="layout-3">
                        </a>
                    </li>
                    <li class="nav-item nav-search"><a id="active-layout-4" data-value="4"
                                                       class="nav-link nav-link-grid disable-layout layout-selector"
                                                       data-layout="layout-4">
                            <img class="" src="{{asset('assets/icons/type/layout-4.svg')}}" alt="layout-4">
                        </a>
                    </li>
                </ul>
            </div>

            <div class="create-type-title d-flex justify-content-between mt-2 px-2">
                <div class="d-flex align-items-center">
                    <h4 class="fw-bolder">Дії з документом і ролі</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter"
                            style="width: 127px; height: 38px; margin-bottom: 5px;">
                        <img
                            src="{{asset('assets/icons/plus-yellow.svg')}}" alt="plus-yellow"> Додати
                    </button>
                    <!-- Modal -->
                    <div class="vertical-modal-ex">
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content px-3 py-3">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h2 class="modal-title fw-bolder" id="exampleModalCenterTitle">Додати дії до
                                            документу</h2>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group input-group-merge mb-2">
                                            <span class="input-group-text" id="basic-addon-search2"><i
                                                    data-feather="search"></i></span>
                                            <input type="text" class="form-control ps-1" id="searchBarItem"
                                                   placeholder="Пошук полів" aria-label="Search..."
                                                   aria-describedby="basic-addon-search2"/>
                                        </div>
                                        <div id="actionDoc" class="form-check"
                                             style="height: 265px; overflow-y: scroll;">

                                            <div data-item-key="edit">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="defaultCheck1" checked>
                                                <label class="form-check-label pb-2" data-key="edit"
                                                       for="defaultCheck1">Редагування</label>
                                            </div>

                                            <div data-item-key="delete">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="defaultCheck2" checked>
                                                <label data-key="delete" class="form-check-label pb-2"
                                                       for="defaultCheck2">Видалення</label>
                                            </div>

                                            <div data-item-key="copy">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="defaultCheck3" checked>
                                                <label data-key="copy" class="form-check-label pb-2"
                                                       for="defaultCheck3">Копіювання</label>
                                            </div>

                                            <div data-item-key="carrying_out">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="defaultCheck4">
                                                <label data-key="carrying_out" class="form-check-label pb-2"
                                                       for="defaultCheck4">Проведення накладної</label>
                                            </div>

                                            <div data-item-key="action">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="defaultCheck5">
                                                <label data-key="action" class="form-check-label pb-2"
                                                       for="defaultCheck5">Дія з документом</label>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="modal-footer" style="border-top: 0;">
                                        <button type="button" class="btn btn-link cancel-btn" data-bs-dismiss="modal"
                                                aria-label="Close">Скасувати
                                        </button>
                                        <button id="add-btn" type="submit" class="btn btn-primary">
                                            Добавити
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal end -->
                </div>
            </div>
            <div class="create-type-actions">
                <div class="accordion" id="myAccordion">
                    <div class="accordion-item border-bottom-0" data-accordion-key="edit">
                        <h2 class="accordion-header d-flex" id="headingOne">
                            <button class="accordion-button collapsed ps-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span class="me-1 ps-2" style="list-style: none;">
                                <img class="" src="{{asset('assets/icons/doctype-edit.svg')}}" alt="doctype-edit">
                            </span>
                                <span class="accordion-list-item-title"> Редагування<br/>
                                <span class="accordion-list-item-text"><span>Дозволено автоматично:</span><span
                                        id="edit_roles">адміністратор, комірник, водій</span></span>
                            </span>
                            </button>
                            <span class="delete-btn d-flex justify-content-center align-items-center pe-2"
                                  style="list-style: none;">
                                <img class="pe-1" src="{{asset('assets/icons/vertical-divider.svg')}}"
                                     alt="vertical-divider">
                                <a><img src="{{asset('assets/icons/trash.svg')}}" alt="trash.svg"></a>
                            </span>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                             data-bs-parent="#myAccordion">
                            <div class="accordion-body ps-2 py-2 gap-2 d-flex flex-column">
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="admin_edit" checked>
                                    <label class="form-check-label ps-75 fw-bold">Адміністратор</label>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="storekeeper_edit" checked>
                                    <label class="form-check-label ps-75 fw-bold">Комірник</label>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="driver_edit" checked>
                                    <label class="form-check-label ps-75 fw-bold">Водій</label>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="manager_edit"/>
                                    <label class="form-check-label ps-75 fw-bold">Менеджер</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-bottom-0" data-accordion-key="delete">
                        <h2 class="accordion-header d-flex" id="heading-delete">
                            <button class="accordion-button collapsed ps-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span class="me-1 ps-2" style="list-style: none;">
                                    <img class="" src="{{asset('assets/icons/doctype-delete.svg')}}"
                                         alt="doctype-delete">
                                </span>
                                <span class="accordion-list-item-title">Видалення<br/>
                                <span class="accordion-list-item-text"><span>Дозволено автоматично:</span><span
                                        id="delete_roles">адміністратор, комірник, водій</span></span>
                            </span>
                            </button>
                            <span class="delete-btn d-flex justify-content-center align-items-center pe-2"
                                  style="list-style: none;">
                                <img class="pe-1" src="{{asset('assets/icons/vertical-divider.svg')}}"
                                     alt="vertical-divider">
                                <a><img src="{{asset('assets/icons/trash.svg')}}" alt="trash"></a>
                            </span>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                             data-bs-parent="#myAccordion">
                            <div class="accordion-body ps-2 py-2 gap-2 d-flex flex-column">
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="admin_delete" checked>
                                    <label class="form-check-label ps-75 fw-bold">Адміністратор</label>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="storekeeper_delete" checked>
                                    <label class="form-check-label ps-75 fw-bold">Комірник</label>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="driver_delete" checked>
                                    <label class="form-check-label ps-75 fw-bold">Водій</label>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="manager_delete"/>
                                    <label class="form-check-label ps-75 fw-bold">Менеджер</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-bottom-0" data-accordion-key="copy">
                        <h2 class="accordion-header d-flex" id="heading-copy">
                            <button class="accordion-button collapsed ps-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <span class="me-1 ps-2" style="list-style: none;">
                                    <img class="" src="{{asset('assets/icons/doctype-copy.svg')}}" alt="doctype-copy">
                                </span>
                                <span class="accordion-list-item-title">Копіювання<br/>
                                <span class="accordion-list-item-text"><span>Дозволено автоматично:</span><span
                                        id="edit_roles">адміністратор, комірник, водій</span></span>
                            </span>
                            </button>
                            <span class="delete-btn d-flex justify-content-center align-items-center pe-2"
                                  style="list-style: none;">
                                <img class="pe-1" src="{{asset('assets/icons/vertical-divider.svg')}}"
                                     alt="vertical-divider">
                                <a><img src="{{asset('assets/icons/trash.svg')}}" alt="trash.svg"></a>
                            </span>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                             data-bs-parent="#myAccordion">
                            <div class="accordion-body ps-2 py-2 gap-2 d-flex flex-column">
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="admin_copy" checked>
                                    <label class="form-check-label ps-75 fw-bold">Адміністратор</label>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="storekeeper_copy" checked>
                                    <label class="form-check-label ps-75 fw-bold">Комірник</label>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="driver_copy" checked>
                                    <label class="form-check-label ps-75 fw-bold">Водій</label>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="manager_copy">
                                    <label class="form-check-label ps-75 fw-bold">Менеджер</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-center pt-1">
                    <button class="btn btn-flat-primary waves-effect expand-btn" style="display: none" type="button">
                        <span id="expand-btn-title">Переглянути усі</span>
                        <img id="chevron-icon" src="{{asset('assets/icons/chevron-down.svg')}}" alt="chevron-down">
                    </button>

                </div>
            </div>
            <hr class="pb-1 pt-0"/>
            <div class="create-type-others-documents px-2">
                <div class="document-switch">
                    <div
                        class="form-check form-switch form-check-reverse d-flex justify-content-start align-items-center">
                        <label class="form-check-label me-1 mb-0 fs-4    fw-bolder" for="customSwitchDocument">
                            Документи
                        </label>
                        <input type="checkbox" class="form-check-input" id="customSwitchDocument"/>
                    </div>
                </div>
                <div class="create-type-others-documents-text pt-2">
                    <p>Включаючи цю опцію ви можете додавати інші<br>
                        документи в цей тип документу.</p>
                </div>
                <div class="create-type-others-documents-select row mx-0">
                    <div class="mb-1  col-12 col-lg-5 px-0">
                        <div id="document-type-switch" class="d-none text-danger mb-1">Виберіть значення поля "Тип
                            документу"
                        </div>

                        <label class="form-label" for="u_street select2-hide-search">Тип документу</label>
                        <select class="select2 form-select hide-search" id="document-type"
                                data-placeholder="Виберіть тип документу" multiple>
                            <option value=""></option>
                            @foreach($docTypes as $docType)
                                <option value="{{$docType->id}}">{{$docType->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr class="pb-1 pt-0"/>

            <div class="vertical-modal-ex" style="z-index: 5000;">
                <!-- Modal -->
                <div class="modal fade" id="customField" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                        <div class="modal-content">
                            <div class="modal-header pt-0">
                                <div class="d-flex flex-column m-auto pt-3">
                                    <div>
                                        <h3 class="modal-title text-center pb-1 fw-bolder" id="exampleModalCenterTitle">
                                            Створити
                                            нове поле</h3>
                                    </div>
                                    <div>
                                        <p class="text-center" id="custom-modal-title">Виберіть новий тип поля</p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="btn-close" id="custom-close-btn"
                                            data-bs-dismiss="modal" aria-label="Close"
                                            style="margin-bottom: 100px;"></button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="field-type-list px-4">
                                    <div class="input-group input-group-merge mb-2">
                                        <span class="input-group-text" id="basic-addon-search2"><i
                                                data-feather="search"></i></span>
                                        <input type="text" class="form-control ps-1" id="searchBarItemModal"
                                               placeholder="Напишіть назву типу поля" aria-label="Search..."
                                               aria-describedby="basic-addon-search2"/>
                                    </div>
                                    <div>
                                        <h4 class="fw-bolder">Типи</h4>
                                    </div>
                                    <ul id="modalFieldTypeList" style="max-height: 420px; overflow-y: scroll"
                                        class="ps-0 mt-1">

                                        <li class="field-type border-bottom py-1  list-unstyled" id="field-type-text">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Текстове поле</h5>
                                                    <p class="text-secondary mb-0">Дозволяє вводити і редагувати
                                                        текст.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-text.svg')}}"
                                                     alt="type-text">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled" id="field-type-range">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Два текстові поля (діапазон)</h5>
                                                    <p class="text-secondary mb-0">Дозволяє вводити і редагувати текст
                                                        для
                                                        значень від і до.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-text-range.svg')}}"
                                                     alt="text-range">
                                            </a>

                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled" id="field-type-select">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0"> Вибір значення зі списку</h5>
                                                    <p class="text-secondary mb-0">Дозволяє обрати одне значення зі
                                                        списку.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-select.svg')}}"
                                                     alt="type-select">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled" id="field-type-label">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Вибір декількох значень зі списку</h5>
                                                    <p class="text-secondary mb-0">Дозволяє обрати кілька значення зі
                                                        списку.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-multiselect.svg')}}"
                                                     alt="type-label">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled" id="field-type-date">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Дата</h5>
                                                    <p class="text-secondary mb-0">Дозволяє вказати дату.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-date.svg')}}"
                                                     alt="type-date">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled"
                                            id="field-type-dateRange">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Період дат</h5>
                                                    <p class="text-secondary mb-0">Дозволяє вказати період дат від і
                                                        до.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-date-range.svg')}}"
                                                     alt="type-date-range">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled"
                                            id="field-type-dateTime">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Дата і час</h5>
                                                    <p class="text-secondary mb-0">Дозволяє вказати дату та час.</p>
                                                </div>
                                                <img class=""
                                                     src="{{asset('assets/icons/type-date-time.svg')}}"
                                                     alt="type-date-time">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled"
                                            id="field-type-dateTimeRange">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Дата і часові рамки</h5>
                                                    <p class="text-secondary mb-0">Дозволяє вказати дату із часовим
                                                        проміжком.</p>
                                                </div>
                                                <img class=""
                                                     src="{{asset('assets/icons/type-date-time-range.svg')}}"
                                                     alt="type-date-time-range">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled"
                                            id="field-type-timeRange">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Часові рамки</h5>
                                                    <p class="text-secondary mb-0">Дозволяє вказати час від і до.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-time-range.svg')}}"
                                                     alt="type-time-range">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled" id="field-type-switch">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Вмикач / вимикач значення</h5>
                                                    <p class="text-secondary mb-0">Дозволяє робити вказану опцію
                                                        активною або неактивною.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-switch.svg')}}"
                                                     alt="type-switch">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled"
                                            id="field-type-uploadFile">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Обрати файл</h5>
                                                    <p class="text-secondary mb-0">Дозволяє завантажувати та
                                                        вивантажувати файл.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-upload-file.svg')}}"
                                                     alt="type-upload-file">
                                            </a>
                                        </li>

                                        <li class="field-type border-bottom py-1 list-unstyled" id="field-type-comment">
                                            <a class="px-1 d-flex gap-1 align-items-center">
                                                <div
                                                    class="flex-grow-1 d-flex flex-column justify-content-center gap-lg-25">
                                                    <h5 class="fw-bolder mb-0">Коментар</h5>
                                                    <p class="text-secondary mb-0">Дозволяє вводити і редагувати текст
                                                        для примітки до документу.</p>
                                                </div>
                                                <img class="" src="{{asset('assets/icons/type-comment.svg')}}"
                                                     alt="type-comment">
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-text"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-text-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-text-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-text-desc">Підказка</label>
                                        <textarea class="form-control" id="additional-settings-field-type-text-desc"
                                                  rows="3"
                                                  placeholder="Поясніть як користувачі можуть використовувати це поле"></textarea>
                                    </div>
                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-range"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-range-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-range-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                    {{--                                    <div class="mb-1">--}}
                                    {{--                                        <label class="form-label" for="additional-settings-field-type-range-desc">Підказка</label>--}}
                                    {{--                                        <textarea class="form-control" id="additional-settings-field-type-range-desc"--}}
                                    {{--                                                  rows="3"--}}
                                    {{--                                                  placeholder="Поясніть як користувачі можуть використовувати це поле"></textarea>--}}
                                    {{--                                    </div>--}}
                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-select"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-select-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-select-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-select-desc">Підказка</label>
                                        <textarea class="form-control" id="additional-settings-field-type-select-desc"
                                                  rows="3"
                                                  placeholder="Поясніть як користувачі можуть використовувати це поле"></textarea>
                                    </div>

                                    <div class="blockDataParam">
                                        <div id="directoryBlock" class="mb-1">
                                            <label class="form-label" for="directoryBlock">Довідник</label>
                                            <select class="select2 form-select"
                                                    id="additional-settings-field-type-select-model"
                                                    data-placeholder="Виберіть довідник для цього селекту">
                                                <option value=""></option>
                                                @foreach(\App\Helpers\DictionaryList::list() as $key=>$dictionaryName)
                                                    <option value="{{$key}}">{{$dictionaryName}}</option>
                                                @endforeach
                                            </select>

                                            <button id="parameterBtnShow" class="btn text-primary mt-1">Додати власні
                                                опції
                                            </button>
                                        </div>

                                        <div id="parameterBlock" class="mb-1 d-none">
                                            <label class="form-label" for="inputParameter">Параметр</label>
                                            <div class="d-flex row mx-0" style="gap: 16px">
                                                <div class="col-9 px-0">
                                                    <input id="inputParameter" class="form-control" type="text"
                                                           placeholder="Вкажіть параметр"/>
                                                </div>

                                                <button id="customAddItemParameter"
                                                        class="btn btn-outline-primary flex-grow-1 col-2 text-primary">
                                                    Додати
                                                </button>
                                            </div>
                                            <ul class="p-0 parameter-list col-9">
                                            </ul>

                                            <button id="addItemInDirectory" class="btn text-primary">Додати довідник
                                            </button>

                                        </div>
                                    </div>


                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-label"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-label-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-label-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-label-desc">Підказка</label>
                                        <textarea class="form-control" id="additional-settings-field-type-label-desc"
                                                  rows="3"
                                                  placeholder="Поясніть як користувачі можуть використовувати це поле"></textarea>
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label" for="select2-hide-search">Довідник</label>
                                        <select class="select2 form-select"
                                                id="additional-settings-field-type-label-parameter"
                                                data-placeholder="Виберіть довідник для цього селекту">
                                            <option value=""></option>
                                            @foreach(\App\Helpers\DictionaryList::list() as $key=>$dictionaryName)
                                                <option value="{{$key}}">{{$dictionaryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-date"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-date-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-date-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-date-desc">Підказка</label>
                                        <textarea class="form-control" id="additional-settings-field-type-date-desc"
                                                  rows="3"
                                                  placeholder="Поясніть як користувачі можуть використовувати це поле"></textarea>
                                    </div>
                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-dateRange"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-dateRange-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-dateRange-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                </div>
                                <div class="additional-settings px-3" id="additional-settings-field-type-dateTime"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-dateTime-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-dateTime-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                </div>

                                <div class="additional-settings px-3"
                                     id="additional-settings-field-type-dateTimeRange"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label"
                                               for="additional-settings-field-type-dateTimeRange-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-dateTimeRange-title"
                                               class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-timeRange"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-timeRange-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-timeRange-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-switch"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-switch-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-switch-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-uploadFile"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label"
                                               for="additional-settings-field-type-uploadFile-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-uploadFile-title"
                                               class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                </div>

                                <div class="additional-settings px-3" id="additional-settings-field-type-comment"
                                     style="min-height: 350px;">
                                    <div class="mb-1">
                                        <label class="form-label" for="additional-settings-field-type-comment-title">Назва
                                            поля</label>
                                        <input id="additional-settings-field-type-comment-title" class="form-control"
                                               type="text" placeholder="Вкажіть назву поля"/>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer mx-3 mb-3 d-flex justify-content-between flex-row-reverse"
                                 style="border-top: 0;">
                                <button type="button" class="btn btn-primary disabled" id="next-custom-btn">Далі <img
                                        class="nav-img" src="{{asset('assets/icons/arrow-right.svg')}}"
                                        alt="arrow-right"></button>
                                <button type="button" class="btn btn-primary" id="create-custom-btn">Створити</button>
                                <button type="button" class="btn btn-flat-secondary" id="back-custom-btn"><img
                                        class="nav-img" src="{{asset('assets/icons/arrow-left.svg')}}" alt="arrow-left">
                                    Назад
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document-fields start -->
            <div class="document-fields px-2 pb-3">
                <div class="row">
                    <div class="fields-list col-12 col-lg-8" style="height: 600px; overflow-y: scroll;">
                        <div>
                            <div id="document-type-empty-header-error" class="d-none mb-1">
                                Введіть дані у полі "Основні дані"
                            </div>
                            <div id="accordion-field-header"
                                 class="accordion-field-header align-items-center d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <h4 id="accordion-field-title" class="m-0 fw-bolder">Основна інформація</h4>
                                    <input id="header-block-title-input"
                                           type="text"
                                           class="m-0 fw-bolder w-100 header-block-title-input bg-transparent border-0 d-none"
                                           value="Основна інформація">
                                    {{--                                    <img id="header-accordion-icon"--}}
                                    {{--                                         src="{{asset('assets/icons/create-type/header-accordion-icon.svg')}}"--}}
                                    {{--                                         alt="header-accordion-icon">--}}
                                </div>

                            </div>
                            <ul class="sortableList" id="header_fields">
                            </ul>

                        </div>

                        <div class="d-flex justify-content-center btn-add-new-block align-items-center gap-1 mb-1 px-1">
                            <button class="btn btn-flat-primary col-auto" id="add-new-block-item">Додати блок</button>
                        </div>

                        <div>
                            <div class="accordion-field-header d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <h4 class="m-0 fw-bolder">Товар</h4>
                                    {{--                                    <img src="{{asset('assets/icons/create-type/header-accordion-icon.svg')}}"--}}
                                    {{--                                         alt="header-accordion-icon">--}}
                                </div>

                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="nomenclature_checked"/>
                                </div>
                            </div>
                            <div id="default_nomenclature_fields" class="d-none px-75">
                                <div class="ui-accordion-header d-flex align-items-center">
                                    <img class="pe-1" src="{{asset('assets/icons/create-type/arrow-down-circle.svg')}}">
                                    <p class="mb-0">Категорія</p>
                                </div>
                                <div class="ui-accordion-header d-flex align-items-center">
                                    <img class="pe-1" src="{{asset('assets/icons/create-type/letter-case.svg')}}">
                                    <p class="mb-0">Найменування</p>
                                </div>
                                <div class="ui-accordion-header d-flex align-items-center">
                                    <img class="pe-1" src="{{asset('assets/icons/create-type/letter-case.svg')}}">
                                    <p class="mb-0">Кількість</p>
                                </div>

                            </div>
                            <ul class="sortableList" id="nomenclature_fields">


                            </ul>

                            {{--                            <div class="position-relative">--}}
                            {{--                                <ul class="sortableList" id="nomenclature_fields">--}}


                            {{--                                </ul>--}}
                            {{--                                <div class="sortable-placeholder position-absolute" style="top: 25px; left: 40%"--}}
                            {{--                                     id="sortablePlaceholder">--}}
                            {{--                                    Текстовий плейсхолдер--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>

                        <div>
                            <div class="accordion-field-header d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <h4 class="m-0 fw-bolder">Тара</h4>
                                    {{--                                    <img src="{{asset('assets/icons/create-type/header-accordion-icon.svg')}}"--}}
                                    {{--                                         alt="header-accordion-icon">--}}
                                </div>

                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="container_checked"/>
                                </div>
                            </div>
                            <div id="default_container_fields" class="d-none px-75">
                                <div class="ui-accordion-header d-flex align-items-center">
                                    <img class="pe-1" src="{{asset('assets/icons/create-type/arrow-down-circle.svg')}}">
                                    <p class="mb-0">Категорія</p>
                                </div>
                                <div class="ui-accordion-header d-flex align-items-center">
                                    <img class="pe-1" src="{{asset('assets/icons/create-type/letter-case.svg')}}">
                                    <p class="mb-0">Найменування</p>
                                </div>
                                <div class="ui-accordion-header d-flex align-items-center">
                                    <img class="pe-1" src="{{asset('assets/icons/create-type/letter-case.svg')}}">
                                    <p class="mb-0">Кількість</p>
                                </div>

                            </div>
                            <ul class="sortableList" id="container_fields">
                            </ul>
                        </div>

                        <div>
                            <div class="accordion-field-header d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <h4 class="m-0 fw-bolder">Послуги</h4>
                                    {{--                                    <img src="{{asset('assets/icons/create-type/header-accordion-icon.svg')}}"--}}
                                    {{--                                         alt="header-accordion-icon">--}}
                                </div>

                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="services_checked"/>
                                </div>
                            </div>
                            <div id="default_services_fields" class="d-none px-75">
                                <div class="ui-accordion-header d-flex align-items-center">
                                    <img class="pe-1" src="{{asset('assets/icons/create-type/arrow-down-circle.svg')}}">
                                    <p class="mb-0">Категорія</p>
                                </div>
                                <div class="ui-accordion-header d-flex align-items-center">
                                    <img class="pe-1" src="{{asset('assets/icons/create-type/arrow-down-circle.svg')}}">
                                    <p class="mb-0">Послуга</p>
                                </div>
                            </div>
                            <ul class="sortableList" id="services_fields">
                            </ul>
                        </div>
                    </div>

                    <div id="add-field" class="col-12 col-lg-4 ps-2">
                        <h4 class="fw-bolder"> Поля</h4>
                        <p>Перетягніть поле в один з блоків ліворуч<br/>щоб добавити його</p>
                        <div class="input-group input-group-merge mb-1">
                            <span class="input-group-text" id="basic-addon-search2"><i data-feather="search"></i></span>
                            <input id="searchCreateFields" type="text" class="ps-1 form-control"
                                   placeholder="Пошук полів"
                                   aria-label="Search..." aria-describedby="basic-addon-search2"/>
                        </div>

                        <div class="pe-2 document-new-fields" style="height: 400px; overflow-y: scroll;">

                            <div class="mb-2 accordion-group-field">
                                <div class="accordion-header-castom  py-1 bg-white mb-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <h6 class="m-0">Створити поле</h6>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <img id="accordion-chevron" width="16px"
                                                     src="{{asset('assets/icons/chevron-right.svg')}}" alt="chevron">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-group-field-body d-none">
                                    <ul class="arrTypeSystemFieldsCustom align-items-center row"
                                        style="list-style-type: none; padding: 0"></ul>
                                </div>
                            </div>


                            <h6 class="py-1">Текстові поля</h6>
                            <ul class="arrTypeSystemFieldsListText" style="list-style-type: none; padding: 0"></ul>
                            <ul class="arrTypeSystemFieldsListRange" style="list-style-type: none; padding: 0"></ul>

                            <h6 class="py-1">Поля дати і часу</h6>
                            <ul class="arrTypeSystemFieldsListDate" style="list-style-type: none; padding: 0"></ul>
                            <ul class="arrTypeSystemFieldsListDateRange" style="list-style-type: none; padding: 0"></ul>
                            <ul class="arrTypeSystemFieldsListDateTime" style="list-style-type: none; padding: 0"></ul>
                            <ul class="arrTypeSystemFieldsListDateTimeRange"
                                style="list-style-type: none; padding: 0"></ul>
                            <ul class="arrTypeSystemFieldsListTimeRange" style="list-style-type: none; padding: 0"></ul>

                            <h6 class="py-1">Поля вибору</h6>
                            <ul class="arrTypeSystemFieldsListSelect" style="list-style-type: none; padding: 0"></ul>
                            <ul class="arrTypeSystemFieldsLabel" style="list-style-type: none; padding: 0"></ul>

                            <h6 class="py-1">Інші поля</h6>
                            <ul class="arrTypeSystemFieldsListSwitch" style="list-style-type: none; padding: 0"></ul>
                            <ul class="arrTypeSystemFieldsListUploadFile"
                                style="list-style-type: none; padding: 0"></ul>
                            <ul class="arrTypeSystemFieldsListComment" style="list-style-type: none; padding: 0"></ul>


                        </div>
                        <div class="pt-1">
                            <button type="button" class="btn btn-flat-primary" data-bs-toggle="modal"
                                    data-bs-target="#customField">Створити кастомне поле
                            </button>
                        </div>
                    </div>
                    <div style="display: none" id="trash" class="col-12 col-lg-4 ps-2 mt-1 mt-lg-0">
                        <div class="trash flex-column justify-content-center align-items-center">
                            <img class="" src="{{asset('assets/icons/recycle.svg')}}" alt="recycle">
                            <h3 class="text-center fw-bolder">Перетягніть сюди, щоб <br> прибрати поле</h3>
                            <p class="text-center">Поля які перенесені сюди, зможуть <br> бути використані для
                                формування
                                <br>
                                документів</p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Document-fields end -->

        </div>
    </div>
@endsection

@section('page-script')

    <!-- BEGIN: Page Vendor JS-->
    <script>
        var dictionaryList = {!! json_encode(\App\Helpers\DictionaryList::list()) !!};
        var doctypeFields = {!! $doctypeFields->toJson() !!}

    </script>

    <script>console.log(doctypeFields)</script>
    <script src="{{asset('vendors/js/extensions/dragula.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/js/entity/document-type/document-type.js')}}"></script>
    <script type="module" src="{{asset('assets/js/entity/document-type/configurator.js')}}"></script>

    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <!-- END: Page JS-->

    <!-- Jquery UI start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
            integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('vendors/js/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

    <!-- Jquery UI end -->
@endsection
