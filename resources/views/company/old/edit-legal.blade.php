@extends('layouts.admin')
@section('title','')
@section('page-style')
    <script src="{{asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js'))}}"></script>

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">

@endsection
@section('content')

    <div class="mx-2 card">
        <div class="card-header">
            <h4 class="card-title">Особисті дані</h4>
        </div>
        <div class="card-body my-25">
            <!-- header section -->

            <div class="d-flex">
                <a href="#" class="me-25">
                    <img src="{{$company->img_type? asset('uploads/company/image/'.$company->id.'.'.$company->img_type)
                : asset('assets/icons/empty-company.svg')}}" id="company-upload-img2"
                         class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">
                </a>
                <!-- upload and reset button -->
                <div class="d-flex align-items-end mb-1 ms-1">
                    <div>
                        <label for="company-upload2"
                               class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                        <input type="file" id="company-upload2" name="avatar" hidden=""
                               accept="image/jpeg, image/png, image/gif">
                        <button type="submit" id="update-company-reset"
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
                <div class="row">

                    <div class="col-12 col-sm-12 mb-1">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="3PLOperator" {{$company->company->three_pl ? 'selected' : ''}}>
                            <label class="form-check-label">3PL Оператор</label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="edrpou">ЄДРПОУ</label>
                        <input type="text" class="form-control" id="edrpou" name="edrpou"
                               value="{{$company->company->edrpou}}" required placeholder="0000000"
                               data-msg="Please enter first name">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="email_2">Емейл</label>
                        <input type="email" class="form-control" id="email_2" name="email" value="{{$company->email}}"
                               required data-msg="Please enter last name" placeholder="example@gmail.com">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="company_name">Назва компанії</label>
                        <input type="text" class="form-control" id="company_name" value="{{$company->company->name}}"
                               required placeholder="Вкажіть назву компанії" data-msg="Please enter patronymic">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="fp-default select2-hide-search">Вид юридичної особи</label>
                        <select class="hide-search form-select" id="legal_entity"
                                data-placeholder="Виберіть вид юридичної особи">
                            <option value=""></option>
                            @foreach($legalTypes as $type)
                                <option
                                    {{$company->company->legal_type->id === $type->id ? 'selected' : '' }} value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div id="private-data-message2"></div>

                </div>
            </div>
            <!--/ form -->
        </div>
    </div>
    <div class="mx-2 card mt-3">
        <div class="card-header">
            <h4 class="card-title">Фактична адреса</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 mb-1">
                    <div class="mb-1">
                        <label class="form-label" for="select2-hide-search">Країна</label>
                        <select class="select2 form-select" id="country_2" data-placeholder="Виберіть країну">
                            <option value=""></option>
                            @foreach($countries as $country)
                                <option
                                    {{$company->address->country->id === $country->id ? 'selected' : '' }} value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <div class="mb-1">
                        <label class="form-label" for="select2-hide-search">Населений пункт</label>
                        <select class="select2 form-select" id="city_2" data-placeholder="Виберіть населений пункт">
                            <option value=""></option>
                            @foreach($settlements as $settlement)
                                <option
                                    {{$company->address->settlement->id === $settlement->id ? 'selected' : ''  }} value="{{$settlement->id}}">{{$settlement->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <div class="mb-1">
                        <label class="form-label" for="select2-hide-search">Вулиця / Проспект</label>
                        <select class="select2 form-select" id="street_2" data-placeholder="Виберіть вулицю / проспект">
                            <option value=""></option>
                            @foreach($streets as $street)
                                <option
                                    {{$company->address->street->id === $street->id  ? 'selected' : '' }} value="{{$street->id}}">{{$street->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="code">Номер будинку</label>
                    <input type="text" class="form-control" value="{{$company->address->building_number}}"
                           id="u_building_number" name="building_number" required autocomplete="off"
                           placeholder="Вкажіть номер будинку">
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="code">Квартира</label>
                    <input type="text" class="form-control" value="{{$company->address->apartment_number}}" id="flat_2"
                           name="flat" required autocomplete="off" placeholder="Вкажіть номер квартири">
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="code">GLN</label>
                    <input type="text" class="form-control" id="gln_2" name="gln" value="{{$company->address->gln}}"
                           required autocomplete="off" placeholder="0000000000000">
                </div>

                <div id="address-message2"></div>
            </div>

        </div>

    </div>

    <div class="mx-2 card mt-3">
        <div class="card-header">
            <h4 class="card-title">Юридична Адреса</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 mb-1">
                    <div class="mb-1">
                        <label class="form-label" for="u_country select2-hide-search">Країна</label>
                        <select class="select2 form-select" id="u_country" data-placeholder="Виберіть країну">
                            <option value=""></option>
                            @foreach($countries as $country)
                                <option
                                    {{$company->company->address->country->id === $country->id  ? 'selected' : '' }} value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <div class="mb-1">
                        <label class="form-label" for="u_city select2-hide-search">Населений пункт</label>
                        <select class="select2 form-select" id="u_city" data-placeholder="Виберіть населений пункт">
                            <option value=""></option>
                            @foreach($settlements as $settlement)
                                <option
                                    {{$company->company->address->settlement->id === $settlement->id ? 'selected' : ''  }} value="{{$settlement->id}}">{{$settlement->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <div class="mb-1">
                        <label class="form-label" for="u_street select2-hide-search">Вулиця / Проспект</label>
                        <select class="select2 form-select" id="u_street" data-placeholder="Виберіть вулицю / проспект">
                            <option value=""></option>
                            @foreach($streets as $street)
                                <option
                                    {{$company->company->address->street->id === $street->id ? 'selected' : ''  }} value="{{$street->id}}">{{$street->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="u_building_number">Номер будинку</label>
                    <input type="text" class="form-control" value="{{$company->company->address->building_number}}"
                           id="building_number_2" name="building_number" required autocomplete="off"
                           placeholder="Вкажіть номер будинку">
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="code">Квартира</label>
                    <input type="text" class="form-control" value="{{$company->company->address->apartment_number}}"
                           id="u_flat" name="flat" required autocomplete="off" placeholder="Вкажіть номер квартири">
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="code">GLN</label>
                    <input type="text" class="form-control" id="u_gln" value="{{$company->company->address->gln}}"
                           name="gln" required autocomplete="off" placeholder="0000000000000">
                </div>

                <div id="u-address-message"></div>
            </div>

        </div>

    </div>

    <div class="mx-2 card mt-3">
        <div class="card-header">
            <h4 class="card-title">Реквізити</h4>
        </div>


        <div class="card-body my-25">


            <div class="row">

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="passwordEmail">Банк</label>
                    <input type="text" class="form-control" value="{{$company->bank}}" id="bank_2"
                           placeholder="Вкажіть назву банка" required>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="passwordEmail">IBAN</label>
                    <input type="text" class="form-control" value="{{$company->iban}}" id="iban_2"
                           placeholder="UA000000000000000000000000000" required>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="passwordEmail">МФО</label>
                    <input type="text" class="form-control" value="{{$company->mfo}}" placeholder="000000" id="mfo_2"
                           required>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <div class="mb-1">
                        <label class="form-label"
                               for="select2-hide-search">Валюта</label>
                        <select class="select2 form-select" id="сurrency_u"
                                data-placeholder="Виберіть валюту">
                            <option value=""></option>
                            <option value="UAH" {{$company->currency === 'UAH' ? 'selected' : ''}}>UAN</option>
                            <option value="USD" {{$company->currency === 'USD' ? 'selected' : ''}}>USD</option>
                            <option value="EUR" {{$company->currency === 'EUR' ? 'selected' : ''}}>EUR</option>
                            <option value="ZLT" {{$company->currency === 'ZLT' ? 'selected' : ''}}>ZLT</option>
                        </select>
                    </div>
                </div>

                <div id="requisite-message2"></div>
            </div>
        </div>
    </div>
    <div class="mx-2 card mt-3">
        <div class="card-header justify-content-normal">
            <h4 class="card-title">Платник ПДВ</h4>
            <input type="checkbox" {{$company->ipn ? 'checked' : ''}} class="form-check-input" id="pdv">
        </div>

        <div class="card-body my-25">

            <div class="row">

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="passwordEmail">Номер ІПН</label>
                    <input type="text" class="form-control" value="{{$company->ipn}}" id="ipn_2"
                           placeholder="000000000" {{$company->ipn ? '' : 'disabled'}}>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label for="formFileMultiple" class="form-label">Свідоцтво реєстрації</label>
                    <input class="form-control" type="file" id="reg_doc" {{$company->ipn ? '' : 'disabled'}}>
                </div>

                <div class="col-12 offset-sm-6 col-sm-6 mb-1">
                    <label for="formFileMultiple" class="form-label">Установчі документи</label>
                    <input class="form-control" type="file" id="ust_doc" {{$company->ipn ? '' : 'disabled'}}>
                </div>

                <div id="pdv-message"></div>
            </div>
        </div>
    </div>
    <div class="mx-2 card mt-3">
        <div class="card-header">
            <h4 class="card-title">Про компанію</h4>
        </div>
        <div class="card-body my-25">
            <div class="row">
                <div class="col-12 col-sm-6 mb-1">
                    <textarea class="form-control" id="about_2" rows="5"
                              placeholder="Напишіть короткий опис про компанію">{{$company->about}}</textarea>
                </div>

                <div id="about_company_message_2"></div>
            </div>
        </div>
    </div>

    <button id="edit_2" type="button" data-id="{{$company->id}}"
            class="btn btn-green ms-2 mb-5 waves-effect waves-float waves-light">
        Зберегти
    </button>

@endsection
@section('page-script')
    <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/company.js')}}"></script>

    <script>
        const fileInput = document.querySelector('#reg_doc');

        const myFile = new File([''], '{!! $company->company->name.'.
    '.$company->company->reg_doctype !!}', {
            type: 'text/plain',
            lastModified: new Date(),
        });

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(myFile);
        fileInput.files = dataTransfer.files;

        const fileInput2 = document.querySelector('#ust_doc');

        const myFile2 = new File([''], '{!! $company->company->name.'.
    '.$company->company->install_doctype !!}', {
            type: 'text/plain',
            lastModified: new Date(),
        });

        const dataTransfer2 = new DataTransfer();
        dataTransfer2.items.add(myFile2);
        fileInput2.files = dataTransfer2.files;

        let company_id = {
        !!$company - > id
        !!
        }
    </script>
@endsection