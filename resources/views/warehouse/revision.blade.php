@extends('layouts.admin')
@section('title','Склад')
@section('page-style')
@endsection
@section('before-style')
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
                            Перегляд складу {{ isset( $warehouse->name) ?  $warehouse->name : "Немає" }}
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
                                <h3 class="mb-0 fw-bolder text-start">{{$warehouse->name}}</h3>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="fw-bold pt-1">
                                    <a href="{{route('company.show',['company'=>$warehouse->company->id])}}"
                                       style="color: #4B465C;">
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
                            @if($warehouse->user)
                                <div class="row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Контактна особа
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        <a href="{{route('user.show',['user'=>$warehouse->user->id])}}"
                                           style="color: #4B465C;"><span
                                                style="text-decoration: underline;">{{$warehouse->user->surname.' '.$warehouse->user->name.' '.$warehouse->user->patronymic}}</span></a>
                                        ({{$warehouse->user->phone}})
                                    </div>
                                </div>
                            @endif

                            @if($warehouse->warehouseERP)
                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Склад ERP
                                    </div>


                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        @if(count($warehouse->warehouseERP))
                                            @foreach($warehouse->warehouseERP as $key=>$warehouseERP)
                                                {{count($warehouse->warehouseERP)-1!=$key ?
                                                 $warehouseERP->name.', ':$warehouseERP->name}}
                                            @endforeach
                                        @else
                                            Немає
                                        @endif


                                    </div>
                                </div>
                            @endif
                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Адреса
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{isset($warehouse->address->settlement->name).' '.isset($warehouse->address->street->name).' '.isset($warehouse->address->building_number) }}
                                </div>
                            </div>
                            @if($warehouse->addition_to_address)
                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Підказка до адреси
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        {{$warehouse->addition_to_address}}
                                    </div>
                                </div>
                            @endif
                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                </div>

                                <div class="col-auto col-md-9 f-15 pe-0">
                                    <div id="map" style="height: 270px; border-radius: 6px;"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h5 class="fw-bolder mb-2">Графік роботи</h5>
                    @if(count($warehouse->schedule))
                        <div class="calendar-container">
                            <div class="calendar-header my-1">
                                <div
                                    class="calendar-navigation d-flex align-items-center justify-content-between justify-content-md-start row mx-0">
                                    <div class="col-auto d-flex justify-content-center p-0">
                                        <button class="btn p-0 button-calendar rounded-5 " id="prevWeekButton"><i
                                                data-feather='chevron-left'></i>
                                        </button>
                                    </div>

                                    <h5 class="col-auto col-sm-auto col-md-5 col-lg-3 p-0 mb-0 text-center text-secondary"
                                        id="currentMonthYear"></h5>

                                    <div class="col-auto d-flex justify-content-center p-0">
                                        <button class="btn p-0 button-calendar rounded-5 " id="nextWeekButton"><i
                                                data-feather='chevron-right'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table css-calendar-table table-hover table-striped table-borderless">
                                    <thead>
                                    <tr class="border border-top-0 border-end-0 border-start-0">
                                        <th class="text-nowrap text-secondary fs-5 fw-bold">День</th>
                                        <th class="text-nowrap text-secondary fs-5 fw-bold">Робочий день</th>
                                        <th class="text-nowrap text-secondary fs-5 fw-bold">Обід</th>
                                        <th class="text-nowrap"></th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        </div>

                    @else
                        <div class="fw-bold mb-0">Немає</div>
                    @endif

                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

@section('page-script')
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>

    <script src="{{asset('js/scripts/maps/map-leaflet.js')}}"></script>
    <script src="{{asset('vendors/js/maps/leaflet.min.js')}}"></script>

    <script>
        let coordinatesLoad = {!! ($warehouse->coordinates) !!}

    </script>
    <script src="{{asset('assets/js/utils/locationWarehouseMapsView.js')}}"></script>

    <script>
        let conditions = {!! json_encode($warehouse->conditions) !!}

            let
        exceptions = {!! json_encode($exceptions) !!}

            let
        exceptionsArray = []

        for (let i = 0; i < exceptions.length; i++) {
            exceptionsArray[exceptions[i].id] = exceptions[i].name
        }

        let schedule = [];
        console.log(conditions, exceptions, exceptionsArray)

        @foreach($warehouse->schedule as $row)

        // Додати конвертований рядок JSON у масив JavaScript
        schedule.push({!! json_encode($row) !!});

        // Використовуйте значення змінної PHP в JavaScript
        //console.log(phpVariable);

        @endforeach

        //console.log(schedule)

    </script>

    <script src="{{asset('assets/js/utils/calendar.js')}}"></script>

@endsection
