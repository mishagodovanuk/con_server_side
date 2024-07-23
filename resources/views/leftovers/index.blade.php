@extends('layouts.admin')
@section('title','Залишки')
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
@endsection

@section('table-js')
    @include('layouts.table-scripts')
    <script type="module" src="{{asset('assets/js/grid/leftovers/leftovers-table.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/leftovers/leftovers-1-table.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/leftovers/leftovers-2-table.js')}}"></script>

    <script type="text/javascript">
        // Ініціалізуємо таб
        $('#tabs').jqxTabs({
            width: '100%',
            height: '100%'
        });

        var warehouses = {!! $warehouses !!};

        let options;

        warehouses.forEach((item) => {
            options += `<option value="${item.id}">${item.name}</option>`;
        });
        var addButton =  $(`<div style="margin-left:auto"> <div class="h-100 d-flex gap-1 align-items-center"> <p class="m-0 fw-bold" style="color:#6F6B7D">Cклад:</p> <div style="width:300px; margin-left:auto">
                                              <select class="select2 form-select" multiple="multiple" id="warehouse-type">
                                                  <option value=""></option>
                                                ${options}
                                             </select>
                                          </div></div>
      
                                      </div>`);


        addButton.appendTo('.jqx-tabs-title-container ');

    </script>

    <script src="{{asset('assets/js/utils/loader-for-tabs.js')}}"></script>

@endsection

