@extends('layouts.admin')
@section('title','Редагування')

@section('content')
    <div id="data_tab_1" class="px-2">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item">
                            <a class="link-secondary" href="/transport-equipment">Додаткове обладнання</a>
                        </li>
                        <li class="breadcrumb-item">

                            <a class="link-secondary"
                               href="{{"/transport-equipment/".$transportEquipment->id}}">Перегляд
                                {{$transportEquipment->brand->name}}
                            </a>
                        </li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Редагування додаткового
                            обладнання
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">

                <a class="btn btn-flat-secondary" href="{{"/transport-equipment"}}" data-bs-toggle="modal"
                   data-bs-target="#cancelEditPage">Скасувати</a>

                <button type="button" class="btn btn-green" id="edit" data-id="{{$transportEquipment->id}}">
                    Зберегти
                </button>
            </div>
        </div>


        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Основні дані про обладнання</h4>
            </div>
            <div class="card-body my-25">
                <!-- header section -->
                <div class="d-flex">
                    <a href="#" class="me-25">
                        <img src="{{$transportEquipment->img_type ? '/file/uploads/transport-equipment/'.$transportEquipment->id.'.'.$transportEquipment->img_type
                                            : asset('assets/icons/truck-empty.svg')}}"
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
                            <button type="submit" data-id="{{$transportEquipment->id}}" id="update-equipment-reset"
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
                            <select class="hide-search form-select" data-id="{{$transportEquipment->brand_id}}"
                                    data-dictionary="additional_equipment_brand"
                                    id="mark-equipment"
                                    data-placeholder="Виберіть марку обладнання">

                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Модель обладнання</label>
                            <select class="hide-search form-select" id="model" id="select2-hide-search"
                                    data-placeholder="Виберіть модель обладнання">
                                <option value=""></option>

                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label">ДНЗ</label>
                            {{--                            <input type="text" class="form-control" id="license_plate" required--}}
                            {{--                                   oninput="validateUkrainianDNZ(this,8)"--}}
                            {{--                                   style="text-transform: uppercase" placeholder="АА0000АА"--}}
                            {{--                                   value="{{$transportEquipment->license_plate}}">--}}
                            <input type="text" class="form-control" id="license_plate" required
                                   style="text-transform: uppercase" placeholder=""
                                   value="{{$transportEquipment->license_plate}}">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Тип</label>
                            <select class="hide-search form-select " data-id="{{$transportEquipment->type_id}}"
                                    data-dictionary="additional_equipment_type"
                                    id="type-equipment"
                                    data-placeholder="Виберіть тип обладнання">
                                <option value=""></option>
                            </select>
                        </div>


                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Компанія</label>
                            <select class="select2 form-select" id="company"
                                    data-id="{{$transportEquipment->company_id}}" data-dictionary="company"
                                    data-placeholder="Виберіть компанію">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Автомобіль за замовчуванням</label>
                            <select class="select2 form-select hide-search" id="transport"
                                    data-placeholder="Виберіть автомобіль за замовчуванням">
                                <option value=""></option>
                                @foreach($transports as $transport)
                                    <option value="{{$transport->id}}"
                                        {{$transportEquipment->transport_id===$transport->id ? 'selected' :''}}>{{$transport->brand->name
                                        .' '.$transport->model->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Країна реєстрації</label>
                            <select class="select2 form-select" data-id="{{$transportEquipment->country_id}}"
                                    data-dictionary="country"
                                    id="country"
                                    data-placeholder="Виберіть країну реєстрації">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="select2-hide-search">Рік випуску</label>
                            <select class="select2 form-select hide-search" id="manufacture_year"
                                    data-placeholder="Вкажіть рік випуску">
                                <option value=""></option>
                                @for($i=0;$i<=43;$i++)
                                    <option value="{{1980+$i}}"
                                        {{$transportEquipment->manufacture_year===1980+$i ? 'selected' :''}}>{{1980+$i}}
                                    </option>
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
                <h4 class="card-title">Характеристики обладнання</h4>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="select2-hide-search">Спосіб завантаження</label>
                        <select class="select2 form-select hide-search"
                                data-id='@json($transportEquipment->download_methods)'
                                data-dictionary="transport_download" id="download_method"
                                data-placeholder="Виберіть спосіб завантаження" multiple>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="select2-hide-search">ADR</label>
                        <select class="select2 form-select hide-search" id="adr"
                                data-id="{{$transportEquipment->adr_id}}" data-dictionary="adr"
                                data-placeholder="Вкажіть клас небезпечних вантажів">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Вантажопідйомність</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="carrying_capacity"
                                   placeholder="Вкажіть вантажопідйомність"
                                   value="{{$transportEquipment->carrying_capacity}}"
                                   oninput="maskFractionalNumbers(this,4)">
                            <span class="input-group-text">Т</span>
                        </div>

                    </div>
                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Довжина</label>
                        <div class="input-group">
                            <input type="text" value="{{$transportEquipment->length}}" class="form-control" id="length"
                                   oninput="maskFractionalNumbers(this,3)">
                            <span class="input-group-text">М</span>
                        </div>

                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Ширина</label>
                        <div class="input-group">
                            <input type="text" value="{{$transportEquipment->width}}" class="form-control" id="width"
                                   oninput="maskFractionalNumbers(this,3)">
                            <span class="input-group-text">М</span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Висота</label>
                        <div class="input-group">
                            <input type="text" value="{{$transportEquipment->height}}" class="form-control" id="height"
                                   oninput="maskFractionalNumbers(this,3)">
                            <span class="input-group-text">М</span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Об’єм</label>
                        <div class="input-group">
                            <input type="text" value="{{$transportEquipment->volume}}" class="form-control" id="volume"
                                   oninput="maskFractionalNumbers(this,4)">
                            <span class="input-group-text">М<sup>3</sup></span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Місткість в європалетах</label>
                        <div class="input-group">
                            <input type="text" value="{{$transportEquipment->capacity_eu}}" class="form-control"
                                   oninput="limitInputToNumbers(this,3)"
                                   id="capacity_eu">
                            <span class="input-group-text">пал</span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label">Місткість в американських палетах</label>
                        <div class="input-group">
                            <input type="text" value="{{$transportEquipment->capacity_am}}" class="form-control"
                                   oninput="limitInputToNumbers(this,3)"
                                   id="capacity_am">
                            <span class="input-group-text">пал</span>
                        </div>
                    </div>

                    <div class="col-12  mb-4">
                        <div class="form-check form-switch"><input type="checkbox" class="form-check-input"
                                                                   id="hydroboard"
                                {{$transportEquipment->hydroboard ? 'checked' : ''}} />
                            <label class="form-check-label" for="hydroboard">Наявність гідроборту</label>
                        </div>
                    </div>

                </div>
                <div id="capacity-data-message"></div>
            </div>
        </div>

    </div>

    <!-- модал скасування  редагування -->
    <div class="modal fade" id="cancelEditPage" tabindex="-1" aria-labelledby="cancelEditPage" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 526px">
            <div class="p-2 modal-content">
                <h4 class=" mb-2">Скасувати редагування додаткового обладнання</h4>
                <p class="mb-2">Ви точно впевнені що хочете вийти з редагування?<br>Внесені зміни не збережуться.</p>


                <div class="d-flex justify-content-end">

                    <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">

                        Скасувати
                    </a>
                    <a class="btn btn-primary" href="{{"/transport-equipment/".$transportEquipment->id}}">
                        Підтвердити</a>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script src="{{asset('assets/js/entity/additional-equipment/additional-equipment.js')}}"></script>
@endsection
