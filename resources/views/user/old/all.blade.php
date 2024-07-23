@extends('layouts.admin')
@section('title','')
@section('before-style')

    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
@endsection

@section('table-js')
    @include('layouts.table-scripts')
    <script type="module" src="{{asset('assets/js/grid/user/all-table.js')}}"></script>

@endsection

@section('content')
    <div class="card mx-2">
        <div class="card-header border-bottom row mx-0 gap-1">
            <h4 class="card-title col-auto fw-bolder">Користувачі</h4>
            <div class="col-auto d-flex  flex-grow-1 justify-content-end pe-0">
                <a class="btn btn-green" href="{{route('user.create')}}">
                    <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}" alt="plus">
                    Добавити користувача
                </a>
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
                        <div class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                             style="list-style: none;"><a class="nav-link nav-link-grid">
                                <img src="{{asset('assets/icons/close-button.svg')}}" alt="close-button"></a>
                        </div>
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
                            <div class="d-flex flex-column justify-content-between h-100">
                                <div>
                                    <div style="float: left;" id="jqxlistbox"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="table-block" id="usersDataTable"></div>

        </div>
    </div>

    <div class="toast basic-toast position-fixed top-0 end-0 mt-5 me-3 fade show"
         style="background: rgb(255,255,255);display: none">
        <div class="toast-header pt-2">
            <img src="{{asset('assets/icons/check.svg')}}" class="me-1" alt="Toast image" height="18" width="25">
            <strong style="font-weight: 600;font-size: 15px;" class="me-auto">Користувача успішно додано</strong>
            <button type="button" class="ms-0 btn-close p-0" style="width: 45px" data-bs-dismiss="toast"
                    aria-label="Close"></button>
        </div>
        <div id="alert-body" style="margin-left: 50px; font-size: 14px; margin-top: 5px">

        </div>
        <div class="mt-1 mb-1 d-flex justify-content-between gap-1 pe-2 ps-5 flex-grow-1">
            <button id="send_email" class="btn send_email  py-0  px-1 btn-primary"><img class="me-1"
                                                                                        src="{{asset('assets/icons/mail-forward.svg')}}"
                                                                                        alt="mail-forward">Відправити
            </button>
            <button type="button" id="copy" class="btn copy px-1 py-0 btn-outline-primary"><i class="me-1"
                                                                                              data-feather='copy'></i>Копіювати
            </button>
        </div>
    </div>
    <textarea style="position: absolute;left: -999999999px;" name="temp" tabindex="-1" id="temp"></textarea>
@endsection
@section('page-script')
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        tableSetting($('#usersDataTable'));

    </script>
    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        offCanvasByBorder($('#usersDataTable'));

    </script>

    {{--    For new users--}}
    <script src="{{asset('assets/js/user-toast.js')}}"></script>

@endsection

