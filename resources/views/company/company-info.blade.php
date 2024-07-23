@extends('layouts.admin')
@section('title','Перегляд компанії')
@section('page-style')

@endsection
@section('before-style')

@endsection
@section('content')

    <!-- сторінка для ТОВ  -->

    <div class="row mx-0 px-2">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a class="link-secondary" href="/company">Компанії</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Перегляд компанії {{$company->type->key == 'legal' ? $company->company->name
                                           : $company->company->surname.' '.$company->company->first_name}}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">
                <div>

                    <a class="text-secondary" href="{{route('company.edit',['company'=>$company->id])}}"><i
                            data-feather='edit'
                            style="cursor: pointer; transform: scale(1.2);"></i>
                    </a>

                </div>
                <div>
                    <div class="btn-group">
                        <i data-feather='more-horizontal' id="header-dropdown" data-bs-toggle="dropdown"
                           aria-expanded="false" style="cursor: pointer; transform: scale(1.2);"></i>
                        <div class="dropdown-menu px-1" aria-labelledby="header-dropdown">
                            <a class="" href="#">
                                <div>

                                    <button class="btn text-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteEquipment">Деактивувати
                                    </button>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- тут вся інфа модал компанії -->
        <div class="col-12 card-info-padding p-0">
            <div class="card">
                <div class="card-body p-1 p-md-4 row mx-0">

                    <div
                        class="col-12 d-flex flex-row justify-content-start text-center gap-1 flex-wrap flex-md-nowrap">
                        <div class="d-flex flex-column gap-1">
                            <img src="{{ $company->img_type? '/file/uploads/company/image/'.$company->id.'.'.$company->img_type
                : asset('assets/icons/empty-company.svg') }}" id="account-upload-img" class="uploadedAvatar rounded"
                                 alt="company image" height="80" width="80">

                        </div>
                        <div class="d-flex flex-column justify-content-between justify-content-md-around">
                            <div class="d-flex align-items-center gap-1">
                                <h3 class="mb-0 fw-bolder text-start">{{$company->type->key == 'legal' ? $company->company->name
                                           : $company->company->surname.' '.$company->company->first_name}}
                                </h3>

                                <!-- статус верифікації d-none -->
                                <div class="avatar bg-light-success rounded float-start d-none ">
                                    <div class="avatar-content">
                                        <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div
                                    class="fw-bold"> {{$company->type->key == 'legal' ? 'Товариство з обмеженою відповідальністю' :'Фізична особа'}}</div>
                            </div>
                        </div>
                    </div>

                    <!-- alerts стосовно верифікацій кожен d-none -->
                    <div class="p-1 ">
                        <div class="d-none alert alert-primary alert-dismissible fade show p-0" role="alert">
                            <div class="alert-body d-flex align-items-start ">
                            <span class="badge bg-white p-50 rounded mr-1">
                                <i data-feather="clock" class="font-medium-2 text-primary"></i>
                            </span>

                                <div class="">
                                    <p class="fw-medium ">Верифікується</p>
                                    <p class="fw-light">Верифікація данних може зайняти до 3 робочих днів</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="d-none alert alert-success alert-dismissible fade show p-0" role="alert">
                            <div class="alert-body d-flex align-items-start ">
                            <span class="badge bg-white p-50 rounded mr-1">
                                <i data-feather="check" class="font-medium-2 text-success"></i>
                            </span>

                                <div class="">
                                    <p class="fw-medium ">Верифікація успішна</p>
                                    <p class="fw-light">Ваша компанія верифікована</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="d-none alert alert-danger alert-dismissible fade show p-0" role="alert">
                            <div class="alert-body d-flex align-items-start ">
                            <span class="badge bg-white p-50 rounded mr-1">
                                <i data-feather="info" class="font-medium-2 text-danger"></i>
                            </span>

                                <div class="">
                                    <p class="fw-medium ">У верифікації відхилено</p>
                                    <p class="fw-light">У верифікаціяї відмовлено. Щоб дізнатися причину натисніть <a
                                            class="text-decoration-underline text-danger" href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#rejectionVerification">сюди</a>
                                    </p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                    <hr class="mt-2 my-2">

                    <div class="col-12 p-0 mt-1 row mx-0">
                        <h5 class="fw-bolder mb-0">Основні дані</h5>
                        <div class="col-12 p-0 my-2 card-data-reverse">


                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    {{$company->type->key == 'legal' ? 'ЄДРПОУ' :'ІПН'}}
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$company->type->key == 'legal'
                                    ? (isset($company->company->edrpou) ? $company->company->edrpou : "Немає")
                                    : (isset($company->ipn) ? $company->ipn : "Немає")}}
                                </div>
                            </div>
                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Електронна адреса
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{isset($company->email) ? $company->email : 'Немає'}}
                                </div>
                            </div>
                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Категорія компанії
                                </div>
                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    @if($company->category_id === 1)
                                        Виробник
                                    @elseif($company->category_id === 2)
                                        Постачальник
                                    @elseif($company->category_id === 3)
                                        Дистрибютор
                                    @elseif($company->category_id === 4)
                                        Супермаркет
                                    @elseif($company->category_id === 5)
                                        Перевізник
                                    @elseif($company->category_id === 6)
                                        3PL - оператор
                                    @else
                                        Немає
                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>
                    @if ($company->type->key == 'legal' && $company->ipn)
                        <div class="col-12 p-0 mt-1 row mx-0">
                            <h5 class="fw-bolder mb-0">Дані платника ПДВ</h5>
                            <div class="col-12 p-0 my-2 card-data-reverse">


                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Номер ІПН
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        {{$company->ipn}}
                                    </div>
                                </div>
                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Свідоцтво реєстрації
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold d-flex align-items-center gap-1">
                                        <img src="{{asset('assets/icons/file-upload.svg')}}" alt="file-upload">
                                        <a class="link-secondary text-decoration-underline"
                                           download="{{$registerFile->name}}"
                                           href="{{'/file/uploads/company/docs/registration'.'/'.$company->company->id.'.'.$company->company->reg_doctype}}">
                                            {{$registerFile->name}}</a>
                                    </div>
                                </div>
                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Установчі документи
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold d-flex align-items-center gap-1">
                                        <img src="{{asset('assets/icons/file-upload.svg')}}" alt="file-upload">
                                        <a class="link-secondary text-decoration-underline"
                                           download="{{$installFile->name}}"
                                           href="{{'/file/uploads/company/docs/install'.'/'.$company->company->id.'.'.$company->company->install_doctype}}">
                                            {{$installFile->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-12 p-0 mt-1 row mx-0">
                        <h5 class="fw-bolder mb-0">Адреса</h5>
                        <div class="col-12 p-0 my-2 card-data-reverse">

                            @if($company->address->country?->name && $company->address->settlement?->name
                                                         && $company->address->street?->name && $company->address->building_number || $company->address->gln)
                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Фактична адреса
                                    </div>
                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        @if($company->address->country?->name && $company->address->settlement?->name
                                        && $company->address->street?->name && $company->address->building_number)
                                            {{$company->address->country->name.', м. '.$company->address->settlement->name
                                 .', '.$company->address->street->name.', б.'.$company->address->building_number.', '}}
                                            {{$company->address->apartment_number ? 'кв. '.$company->address->apartment_number : ''}}
                                        @endif

                                        <br/>
                                        @if($company->address?->gln)
                                            {{'GLN'.$company->address->gln}}
                                        @endif


                                    </div>
                                    @else
                                        <div class=" row mx-0 py-1">
                                            <div class="col-6 col-md-3 f-15">
                                                Фактична адреса
                                            </div>
                                            <div class="col-auto col-md-9 f-15 fw-bold">
                                                Немає
                                            </div>
                                        </div>
                                    @endif

                                    @if($company->type->key == "legal")
                                        @if($company->address->country?->name && $company->address->settlement?->name
                                                                    && $company->address->street?->name && $company->address->building_number || $company->address->gln)
                                            <div class="row mx-0 py-1">
                                                <div class="col-6 col-md-3 f-15">
                                                    Юридична адреса
                                                </div>

                                                <div class="col-auto col-md-9 f-15 fw-bold">
                                                    @if($company->address->country?->name && $company->address->settlement?->name
                                             && $company->address->street?->name && $company->address->building_number)
                                                        {{$company->company->address->country->name.', м. '.$company->company->address->settlement->name
                                               .', '.$company->company->address->street->name.', б.'.$company->company->address->building_number.', '}}
                                                        {{$company->company->address->apartment_number ? 'кв. '.$company->company->address->apartment_number : ''}}
                                                    @endif
                                                    <br/>
                                                    @if($company->address?->gln)
                                                        {{'GLN'.$company->company->address->gln}}
                                                    @endif
                                                </div>
                                            </div>

                                        @else
                                            <div class=" row mx-0 py-1">
                                                <div class="col-6 col-md-3 f-15">
                                                    Юридична адреса
                                                </div>
                                                <div class="col-auto col-md-9 f-15 fw-bold">
                                                    Немає
                                                </div>
                                            </div>
                                        @endif

                                    @endif
                                </div>

                        </div>
                        <div class="col-12 p-0 mt-1 row mx-0">
                            <h5 class="fw-bolder mb-0">Реквізити</h5>
                            <div class="col-12 p-0 my-2 card-data-reverse">


                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Банк
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        {{isset($company->bank) ? $company->bank : "Немає"}}
                                    </div>
                                </div>
                                <div class="row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        IBAN
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">

                                        {{$company->iban ?? "Немає"}}
                                    </div>
                                </div>
                                <div class="row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        МФО
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        {{$company->mfo ?? "Немає"}}
                                    </div>
                                </div>
                                <div class="row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Валюта
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        {{$company->currency ?? "Немає"}}
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="col-12 p-0 mt-1 row mx-0">
                            <h5 class="fw-bolder mb-0">Додатково</h5>
                            <div class="col-12 p-0 my-2 card-data-reverse">


                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Про компанію
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        {{$company->about ?? "Опис відсутній"}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- модал  відмови верифікації компанії -->

        <div class="modal fade" id="rejectionVerification" tabindex="-1" aria-labelledby="rejectionVerification"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 737px">
                <div class=" modal-content" style="padding: 67px">
                    <h2 class="text-center mb-2">Причини відхилення верифікації</h2>
                    <p class="mb-2">Будь ласка, перевірте, коректність данних нижче! Якщо дані не вірні то редагуйте
                        їх і
                        відправте заявку на верифікацію повторно. Якщо дані коректні то <a href="#"
                                                                                           class="text-secondary text-decoration-underline fw-medium-c">зв’яжіться
                            з нами</a></p>
                    <p class="mb-1 ">Тип юридичної особи: <span class="fw-medium-c ps-1">TOB</span></p>
                    <p class="mb-1 ">ЄДРПОУ: <span class="fw-medium-c ps-1">2701987</span></p>
                    <p class="mb-1 ">IBAN: <span class="fw-medium-c ps-1">UA803146880000031004141892113</span></p>
                    <p class="mb-1 ">МФО: <span class="fw-medium-c ps-1">213456</span></p>
                    <div class="mb-1 d-flex align-items-center">
                        <p class="mr-1 my-0"> Свідоцтва реєстрації:</p>
                        <div class="fw-bold d-flex align-items-center gap-1">
                            <img src="{{asset('assets/icons/file-upload.svg')}}" alt="file-upload">
                            <a class="link-secondary text-decoration-underline" download href="3">
                                file_example.pdf </a>
                        </div>
                    </div>
                    <div class="mb-1 d-flex align-items-center">
                        <p class="mr-1 my-0">Установчі документи:</p>
                        <div class="fw-bold d-flex align-items-center gap-1">
                            <img src="{{asset('assets/icons/file-upload.svg')}}" alt="file-upload">
                            <a class="link-secondary text-decoration-underline" download href="3">
                                file_example.pdf </a>
                        </div>
                    </div>


                    <div class="d-flex justify-content-end">
                        <button class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal"
                                aria-label="Close">

                            Скасувати
                        </button>
                        <a class="btn btn-primary" href="#">
                            Редагувати дані</a>
                    </div>

                </div>
            </div>
        </div>

        <!-- модал видалення обладнання -->
        <div class="modal fade" id="deleteEquipment" tabindex="-1" aria-labelledby="deleteEquipment"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 500px">
                <div class="p-2 modal-content">
                    <h4 class="mb-2">Причини відхилення верифікації</h4>
                    <p class="mb-2">Ви точно впевнені що хочете видалити це додаткове обладнання?</p>
                    <form class="d-flex justify-content-end" method="POST"
                          action="{{route('company.destroy',['company'=>$company->id])}}">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal"
                           aria-label="Close">

                            Скасувати
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Видалити
                        </button>
                    </form>

                </div>
            </div>
        </div>

@endsection
@section('page-script')

@endsection
