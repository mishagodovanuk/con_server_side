@extends('layouts.admin')
@section('title','Перегляд')

@section('content')
    <div class="row mx-0 px-2">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item">
                            <a class="link-secondary" href="/transport-equipment">Додаткове обладнання</a>
                        </li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Перегляд
                            {{$transportEquipment->brand->name.' '.$transportEquipment->model->name}}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">
                <div>
                    <a class="text-secondary"
                       href="{{route('transport-equipment.edit',['transport_equipment'=>$transportEquipment->id])}}"><i
                            data-feather='edit' style="cursor: pointer; transform: scale(1.2);"></i>
                    </a>

                </div>
                <div>
                    <div class="btn-group">
                        <i data-feather='more-horizontal' id="header-dropdown" data-bs-toggle="dropdown"
                           aria-expanded="false" style="cursor: pointer; transform: scale(1.2);"></i>
                        <div class="dropdown-menu px-1" aria-labelledby="header-dropdown">
                            <a class="" href="#">
                                <div>

                                    <div>

                                        <button class="btn text-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteEquipment">Деактивувати
                                        </button>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 card-info-padding p-0">
            <div class="card">
                <div class="card-body p-1 p-md-4 row mx-0">

                    <div class="col-12 d-flex flex-row justify-content-start text-center gap-1">
                        <div class="d-flex flex-column gap-1">

                            <img src="{{ $transportEquipment->img_type ? '/file/uploads/transport-equipment/'.$transportEquipment->id.'.'.$transportEquipment->img_type
                                            : asset('assets/icons/truck-empty.svg') }}" id="account-upload-img"
                                 class="uploadedAvatar rounded" alt="profile image" height="80" width="80">
                        </div>
                        <div class="d-flex flex-column justify-content-between justify-content-md-around">
                            <div class="d-flex align-items-center gap-1">
                                <h3 class="mb-0 fw-bolder text-start"> {{$transportEquipment->brand->name}}
                                    {{$transportEquipment->model->name}}
                                </h3>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="fw-bold"> {{$transportEquipment->license_plate ?? 'Немає'}}</div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-3 my-2">

                    <div class="col-12 p-0 mt-1 row mx-0">
                        <h5 class="fw-bolder mb-0">Основні дані про обладнання</h5>
                        <div class="col-12 p-0 my-3 card-data-reverse">

                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Країна реєстрації
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->country->name}}
                                </div>
                            </div>
                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Компанія
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    <a class="text-reset text-decoration-underline text-gold"
                                       href="{{route('company.show',['company'=>$transportEquipment->company_id])}}">
                                        {{$transportEquipment->company->type->key == 'legal' ? $transportEquipment->company->company->name
                                        : $transportEquipment->company->company->surname.' '.$transportEquipment->company->company->first_name}}
                                    </a>
                                </div>
                            </div>
                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Автомобіль
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    <a class="text-reset text-decoration-underline text-gold"
                                       href="{{route('transport.show',['transport'=>$transportEquipment->transport->id])}}">
                                        {{$transportEquipment->transport->brand->name.' '.$transportEquipment->transport->model->name}}</a>
                                </div>
                            </div>

                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Рік випуску
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->manufacture_year}}
                                </div>
                            </div>


                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Тип
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->type->name}}
                                </div>
                            </div>


                        </div>

                        <h5 class="fw-bolder mb-0">Характеристика обладнання</h5>

                        <div class="col-12 p-0 my-3 card-data-reverse">

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Спосіб завантаження
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    @if($transportEquipment->download_methods)
                                        @foreach(json_decode($transportEquipment->download_methods) as $key=>$method)
                                            {{count(json_decode($transportEquipment->download_methods))-1==$key
                                            ? $transportEquipment->getDownloadMethodById($method)->name
                                            :$transportEquipment->getDownloadMethodById($method)->name.', '}}
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    ADR
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->adr->name}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Вантажопідйомність
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->carrying_capacity}} т
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Довжина
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->length}} м
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Ширина
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->width}} м
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Висота
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->height}} м
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Об’єм
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->volume}} м<sup>3</sup>
                                </div>
                            </div>
                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Місткість
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transportEquipment->capacity_eu}} Європалет, {{$transportEquipment->capacity_am}}
                                    Американські палети
                                </div>
                            </div>
                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Гідроборт
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    @if ($transportEquipment->hydroboard)
                                        Присутній
                                    @else
                                        Відсутній
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <!-- модал видалення обладнання -->
    <div class="modal fade" id="deleteEquipment" tabindex="-1" aria-labelledby="deleteEquipment" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 500px">
            <div class="p-2 modal-content">
                <h4 class="mb-2">Видалення додаткового обладнання</h4>
                <p class="mb-2">Ви точно впевнені що хочете видалити це додаткове обладнання?</p>
                <form class="d-flex justify-content-end" method="POST"
                      action="{{route('transport-equipment.destroy',['transport_equipment'=>$transportEquipment->id])}}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">

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
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <script>

    </script>
    </script>
@endsection
