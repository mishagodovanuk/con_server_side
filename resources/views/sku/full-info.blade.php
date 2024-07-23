@extends('layouts.admin')
@section('title','Товари')
@section('page-style')
@endsection
@section('before-style')
<link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css" />
@endsection

@section('table-js')
@include('layouts.table-scripts')

<script type="text/javascript">
// Ініціалізуємо таби
$('#tabs').jqxTabs({
    width: '100%',
    height: '100%'
});

// Ініціалізуємо таби
// $('#tabs-1').jqxTabs({
//     width: '100%',
//     height: '100%'
// });
</script>

<script type="module" src="{{asset('assets/js/grid/sku/packing-table.js')}}"></script>
<script type="module" src="{{asset('assets/js/grid/sku/barcode-table.js')}}"></script>
<!-- <script type="module" src="{{asset('assets/js/grid/sku/locations-table.js')}}"></script>
<script type="module" src="{{asset('assets/js/grid/sku/pallets-table.js')}}"></script> -->
<script src="{{asset('assets/js/utils/loader-for-tabs.js')}}"></script>
@endsection

@section('content')
<div id="jqxLoader"></div>
<div class=" mx-2 px-0">
    <div class="tn-details-header d-flex justify-content-between">
        <div class="tn-details-breadcrumbs-nav pb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-slash">
                    <li class="breadcrumb-item"><a href="/sku" style="color: #4B465C;">Товари</a></li>
                    <li class="breadcrumb-item fw-bolder active" aria-current="page">Перегляд товару {{$sku->name}}</li>
                </ol>
            </nav>
        </div>
        <div class="tn-details-actions d-flex gap-2">
            <div><i data-feather='printer' style="cursor: pointer; transform: scale(1.2);"></i></div>
            {{--                href="{{route('sku.destroy',['sku'=>$sku->id])}}"--}}
            <div><i data-feather='copy' style="cursor: pointer; transform: scale(1.2);"></i></div>
            <div><a class="text-secondary" href="{{route('sku.edit',['sku'=>$sku->id])}}"><i data-feather='edit'
                        style="cursor: pointer; transform: scale(1.2);"></i></a>
            </div>
            <div>
                <div class="btn-group">
                    <i data-feather='more-horizontal' id="tn-details-header-dropdown" data-bs-toggle="dropdown"
                        aria-expanded="false" style="cursor: pointer; transform: scale(1.2);"></i>
                    <div class="dropdown-menu" aria-labelledby="tn-details-header-dropdown">
                        <a class="dropdown-item" href="#">Використання продукції</a>
                        <a class="dropdown-item" href="#">Переміщення PC палети </a>
                        <a class="dropdown-item" href="#">Рух продукції</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-0 mb-2">
        <div class="col-12 col-md-12 col-lg-4 pe-0 pe-md-1 ps-0">
            <div class="card px-2 py-1" >
                <div class="card-header px-0 pb-0">
                    <h4 class="card-title fw-bolder w-100 mb-0s" style="padding-left: 6px;">{{$sku->name}}</h4>
                </div>
                <div class="row" style="max-height : 630px; overflow-y: auto;">
                    <div class="col-lg-12 col-md-6 card-body px-1 mt-0">
                        <p class="text-uppercase mb-0" style="color: rgb(168, 170, 174); padding-left: 6px">Основні дані
                        </p>
                        <div class="mx-0 gap-2 card-data-reverse-darker">

                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Компанія</p>    <a class="text-reset text-decoration-underline text-gold"
                                       href="/company/{{$sku->company->id}}">{{$sku->company->name}}</a>
                            </div>
                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Категорія</p>
                                <p class=" m-0 fw-medium-c">{{$sku->category->name}}</p>
                            </div>
                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Виробник</p>
                                <a class="text-reset text-decoration-underline text-gold"
                                   href="/company/{{$sku->manufacturer->id}}">{{$sku->manufacturer->name}}</a>
                            </div>
                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Країна виробник</p>
                                <p class=" m-0 fw-medium-c">{{$sku->manufacturer_country->name}}</p>
                            </div>
                            @if($sku->adr)
                            <div class="mx-0 py-1" style="padding-left: 6px">
                                <p class="m-0 mb-1">ADR</p>
                                <p class=" m-0 fw-medium-c">{{$sku->adr->name}}</p>
                            </div>
                            @endif
                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Одиниця виміру</p>
                                <p class=" m-0 fw-medium-c">{{$sku->measurement_unit->name}}</p>
                            </div>
                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Коментар</p>
                                <p class=" m-0 fw-medium-c">{{$sku->comment}}</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6 card-body px-1 mt-0 pt-0">
                        <p class="text-uppercase mb-0 " style="color: rgb(168, 170, 174); padding-left: 6px">Параметри
                        </p>
                        <div class="mx-0 gap-2 card-data-reverse-darker">


                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Маса нетто</p>
                                <p class=" m-0 fw-medium-c ">{{$sku->weight_netto}} кг</p>
                            </div>
                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Маса брутто</p>
                                <p class=" m-0 fw-medium-c ">{{$sku->weight_brutto}} кг</p>
                            </div>
                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Температурний режим</p>
                                <p class=" m-0 fw-medium-c "> від {{$sku->temp_from}}-{{$sku->temp_to}} &#8451;</p>
                            </div>
                            <div class="mx-0 py-1 " style="padding-left: 6px">
                                <p class="m-0 mb-1">Висота/ширина/довжина</p>
                                <p class=" m-0 fw-medium-c ">{{$sku->height}}/{{$sku->width}}/{{$sku->depth}} см</p>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-12  col-lg-7 pe-0 ps-lg-1 ps-0 " style="flex-grow: 1;">
            <!-- Basic Tabs starts -->
            <div class="col-xl-12 col-lg-12">
                <div class="card-body">
                    <div class="d-flex justify-content-between sku-create-tables">

                        <div id="tabs" class="invisible">
                            <ul class="d-flex ">
                                <li>Пакування</li>
                                <li>Штрих код</li>
                            </ul>

                            <div>
                                <div class="card-grid" style="position: relative;">

                                    <div id="offcanvas-end-example">

                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                            id="settingTable" aria-labelledby="settingTableLabel"
                                            style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                            data-bs-scroll="true">
                                            <div class="offcanvas-header">
                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">
                                                    Налаштування
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
                                                        <div class="form-check-label f-15">Змінити висоту
                                                            рядка:
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
                                    <div class="table-block" id="packing-table">

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="card-grid" style="position: relative;">

                                    <div id="offcanvas-end-example">
                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                            id="settingTable-barcode" aria-labelledby="settingTableLabel"
                                            style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                            data-bs-scroll="true">
                                            <div class="offcanvas-header">
                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">
                                                    Налаштування таблиці
                                                </h4>
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
                                                        <div class="form-check-label f-15">Змінити висоту
                                                            рядка:
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
                                                            for="changeFonts-sku-location">Збільшити
                                                            шрифт</label>
                                                        <div class="form-check form-check-warning form-switch">
                                                            <input type="checkbox" class="form-check-input checkbox"
                                                                id="changeFonts-sku-location" />
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                        <label class="form-check-label f-15"
                                                            for="changeCol-sku-location">Зміна
                                                            розміру
                                                            колонок</label>
                                                        <div class="form-check form-check-warning form-switch">
                                                            <input type="checkbox" class="form-check-input checkbox"
                                                                id="changeCol-sku-location" />
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="d-flex flex-column justify-content-between h-100" id="">
                                                        <div>
                                                            <div style="float: left;" id="jqxlistbox-barcode"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-block" id="barcode-table">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Basic Tabs end -->

            <!-- Basic Tabs starts -->
            <!-- <div class="col-xl-12 col-lg-12 mt-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between">

                        <div id="tabs-1">
                            <ul class="d-flex ">
                                <li>Локація</li>
                                <li>Палети</li>
                            </ul>

                            <div>
                                <div class="card-grid" style="position: relative;">

                                    <div id="offcanvas-end-example">

                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                            id="settingTable-location" aria-labelledby="settingTableLabel"
                                            style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                            data-bs-scroll="true">
                                            <div class="offcanvas-header">
                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">
                                                    Налаштування
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
                                                        <div class="form-check-label f-15">Змінити висоту
                                                            рядка:
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
                                                            <div style="float: left;" id="jqxlistbox-location"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-block" id="location-table">

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="card-grid" style="position: relative;">

                                    <div id="offcanvas-end-example">
                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                            id="settingTable-pallets" aria-labelledby="settingTableLabel"
                                            style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                            data-bs-scroll="true">
                                            <div class="offcanvas-header">
                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">
                                                    Налаштування таблиці
                                                </h4>
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
                                                        <div class="form-check-label f-15">Змінити висоту
                                                            рядка:
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
                                                            for="changeFonts-sku-location">Збільшити
                                                            шрифт</label>
                                                        <div class="form-check form-check-warning form-switch">
                                                            <input type="checkbox" class="form-check-input checkbox"
                                                                id="changeFonts-sku-location" />
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                        <label class="form-check-label f-15"
                                                            for="changeCol-sku-location">Зміна
                                                            розміру
                                                            колонок</label>
                                                        <div class="form-check form-check-warning form-switch">
                                                            <input type="checkbox" class="form-check-input checkbox"
                                                                id="changeCol-sku-location" />
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="d-flex flex-column justify-content-between h-100" id="">
                                                        <div>
                                                            <div style="float: left;" id="jqxlistbox-pallets"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-block" id="pallets-table">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> -->
            <!-- Basic Tabs end -->
        </div>

    </div>

</div>

</div>





@endsection

@section('page-script')

<script src="{{asset('assets/js/entity/sku/sku_info.js')}}"></script>
<script>
    const sku_id = {!! $sku->id !!};
</script>
<script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        tableSetting($('#packing-table'));
        tableSetting($('#barcode-table'), '-barcode');
        // tableSetting($('#location-table'), '-location');
        // tableSetting($('#pallets-table'), '-pallets');
    </script>

    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        offCanvasByBorder($('#packing-table'));
        offCanvasByBorder($('#barcode-table'), '-barcode');
        // offCanvasByBorder($('#location-table'), '-location');
        // offCanvasByBorder($('#pallets-table'), '-pallets');


    </script>

@endsection
