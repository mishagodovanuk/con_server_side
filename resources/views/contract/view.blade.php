@php use App\Enums\ContractStatus;use Carbon\Carbon; @endphp
@extends('layouts.admin')
@section('title','Перегляд договору')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
@endsection

@section('table-js')
    @include('layouts.table-scripts')
    <script src="{{asset('assets/js/utils/loader-for-tabs.js')}}"></script>

    <script type="text/javascript">
        // Ініціалізуємо таби
        $('#tabs').jqxTabs({
            width: '100%',
            height: '100%'
        });
    </script>
@endsection

@section('content')
    <div class=" mx-2 px-0">
        <!-- навігація з кнопками та діями головними -->
        <div class=" d-flex justify-content-between align-items-center">
            <div class="">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/contracts" style="color: #4B465C;">Договори</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Перегляд {{$side}} договору
                            №{{$contract->id}}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="contract-actions d-flex align-items-center gap-2">
                {{--                <div class=" mr-1" id="bnt-action-printer"><i data-feather='printer'--}}
                {{--                                                              style="cursor: pointer; transform: scale(1.2);"></i>--}}
                {{--                </div>--}}

                @if($contract->status === ContractStatus::CREATED)
                    <div class=" mr-1" id="bnt-action-edit">
                        <a class="link-secondary" href="/contracts/{{$contract->id}}/edit">
                            <i data-feather='edit'
                               style="cursor: pointer; transform: scale(1.2);"></i>
                        </a>
                    </div>

                    <div class="" id="bnt-action-delete" data-bs-toggle="modal"
                         data-bs-target="#deleteContractModal"><a
                            class="text-secondary" href="#">
                            <i data-feather='trash-2'
                               style="cursor: pointer; transform: scale(1.2);"></i>
                        </a>
                    </div>
                @endif

                <div>

                    <div class="btn-group d-flex  gap-1">
                        @if($contract->status == ContractStatus::CREATED && $userSide == 1)
                            <a class="btn btn-primary rounded" id="btn-send-for-review" href="#">Надіслати на
                                розгляд</a>
                        @endif
                        @if($contract->status == ContractStatus::PENDING_CONSOLIDATION && $userSide == 1)
                            <a class="btn btn-primary rounded" id="btn-return-for-review" href="#">Повернути з
                                розгляду</a>
                        @endif
                        @if($contract->status == ContractStatus::PENDING_CONSOLIDATION && $userSide == 0)
                            <a class="btn btn-outline-danger rounded" id="btn-reject" href="#"
                               data-bs-toggle="modal"
                               data-bs-target="#causesRejectionModal">Відхилити</a>
                            <button class="btn btn-primary rounded" disabled id="btn-sign" href="#">Підписати</button>
                        @endif
                        @if($contract->status == ContractStatus::PENDING_SIGN && $userSide == 1)
                            <a class="btn btn-primary rounded" disabled id="btn-second-sign" href="#">Підписати</a>
                        @endif
                        @if($contract->status == ContractStatus::PENDING_SIGN && $userSide == 0)
                            <a class="btn btn-primary rounded" id="btn-reject-sign" href="#">Скасувати підпис</a>
                        @endif
                        @if($contract->status == ContractStatus::SIGNED_ALL)
                            <a class="btn btn-outline-danger rounded" href="#"
                               data-bs-toggle="modal" data-bs-target="#contractCancelledModal">Розірвати
                                договір</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- контент -->
        <div class="row mx-0 my-2">
            <div class="col-12 col-md-12 col-lg-5 pe-0 pe-md-1 ps-0">
                <div class="row" style="">
                    <div class="col-lg-12 col-md-6 px-1 mt-0">
                        <!-- блок договір -->
                        <div class="card p-2 mb-1">
                            <div class="align-items-center px-0 d-flex gap-1 mb-1">
                                <h4 class="card-title fw-bolder mb-0 pt-0 ">Договір №{{$contract->id}}</h4>
                                <!-- контейнер з статусами договора -->
                                <div class="">
                                    @if($contract->status == ContractStatus::CREATED)
                                        <div class="alert alert-secondary fw-bolder p-0"
                                             style="padding : 2px 10px !important;"
                                             id="status-contract-create"> Створено
                                        </div>
                                    @endif
                                    @if($contract->status == ContractStatus::PENDING_CONSOLIDATION && $userSide == 1)
                                        <div class="alert alert-primary fw-bolder p-0"
                                             style="padding : 2px 10px !important;"
                                             id="status-contract-submitted-for-review">Надіслано на розгляд
                                        </div>
                                    @endif
                                    @if($contract->status == ContractStatus::PENDING_CONSOLIDATION  && $userSide == 0)
                                        <div class="alert alert-primary fw-bolder p-0"
                                             style="padding : 2px 10px !important;"
                                             id="status-contract-waiting-for-your-sign">Очікує на ваш підпис
                                        </div>
                                    @endif
                                    @if($contract->status == ContractStatus::PENDING_SIGN  && $userSide == 0)
                                        <div class="alert alert-primary fw-bolder p-0"
                                             style="padding : 2px 10px !important;"
                                             id="status-contract-waiting-for-your-sign">Очікує на підпис
                                        </div>
                                    @endif
                                    @if($contract->status == ContractStatus::PENDING_SIGN  && $userSide == 1)
                                        <div class="alert alert-primary fw-bolder p-0"
                                             style="padding : 2px 10px !important;"
                                             id="status-contract-waiting-for-your-sign">Очікує на ваш підпис
                                        </div>
                                    @endif
                                    @if($contract->status == ContractStatus::SIGNED_ALL)
                                        <div class="alert alert-success fw-bolder p-0"
                                             style="padding : 2px 10px !important;"
                                             id="status-contract-signed-by-all">Підписано всіма
                                        </div>
                                    @endif
                                    @if($contract->status == ContractStatus::TERMINATED)
                                        <div class="alert alert-secondary fw-bolder p-0"
                                             style="padding : 2px 10px !important; color: #4B4B4B !important;"
                                             id="status-contract-broken">Розірвано
                                        </div>
                                    @endif
                                    @if($contract->status == ContractStatus::DECLINE)
                                        <div class="alert alert-danger fw-bolder p-0"
                                             style="padding : 2px 10px !important;"
                                             id="status-contract-rejected-by-you">Відхилено вами
                                        </div>
                                    @endif
                                    @if($contract->status == ContractStatus::DECLINE_CONTRACTOR)
                                        <div class="alert alert-danger fw-bolder p-0"
                                             style="padding : 2px 10px !important;"
                                             id="status-contract-rejected-by-contractor">Відхилено контрагентом
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="card-body px-0 py-0 d-flex flex-column">
                                <div class="d-flex row mx-0">
                                    <p class="f-15 fw-4 col-4 ps-0">Договір</p>
                                    <p class="f-15 fw-5 col-8">{{$typeName}}</p>
                                </div>
                                <div class="d-flex row mx-0">
                                    <p class="f-15 fw-4 col-4 ps-0">Тип договору</p>
                                    <p class="f-15 fw-5 col-8">{{$sideName}}</p>
                                </div>
                                <div class="d-flex row mx-0">
                                    <p class="f-15 fw-4 col-4 ps-0">Зі сторони</p>
                                    <p class="f-15 fw-5 col-8">{{$roleName}}</p>
                                </div>
                                <div class="d-flex row mx-0">
                                    <p class="f-15 fw-4 col-4 ps-0">Дата створення</p>
                                    <p class="f-15 fw-5 col-8">{{Carbon::parse($contract->created_at)->format('d.m.Y')}}</p>
                                </div>
                                <div class="d-flex row mx-0">
                                    <p class="f-15 fw-4 col-4 ps-0">Ваша компанія</p>
                                    <a
                                        class="f-15 fw-5 col-8 text-decoration-underline"
                                        href="/company/{{$contract->company->id}}"
                                        style="color: #6F6B7D">{{$contract->company->name}}
                                    </a>
                                </div>
                                <div class="d-flex row mx-0">
                                    <p class="f-15 fw-4 col-4 ps-0">Контрагент</p>
                                    <a
                                        class="f-15 fw-5 col-8 text-decoration-underline"
                                        href="/company/{{$contract->counterparty->id}}"
                                        style="color: #6F6B7D">{{$contract->counterparty->name}}
                                    </a>
                                </div>
                                <div class="d-flex row mx-0">
                                    <p class="f-15 fw-4 col-4 ps-0">Термін дії</p>
                                    <p class="f-15 fw-5 col-8">
                                        до {{Carbon::parse($contract->expired_at)->format('d.m.Y')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6  pe-md-0 pe-lg-1">
                        <!-- підписанн та коменарі два блоки -->
                        <div class="card p-2 mb-1 pt-0 ">
                            <div class="card-header px-0">
                                <h5 class="card-title fw-8 pt-0 f-15 fw-bolder">Підписання</h5>
                            </div>
                            <div class="card-body px-0 py-0">
                                <div class="d-flex">
                                    <p class=" f-15 fw-4 " style="width:170px; ">Ваша компанія</p>
                                    <p class="f-15 fw-5 text-truncate">{{$contract->signed_at ?? '-'}}</p>
                                </div>
                                <div class="d-flex">
                                    <p class=" f-15 fw-4 " style="width:170px; ">Ваш контрагент</p>
                                    <p class="f-15 fw-5 ">{{$contract->signed_at_counterparty ?? '-'}}</p>
                                </div>
                                <div class="d-flex d-none" id="block-for-broken-info">
                                    <p class=" f-15 fw-4 " style="width:170px; ">Розірвання</p>
                                    <div><a class="f-15 fw-5 text-decoration-underline d-flex" href="#"
                                            style="color: #6F6B7D">ТОВ
                                            “КОМПАНІЯ 1”</a>
                                        <p class="f-15 fw-5 ">до 23.05.2024</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card p-2 mb-1">
                            <div class="card-header py-1 px-0 d-flex align-items-center justify-content-between">
                                <h5 class="card-title fw-8 pt-0 f-15 fw-bolder">
                                    Коментарі <span id="comment-count">{{count($contract->comments)}}</span></h5>
                                <button
                                    class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addCommentModal">Додати коментар
                                </button>
                            </div>
                            <!-- контейнер для коментів -->
                            <div class="card-body px-0 py-0" id="comments-container">
                                @foreach($contract->comments as $comment)
                                    <div>
                                        <p class="f-15 fw-5 row mx-0">
                                            <span class="col-8 ps-0">
                                              {{$comment->company->name}}
                                            </span>
                                            <span class="f-15 col-4 text-secondary pe-0 text-end">
                                                {{ Carbon::parse($comment->created_at)->format('d.m.Y') }} о {{ Carbon::parse($comment->created_at)->format('H:i:s') }}
                                            </span>
                                        </p>
                                        <p>{{$comment->comment}}</p>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12  col-lg-6 pe-0 ps-lg-1 ps-0 " style="flex-grow: 1;">
                <div class="col-xl-12 col-lg-12 h-100">
                    <div class="card h-100">
                        <div id="jqxLoader"></div>

                        <div class="ps-2 pt-2">
                            <h4 class="fw-bolder">Регламенти</h4>
                        </div>
                        <div class="contract-view-tables h-100">
                            <!-- Basic Tabs starts -->
                            <div id="tabs" class="invisible">
                                <ul class="d-flex ">
                                    <li>З вашої сторони</li>
                                    <li>Зі сторони контрагента</li>
                                </ul>
                                <div>
                                    <!-- контент в першій табі вашої сторони-->
                                    @if($ownRegulation)
                                        <!-- для магазинів табу вашої сторони -->
                                        <div class="d-none list-regulations-for-market">
                                            <div class="p-2 pb-0">
                                                <h2 class="f-15 fw-bolder">
                                                    <h2 class="f-15 fw-bolder"> {{$ownRegulation->name}}
                                                        ({{$contract->role === 1 ? 'Замовник'  :'Постачальник'}}
                                                        послуг)
                                                    </h2>
                                                </h2>
                                            </div>
                                            <hr class="mb-0">
                                            <div class="accordion">
                                                <div class="accordion-item ">
                                                    <h2 class="accordion-header  px-1" id="">
                                                        <button class="accordion-button fw-bolder f-15"
                                                                style="color:#4B465C;"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionOne" aria-expanded="true"
                                                                aria-controls="accordionOne">
                                                            1. Назва і батьківський регламент
                                                        </button>
                                                    </h2>
                                                    <div id="accordionOne" class="accordion-collapse collapse show"
                                                         aria-labelledby="headingOne"
                                                         data-bs-parent="#accordionExample">
                                                        <div class="accordion-body px-2">

                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Назва
                                                                    регламенту</p>
                                                                <p class="f-15 m-0 fw-bold">{{$ownRegulation->name}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Батьківський
                                                                    регламент
                                                                </p>
                                                                @if($ownRegulation->parent)
                                                                    <a href="#"
                                                                       class="f-15 fw-bold">{{ $ownRegulation->parent->name }}</a>
                                                                @else
                                                                    <div class="f-15 fw-bold">-</div>
                                                                @endif

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item ">
                                                    <h2 class="accordion-header  px-1" id="">
                                                        <button class="accordion-button fw-bolder f-15"
                                                                style="color:#4B465C;"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionTwo" aria-expanded="true"
                                                                aria-controls="accordionTwo">
                                                            2. Налаштування регламенту
                                                        </button>
                                                    </h2>
                                                    <div id="accordionTwo" class="accordion-collapse collapse "
                                                         aria-labelledby="headingTwo"
                                                         data-bs-parent="#accordionExample">
                                                        <div class="accordion-body px-2">

                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0 fw-bold" style="color:#5D596C;">
                                                                    Повернення товару у разі:</p>
                                                                <p class="f-15 m-0"></p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Тип палет
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$ownRegulation['settings']['typePalet']}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Висота палет
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$ownRegulation['settings']['heightPalet']}}
                                                                    см</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Залишковий
                                                                    термін
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$ownRegulation['settings']['overheadTerm']}}
                                                                    дні</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0 " style="color: #A5A3AE;">Палетний
                                                                    лист
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$ownRegulation['settings']['palletSheet'] ? 'Так' : 'Ні'}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                                    збірні
                                                                    палети
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$ownRegulation['settings']['allowPrefabPallets'] ? 'Так' : 'Ні'}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                                    сендвіч-палету
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$ownRegulation['settings']['allowSandwichPallet'] ? 'Так' : 'Ні'}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Стікерування
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$ownRegulation['settings']['stickering'] ? 'Так' : 'Ні'}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                                    проведення
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$ownRegulation['settings']['allowHolding'] ? 'Так' : 'Ні'}}</p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    @else
                                        <!-- торгові регламенти -->
                                        <div id="retail-list-regulations" class="d-none h-100">
                                            <div class="p-2 pb-0 mb-2">
                                                <h2 class="f-15 fw-bolder mb-1">

                                                    {{$contract->type_id === 0 ? 'Торгові'  :''}}
                                                    {{$contract->type_id === 1 ? 'Складські'  :''}}
                                                    {{$contract->type_id === 2 ? 'Транспортні'  :''}}
                                                    регламенти
                                                    ({{$contract->role === 1 ? 'Замовник'  :'Постачальник'}}
                                                    послуг)
                                                </h2>
                                                <div class="input-group input-group-merge mb-2"
                                                     style="max-width: 350px">
                                                    <span class="input-group-text"><i data-feather="search"></i></span>
                                                    <input type="text" class="form-control ps-2" placeholder="Пошук"
                                                           id="search-retail-regulation"/>
                                                </div>
                                            </div>

                                            <hr class="mb-0">
                                            <ul class="container-for-market-list list-s-none">

                                            </ul>
                                        </div>

                                        <!-- відсутні регламенти -->
                                        <div id="missingRegulations" class="d-none h-100">
                                            <hr>
                                            <div style="margin-top: 200px"
                                                 class="h-100 d-flex flex-column align-items-center justify-content-center px-2">
                                                <h4 class="fw-bolder">Немає доступних регламентів</h4>
                                                <p class="text-center">
                                                    Створіть регламенти для “Договір на <span
                                                        id="missingRegulationsTitleType">шаблон</span>
                                                    послуги” <br>
                                                    для сторони “<span id="missingRegulationsTitleSide">Шаблон</span>”
                                                </p>
                                                <button id="create-regulation-missing" type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#createNewRegulationModal"
                                                        class="btn btn-outline-primary">
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Створити регламент</span>
                                                </button>

                                            </div>
                                        </div>

                                        <!-- один торговий регламент-->
                                        <div id="one-retail-regulation" class="d-none">
                                            <div class="p-2 pb-0 d-flex justify-content-between align-items-center">
                                                <h2 class="f-15 fw-bolder"><a href="#" class="text-black"
                                                                              id="link-to-back-retail-list"><i
                                                            data-feather="arrow-left"
                                                            class="me-25 cursor-pointer"></i> </a> <span
                                                        id="one-regulation-name"> Для
                                    магазинів </span> (Замовник послуг)</h2>
                                                <button class="d-none btn btn-outline-primary btn-sm"
                                                        id="btn-cancel-changes">
                                                    Відмінити
                                                    зміни
                                                </button>
                                            </div>
                                            <hr class="mb-0">
                                            <div class="accordion">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header  px-1" id="">
                                                        <button class="accordion-button fw-bolder f-15"
                                                                style="color:#4B465C;"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionOne"
                                                                aria-expanded="true" aria-controls="accordionOne">
                                                            1. Назва і батьківський регламент
                                                        </button>
                                                    </h2>
                                                    <div id="accordionOne" class="accordion-collapse collapse show"
                                                         aria-labelledby="headingOne"
                                                         data-bs-parent="#accordionExample">
                                                        <div class="accordion-body px-2 ps-3">
                                                            <div class="row">
                                                                <div class="col-12 col-sm-6 mb-1">
                                                                    <input type="text" class="form-control"
                                                                           id="nameRetail" required
                                                                           placeholder="">
                                                                </div>
                                                                <div class="col-12 col-sm-6 mb-1">
                                                                    <div class="mb-1">
                                                                        <select class="select2 form-select"
                                                                                id="parentRegulation"
                                                                                data-placeholder="Батьківський регламент">
                                                                            <option value=""></option>
                                                                            @foreach($regulations as $regulation)
                                                                                <option
                                                                                    value="{{$regulation->id}}">{{$regulation->name}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item ">
                                                    <h2 class="accordion-header  px-1" id="">
                                                        <button class="accordion-button fw-bolder f-15"
                                                                style="color:#4B465C;"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionTwo"
                                                                aria-expanded="true" aria-controls="accordionTwo">
                                                            2. Налаштування регламенту
                                                        </button>
                                                    </h2>
                                                    <div id="accordionTwo" class="accordion-collapse collapse"
                                                         aria-labelledby="headingTwo"
                                                         data-bs-parent="#accordionExample">
                                                        <div class="accordion-body px-2 ">


                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Тип палет
                                                                </p>
                                                                <div style="width: 260px">
                                                                    <select class="select2 form-select" id="typePallet"
                                                                            data-placeholder="Тип палет">
                                                                        <option value=""></option>
                                                                        @foreach($typePallets as $key => $value)
                                                                            <option value="{{$key}}">{{$value}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Висота палет
                                                                </p>
                                                                <div class="input-group" style="width: 260px">
                                                                    <input type="number" class="form-control"
                                                                           id="heightPallet">
                                                                    <span class="input-group-text">см</span>
                                                                </div>


                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Залишковий
                                                                    термін
                                                                </p>
                                                                <div class="input-group" style="width: 260px">
                                                                    <input type="number" class="form-control"
                                                                           id="remainingTerm">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Палетний
                                                                    лист
                                                                </p>
                                                                <div class="form-check form-switch"><input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        id="palletLatter"></div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                                    збірні
                                                                    палети
                                                                </p>
                                                                <div class="form-check form-switch"><input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        id="allowPrefabricatedPallets">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                                    сендвіч-палету
                                                                </p>
                                                                <div class="form-check form-switch"><input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        id="allowSendwichPallet">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Стікерування
                                                                </p>
                                                                <div class="form-check form-switch"><input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        id="labeling"></div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-2 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                                    проведення
                                                                </p>
                                                                <div class="form-check form-switch"><input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        id="allowCondacting">
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    @endif
                                </div>

                                <!-- контент в контрагента-->
                                <div>
                                    @if($contractorRegulation)
                                        <!-- для магазинів В ДРУГІЙ ТАБІ-->
                                        <div>
                                            <div class="p-2 pb-0">
                                                <h2 class="f-15 fw-bolder"> {{$contractorRegulation->name}}
                                                    ({{$contract->role !== 1 ? 'Замовник'  :'Постачальник'}}
                                                    послуг)</h2>
                                            </div>
                                            <hr class="mb-0">
                                            <div class="accordion">
                                                <div class="accordion-item ">
                                                    <h2 class="accordion-header  px-1" id="">
                                                        <button class="accordion-button fw-bolder f-15"
                                                                style="color:#4B465C;"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionOne" aria-expanded="true"
                                                                aria-controls="accordionOne">
                                                            1. Назва і батьківський регламент
                                                        </button>
                                                    </h2>
                                                    <div id="accordionOne" class="accordion-collapse collapse show"
                                                         aria-labelledby="headingOne"
                                                         data-bs-parent="#accordionExample">
                                                        <div class="accordion-body px-2">

                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Назва
                                                                    регламенту</p>
                                                                <p class="f-15 m-0 fw-bold">{{$contractorRegulation->name}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0 " style="color: #A5A3AE;">
                                                                    Батьківський регламент
                                                                </p>
                                                                @if($contractorRegulation->parent)
                                                                    <a href="#"
                                                                       class="f-15 fw-bold">{{ $contractorRegulation->parent->name }}</a>
                                                                @else
                                                                    <div class="f-15 fw-bold">-</div>
                                                                @endif
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item ">
                                                    <h2 class="accordion-header  px-1" id="">
                                                        <button class="accordion-button fw-bolder f-15"
                                                                style="color:#4B465C;"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionTwo" aria-expanded="true"
                                                                aria-controls="accordionTwo">
                                                            2. Налаштування регламенту
                                                        </button>
                                                    </h2>
                                                    <div id="accordionTwo" class="accordion-collapse collapse "
                                                         aria-labelledby="headingTwo"
                                                         data-bs-parent="#accordionExample">
                                                        <div class="accordion-body px-2">

                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0 fw-bold" style="color:#5D596C;">
                                                                    Повернення товару у разі:</p>
                                                                <p class="f-15 m-0"></p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Тип палет
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$contractorRegulation['settings']['typePalet']}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Висота палет
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$contractorRegulation['settings']['heightPalet']}}
                                                                    см</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Залишковий
                                                                    термін
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$contractorRegulation['settings']['overheadTerm']}}
                                                                    дні</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0 " style="color: #A5A3AE;">Палетний
                                                                    лист
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$contractorRegulation['settings']['palletSheet'] ? 'Так' : 'Ні'}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                                    збірні
                                                                    палети
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$contractorRegulation['settings']['allowPrefabPallets'] ? 'Так' : 'Ні'}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                                    сендвіч-палету
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$contractorRegulation['settings']['allowSandwichPallet'] ? 'Так' : 'Ні'}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Стікерування
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$contractorRegulation['settings']['stickering'] ? 'Так' : 'Ні'}}</p>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ps-3 pe-50 py-1">
                                                                <p class="f-15 m-0" style="color: #A5A3AE;">Дозволити
                                                                    проведення
                                                                </p>
                                                                <p class="f-15 fw-bold">{{$contractorRegulation['settings']['allowHolding'] ? 'Так' : 'Ні'}}</p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    @else
                                        <!-- інфо про відсутність регламенту в контрагента -->
                                        <div
                                            class="info-about-missing-contractorTab d-flex flex-column justify-content-center align-items-center"
                                            style="height: 500px">
                                            <h4 class="fw-bolder">Немає регламенту зі сторони контрагента</h4>
                                            <p class="text-secondary">Він зʼявиться після того як контрагент додасть
                                                його до договору</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal add comment-->
    <div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 580px">
            <div class="p-4 modal-content">
                <h2 class="mb-2 text-center fw-bolder">Залишити коментар</h2>

                <form class="" method="" action="#">
                    <textarea class="form-control" style="min-height: 60px; max-height: 600px" id="text-for-comment"
                              rows="3"
                              placeholder="Текст коментаря"></textarea>
                    <div class="d-flex justify-content-end pt-2">
                        <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">
                            Скасувати
                        </a>
                        <button type="button" class="btn btn-primary" id="btnAddComment">
                            Надіслати
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- modal causes of rejection-->
    <div class="modal fade" id="causesRejectionModal" tabindex="-1" aria-labelledby="causesRejectionModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 580px">
            <div class="p-4 modal-content">
                <h2 class="text-center fw-bolder">Причина відхилення</h2>
                <p class="mb-2 text-center">Напишіть причину відхилення договору</p>

                <form class="" method="" action="#">
                    <textarea class="form-control" id="text-for-comment" rows="3"
                              placeholder="Текст коментаря"></textarea>
                    <div class="d-flex justify-content-end pt-2">
                        <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">
                            Скасувати
                        </a>
                        <button type="button" class="btn btn-primary" id="click-causes-of-rejection">
                            Відхилити
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- modal contract cancelled-->
    <div class="modal fade" id="contractCancelledModal" tabindex="-1" aria-labelledby="contractCancelledModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 580px">
            <div class="p-4 modal-content">
                <h2 class="text-center fw-bolder">Причина розірвання договору</h2>
                <p class="mb-2 text-center">Напишіть причину розірвання договору</p>

                <form class="" method="" action="#">
                    <textarea class="form-control" id="text-for-comment" rows="3"
                              placeholder="Текст коментаря"></textarea>
                    <div class="d-flex justify-content-end pt-2">
                        <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">
                            Скасувати
                        </a>
                        <button type="button" class="btn btn-primary" id="btn-cancel-contract">
                            Розірвати договір
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- modal dellete contract-->
    <div class="modal fade" id="deleteContractModal" tabindex="-1" aria-labelledby="deleteContractModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 580px">
            <div class="p-2 modal-content">
                <h4 class="mb-2 fw-bolder">Видалення договору №{{$contract->id}}</h4>
                <p class="mb-2">Ви впевнені, що хочете видалити цей договір?</p>

                <form class="d-flex justify-content-end" method="" action="#">
                    <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">
                        Скасувати
                    </a>
                    <button type="button" class="btn btn-primary" id="delete-contract-btn">
                        Видалити
                    </button>

                </form>

            </div>
        </div>
    </div>

    <!-- amendments to the regulations-->
    <div class="modal fade" id="amendedChangesModal" tabindex="-1" aria-labelledby="amendedChangesModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 580px">

            <div class=" modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="p-4 pt-2">
                    <h2 class="mb-0 mt-0 text-center fw-bolder">Внесено зміни до регламенту</h2>
                    <div class="p-2">
                        <p class="mb-1 text-start">Ви внесли зміни в цей регламент при додаванні до цього договору.
                            Бажаєте
                            оновити
                            цей регламент, або створити новий тип?</p>
                    </div>
                    <form class="d-flex justify-content-end" method="" action="#">
                        <a class="btn btn-outline-primary mr-2 text-primary" data-bs-toggle="modal"
                           data-bs-target="#createNewRegulationModal" id="btn-create-new-regulation-in-modal">
                            Створити новий регламент
                        </a>
                        <button type="button" class="btn btn-primary" id="update-regulation">
                            Оновити
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- create new regulation-->
    <div class="modal fade" id="createNewRegulationModal" tabindex="-1" aria-labelledby="createNewRegulationModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 580px">

            <div class=" modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="p-4 pt-2">
                    <h2 class="mb-1 mt-0 text-center  fw-bolder">Створення нового регламенту</h2>
                    <p class="mb-1 text-center">Вкажіть назву і за потреби оберіть батьківський регламент</p>
                    <form class=" pt-2" method="" action="#">
                        <div class="mb-1"><label class="form-label" for="nameRetailInModal">Назва регламенту </label>
                            <input type="text" class="form-control" id="nameRetailInModal" required
                                   placeholder="Вкажіть назву">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="parentRegulationInModal">Батьківський регламент (за потреби)
                            </label>
                            <select class="select2 form-select" name="parentRegulationInModal"
                                    id="parentRegulationInModal"
                                    data-placeholder="Оберіть батьківський регламент">
                                <option value=""></option>
                                <option selected value="parent">Батьківський регламент</option>
                                @foreach($regulations as $regulation)
                                    <option value="{{$regulation->id}}">{{$regulation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary " id="create-regulation">
                                Створити
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>
        const contractId = {!! $contract->id !!};
        const isContractor = {!! intval($userSide) !!};
        const commentCompany = {!! $userSide ? $contract->counterparty : $contract->company !!};

        let contractRoleReg = {!! $contract->role !!};
        let contractTypeReg = {!! $contract->type_id !!};

        if (contractRoleReg === 0) {
            contractRoleReg = 1
        } else {
            contractRoleReg = 0
        }

    </script>

    <script type="module" src="{{asset('assets/js/entity/contract/contract-view.js')}}"></script>

@endsection



