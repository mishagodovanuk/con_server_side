@extends('layouts.admin')
@section('title','')
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
@endsection

@section('table-js')
    @include('layouts.table-scripts')
    <script type="module" src="{{asset('assets/js/grid/registers/storekeeper-table.js')}}"></script>

@endsection

@section('content')
    <div class="loader" style="display: none">
        <span></span>
    </div>
    <div class="card mt-0 m-2">
        <div class="card-header border border-bottom-0 row mx-0 d-flex">
            <h4 class="card-title col-auto fw-bolder">Автореєстр комірники</h4>
            <div class="px-0 d-flex col-10 justify-content-end align-items-center gap-1">
                <label class="form-label" for="u_street select2-hide-search">Склад</label>
                <div class="col-3">
                    <select class="select2 form-select hide-search" id="warehouse-select"
                            data-placeholder="Виберіть склад" multiple>
                        <option value=""></option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>

        </div>
        <div class="card-grid" style="position: relative;">
            <div id="offcanvas-end-example">
                <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="settingTable"
                     aria-labelledby="settingTableLabel"
                     style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;"
                     data-bs-scroll="true">
                    <div class="offcanvas-header">
                        <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                        <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                            style="list-style: none;"><a class="nav-link nav-link-grid">
                                <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                        </li>
                    </div>
                    <div class="offcanvas-body p-0">
                        <div class="" id="body-wrapper">
                            <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                <div class="form-check-label f-15">Змінити висоту рядка:</div>
                                <div class="form-check form-check-warning form-switch d-flex align-items-center"
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
                            <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                <label class="form-check-label f-15" for="changeFonts">Збільшити шрифт</label>
                                <div class="form-check form-check-warning form-switch">
                                    <input type="checkbox" class="form-check-input checkbox"
                                           id="changeFonts"/>
                                </div>
                            </div>
                            <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                <label class="form-check-label f-15" for="changeCol">Зміна розміру колонок</label>
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
            <div class="table-block" id="storekeeperRegisterTable">
                <div id="cellbegineditevent"></div>
                <div style="margin-top: 10px;" id="cellendeditevent"></div>
                <script type="text/javascript" src="{{asset('assets/js/grid/registers/register-actions.js')}}"></script>
            </div>

        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        tableSetting($('#storekeeperRegisterTable'));

    </script>
    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        offCanvasByBorder($('#storekeeperRegisterTable'));

    </script>

    <script>
        var storekeepers = {!! $storekeepers->toJson() !!};
        var transportDownload = {!! $transportDownload->toJson() !!};
        var downloadZone = {!! $downloadZone->toJson() !!};
    </script>
@endsection

