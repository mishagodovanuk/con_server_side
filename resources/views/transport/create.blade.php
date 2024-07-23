@extends('layouts.admin')
@section('title','')

@section('content')

    <div id="data_tab_1" class="px-2">

        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item">
                            <a class="link-secondary" href="/transport">Транспорт</a>
                        </li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Реєстрація транспортного засобу
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">

                <a class="btn btn-flat-secondary" href="{{"/transport"}}">Скасувати</a>

                <button id="save" type="button" class="btn btn-green">
                    Зберегти
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="padding-left: 2rem; padding-right: 2rem">
                <h4 class="card-title fw-bolder">Характеристика ТЗ</h4>
            </div>
            <div class="card-body my-25 px-1">
                <!-- header section -->

                <div class="d-flex px-1">
                    <a href="#" class="me-25">
                        <img src="{{asset('assets/images/transport-empty.png') }}" id="transport-upload-img"
                             class="uploadedAvatar rounded me-50" alt="transport image" height="100" width="100">
                    </a>
                    <!-- upload and reset button -->
                    <div class="d-flex align-items-end mb-1 ms-1">
                        <div>
                            <label for="transport-upload"
                                   class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                            <input type="file" id="transport-upload" name="transport_img" hidden=""
                                   accept="image/jpeg, image/png, image/gif">
                            <button type="submit" id="transport-reset"
                                    class="btn btn-sm btn-outline-secondary mb-75 waves-effect">Видалити
                            </button>
                            <p class="mb-0 text-secondary">Формати JPG, GIF або PNG</p>
                            <p class="mb-0 text-secondary">Розмір не більше 800kB </p>
                        </div>
                    </div>
                    <!--/ upload and reset button -->
                </div>
                <!--/ header section -->
                <div class="mt-2 pt-50">
                    <div class="row mx-0">

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Марка авто</label>
                            <select class="hide-search form-select" id="mark" data-dictionary="transport_brand"
                                    data-placeholder="Виберіть марку авто">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Модель авто</label>
                            <select class="hide-search form-select" id="model"
                                    disabled data-placeholder="Виберіть модель авто">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label">ДНЗ</label>
                            <input type="text" class="form-control" style="text-transform: uppercase" id="license_plate"
                                    placeholder="" data-msg="Please enter patronymic">
{{--                            <input type="text" class="form-control" style="text-transform: uppercase" id="license_plate"--}}
{{--                                   required placeholder="АА0000АА" data-msg="Please enter patronymic"--}}
{{--                                   oninput="validateUkrainianDNZ(this,8)">--}}
                        </div>


                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Країна реєстрації</label>
                            <select class="select2 form-select" id="country" data-dictionary="country"
                                    data-placeholder="Виберіть країну реєстрації">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Категорія</label>
                            <select class="hide-search form-select" id="category" data-dictionary="transport_kind"
                                    data-placeholder="Виберіть категорію транспорту">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Тип</label>
                            <select class="hide-search form-select" id="type" data-dictionary="transport_type"
                                    data-placeholder="Виберіть тип транспорту">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Виберіть обладнання за
                                замовчуванням</label>
                            <select class="select2 form-select" id="additional_equipment"
                                    data-placeholder="Виберіть обладнання за замовчуванням">
                                <option value=""></option>
                                @foreach($additionalEquipments as $equipment)
                                    <option value="{{$equipment->id}}">{{$equipment->brand->name
                                        .' '.$equipment->model->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Рік випуску</label>
                            <select class="select2 form-select hide-search" id="manufacture_year"
                                    data-placeholder="Вкажіть рік випуску">
                                <option value=""></option>
                                @for($i=0;$i<=43;$i++)
                                    <option value="{{1980+$i}}">{{1980+$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-12 ">
                            <hr>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Компанія</label>
                            <select class="select2 form-select" id="company" data-dictionary="company"
                                    data-placeholder="Виберіть компанію">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Водій за замовчуванням</label>
                            <select class="select2 form-select hide-search" id="driver" data-dictionary="driver"
                                    data-placeholder="Виберіть водія за замовчуванням">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label">Витрати пустого</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       placeholder="Вкажіть витрати пального пустого авто" id="spending_empty"
                                       oninput="maskFractionalNumbers(this, 3)">
                                <span class="input-group-text">Л / 100КМ</span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label">Витрати повного</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       placeholder="Вкажіть витрати пального повного авто" id="spending_full"
                                       oninput="maskFractionalNumbers(this, 3)">
                                <span class="input-group-text">Л / 100КМ</span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label">Вага</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Вага авто" id="weight"
                                       oninput="maskFractionalNumbers(this, 6)">
                                <span class="input-group-text">Кг</span>
                            </div>
                        </div>

                        <div id="main-data-message"></div>

                    </div>
                </div>
                <!--/ form -->
            </div>
        </div>

        <div class="card my-2 mx-0 card-transport-m" id="additional-data" style="display: none">
            <div class="card-header" style="padding-left: 2rem; padding-right: 2rem">
                <h4 class="card-title fw-bolder">Характеристика кузова</h4>
            </div>
            <div class="card-body px-1">
                <div class="row mx-0">

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Спосіб завантаження</label>
                        <select class="select2 form-select select2-multiple" id="download_methods" data-dictionary="transport_download"
                                data-placeholder="Виберіть спосіб завантаження" multiple>
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label" for="select2-hide-search">ADR</label>
                        <select class="select2 form-select hide-search" id="adr" data-dictionary="adr"
                                data-placeholder="Вкажіть клас небезпечних вантажів">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Вантажопідйомність</label>
                        <div class="input-group">
                            <input oninput="maskFractionalNumbers(this,4)" type="text" class="form-control"
                                   placeholder="Вкажіть вантажопідйомність"
                                   id="carrying_capacity">
                            <span class="input-group-text">Т</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Довжина</label>
                        <div class="input-group">
                            <input oninput="maskFractionalNumbers(this,3)" type="text" class="form-control"
                                   placeholder="Вкажіть довжину кузова" id="length">
                            <span class="input-group-text">М</span>
                        </div>

                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Ширина</label>
                        <div class="input-group">
                            <input oninput="maskFractionalNumbers(this,3)" type="text" class="form-control"
                                   placeholder="Вкажіть ширину кузова" id="width">
                            <span class="input-group-text">М</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Висота</label>
                        <div class="input-group">
                            <input oninput="maskFractionalNumbers(this,3)" type="text" class="form-control"
                                   placeholder="Вкажіть висоту кузова" id="height">
                            <span class="input-group-text">М</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Об’єм</label>
                        <div class="input-group">
                            <input oninput="maskFractionalNumbers(this,4)" type="text" class="form-control"
                                   placeholder="Вкажіть об’єм кузова" id="volume">
                            <span class="input-group-text">М<sup>3</sup></span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Місткість в європалетах</label>
                        <div class="input-group">
                            <input oninput="limitInputToNumbers(this,3)" type="text" class="form-control"
                                   placeholder="Вкажіть місткість кузова"
                                   id="capacity_eu">
                            <span class="input-group-text">Пал</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Місткість в американських палетах</label>
                        <div class="input-group">
                            <input oninput="limitInputToNumbers(this,3)" type="text" class="form-control"
                                   placeholder="Вкажіть місткість кузова"
                                   id="capacity_am">
                            <span class="input-group-text">Пал</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1 d-flex align-items-center">
                        <div class=" d-flex flex-row align-items-center justify-content-between gap-1 mt-2">
                            <div class="form-check form-check-warning form-switch">
                                <input type="checkbox" class="form-check-input checkbox"
                                       id="hydroboard"/>
                            </div>
                            <label class="form-check-label f-15" for="hydroboard">Наявність гідроборту</label>

                        </div>
                    </div>

                    <div id="capacity-data-message"></div>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script src="{{asset('assets/js/entity/transport/transport.js')}}"></script>

@endsection