@section('content')
    <div id="jqxLoader"></div>
    @if(count($leftovers))
        <div class="card m-2">
            <div id="tabs" class="tabs-leftovers invisible">
                <ul class="d-flex ">
                    <li>Залишки</li>
                    <li>Залишки по партіях</li>
                    <li>Залишки по партіях і пакуванню</li>
                </ul>
                <div>
                    <div class="card-grid" style="position: relative;">

                        <div id="offcanvas-end-example">
                            <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                 id="settingTable"
                                 aria-labelledby="settingTableLabel"
                                 style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;"
                                 data-bs-scroll="true">
                                <div class="offcanvas-header">
                                    <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                                    <div class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                         aria-label="Close"
                                         style="list-style: none;"><a class="nav-link nav-link-grid">
                                            <img src="{{asset('assets/icons/close-button.svg')}}"
                                                 alt="close-button"></a>
                                    </div>
                                </div>
                                <div class="offcanvas-body p-0">
                                    <div class="" id="body-wrapper">
                                        <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                            <div class="form-check-label f-15">Змінити висоту рядка:</div>
                                            <div
                                                class="form-check form-check-warning form-switch d-flex align-items-center"
                                                style="">
                                                <button class="changeMenu-3">
                                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>
                                                <button class="changeMenu-2 active-row-table ">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>

                                            </div>
                                        </div>
                                        <div
                                            class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                            <label class="form-check-label f-15" for="changeFonts">Збільшити
                                                шрифт</label>
                                            <div class="form-check form-check-warning form-switch">
                                                <input type="checkbox" class="form-check-input checkbox"
                                                       id="changeFonts"/>
                                            </div>
                                        </div>
                                        <div
                                            class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                            <label class="form-check-label f-15" for="changeCol">Зміна розміру
                                                колонок</label>
                                            <div class="form-check form-check-warning form-switch">
                                                <input type="checkbox" class="form-check-input checkbox"
                                                       id="changeCol"/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex flex-column justify-content-between h-100" id="">
                                            <div>
                                                <div style="float: left;" id="jqxlistbox"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="table-block" id="leftoversDataTable">

                        </div>
                    </div>
                </div>
                <div>
                    <div class="card-grid" style="position: relative;">

                        <div id="offcanvas-end-example">
                            <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                 id="settingTable-1"
                                 aria-labelledby="settingTableLabel"
                                 style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;"
                                 data-bs-scroll="true">
                                <div class="offcanvas-header">
                                    <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                                    <div class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                         aria-label="Close"
                                         style="list-style: none;"><a class="nav-link nav-link-grid">
                                            <img src="{{asset('assets/icons/close-button.svg')}}"
                                                 alt="close-button"></a>
                                    </div>
                                </div>
                                <div class="offcanvas-body p-0">
                                    <div class="" id="body-wrapper">
                                        <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                            <div class="form-check-label f-15">Змінити висоту рядка:</div>
                                            <div
                                                class="form-check form-check-warning form-switch d-flex align-items-center"
                                                style="">
                                                <button class="changeMenu-3">
                                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>
                                                <button class="changeMenu-2 active-row-table ">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>

                                            </div>
                                        </div>
                                        <div
                                            class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                            <label class="form-check-label f-15" for="changeFonts">Збільшити
                                                шрифт</label>
                                            <div class="form-check form-check-warning form-switch">
                                                <input type="checkbox" class="form-check-input checkbox"
                                                       id="changeFonts"/>
                                            </div>
                                        </div>
                                        <div
                                            class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                            <label class="form-check-label f-15" for="changeCol">Зміна розміру
                                                колонок</label>
                                            <div class="form-check form-check-warning form-switch">
                                                <input type="checkbox" class="form-check-input checkbox"
                                                       id="changeCol"/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex flex-column justify-content-between h-100" id="">
                                            <div>
                                                <div style="float: left;" id="jqxlistbox-1"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="table-block" id="leftoversDataTable1">

                        </div>
                    </div>
                </div>
                <div>
                    <div class="card-grid" style="position: relative;">

                        <div id="offcanvas-end-example">
                            <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                 id="settingTable-2"
                                 aria-labelledby="settingTableLabel"
                                 style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;"
                                 data-bs-scroll="true">
                                <div class="offcanvas-header">
                                    <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                                    <div class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                         aria-label="Close"
                                         style="list-style: none;"><a class="nav-link nav-link-grid">
                                            <img src="{{asset('assets/icons/close-button.svg')}}"
                                                 alt="close-button"></a>
                                    </div>
                                </div>
                                <div class="offcanvas-body p-0">
                                    <div class="" id="body-wrapper">
                                        <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                            <div class="form-check-label f-15">Змінити висоту рядка:</div>
                                            <div
                                                class="form-check form-check-warning form-switch d-flex align-items-center"
                                                style="">
                                                <button class="changeMenu-3">
                                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>
                                                <button class="changeMenu-2 active-row-table ">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>

                                            </div>
                                        </div>
                                        <div
                                            class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                            <label class="form-check-label f-15" for="changeFonts">Збільшити
                                                шрифт</label>
                                            <div class="form-check form-check-warning form-switch">
                                                <input type="checkbox" class="form-check-input checkbox"
                                                       id="changeFonts"/>
                                            </div>
                                        </div>
                                        <div
                                            class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                            <label class="form-check-label f-15" for="changeCol">Зміна розміру
                                                колонок</label>
                                            <div class="form-check form-check-warning form-switch">
                                                <input type="checkbox" class="form-check-input checkbox"
                                                       id="changeCol"/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex flex-column justify-content-between h-100" id="">
                                            <div>
                                                <div style="float: left;" id="jqxlistbox-2"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="table-block" id="leftoversDataTable2">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    @else
        <div style="margin-top: 253px">
            <div class="empty-company text-center">
                У вас ще немає жодних залишків!
            </div>
            <div class="empty-company-title empty-company-title-m text-center mt-1">
                Залишки з'являться створивши документ "Прихід від постачальника" та після дії "Опрацювання"
            </div>
            <div class="text-center mt-2">
                <a href="/document/table/4"
                   class="btn btn-green">
                    <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}" alt="plus">
                    Створити документ
                </a>
            </div>
        </div>

    @endif
@endsection

@section('page-script')
    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        tableSetting($('#leftoversDataTable'), '', 80, 120);
        tableSetting($('#leftoversDataTable1'), '-1', 80, 120);
        tableSetting($('#leftoversDataTable2'), '-2', 80, 120);

    </script>
    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        offCanvasByBorder($('#leftoversDataTable'), '');
        offCanvasByBorder($('#leftoversDataTable1'), '-1');
        offCanvasByBorder($('#leftoversDataTable2'), '-2');

    </script>
@endsection
