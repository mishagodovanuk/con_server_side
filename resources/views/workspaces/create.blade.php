@extends('layouts.empty')
@section('title','Onboarding')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/vendors.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/forms/wizard/bs-stepper.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/forms/select/select2.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/core/menu/menu-types/vertical-menu.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/form-validation.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/form-wizard.css'))}}">
@endsection

@section('content')
    <div class="container-fluid" style="padding: 38px 144px; height: 100vh">
        <section class="vertical-wizard" style="height: 100%;">
            <div class="bs-stepper vertical vertical-wizard-example" style="height: 100%">
                <div class="bs-stepper-header" style="background: rgba(217, 180, 20, 0.03);">
                    <div class="step" data-target="#workspace-name" role="tab" id="workspace-name-trigger">
                        <button type="button" class="step-trigger" style="padding-bottom: 0;">
                            <span class="bs-stepper-box"><i data-feather='monitor'
                                                            style="transform: scale(1.5);"></i></span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Робоче середовище</span>
                            <span class="bs-stepper-subtitle">Назва, аватар</span>
                        </span>
                        </button>
                    </div>
                    <div class="step" data-target="#workspace-warehouse" role="tab" id="workspace-warehouse-trigger">
                        <button type="button" class="step-trigger" style="padding-bottom: 0;">
                            <span class="bs-stepper-box"><i data-feather='home'
                                                            style="transform: scale(1.5);"></i></span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Склади</span>
                            <span class="bs-stepper-subtitle">Характеристики складів</span>
                        </span>
                        </button>
                    </div>
                    <div class="step" data-target="#workspace-employee" role="tab" id="workspace-employee-trigger">
                        <button type="button" class="step-trigger" style="padding-bottom: 0;">
                            <span class="bs-stepper-box"><i data-feather='users'
                                                            style="transform: scale(1.5);"></i></span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Працівники</span>
                            <span class="bs-stepper-subtitle">Кількість працівників</span>
                        </span>
                        </button>
                    </div>
                    <div class="step" data-target="#workspace-integration" role="tab"
                         id="workspace-integration-trigger">
                        <button type="button" class="step-trigger" style="padding-bottom: 0;">
                            <span class="bs-stepper-box"><i data-feather='tool'
                                                            style="transform: scale(1.5);"></i></span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Інтеграції</span>
                            <span class="bs-stepper-subtitle">Додаткові інструменти</span>
                        </span>
                        </button>
                    </div>
                    <div class="step" data-target="#workspace-tariff" role="tab" id="workspace-tariff-trigger">
                        <button type="button" class="step-trigger" style="padding-bottom: 0;">
                            <span class="bs-stepper-box"><i data-feather='dollar-sign'
                                                            style="transform: scale(1.5);"></i></span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Тарифний план</span>
                            <span class="bs-stepper-subtitle">Розрахунок тарифного плану</span>
                        </span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <div class="content h-100" id="workspace-name" role="tabpanel"
                         aria-labelledby="workspace-name-trigger">
                        <div class="workspace-name-wrapper h-100 d-flex flex-column justify-content-between">
                            <div class="workspace-content-wrapper">
                                <div class="content-header">
                                    <div class="content-header-icon-wrapper d-flex align-items-center mb-1">
                                        <img width="25px" class="content-header-icon"
                                             src="{{asset('assets/icons/nav-logo-consolid.svg')}}"
                                             alt="CONSOLID" style="margin-right: 5px;">
                                        <span
                                            class="content-header-icon-text fw-semibold text-center fs-5">CONSOLID</span>
                                    </div>
                                    <h2 class=" fw-bolder">Створіть робоче середовище</h2>
                                    <h5 class="fw-normal">Вкажіть назву робочого середовища і виберіть йому
                                        аватар</h5>
                                </div>
                                <div class="row">
                                    <div class="my-1">
                                        <label class="form-label" for="workspace-username">Назва</label>
                                        <input type="text" id="workspace-username" class="form-control"
                                               placeholder="Введіть назву"/>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-between">
                                    <div class="row d-flex justify-content-center">
                                        <div class="workspace-choose-avatar d-flex mt-2">
                                            <div class="workspace-default-avatar-wrapper me-2">
                                                <label for="workspace-upload"><img id="workspace-upload-image"
                                                                                   class="workspace-default-avatar"
                                                                                   src="{{asset('assets/icons/default-avatar.svg')}}"
                                                                                   alt="CONSOLID"></label>
                                                <input type="file" id="workspace-upload" name="avatar" hidden=""
                                                       accept="image/jpeg, image/png, image/gif">
                                            </div>
                                            <div class="workspace-divider me-2">
                                                <img class="workspace-vertical-divider"
                                                     src="{{asset('assets/icons/workspace-divider.svg')}}">
                                            </div>
                                            <div class="workspace-avatar-preview-wrapper me-4">
                                                <div class="workspace-avatar-preview" id="workspace-preview"></div>
                                            </div>
                                            <div class="workspace-avatars d-flex flex-column justify-content-around"
                                                 id="avatars">
                                                <div class="row">
                                                    <div data-value="#8692d0"
                                                         class="col px-0 workspace-avatar workspace-selected"
                                                         style="background-color:#8692d0;"></div>
                                                    <div data-value="#0c93a2" class="col px-0 mx-2 workspace-avatar "
                                                         style="background-color:#0c93a2;"></div>
                                                    <div data-value="#28c76f" class="col px-0 workspace-avatar"
                                                         style="background-color:#28c76f;"></div>
                                                </div>
                                                <div class="row">
                                                    <div data-value="#be9823" class="col px-0 workspace-avatar "
                                                         style="background-color:#be9823;"></div>
                                                    <div data-value="#ff9f43"
                                                         class="col px-0 mx-2 workspace-avatar"
                                                         style="background-color:#ff9f43;"></div>
                                                    <div data-value="#ea5455" class="col px-0 workspace-avatar"
                                                         style="background-color:#ea5455;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="content h-100" id="workspace-warehouse" role="tabpanel"
                         aria-labelledby="workspace-warehouse-trigger">
                        <div class="workspace-warehouse-wrapper h-100 d-flex flex-column justify-content-between">
                            <div class="workspace-content-wrapper">
                                <div class="content-header pb-1">
                                    <div class="content-header-icon-wrapper d-flex align-items-center mb-1">
                                        <img width="25px" class="content-header-icon"
                                             src="{{asset('assets/icons/nav-logo-consolid.svg')}}"
                                             alt="CONSOLID" style="margin-right: 5px;">
                                        <span
                                            class="content-header-icon-text fw-semibold text-center fs-5">CONSOLID</span>
                                    </div>
                                    <h2 class=" fw-bolder">Функціональна класифікація складів компанії</h2>
                                    <h5 class="fw-normal">Виберіть один або декілька варіантів в кожному блоці для
                                        того щоб ми змогли краще розрахувати тариф</h5>
                                </div>
                                <div class="workspace-row-wrapper">
                                    <div class="row">
                                        <div class="row-title" style="padding-bottom: 10px;">
                                            <h4 class="fw-bolder">За формою власності</h4>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                       value="unchecked" name="own">
                                                <label class="form-check-label" for="inlineCheckbox1">Власні</label>
                                            </div>
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                       value="unchecked" name="commercial">
                                                <label class="form-check-label" for="inlineCheckbox2">Комерційні</label>
                                            </div>
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                                       value="unchecked" name="rent">
                                                <label class="form-check-label" for="inlineCheckbox3">Орендовані</label>
                                            </div>
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox4"
                                                       value="unchecked" name="governmental">
                                                <label class="form-check-label" for="inlineCheckbox4">Державні і
                                                    муніципальні</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row-title" style="padding-bottom: 10px; padding-top: 20px;">
                                            <h4 class="fw-bolder">За учасниками</h4>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox5"
                                                       value="unchecked" name="warehouses-of-trading-companies">
                                                <label class="form-check-label" for="inlineCheckbox5">Склади
                                                    торговельних компаній</label>
                                            </div>
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox6"
                                                       value="unchecked" name="manufacturers'-warehouses">
                                                <label class="form-check-label" for="inlineCheckbox6">Склади
                                                    виробників</label>
                                            </div>
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox7"
                                                       value="unchecked" name="warehouses-of-3PL-operators">
                                                <label class="form-check-label" for="inlineCheckbox7">Склади
                                                    3PL-операторів</label>
                                            </div>
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox8"
                                                       value="unchecked" name="warehouses-of-freight-forwarders">
                                                <label class="form-check-label" for="inlineCheckbox8">Склади
                                                    експедиторів</label>
                                            </div>
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox9"
                                                       value="unchecked" name="warehouses-of-carriers">
                                                <label class="form-check-label" for="inlineCheckbox9">Склади
                                                    перевізників</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row-title" style="padding-bottom: 10px; padding-top: 20px;">

                                            <h4 class="fw-bolder">За галузями логістики</h4>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox10"
                                                       value="unchecked" name="supply-logistics">
                                                <label class="form-check-label" for="inlineCheckbox10">Логістика
                                                    постачання</label>
                                            </div>
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox11"
                                                       value="unchecked" name="production-logistics">
                                                <label class="form-check-label" for="inlineCheckbox11">Виробнича
                                                    логістика</label>
                                            </div>
                                            <div class="form-check form-check-inline workspace-unchecked mb-1">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox12"
                                                       value="unchecked" name="distribution-logistics">
                                                <label class="form-check-label" for="inlineCheckbox12">Розподільча
                                                    логістика</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-flat-secondary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Назад</span>
                                </button>
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="workspace-employee" class="content h-100" role="tabpanel"
                         aria-labelledby="workspace-employee-trigger">
                        <div class="workspace-employee-wrapper h-100 d-flex flex-column justify-content-between">
                            <div class="workspace-employee-content-wrapper">
                                <div class="content-header pb-1">
                                    <div class="content-header-icon-wrapper d-flex align-items-center mb-1">
                                        <img width="25px" class="content-header-icon"
                                             src="{{asset('assets/icons/nav-logo-consolid.svg')}}"
                                             alt="CONSOLID" style="margin-right: 5px;">
                                        <span
                                            class="content-header-icon-text fw-semibold text-center fs-5">CONSOLID</span>
                                    </div>
                                    <h2 class=" fw-bolder">Інформація про ваших працівників</h2>
                                    <h5 class="fw-normal">Виберіть один або декілька варіантів в кожному блоці для
                                        того щоб ми змогли краще розрахувати тариф</h5>
                                </div>
                                <div class="row">
                                    <div class="row-title" style="padding-bottom: 10px;">
                                        <h4 class="fw-bolder">На яких посадах вони працюють?</h4>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox13"
                                                   value="unchecked" name="distribution-center-manager">
                                            <label class="form-check-label" for="inlineCheckbox13">Менеджер
                                                розподільного центру</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox14"
                                                   value="unchecked" name="inventory-control-manager">
                                            <label class="form-check-label" for="inlineCheckbox14">Менеджер з контролю
                                                запасів</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox15"
                                                   value="unchecked" name="warehouse-manager">
                                            <label class="form-check-label" for="inlineCheckbox15">Завідуючий
                                                складом</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox16"
                                                   value="unchecked" name="checkpoint-guard">
                                            <label class="form-check-label" for="inlineCheckbox16">Вахтер КПП</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox17"
                                                   value="unchecked" name="storekeeper">
                                            <label class="form-check-label" for="inlineCheckbox17">Комірник</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox18"
                                                   value="unchecked" name="driver">
                                            <label class="form-check-label" for="inlineCheckbox18">Водій</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox19"
                                                   value="unchecked" name="warehouse-employee">
                                            <label class="form-check-label" for="inlineCheckbox19">Співробітник
                                                складу</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox20"
                                                   value="unchecked" name="packer">
                                            <label class="form-check-label" for="inlineCheckbox20">Пакувальник</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-flat-secondary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Назад</span>
                                </button>
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="content h-100" id="workspace-integration" role="tabpanel"
                         aria-labelledby="workspace-integration-trigger">
                        <div class="workspace-integration-wrapper h-100 d-flex flex-column justify-content-between">
                            <div class="workspace-integration-content-wrapper">
                                <div class="content-header pb-1">
                                    <div class="content-header-icon-wrapper d-flex align-items-center mb-1">
                                        <img width="25px" class="content-header-icon"
                                             src="{{asset('assets/icons/nav-logo-consolid.svg')}}"
                                             alt="CONSOLID" style="margin-right: 5px;">
                                        <span
                                            class="content-header-icon-text fw-semibold text-center fs-5">CONSOLID</span>
                                    </div>
                                    <h2 class=" fw-bolder">Інтеграції з іншими інструментами</h2>
                                    <h5 class="fw-normal">Виберіть один або декілька інструментів якими ви
                                        користуєтесь зараз або плануєте користуватися в подальшому</h5>
                                </div>
                                <div class="row">
                                    <div class="row-title" style="padding-bottom: 10px;">
                                        <h4 class="fw-bolder">Якими інструментами ви користуєтесь?</h4>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox21"
                                                   value="unchecked" name="erp">
                                            <label class="form-check-label" for="inlineCheckbox21">ERP</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox22"
                                                   value="unchecked" name="edi">
                                            <label class="form-check-label" for="inlineCheckbox22">EDI</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox23"
                                                   value="unchecked" name="tms">
                                            <label class="form-check-label" for="inlineCheckbox23">TMS</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox24"
                                                   value="unchecked" name="garp">
                                            <label class="form-check-label" for="inlineCheckbox24">GARP</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox25"
                                                   value="unchecked" name="sap">
                                            <label class="form-check-label" for="inlineCheckbox25">SAP</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox26"
                                                   value="unchecked" name="consolid">
                                            <label class="form-check-label" for="inlineCheckbox26">Consolid</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox27"
                                                   value="unchecked" name="1c">
                                            <label class="form-check-label" for="inlineCheckbox27">1C</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox28"
                                                   value="unchecked" name="jeeves">
                                            <label class="form-check-label" for="inlineCheckbox28">Jeeves</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox29"
                                                   value="unchecked" name="visma">
                                            <label class="form-check-label" for="inlineCheckbox29">Visma</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox30"
                                                   value="unchecked" name="microsoft-excel">
                                            <label class="form-check-label" for="inlineCheckbox30">Microsoft
                                                Excel</label>
                                        </div>
                                        <div class="form-check form-check-inline workspace-unchecked mb-1">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox31"
                                                   value="unchecked" name="google-sheets">
                                            <label class="form-check-label" for="inlineCheckbox31">Google Sheets</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-flat-secondary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Назад</span>
                                </button>
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="content h-100" id="workspace-tariff" role="tabpanel"
                         aria-labelledby="workspace-tariff-trigger">
                        <div class="workspace-tariff-wrapper h-100 d-flex flex-column justify-content-between">
                            <div class="workspace-tariff-content-wrapper">
                                <div class="content-header">
                                    <div class="content-header-icon-wrapper d-flex align-items-center mb-1">
                                        <img width="25px" class="content-header-icon"
                                             src="{{asset('assets/icons/nav-logo-consolid.svg')}}"
                                             alt="CONSOLID" style="margin-right: 5px;">
                                        <span
                                            class="content-header-icon-text fw-semibold text-center fs-5">CONSOLID</span>
                                    </div>
                                    <h2 class=" fw-bolder">Тарифний план</h2>
                                    <h5 class="fw-normal">Вкажіть кількісті працівників в вашій компанії і ми
                                        підберемо для вас тарифний план
                                        <img src="{{asset('assets/icons/create-type/header-accordion-icon.svg')}}"
                                             id="manual-tooltip" data-bs-toggle="tooltip"
                                             title="200 $ за користувача в місяць" data-bs-trigger="hover"></h5>

                                </div>
                                <div class="row">
                                    <div class="my-1 col-md-12">
                                        <label class="form-label" for="workspace-employee-quantity">Кількість
                                            працівників</label>
                                        <input type="text" id="workspace-employee-quantity" class="form-control"
                                               placeholder="Вкажіть кількість працівників"/>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div>
                                        <span class="total-price fw-bold    "
                                              style="font-size: 46px; color:#D9B414;"></span><span
                                            class="total-price-per-month">/місяць</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-flat-secondary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Назад</span>
                                </button>
                                <button class="btn btn-primary btn-next" id="workspace-form-next-btn">
                                    <span class="align-middle d-sm-inline-block d-none">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('page-script')
    <script src="{{asset('vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
    <script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/form-wizard.js')}}"></script>
    <script src="{{asset('js/scripts/components/components-tooltips.js')}}"></script>
    <script src="{{asset('assets/js/entity/workspace/create-workspace.js')}}"></script>
@endsection
