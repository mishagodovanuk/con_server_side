@extends('layouts.admin')
@section('title','Склад')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/maps/leaflet.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/maps/map-leaflet.css'))}}">
@endsection

@section('content')

    <div class="row mx-0 px-2">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a class="link-secondary" href="/warehouse">Склади</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Перегляд складу
                        </li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">
                <div>
                    <a class="text-secondary" href="{{route('warehouse.edit',['warehouse'=>$warehouse->id])}}"><i
                            data-feather='edit' style="cursor: pointer; transform: scale(1.2);"></i>
                    </a>
                </div>
                <div>
                    <div class="btn-group">
                        <i data-feather='more-horizontal' id="header-dropdown" data-bs-toggle="dropdown"
                           aria-expanded="false" style="cursor: pointer; transform: scale(1.2);"></i>
                        <div class="dropdown-menu px-1" aria-labelledby="header-dropdown">
                            <div>
                                <form method="" action="">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter">Деактивувати
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete warehouse modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Видалення складу</h5>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Ви дійсно впевнені що хочете видалити цю локацію?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Скасувати
                                </button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Видалити</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 card-info-padding p-0">
            <div class="card">
                <div class="card-body p-1 p-md-4 row mx-0">

                    <div class="col-12 d-flex flex-row justify-content-start text-center gap-1">

                        <div class="d-flex flex-column justify-content-between justify-content-md-around">
                            <div class="d-flex align-items-center gap-1">
                                <h3 class="mb-0 fw-bolder text-start">Bolero
                                </h3>

                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="fw-bold pt-1">
                                    <a href="" style="color: #4B465C;">
                                        <p style="text-decoration: underline;">{{$warehouse->company->company->name ?? $warehouse->company->company->surname.' '.
                                                   $warehouse->company->company->first_name.' '.$warehouse->company->company->patronymic}}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2">

                    <div class="col-12 p-0 mt-1 row mx-0">
                        <h5 class="fw-bolder mb-0">Основні дані</h5>
                        <div class="col-12 p-0 my-3 card-data">

                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Контактна особа
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    <a href="" style="color: #4B465C;"><span
                                            style="text-decoration: underline;">{{$warehouse->user->surname.' '.$warehouse->user->name.' '.$warehouse->user->patronymic}}</span></a>
                                    (+380666666666)
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Склад ERP
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    Склад 1, Склад 2, Склад 3
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Адреса
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$warehouse->address->street->name.' '.$warehouse->address->settlement->name}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                </div>

                                <div class="col-auto col-md-9 f-15 pe-0">
                                    <div id="map" style="height: 270px; border-radius: 6px;"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h5 class="fw-bolder mb-0">Графік роботи</h5>

                    <div class="col-12 p-0 mt-2">
                        <div class="calendar row mx-0 d-flex">
                            <h5 class="col-8 col-md-3" id="currentMonthYear"></h5>
                            <div
                                class="col-4 col-md-auto  d-flex  justify-content-end justify-content-md-start align-items-start">
                                <button class="btn p-0 button-calendar rounded-5" id="prevWeekButton"><i
                                        data-feather='chevron-left'></i>
                                </button>
                                <button class="btn p-0 button-calendar rounded-5" id="nextWeekButton"><i
                                        data-feather='chevron-right'></i>
                                </button>
                            </div>
                            <div class="col-3 mt-1 mt-md-0 col-md-auto">
                                <h5>День</h5>
                                <div class="d-flex gap-1 flex-column" id="daysColumn"></div>
                            </div>
                            <div
                                class="col-9 d-flex flex-column align-items-end align-items-md-start mt-1 mt-md-0 col-md-auto">
                                <h5>Робочий день</h5>
                                <div class="d-flex gap-1 flex-column" id="workdayColumn"></div>
                            </div>
                            <div class="col-12 mt-1 mt-md-0 col-md-auto">
                                <h5>Обід</h5>
                                <div class="d-flex gap-1 flex-column" id="dinnerColumn"></div>
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
    <script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>

    <script src="{{asset('/js/scripts/tables/table-datatables-advanced.js')}}"></script>


    <script src="{{asset('js/scripts/maps/map-leaflet.js')}}"></script>
    <script src="{{asset('vendors/js/maps/leaflet.min.js')}}"></script>
    <script src="{{asset('assets/js/utils/locationWarehouseMaps.js')}}"></script>



    <script>
        let conditions = {!! json_encode($warehouse->conditions) !!}

            let
        exceptions = {!! json_encode($exceptions) !!}

            let
        exceptionsArray = []

        for (let i = 0; i < exceptions.length; i++) {
            exceptionsArray[exceptions[i].id] = exceptions[i].name
        }

        let schedule = {!!$warehouse->schedule!!}

        // console.log(conditions, exceptions, exceptionsArray)

        @foreach($warehouse->schedule as $row)

        // Отримати значення змінної PHP і передати його в JavaScript
        var phpVariable = {!! json_encode($row) !!}

        // Використовуйте значення змінної PHP в JavaScript
        //console.log(phpVariable);

        @endforeach
    </script>

    <script src="{{asset('assets/js/utils/calendar.js')}}"></script>

@endsection
