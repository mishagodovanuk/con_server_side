@extends('layouts.admin')
@section('title','Створення додаткового обладнання')

@section('content')
    <div id="data_tab_1" class="px-2">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between align-items-center  pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item">
                            <a class="link-secondary" href="/transport-equipment">Додаткове обладнання</a>
                        </li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Реєстрація додаткового
                            обладнання
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">

                <a class="btn btn-flat-secondary" href="{{"/transport-equipment"}}">Скасувати</a>

                <button id="save" type="button" class="btn btn-green">
                    Зберегти
                </button>
            </div>
        </div>

        <div class="card ">
            <div class="card-header">
                <h4 class="card-title fw-bolder">Основні дані про обладнання</h4>
            </div>
            <div class="card-body my-25">
                <!-- header section -->
                <div class="d-flex">
                    <a href="#" class="me-25">
                        <img src="{{asset('assets/images/additional-equipment-empty.png') }}"
                             id="additional-equipment-upload-img" class="uploadedAvatar rounded me-50"
                             alt="equipment image"
                             height="100" width="100">
                    </a>
                    <!-- upload and reset button -->
                    <div class="d-flex align-items-end mb-1 ms-1">
                        <div>
                            <label for="additional-equipment-upload"
                                   class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                            <input type="file" id="additional-equipment-upload" name="avatar" hidden=""
                                   accept="image/jpeg, image/png, image/gif">
                            <button type="submit" id="additional-equipment-reset"
                                    class="btn btn-sm btn-outline-secondary mb-75 waves-effect">Видалити
                            </button>
                            <p class="mb-0">Формати JPG, GIF або PNG</p>
                            <p class="mb-0">Розмір не більше 800kB </p>
                        </div>
                    </div>
                    <!--/ upload and reset button -->
                </div>
                <!--/ header section -->
                <div class="mt-0.5 pt-50">
                    <div class="row">

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Марка обладнання</label>
                            <select class="hide-search form-select" id="mark-equipment" data-dictionary="additional_equipment_brand"
                                    data-placeholder="Оберіть марку">
                                <option value=""></option>

                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Модель обладнання</label>
                            <select class="hide-search  form-select" id="model"
                                    disabled data-placeholder="Оберіть модель обладнання">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label">ДНЗ</label>
                            <input type="text" class="form-control upperText-normalPlaceholder" id="license_plate"
                                   required
                                   placeholder="">
{{--                            <input type="text" class="form-control upperText-normalPlaceholder" id="license_plate"--}}
{{--                                   required oninput="validateUkrainianDNZ(this,8)"--}}
{{--                                   placeholder="АА0000АА">--}}
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Тип</label>
                            <select class="hide-search form-select" id="type-equipment" data-dictionary="additional_equipment_type"
                                    data-placeholder="Оберіть тип обладнання">
                                <option value=""></option>

                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Компанія</label>
                            <select class="select2 form-select hide-search" id="company" data-dictionary="company"
                                    data-placeholder="Оберіть компанію власника">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Автомобіль за замовчуванням</label>
                            <select class="select2 form-select hide-search" id="transport"
                                    data-placeholder="Oберіть автомобіль">
                                <option value=""></option>
                                @foreach($transports as $transport)

                                    <option value="{{$transport->id}}">{{$transport->brand?->name
                                        .' '.$transport->model?->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Країна реєстрації</label>
                            <select class="select2 form-select" id="country" id="select2-hide-search" data-dictionary="country"
                                    data-placeholder="Oберіть країну реєстрації">
                                <option value=""></option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Рік випуску</label>
                            <select class="select2 form-select hide-search" id="manufacture_year"
                                    data-placeholder="Вкажіть рік випуску">
                                <option value=""></option>
                                @for($i=0;$i<=43;$i++)
                                    <option value="{{1980+$i}}">{{1980+$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div id="main-data-message"></div>

                    </div>
                </div>
                <!--/ form -->
            </div>
        </div>

        <div class="card mt-3 ">
            <div class="card-header">
                <h4 class="card-title fw-bolder">Характеристики обладнання</h4>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="select2-hide-search">Спосіб завантаження</label>
                        <select class="select2 form-select hide-search" multiple id="download_method" data-dictionary="transport_download"
                                data-placeholder="Oберіть спосіб завантаження">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="select2-hide-search">ADR</label>
                        <select class="select2 form-select hide-search" id="adr" data-dictionary="adr"
                                data-placeholder="Оберіть клас небезпечних вантажів">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Вантажопідйомність</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="carrying_capacity"
                                   placeholder="Вкажіть вантажопідйомність" oninput="maskFractionalNumbers(this,4)">
                            <span class="input-group-text">Т</span>
                        </div>

                    </div>
                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Довжина</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="length" placeholder="Вкажіть довжину кузова"
                                   oninput="maskFractionalNumbers(this,3)">
                            <span class="input-group-text">М</span>
                        </div>

                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Ширина</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="width" placeholder="Вкажіть ширину кузова"
                                   oninput="maskFractionalNumbers(this,3)">
                            <span class="input-group-text">М</span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Висота</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="height" placeholder="Вкажіть висоту кузова"
                                   oninput="maskFractionalNumbers(this,3)">
                            <span class="input-group-text">М</span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Об’єм</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="volume" placeholder="Вкажіть об‘єм кузова"
                                   oninput="maskFractionalNumbers(this,4)">
                            <span class="input-group-text">М<sup>3</sup></span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Місткість в європалетах</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="capacity_eu"
                                   placeholder="Вкажіть місткість кузова" oninput="limitInputToNumbers(this,3)">
                            <span class="input-group-text">Пал</span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-2">
                        <label class="form-label">Місткість в американських палетах</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="capacity_am"
                                   placeholder="Вкажіть місткість кузова" oninput="limitInputToNumbers(this,3)">
                            <span class="input-group-text">Пал</span>
                        </div>
                    </div>

                    <div class="col-12  mb-4">
                        <div class="form-check form-switch"><input type="checkbox" class="form-check-input"
                                                                   id="hydroboard" checked/>
                            <label class="form-check-label" for="hydroboard">Наявність гідроборту</label></div>
                    </div>
                
                </div>
                <div id="capacity-data-message"></div>
            </div>
        </div>

        <!-- <button id="save" type="button" class="btn btn-green   waves-effect waves-float waves-light mt-2 ms-2 mb-3">
        Зареєструвати
      </button> -->

    </div>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/entity/additional-equipment/additional-equipment.js')}}"></script>
    <script>
        //Fix placeholder
        //TODO Add padding for select2-selection--multiple
        $('.select-2').select2({
            minimumResultsForSearch: -1,
            placeholder: function () {
                $(this).data('placeholder');
            }
        });
        $('.select-2[multiple]').each(function () {
            $(this).next('.select2').find('textarea').attr('placeholder', $(this).data('placeholder'));
        });

        $('.select2-search--inline').css('display', 'contents');

        $('.select2-search__field').css('width', '100%');
    </script>

@endsection
