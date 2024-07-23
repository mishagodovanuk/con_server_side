@extends('layouts.admin')
@section('title','invoice-view')
@section('page-style')


@endsection
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
@endsection

@section('table-js')
    @include('layouts.table-scripts')
    <script type="module" src="{{asset('assets/js/entity/invoice/invoice-view.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/invoice/selected-payment-obligations-table.js')}}"></script>
@endsection

@section('content')
    <!-- модалка платіжне зобов‘язання -->
    <div class="modal fade" id="modalPaymentObligation" tabindex="-1" aria-labelledby="modalPaymentObligation"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-ld" style="max-width:928px;">
            <div class="modal-content p-5">
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
                                <p class=" m-0 fw-medium-c" id="date-invoice"><span
                                        id="cost-invoice-info">34000.00</span>
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
                                    коригування
                                </button>
                            </div>
                        </div>
                        <!-- block додати коригування вартості -->
                        <div id="block-add-correction-cost" class="d-none h-100">
                            <h4 class="fw-15 mb-2"><a href="#" class="text-black" id="link-to-back-start-cost"><i
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
                                    <select class="select2 form-select" id="location"
                                            data-placeholder="Оберіть локацію">
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
                                коригування
                            </button>


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
                    <div class="mt-2 d-flex justify-content-end " id="btns-action-modal">
                        <button
                            class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            Скасувати
                        </button>
                        <button type="button" class="btn btn-primary" id="btn-save-PO" disabled>
                            Зберегти
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->


    <div class="container-fluid px-2">
        <div class=" d-flex justify-content-between">
            <div class=" pb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/service" style="color: #6F6B7D;">Документи</a></li>
                        <li class="breadcrumb-item"><a href="/service" style="color: #6F6B7D;">Рахунки</a></li>
                        <li class="breadcrumb-item fw-bolder"><a href="#" style="color: #6F6B7D;">Перегляд рахунку
                                №4234234
                            </a>
                        </li>

                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-2">
                <div><i data-feather='printer' style="cursor: pointer; transform: scale(1.2);"></i></div>
                <div><i data-feather='copy' style="cursor: pointer; transform: scale(1.2);"></i></div>
                <div id="btn-actions-edit"><i data-feather='edit' style="cursor: pointer; transform: scale(1.2);"></i>
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

        <!-- контент -->
        <div class="row">

            <div class="col-12  col-xl-9 " id="block-content-view">
                <div class="card p-2 mb-1 pe-0">
                    <div class=" px-0 d-flex gap-1">
                        <h4 class="card-title fw-bolder pt-0 ">Рахунок №12232423</h4>
                        <!-- контейнер з статусами рахунку -->
                        <div class="">
                            <div class=" d-none alert alert-secondary  p-0" style="padding : 2px 10px !important;"
                                 id="status-invoice-create"> Створено
                            </div>
                            <div class="d-none  alert alert-primary  p-0" style="padding : 2px 10px !important;"
                                 id="status-invoice-sent-for-payment"> Надіслано на оплату
                            </div>
                            <div class=" d-none alert alert-primary  p-0" style="padding : 2px 10px !important;"
                                 id="status-invoice-waiting-for-your-payment"> Очікує на вашу оплату
                            </div>
                            <div class=" d-none alert alert-success  p-0" style="padding : 2px 10px !important;"
                                 id="status-invoice-paid-by-contractor"> Оплачено контрагентом
                            </div>
                            <div class="d-none  alert alert-success  p-0" style="padding : 2px 10px !important;"
                                 id="status-invoice-paid-by-you"> Оплачено вами
                            </div>
                            <div class="d-none alert alert-danger p-0" style="padding : 2px 10px !important;"
                                 id="status-invoice-rejected-by-you"> Відхилено вами
                            </div>
                            <div class="d-none alert alert-danger p-0" style="padding : 2px 10px !important;"
                                 id="status-invoice-rejected-by-contractor"> Відхилено контрагентом
                            </div>

                        </div>

                    </div>
                    <div class="card-body px-0 py-0 row">
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Тип рахунку</p>
                                <p class="f-15 fw-5 " style="width:180px; ">Вихідний</p>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Компанія постачальник</p>
                                <a class="f-15 fw-5 text-decoration-underline" href="#"
                                   style="color: #6F6B7D; width:180px;">ТОВ "КОНДИТЕРСЬКА ФАБРИКА"ЯРИЧ"</a>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Відпов. особа постачальника</p>
                                <a class="f-15 fw-5 text-decoration-underline" href="#"
                                   style="color: #6F6B7D; width:180px;">Кисіль Наталія</a>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Компанія отримувач</p>
                                <a class="f-15 fw-5 text-decoration-underline" href="#"
                                   style="color: #6F6B7D; width:180px;">НАВІГАТОР ТД ТОВ</a>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Відпов. особа отримувача</p> <a
                                    class="f-15 fw-5 text-decoration-underline" href="#"
                                    style="color: #6F6B7D; width:180px;">Решетняк Максим</a>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">На основі договору</p> <a
                                    class="f-15 fw-5 text-decoration-underline" href="#"
                                    style="color: #6F6B7D; width:180px;">№10472</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Рахунок від</p>
                                <p class="f-15 fw-5 " style="width:180px; ">23.05.2023</p>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Сума без ПДВ</p>
                                <p class="f-15 fw-5 " style="width:180px; ">34 500.00 грн</p>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Сума з ПДВ</p>
                                <p class="f-15 fw-5 " style="width:180px; ">44 500.00 грн</p>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Термін оплати</p>
                                <p class="f-15 fw-5 " style="width:180px; ">30 календарних днів</p>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Дата оплати</p>
                                <p class="f-15 fw-5 " style="width:180px; ">-</p>
                            </div>
                            <div class="d-flex">
                                <p class=" f-15 fw-4 " style="width:180px; ">Квитанція </br> про оплату</p>
                                <a class="f-15 fw-5 text-secondary" style="width:180px;" id="link-receiptForPayment">
                                    -</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-3 " id="block-actionsDocuments">
                <div class="card p-2 mb-1 mx-auto" style="max-width:328px">

                    <h4 class="card-title fw-bolder pt-0 ">Дії з документами</h4>
                    <a class="d-none btn btn-primary mb-1" id="btn-send-to-payment" href="#">Надіслати на оплату</a>
                    <a class="d-none btn btn-primary mb-1" id="btn-payment" href="#" data-bs-toggle="modal"
                       data-bs-target="#receiptForPayment">Оплатити</a>
                    <a class="d-none btn btn-primary mb-1" id="btn-return-from-payment" href="#">Повернути з оплати</a>
                    <a class="d-none btn btn-outline-danger " id="btn-reject" href="#">Відхилити</a>
                </div>
            </div>


        </div>

        <!-- таблиця  -->
        <div class="card">
            <div class="card-header border-bottom row mx-0 gap-1">
                <h4 class="card-title col-auto fw-bolder">Платіжні зобов‘язання</h4>
                <div class="col-auto d-flex  flex-grow-1 justify-content-end pe-0">

                </div>
            </div>

            @if(True)
                <div class="card-grid" style="position: relative;">

                    <div id="offcanvas-end-example">
                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="settingTable"
                             aria-labelledby="settingTableLabel"
                             style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;"
                             data-bs-scroll="true">
                            <div class="offcanvas-header">
                                <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                                <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"
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
                                            <input type="checkbox" class="form-check-input checkbox" id="changeFonts"/>
                                        </div>
                                    </div>
                                    <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                        <label class="form-check-label f-15" for="changeCol">Зміна розміру
                                            колонок</label>
                                        <div class="form-check form-check-warning form-switch">
                                            <input type="checkbox" class="form-check-input checkbox" id="changeCol"/>
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
                        <a class="btn btn-primary" href="#">
                            Додати
                            платіжне зобов‘язання
                        </a>
                    </div>
                </div>
            @endif
        </div>


    </div>


    <!-- модал квитанція про оплату -->
    <div class="modal fade" id="receiptForPayment" tabindex="-1" aria-labelledby="receiptForPayment" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 681px">

            <div class=" modal-content">

                <div class="p-4 ">
                    <h2 class="mb-0 mt-0 text-center">Квитанція про оплату</h2>
                    <div class="p-2 pb-1">
                        <p class="mb-0 text-center">Додайте квитанцію про оплату та натисніть кнопку “Оплачено”</p>
                    </div>
                    <form class="d-flex flex-column" method="" action="#">

                        <div class="my-2">
                            <input type="file" class="form-control" id="fileInput-receiptForPayment">

                        </div>

                        <div class="d-flex justify-content-end"><a class="btn btn-flat-secondary float-start mr-2"
                                                                   data-bs-dismiss="modal" aria-label="Close">
                                Скасувати
                            </a>
                            <button type="button" class="btn btn-primary" id="btn-paid">
                                Оплачено
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
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
@endsection
