@extends('layouts.admin')
@section('title','Workspaces')
@section('page-style')
@endsection
@section('before-style')
@endsection

@section('content')
    <div class="container-fluid px-2">
        <div class="d-flex gap-5">
            <!-- Settings tabs -->
            <div class="pe-5">
                @include('layouts.setting')

            </div>

            <div class="card d-flex" style="width: 798px;">
                <div class="card-body p-0">
                    <div class="nav-vertical">
                        <div class="tab-content">

                            <!-- Workspace tab start -->
                            <div class="tab-pane active" id="vertical-pill-4" role="tabpanel"
                                 aria-labelledby="stacked-pill-4">
                                <!-- Workspace content start -->
                                <div class="workspace-tab">
                                    <div class="d-flex justify-content-between align-items-center p-2">
                                        <div class="d-flex">
                                            <div class="pe-1">
                                                @if (!is_null($workspace->avatar_type))
                                                    <img style="width: 50px; height: 50px;"
                                                         src="{{'/file/uploads/workspace/avatars/'.$workspace->id.'.'.$workspace->avatar_type}}">
                                                @else
                                                    <div
                                                        style="width: 50px;height: 50px;padding-right: 5px;border-radius: 50%;display: inline-block;vertical-align: middle;background: {{$workspace->avatar_color}};position: relative">
                                                    <span
                                                        style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: white;font-family: 'Montserrat';font-style: normal;font-weight: 600;font-size: 27px;">
                                                        {{$workspace->name[0]}}
                                                    </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-between">
                                                <h5>{{$workspace->name}}</h5>
                                                <div>
                                                    <span style="padding-right: 5px;">Працівників: <span
                                                            style="font-weight: 500;">{{$usersInWorkspaceCount}}</span></span><span>Компаній: <span
                                                            style="font-weight: 500;">{{$companiesCount}}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-outline-danger waves-effect">
                                                Деактивувати
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between px-2 list-document-effect"
                                         id="workspace-details-wrapper"
                                         style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;">
                                        <div><span style="font-weight: 500;">Деталі робочого середовища</span></div>
                                        <div><i data-feather='arrow-right' style="transform: scale(1.5);"></i></div>
                                    </div>
                                    <div class="d-flex justify-content-between px-2 list-document-effect"
                                         id="workspace-tariff-plan-wrapper"
                                         style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;">
                                        <div><span style="font-weight: 500;">Тарифний план</span></div>
                                        <div><i data-feather='arrow-right' style="transform: scale(1.5);"></i></div>
                                    </div>
                                    <div class="d-flex justify-content-between px-2 list-document-effect"
                                         id="workspace-integrations-button"
                                         style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;">
                                        <div><span style="font-weight: 500;">Інтеграції</span></div>
                                        <div><i data-feather='arrow-right' style="transform: scale(1.5);"></i></div>
                                    </div>
                                    <div class="d-flex justify-content-between px-2 list-document-effect"
                                         id="api-details-wrapper"
                                         style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;">
                                        <div><span style="font-weight: 500;">API</span></div>
                                        <div><i data-feather='arrow-right' style="transform: scale(1.5);"></i></div>
                                    </div>
                                </div>

                                <!-- Workspace details start -->
                                <div class="workspace-details px-2" style="padding-top: 30px; padding-bottom: 30px;">
                                    <div class="workspace-content-wrapper">
                                        <div class="content-header d-flex align-items-center">
                                            <div class="back-to-workspace-settings" style="cursor: pointer;">
                                                <i data-feather='arrow-left' class="mx-1"
                                                   style="transform: scale(1.5);"></i>
                                            </div>
                                            <h4 class="mb-0 ps-1">Деталі робочого середовища</h4>
                                        </div>
                                        <div class="row pt-1">
                                            <div class="my-1">
                                                <label class="form-label" for="workspace-username">Назва</label>
                                                <input type="text" id="workspace-username" class="form-control w-75"
                                                       placeholder="Введіть назву" value="{{$workspace->name}}"/>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column justify-content-between">
                                            <div class="row d-flex justify-content-center">
                                                <div class="workspace-choose-avatar d-flex mt-2">
                                                    <div class="workspace-default-avatar-wrapper me-2">
                                                        <div id="avatar-input-container">
                                                            @if ($workspace->avatar_type)
                                                                <img style="width: 102px; height: 102px;"
                                                                     class="workspace-default-avatar"
                                                                     src="{{'/file/uploads/workspace/avatars/'.$workspace->id.'.'.$workspace->avatar_type}}">
                                                            @else
                                                                <img style="width: 102px; height: 102px;"
                                                                     id="workspace-avatar-upload"
                                                                     class="workspace-default-avatar "
                                                                     src="{{asset('assets/icons/default-avatar.svg')}}"
                                                                     alt="default-avatar">
                                                            @endif
                                                        </div>
                                                        <input type="file" id="workspace-file-input" name="avatar"
                                                               hidden=""
                                                               accept="image/jpeg, image/png, image/gif">
                                                    </div>
                                                    <div class="workspace-divider me-2">
                                                        <img class="workspace-vertical-divider"
                                                             src="{{asset('assets/icons/workspace-divider.svg')}}">
                                                    </div>
                                                    <div class="workspace-avatar-preview-wrapper me-4">
                                                        <div class="workspace-avatar-preview" id="workspace-preview"
                                                             style="background: {{$workspace->avatar_color ?? '#8692d0'}}">{{$workspace->name[0]}}</div>
                                                    </div>
                                                    <div
                                                        class="workspace-avatars d-flex flex-column justify-content-around"
                                                        id="avatars">
                                                        <div class="row">
                                                            <div
                                                                class="col workspace-avatar violet {{$workspace->avatar_color === '#8692d0' || is_null($workspace->avatar_color) ? 'workspace-selected' : ''}}"></div>
                                                            <div
                                                                class="col mx-2 workspace-avatar blue {{$workspace->avatar_color === '#00cfe8' ? 'workspace-selected' : ''}}"></div>
                                                            <div
                                                                class="col workspace-avatar green {{$workspace->avatar_color === '#28c76f' ? 'workspace-selected' : ''}}"></div>
                                                        </div>
                                                        <div class="row">
                                                            <div
                                                                class="col workspace-avatar yellow {{$workspace->avatar_color === '#d9b414' ? 'workspace-selected' : ''}}"></div>
                                                            <div
                                                                class="col mx-2 workspace-avatar orange {{$workspace->avatar_color === '#ff9f43' ? 'workspace-selected' : ''}}"></div>
                                                            <div
                                                                class="col workspace-avatar red {{$workspace->avatar_color === '#ea5455' ? 'workspace-selected' : ''}}"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end px-2 pb-2">
                                                    <button type="button" class="btn btn-primary"
                                                            id="submit-workspace-detail">Зберегти зміни
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Workspace details end -->

                                <div class="workspace-tariff">
                                    <div class="workspace-tariff-header d-flex align-items-center px-2"
                                         style="height: 85px;">
                                        <div class="d-flex">
                                            <div class="back-to-workspace-settings" style="cursor: pointer;">
                                                <i data-feather='arrow-left' class="mx-1"
                                                   style="transform: scale(1.5);"></i>
                                            </div>
                                            <h4 class="mb-0 ps-1">Тарифний план</h4>
                                        </div>
                                    </div>
                                    <div class="px-2">
                                        <div class="pb-1">
                                            <div class="d-flex align-items-center" style="padding-bottom: 10px;">
                                                <h6 class="mb-0">Поточний тарифний план</h6><img
                                                    src="{{asset('assets/icons/create-type/header-accordion-icon.svg')}}"
                                                    data-bs-toggle="tooltip" title="200 $ за користувача в місяць">
                                            </div>
                                            <div class="pb-1"><span
                                                    class="fs-4 fw-semibold">${{$workspace->employees_count * 200}}</span>
                                                <span>/ місяць</span></div>
                                            <div class=""><span>Працівників:</span> <span
                                                    class="fw-semibold">{{$workspace->employees_count}}</span></div>
                                        </div>
                                        <hr>
                                        <div class="pt-1">
                                            <div class="pb-1"><span style="font-weight: 500;">Умови тарифу</span></div>
                                            <div>
                                                <ul class="workspace-list-marker-wrapper">
                                                    <li>$200 за працівника в місяць</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end px-2 pb-2">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#tariffModal">Змінити тариф
                                        </button>
                                    </div>

                                    <!-- Tariff modal start -->
                                    <div class="modal fade text-start" id="tariffModal" tabindex="-1"
                                         aria-labelledby="myModalLabel18" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content p-2">
                                                <div class="modal-header"></div>
                                                <div class="modal-body">
                                                    <div
                                                        class="d-flex flex-column justify-content-center align-items-center">
                                                        <div class="pb-1">
                                                            <h3>Змінити тарифний план</h3>
                                                        </div>
                                                        <div>
                                                            <p class="text-center">Вкажіть кількість працівників в вашій
                                                                компанії і ціна за тариф зміниться автоматично</p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="row">
                                                            <div class="my-1 col-md-12">
                                                                <label class="form-label"
                                                                       for="workspace-employee-quantity">Кількість
                                                                    працівників</label>
                                                                <input type="text" id="workspace-employee-quantity"
                                                                       class="form-control"
                                                                       placeholder="Вкажіть кількість працівників"/>
                                                            </div>
                                                        </div>
                                                        <div class="row py-1">
                                                            <div>
                                                                <span class="total-price"
                                                                      style="font-size: 46px; color:#D9B414;"></span><span
                                                                    class="total-price-per-month">/місяць</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="border-top: none;">
                                                    <button type="button" class="btn btn-flat-secondary"
                                                            data-bs-dismiss="modal">Скасувати
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal" id="submit-workspace-tariff">
                                                        Зберегти
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tariff modal end -->
                                </div>

                                <!-- Integrations start -->
                                <div class="workspace-integrations">
                                    <div class="workspace-integrations-list">
                                        <div
                                            class="workspace-integrations-content-header d-flex justify-content-between align-items-center px-2"
                                            style="height: 85px;">
                                            <div class="d-flex">
                                                <div class="back-to-workspace-settings" style="cursor: pointer;">
                                                    <i data-feather='arrow-left' class="mx-1"
                                                       style="transform: scale(1.5);"></i>
                                                </div>
                                                <h4 class="mb-0 ps-1">Інтеграції</h4>
                                            </div>
                                            <div class="workspace-integrations-search">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text" id="workspace-integrations-search"><i
                                                            data-feather="search"></i></span>
                                                    <input type="text" class="form-control ps-1" placeholder="Пошук"
                                                           aria-label="Search..." id="find-integration"
                                                           aria-describedby="workspace-integrations-search"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="workspace-integrations-items d-flex flex-column">
                                            <div
                                                class="workspace-integrations-item d-flex align-items-center justify-content-between px-2 py-1"
                                                id="workspace-integrations-item-vchasno"
                                                style="border-top: 1px solid rgba(168, 170, 174, 0.16);">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div><img src="{{asset('assets/icons/vchasno-logo.svg')}}"></div>
                                                    <div class="d-flex flex-column" style="gap: 5px;">
                                                        <div class=""><span class="fw-semibold integration-title fs-4">Вчасно</span>
                                                        </div>
                                                        <div class=""><span
                                                                class="fs-6">Електронний обіг документів</span></div>
                                                    </div>
                                                </div>
                                                <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                            </div>
                                            <div
                                                class="workspace-integrations-item d-flex align-items-center justify-content-between px-2 py-1"
                                                style="border-top: 1px solid rgba(168, 170, 174, 0.16);">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div><img src="{{asset('assets/icons/edin-icon.svg')}}"></div>
                                                    <div class="d-flex flex-column" style="gap: 5px;">
                                                        <div class=""><span class="fw-semibold integration-title fs-4">EDIN</span>
                                                        </div>
                                                        <div class=""><span class="fs-6">Сервіси електронного документообігу</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                            </div>
                                            <div
                                                class="workspace-integrations-item d-flex align-items-center justify-content-between px-2 py-1"
                                                style="border-top: 1px solid rgba(168, 170, 174, 0.16);">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div><img src="{{asset('assets/icons/ant-logistics-logo.svg')}}">
                                                    </div>
                                                    <div class="d-flex flex-column" style="gap: 5px;">
                                                        <div class=""
                                                             style="display: flex; align-items: center; gap: 10px"><span
                                                                class="fw-semibold integration-title fs-4">Ant logistics</span><span
                                                                class="badge badge-light-success">Підключено</span>
                                                        </div>
                                                        <div class=""><span class="fs-6">Хмарна система управління транспортом</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                            </div>
                                            <div
                                                class="workspace-integrations-item d-flex align-items-center justify-content-between px-2 py-1"
                                                style="border-top: 1px solid rgba(168, 170, 174, 0.16);">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div><img src="{{asset('assets/icons/telegram-logo.svg')}}"></div>
                                                    <div class="d-flex flex-column" style="gap: 5px;">
                                                        <div class=""><span class="fw-semibold integration-title fs-4">Telegram</span>
                                                        </div>
                                                        <div class=""><span class="fs-6">Багатоплатформовий зашифрований месенджер</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="worspace-intergrations-company pb-2">
                                        <div
                                            class="workspace-integrations-company-header d-flex align-items-center px-2"
                                            style="height: 85px;">
                                            <div class="d-flex">
                                                <div class="back-to-workspace-settings-list" style="cursor: pointer;">
                                                    <i data-feather='arrow-left' class="mx-1"
                                                       style="transform: scale(1.5);"></i>
                                                </div>
                                                <h4 class="mb-0 ps-1">Інтеграція з Вчасно</h4>
                                            </div>
                                        </div>
                                        <div
                                            class="workspace-integrations-company-details d-flex align-items-center justify-content-between px-2 pb-1">
                                            <div class="d-flex align-items-center gap-1">
                                                <div><img src="{{asset('assets/icons/vchasno-logo.svg')}}"></div>
                                                <div class="d-flex flex-column" style="gap: 5px;">
                                                    <div class="">
                                                        <h4>Вчасно</h4>
                                                    </div>
                                                    <div class=""><span class="fs-6">Створена компанією: <span
                                                                class="workspaces-yellow-text"
                                                                style="font-weight: 600;">YouControl</span></span></div>
                                                    <div class=""><span class="fs-6">Електронний обіг документів</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <div><span
                                                        class="fw-semibold">3600</span><span> грн/доступ до API</span>
                                                    <img
                                                        src="{{asset('assets/icons/create-type/header-accordion-icon.svg')}}"
                                                        data-bs-toggle="tooltip" title="Hover Triggered">
                                                </div>
                                                <div><span class="fw-semibold">3</span><span> грн/документ</span></div>
                                            </div>
                                        </div>
                                        <hr class="mx-2">
                                        <div class="workspace-integrations-company-benefits py-1 px-2">
                                            <div class="workspace-integrations-company-benefits-title">
                                                <h5>Вчасно для CONSOLID</h5>
                                            </div>
                                            <div class="workspace-integrations-company-benefits-list">
                                                <ul class="workspace-list-marker-wrapper">
                                                    <li>Підписання та надсилання вхідних та вихідних документів</li>
                                                    <li>Коментарі зі співробітниками та контрагентами</li>
                                                    <li>Тарифікація - поштучно за відправлені документи</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="workspace-integrations-company-legal-part pt-2 pb-1 px-2"
                                             style="background-color: rgba(168, 170, 174, 0.08);">
                                            <div class="workspace-integrations-company-legal-part-title"
                                                 style="padding-bottom: 5px;">
                                                <span style="font-size: 13px;">Підписуючи угоду з Вчасно ви:</span>
                                            </div>
                                            <div class="workspace-integrations-company-legal-part-list">
                                                <ul class="workspace-list-marker-wrapper" style="font-size: 13px;">
                                                    <li>Дозволяєте SK Group ділитися анонімними даними з Вчасно для
                                                        CONSOLID
                                                        Pro
                                                    </li>
                                                    <li>Погоджуєтеся з <a href=""><span class="workspaces-yellow-text">умовами використання</span></a>
                                                        SK Group
                                                    </li>
                                                    <li>Погоджуєтеся з <a href=""><span class="workspaces-yellow-text">умовами використання</span></a>
                                                        та <a href=""><span class="workspaces-yellow-text">політикою конфіденційності</span></a>
                                                        Вчасно
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr class="mt-0">
                                        <div
                                            class="workspace-integrations-company-footer d-flex justify-content-between align-items-center px-2">
                                            <div><a href="" target="_blank"><span class="workspaces-yellow-text"
                                                                                  style="font-weight: 500;">Переглянути сторінку продукту</span></a>
                                            </div>
                                            <div>
                                                <button data-bs-toggle="modal" id="modal_vchasno-button"
                                                        data-bs-target="#modal_vchasno"
                                                        type="submit"
                                                        class="btn btn-primary">
                                                    Підключити
                                                </button>


                                            </div>
                                            <!-- toast info -->
                                            <div class="toast-container">
                                                <div class="toast basic-toast position-fixed top-0 end-0 m-2"
                                                     role="alert" aria-live="assertive" aria-atomic="true">
                                                    <div
                                                        class="toast-header d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <img
                                                                src="{{asset('assets/icons/create-type/header-accordion-icon.svg')}}">
                                                            <h6 class="mb-0">Додавання Вчасно в CONSOLID</h6>
                                                        </div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="toast-body"
                                                         style="background-color: #ffffff; border-top: 1px solid rgba(75, 70, 92, 0.1);">
                                                        Ми повідомимо вас коли все буде готово
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- toast success -->
                                            <!-- <div class="toast-container">
                                            <div class="toast basic-toast position-fixed top-0 end-0 m-2" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="toast-header d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center" style="gap: 5px;">
                                                        <img src="{{asset('assets/icons/success-icon.svg')}}">
                                                        <h6 class="mb-0">Успішно</h6>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                                <div class="toast-body" style="background-color: #ffffff; border-top: 1px solid rgba(75, 70, 92, 0.1);">Вчасно було успішно інтегровано в CONSOLID</div>
                                            </div>
                                        </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Integrations end -->

                                <!-- API Start -->
                                <div class="api-details">
                                    <div class="api-content-wrapper">
                                        <div class="content-header d-flex align-items-center px-2"
                                             style="height: 85px;">
                                            <div class="d-flex align-items-center ">
                                                <div id="back-to-workspace-settings-2" style="cursor: pointer;">
                                                    <i data-feather='arrow-left' class="mx-1"
                                                       style="transform: scale(1.5);"></i>
                                                </div>
                                                <h4 class="mb-0">API</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between px-2 list-document-effect"
                                             style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;"
                                             id="apiKeys-details-wrapper">
                                            <div><span style="font-weight: 500;">API ключі</span></div>
                                            <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                        </div>
                                        <div class="d-flex justify-content-between px-2 list-document-effect"
                                             style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;">
                                            <div><span style="font-weight: 500;">Документація API</span></div>
                                            <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- api keys tabs -->
                                <div class="apiKeys-details">
                                    <div class="apiKeys-content-wrapper">
                                        <div
                                            class="content-header d-flex align-items-center justify-content-between mx-2"
                                            style="height: 85px;">
                                            <div class="d-flex align-items-center ">
                                                <div id="back-to-api-details" style="cursor: pointer;">
                                                    <i data-feather='arrow-left' class="mx-1"
                                                       style="transform: scale(1.5);"></i>
                                                </div>
                                                <h4 class="mb-0">API ключі</h4>
                                            </div>
                                            <button type="button" id="create-newApiKey-wrapper"
                                                    class="btn btn-flat-primary waves-effect">Створити новий API ключ
                                            </button>
                                        </div>
                                        <div
                                            class="d-flex justify-content-between px-2 list-document-effect  btn-open-done-apiKeys"
                                            style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;">
                                            <div><span style="font-weight: 500;">Untitled API Key (2023-04-11
                                                10:31:46)</span></div>
                                            <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                        </div>
                                        <div
                                            class="d-flex justify-content-between px-2 list-document-effect  btn-open-done-apiKeys "
                                            style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;">
                                            <div><span сlass="textNameKey" style="font-weight: 500;">Для Jira</span>
                                            </div>
                                            <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                        </div>
                                        <div
                                            class="d-flex justify-content-between px-2 list-document-effect  btn-open-done-apiKeys "
                                            style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;">
                                            <div><span сlass="textNameKey"
                                                       style="font-weight: 500;">Для West Group</span>
                                            </div>
                                            <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                        </div>
                                        <div
                                            class="d-flex justify-content-between px-2 list-document-effect  btn-open-done-apiKeys "
                                            style="border-top: 1px solid rgba(75, 70, 92, 0.1); padding: 18px 0;">
                                            <div><span сlass="textNameKey" style="font-weight: 500;">Для Consolid</span>
                                            </div>
                                            <div><img src="{{asset('assets/icons/fill-arrow-right.svg')}}"></div>
                                        </div>

                                    </div>
                                </div>

                                <!-- create new api key -->
                                <div class="create-newApiKey">
                                    <div class="create-newApiKey-content-wrapper">

                                        <div class="" style="border-bottom: 1px solid rgba(75, 70, 92, 0.1);">
                                            <div
                                                class="content-header d-flex align-items-center justify-content-between mx-2"
                                                style="height: 85px;">
                                                <div class="d-flex align-items-center ">
                                                    <div id="back-to-apiKeys-details" style="cursor: pointer;">
                                                        <i data-feather='arrow-left' class="mx-1"
                                                           style="transform: scale(1.5);"></i>
                                                    </div>
                                                    <h4 class="mb-0 create-newApiKey__title ">Новий API ключ</h4>
                                                    <h4 class="mb-0 edit-newApiKey__title ">API ключ</h4>
                                                </div>
                                                <button type="button" class="btn btn-primary  btn-create-newApiKeys">
                                                    Створити
                                                </button>
                                                <div id='btns-change-apiKey'>
                                                    <div class="d-flex gap-1 ">
                                                        <button type="button"
                                                                class="btn btn-flat-danger  btn-remove-newApiKeys">
                                                            Видалити
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-primary  btn-edit-newApiKeys">Зберегти
                                                            зміни
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-0">
                                            <div class="px-2 pb-2 pt-0">

                                                <!-- інпути   з алертоми -->

                                                <div class="mb-2">
                                                    <label class="form-label " for="basicInput">Назва ключа</label>
                                                    <input type="text" class="form-control mb-1 input-name-apiKeys"
                                                           id="basicInput" value="" placeholder=""/>


                                                    <!-- інпут з генерованим ключем -->
                                                    <div id="edit-newApiKey__input">
                                                        <div class="d-flex align-items-end  mb-2 ">
                                                            <div class=" w-100 pe-1 ">
                                                                <div class=" ">
                                                                    <label class="form-label"
                                                                           for="copy-to-clipboard-input">Api
                                                                        ключ</label>
                                                                    <input type="text" class="form-control  "
                                                                           id="copy-to-clipboard-input"
                                                                           value="P1appBhmZ2XgqVDvm4MBKsoC"/>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <button class="btn btn-outline-primary " id="btn-copy">
                                                                    Копіювати
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- alerts -->
                                                    <div class="p-1 rounded create-newApiKey-alert"
                                                         style="background-color:#F1F1F2">Задайте таку
                                                        назву, щоб було зрозуміло <span class="fw-medium-c ">для чого буде
                                                        використовуватись цей API ключ</span></div>

                                                    <div class="p-1 rounded edit-newApiKey-alert "
                                                         style="background-color:#DDF6E8">
                                                    <span class="fw-medium-c " style="color:#28C76F">API ключ успішно
                                                        створено</span>
                                                    </div>
                                                </div>

                                                <h6 class="mb-2">Налаштування доступу</h6>

                                                <!-- таблиця -->
                                                <div class="table-responsive mb-2">
                                                    <table class="table  text-center ">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-start  ps-0 bg-white  text-light-c">Сутності
                                                            </th>
                                                            <th class="bg-white text-light-c">Перегляд</th>
                                                            <th class="bg-white text-light-c">Редагування</th>
                                                            <th class="bg-white text-light-c">Створення</th>
                                                            <th class="bg-white text-light-c">Видалення</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td class="text-start  ps-0">Користувачі</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck1" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck2"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start  ps-0">Компанії</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck4"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck5" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck6" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start  ps-0">Склади</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck7" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck8" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck9" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start  ps-0">Номенклатура</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck10"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck11" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck12"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3"/>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="text-start  ps-0">Логи</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck1" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck2"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3" checked/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start  ps-0">Реєстри</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck4"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck5" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck6" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start  ps-0">Документи</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck7" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck8" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck9" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3" checked/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start  ps-0">Транспортне планування</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck10"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck11" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck12"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3" checked/>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="text-start  ps-0">Транспорт</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck7" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck8" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck9" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start  ps-0">Додаткове обладнення</td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck10"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck11" checked/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck12"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="defaultCheck3"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- API End -->

                                <!-- Workspace content end -->
                            </div>

                            <div class="modal text-start" id="modal_vchasno" tabindex="-1"
                                 aria-labelledby="myModalLabel6" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                                    <div class="modal-content">
                                        <div class="card popup-card p-2">
                                            <h3 class="fw-bolder text-center mt-1">
                                                Підлючити інтеграцію з Вчасно
                                            </h3>
                                            <div class="card-body row mx-0 p-0">

                                                <p class="my-2 p-0 text-center fs-5"> Введіть логін та пароль від
                                                    кабінету EDIN щоб
                                                    підключити інтеграцію
                                                </p>


                                                <div class="col-12  mb-1">
                                                    <label class="form-label"
                                                           for="accountVchasnoLogin">Логін</label>
                                                    <input type="text" class="form-control" id="accountVchasnoLogin"
                                                           name="accountVchasnoLogin" required
                                                           placeholder="Введіть логін"
                                                           data-msg="Please enter login">
                                                </div>

                                                <div class="col-12 mb-1">
                                                    <label class="form-label"
                                                           for="accountVchasnoPass">Пароль</label>
                                                    <input type="text" class="form-control" id="accountVchasnoPass"
                                                           name="accountVchasnoPass" required
                                                           placeholder="Введіть пароль"
                                                           data-msg="Please enter pass">
                                                </div>


                                                <div class="col-12">
                                                    <div class="d-flex float-end">
                                                        <button type="button" class="btn btn-link cancel-btn"
                                                                data-dismiss="modal">Скасувати
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-primary toast-basic-toggler">
                                                            Підключити
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        const workspace = {!! json_encode($workspace) !!};
    </script>

    <script>
        $('.toast-basic-toggler').on('click', function () {
            $('.modal').modal('hide')
        });
    </script>

    <script>$('.cancel-btn').on('click', function () {
            $('.modal').modal('hide')
        });</script>

    <script src="{{asset('assets/js/entity/workspace/create-workspace.js')}}"></script>
    <script src="{{asset('assets/js/entity/workspace/workspace-settings.js')}}"></script>
    <script src="{{asset('js/scripts/components/components-bs-toast.js')}}"></script>
    <script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
@endsection
