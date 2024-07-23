@extends('layouts.admin')
@section('title','')

@section('content')
    <div id="data_tab_1" class="px-2" data-id="{{$transport->id}}">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item">
                            <a class="link-secondary" href="/transport">Транспорт</a>
                        </li>
                        <li class="breadcrumb-item">

                            <a class="link-secondary"
                               href="{{"/transport/".$transport->id}}">Перегляд
                                транспорту {{$transport->brand->name.' '.$transport->model->name }}
                                ({{$transport->license_plate}}) </a>
                        </li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Редагування транспортного
                            засобу
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">
                <button data-bs-toggle="modal" id="cancel_button" data-bs-target="#cancel_edit_transport" type="submit"
                        class="btn btn-flat-secondary">
                    Скасувати
                </button>
                <button id="update" type="button" class="btn btn-green">
                    Зберегти
                </button>
            </div>

        </div>

        <div class="card mx-0">
            <div class="card-header" style="padding-left: 2rem; padding-right: 2rem">
                <h4 class="card-title fw-bolder">Характеристика ТЗ</h4>
            </div>
            <div class="card-body my-25 px-1">
                <!-- header section -->

                <div class="d-flex px-1">
                    <a href="#" class="me-25">
                        <img
                            src="{{ $transport->img_type ? '/file/uploads/transport/'.$transport->id.'.'.$transport->img_type : asset('assets/images/transport-empty.png') }}"
                            id="transport-upload-img"
                            class="uploadedAvatar rounded me-50" alt="transport image" height="100" width="100">
                    </a>
                    <!-- upload and reset button -->
                    <div class="d-flex align-items-end mb-1 ms-1">
                        <div>
                            <label for="transport-upload"
                                   class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                            <input type="file" id="transport-upload" name="transport_img" hidden=""
                                   accept="image/jpeg, image/png, image/gif">
                            <button type="submit" id="update-transport-reset"
                                    class="btn btn-sm btn-outline-secondary mb-75 waves-effect">Видалити
                            </button>
                            <p class="mb-0">Формати JPG, GIF або PNG</p>
                            <p class="mb-0">Розмір не більше 800kB </p>
                        </div>
                    </div>
                    <!--/ upload and reset button -->
                </div>
                <!--/ header section -->
                <div class="mt-2 pt-50">
                    <div class="row mx-0">

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Марка авто</label>
                            <select class="hide-search form-select" id="mark" data-id="{{$transport->brand_id}}" data-dictionary="transport_brand"
                                    data-placeholder="Виберіть марку авто">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Модель авто</label>
                            <select class="hide-search form-select" id="model" id="select2-hide-search"
                                    data-placeholder="Виберіть модель авто">
                                <option value=""></option>

                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label">ДНЗ</label>
                            <input type="text" class="form-control" style="text-transform: uppercase" id="license_plate"
                                   required placeholder="" value="{{$transport->license_plate}}"
                                   data-msg="Please enter patronymic">
{{--                            <input type="text" class="form-control" style="text-transform: uppercase" id="license_plate"--}}
{{--                                   required placeholder="АА0000АА" value="{{$transport->license_plate}}"--}}
{{--                                   data-msg="Please enter patronymic" oninput="validateUkrainianDNZ(this,8)">--}}
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Країна реєстрації</label>
                            <select class="select2 form-select" data-id="{{$transport->registration_country_id}}" data-dictionary="country"
                                    id="country"
                                    data-placeholder="Виберіть країну реєстрації">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Тип</label>
                            <select class="hide-search form-select" id="type" data-id="{{$transport->type_id}}" data-dictionary="transport_type"
                                    data-placeholder="Виберіть тип авто">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Категорія</label>
                            <select class="hide-search form-select" id="category" id="select2-hide-search"
                          data-placeholder="Виберіть категорію транспорту">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{$transport->category_id===$category->id ? 'selected' :''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="additional_equipment">Виберіть обладнання за
                                замовчуванням</label>
                            <select class="select2 form-select" id="additional_equipment"
                                    data-placeholder="Виберіть обладнання за замовчуванням">
                                <option value=""></option>
                                @foreach($additionalEquipments as $equipment)
                                    <option
                                        value="{{$equipment->id}}" {{$transport->equipment_id===$equipment->id ? 'selected' :''}}>{{$equipment->brand->name
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
                                    <option
                                        value="{{1980+$i}}" {{$transport->manufacture_year===1980+$i ? 'selected' :''}}>{{1980+$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-12 ">
                            <hr>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Компанія</label>
                            <select class="select2 form-select hide-search" data-id="{{$transport->company_id}}" data-dictionary="company"
                                    id="company"
                                    data-placeholder="Виберіть компанію">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Водій за замовчуванням</label>
                            <select class="select2 form-select hide-search" id="driver" data-id="{{$transport->driver_id}}" data-dictionary="driver"
                                    data-placeholder="Виберіть водія за замовчуванням">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label">Витрати пустого</label>
                            <div class="input-group">
                                <input type="number" class="form-control"
                                       placeholder="Вкажіть витрати пального пустого авто"
                                       value="{{$transport->spending_empty}}" id="spending_empty"
                                       oninput="maskFractionalNumbers(this, 3)">
                                <span class="input-group-text">Л / 100КМ</span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label">Витрати повного</label>
                            <div class="input-group">
                                <input type="number" class="form-control"
                                       placeholder="Вкажіть витрати пального повного авто"
                                       value="{{$transport->spending_full}}" id="spending_full"
                                       oninput="maskFractionalNumbers(this, 3)">
                                <span class="input-group-text">Л / 100КМ</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            <label class="form-label">Вага</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Вага авто"
                                       value="{{$transport->weight}}" id="weight"
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

        <div class="card my-2 mx-0 card-transport-m"
             id="additional-data" {{$transport->category_id !== 2 ? "style=display:none" : ''}}>
            <div class="card-header" style="padding-right: 2rem; padding-left: 2rem">
                <h4 class="card-title fw-bolder">Характеристика кузова</h4>
            </div>

            <div class="card-body">
                <div class="row mx-0">
                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label" for="download_methods">Спосіб завантаження</label>
                        <select class="select2 form-select" data-dictionary="transport_download" data-id='@json($transport->download_methods)'
                                data-placeholder="Виберіть спосіб завантаження"
                                multiple="multiple" id="download_methods">
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label" for="select2-hide-search">ADR</label>
                        <select class="select2 form-select hide-search" data-id="{{$transport->adr_id}}" data-dictionary="adr" id="adr"
                                data-placeholder="Вкажіть клас небезпечних вантажів">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Вантажопідйомність</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Вкажіть вантажопідйомність"
                                   id="carrying_capacity" value="{{$transport->carrying_capacity}}">
                            <span class="input-group-text">Т</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Довжина</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Вкажіть довжину кузова" id="length"
                                   value="{{$transport->length}}">
                            <span class="input-group-text">М</span>
                        </div>

                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Ширина</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Вкажіть ширину кузова"
                                   value="{{$transport->width}}" id="width">
                            <span class="input-group-text">М</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Висота</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Вкажіть висоту кузова"
                                   value="{{$transport->height}}" id="height">
                            <span class="input-group-text">М</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Об’єм</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Вкажіть об’єм кузова"
                                   value="{{$transport->volume}}" id="volume">
                            <span class="input-group-text">М<sup>3</sup></span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Місткість в європалетах</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Вкажіть місткість кузова"
                                   value="{{$transport->capacity_eu}}" id="capacity_eu">
                            <span class="input-group-text">Пал</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1">
                        <label class="form-label">Місткість в американських палетах</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Вкажіть місткість кузова"
                                   value="{{$transport->capacity_am}}" id="capacity_am">
                            <span class="input-group-text">Пал</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-1 d-flex align-items-center">
                        <div class=" d-flex flex-row align-items-center justify-content-between gap-1 mt-2">
                            <div class="form-check form-check-warning form-switch">
                                <input type="checkbox" class="form-check-input checkbox"
                                       checked="{{$transport->hydroboard}}" id="hydroboard"/>
                            </div>
                            <label class="form-check-label f-15" for="hydroboard">Наявність гідроборту</label>

                        </div>
                    </div>

                    <div id="capacity-data-message"></div>

                </div>

            </div>
        </div>

        <div class="modal text-start" id="cancel_edit_transport" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder">
                            Скасувати редагування транспорту
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Ви точно впевнені що хочете вийти з редагування? <br> Внесені
                                зміни не
                                збережуться.
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-link cancel-btn"
                                            data-dismiss="modal">Скасувати
                                    </button>
                                    <a class="btn btn-primary"
                                       href="{{"/transport/".$transport->id}}">Підтвердити</a>
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

    <script src="{{asset('assets/js/entity/transport/transport.js')}}"></script>
@endsection
