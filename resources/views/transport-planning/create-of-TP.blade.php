@extends('layouts.admin')
@section('title','Створення ТП')
@section('page-style')
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

        var addButton = $('<li class="btn-tabs-watch-all"> <button id="add-new-goods-invoices-item" disabled class="btn btn-green position-absolute " style="top: 13px; right: 15px" >Додати </button> </li>');
        addButton.appendTo('#tabs ');

        var addTransportRequestButton = $('<li class="btn-tabs-watch-all"> <button id="add-new-transport-request-item" disabled class="btn btn-green position-absolute d-none" style="top: 13px; right: 15px" >Додати </button> </li>');
        addTransportRequestButton.appendTo('#tabs ');

    </script>

    <script type="module" src="{{asset('assets/js/grid/transport-planning/commodity-invoice-table.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/transport-planning/request-for-transport-table.js')}}"></script>
    <script src="{{asset('assets/js/utils/loader-for-tabs.js')}}"></script>

@endsection


@section('content')
    <div id="jqxLoader"></div>

    <div class="container-fluid px-2">
        <!-- контейнер з навігацією і кнопками -->
        <div
            class="d-flex justify-content-between pb-2 flex-column  flex-sm-column flex-md-row flex-lg-row flex-xxl-row">
            <div class="tn-details-breadcrumbs-nav d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a class="text-secondary" href="/transport-planning">Транспортне
                                планування</a></li>
                        <li class="breadcrumb-item fw-bolder text-truncate">Створення
                            транспортного
                            планування
                        </li>

                    </ol>
                </nav>
            </div>
            <div class="container_btn-createTP d-flex justify-content-end">
                <button type='button' class="btn disabled border-0" tabindex="4"> <span
                        class="align-middle d-sm-inline-block  text-secondary">Скасувати</span>
                </button>
                <button type='button' class="btn btn-primary" id="create-transport-planning" tabindex="4">
                    <span class="align-middle d-sm-inline-block">Зберегти</span>
                </button>
            </div>
        </div>
        <!-- = -->
        <!-- контейнер  з селектами та полями  для створення ТP-->
        <div class="card p-2">
            <h4 class="mb-2">Основна інформація</h4>
            <!-- набір чекбоксів  -->
            <div class="d-flex gap-1 gap-sm-1 gap-lg-0 flex-column flex-sm-column flex-md-column flex-lg-row mb-1">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="3pl-auto" value="unchecked"/>
                    <label class="form-check-label" for="3pl-auto">3PL auto</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="auto-search" value="unchecked"/>
                    <label class="form-check-label" for="auto-search">Автоматичний пошук</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="init-auto" value="unchecked"/>
                    <label class="form-check-label" for="init-auto">Ініціалізація авто</label>
                </div>
            </div>
            <!-- набір селектів та інпутів в двох групах -->
            <div class="row ">

                <div class="col-12 col-sm-12 col-md-6 mb-1">
                    <label class="form-label" for="select-company-provider">Компанія постачальник</label>
                    <select class="select2 form-select" id="select-company-provider"
                            data-placeholder="Оберіть компанію" data-dictionary="company">
                        <option value=""></option>

                    </select>
                </div>


                <div class="col-12 col-sm-12 col-md-6 mb-1">
                    <label class="form-label" for="select-company-transporter">Компанія перевізник</label>
                    <select class="select2 form-select" id="select-company-transporter"
                            data-placeholder="Оберіть компанію перевізника" data-dictionary="company">
                        <option value=""></option>

                    </select>
                </div>

                <div class="col-12 col-sm-12 col-md-6 mb-1">
                    <label class="form-label" for="select-transport">Транспорт</label>
                    <select class="select2 form-select" id="select-transport"
                            data-placeholder="Виберіть траспорт" data-dictionary="transport">
                        <option value=""></option>

                    </select>
                </div>

                <div class="col-12 col-sm-12 col-md-6 mb-1">
                    <label class="form-label" for="select-equipment">Додаткове обладнання</label>
                    <select class="select2 form-select" id="select-equipment"
                            data-placeholder="Виберіть додаткове обладнання" data-dictionary="additional_equipment">
                        <option value=""></option>

                    </select>
                </div>

                <div class="col-12 col-sm-12 col-md-6 mb-1">
                    <label class="form-label" for="select-payer">Платник</label>
                    <select class="select2 form-select" id="select-payer"
                            data-placeholder="Оберіть платника" data-dictionary="company">
                        <option value=""></option>
                    </select>
                </div>


                <div class="col-12 col-sm-12 col-md-6 input-with-switch mb-1  d-flex align-items-end ">
                    <div class="w-100 mr-1">
                        <label class="form-label" for="price">Ціна рейсу</label>
                        <input type="number" class="form-control" id="price"
                               placeholder="Оберіть ціну перевезення "/>
                    </div>
                    <div class="form-check form-switch  flex-shrink-1" style="padding-bottom:8px">
                        <input type="checkbox" class="form-check-input" id="pdv"/>
                        <label class="form-check-label  " for="pdv" style="width:45px">з ПДВ</label>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 mb-1">
                    <label class="form-label" for="select-driver">Водій</label>
                    <select class="select2 form-select" id="select-driver"
                            data-placeholder="Оберіть водія" data-dictionary="driver">
                        <option value=""></option>

                    </select>
                </div>

                <div class="d-none d-sm-none d-md-block col-md-6 mb-1"></div>


                <div class="trans-planning-textarea col-12 col-sm-12 col-md-6 mb-1">

                    <textarea class="form-control" id="comment" rows="3"
                              placeholder="Коментар"></textarea>
                </div>


            </div>

            <div id="validate-error"></div>

        </div>

        <div class="card">
            <div class="card-header pb-0  mx-0 row">
                <h4 class="card-title col-12 col-sm-12 col-md-8 col-lg-9 col-xxl-9 fw-semibold pb-2 pb-md-0">
                    Документи</h4>
                <div class=" col-12 col-sm-12 col-md-4 col-lg-3 col-xxl-3 pe-0">
                    <a data-bs-toggle="modal" id="button_sku_tp" data-bs-target="#add_sku_tp"
                       class="btn btn-outline-primary float-end" href="#"><img
                            class="plus-icon" src="{{asset('assets/icons/plus-yellow.svg')}}" alt="plus-yellow">Додати
                        документ
                    </a>
                </div>
            </div>


            <div class="mt-1 p-2">
                <div class="card-body p-0" id="sortable"></div>
                <div class="d-flex align-items-center justify-content-center" id="js-tp-sortable-placeholder"
                     style="height: 120px;">
                    <h4 class="text-secondary fw-normal">
                        Почніть додавати сформовані ТН для формування рейсу
                    </h4>
                </div>
            </div>

        </div>

        <div class="modal-size-xl d-inline-block">
            <div class="modal fade text-start" id="add_sku_tp" tabindex="-1" aria-labelledby="myModalLabel16"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body-title pb-2">
                                <h3 class="text-center fw-bolder">Документи</h3>
                            </div>
                            <div class=" m-2">
                                <div class="card-body p-0">
                                    <div class="d-flex justify-content-between tp-tables">

                                        <div class="transport-planning-table-tabs invisible tabs-transport-planning-сss"
                                             id="tabs">
                                            <ul class="d-flex ">
                                                <li id="schedule-tab">Товарні накладні</li>
                                                <li id="transport-request-tab">Запит на транспорт</li>
                                            </ul>

                                            <div id="schedule">
                                                <div class="card-grid" style="position: relative;">

                                                    <div id="offcanvas-end-example">

                                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false"
                                                             tabindex="-1"
                                                             id="settingTable" aria-labelledby="settingTableLabel"
                                                             style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 5100;"
                                                             data-bs-scroll="true">
                                                            <div class="offcanvas-header">
                                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">
                                                                    Налаштування
                                                                    таблиці</h4>
                                                                <li class="nav-item nav-search text-reset"
                                                                    data-bs-dismiss="offcanvas"
                                                                    aria-label="Close" style="list-style: none;"><a
                                                                        class="nav-link nav-link-grid">
                                                                        <img
                                                                            src="{{asset('assets/icons/close-button.svg')}}"></a>
                                                                </li>
                                                            </div>
                                                            <div class="offcanvas-body p-0">
                                                                <div class="" id="body-wrapper">
                                                                    <div
                                                                        class="d-flex flex-row align-items-center justify-content-between px-2">
                                                                        <div class="form-check-label f-15">Змінити
                                                                            висоту
                                                                            рядка:
                                                                        </div>
                                                                        <div
                                                                            class="form-check form-check-warning form-switch d-flex align-items-center"
                                                                            style="">
                                                                            <button class="changeMenu-3">
                                                                                <svg width="30" height="30"
                                                                                     viewBox="0 0 30 30"
                                                                                     fill="none"
                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M9 10.5H21"
                                                                                          stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                    <path d="M9 15H21" stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                    <path d="M9 19.5H21"
                                                                                          stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                </svg>
                                                                            </button>
                                                                            <button
                                                                                class="changeMenu-2 active-row-table ">
                                                                                <svg width="18" height="18"
                                                                                     viewBox="0 0 18 18"
                                                                                     fill="none"
                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M3 6H15" stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                    <path d="M3 12H15" stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                </svg>
                                                                            </button>

                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                                        <label class="form-check-label f-15"
                                                                               for="changeFonts">Збільшити
                                                                            шрифт</label>
                                                                        <div
                                                                            class="form-check form-check-warning form-switch">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input checkbox"
                                                                                   id="changeFonts"/>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                                        <label class="form-check-label f-15"
                                                                               for="changeCol">Зміна
                                                                            розміру
                                                                            колонок</label>
                                                                        <div
                                                                            class="form-check form-check-warning form-switch">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input checkbox"
                                                                                   id="changeCol"/>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div
                                                                        class="d-flex flex-column justify-content-between h-100"
                                                                        id="">
                                                                        <div>
                                                                            <div style="float: left;"
                                                                                 id="jqxlistbox"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-block" id="commodityInvoiceDataTable"></div>
                                                </div>
                                            </div>
                                            <div id="transport-request">
                                                <div class="card-grid" style="position: relative;">

                                                    <div id="offcanvas-end-example">

                                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false"
                                                             tabindex="-1"
                                                             id="settingTable-tr-request"
                                                             aria-labelledby="settingTableLabel"
                                                             style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 5100;"
                                                             data-bs-scroll="true">
                                                            <div class="offcanvas-header">
                                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">
                                                                    Налаштування
                                                                    таблиці</h4>
                                                                <li class="nav-item nav-search text-reset"
                                                                    data-bs-dismiss="offcanvas"
                                                                    aria-label="Close" style="list-style: none;"><a
                                                                        class="nav-link nav-link-grid">
                                                                        <img
                                                                            src="{{asset('assets/icons/close-button.svg')}}"></a>
                                                                </li>
                                                            </div>
                                                            <div class="offcanvas-body p-0">
                                                                <div class="" id="body-wrapper">
                                                                    <div
                                                                        class="d-flex flex-row align-items-center justify-content-between px-2">
                                                                        <div class="form-check-label f-15">Змінити
                                                                            висоту
                                                                            рядка:
                                                                        </div>
                                                                        <div
                                                                            class="form-check form-check-warning form-switch d-flex align-items-center"
                                                                            style="">
                                                                            <button class="changeMenu-3">
                                                                                <svg width="30" height="30"
                                                                                     viewBox="0 0 30 30"
                                                                                     fill="none"
                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M9 10.5H21"
                                                                                          stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                    <path d="M9 15H21" stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                    <path d="M9 19.5H21"
                                                                                          stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                </svg>
                                                                            </button>
                                                                            <button
                                                                                class="changeMenu-2 active-row-table ">
                                                                                <svg width="18" height="18"
                                                                                     viewBox="0 0 18 18"
                                                                                     fill="none"
                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M3 6H15" stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                    <path d="M3 12H15" stroke="#A8AAAE"
                                                                                          stroke-width="1.75"
                                                                                          stroke-linecap="round"
                                                                                          stroke-linejoin="round"/>
                                                                                </svg>
                                                                            </button>

                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                                        <label class="form-check-label f-15"
                                                                               for="changeFonts">Збільшити
                                                                            шрифт</label>
                                                                        <div
                                                                            class="form-check form-check-warning form-switch">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input checkbox"
                                                                                   id="changeFonts"/>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                                        <label class="form-check-label f-15"
                                                                               for="changeCol">Зміна
                                                                            розміру
                                                                            колонок</label>
                                                                        <div
                                                                            class="form-check form-check-warning form-switch">
                                                                            <input type="checkbox"
                                                                                   class="form-check-input checkbox"
                                                                                   id="changeCol"/>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div
                                                                        class="d-flex flex-column justify-content-between h-100"
                                                                        id="">
                                                                        <div>
                                                                            <div style="float: left;"
                                                                                 id="jqxlistbox-tr-request"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="table-block" id="transportRequestDataTable"></div>
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
@endsection

