@extends('layouts.admin')
@section('title','Перегляд ТП')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">
@endsection

@section('content')
    <div class="container-fluid px-2">
        <div class="planning-list-breadcrumbs-nav pb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-slash">
                    <li class="breadcrumb-item"><a href="/transport-planning" style="color: #4B465C;">Транспортне
                            планування</a></li>
                    <li class="breadcrumb-item active fw-bolder" aria-current="page">Відвантаження {{$date}}</li>
                </ol>
            </nav>
        </div>

        @foreach($transportPlannings as $planningIndex => $planning)

            <div class="card p-2 px-50">
                <div
                    class="transport-planning-item-header d-flex flex-wrap gap-1 justify-content-center justify-content-sm-between px-1 pb-2">
                    <div class="transport-planning-item-number-actions-wrapper d-flex align-items-center">
                        <div class="transport-planning-item-number d-flex align-items-center pe-2">
                            <h4 class="item-number mb-0 fw-bolder">№ {{$planning->id}}</h4>
                        </div>
                        <div class="transport-planning-item-actions d-flex align-items-center gap-50">
                            <div class="py-25 px-50 "><i data-feather='printer'
                                                         style="cursor: pointer; transform: scale(1.2);"></i></div>
                            <div class="py-25 px-50"><i data-feather='edit'
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

                                    <a data-bs-toggle="modal" data-bs-target="#change-status-modal"
                                       class="dropdown-item" href="#">Завершити рейс</a>

                                    <a data-bs-toggle="modal" data-bs-target="#change-status-modal"
                                       class="dropdown-item" href="#">Скасувати рейс</a>

                                    <a class="dropdown-item" href="#">
                                        <p class="text-danger mb-0" data-bs-toggle="modal"
                                           data-bs-target="#tp-delete-trip">Видалити рейс</p>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="transport-planning-item-button">
                        <a href="/transport-planning/{{$planning->id}}">
                            <button type="button" class="btn btn-outline-primary waves-effect">Переглянути авто</button>
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

                <div class="row mx-0" style="row-gap: 1rem">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xxl-3">
                        <section id="transport-planning-status">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="transport-planning-status-wrapper">
                                        <div class="">
                                            <div
                                                class="transport-planning-status-container d-flex flex-column p-1 gap-1"
                                                style="background-color: rgba(168, 170, 174, 0.08); border-top-left-radius: 6px; border-top-right-radius: 6px; height: 282px; overflow: auto; border-bottom: 1px solid #D3D3D3;">

                                                @foreach($planning->statuses as $index => $status)
                                                    @if($index !== (count($planning->statuses) - 1))
                                                        <div id="status-block-{{$status->pivot->id}}"
                                                             data-status-info="{{json_encode($status)}}"
                                                             class="d-flex gap-1 transport-planning-status">
                                                            <div class="opacity-50">
                                                                <img
                                                                    src="{{asset('assets/icons/entity/transport-planning/timeline.svg')}}"/>
                                                            </div>
                                                            <div class="w-100">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center opacity-50">
                                                                        <span
                                                                            class="fw-semibold"
                                                                            style="padding-right: 10px; font-size: 15px;">{{$status->name}}
                                                                        </span>
                                                                        @if(!$status->failure_id && $status->pivot->comment)
                                                                            <i
                                                                                data-feather='info'
                                                                                data-bs-toggle="tooltip"
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
                                                                                 aria-labelledby="js-button-dropdown-menu">
                                                                                <a id="open-edit-status-modal-button-{{$status->pivot->id}}"
                                                                                   data-status-id="{{$status->pivot->id}}"
                                                                                   class="dropdown-item"
                                                                                   data-bs-toggle="modal"
                                                                                   data-bs-target="#edit-status-modal"
                                                                                   href="#">Редагувати
                                                                                    поточний статус</a>
                                                                                <a id="open-add-failure-model-button-{{$status->pivot->id}}"
                                                                                   class="dropdown-item"
                                                                                   data-bs-toggle="modal"
                                                                                   data-bs-target="#problem-modal"
                                                                                   href="#">Зафіксувати
                                                                                    проблему</a>
                                                                                <a id="delete-status-{{$status->pivot->id}}"
                                                                                   data-status-id="{{$status->pivot->id}}"
                                                                                   class="dropdown-item" href="#">Видалити
                                                                                    поточний
                                                                                    статус</a>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="opacity-50"
                                                                     style="padding-top: 5px; padding-bottom: 5px;">
                                                        <span
                                                            style="font-size: 13px;">{{$status->address}}</span>
                                                                </div>
                                                                <div class="opacity-50">
                                                        <span class="pe-1"
                                                              style="font-size: 13px;">{{\Carbon\Carbon::parse($status->pivot->date)->format('d.m.Y')}}</span><span
                                                                        style="font-size: 13px;">{{\Carbon\Carbon::parse($status->pivot->date)->format('H:i')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div id="status-block-{{$status->pivot->id}}"
                                                             data-status-info="{{json_encode($status)}}"
                                                             class="d-flex gap-1 transport-planning-status">
                                                            <div class="">
                                                                <img
                                                                    src="{{asset('assets/icons/entity/transport-planning/timeline.svg')}}"/>
                                                            </div>
                                                            <div class="w-100">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="fw-semibold"
                                                                            style="padding-right: 10px; font-size: 15px;">{{$status->name}}</span>
                                                                        @if(!$status->failure_id && $status->pivot->comment)
                                                                            <i
                                                                                data-feather='info'
                                                                                data-bs-toggle="tooltip"
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
                                                                    <div class="d-flex align-items-center"
                                                                         style="height: 25px">
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
                                                                                 aria-labelledby="js-button-dropdown-menu">
                                                                                <a id="open-edit-status-modal-button-{{$status->pivot->id}}"
                                                                                   data-status-id="{{$status->pivot->id}}"
                                                                                   class="dropdown-item"
                                                                                   data-bs-toggle="modal"
                                                                                   data-bs-target="#edit-status-modal"
                                                                                   href="#">Редагувати
                                                                                    поточний статус</a>
                                                                                <a id="open-add-failure-model-button-{{$status->pivot->id}}"
                                                                                   data-status-id="{{$status->pivot->id}}"
                                                                                   class="dropdown-item"
                                                                                   data-bs-toggle="modal"
                                                                                   data-bs-target="#problem-modal"
                                                                                   href="#">Зафіксувати
                                                                                    проблему</a>
                                                                                <a id="delete-status-{{$status->pivot->id}}"
                                                                                   data-status-id="{{$status->pivot->id}}"
                                                                                   class="dropdown-item" href="#">Видалити
                                                                                    поточний
                                                                                    статус</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="padding-top: 5px; padding-bottom: 5px;">
                                                        <span
                                                            style="font-size: 13px;">{{$status->address}}</span>
                                                                </div>
                                                                <div>
                                                        <span class="pe-1"
                                                              style="font-size: 13px;">{{\Carbon\Carbon::parse($status->pivot->date)->format('d.m.Y')}}</span><span
                                                                        style="font-size: 13px;">{{\Carbon\Carbon::parse($status->pivot->date)->format('H:i')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                @endforeach

                                            </div>
                                            <div class="d-flex"
                                                 style="background-color: rgba(168, 170, 174, 0.08); border-bottom-left-radius: 6px; border-bottom-right-radius: 6px;">
                                                <button type="button" class="btn btn-flat-primary waves-effect w-100"
                                                        style="border-top-left-radius: 0; border-top-right-radius: 0;"
                                                        data-bs-toggle="modal" data-bs-target="#change-status-modal">
                                                    Змінити
                                                    статус
                                                </button>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div
                        class="col-12 col-sm-12 col-md-12 col-lg-3 col-xxl-3 d-flex flex-column justify-content-between"
                        style="row-gap: 1rem"
                    >
                        <div>
                            <div class="planning-data-header pb-1">
                                <h5 class="fw-bolder">Дані планування</h5>
                            </div>
                            <div class="planning-data d-flex flex-column gap-1">
                                <div class="text-truncate"><span>Перевізник: <a
                                            href="/company/{{$planning->carrier->id}}"><span
                                                class="transport-planning-yellow-text ">{{$planning->carrier->name}}</span></a></span>
                                </div>
                                <div class="text-truncate"><span>Водій: <a
                                            href="/user/show/{{$planning->driver->id}}"><span
                                                class="transport-planning-yellow-text ">{{$planning->driver->full_name}}</span></a></span>
                                </div>
                                <div class="text-truncate"><span>Автомобіль: <a
                                            href="/transport/{{$planning->transport->id}}"><span
                                                class="transport-planning-yellow-text">{{$planning->transport->name}}</span></a></span>
                                </div>
                                <div class="text-truncate"><span>Причіп: <a
                                            href="/transport-equipment/{{$planning->additional_equipment->id}}"><span
                                                class="transport-planning-yellow-text">{{$planning->additional_equipment->name}}</span></a></span>
                                </div>
                                <div class="text-truncate"><span>Місткість авто: <span
                                            class="transport-planning-bold-text">{{$planning->additional_equipment->capacity_eu}} пл.</span></span>
                                </div>
                                <div class="text-truncate"><span>Зарезервовано: <span
                                            class="transport-planning-bold-text ">{{$planning->countPallets}} пл.</span></span>
                                </div>
                            </div>
                        </div>

                        <div class="planning-time d-flex flex-column" style="gap:5px;">
                            <div>

                                <span>Створено {{\Carbon\Carbon::parse($planning->created_at)->format('d.m.Y')}} в <span
                                        class="transport-planning-bold-text">{{\Carbon\Carbon::parse($planning->created_at)->format('H:i')}}</span></span>
                            </div>
                            <div><span>Редаговано {{\Carbon\Carbon::parse($planning->updated_at)->format('d.m.Y')}} в <span
                                        class="transport-planning-bold-text">{{\Carbon\Carbon::parse($planning->updated_at)->format('H:i')}}</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xxl-6">
                        <div class="transoprt-planning-orders-header d-flex justify-content-between pb-1">
                            <div class="d-flex gap-1 align-items-center">
                                <div>
                                    <h5 class="m-0 fw-bolder">Замовлення</h5>
                                </div>
                                <div>
                                <span class="transport-planning-yellow-text" style="cursor: pointer;"
                                      data-bs-toggle="modal" data-bs-target="#transport-planning-orders-modal">Всі ({{count($planning->documents)}})</span>
                                </div>
                            </div>
                            <div><span>Всього палет <span
                                        class="transport-planning-bold-text">{{$planning->countPallets}}</span></span>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-1" style="height: 285px; overflow-y:auto;">

                            @foreach($planning->documents as $documentIndex => $document)

                                <div class="d-flex justify-content-between p-1 gap-2"
                                     style="background-color: rgba(168, 170, 174, 0.08); border-radius: 6px;">
                                    <div class="pe-0"><span
                                            class="transport-planning-bold-text">{{$documentIndex + 1}}</span></div>
                                    <div class="p-0 flex-grow-1">
                                        <div style="padding-bottom:10px;"><a href="/document/{{$document->id}}"><span
                                                    class="transport-planning-yellow-text pe-1">{{$planning->documents[0]->documentType->key == 'tovarna_nakladna' ? 'ТН' : 'ЗНТ'}}{{$document->id}}</span></a><span>Палет: </span><span
                                                class="transport-planning-bold-text">{{$document->pallet}} ({{$document->weight}}кг)</span>
                                        </div>
                                        <div style="padding-bottom:5px;"><span>Постачальник: </span><span
                                                class="transport-planning-bold-text">{{$document->company_provider}}</span>
                                        </div>
                                        <div style="padding-bottom:5px;"><span>Склад завантаження: </span><span
                                                class="transport-planning-bold-text">{{$document->loading_warehouse}}</span>
                                        </div>
                                        <div style="padding-bottom:5px;"><span>Замовник: </span><span
                                                class="transport-planning-bold-text">{{$document->company_customer}}</span>
                                        </div>
                                        <div><span>Склад розвантаження: </span><span
                                                class="transport-planning-bold-text">{{$document->unloading_warehouse}}</span>
                                        </div>
                                    </div>
                                    <div class="ps-0 pe-1">

                                        <div class="btn-group js-button-dropdown-menu"
                                             id="transport-planning-order-dropdown">
                                            <div data-bs-toggle="dropdown"
                                                 aria-expanded="false" class="py-25 px-50">
                                                <i data-feather='more-vertical'
                                                   style="cursor: pointer;">
                                                </i>
                                            </div>
                                            <div class="dropdown-menu"
                                                 aria-labelledby="transport-planning-order-dropdown">
                                                <a class="dropdown-item" href="/document/{{$document->id}}">Переглянути
                                                    ТН</a>
                                                <a class="dropdown-item" href="#">Роздрукувати ТН як документ</a>
                                                <a class="dropdown-item" href="#">Переглянути ТТН</a>
                                                <a class="dropdown-item" href="#">Роздрукувати ТТН</a>
                                                <a class="dropdown-item" href="#">Переглянути палетні листи</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Change status modal -->
        <div class="modal fade text-start" id="change-status-modal" tabindex="-1"
             aria-labelledby="myModalLabel18" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header d-flex justify-content-center">
                        <h3 class="modal-title fw-bolder" id="myModalLabel18">Зміна статусу
                            рейсу</h3>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label class="form-label"
                                   for="change-status-select">Статус</label>
                            <select class="form-select select2"
                                    id="change-status-select"
                                    data-placeholder="Оберіть статус
                                                                        рейсу" required>
                                <option value=""></option>

                                @foreach($allStatuses as $status)
                                    <option
                                        value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-1">
                            <label class="form-label"
                                   for="change-status-select-location">Адреса</label>
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
                            <label class="form-label" for="fp-date-time">Дата і
                                час</label>
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
                        <button id="create-status-button"
                                data-transport-planning-id="{{$planning->id}}"
                                type="button" class="btn btn-primary"
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
                            <select class="form-select select2"
                                    id="edit-status-select"
                                    required data-placeholder="Оберіть статус
                                                                        рейсу">
                                <option value=""></option>
                                @foreach($allStatuses as $status)
                                    <option
                                        value="{{$status->id}}" {{$status->id == $status->id ? 'selected' : ''}}>{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label"
                                   for="edit-status-select-location">Адреса</label>
                            <select class="form-select select2"
                                    id="edit-status-select-location"
                                    required data-placeholder="Оберіть адресу
                                                                        рейсу">
                                <option value=""></option>

                                @foreach($allAddresses as $address)
                                    <option
                                        value="{{$address->id}}" {{$address->id == $address->id ? 'selected' : ''}}>{{$address->full_address}}</option>
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
                                                            <textarea class="form-control" id="edit-status-comment"
                                                                      rows="3"
                                                                      placeholder="Залиште коментар, якщо маєте що додати"
                                                                      style="max-height: 150px; min-height: 100px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: none;">
                        <button type="button" class="btn btn-flat-secondary"
                                data-bs-dismiss="modal">Скасувати
                        </button>
                        <button id="edit-status-button" type="button"
                                class="btn btn-primary"
                                data-bs-dismiss="modal">Оновити статус
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Problem modal -->
        <div class="modal fade text-start" id="problem-modal" tabindex="-1" aria-labelledby="myModalLabel18"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content p-3">
                    <div class="modal-header d-flex justify-content-center">
                        <h3 class="modal-title fw-bolder" id="myModalLabel18">Фіксація проблеми</h3>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label class="form-label" for="basicSelect">Тип збою постачання</label>
                            <select class="form-select select2" id="problemSelect"
                                    data-placeholder="Оберіть тип збою постачання" required>
                                <option value=""></option>
                                @foreach($allFailureTypes as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basicInput">Причина збою постачання</label>
                            <input type="text" class="form-control" id="problem-reason"
                                   placeholder="Вкажіть причину збою постачання" required/>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basicInput">Винуватець збою постачання</label>
                            <input type="text" class="form-control" id="problem-author"
                                   placeholder="Вкажіть винуватця збою постачання" required/>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basicInput">Вартість штрафних санкцій</label>
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
                        <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">
                            Скасувати
                        </button>
                        <button id="add-reason-submit" type="button" class="btn btn-primary"
                                data-bs-dismiss="modal">Зафіксувати
                            проблему
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transport planning orders modal -->
        <div class="modal-size-xl d-inline-block">
            <div class="modal fade text-start" id="transport-planning-orders-modal" tabindex="-1"
                 aria-labelledby="myModalLabel16" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="pb-2">
                                <div class="modal-body-title pb-2">
                                    <h3 class="text-center fw-bolder">{{$planning->documents[0]->documentType->key == 'tovarna_nakladna' ? 'Товарні накладні' : 'Запити на транспорт'}} </h3>
                                </div>
                                <div class="d-flex flex-column gap-1">

                                    @foreach($planning->documents as $documentIndex => $document)

                                        <div class="p-2"
                                             style="background-color: rgba(168, 170, 174, 0.08); border-radius: 6px;">
                                            <div class="d-flex align-items-center pb-1"><span
                                                    class="pe-1 fw-semibold">{{$documentIndex + 1}}</span><img
                                                    src="{{asset('assets/icons/entity/transport-planning/info-square.svg')}}"><span
                                                    class="transport-planning-bold-text">{{$planning->documents[0]->documentType->key == 'tovarna_nakladna'
                                                    ? 'Товарна накладна' : 'Запит на транспорт'}} №{{$document->id}}</span>
                                            </div>
                                            <div class="d-flex ps-2 gap-1">
                                                <div class="d-flex flex-column" style="flex: 3; gap: 10px;">
                                                    <div><span>Склад і час завантаження:</span></div>
                                                    <div><span
                                                            class="transport-planning-bold-text">{{$document->loading_warehouse}}</span>
                                                    </div>
                                                    <div><span
                                                            class="transport-planning-bold-text">{{\Carbon\Carbon::parse($document->loading_date['date'])->format('d.m.Y')}} {{$document->loading_date['from']}}-{{$document->loading_date['to']}}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column" style="flex: 3; gap: 10px;">
                                                    <div><span>Склад і час розвантаження:</span></div>
                                                    <div><span
                                                            class="transport-planning-bold-text">{{$document->unloading_warehouse}}</span>
                                                    </div>
                                                    <div><span
                                                            class="transport-planning-bold-text">{{\Carbon\Carbon::parse($document->unloading_date['date'])->format('d.m.Y')}} {{$document->unloading_date['from']}}-{{$document->unloading_date['to']}}</span>
                                                    </div>
                                                </div>
                                                <div class="empty-container" style="flex: 3;"></div>
                                                <div style="flex: 3;">
                                                    <div class="d-flex flex-column" style="gap: 10px;">
                                                        <div><span>Загальна вага: </span><span
                                                                class="transport-planning-bold-text">{{$document->weight}} кг</span>
                                                        </div>
                                                        <div><span>Фактичних палет: </span><span
                                                                class="transport-planning-bold-text">{{$document->pallet}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
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
    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>

    <script src="{{asset('assets/js/entity/transport-planning/transport-planning-list.js')}}"></script>
@endsection
