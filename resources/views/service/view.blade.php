@extends('layouts.admin')
@section('title','service-view')
@section('page-style')


@endsection
@section('before-style')

    <!-- <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css" /> -->

@endsection

@section('table-js')
    @include('layouts.table-scripts')

    <!-- <script type="text/javascript">
$('#tabs').jqxTabs({
    width: '100%',
    height: '100%'
});
</script>
<script type="module" src="{{asset('assets/js/grid/service/view-log-1-table.js')}}"></script>
<script type="module" src="{{asset('assets/js/grid/service/view-log-2-table.js')}}"></script> -->

@endsection

@section('content')
    <div class="container-fluid px-2">
        <div class=" d-flex justify-content-between">
            <div class=" pb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/services" style="color: #4B465C;">Послуги</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Перегляд послуги {{$service->name}}
                        </li>

                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-2">
                <div><i data-feather='printer' style="cursor: pointer; transform: scale(1.2);"></i></div>
                <div><i data-feather='copy' style="cursor: pointer; transform: scale(1.2);"></i></div>
                <div><a class="text-secondary" href="/services/{{$service->id}}/edit"><i data-feather='edit'
                                                                                         style="cursor: pointer; transform: scale(1.2);"></i></a>
                </div>
                <div>
                    <div class="btn-group">
                        <i data-feather='more-horizontal' id="tn-details-header-dropdown" data-bs-toggle="dropdown"
                           aria-expanded="false" style="cursor: pointer; transform: scale(1.2);"></i>
                        <div class="dropdown-menu" aria-labelledby="tn-details-header-dropdown">
                            <a class="dropdown-item" href="#">Option 1</a>
                            <a class="dropdown-item" href="#">Option 2</a>
                            <a class="dropdown-item" href="#">Option 3</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-12  col-xl-4 ">
                <div class="card px-2 py-1 ">
                    <div class="card-header px-0 pb-0">
                        <h4 class="card-title fw-bolder w-100 mb-0" style="padding-left: 6px;">{{$service->name}}</h4>
                    </div>
                    <div class="row">


                        <div class="col-lg-12 col-md-6 card-body px-1 mt-0">
                            <p class="text-uppercase mb-0 text-decoration-underline"
                               style="color: rgb(168, 170, 174); padding-left: 6px">Основні дані
                            </p>
                            <div class="mx-0 gap-2 card-data-reverse-darker">


                                <div class="mx-0 py-1 " style="padding-left: 6px">
                                    <p class="fs-6 m-0 mb-50"> Категорія</p>
                                    <p class="fs-5 m-0 fw-medium-c ">{{$service->category->name}}</p>
                                </div>
                                <div class="mx-0 py-1 " style="padding-left: 6px">
                                    <p class="fs-6 m-0 mb-50">Коментар</p>
                                    <p class="fs-5 m-0 fw-medium-c ">{{$service->comment}}</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <!--  Tabs starts -->
            <!-- <div class="col-12 col-xl-8 " style="">
            <div class="">
                <div class="view-service-logs-tables">

                    <div id="tabs" class="w-100">
                        <ul class=" d-flex ">
                            <li>Логи</li>
                            <li>Логи 2</li>


                        </ul>

                        <div>

                            <div>
                                <div class="card-grid" style="position: relative;">

                                    <div id="offcanvas-end-example">

                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                            id="settingTable" aria-labelledby="settingTableLabel"
                                            style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                            data-bs-scroll="true">
                                            <div class="offcanvas-header">
                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування
                                                    таблиці</h4>
                                                <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                                    aria-label="Close" style="list-style: none;"><a
                                                        class="nav-link nav-link-grid">
                                                        <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                                                </li>
                                            </div>
                                            <div class="offcanvas-body p-0">
                                                <div class="" id="body-wrapper">
                                                    <div
                                                        class="d-flex flex-row align-items-center justify-content-between px-2">
                                                        <div class="form-check-label f-15">Змінити висоту рядка:
                                                        </div>
                                                        <div class="form-check form-check-warning form-switch d-flex align-items-center"
                                                            style="">
                                                            <button class="changeMenu-3">
                                                                <svg width="30" height="30" viewBox="0 0 30 30"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M9 15H21" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </button>
                                                            <button class="changeMenu-2 active-row-table ">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M3 6H15" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M3 12H15" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
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
                                                                id="changeFonts" />
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                        <label class="form-check-label f-15" for="changeCol">Зміна
                                                            розміру
                                                            колонок</label>
                                                        <div class="form-check form-check-warning form-switch">
                                                            <input type="checkbox" class="form-check-input checkbox"
                                                                id="changeCol" />
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
                                    <div class="table-block" id="view-log-1-table">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div>

                            <div>
                                <div class="card-grid" style="position: relative;">

                                    <div id="offcanvas-end-example">

                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                            id="settingTable-log-2" aria-labelledby="settingTableLabel"
                                            style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                            data-bs-scroll="true">
                                            <div class="offcanvas-header">
                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування
                                                    таблиці</h4>
                                                <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                                    aria-label="Close" style="list-style: none;"><a
                                                        class="nav-link nav-link-grid">
                                                        <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                                                </li>
                                            </div>
                                            <div class="offcanvas-body p-0">
                                                <div class="" id="body-wrapper">
                                                    <div
                                                        class="d-flex flex-row align-items-center justify-content-between px-2">
                                                        <div class="form-check-label f-15">Змінити висоту рядка:
                                                        </div>
                                                        <div class="form-check form-check-warning form-switch d-flex align-items-center"
                                                            style="">
                                                            <button class="changeMenu-3">
                                                                <svg width="30" height="30" viewBox="0 0 30 30"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M9 15H21" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </button>
                                                            <button class="changeMenu-2 active-row-table ">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M3 6H15" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M3 12H15" stroke="#A8AAAE"
                                                                        stroke-width="1.75" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </button>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                        <label class="form-check-label f-15"
                                                            for="changeFonts-log-2">Збільшити
                                                            шрифт</label>
                                                        <div class="form-check form-check-warning form-switch">
                                                            <input type="checkbox" class="form-check-input checkbox"
                                                                id="changeFonts-log-2" />
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                        <label class="form-check-label f-15" for="changeCol-log-2">Зміна
                                                            розміру
                                                            колонок</label>
                                                        <div class="form-check form-check-warning form-switch">
                                                            <input type="checkbox" class="form-check-input checkbox"
                                                                id="changeCol-log-2" />
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="d-flex flex-column justify-content-between h-100" id="">
                                                        <div>
                                                            <div style="float: left;" id="jqxlistbox-log-2"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-block" id="view-log-2-table">

                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </div> -->
            <!--  Tabs end -->


        </div>


    </div>

@endsection

@section('page-script')

    <!-- <script type="module">
import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';
tableSetting($('#view-log-1-table'));
tableSetting($('#view-log-2-table'),'-log-2');
</script>





<script type="module">
import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';
offCanvasByBorder($('#view-log-1-table'));
offCanvasByBorder($('#view-log-2-table'),'-log-2');
</script> -->

@endsection