@section('page-script')

    <script src="{{asset('assets/js/entity/transport-planning/create-of-TP.js')}}"></script>

    <!-- Jquery UI start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
            integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Jquery UI end -->

    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>


    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        tableSetting($('#commodityInvoiceDataTable'), '', 85, 100);
        tableSetting($('#transportRequestDataTable'), '-tr-request', 85, 100);
    </script>

    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        offCanvasByBorder($('#commodityInvoiceDataTable'));
        offCanvasByBorder($('#transportRequestDataTable'), '-tr-request');

    </script>
    <script>
        $('#button_sku_tp').click(function (e) {
            $('.custom-pager-select-size').addClass('d-none')
            hidenPaginationInfo()
        });
        $('#tabs').on('click', function () {
            hidenPaginationInfo()
        });

        function hidenPaginationInfo() {
            $('.custom-pager').find('button').on('click', function () {
                $('.custom-pager-select-size').addClass('d-none');

            });
        }
    </script>

    {{--    <script>$(document).ready(function() {--}}
    {{--            $(".flatpickr-range").flatpickr({--}}
    {{--                enableTime: true,--}}
    {{--                noCalendar: true,--}}
    {{--                dateFormat: "H:i",--}}
    {{--                time_24hr: true,--}}
    {{--                defaultDate: ["17:00 -", "20:00"]--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}

    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
    <script src="{{asset('assets/js/utils/validate.js')}}"></script>

@endsection
