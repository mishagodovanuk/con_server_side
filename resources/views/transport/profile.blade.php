@extends('layouts.admin')
@section('title','')

@section('content')
    <div class="row mx-0 px-2">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item">
                            <a class="link-secondary" href="/transport">Транспорт</a>
                        </li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Перегляд
                            транспорту {{$transport->brand->name.' '.$transport->model->name }}
                            ({{$transport->license_plate}})
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">
                <div>
                    <a class="text-secondary" href="{{route('transport.edit',['transport'=>$transport->id])}}"><i
                            data-feather='edit'
                            style="cursor: pointer; transform: scale(1.2);"></i>
                    </a>

                </div>
                <div>
                    <div class="btn-group">
                        <i data-feather='more-horizontal' id="header-dropdown" data-bs-toggle="dropdown"
                           aria-expanded="false" style="cursor: pointer; transform: scale(1.2);"></i>
                        <div class="dropdown-menu px-1" aria-labelledby="header-dropdown">
                            <button data-bs-toggle="modal" id="cancel_button" data-bs-target="#delete_transport"
                                    type="submit"
                                    class="btn btn-flat-danger">
                                Видалити
                            </button>

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

                            <img src="{{ $transport->img_type ? '/file/uploads/transport/'.$transport->id.'.'.$transport->img_type
                                            : asset('assets/icons/truck-empty.svg') }}" id="account-upload-img"
                                 class="uploadedAvatar rounded" alt="profile image" height="80"
                                 width="80">
                        </div>
                        <div class="d-flex flex-column justify-content-md-around gap-1">
                            <div class="d-flex align-items-center gap-1">
                                <h3
                                    class="mb-0 fw-bolder text-start">   {{$transport->brand->name}}  {{$transport->model->name}}
                                </h3>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="fw-bold"> {{$transport->license_plate ?? 'Немає'}}</div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-3 my-2">

                    <div class="col-12 p-0 mt-1 row mx-0">
                        <h5 class="fw-bolder mb-0">Характеристика ТЗ</h5>
                        <div class="col-12 p-0 my-2 card-data-reverse">

                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Країна реєстрації
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    Україна
                                </div>
                            </div>

                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Тип
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transport->type->name}}
                                </div>
                            </div>

                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Категорія
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transport->category->name ?? "Немає"}}
                                </div>
                            </div>

                            @if($transport->equipment_id)
                                <div class="row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Обладнання
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        <a class="text-reset text-decoration-none text-gold"
                                           href="{{route('transport-equipment.show',['transport_equipment'=>$transport->equipment_id])}}">
                                            {{$transport->equipment->brand->name.' '.$transport->equipment->model->name.' ('.$transport->equipment->license_plate.')'}}</a>
                                    </div>
                                </div>
                            @endif


                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Рік випуску
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transport->manufacture_year}}
                                </div>
                            </div>


                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Компанія
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    <a class="text-reset text-decoration-none text-gold"
                                       href="{{route('company.show',['company'=>$transport->company_id])}}">
                                        {{$transport->company->type->key == 'legal' ? $transport->company->company->name
                                           : $transport->company->company->surname.' '.$transport->company->company->first_name}}
                                    </a>
                                </div>
                            </div>

                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Водій
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    <a class="text-reset text-decoration-none text-gold"
                                       href="{{route('user.show',['user'=>$transport->driver_id])}}">
                                        {{$transport->driver->surname.' '.$transport->driver->name.' '.$transport->driver->patronymic ?? 'Немає'}}
                                    </a>
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Витрати пустого:
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transport->spending_empty}} л/100 км
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Витрати повного
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transport->spending_full}} л/100 км
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Вага
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$transport->weight}} кг
                                </div>
                            </div>

                        </div>
                        @if($transport->category_id ==2)
                            <h5 class="fw-bolder mb-0">Характеристика кузова</h5>

                            <div class="col-12 p-0 my-2 card-data-reverse">


                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Спосіб завантаження
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        @if($transport->download_methods)
                                            @foreach(json_decode($transport->download_methods) as $key=>$method)
                                                {{count(json_decode($transport->download_methods))-1==$key
                                                ? $transport->getDownloadMethodById($method)->name
                                                :$transport->getDownloadMethodById($method)->name.', '}}
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                @if($transport->adr)
                                    <div class=" row mx-0 py-1">
                                        <div class="col-6 col-md-3 f-15">
                                            ADR:
                                        </div>

                                        <div class="col-auto col-md-9 f-15 fw-bold">
                                            {{$transport->adr->name}} клас
                                        </div>
                                    </div>
                                @endif

                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Вантажопідйомність
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        {{$transport->carrying_capacity}} т
                                    </div>
                                </div>

                                @if($transport->length)
                                    <div class=" row mx-0 py-1">
                                        <div class="col-6 col-md-3 f-15">
                                            Довжина:
                                        </div>

                                        <div class="col-auto col-md-9 f-15 fw-bold">
                                            {{$transport->length}} м
                                        </div>
                                    </div>

                                    <div class=" row mx-0 py-1">
                                        <div class="col-6 col-md-3 f-15">
                                            Ширина:
                                        </div>

                                        <div class="col-auto col-md-9 f-15 fw-bold">
                                            {{$transport->width}} м
                                        </div>
                                    </div>

                                    <div class=" row mx-0 py-1">
                                        <div class="col-6 col-md-3 f-15">
                                            Висота:
                                        </div>

                                        <div class="col-auto col-md-9 f-15 fw-bold">
                                            {{$transport->height}} м
                                        </div>
                                    </div>

                                    <div class=" row mx-0 py-1">
                                        <div class="col-6 col-md-3 f-15">
                                            Об’єм:
                                        </div>

                                        <div class="col-auto col-md-9 f-15 fw-bold">
                                            {{$transport->volume}} м<sup>3</sup>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-none"></div>
                                @endif

                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Місткість
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold d-flex flex-column flex-md-row">
                                        <div class="pe-1">
                                            {{$transport->capacity_eu}} Європалет,
                                        </div>
                                        <div>
                                            {{$transport->capacity_am}} Американські
                                            палети
                                        </div>

                                    </div>
                                </div>

                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Гідроборт
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        @if ($transport->hydroboard)
                                            Присутній
                                        @else
                                            Відсутній
                                        @endif
                                    </div>
                                </div>


                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <div class="modal text-start" id="delete_transport" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 500px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder">
                            Видалення транспорту
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Ви точно впевнені що хочете видалити цей транспорт?
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-link cancel-btn"
                                            data-dismiss="modal">Скасувати
                                    </button>

                                    <div>
                                        <form action="{{route('transport.destroy',['transport'=>$transport->id])}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">Видалити</button>
                                        </form>
                                    </div>

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
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <script>
        $('.cancel-btn').on('click', function () {
            $('.modal').modal('hide')

        });
    </script>
@endsection
