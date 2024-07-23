@extends('layouts.admin')
@section('title','')
@section('page-style')


@endsection
@section('before-style')
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>

@endsection

@section('table-js')
    @include('layouts.table-scripts')

    <script type="text/javascript">
        // Ініціалізуємо таби
        $('#tabs').jqxTabs({
            width: '100%',
            height: '100%'
        });

        // Додаємо кнопку "Додати вкладку"
        var addButton = $(
            '<li class="btn-tabs-watch-all ms-auto  "><a class="btn btn-flat-primary tabs-external-link" href="#" style="" type="button"  >  Переглянути усі </a> </li>'
        );
        addButton.appendTo('#tabs > .jqx-tabs-header > .jqx-tabs-title-container');
    </script>
    <script type="module" src="{{asset('assets/js/grid/user/sessions-table.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/user/actionOverhead-table.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/user/actionCells-table.js')}}"></script>

@endsection



@section('content')

    <div class="row mx-0 px-2">
        <div class="d-flex p-0 justify-content-between">
            <div class="pb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="#" style="color: #4B465C;">Користувачі</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Перегляд {{$user->surname.' '.$user->name.' '.$user->patronymic}}</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
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
                        <div class="dropdown-menu" aria-labelledby="header-dropdown">
                            <a class="dropdown-item" href="#">
                                <div>
                                    <form method="POST" action="{{route('user.delete',['user'=>$user->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary user-btn">Деактивувати
                                        </button>
                                    </form>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">Дія</a>
                            <a class="dropdown-item" href="#">Дія</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 px-5 p-0">
            <div class="card">
                <div class="card-body p-4 row mx-0">

                    <div class="col-12 d-flex flex-row justify-content-start text-center gap-1">
                        <div>
                            <img src="{{ $user->avatar_type ? '/file/uploads/user/avatars/'.$user->id.'.'.$user->avatar_type
                                            : asset('assets/images/avatar_empty.png') }}" id="account-upload-img"
                                 class="uploadedAvatar rounded" alt="profile image" height="80"
                                 width="80">
                        </div>
                        <div class="d-flex flex-column justify-content-around">
                            <div class="d-flex align-items-center gap-1">
                                <h3

                                    class="mb-0 fw-bolder">{{$user->surname.' '.$user->name.' '.$user->patronymic}}
                                </h3>
                                <div>
                                    @if($user->isOnline())
                                        <span class="badge badge-light-success">Онлайн</span>
                                    @else
                                        <span class="badge badge-light-danger">Оффлайн</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="fw-bold"> {{$user->position->name ?? 'Немає'}}</div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-3 my-2">

                    <div class="col-12 p-0 mt-1 row mx-0">
                        <h5 class="fw-bolder mb-0">Особисті дані</h5>
                        <div class="col-12 p-0 my-3 card-data">

                            <div class="row mx-0 py-1">
                                <div class="col-3 f-15">
                                    Дата народження
                                </div>

                                <div class="col-9 0mt-1 f-15 fw-bold">
                                    {{$user->birthday ?? "Немає"}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-3 f-15">
                                    Електронна пошта
                                </div>

                                <div class="col-9 0mt-1 f-15 fw-bold">
                                    {{$user->email}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-3 f-15">
                                    Телефон
                                </div>

                                <div class="col-9 0mt-1 f-15 fw-bold">
                                    {{$user->phone}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-3 f-15">
                                    Стать
                                </div>

                                <div class="col-9 0mt-1 f-15 fw-bold">
                                    Чоловіча
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-3 f-15">
                                    Пароль
                                </div>

                                <div class="col-9 0mt-1 f-15 fw-bold">
                                    {{$user->short_password ?? "Немає"}}
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-bolder mb-0">Робочі дані</h5>

                        <div class="col-12 p-0 my-3 card-data">

                            <div class=" row mx-0 py-1">
                                <div class="col-3 f-15">
                                    Бригада
                                </div>

                                <div class="col-9 0mt-1 f-15 fw-bold">
                                    {{$user->brigade->name ?? 'Немає'}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-3 f-15">
                                    Посада / Роль користувача
                                </div>

                                <div class="col-9 0mt-1 f-15 fw-bold">
                                    {{$user->position->name ?? 'Немає'}}
                                </div>
                            </div>

                            <div class=" row mx-0 py-1">
                                <div class="col-3 f-15">
                                    Підрозділ
                                </div>

                                <div class="col-9 0mt-1 f-15 fw-bold">
                                    {{$user->unit->name ?? 'Немає'}}
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-bolder mb-0">Графік роботи</h5>

                    </div>

                </div>
            </div>
        </div>


    </div>

@endsection
@section('page-script')

    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        tableSetting($('#sessions-table'));
        tableSetting($('#actionOverhead-table'), '-actionOverhead');
        tableSetting($('#actionCells-table'), '-actionCells');
    </script>





    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        offCanvasByBorder($('#sessions-table'));
        offCanvasByBorder($('#actionOverhead-table'), '-actionOverhead');
        offCanvasByBorder($('#actionCells-table'), '-actionCells');
    </script>

@endsection


{{--@extends('layouts.admin')--}}
{{--@section('title','')--}}
{{--@section('page-style')--}}


{{--@endsection--}}
{{--@section('before-style')--}}
{{--    <link rel="stylesheet" type="text/css"--}}
{{--          href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>--}}
{{--    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>--}}

{{--@endsection--}}

{{--@section('table-js')--}}
{{--    @include('layouts.table-scripts')--}}

{{--    <script type="text/javascript">--}}
{{--        // Ініціалізуємо таби--}}
{{--        $('#tabs').jqxTabs({--}}
{{--            width: '100%',--}}
{{--            height: '100%'--}}
{{--        });--}}

{{--        // Додаємо кнопку "Додати вкладку"--}}
{{--        var addButton = $(--}}
{{--            '<li class="btn-tabs-watch-all ms-auto  "><a class="btn btn-flat-primary tabs-external-link" href="#" style="" type="button"  >  Переглянути усі </a> </li>'--}}
{{--        );--}}
{{--        addButton.appendTo('#tabs > .jqx-tabs-header > .jqx-tabs-title-container');--}}
{{--    </script>--}}
{{--    <script type="module" src="{{asset('assets/js/grid/user/sessions-table.js')}}"></script>--}}
{{--    <script type="module" src="{{asset('assets/js/grid/user/actionOverhead-table.js')}}"></script>--}}
{{--    <script type="module" src="{{asset('assets/js/grid/user/actionCells-table.js')}}"></script>--}}

{{--@endsection--}}


{{--@section('content')--}}

{{--    <div class="row ps-2 pe-2">--}}
{{--        <div class="d-flex justify-content-between">--}}
{{--            <div class="pb-2">--}}
{{--                <nav aria-label="breadcrumb">--}}
{{--                    <ol class="breadcrumb breadcrumb-slash">--}}
{{--                        <li class="breadcrumb-item"><a href="#" style="color: #4B465C;">Користувачі</a></li>--}}
{{--                        <li class="breadcrumb-item fw-bolder active" aria-current="page">--}}
{{--                            Перегляд {{$user->surname.' '.$user->name.' '.$user->patronymic}}</li>--}}
{{--                    </ol>--}}
{{--                </nav>--}}
{{--            </div>--}}
{{--            <div class="d-flex gap-2">--}}
{{--                <div><a class="text-secondary" href="{{route('user.update',['user'=>$user->id])}}"><i--}}
{{--                            data-feather='edit'--}}
{{--                            style="cursor: pointer; transform: scale(1.2);"></i></a>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <div class="btn-group">--}}
{{--                        <i data-feather='more-horizontal' id="header-dropdown" data-bs-toggle="dropdown"--}}
{{--                           aria-expanded="false" style="cursor: pointer; transform: scale(1.2);"></i>--}}
{{--                        <div class="dropdown-menu" aria-labelledby="header-dropdown">--}}
{{--                            <a class="dropdown-item" href="#">Дія</a>--}}
{{--                            <a class="dropdown-item" href="#">Дія</a>--}}
{{--                            <a class="dropdown-item" href="#">Дія</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body row">--}}

{{--                    <div class="col-2 justify-content-center text-center avatar_block">--}}
{{--                        <div class="avatar">--}}
{{--                            <img src="{{ $user->avatar_type ? asset('uploads/user/avatars/'.$user->id.'.'.$user->avatar_type)--}}
{{--                                            : asset('assets/images/avatar_empty.png') }}" id="account-upload-img"--}}
{{--                                 class="uploadedAvatar rounded border-radius-50" alt="profile image" height="100"--}}
{{--                                 width="100">--}}
{{--                            @if($user->isOnline())--}}
{{--                                <span class="online-status"></span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="mt-1">--}}
{{--                            <span class="f-15 fw-bolder">{{$user->surname.' '.$user->name.' '.$user->patronymic}}</span>--}}
{{--                        </div>--}}
{{--                        <div class="mt-1">--}}
{{--                            Статус <span class="text-success fw-bolder">на складі</span>--}}
{{--                        </div>--}}
{{--                        <div class="mt-1">--}}
{{--                            <a href="{{route('user.update',['user'=>$user->id])}}"--}}
{{--                               class="btn btn-primary user-btn">Редагувати</a>--}}
{{--                        </div>--}}
{{--                        <div class="mt-1">--}}
{{--                            <form method="POST" action="{{route('user.delete',['user'=>$user->id])}}">--}}
{{--                                @method('DELETE')--}}
{{--                                @csrf--}}
{{--                                <button type="submit" class="btn btn-outline-primary user-btn">Деактивувати</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-3">--}}
{{--                        <div class="mt-1 f-15 fw-4">--}}
{{--                            Login--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-4">--}}
{{--                            Пароль--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-4">--}}
{{--                            Дата народження--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-4">--}}
{{--                            Номер телефону--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-4">--}}
{{--                            Адреса електронної пошти--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-4">--}}
{{--                            Бригада--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-4">--}}
{{--                            Посада / Роль користувача--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-4">--}}
{{--                            Підрозділ--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-5">--}}
{{--                        <div class="mt-1 f-15 fw-6">--}}
{{--                            {{$user->login}}--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-6">--}}
{{--                            {{$user->short_password}}--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-6">--}}
{{--                            {{$user->birthday}}--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-6">--}}
{{--                            {{$user->phone}}--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-6">--}}
{{--                            {{$user->email}}--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-6">--}}
{{--                            {{$user->brigade->name ?? 'Немає'}}--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-6">--}}
{{--                            {{$user->position->name}}--}}
{{--                        </div>--}}
{{--                        <div class="mt-1 f-15 fw-6">--}}
{{--                            {{$user->unit->name}}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-6">--}}
{{--            <div class="card" style="height: 386px;">--}}
{{--                <div class="card-header row" style="margin-top: 10px">--}}
{{--                    <div class="col-6 fw-bolder fs-4">Робочий графік</div>--}}
{{--                    <div class="col-6">--}}
{{--                        <a href="{{route('user.schedule-update',['user'=>$user->id])}}"--}}
{{--                           class="btn btn-link link-primary float-end p-0 f-15 fw-5">Редагувати</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-3">--}}
{{--                            <span class="f-15">Дата</span>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <span class="f-15">Робочий день</span>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <span class="f-15">Обід</span>--}}
{{--                        </div>--}}
{{--                        <div class="col-2">--}}
{{--                            <span class="f-15 float-end">Виконання</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @foreach($user->schedule as $record)--}}
{{--                        <div class="row mt-1">--}}
{{--                            <div class="col-3">--}}
{{--                                <span class="f-15">{{$record->weekday}}</span>--}}
{{--                            </div>--}}
{{--                            @if($record->is_day_off)--}}
{{--                                <div class="col-4">--}}
{{--                                    <span class="f-15">Вихідний</span>--}}
{{--                                </div>--}}
{{--                                <div class="col-3">--}}
{{--                                    <span class="f-15">Вихідний</span>--}}
{{--                                </div>--}}
{{--                            @else--}}
{{--                                <div class="col-4">--}}
{{--                                    <span class="f-15">{{$record->start_at.' - '.$record->end_at}}</span>--}}
{{--                                </div>--}}
{{--                                <div class="col-3">--}}
{{--                                    <span class="f-15">{{$record->break_start_at.' - '.$record->break_end_at}}</span>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            <div class="col-2 d-flex justify-content-center">--}}
{{--                                <span class="badge badge-light-warning">45%</span>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-6">--}}
{{--            <div class="card" style="height: 386px;">--}}
{{--                <div class="card-header row" style="margin-top: 10px">--}}
{{--                    <div class="col-6 fw-bolder fs-4">КПП</div>--}}
{{--                    <div class="col-6">--}}
{{--                        <a class="btn btn-link link-primary float-end p-0 f-15 fw-5">Переглянути усі</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card border-top">--}}
{{--                    <div class="card-datatable">--}}
{{--                        <table id="example" class="display table" style="width:100%">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Тип</th>--}}
{{--                                <th>Часова відмітка</th>--}}
{{--                                <th>ID Прохідна</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @for($i=1;$i<6;$i++)--}}
{{--                                <tr>--}}
{{--                                    <td>Вихід</td>--}}
{{--                                    <td>18:36 10.11.2022</td>--}}
{{--                                    <td>КПП 1</td>--}}
{{--                                </tr>--}}
{{--                            @endfor--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- таблиці з табами  -->--}}
{{--        @if(True)--}}

{{--            <div class="col-12 " style="flex-grow: 1;">--}}
{{--                <!-- Basic Tabs starts -->--}}
{{--                <div class="col-xl-12 col-lg-12">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex justify-content-between tabs-user-tables">--}}

{{--                            <div id="tabs" class="">--}}
{{--                                <ul class=" d-flex ">--}}
{{--                                    <li>WMS сесії</li>--}}
{{--                                    <li>Дії з накладними</li>--}}
{{--                                    <li>Дії з комірками</li>--}}

{{--                                </ul>--}}

{{--                                <div>--}}
{{--                                    <!-- таблиця один -->--}}
{{--                                    <div>--}}
{{--                                        <div class="card-grid" style="position: relative;">--}}

{{--                                            <div id="offcanvas-end-example">--}}

{{--                                                <div class="offcanvas offcanvas-end" data-bs-backdrop="false"--}}
{{--                                                     tabindex="-1"--}}
{{--                                                     id="settingTable" aria-labelledby="settingTableLabel"--}}
{{--                                                     style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"--}}
{{--                                                     data-bs-scroll="true">--}}
{{--                                                    <div class="offcanvas-header">--}}
{{--                                                        <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування--}}
{{--                                                            таблиці</h4>--}}
{{--                                                        <li class="nav-item nav-search text-reset"--}}
{{--                                                            data-bs-dismiss="offcanvas"--}}
{{--                                                            aria-label="Close" style="list-style: none;"><a--}}
{{--                                                                class="nav-link nav-link-grid">--}}
{{--                                                                <img--}}
{{--                                                                    src="{{asset('assets/icons/close-button.svg')}}"></a>--}}
{{--                                                        </li>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="offcanvas-body p-0">--}}
{{--                                                        <div class="" id="body-wrapper">--}}
{{--                                                            <div--}}
{{--                                                                class="d-flex flex-row align-items-center justify-content-between px-2">--}}
{{--                                                                <div class="form-check-label f-15">Змінити висоту рядка:--}}
{{--                                                                </div>--}}
{{--                                                                <div--}}
{{--                                                                    class="form-check form-check-warning form-switch d-flex align-items-center"--}}
{{--                                                                    style="">--}}
{{--                                                                    <button class="changeMenu-3">--}}
{{--                                                                        <svg width="30" height="30" viewBox="0 0 30 30"--}}
{{--                                                                             fill="none"--}}
{{--                                                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                            <path d="M9 10.5H21" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                            <path d="M9 15H21" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                            <path d="M9 19.5H21" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                        </svg>--}}
{{--                                                                    </button>--}}
{{--                                                                    <button class="changeMenu-2 active-row-table ">--}}
{{--                                                                        <svg width="18" height="18" viewBox="0 0 18 18"--}}
{{--                                                                             fill="none"--}}
{{--                                                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                            <path d="M3 6H15" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                            <path d="M3 12H15" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                        </svg>--}}
{{--                                                                    </button>--}}

{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div--}}
{{--                                                                class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">--}}
{{--                                                                <label class="form-check-label f-15" for="changeFonts">Збільшити--}}
{{--                                                                    шрифт</label>--}}
{{--                                                                <div class="form-check form-check-warning form-switch">--}}
{{--                                                                    <input type="checkbox"--}}
{{--                                                                           class="form-check-input checkbox"--}}
{{--                                                                           id="changeFonts"/>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div--}}
{{--                                                                class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">--}}
{{--                                                                <label class="form-check-label f-15" for="changeCol">Зміна--}}
{{--                                                                    розміру--}}
{{--                                                                    колонок</label>--}}
{{--                                                                <div class="form-check form-check-warning form-switch">--}}
{{--                                                                    <input type="checkbox"--}}
{{--                                                                           class="form-check-input checkbox"--}}
{{--                                                                           id="changeCol"/>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <hr>--}}
{{--                                                            <div--}}
{{--                                                                class="d-flex flex-column justify-content-between h-100"--}}
{{--                                                                id="">--}}
{{--                                                                <div>--}}
{{--                                                                    <div style="float: left;" id="jqxlistbox"></div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="table-block" id="sessions-table">--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <!-- таблиця два -->--}}
{{--                                    <div class=" ">--}}

{{--                                        <div class="card-grid" style="position: relative;">--}}

{{--                                            <div id="offcanvas-end-example">--}}
{{--                                                <button class="btn btn-flat-primary tabs-external-link "--}}
{{--                                                        style=" position:absolute;  right: 56px; top:4px; transform: unset; transition: unset; z-index: 51;">--}}
{{--                                                    Переглянути--}}
{{--                                                    всі--}}
{{--                                                </button>--}}

{{--                                                <div class="offcanvas offcanvas-end" data-bs-backdrop="false"--}}
{{--                                                     tabindex="-1"--}}
{{--                                                     id="settingTable-actionOverhead"--}}
{{--                                                     aria-labelledby="settingTableLabel"--}}
{{--                                                     style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"--}}
{{--                                                     data-bs-scroll="true">--}}
{{--                                                    <div class="offcanvas-header">--}}
{{--                                                        <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування--}}
{{--                                                            таблиці--}}
{{--                                                        </h4>--}}
{{--                                                        <li class="nav-item nav-search text-reset"--}}
{{--                                                            data-bs-dismiss="offcanvas"--}}
{{--                                                            aria-label="Close" style="list-style: none;"><a--}}
{{--                                                                class="nav-link nav-link-grid">--}}
{{--                                                                <img--}}
{{--                                                                    src="{{asset('assets/icons/close-button.svg')}}"></a>--}}
{{--                                                        </li>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="offcanvas-body p-0">--}}
{{--                                                        <div class="" id="body-wrapper">--}}
{{--                                                            <div--}}
{{--                                                                class="d-flex flex-row align-items-center justify-content-between px-2">--}}
{{--                                                                <div class="form-check-label f-15">Змінити висоту--}}
{{--                                                                    рядка:--}}
{{--                                                                </div>--}}
{{--                                                                <div--}}
{{--                                                                    class="form-check form-check-warning form-switch d-flex align-items-center"--}}
{{--                                                                    style="">--}}
{{--                                                                    <button class="changeMenu-3">--}}
{{--                                                                        <svg width="30" height="30" viewBox="0 0 30 30"--}}
{{--                                                                             fill="none"--}}
{{--                                                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                            <path d="M9 10.5H21" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                            <path d="M9 15H21" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                            <path d="M9 19.5H21" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                        </svg>--}}
{{--                                                                    </button>--}}
{{--                                                                    <button class="changeMenu-2 active-row-table ">--}}
{{--                                                                        <svg width="18" height="18" viewBox="0 0 18 18"--}}
{{--                                                                             fill="none"--}}
{{--                                                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                            <path d="M3 6H15" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                            <path d="M3 12H15" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                        </svg>--}}
{{--                                                                    </button>--}}

{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div--}}
{{--                                                                class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">--}}
{{--                                                                <label class="form-check-label f-15"--}}
{{--                                                                       for="changeFonts-actionOverhead">Збільшити--}}
{{--                                                                    шрифт</label>--}}
{{--                                                                <div class="form-check form-check-warning form-switch">--}}
{{--                                                                    <input type="checkbox"--}}
{{--                                                                           class="form-check-input checkbox"--}}
{{--                                                                           id="changeFonts-actionOverhead"/>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div--}}
{{--                                                                class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">--}}
{{--                                                                <label class="form-check-label f-15"--}}
{{--                                                                       for="changeCol-actionOverhead">Зміна--}}
{{--                                                                    розміру--}}
{{--                                                                    колонок</label>--}}
{{--                                                                <div class="form-check form-check-warning form-switch">--}}
{{--                                                                    <input type="checkbox"--}}
{{--                                                                           class="form-check-input checkbox"--}}
{{--                                                                           id="changeCol-actionOverhead"/>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <hr>--}}
{{--                                                            <div--}}
{{--                                                                class="d-flex flex-column justify-content-between h-100"--}}
{{--                                                                id="">--}}
{{--                                                                <div>--}}
{{--                                                                    <div style="float: left;"--}}
{{--                                                                         id="jqxlistbox-actionOverhead"></div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="table-block" id="actionOverhead-table">--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <!-- таблиця три -->--}}
{{--                                    <div class=" ">--}}

{{--                                        <div class="card-grid" style="position: relative;">--}}

{{--                                            <div id="offcanvas-end-example">--}}
{{--                                                <button class="btn btn-flat-primary tabs-external-link "--}}
{{--                                                        style=" position:absolute;  right: 56px; top:4px; transform: unset; transition: unset; z-index: 51;">--}}
{{--                                                    Переглянути--}}
{{--                                                    всі--}}
{{--                                                </button>--}}

{{--                                                <div class="offcanvas offcanvas-end" data-bs-backdrop="false"--}}
{{--                                                     tabindex="-1"--}}
{{--                                                     id="settingTable-actionCells" aria-labelledby="settingTableLabel"--}}
{{--                                                     style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"--}}
{{--                                                     data-bs-scroll="true">--}}
{{--                                                    <div class="offcanvas-header">--}}
{{--                                                        <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування--}}
{{--                                                            таблиці--}}
{{--                                                        </h4>--}}
{{--                                                        <li class="nav-item nav-search text-reset"--}}
{{--                                                            data-bs-dismiss="offcanvas"--}}
{{--                                                            aria-label="Close" style="list-style: none;"><a--}}
{{--                                                                class="nav-link nav-link-grid">--}}
{{--                                                                <img--}}
{{--                                                                    src="{{asset('assets/icons/close-button.svg')}}"></a>--}}
{{--                                                        </li>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="offcanvas-body p-0">--}}
{{--                                                        <div class="" id="body-wrapper">--}}
{{--                                                            <div--}}
{{--                                                                class="d-flex flex-row align-items-center justify-content-between px-2">--}}
{{--                                                                <div class="form-check-label f-15">Змінити висоту--}}
{{--                                                                    рядка:--}}
{{--                                                                </div>--}}
{{--                                                                <div--}}
{{--                                                                    class="form-check form-check-warning form-switch d-flex align-items-center"--}}
{{--                                                                    style="">--}}
{{--                                                                    <button class="changeMenu-3">--}}
{{--                                                                        <svg width="30" height="30" viewBox="0 0 30 30"--}}
{{--                                                                             fill="none"--}}
{{--                                                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                            <path d="M9 10.5H21" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                            <path d="M9 15H21" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                            <path d="M9 19.5H21" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                        </svg>--}}
{{--                                                                    </button>--}}
{{--                                                                    <button class="changeMenu-2 active-row-table ">--}}
{{--                                                                        <svg width="18" height="18" viewBox="0 0 18 18"--}}
{{--                                                                             fill="none"--}}
{{--                                                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                            <path d="M3 6H15" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                            <path d="M3 12H15" stroke="#A8AAAE"--}}
{{--                                                                                  stroke-width="1.75"--}}
{{--                                                                                  stroke-linecap="round"--}}
{{--                                                                                  stroke-linejoin="round"/>--}}
{{--                                                                        </svg>--}}
{{--                                                                    </button>--}}

{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div--}}
{{--                                                                class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">--}}
{{--                                                                <label class="form-check-label f-15"--}}
{{--                                                                       for="changeFonts-actionCells">Збільшити--}}
{{--                                                                    шрифт</label>--}}
{{--                                                                <div class="form-check form-check-warning form-switch">--}}
{{--                                                                    <input type="checkbox"--}}
{{--                                                                           class="form-check-input checkbox"--}}
{{--                                                                           id="changeFonts-actionCells"/>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div--}}
{{--                                                                class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">--}}
{{--                                                                <label class="form-check-label f-15"--}}
{{--                                                                       for="changeCol-actionCells">Зміна--}}
{{--                                                                    розміру--}}
{{--                                                                    колонок</label>--}}
{{--                                                                <div class="form-check form-check-warning form-switch">--}}
{{--                                                                    <input type="checkbox"--}}
{{--                                                                           class="form-check-input checkbox"--}}
{{--                                                                           id="changeCol-actionCells"/>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <hr>--}}
{{--                                                            <div--}}
{{--                                                                class="d-flex flex-column justify-content-between h-100"--}}
{{--                                                                id="">--}}
{{--                                                                <div>--}}
{{--                                                                    <div style="float: left;"--}}
{{--                                                                         id="jqxlistbox-actionCells"></div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="table-block" id="actionCells-table">--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Basic Tabs end -->--}}
{{--            </div>--}}

{{--        @endif--}}
{{--        <!-- = -->--}}


{{--    </div>--}}

{{--@endsection--}}
{{--@section('page-script')--}}

{{--    <script type="module">--}}
{{--        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';--}}

{{--        tableSetting($('#sessions-table'));--}}
{{--        tableSetting($('#actionOverhead-table'), '-actionOverhead');--}}
{{--        tableSetting($('#actionCells-table'), '-actionCells');--}}
{{--    </script>--}}


{{--    <script type="module">--}}
{{--        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';--}}

{{--        offCanvasByBorder($('#sessions-table'));--}}
{{--        offCanvasByBorder($('#actionOverhead-table'), '-actionOverhead');--}}
{{--        offCanvasByBorder($('#actionCells-table'), '-actionCells');--}}
{{--    </script>--}}

{{--@endsection--}}
