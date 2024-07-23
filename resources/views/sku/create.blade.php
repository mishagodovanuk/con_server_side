@extends('layouts.admin')
@section('title','Товари')
@section('page-style')

@endsection
@section('before-style')

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">

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

        // Додаємо кнопку "Додати вкладку"
        var addButton = $(
            '<li class="btn-tabs-watch-all" style="margin-left: auto ">  <div id="change-button-for-tabs"> <a data-bs-toggle="modal" id="button_paking" data-bs-target="#add_paking" href="#" class="btn btn-outline-primary" >   <i data-feather="plus" class="me-25"></i> <span>Додати пакування</span></a> <a style="display: none;" id="button_bar_code" href="#" data-bs-toggle="modal" data-bs-target="#add_bar_code" class="btn btn-outline-primary" >   <i data-feather="plus" class="me-25"></i> Додати штрих-код </a> </div></li>'
        );
        addButton.appendTo('#tabs > .jqx-tabs-header > .jqx-tabs-title-container');
    </script>


    <script type="module" src="{{asset('assets/js/grid/sku/packing-table.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/sku/barcode-table.js')}}"></script>
    <script src="{{asset('assets/js/utils/loader-for-tabs.js')}}"></script>
@endsection
@section('content')
    <div id="jqxLoader"></div>

    <div class="mx-0 px-2 ">

        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class="tn-details-breadcrumbs-nav align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/sku" style="color: #4B465C;">Товари</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Додавання товару</li>
                    </ol>
                </nav>
            </div>
            <div class="tn-details-actions d-flex gap-1 align-self-end ">
                <button type="submit" id="draft_save" class="btn btn-flat-primary">
                    Зберегти як чернетку
                </button>
                <button type="submit" id="save" class="btn btn-green">
                    Зберегти
                </button>
            </div>
        </div>

        <form action="{{route('sku.store')}}" method="post">
            @csrf

            <div class=" card  mb-2">
                <div class="row mx-0">
                    <div class="card col-12 p-2 mb-0">
                        <div class="card-header p-0">
                            <h4 class="card-title fw-bolder">Основні дані</h4>
                        </div>
                        <div class="card-body p-0 mt-1">
                            <div class="row">

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="name_sku">Назва</label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" id="name_sku"
                                           name="name" placeholder="Вкажіть назву товару">
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="company_owner select2-hide-search">Компанія
                                    </label>
                                    <select class="select2 form-select" name="category_id" id="company_owner"
                                            data-dictionary="company"
                                            data-placeholder="Виберіть компанію ">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="category_sku select2-hide-search">Тип товару</label>
                                    <select class="select2 form-select" name="cargo_type_id" id="cargo_type"
                                            data-dictionary="cargo_type"
                                            data-placeholder="Виберіть тип товару">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="category_sku select2-hide-search">Категорія</label>
                                    <select class="select2 form-select" name="category_id" id="category_sku"
                                            data-dictionary="goods_category"
                                            data-placeholder="Виберіть категорію">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1 position-relative">
                                    <label class="form-label" for="fp-default">Партія</label>
                                    <input type="text" id="fp-default"
                                           class="form-control flatpickr-basic flatpickr-input"
                                           required placeholder="РРРР-ММ-ДД" name="group" readonly="readonly">
                                    <span class="cursor-pointer text-secondary position-absolute top-50"
                                          style="right : 27px;pointer-events: none;"><i
                                            data-feather="calendar"></i></span>
                                </div>


                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="category_sku select2-hide-search">Виробник</label>
                                    <select class="select2 form-select" name="category_id" id="producer"
                                            data-dictionary="company"
                                            data-placeholder="Виберіть виробника">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="category_sku select2-hide-search">Країна
                                        виробник</label>
                                    <select class="select2 form-select" name="category_id" id="producerСountry"
                                            data-dictionary="country"
                                            data-placeholder="Виберіть країну виробника">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="adr select2-hide-search">ADR</label>
                                    <select class="select2 form-select" name="category_id" id="adr"
                                            data-dictionary="adr"
                                            data-placeholder="Оберіть клас небезпечного товару">
                                        <option value=""></option>

                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="unit_sku select2-hide-search">Одиниця виміру</label>
                                    <select class="select2 form-select" name="measurement_unit_id" id="unit_sku"
                                            data-dictionary="measurement_unit"
                                            data-placeholder="Виберіть основну одиницю виміру">
                                        <option value=""></option>

                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                <textarea class="form-control" id="comment_goods" rows="2"
                                          placeholder="Коментар"></textarea>
                                </div>


                                <div id="basic-data-message"></div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class=" card  mb-0">
                <div class="row mx-0">

                    <div class="card col-12 p-2 mb-0">
                        <div class="card-header p-0">
                            <h4 class="card-title fw-bolder">Параметри</h4>
                        </div>
                        <div class="card-body p-0 mt-1">
                            <div class="row">


                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label">Маса нетто</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="weight"
                                               oninput="maskFractionalNumbers(this,5)"
                                               placeholder="Вкажіть масу нетто" id="sku_net_weight">
                                        <span class="input-group-text">кг</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label">Маса брутто</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="weight"
                                               oninput="maskFractionalNumbers(this,5)"
                                               placeholder="Вкажіть масу брутто" id="sku_gross_weight">
                                        <span class="input-group-text">кг</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <div class="d-flex align-items-center">

                                        <div class="d-flex flex-grow-1 flex-column">
                                            <label class="form-label">Температурний режим</label>
                                            <div class="d-flex gap-1">

                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="from"
                                                           oninput="maskFractionalNumbersMinus(this,3)"
                                                           placeholder="Від 00.0" id="temperature_regime_from">
                                                    <span class="input-group-text fw-light">&#8451;</span>
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="to"
                                                           oninput="maskFractionalNumbers(this,3)"
                                                           placeholder="До 00.0" id="temperature_regime_to">
                                                    <span class="input-group-text fw-light">&#8451;</span>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 mb-1 d-flex flex-grow gap-1">
                                    <div class="w-100"><label class="form-label">Висота</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="weight"
                                                   oninput="maskFractionalNumbers(this,4)"
                                                   placeholder="000.0" id="sku_height">
                                            <span class="input-group-text">см</span>
                                        </div>
                                    </div>
                                    <div class="w-100"><label class="form-label">Ширина</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="weight"
                                                   oninput="maskFractionalNumbers(this,4)"
                                                   placeholder="000.0" id="sku_width">
                                            <span class="input-group-text">см</span>
                                        </div>
                                    </div>
                                    <div class="w-100"><label class="form-label">Довжина</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="weight"
                                                   oninput="maskFractionalNumbers(this,4)"
                                                   placeholder="000.0" id="sku_length">
                                            <span class="input-group-text">см</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="parameters-message"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </form>

        <div class="row mt-2 mx-0">

            <div class="col-12  px-0 ">
                <!-- Add Modal Paking -->
                <div class="modal text-start" id="add_paking" tabindex="-1" aria-labelledby="myModalLabel6"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 681px!important;">
                        <div class="modal-content">
                            <div class="card popup-card">
                                <div class="popup-header mt-4">
                                    Додати пакування
                                </div>
                                <div class="card-body px-4 pb-4">
                                    <form class="row mx-0 js-modal-form" id="modal-packing-form">
                                        <div class="col-12 mb-2">
                                            <label class="form-label" for="add_paking_name">Тип
                                                пакування</label>
                                            <select name="type_id" class="select2 form-select"
                                                    id="add_paking_name" data-dictionary="package_type"
                                                    data-placeholder="Виберіть тип пакування">
                                                <option value=""></option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <label class="form-label">К-сть
                                                одиниць в пакуванні</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="packing-quantity"
                                                       name="add_number_packing" oninput="maskFractionalNumbers(this,4)"
                                                       placeholder="Вкажіть к-сть">
                                                <span class="input-group-text">м <sup>2</sup></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <label class="form-label">Маса пакування</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="packing-weight"
                                                       name="add_weight_packing" oninput="maskFractionalNumbers(this,5)"
                                                       value="{{old('weight')}}" placeholder="Вкажіть масу">
                                                <span class="input-group-text">кг</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <label class="form-label">Маса нетто</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="packing-net-weight"
                                                       name="add_net_weight" oninput="maskFractionalNumbers(this,7)"
                                                       placeholder="">
                                                <span class="input-group-text">кг</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <label class="form-label">Маса брутто</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="packing-gross-weight"
                                                       name="add_gross_weight" oninput="maskFractionalNumbers(this,7)"
                                                       value="{{old('weight')}}" placeholder="">
                                                <span class="input-group-text">кг</span>
                                            </div>
                                        </div>

                                        <div class="col-12  mb-2 d-flex gap-1">
                                            <div class=""><label class="form-label">Висота</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="packing-height"
                                                           name="weight" oninput="maskFractionalNumbers(this,4)"
                                                           placeholder="000.0">
                                                    <span class="input-group-text">см</span>
                                                </div>
                                            </div>
                                            <div class=""><label class="form-label">Ширина</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="packing-width"
                                                           name="weight" oninput="maskFractionalNumbers(this,4)"
                                                           placeholder="000.0">
                                                    <span class="input-group-text">см</span>
                                                </div>
                                            </div>
                                            <div class=""><label class="form-label">Довжина</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="packing-length"
                                                           name="weight" oninput="maskFractionalNumbers(this,4)"
                                                           placeholder="000.0">
                                                    <span class="input-group-text">см</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <input class="form-check-input" type="checkbox" id="packing-setMain"
                                                   value="unchecked"/>
                                            <label class="form-check-label" for="packing-setMain">встановити пакування
                                                як основне <i data-feather="info" data-bs-toggle="tooltip"
                                                              data-bs-custom-class="custom-tooltip-addPacking"
                                                              title="Встановивши цей параметр, розрахунки в документах будуть вестися за таким типом пакуванням."></i>
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex float-end">
                                                <button type="button" class="btn btn-link cancel-btn"
                                                        data-dismiss="modal">Скасувати
                                                </button>
                                                <button type="button" class="btn btn-primary" id="package_submit">
                                                    Зберегти
                                                </button>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Edit Modal Paking -->
                <div class="modal text-start" id="edit_paking" tabindex="-1" aria-labelledby="myModalLabel6"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 681px!important;">
                        <div class="modal-content">
                            <div class="card popup-card">
                                <div class="popup-header mt-4">
                                    Редагування пакування
                                </div>
                                <div class="card-body px-4 pb-4">
                                    <form id="update-package" class="row mx-0 js-modal-form2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label" for="edit_paking_name select2-hide-search">Тип
                                                пакування</label>
                                            <select class="select2 form-select hide-search" id="edit_paking_name"
                                                    data-dictionary="package_type"
                                                    name="type_id" data-placeholder="Виберіть тип пакування">
                                                <option value=""></option>

                                            </select>
                                        </div>


                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <label class="form-label">К-сть
                                                одиниць в пакуванні</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="edit_quantity_packing"
                                                       oninput="maskFractionalNumbers(this,4)"
                                                       placeholder="00">
                                                <span class="input-group-text">м <sup>2</sup></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <label class="form-label">Маса пакування</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="edit_weight_packing"
                                                       oninput="maskFractionalNumbers(this,5)"
                                                       value="{{old('weight')}}" placeholder="Вкажіть масу">
                                                <span class="input-group-text">кг</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <label class="form-label">Маса нетто</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="edit_net_weight"
                                                       oninput="maskFractionalNumbers(this,7)"
                                                       placeholder="00">
                                                <span class="input-group-text">кг</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <label class="form-label">Маса брутто</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="edit_gross_weight"
                                                       oninput="maskFractionalNumbers(this,7)"
                                                       value="{{old('weight')}}" placeholder="00">
                                                <span class="input-group-text">кг</span>
                                            </div>
                                        </div>

                                        <div class="col-12  mb-2 d-flex gap-1">
                                            <div class=""><label class="form-label">Висота</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="edit_size_height"
                                                           oninput="maskFractionalNumbers(this,4)"
                                                           placeholder="000.0">
                                                    <span class="input-group-text">см</span>
                                                </div>
                                            </div>
                                            <div class=""><label class="form-label">Ширина</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="edit_size_width"
                                                           oninput="maskFractionalNumbers(this,4)"
                                                           placeholder="000.0">
                                                    <span class="input-group-text">см</span>
                                                </div>
                                            </div>
                                            <div class=""><label class="form-label">Довжина</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="edit_size_depth"
                                                           oninput="maskFractionalNumbers(this,4)"
                                                           placeholder="000.0">
                                                    <span class="input-group-text">см</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 mb-1">
                                            <input class="form-check-input" type="checkbox" id="edit_packing-setMain"
                                                   value="unchecked"/>
                                            <label class="form-check-label" for="edit_packing-setMain">встановити
                                                пакування як основне <i data-feather="info" data-bs-toggle="tooltip"
                                                                        data-bs-custom-class="custom-tooltip-addPacking"
                                                                        title="Встановивши цей параметр, розрахунки в документах будуть вестися за таким типом пакуванням."></i>
                                            </label>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-flex float-end">
                                                <button class="btn btn-link cancel-btn" type="button"
                                                        data-dismiss="modal">Скасувати
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                        id="edit_condition_submit">Зберегти
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Add Modal Bar Code -->
                <div class="modal text-start" id="add_bar_code" tabindex="-1" aria-labelledby="myModalLabel6"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                        <div class="modal-content">
                            <div class="card popup-card">
                                <div class="popup-header mt-4">
                                    Додати штрих-код
                                </div>
                                <div class="card-body px-4 pb-4">
                                    <form id="barcode-form" class="row mx-0">

                                        <div class="col-12 mb-2">
                                            <label class="form-label" for="add_bar_code">Штрих-код</label>
                                            <input type="number" class="form-control" id="add_bar_code_input"
                                                   name="barcode"
                                                   placeholder="Введіть штрих-код">
                                        </div>

                                        <div class="col-12 mt-1">
                                            <div class="d-flex float-end">
                                                <button type="button" class="btn btn-link cancel-btn"
                                                        data-dismiss="modal">Скасувати
                                                </button>
                                                <button type="button" class="btn btn-primary" id="create_barcode">
                                                    Зберегти
                                                </button>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Edit Modal Bar Code -->
                <div class="modal text-start" id="edit_bar_code" tabindex="-1" aria-labelledby="myModalLabel6"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                        <div class="modal-content">
                            <div class="card popup-card">
                                <div class="popup-header mt-4">
                                    Редагування штрих-коду
                                </div>
                                <div class="card-body px-4 pb-4">
                                    <form id="update-barcode" class="row mx-0">
                                        <div class="col-12 mb-2">
                                            <label class="form-label" for="edit_bar_code">Штрих-код</label>
                                            <input type="number" class="form-control" id="edit_barcode" name="barcode"
                                                   placeholder="Введіть штрих-код">
                                        </div>

                                        <div class="col-12 mt-1">
                                            <div class="d-flex float-end">
                                                <button type="button" class="btn btn-link cancel-btn"
                                                        data-dismiss="modal">Скасувати
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                        id="edit_condition_barcode_submit">Зберегти
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Basic Tabs starts -->
                <div class="col-xl-12 col-lg-12 mb-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between sku-create-tables">

                            <div id="tabs" class="invisible">
                                <ul class="d-flex ">
                                    <li id="schedule-tab">Пакування</li>
                                    <li id="code-tab">Штрих код</li>
                                </ul>

                                <div id="schedule">
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
                                                    <li class="nav-item nav-search text-reset"
                                                        data-bs-dismiss="offcanvas"
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
                                                            <div
                                                                class="form-check form-check-warning form-switch d-flex align-items-center"
                                                                style="">
                                                                <button class="changeMenu-3">
                                                                    <svg width="30" height="30" viewBox="0 0 30 30"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
                                                                        <path d="M9 15H21" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
                                                                        <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
                                                                    </svg>
                                                                </button>
                                                                <button class="changeMenu-2 active-row-table ">
                                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M3 6H15" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
                                                                        <path d="M3 12H15" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
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
                                                            <label class="form-check-label f-15" for="changeCol">Зміна
                                                                розміру
                                                                колонок</label>
                                                            <div class="form-check form-check-warning form-switch">
                                                                <input type="checkbox" class="form-check-input checkbox"
                                                                       id="changeCol"/>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="d-flex flex-column justify-content-between h-100"
                                                             id="">
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
                                <div id="code">
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
                                                    <li class="nav-item nav-search text-reset"
                                                        data-bs-dismiss="offcanvas"
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
                                                            <div
                                                                class="form-check form-check-warning form-switch d-flex align-items-center"
                                                                style="">
                                                                <button class="changeMenu-3">
                                                                    <svg width="30" height="30" viewBox="0 0 30 30"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
                                                                        <path d="M9 15H21" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
                                                                        <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
                                                                    </svg>
                                                                </button>
                                                                <button class="changeMenu-2 active-row-table ">
                                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M3 6H15" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
                                                                        <path d="M3 12H15" stroke="#A8AAAE"
                                                                              stroke-width="1.75" stroke-linecap="round"
                                                                              stroke-linejoin="round"/>
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
                                                                       id="changeFonts-sku-location"/>
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
                                                                       id="changeCol-sku-location"/>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="d-flex flex-column justify-content-between h-100"
                                                             id="">
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
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        const barcodeData = [];
        const packingData = [];
        let sku_id = null;
    </script>

    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>

    <script src="{{asset('assets/js/entity/sku/sku_info.js')}}"></script>
    <script src="{{asset('assets/js/entity/sku/sku-create.js')}}"></script>
    <script src="{{asset('assets/js/entity/sku/typesPacking.js')}}"></script>

    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        tableSetting($('#packing-table'));
        tableSetting($('#barcode-table'), '-barcode');

    </script>

    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        offCanvasByBorder($('#packing-table'));
        offCanvasByBorder($('#barcode-table'), '-barcode');
    </script>

@endsection
