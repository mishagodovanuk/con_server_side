@extends('layouts.admin')
@section('title','')
@section('page-style')
@endsection
@section('before-style')
<link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
<link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css" />
@endsection
@section('table-js')
@include('layouts.table-scripts')
<script type="module" src="{{asset('assets/js/utils/payment-obligation.js')}}"></script>
<script type="module" src="{{asset('assets/js/grid/invoice/selected-payment-obligations-table.js')}}"></script>
<script type="module" src="{{asset('assets/js/grid/invoice/payment-obligations-table.js')}}"></script>
@endsection

@section('content')
<div class="px-2">
    <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
        <div class="tn-details-breadcrumbs-nav align-self-start">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-slash">
                    <li class="breadcrumb-item"><a href="/sku" style="color: #4B465C;">Документи</a></li>
                    <li class="breadcrumb-item"><a href="/sku" style="color: #4B465C;">Рахунки</a></li>
                    <li class="breadcrumb-item fw-bolder active" aria-current="page">Виставлення рахунку</li>
                </ol>
            </nav>
        </div>
        <div class="tn-details-actions d-flex gap-1 align-self-end ">
            <button type="submit" class="btn btn-flat-primary">
                Зберегти як чернетку
            </button>
            <button type="submit" class="btn btn-green">
                Зберегти
            </button>
        </div>
    </div>

    <div class="">
        <form action="" method="">

            <div class="card mb-2 py-1">
                <div class="row mx-0">
                    <div class="card col-12 p-2 mb-0">
                        <div class="card-header p-0">
                            <h4 class="card-title fw-bolder">Виставлення рахунку № 12342342</h4>
                        </div>
                        <div class="card-body p-0 mt-1">
                            <div class="row">

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="supplier-of-services select2-hide-search">Компанія постачальник послуг</label>
                                    <select class="select2 form-select" id="supplier-of-services" data-placeholder="Оберіть компанію постачальника послуг">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="responsible-for-supply select2-hide-search">Відповідальний за постачання послуг ПІБ
                                    </label>
                                    <select class="select2 form-select" id="responsible-for-supply" data-placeholder="Оберіть компанію постачальника послуг">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="recipient-of-services select2-hide-search">Компанія отримувач послуг</label>
                                    <select class="select2 form-select" id="recipient-of-services" data-placeholder="Оберіть компанію отримувача послуг">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="responsible-for-receiving select2-hide-search">Відповідальний за отримання послуг (ПІБ)</label>
                                    <select class="select2 form-select" id="responsible-for-receiving" data-placeholder="Оберіть компанію постачальника послуг">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="basis-of-contract select2-hide-search">На основі договору</label>
                                    <select class="select2 form-select" id="basis-of-contract" data-placeholder="Оберіть договір">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1 position-relative">
                                    <label class="form-label" for="fp-default">Рахунок від</label>
                                    <input type="text" id="fp-default" class="form-control flatpickr-basic flatpickr-input" required placeholder="РРРР-ММ-ДД" name="group" readonly="readonly">
                                    <span class="cursor-pointer text-secondary position-absolute top-50" style="right : 27px;pointer-events: none;"><i data-feather="calendar"></i></span>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="disabledInput">Сума без ПДВ</label>
                                    <input type="text" class="form-control" id="readonlyInput" readonly="readonly" value="0.00 грн" disabled />
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="disabledInput2">Сума з ПДВ</label>
                                    <input type="text" class="form-control" id="readonlyInput" readonly="readonly" value="0.00 грн" disabled />
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="payment-term select2-hide-search">Термін оплати</label>
                                    <select class="select2 form-select" id="payment-term" data-placeholder="Оберіть термін оплати">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>

                                <!-- For errors -->
                                <!-- <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                                    
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header border-bottom row mx-0 gap-1">
            <h4 class="card-title col-auto fw-bolder px-0">Платіжні зобов‘язання</h4>
            <div class="col-auto d-flex  flex-grow-1 justify-content-end pe-0">

            </div>
        </div>

        @if(True)
        <div class="card-grid" style="position: relative;">

            <div id="offcanvas-end-example">
                <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="settingTable" aria-labelledby="settingTableLabel" style="width: 400px; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;" data-bs-scroll="true">
                    <div class="offcanvas-header">
                        <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                        <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas" aria-label="Close" style="list-style: none;"><a class="nav-link nav-link-grid">
                                <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                        </li>
                    </div>
                    <div class="offcanvas-body p-0">
                        <div class="" id="body-wrapper">
                            <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                <div class="form-check-label f-15">Змінити висоту рядка:</div>
                                <div class="form-check form-check-warning form-switch d-flex align-items-center" style="">
                                    <button class="changeMenu-3">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <button class="changeMenu-2 active-row-table ">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>

                                </div>
                            </div>
                            <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                <label class="form-check-label f-15" for="changeFonts">Збільшити шрифт</label>
                                <div class="form-check form-check-warning form-switch">
                                    <input type="checkbox" class="form-check-input checkbox" id="changeFonts" />
                                </div>
                            </div>
                            <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                <label class="form-check-label f-15" for="changeCol">Зміна розміру
                                    колонок</label>
                                <div class="form-check form-check-warning form-switch">
                                    <input type="checkbox" class="form-check-input checkbox" id="changeCol" />
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
            <div class="table-block" id="selected-payment-obligations-table">

            </div>
        </div>
        @else
        <div style="margin: 50px 0;">
            <div class=" text-center">
                Немає доданих платіжних зобовʼязань
            </div>
            <div class="text-center mt-2">
                <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#modalPaymentObligations">
                    Додати
                    платіжне зобов‘язання
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="modal fade" id="modalPaymentObligations" tabindex="-1" aria-labelledby="modalPaymentObligations" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content p-3">
            <div class="pb-2">
                <h3 class="text-center">Додати платіжні зобов‘язання</h3>
            </div>
            <div class="card mb-0">
                <div class="card-header border-bottom row mx-0 gap-1">
                    <h4 class="card-title col-auto fw-bolder px-0">Платіжні зобов‘язання</h4>
                    <div class="col-auto d-flex  flex-grow-1 justify-content-end pe-0">

                    </div>
                </div>
                <div class="card-grid" style="position: relative;">

                    <div id="offcanvas-end-example">
                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="settingTable" aria-labelledby="settingTableLabel" style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;" data-bs-scroll="true">
                            <div class="offcanvas-header">
                                <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                                <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas" aria-label="Close" style="list-style: none;"><a class="nav-link nav-link-grid">
                                        <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                                </li>
                            </div>
                            <div class="offcanvas-body p-0">
                                <div class="" id="body-wrapper">
                                    <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                        <div class="form-check-label f-15">Змінити висоту рядка:</div>
                                        <div class="form-check form-check-warning form-switch d-flex align-items-center" style="">
                                            <button class="changeMenu-3">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                            <button class="changeMenu-2 active-row-table ">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>

                                        </div>
                                    </div>
                                    <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                        <label class="form-check-label f-15" for="changeFonts">Збільшити шрифт</label>
                                        <div class="form-check form-check-warning form-switch">
                                            <input type="checkbox" class="form-check-input checkbox" id="changeFonts" />
                                        </div>
                                    </div>
                                    <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                        <label class="form-check-label f-15" for="changeCol">Зміна розміру
                                            колонок</label>
                                        <div class="form-check form-check-warning form-switch">
                                            <input type="checkbox" class="form-check-input checkbox" id="changeCol" />
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
                    <div class="table-block" id="payment-obligations-table">
                    </div>
                </div>
            </div>
            <div class="d-flex pt-2 gap-1 justify-content-end">
                <button type="button" class="btn btn-flat-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal">Скасувати</button>
                <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal">Додати</button>
            </div>
        </div>
    </div>
