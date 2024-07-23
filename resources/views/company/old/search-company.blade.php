@extends('layouts.empty')
@section('title','search company')
@section('page-style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/css/intlTelInput.css" />

@endsection
@section('before-style')

@endsection

@section('content')






<div class="container-fluid px-2">
    <!-- контейнер з навігацією  -->
    <div class="d-flex justify-content-between flex-column  flex-sm-column flex-md-row flex-lg-row flex-xxl-row">
        <div class=" pb-2 pt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-slash">
                    <li class="breadcrumb-item"><a href="#" style="color: #4B465C;">Компанії</a></li>
                    <li class="breadcrumb-item fw-bolder"><a href="#" style="color: #4B465C;">Додати компанію</a>
                    </li>

                </ol>
            </nav>
        </div>

    </div>
    <!-- = -->
    <!--  контейнер пошук компанії -->
    <div class="card p-1 pt-2 mx-auto my-auto " id="find-company" style="max-width: 916px; min-height: 675px;">

        <div class="row mx-0 h-100 justify-content-between flex-column">

            <div class="col-md-12 col-12">
                <div class="col-12 ">
                    <h2 class="mb-2">Додати компанію</h2>
                    <p class=" col-sm-12 col-lg-9 col-md-9">
                        Якщо компанія вже зареєстрована в CONSOLID введіть її назву, ЄДРПОУ, ІПН або
                        країну
                        реєстрації в пошуку та виберіть зі списку або створіть нову компанію.
                    </p>

                </div>

                <div class="col-md-12 col-12 mb-1">
                    <div class="input-group inpSelectCountry ">
                        <input id="searchCompanyInpCountry" type="text" class="form-control "
                            placeholder="Вкажіть назву, ЄДРПОУ, ІПН або країну реєстрації"
                            aria-describedby="button-addon2" />

                        <button class="btn btn-outline-primary" id="searchCompanyButton" type="button">
                            <i style="margin-right: 10px" data-feather='search'></i> Шукати
                        </button>
                    </div>
                </div>

                <div id="searchCompanyResult" class="col-12 col-sm-12 ">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 414px">

                        <div id="findCompany" class="d-flex flex-column align-items-center justify-content-center">
                            <img src="{{asset('assets/icons/onboarding-search.svg')}}">
                            <h4 class="fw-bolder">Знайдіть компанію</h4>
                            <p class="text-secondary text-center" style="max-width: 390px; opacity: 0.7!important;">
                                Введіть в пошуку назву
                                компанії, ЄДРПОУ або ІПН
                            </p>
                        </div>

                        <div id="notFoundCompany"
                            class="d-none d-flex flex-column align-items-center justify-content-center">
                            <img src="{{asset('assets/icons/onbording-search-question.svg')}}">
                            <h4 class="fw-bolder">За вашим запитом нічого не знайдено</h4>
                            <p class="text-secondary text-center" style="max-width: 390px; opacity: 0.7!important;">
                                Перевірте правильність
                                вказаних данних або
                                створіть нову компанію</p>
                        </div>

                        <button class="btn btn-primary float-end mt-1 d-none" id="create-new-company" type="button">
                            <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">
                            Створити
                            нову
                            компанію
                        </button>

                    </div>
                </div>

                <div id="listFindCompany" class="col-12 col-sm-12 d-none ">
                    <p id="countCompanyItem" class="mb-0">Найдено X результати</p>
                    <div class="d-flex flex-column" style="height: 400px; overflow-y: auto; margin-bottom: 10px;">
                        <div class="row mx-0" id="listItemCompany"></div>
                    </div>
                </div>


            </div>


            <div class="col-12 col-sm-12 d-flex justify-content-between align-items-center">
                <button class="btn btn-flat-secondary float-start d-none" id="back-to-find-company"
                    style="padding-top:10px!important ;padding-bottom:10px!important ;">
                    <img style="margin-right: 0.5rem" src="{{asset('assets/icons/arrow-left.svg')}}">
                    Назад
                </button>
                <p id="onbording-link-proposition" class="p-0 m-0 d-none"> Не знайшли свою компанію? <a
                        data-bs-toggle="modal" data-bs-target="#statusCompany" href="#">Створити нову</a> </p>
            </div>

        </div>



    </div>

    <!-- контейнер з вибраною компанією -->
    <div class="card p-1 pt-2 mx-auto my-auto  d-none chosen-company" id="send-join"
        style="max-width: 916px; height: 675px;">

        <div class="row mx-0 h-100 justify-content-between flex-column">
            <div class="">
                <div class="col-12 ">
                    <h2 class="mb-2">Додати компанію</h2>
                    <p class=" col-sm-12 col-lg-9 col-md-9">
                        Ця компанія вже знаходить в робочому средовищі. Ви можете надіслати запит на долучення до цього
                        робочого середовища.
                    </p>

                </div>
                <div class="col-12 col-sm-12 ">
                    <div class="d-flex flex-column" style="max-height: 476px; overflow-y: auto">
                        <div class="row mx-0">
                            <a class="col-12 px-0 border onboarding-item-company mt-1" style="border-radius: 6px"
                                id="request-company-card">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 d-flex justify-content-between align-items-center">
                <button class="btn btn-flat-secondary float-start" id="back-find-company-2"
                    style="padding-top:10px!important ;padding-bottom:10px!important ;">
                    <img style="margin-right: 0.5rem" src="{{asset('assets/icons/arrow-left.svg')}}">
                    Назад
                </button>
                <a class="btn btn-primary" href="{{route('company.index')}}"> <i data-feather="plus" class="mr-1"></i>
                    Додати до списку компаній</a>
            </div>

        </div>



    </div>




</div>






<!-- модал статус компанії -->
<div class="modal fade" id="statusCompany" tabindex="-1" aria-labelledby="statusCompany" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md ">
        <div class="modal-content p-3 border">


            <h2 class="text-center mb-1">Статус компанії</h2>
            <p>Для продовження оберіть, яке відношення до вас має створювана компанія</p>
            <div class="d-flex " id="statusCompanyCheckboxes">
                <div class="form-check mr-2">
                    <input class="form-check-input" type="radio" name="checkStatusCompany" id="myCompanyCheck" checked>
                    <label class="form-check-label" for="myCompanyCheck">
                        Моя компанія
                    </label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="checkStatusCompany" id="contractorCheck">
                    <label class="form-check-label" for="contractorCheck">
                        Контрагент
                    </label>
                </div>
            </div>
            <div class="rounded p-1 my-2 titlesStatus" style="background-color: #F1F1F2">
                <p class="m-0 p-0 title-1">Після створення своєї компанії, для неї необхідно буде пройти верифікацію
                </p>
                <p class="d-none m-0 p-0 title-2">При створенні контрагента ви не матимете прав адміністратора у цій
                    компанії</p>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">

                    Скасувати
                </button>
                <a class="btn btn-primary" href="{{route('company.create')}}">
                    Продовжити</a>
            </div>
        </div>
    </div>

</div>




@endsection

@section('page-script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/js/intlTelInput.min.js"></script>
<script src="{{asset('assets/js/search-company.js')}}"></script>

@endsection
