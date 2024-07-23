@extends('layouts.admin')
@section('title','')
@section('page-style')
@section('before-style')
<link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css" />
@endsection

@section('table-js')
@include('layouts.table-scripts')
<script type="module" src="{{asset('assets/js/grid/company/companies-table.js')}}"></script>
@endsection

@section('content')

@if(True)
<!-- <div class="card m-2">
            <div class="card-header border-bottom row">
                <h4 class="card-title col-9">Компанії</h4>
                <div class="col-3">
                    <a class="btn btn-green float-end" href="{{route('company.create')}}"><img class="plus-icon"
                                                                                               src="{{asset('assets/icons/plus.svg')}}">Добавити
                        компанію
                    </a>
                </div>
            </div>
            <div class="card-datatable">
                <table id="example" class="display table" style="width:100%">
                    <thead>
                    <tr>
                        <th>Назва</th>
                        <th>Тип</th>
                        <th>ЄДРПОУ/ІПН</th>
                        <th>Адреса</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($companies as $company)
                        <tr>
                            <td><a class="text-reset text-decoration-none" href="{{route('company.show',['company'=>$company->id])}}">
                                    {{$company->type->key === 'physical'
                                    ? $company->company->surname.' '.$company->company->first_name
                                    : $company->company->name}}
                                </a></td>
                            <td>{{$company->type->short_name}}</td>
                            <td>{{$company->ipn ?? $company->company->edrpou}}</td>
                            <td>{{$company->address->settlement->name.' '.$company->address->street->name}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div> -->

<div class="card m-2">
    <div class="card-header border-bottom row mx-0">
        <div class=" d-flex justify-content-between align-items-center">
            <h4 class="card-title col-9 fw-semibold">Компанії </h4> <a class="btn btn-primary"
                href="{{route('company.create')}}"> <i data-feather="plus" class="mr-1"></i> Додати компанію</a>
        </div>
    </div>
    <div class="card-grid" style="position: relative;">

        <div id="offcanvas-end-example">
            <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="settingTable"
                aria-labelledby="settingTableLabel"
                style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;"
                data-bs-scroll="true">
                <div class="offcanvas-header">
                    <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                    <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                        style="list-style: none;"><a class="nav-link nav-link-grid">
                            <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                    </li>
                </div>
                <div class="offcanvas-body p-0">
                    <div class="" id="body-wrapper">
                        <div class="d-flex flex-row align-items-center justify-content-between px-2">
                            <div class="form-check-label f-15">Змінити висоту рядка:</div>
                            <div class="form-check form-check-warning form-switch d-flex align-items-center" style="">
                                <button class="changeMenu-3">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button class="changeMenu-2 active-row-table ">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>

                            </div>
                        </div>
                        <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                            <label class="form-check-label f-15" for="changeFonts">Збільшити шрифт</label>
                            <div class="form-check form-check-warning form-switch">
                                <input type="checkbox" class="form-check-input checkbox" id="changeFonts" />
                            </div>
                        </div>
                        <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                            <label class="form-check-label f-15" for="changeCol">Зміна розміру
                                колонок</label>
                            <div class="form-check form-check-warning form-switch">
                                <input type="checkbox" class="form-check-input checkbox" id="changeCol" />
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex flex-column justify-content-between h-100" id="">
                            <div>
                                <div style="float: left;" id="jqxlistbox"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="table-block" id="companies-table">

        </div>
    </div>
</div>


@else
<div style="margin-top: 187px">
    <div class="empty-company text-center">
        У вас ще немає жодних компаній!
    </div>
    <div class="empty-company-title text-center">
        Для продовження роботи додайте нову компанію
    </div>
    <div class="text-center mt-2">
        <a class="btn btn-primary" href="{{route('company.create')}}">
            <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">Добавити
            компанію
        </a>
    </div>
</div>
@endif
@endsection


@section('page-script')
<script type="module">
import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

tableSetting($('#companies-table'));
</script>
<script type="module">
import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

offCanvasByBorder($('#companies-table'));
</script>
@endsection