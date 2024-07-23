@extends('layouts.admin')
@section('title','Перегляд автомобіля')
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
    </script>


    @if($planning->documents[0]->documentType->key == 'tovarna_nakladna')
        <script type="module"
                src="{{asset('assets/js/grid/transport-planning/goods-invoices-table.js')}}"></script>
    @else
        <script type="module"
                src="{{asset('assets/js/grid/transport-planning/request-for-transport-table-details.js')}}"></script>
    @endif

@endsection

@section('content')
    <div class="container-fluid px-2">
        <div class="tn-details-header pb-2 d-flex justify-content-between">
            <div class="tn-details-breadcrumbs-nav ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a class="text-secondary" href="/transport-planning">Транспортне
                                планування</a></li>
                        <li class="breadcrumb-item fw-bolder text-truncate">ТП № {{$planning->id}}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="tn-details-actions d-flex align-items-center gap-50">
                <div class="py-25 px-50 "><i data-feather='printer'
                                             style="cursor: pointer; transform: scale(1.2);"></i></div>
                <div class="btn-group js-button-dropdown-menu "
                     id="delete-transport-planning-{{$planning->id}}"
                     data-transport-id="{{$planning->id}}">
                    <div data-bs-toggle="dropdown"
                         aria-expanded="false" class="py-25 px-50">
                        <i data-feather='more-vertical'
                           style="cursor: pointer;">
                        </i>
                    </div>

                    <div class="dropdown-menu"
                         aria-labelledby="js-button-dropdown-menu">

                        <a data-bs-toggle="modal" data-bs-target="#change-status-modal" class="dropdown-item" href="#">Завершити
                            рейс</a>

                        <a data-bs-toggle="modal" data-bs-target="#change-status-modal" class="dropdown-item" href="#">Скасувати
                            рейс</a>

                        <a class="dropdown-item" href="#">
                            <p class="text-danger mb-0" data-bs-toggle="modal"
                               data-bs-target="#tp-delete-trip">Видалити рейс</p>
                        </a>

                    </div>

                    <!-- Delete trip modal -->
                    <div class="modal fade" id="tp-delete-trip" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-4">
                                    <p class="text-center fw-semibold" style="font-size: 26px; line-height: 40px;">
                                        Ви справді хочете видалити транспортне планування<br/><span
                                            id="delete-planning-id-block"></span>?
                                    </p>
                                    <div class="d-flex gap-1 w-100 justify-content-center pt-2"
                                         style="border-top: none;">
                                        <div class="w-100">
                                            <button type="button" class="btn btn-flat-secondary w-100"
                                                    data-bs-dismiss="modal">Скасувати
                                            </button>
                                        </div>
                                        <div class="w-100">
                                            <button id="delete-transport-planning" type="button"
                                                    class="btn btn-primary w-100" data-bs-dismiss="modal">
                                                Підтвердити
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="m-0 d-flex flex-column flex-sm-column flex-md-column flex-lg-row flex-xxl-row flex-xl-row gap-1 justify-content-between pe-0 pe-md-0 pe-lg-1">
            <div class="card col-12 col-sm-12 col-md-12 col-lg-9 col-xxl-9 p-2">
                <div class="pb-1">
                    <h4 class="fw-bolder">№ {{$planning->id}}</h4>
                </div>
                <div>
                    <div class="d-flex flex-row row">
                        <div class="d-flex flex-column col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div>
                                <h5 class="pb-1 fw-bolder">Дані планування</h5>
                            </div>
                            <div class="d-flex">
                                <div class="col-6 d-flex flex-column">
                                    <div class="pb-1"><span>Компанія постачальник:</span></div>
                                    <div class="pb-1"><span>Ціна рейсу:</span></div>
                                    <div class="pb-1"><span>Платник:</span></div>
                                    <div class="pb-1"><span>Редаговано:</span></div>
                                    <div class="pb-1"><span>Створено:</span></div>
                                    <div class="pb-1"><span>Коментар:</span></div>
                                </div>
                                <div class="col-6 d-flex flex-column">
                                    <div class="pb-1 text-truncate"><span
                                            class="transport-planning-bold-text ">{{$planning->provider->name}}</span>
                                    </div>
                                    <div class="pb-1 text-truncate"><span
                                            class="transport-planning-bold-text">{{$planning->price}}</span></div>

                                    <div class="pb-1 text-truncate"><span
                                            class="transport-planning-bold-text">{{$planning->payer->name}}</span>
                                    </div>
                                    <div class="pb-1 text-truncate"><span
                                            class="transport-planning-bold-text">{{\Carbon\Carbon::parse($planning->updated_at)->format('d.m.Y')}}</span>
                                    </div>
                                    <div class="pb-1 text-truncate"><span
                                            class="transport-planning-bold-text">{{\Carbon\Carbon::parse($planning->created_ad)->format('d.m.Y')}}</span>
                                    </div>
                                    <div class="pb-1 text-truncate"><span
                                            class="transport-planning-bold-text">{{$planning->comment ?? ' - '}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div>
                                <h5 class="pb-1 fw-bolder">Дані перевізника</h5>
                            </div>
                            <div class="d-flex">
                                <div class="col-6 d-flex flex-column">
                                    <div class="pb-1"><span>Компанія перевізник:</span></div>
                                    <div class="pb-1"><span>Водій:</span></div>
                                    <div class="pb-1"><span>Транспорт:</span></div>
                                    <div class="pb-1"><span>Додаткове обладнання:</span></div>
                                    <br/>
                                    <div class="pb-1"><span>Місткість авто:</span></div>
                                    <div class="pb-1"><span>Зарезервовано:</span></div>
                                </div>
                                <div class="col-6 d-flex flex-column text-truncate">
                                    <div class="pb-1 text-truncate"><a href="/company/{{$planning->carrier->id}}"><span
                                                class="transport-planning-yellow-text">{{$planning->carrier->name}}</span></a>
                                    </div>
                                    <div class="pb-1 text-truncate"><a
                                            href="/user/show/{{$planning->driver->id}}"> <span
                                                class="transport-planning-yellow-text">{{$planning->driver->full_name}}</span></a>
                                    </div>
                                    <div class="pb-1 text-truncate"><a
                                            href="/transport/{{$planning->transport->id}}"><span
                                                class="transport-planning-yellow-text">{{$planning->transport->name}}</span></a>
                                    </div>
                                    <div class="pb-1 text-truncate"><a
                                            href="/transport-equipment/{{$planning->additional_equipment->id}}"><span
                                                class="transport-planning-yellow-text">{{$planning->additional_equipment->name}}</span></a>
                                    </div>
                                    <br/>
                                    <div class="pb-1 text-truncate"><span class="transport-planning-bold-text">{{$planning->additional_equipment->capacity_eu}} пл.</span>
                                    </div>
                                    <div class="pb-1 text-truncate"><span class="transport-planning-yellow-text">{{$planning->allPallets}} пл.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card col-12 col-sm-12 col-md-6 col-lg-3 col-xxl-3" style="height: 404px;">
                <section id="transport-planning-status">
                    <div class="row mx-0">
                        <div class="col-sm-12">
                            <div id="transport-planning-status-wrapper">
                                <div class="">
                                    <div class="transport-planning-status-container d-flex flex-column p-1 gap-1"
                                         style="background-color: #FFFFFF; border-top-left-radius: 6px; border-top-right-radius: 6px; height: 366px; overflow: auto; border-bottom: 1px solid #D3D3D3;">
                                        @foreach($planning->statuses as $index => $status)
                                            <div id="status-block-{{$status->pivot->id}}"
                                                 data-status-info="{{json_encode($status)}}"
                                                 class="d-flex gap-1 transport-planning-status">
                                                <div
                                                    class="{{$index !== (count($planning->statuses) - 1) ? 'opacity-50' : ''}}">
                                                    <img
                                                        src="{{asset('assets/icons/entity/transport-planning/timeline.svg')}}"/>
                                                </div>
                                                <div class="w-100">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div
                                                            class="d-flex align-items-center {{$index !== (count($planning->statuses) - 1) ? 'opacity-50' : ''}}"><span
                                                                class="fw-semibold"
                                                                style="padding-right: 10px; font-size: 15px;">{{$status->name}}</span>
                                                            @if(!$status->failure_id && $status->pivot->comment)
                                                                <i
                                                                    data-feather='info' data-bs-toggle="tooltip"
                                                                    title="{{$status->pivot->comment}}"></i>
                                                            @endif

                                                            @if ($status->failure_id)
                                                                <img
                                                                    src="{{asset('assets/icons/problem-icon.svg')}}"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{$status->failure_comment}}"
                                                                    style="padding-left: 5px; cursor:pointer;"/>
                                                            @endif
                                                        </div>
                                                        <div style="height: 25px">
                                                            <div
                                                                class="btn-group js-button-dropdown-menu d-none js-button-dropdown-menu-hover align-items-center">
                                                                <div data-bs-toggle="dropdown"
                                                                     aria-expanded="false"
                                                                     class="d-flex align-items-center py-50 px-50 ">
                                                                    <i data-feather='more-vertical'
                                                                       style="cursor: pointer;">
                                                                    </i>
                                                                </div>
                                                                <div class="dropdown-menu"
                                                                     aria-labelledby="transport-planning-status-dropdown">
                                                                    <a id="open-edit-status-modal-button-{{$status->pivot->id}}"
                                                                       data-status-id="{{$status->pivot->id}}"
                                                                       class="dropdown-item" data-bs-toggle="modal"
                                                                       data-bs-target="#edit-status-modal" href="#">Редагувати
                                                                        поточний статус</a>
                                                                    <a id="open-add-failure-model-button-{{$status->pivot->id}}"
                                                                       data-status-id="{{$status->pivot->id}}"
                                                                       class="dropdown-item" data-bs-toggle="modal"
                                                                       data-bs-target="#problem-modal" href="#">Зафіксувати
                                                                        проблему</a>
                                                                    <a id="delete-status-{{$status->pivot->id}}"
                                                                       data-status-id="{{$status->pivot->id}}"
                                                                       class="dropdown-item" href="#">Видалити поточний
                                                                        статус</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="{{$index !== (count($planning->statuses) - 1) ? 'opacity-50' : ''}}"
                                                        style="padding-top: 5px; padding-bottom: 5px;">
                                                    <span
                                                        style="font-size: 13px;">{{$status->address}}</span>
                                                    </div>
                                                    <div
                                                        class="{{$index !== (count($planning->statuses) - 1) ? 'opacity-50' : ''}}">
                                                        <span class="pe-1"
                                                              style="font-size: 13px;">{{\Carbon\Carbon::parse($status->pivot->date)->format('d.m.Y')}}</span><span
                                                            style="font-size: 13px;">{{\Carbon\Carbon::parse($status->pivot->date)->format('H:i')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex"
                                         style="background-color: #FFFFFF; border-bottom-left-radius: 6px; border-bottom-right-radius: 6px;">
                                        <button type="button" class="btn btn-flat-primary waves-effect w-100"
                                                style="border-top-left-radius: 0; border-top-right-radius: 0;"
                                                data-bs-toggle="modal" data-bs-target="#change-status-modal">Змінити
                                            статус
                                        </button>
                                    </div>

                                    <!-- Change status modal -->
                                    <div class="modal fade text-start" id="change-status-modal" tabindex="-1"
                                         aria-labelledby="myModalLabel18" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content p-2">
                                                <div class="modal-header d-flex justify-content-center">
                                                    <h3 class="modal-title" id="myModalLabel18">Зміна статусу рейсу</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <label class="form-label"
                                                               for="change-status-select">Статус</label>
                                                        <select class="form-select select2"
                                                                data-placeholder="Оберіть статус рейсу"
                                                                id="change-status-select"
                                                                required>
                                                            <option value=""></option>
                                                            @foreach($allStatuses as $status)
                                                                <option
                                                                    value="{{$status->id}}">{{$status->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="change-status-select-location">Адреса</label>
                                                        <select class="form-select select2"
                                                                id="change-status-select-location"
                                                                data-placeholder="Оберіть адресу
                                                                        рейсу" required>
                                                            <option value=""></option>
                                                            @foreach($allAddresses as $address)
                                                                <option
                                                                    value="{{$address->id}}">{{$address->full_address}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 w-100 pb-1">
                                                        <label class="form-label" for="fp-date-time">Дата і час</label>
                                                        <div class="" style="position: relative;">
                                                            <input type="text" id="fp-date-time"
                                                                   class="form-control flatpickr-date-time validateFromMon"
                                                                   placeholder="РРРР-MM-ДД 00:00"
                                                                   style="position: relative;"/>
                                                            <img src="{{asset('assets/icons/calendar.svg')}}"
                                                                 style="position: absolute; top: 10px; right: 10px;"/>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <textarea class="form-control" id="change-status-comment"
                                                                  rows="3"
                                                                  placeholder="Залиште коментар, якщо маєте що додати"
                                                                  style="max-height: 150px; min-height: 100px;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="border-top: none;">
                                                    <button type="button" class="btn btn-flat-secondary"
                                                            data-bs-dismiss="modal">Скасувати
                                                    </button>
                                                    <button id="create-status-button" type="button"
                                                            class="btn btn-primary"
                                                            data-transport-planning-id="{{$planning->id}}"
                                                            data-bs-dismiss="modal">Оновити статус
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit status modal -->
                                    <div class="modal fade text-start" id="edit-status-modal" tabindex="-1"
                                         aria-labelledby="myModalLabel18" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content p-2">
                                                <div class="modal-header d-flex justify-content-center">
                                                    <h3 class="modal-title fw-bolder" id="myModalLabel18">Редагування
                                                        статусу
                                                        рейсу</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <label class="form-label"
                                                               for="edit-status-select">Статус</label>
                                                        <select class="form-select select2" id="edit-status-select"
                                                                data-placeholder="Оберіть статус рейсу" required>
                                                            <option value=""></option>
                                                            @foreach($allStatuses as $status)
                                                                <option
                                                                    value="{{$status->id}}">{{$status->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="edit-status-select-location">Адреса</label>
                                                        <select class="form-select select2"
                                                                id="edit-status-select-location"
                                                                data-placeholder="Оберіть адресу
                                                                        рейсу"> required>
                                                            <option value=""></option>

                                                            @foreach($allAddresses as $address)
                                                                <option
                                                                    value="{{$address->id}}">{{$address->full_address}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 w-100 pb-1">
                                                        <label class="form-label" for="fp-date-time-edit">Дата і
                                                            час</label>
                                                        <div class="" style="position: relative;">
                                                            <input type="text" id="fp-date-time-edit"
                                                                   class="form-control flatpickr-date-time validateFromMon"
                                                                   placeholder="РРРР-MM-ДД 00:00"
                                                                   style="position: relative;"/>
                                                            <img src="{{asset('assets/icons/calendar.svg')}}"
                                                                 style="position: absolute; top: 10px; right: 10px;"/>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <textarea class="form-control" id="edit-status-comment" rows="3"
                                                                  placeholder="Залиште коментар, якщо маєте що додати"
                                                                  style="max-height: 150px; min-height: 100px;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="border-top: none;">
                                                    <button type="button" class="btn btn-flat-secondary"
                                                            data-bs-dismiss="modal">Скасувати
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            id="edit-status-button"
                                                            data-bs-dismiss="modal">Оновити статус
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Problem modal -->
                                    <div class="modal fade text-start" id="problem-modal" tabindex="-1"
                                         aria-labelledby="myModalLabel18" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content p-3">
                                                <div class="modal-header d-flex justify-content-center">
                                                    <h3 class="modal-title" id="myModalLabel18">Фіксація проблеми</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basicSelect">Тип збою
                                                            постачання</label>
                                                        <select class="form-select select2" id="problemSelect"
                                                                data-placeholder="Оберіть тип збою
                                                                постачання" required>

                                                            <option value=""></option>
                                                            @foreach($allFailureTypes as $type)
                                                                <option selected
                                                                        value="{{$type->id}}">{{$type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basicInput">Причина збою
                                                            постачання</label>
                                                        <input type="text" class="form-control" id="problem-reason"
                                                               placeholder="Вкажіть причину збою постачання" required/>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basicInput">Винуватець збою
                                                            постачання</label>
                                                        <input type="text" class="form-control" id="problem-author"
                                                               placeholder="Вкажіть винуватця збою постачання"
                                                               required/>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basicInput">Вартість штрафних
                                                            санкцій</label>
                                                        <input type="text" class="form-control" id="problem-price"
                                                               placeholder="Вкажіть суму штрафних санкцій" required/>
                                                    </div>
                                                    <div class="">
                                                        <textarea class="form-control" id="problem-comment" rows="3"
                                                                  placeholder="Залиште коментар, якщо маєте що додати"
                                                                  style="max-height: 150px; min-height: 100px;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="border-top: none;">
                                                    <button type="button" class="btn btn-flat-secondary"
                                                            data-bs-dismiss="modal">Скасувати
                                                    </button>
                                                    <button type="button" class="btn btn-primary" id="add-reason-submit"
                                                            data-bs-dismiss="modal">Зафіксувати проблему
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Table with tabs -->
        <div class="col-xl-12 col-lg-12 mb-2">
            <div class="card-body">
                <div class="d-flex justify-content-between tp-tables">

                    <div class="transport-planning-table-tabs tabs-transport-planning-сss " id="tabs">
                        <ul class="d-flex ">
                            @if($planning->documents[0]->documentType->key == 'tovarna_nakladna')
                                <li id="schedule-tab">Товарні накладні</li>
                            @else
                                <li id="code-tab">Запит на транспорт</li>
                            @endif
                        </ul>
                        @if($planning->documents[0]->documentType->key == 'tovarna_nakladna')
                            <div id="schedule">
                                <div class="card-grid" style="position: relative;">

                                    <div id="offcanvas-end-example">

                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false"
                                             tabindex="-1"
                                             id="settingTable" aria-labelledby="settingTableLabel"
                                             style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 501;"
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
                                                        <div class="form-check-label f-15">Змінити висоту
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
                                                                    <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                    <path d="M9 15H21" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                    <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                </svg>
                                                            </button>
                                                            <button class="changeMenu-2 active-row-table ">
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
                                                            <div style="float: left;" id="jqxlistbox"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-block" id="goods-invoices-table">

                                    </div>
                                </div>
                            </div>
                        @else
                            <div id="code">
                                <div class="card-grid" style="position: relative;">

                                    <div id="offcanvas-end-example">
                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false"
                                             tabindex="-1"
                                             id="settingTable-tr-request"
                                             aria-labelledby="settingTableLabel"
                                             style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 501;"
                                             data-bs-scroll="true">
                                            <div class="offcanvas-header">
                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">
                                                    Налаштування таблиці
                                                </h4>
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
                                                        <div class="form-check-label f-15">Змінити висоту
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
                                                                    <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                    <path d="M9 15H21" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                    <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                </svg>
                                                            </button>
                                                            <button class="changeMenu-2 active-row-table ">
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
                                                               for="changeFonts-tr-request">Збільшити
                                                            шрифт</label>
                                                        <div
                                                            class="form-check form-check-warning form-switch">
                                                            <input type="checkbox"
                                                                   class="form-check-input checkbox"
                                                                   id="changeFonts-tr-request"/>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                        <label class="form-check-label f-15"
                                                               for="changeCol-tr-request">Зміна
                                                            розміру
                                                            колонок</label>
                                                        <div
                                                            class="form-check form-check-warning form-switch">
                                                            <input type="checkbox"
                                                                   class="form-check-input checkbox"
                                                                   id="changeCol-tr-request"/>
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
                                    <div class="table-block" id="transport-request-table">

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>

    </div>
@endsection

@section('page-script')

    <script>
        const planning_id = {!! $planning->id !!};
    </script>

    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>

    <script src="{{asset('assets/js/entity/transport-planning/transport-planning-list.js')}}"></script>

    @if($planning->documents[0]->documentType->key == 'tovarna_nakladna')
        <script type="module">
            import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';
            import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

            tableSetting($('#goods-invoices-table'), '', 85, 100);
            offCanvasByBorder($('#goods-invoices-table'));
        </script>
    @else
        <script type="module">
            import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';
            import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

            tableSetting($('#transport-request-table'), '-tr-request', 85, 100);
            offCanvasByBorder($('#transport-request-table'));
        </script>
    @endif

@endsection