</div>


<!-- модалка платіжне зобов‘язання -->
<div class="modal fade" id="modalPaymentObligation" tabindex="-1" aria-labelledby="modalPaymentObligation"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-ld" style="max-width:928px;">
        <div class="modal-content p-5" >
            <h2 class="mb-1 mt-0 text-center"> Платіжне зобов‘язання №<span id="title-number-PO">432423</span></h2>
            <p class="mb-2 text-center">Ви можете відредагувати вартість платіжного зобов'язання в більшу або меншу
                сторону</p>
            <div class="row">

                <div class="col-sm-12 col-md-5 px-1 mt-0 pe-2 border-end">
                    <div style="padding-left:6px;">
                        <h4 class="fw-15 ">Загальна інформація
                        </h4>
                    </div>
                    <div class="card-data-reverse-darker">


                        <div style="padding: 6px 0 6px 6px;">
                            <p style="margin:5px 0;">Платіжне зобов‘язання</p>
                            <a class=" m-0 fw-medium-c text-secondary text-decoration-underline" href="#">№<span
                                    id="number-info-PO">432423</span></a>
                        </div>
                        <div style="padding: 6px 0 6px 6px;">
                            <p style="margin:5px 0;">На основі договору</p>
                            <a class=" m-0 fw-medium-c text-secondary text-decoration-underline" href="#">№<span
                                    id="number-contract-info">432423</span></a>
                        </div>
                        <div style="padding: 6px 0 6px 6px;">
                            <p style="margin:5px 0;">На основі послуги</p>
                            <a class=" m-0 fw-medium-c text-secondary text-decoration-underline" href="#">№<span
                                    id="number-service-info">432423</span></a>
                        </div>
                        <div style="padding: 6px 0 6px 6px;">
                            <p style="margin:5px 0;">Отримувач послуг</p>
                            <a class=" m-0 fw-medium-c text-secondary text-decoration-underline"
                                id="recipient-name-info" href="#">ТОВ КОндитирська </a>
                        </div>
                        <div style="padding: 6px 0 6px 6px;">
                            <p style="margin:5px 0;">Виконавець послуги</p>
                            <a class=" m-0 fw-medium-c text-secondary text-decoration-underline"
                                id="performer-name-info" href="#">ТОВ КОндитирська </a>
                        </div>
                        <div style="padding: 6px 0 6px 6px;">
                            <p style="margin:5px 0;">Дата надання послуг</p>
                            <p class=" m-0 fw-medium-c" id="date-invoice-info">01.05.2023 </p>
                        </div>
                        <div style="padding: 6px 0 6px 6px;">
                            <p style="margin:5px 0;">Сума платіжного зобов‘язання</p>
                            <p class=" m-0 fw-medium-c" id="date-invoice"> <span id="cost-invoice-info">34000.00</span>
                                грн </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 ps-2 ">
                    <!-- block додати коригування -->
                    <div id="block-start-cost" class="d-none h-100">
                        <h4 class="fw-15 ">Коригування вартості</h4>
                        <div class="p-4 d-flex flex-column align-items-center h-100 justify-content-center">
                            <p>Немає доданих коригувань</p>
                            <button class="btn btn-outline-primary btn-sm" id="btn-add-correction">Додати
                                коригування</button>
                        </div>
                    </div>
                    <!-- block додати коригування вартості -->
                    <div id="block-add-correction-cost" class="d-none h-100">
                        <h4 class="fw-15 mb-2"> <a href="#" class="text-black" id="link-to-back-start-cost"><i
                                    data-feather="arrow-left" style="transform:scale(1.3);"
                                    class="me-25 cursor-pointer"></i>
                            </a> Додати коригування вартості</h4>
                        <div class="d-flex gap-2 mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedWay" id="increaseCost"
                                    checked>
                                <label class="form-check-label" for="increaseCost">
                                    В більшу сторону
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkedWay" id="reduceCost">
                                <label class="form-check-label" for="reduceCost">
                                    В меншу сторону
                                </label>
                            </div>
                        </div>
                        <div class="mb-1" id="block-reason">
                            <label class="form-label" for="reason">Причина додавання додаткової вартості</label>
                            <select class="select2 form-select" id="reason" data-placeholder="Оберіть причину">
                                <option value=""></option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div class="mb-1 d-none" id="block-type-of-problem">
                            <label class="form-label" for="type-of-problem">Тип проблеми</label>
                            <select class="select2 form-select" id="type-of-problem"
                                data-placeholder="Оберіть проблему">
                                <option value=""></option>
                                <option value="1">1</option>
                            </select>
                        </div>

                        <div class="row mb-1">
                            <div class="col-6">
                                <label class="form-label" for="status">Статус</label>
                                <select class="select2 form-select" id="status" data-placeholder="Оберіть статус">
                                    <option value=""></option>
                                    <option value="Pозвантаження">Розвантаження</option>
                                    <option value="Завантаження">Завантаження</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="location">Локація</label>
                                <select class="select2 form-select" id="location" data-placeholder="Оберіть локацію">
                                    <option value=""></option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-1" id="block-amountOfAdditionalCost">
                            <label class="form-label">Сума додаткової вартості</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="+1000.00"
                                    id="amountOfAdditionalCost">
                                <span class="input-group-text">грн</span>
                            </div>
                        </div>
                        <div class="mb-1 d-none" id="block-amountPenalty">
                            <label class="form-label">Сума штрафу</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="-1000.00" id="amountPenalty">
                                <span class="input-group-text">грн</span>
                            </div>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="text-for-comment">Коментар</label>
                            <textarea class="form-control " id="comment" rows="3"
                                placeholder="Залиште коментар"></textarea>
                        </div>
                        <button class="w-100 btn btn-outline-primary" id="add-to-correction-list"> Додати
                            коригування</button>



                    </div>
                    <!-- block вибраних коригувань -->
                    <div id="block-selected-correction" class="h-100 d-none">
                        <div class="mb-1 d-flex justify-content-between">
                            <h4 class="fw-15 mb-0">Коригування вартості</h4>
                            <a href="#" id="link-to-add-correction">Додати коригування</a>
                        </div>
                        <div style="height:400px;overflow: scroll;" id="list-selected-correction">

                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <p class="fw-medium-c fs-5 m-0 lh-1">Вартість з урахуванням коригування</p>
                            <p class="fw-medium-c fs-5 m-0 lh-1"><span id="item-amount">22000</span> грн</p>
                        </div>
                    </div>



                </div>
                <div class="mt-2 d-flex justify-content-end " id="btns-action-modal"><button
                        class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        Скасувати
                    </button>
                    <button type="button" class="btn btn-primary" id="btn-save-PO" disabled>
                        Зберегти</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end -->
@endsection

@section('page-script')
<script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>

<script type="module">
    import {
        tableSetting
    } from '{{asset('
    assets / js / grid / components / table - setting.js ')}}';

    tableSetting($('#selected-payment-obligations-table'));
</script>
<script type="module">
    import {
        offCanvasByBorder
    } from '{{asset('
    assets / js / utils / offCanvasByBorder.js ')}}';

    offCanvasByBorder($('#selected-payment-obligations-table'));
</script>

<script type="module">
    import {
        tableSetting
    } from '{{asset('
    assets / js / grid / components / table - setting.js ')}}';

    tableSetting($('#payment-obligations-table'));
</script>
<script type="module">
    import {
        offCanvasByBorder
    } from '{{asset('
    assets / js / utils / offCanvasByBorder.js ')}}';

    offCanvasByBorder($('#payment-obligations-table'));
</script>
@endsection