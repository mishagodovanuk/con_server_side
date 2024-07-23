@extends('layouts.admin')
@section('title','Профіль користувача')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>

@endsection

@section('content')

    <div class="row mx-0 px-2">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class=" align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a class="link-secondary" href="/">Користувачі</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Перегляд {{$user->surname.' '.$user->name.' '.$user->patronymic}}</li>
                    </ol>
                </nav>
            </div>
            <div class=" d-flex gap-1 align-self-end ">
                <div>
                    <a class="text-secondary" href="{{route('user.update',['user'=>$user->id])}}"><i
                            data-feather='edit'
                            style="cursor: pointer; transform: scale(1.2);"></i>
                    </a>

                </div>
                <div>
                    <div class="btn-group">
                        <i data-feather='more-horizontal' id="header-dropdown" data-bs-toggle="dropdown"
                           aria-expanded="false" style="cursor: pointer; transform: scale(1.2);"></i>
                        <div class="dropdown-menu px-1" aria-labelledby="header-dropdown">
                            <div>
                                <form method="POST" action="{{route('user.delete',['user'=>$user->id])}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn text-danger">Деактивувати
                                    </button>
                                </form>
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
                        <div class="d-flex flex-column gap-1">
                            <img src="{{ $user->avatar_type ? '/file/uploads/user/avatars/'.$user->id.'.'.$user->avatar_type
                                            : asset('assets/images/avatar_empty.png') }}" id="account-upload-img"
                                 class="uploadedAvatar rounded" alt="profile image" height="80"
                                 width="80">
                            <div class="d-block d-md-none">
                                @if($user->isOnline())
                                    <span class="badge badge-light-success">Онлайн</span>
                                @else
                                    <span class="badge badge-light-danger">Оффлайн</span>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-between justify-content-md-around">
                            <div class="d-flex align-items-center gap-1">
                                <h3

                                    class="mb-0 fw-bolder text-start">{{$user->surname.' '.$user->name.' '.$user->patronymic}}
                                </h3>
                                <div class="d-none d-md-block">
                                    @if($user->isOnline())
                                        <span class="badge badge-light-success">Онлайн</span>
                                    @else
                                        <span class="badge badge-light-danger">Оффлайн</span>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex justify-content-start">
                                <div class="fw-bold"> {{$user->position?->name ?? 'Немає'}}</div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-3 my-2">

                    <div class="col-12 p-0 mt-1 row mx-0">
                        <h5 class="fw-bolder mb-0">Особисті дані</h5>
                        <div class="col-12 p-0 my-3 card-data">

                            <div class="row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Дата народження
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$user->birthday ?? "Немає"}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Електронна пошта
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$user->email}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Телефон
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$user->phone}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Стать
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$user->sex ? 'Жіноча' : "Чоловіча"}}
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-bolder mb-0">Робочі дані</h5>

                        <div class="col-12 p-0 my-3 card-data">

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Компанія
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    <a class="link-secondary text-decoration-underline"
                                       href="{{route('company.show',['company'=>$user->workingData->company->id])}}">{{$user->workingData->company->type->key == 'legal'
                                        ? $user->workingData->company->company->name : $user->workingData->company->company->surname.' '.$user->workingData->company->company->first_name}}</a>
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-6 col-md-3 f-15">
                                    Роль в системі
                                </div>

                                <div class="col-auto col-md-9 f-15 fw-bold">
                                    {{$user->workingData->role[0]->title}}
                                </div>
                            </div>

                            @if($user->workingData->position && $user->workingData->position->key ==='driver')
                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Номер посвідчення водія
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        № {{$user->workingData->driving_license_number ?? 'Немає'}}
                                    </div>
                                </div>

                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Термін дії посвідчення водія
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        До {{$user->workingData->driver_license_date}}
                                    </div>
                                </div>

                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Посвідчення водія
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold d-flex align-items-center gap-1">
                                        <img src="{{asset('assets/icons/file-upload.svg')}}" alt="file-upload">
                                        <a class="link-secondary text-truncate text-decoration-underline"
                                           download="{{$drivingLicenseFile->name}}"
                                           href="{{'/file/uploads/driver/driving_license/'.$user->id.".".$user->workingData->driving_license_doctype}}">
                                            {{$drivingLicenseFile->name}}
                                        </a>
                                    </div>
                                </div>

                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Номер особової медичної книжки
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        № {{$user->health_book_number ?? 'Немає'}}
                                    </div>
                                </div>

                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Термін дії особової медичної книжки
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold">
                                        До {{$user->health_book_date}}
                                    </div>
                                </div>

                                <div class=" row mx-0 py-1">
                                    <div class="col-6 col-md-3 f-15">
                                        Особова медична книжка
                                    </div>

                                    <div class="col-auto col-md-9 f-15 fw-bold d-flex align-items-center gap-1">
                                        <img src="{{asset('assets/icons/file-upload.svg')}}" alt="file-upload">
                                        <a class="link-secondary text-truncate text-decoration-underline"
                                           download="{{$healthBookFile->name}}"
                                           href="{{'/file/uploads/driver/health_book/'.$user->id.".".$user->health_book_doctype}}">
                                            {{$healthBookFile->name}}
                                        </a>
                                    </div>
                                </div>
                        </div>
                        @else
                            <div class="d-none"></div>
                        @endif

                    </div>
                    <h5 class="fw-bolder mb-2">Графік роботи</h5>
                    @if(count($user->workingData->schedule))
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

    <script>
        let conditions = {!! json_encode($user->workingData->conditions) !!};

        let exceptions = {!! json_encode($exceptions) !!};

        let exceptionsArray = []

        for (let i = 0; i < exceptions.length; i++) {
            exceptionsArray[exceptions[i].id] = exceptions[i].name
        }

        let schedule = [];

        console.log(conditions, exceptions, exceptionsArray)

        @foreach($user->workingData->schedule as $row)

        // Додати конвертований рядок JSON у масив JavaScript
        schedule.push({!! json_encode($row) !!});

        // Використовуйте значення змінної PHP в JavaScript
        //console.log(phpVariable);

        @endforeach

        //console.log(schedule)
    </script>

    <script src="{{asset('assets/js/utils/calendar.js')}}"></script>

@endsection
