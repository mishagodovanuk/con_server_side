@extends('layouts.admin')
@section('title','')
@section('page-style')
@endsection
@section('content')

    <div class="card mx-2">
        <div class="card-header">
            <h4 class="card-title">Особисті дані</h4>
        </div>
        <div class="card-body my-25">
            <!-- header section -->

            <div class="d-flex">
                <a href="#" class="me-25">
                    <img src="{{$company->img_type? asset('uploads/company/image/'.$company->id.'.'.$company->img_type)
                : asset('assets/icons/empty-company.svg')}}" id="company-upload-img1"
                         class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">
                </a>
                <!-- upload and reset button -->
                <div class="d-flex align-items-end mb-1 ms-1">
                    <div>
                        <label for="company-upload1"
                               class="btn btn-sm btn-green mb-75 me-75 waves-effect waves-float waves-light">Завантажити</label>
                        <input type="file" id="company-upload1" name="avatar" hidden=""
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

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="accountFirstName">Ім’я</label>
                        <input type="text" class="form-control" value="{{$company->company->first_name}}"
                               id="first_name" name="name" required placeholder="Вкажіть ім’я"
                               data-msg="Please enter first name">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="accountLastName">Прізвище</label>
                        <input type="text" class="form-control" value="{{$company->company->surname}}" id="last_name"
                               name="surname" placeholder="Вкажіть прізвище" required data-msg="Please enter last name">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="accountPatronymic">По батькові</label>
                        <input type="text" class="form-control" value="{{$company->company->patronymic}}"
                               id="patronymic" name="patronymic" required placeholder="Вкажіть ім’я по батькові"
                               data-msg="Please enter patronymic">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="fp-default">ІПН</label>

                        <input type="text" class="form-control" required id="ipn" value="{{$company->ipn}}" name="ipn"
                               placeholder="0000000000">
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="accountEmail">Емейл</label>
                        <input type="email" class="form-control" value="{{$company->email}}" id="email" name="email"
                               required placeholder="example@gmail.com">
                    </div>

                    <div id="private-data-message"></div>

                </div>
            </div>
            <!--/ form -->
        </div>
    </div>
    <div class="card mx-2 mt-3">
        <div class="card-header">
            <h4 class="card-title">Адреса</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 mb-1">
                    <div class="mb-1">
                        <label class="form-label" for="select2-hide-search">Країна</label>
                        <select class="select2 form-select" id="country" data-placeholder="Виберіть країну">
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
                        <select class="select2 form-select" id="city" id="select2-hide-search"
                                data-placeholder="Виберіть населений пункт">
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
                        <label class="form-label" for="select2-hide-search">Вулиця/Проспект</label>
                        <select class="select2 form-select" id="street" id="select2-hide-search"
                                data-placeholder="Виберіть вулицю/ проспект">
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
                           id="building_number" name="building_number" required autocomplete="off"
                           placeholder="Вкажіть номер будинку">
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="code">Квартира</label>
                    <input type="text" class="form-control" value="{{$company->address->apartment_number}}" id="flat"
                           name="flat" required autocomplete="off" placeholder="Вкажіть номер квартири">
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="code">GLN</label>
                    <input type="text" class="form-control" id="gln" name="gln" value="{{$company->address->gln}}"
                           required autocomplete="off" placeholder="0000000000000">
                </div>

                <div id="address-message"></div>
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
                    <label class="form-label" for="bank">Банк</label>
                    <input type="text" class="form-control" value="{{$company->bank}}" id="bank"
                           placeholder="Вкажіть назву банка" required>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="iban">IBAN</label>
                    <input type="text" class="form-control" value="{{$company->iban}}" id="iban"
                           placeholder="UA000000000000000000000000000" required>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="mfo">МФО</label>
                    <input type="text" class="form-control" value="{{$company->mfo}}" id="mfo" required
                           placeholder="000000">
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <div class="mb-1">
                        <label class="form-label"
                               for="select2-hide-search">Валюта</label>
                        <select class="select2 form-select" id="сurrency"
                                data-placeholder="Виберіть валюту">
                            <option value=""></option>
                            <option value="UAH" {{$company->currency === 'UAH' ? 'selected' : ''}}>UAN</option>
                            <option value="USD" {{$company->currency === 'USD' ? 'selected' : ''}}>USD</option>
                            <option value="EUR" {{$company->currency === 'EUR' ? 'selected' : ''}}>EUR</option>
                            <option value="ZLT" {{$company->currency === 'ZLT' ? 'selected' : ''}}>ZLT</option>
                        </select>
                    </div>
                </div>

                <div id="requisite-message"></div>
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
                    <textarea class="form-control" id="about" rows="5"
                              placeholder="Напишіть короткий опис про компанію">{{$company->about}}</textarea>
                </div>

                <div id="about-message"></div>
            </div>
        </div>
    </div>

    <button id="edit" type="button" data-id="{{$company->id}}"
            class="btn btn-green ms-2 mb-5 waves-effect waves-float waves-light">
        Зберегти
    </button>

@endsection
@section('page-script')
    <script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/company.js')}}"></script>

    <script>
        let company_id = {
        !!$company - > id
        !!
        }
    </script>
@endsection
