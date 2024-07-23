@extends('layouts.admin')
@section('title','Склад')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">
    <link rel=" stylesheet" type="text/css" href="{{asset('vendors/css/extensions/nouislider.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/extensions/ext-component-sliders.css')}}">

@endsection

@section('content')
    @if(False)
        <div class="card mx-2">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header border-bottom p-1 d-flex justify-content-between">
                    <div class="head-label">
                        <h4 class="card-title">Сектори</h4>
                    </div>
                    <div class="dt-action-buttons text-end">
                        <div class="dt-buttons d-inline-flex">
                            <button class="dt-button create-new btn btn-primary" tabindex="0"
                                    aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modals-slide-in"><span><svg xmlns="http://www.w3.org/2000/svg"
                                                                                 width="24" height="24"
                                                                                 viewBox="0 0 24 24" fill="none"
                                                                                 stroke="currentColor" stroke-width="2"
                                                                                 stroke-linecap="round"
                                                                                 stroke-linejoin="round"
                                                                                 class="feather feather-plus me-50 font-small-4">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>Реєстрація нового сектору</span></button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mx-0 row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select
                                    name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                    class="form-select">
                                    <option value="7">7</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                                                                           class="form-control"
                                                                                                           placeholder=""
                                                                                                           aria-controls="DataTables_Table_0"></label>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table dataTable no-footer dtr-column" id="DataTables_Table_0" role="grid"
                       aria-describedby="DataTables_Table_0_info" style="width: 1442px;">
                    <thead>
                    <tr role="row">
                        <th class="control sorting_disabled" rowspan="1" colspan="1" style="width: 0px; display: none;"
                            aria-label=""></th>
                        <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1"
                            style="width: 25px;" data-col="1" aria-label="">
                            <div class="form-check"><input class="form-check-input" type="checkbox" value=""
                                                           id="checkboxSelectAll"><label class="form-check-label"
                                                                                         for="checkboxSelectAll"></label>
                            </div>
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 370px;" aria-label="Name: activate to sort column ascending">Сектор
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 250px;" aria-label="Email: activate to sort column ascending">Колір
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 360px;" aria-label="Date: activate to sort column ascending">Температурний
                            режим (°С)
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 304px;" aria-label="Salary: activate to sort column ascending">Вологість (%)
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 304px;" aria-label="Salary: activate to sort column ascending">Ряди
                        </th>

                        <th class="sorting_disabled px-1 py-0" rowspan="1" colspan="1" style="width: 26px;"
                            aria-label="Actions">
                            <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="16.5" cy="14.5" r="1.5" stroke="#4B465C" stroke-width="1.75"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="16.5" cy="14.5" r="1.5" stroke="white" stroke-opacity="0.5"
                                        stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 14.5H15" stroke="#4B465C" stroke-width="1.75" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M9 14.5H15" stroke="white" stroke-opacity="0.5" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 14.5H21" stroke="#4B465C" stroke-width="1.75" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M18 14.5H21" stroke="white" stroke-opacity="0.5" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="19" r="1.5" stroke="#4B465C" stroke-width="1.75"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="19" r="1.5" stroke="white" stroke-opacity="0.5" stroke-width="1.75"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 19H10.5" stroke="#4B465C" stroke-width="1.75" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M9 19H10.5" stroke="white" stroke-opacity="0.5" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.5 19H21" stroke="#4B465C" stroke-width="1.75" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M13.5 19H21" stroke="white" stroke-opacity="0.5" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="18.75" cy="23.5" r="1.5" stroke="#4B465C" stroke-width="1.75"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="18.75" cy="23.5" r="1.5" stroke="white" stroke-opacity="0.5"
                                        stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 23.5H17.25" stroke="#4B465C" stroke-width="1.75" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M9 23.5H17.25" stroke="white" stroke-opacity="0.5" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.25 23.5H21" stroke="#4B465C" stroke-width="1.75" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M20.25 23.5H21" stroke="white" stroke-opacity="0.5" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="25" cy="8" r="2" fill="#D9B414"/>
                            </svg>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd">
                        <td class=" control" tabindex="0" style="display: none;"></td>
                        <td class=" dt-checkboxes-cell">
                            <div class="form-check"><input class="form-check-input dt-checkboxes" type="checkbox"
                                                           value="" id="checkbox100"><label class="form-check-label"
                                                                                            for="checkbox100"></label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="d-flex flex-column"><span class="emp_name text-truncate fw-bold">А</span>
                                </div>
                            </div>
                        </td>
                        <td><img src="{{ asset('assets/images/colorMagenta.png') }}" alt="color">
                        </td>
                        <td>18-24</td>
                        <td>30</td>
                        <td>
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.75 15H20.25" stroke="#D9B414" stroke-width="1.75" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M15.75 19.5L20.25 15" stroke="#D9B414" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.75 10.5L20.25 15" stroke="#D9B414" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </td>
                        <td>
                            <div class="d-inline-flex"><a class="pe-1 dropdown-toggle hide-arrow text-primary"
                                                          data-bs-toggle="dropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end"><a href="javascript:;"
                                                                                class="dropdown-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-file-text font-small-4 me-50">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        Details</a><a href="javascript:;" class="dropdown-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-archive font-small-4 me-50">
                                            <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                            <rect x="1" y="3" width="22" height="5"></rect>
                                            <line x1="10" y1="12" x2="14" y2="12"></line>
                                        </svg>
                                        Archive</a><a href="javascript:;" class="dropdown-item delete-record">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-trash-2 font-small-4 me-50">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        Delete</a></div>
                            </div>
                        </td>
                    </tr>
                    <tr class="even">
                        <td class=" control" tabindex="0" style="display: none;"></td>
                        <td class=" dt-checkboxes-cell">
                            <div class="form-check"><input class="form-check-input dt-checkboxes" type="checkbox"
                                                           value="" id="checkbox100"><label class="form-check-label"
                                                                                            for="checkbox100"></label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="d-flex flex-column"><span class="emp_name text-truncate fw-bold">А</span>
                                </div>
                            </div>
                        </td>
                        <td><img src="{{ asset('assets/images/colorMagenta.png') }}" alt="color"></td>
                        <td>18-24</td>
                        <td>30</td>
                        <td>
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.75 15H20.25" stroke="#D9B414" stroke-width="1.75" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M15.75 19.5L20.25 15" stroke="#D9B414" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.75 10.5L20.25 15" stroke="#D9B414" stroke-width="1.75"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </td>
                        <td>
                            <div class="d-inline-flex"><a class="pe-1 dropdown-toggle hide-arrow text-primary"
                                                          data-bs-toggle="dropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end"><a href="javascript:;"
                                                                                class="dropdown-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-file-text font-small-4 me-50">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        Details</a><a href="javascript:;" class="dropdown-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-archive font-small-4 me-50">
                                            <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                            <rect x="1" y="3" width="22" height="5"></rect>
                                            <line x1="10" y1="12" x2="14" y2="12"></line>
                                        </svg>
                                        Archive</a><a href="javascript:;" class="dropdown-item delete-record">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-trash-2 font-small-4 me-50">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        Delete</a></div>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <div class="d-flex justify-content-between mx-0 row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                            Showing 1 to 7 of 100 entries
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled"
                                    id="DataTables_Table_0_previous"><a href="#" aria-controls="DataTables_Table_0"
                                                                        data-dt-idx="0" tabindex="0" class="page-link">&nbsp;</a>
                                </li>
                                <li class="paginate_button page-item active"><a href="#"
                                                                                aria-controls="DataTables_Table_0"
                                                                                data-dt-idx="1" tabindex="0"
                                                                                class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0"
                                                                          data-dt-idx="2" tabindex="0"
                                                                          class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0"
                                                                          data-dt-idx="3" tabindex="0"
                                                                          class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0"
                                                                          data-dt-idx="4" tabindex="0"
                                                                          class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0"
                                                                          data-dt-idx="5" tabindex="0"
                                                                          class="page-link">5</a></li>
                                <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis"><a
                                        href="#" aria-controls="DataTables_Table_0" data-dt-idx="6" tabindex="0"
                                        class="page-link">…</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0"
                                                                          data-dt-idx="7" tabindex="0"
                                                                          class="page-link">15</a></li>
                                <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#"
                                                                                                           aria-controls="DataTables_Table_0"
                                                                                                           data-dt-idx="8"
                                                                                                           tabindex="0"
                                                                                                           class="page-link">&nbsp;</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div style="margin-top: 208px">
            <div class="empty-company text-center">
                Додайте ряди в секторі
            </div>
            <div class="empty-company-title empty-company-title-m text-center mt-1">
                Додайте ряди в секторі в якому будуть розміщуватись комірки
            </div>
            <div class="text-center mt-3">
                <a data-bs-toggle="modal" data-bs-target="#animation" class="btn btn-primary"
                   href="{{route('transport.create')}}">
                    <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">Додати ряд
                </a>
            </div>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal text-start" id="animation" tabindex="-1" aria-labelledby="myModalLabel6" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 610px!important;">
            <div class="modal-content">
                <div class="modal-header justify-content-center" style="padding-top: 4.5rem;">
                    <div class="popup-header ">
                        Створення ряду
                    </div>
                </div>
                <div class="card popup-card">

                    <div class="card-body"
                         style="padding-left: 4.5rem; padding-right: 4.5rem; padding-bottom: 4.5rem; padding-top:1rem">
                        <div class="row">

                            <div class="d-flex flex-row align-items-center">
                                <div class="form-check form-check-warning form-switch">
                                    <input type="checkbox" class="form-check-input checkbox"
                                           id="checkbox-1 customSwitch1" value="checkbox-2-block"/>
                                </div>
                                <label class="form-check-label f-15" for="customSwitch1">Розширені налаштування</label>
                            </div>

                            <div class="col-12" id="checkbox-1-block">
                                <div class="col-12 col-sm-12 mt-1  mb-2">
                                    <label class="form-label">Номер</label>
                                    <input placeholder="Введіть любий номер" type="text" class="form-control" id="">
                                </div>

                                <div class="col-12 mb-2">
                                    <label class="form-label" for=" select2-hide-search">Тип нумерації</label>
                                    <select class="select2 form-select hide-search" id=""
                                            data-placeholder="Виберіть тип нумерації">
                                        <option value=""></option>
                                        <option value="1">Тип нумерації 1</option>
                                        <option value="2">Тип нумерації 2</option>
                                        <option value="3">Тип нумерації 3</option>
                                    </select>
                                </div>

                                <div class="col-12 mb-2">
                                    <label class="form-label" for=" select2-hide-search">Тип зберігання</label>
                                    <select class="select2 form-select hide-search" id=""
                                            data-placeholder="Виберіть тип зберігання">
                                        <option value=""></option>
                                        <option value="1">Тип зберігання 1</option>
                                        <option value="2">Тип зберігання 2</option>
                                        <option value="3">Тип зберігання 3</option>
                                    </select>
                                </div>

                                <div class="col-12 col-sm-12 mb-1">
                                    <label class="form-label">Кількість стелажів</label>
                                    <input placeholder="Введіть кількість стелажів" type="text" class="form-control"
                                           id="">
                                </div>

                                <div class="col-12 col-sm-12 mb-1">
                                    <label class="form-label">Кількість поверхів</label>
                                    <input placeholder="Введіть кількість поверхів" type="text" class="form-control"
                                           id="">
                                </div>

                                <div class="col-12 col-sm-12 mb-1">
                                    <label class="form-label">Кількість комірок в стелажі</label>
                                    <input placeholder="Введіть кількість комірок в стелажі" type="text"
                                           class="form-control" id="">
                                </div>
                            </div>

                            <div class="col-12" id="checkbox-2-block" style="display: none;">
                                <div class="row mt-1 mx-0" style="column-gap: 20px;">
                                    <div class="col-2 mb-2 px-0 w-auto">
                                        <label class="form-label">Номер</label>
                                        <input placeholder="Введіть любий номер" type="text"
                                               class="form-control text-truncate" style="width: 143px;">
                                    </div>

                                    <div class="col-9 px-0" style="flex-grow: 1;">
                                        <div class="row mx-0" style="column-gap: 20px;">
                                            <div class="col-2 col-sm-2 mb-2 ps-0 pe-0" style="flex-basis: max-content">
                                                <label class=" form-label">Кількість стелажів</label>
                                                <input placeholder="Введіть кількість стелажів" type="number"
                                                       class="form-control text-truncate"
                                                       style="width:100%; max-width:140px">
                                            </div>

                                            <div class=" col-8 col-sm-8 mb-2 px-0" style="flex-grow: 1;">
                                                <label class="form-label" for=" select2-hide-search">Тип
                                                    нумерації</label>
                                                <select class="select2 form-select hide-search" id=""
                                                        data-placeholder="Виберіть тип нумерації">
                                                    <option value=""></option>
                                                    <option value="1">Тип нумерації 1</option>
                                                    <option value="2">Тип нумерації 2</option>
                                                    <option value="3">Тип нумерації 3</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <hr class="mt-0">

                                <!-- Vertical Left Tabs start -->
                                <div>
                                    <div class="card mb-0">

                                        <div class="card-body px-0 py-0">
                                            <div class="nav-vertical">
                                                <ul class="nav nav-tabs nav-left flex-column col-2" role="tablist"
                                                    style="margin-right: 1.5rem;">
                                                    <li class="nav-item" style="width: 145px;">
                                                        <a class="nav-link justify-content-center active"
                                                           id="baseVerticalLeft-tab1" data-bs-toggle="tab"
                                                           aria-controls="tabVerticalLeft1" href="#tabVerticalLeft1"
                                                           role="tab" aria-selected="true">Стелаж 1</a>
                                                    </li>
                                                    <li class="nav-item" style="width: 145px;">
                                                        <a class=" nav-link justify-content-center"
                                                           id="baseVerticalLeft-tab2" data-bs-toggle="tab"
                                                           aria-controls="tabVerticalLeft2" href="#tabVerticalLeft2"
                                                           role="tab" aria-selected="fals e">Стелаж 2</a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane active px-0" id="tabVerticalLeft1"
                                                         role="tabpanel" aria-labelledby="baseVerticalLeft-tab1">
                                                        <div class="mb-1">
                                                            <div class="d-flex align-center justify-content-between">
                                                                <h4 class="fw-bolder mb-0" style="margin-top: 4px;">
                                                                    Поверх 1</h4>

                                                                <div>
                                                                    <a href="">
                                                                        <svg width="30" height="30" viewBox="0 0 30 30"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M9 11.25H21" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path d="M13.5 14.25V18.75" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path d="M16.5 14.25V18.75" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path
                                                                                d="M9.75 11.25L10.5 20.25C10.5 21.0784 11.1716 21.75 12 21.75H18C18.8284 21.75 19.5 21.0784 19.5 20.25L20.25 11.25"
                                                                                stroke="#A8AAAE" stroke-width="1.75"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"/>
                                                                            <path
                                                                                d="M12.75 11.25V9C12.75 8.58579 13.0858 8.25 13.5 8.25H16.5C16.9142 8.25 17.25 8.58579 17.25 9V11.25"
                                                                                stroke="#A8AAAE" stroke-width="1.75"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex mt-1 justify-content-between row mx-0">
                                                                <div class="col-2 col-sm-2 mb-1 px-0"
                                                                     style="flex-basis: max-content; column-gap:20px">
                                                                    <label class="form-label">Кількість комірок </label>
                                                                    <input placeholder="Введіть кількість стелажів"
                                                                           type="number"
                                                                           class="form-control text-truncate" id=""
                                                                           style="width:100%; max-width:140px">
                                                                </div>

                                                                <div
                                                                    class="col-10 col-sm-6 col-md-6 col-lg-6 col-xxl-6 mb-2 flex-grow-1 flex-shrink-1 warehouse-row-width-2 px-0">
                                                                    <label class="form-label"
                                                                           for=" select2-hide-search">Тип
                                                                        зберігання</label>
                                                                    <select class="select2 form-select hide-search"
                                                                            id=""
                                                                            data-placeholder="Виберіть тип зберігання">
                                                                        <option value=""></option>
                                                                        <option value="1">Тип зберігання 1</option>
                                                                        <option value="2">Тип зберігання 2</option>
                                                                        <option value="3">Тип зберігання 3</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="mb-1">
                                                            <div class="d-flex align-center justify-content-between">
                                                                <h4 class="fw-bolder mb-0" style="margin-top: 4px;">
                                                                    Поверх 1</h4>

                                                                <div>
                                                                    <a href="">
                                                                        <svg width="30" height="30" viewBox="0 0 30 30"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M9 11.25H21" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path d="M13.5 14.25V18.75" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path d="M16.5 14.25V18.75" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path
                                                                                d="M9.75 11.25L10.5 20.25C10.5 21.0784 11.1716 21.75 12 21.75H18C18.8284 21.75 19.5 21.0784 19.5 20.25L20.25 11.25"
                                                                                stroke="#A8AAAE" stroke-width="1.75"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"/>
                                                                            <path
                                                                                d="M12.75 11.25V9C12.75 8.58579 13.0858 8.25 13.5 8.25H16.5C16.9142 8.25 17.25 8.58579 17.25 9V11.25"
                                                                                stroke="#A8AAAE" stroke-width="1.75"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex mt-1 justify-content-between row mx-0">
                                                                <div class="col-2 col-sm-2 mb-1 px-0"
                                                                     style="flex-basis: max-content; column-gap:20px">
                                                                    <label class="form-label">Кількість комірок </label>
                                                                    <input placeholder="Введіть кількість стелажів"
                                                                           type="number"
                                                                           class="form-control text-truncate" id=""
                                                                           style="width:100%; max-width:140px">
                                                                </div>

                                                                <div
                                                                    class="col-10 col-sm-6 col-md-6 col-lg-6 col-xxl-6 mb-2 flex-grow-1 flex-shrink-1 warehouse-row-width-2 px-0">
                                                                    <label class="form-label"
                                                                           for=" select2-hide-search">Тип
                                                                        зберігання</label>
                                                                    <select class="select2 form-select hide-search"
                                                                            id=""
                                                                            data-placeholder="Виберіть тип зберігання">
                                                                        <option value=""></option>
                                                                        <option value="1">Тип зберігання 1</option>
                                                                        <option value="2">Тип зберігання 2</option>
                                                                        <option value="3">Тип зберігання 3</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <a data-bs-toggle="modal" data-bs-target="#animation"
                                                           class="btn btn-flat-primary  ps-0 pt-0"
                                                           href="{{route('transport.create')}}" style="left: -4px;">
                                                            <img class="plus-icon"
                                                                 src="{{asset('assets/icons/plus-yellow.svg')}}">Добавити
                                                            поверх
                                                        </a>
                                                    </div>

                                                    <div class="tab-pane px-0" id="tabVerticalLeft2" role="tabpanel"
                                                         aria-labelledby="baseVerticalLeft-tab2">
                                                        <div class="mb-1">
                                                            <div class="d-flex align-center justify-content-between">
                                                                <h4 class="fw-bolder mb-0" style="margin-top: 4px;">
                                                                    Поверх 21</h4>

                                                                <div>
                                                                    <a href="">
                                                                        <svg width="30" height="30" viewBox="0 0 30 30"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M9 11.25H21" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path d="M13.5 14.25V18.75" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path d="M16.5 14.25V18.75" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path
                                                                                d="M9.75 11.25L10.5 20.25C10.5 21.0784 11.1716 21.75 12 21.75H18C18.8284 21.75 19.5 21.0784 19.5 20.25L20.25 11.25"
                                                                                stroke="#A8AAAE" stroke-width="1.75"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"/>
                                                                            <path
                                                                                d="M12.75 11.25V9C12.75 8.58579 13.0858 8.25 13.5 8.25H16.5C16.9142 8.25 17.25 8.58579 17.25 9V11.25"
                                                                                stroke="#A8AAAE" stroke-width="1.75"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex mt-1 justify-content-between row mx-0">
                                                                <div class="col-2 col-sm-2 mb-1 px-0"
                                                                     style="flex-basis: max-content; column-gap:20px">
                                                                    <label class="form-label">Кількість комірок </label>
                                                                    <input placeholder="Введіть кількість стелажів"
                                                                           type="number"
                                                                           class="form-control text-truncate" id=""
                                                                           style="width:100%; max-width:140px">
                                                                </div>

                                                                <div
                                                                    class="col-10 col-sm-6 col-md-6 col-lg-6 col-xxl-6 mb-2 flex-grow-1 flex-shrink-1 warehouse-row-width-2 px-0">
                                                                    <label class="form-label"
                                                                           for=" select2-hide-search">Тип
                                                                        зберігання</label>
                                                                    <select class="select2 form-select hide-search"
                                                                            id=""
                                                                            data-placeholder="Виберіть тип зберігання">
                                                                        <option value=""></option>
                                                                        <option value="1">Тип зберігання 1</option>
                                                                        <option value="2">Тип зберігання 2</option>
                                                                        <option value="3">Тип зберігання 3</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="mb-1">
                                                            <div class="d-flex align-center justify-content-between">
                                                                <h4 class="fw-bolder mb-0" style="margin-top: 4px;">
                                                                    Поверх 1</h4>

                                                                <div>
                                                                    <a href="">
                                                                        <svg width="30" height="30" viewBox="0 0 30 30"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M9 11.25H21" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path d="M13.5 14.25V18.75" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path d="M16.5 14.25V18.75" stroke="#A8AAAE"
                                                                                  stroke-width="1.75"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"/>
                                                                            <path
                                                                                d="M9.75 11.25L10.5 20.25C10.5 21.0784 11.1716 21.75 12 21.75H18C18.8284 21.75 19.5 21.0784 19.5 20.25L20.25 11.25"
                                                                                stroke="#A8AAAE" stroke-width="1.75"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"/>
                                                                            <path
                                                                                d="M12.75 11.25V9C12.75 8.58579 13.0858 8.25 13.5 8.25H16.5C16.9142 8.25 17.25 8.58579 17.25 9V11.25"
                                                                                stroke="#A8AAAE" stroke-width="1.75"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex mt-1 justify-content-between row mx-0">
                                                                <div class="col-2 col-sm-2 mb-1 px-0"
                                                                     style="flex-basis: max-content; column-gap:20px">
                                                                    <label class="form-label">Кількість комірок </label>
                                                                    <input placeholder="Введіть кількість стелажів"
                                                                           type="number"
                                                                           class="form-control text-truncate" id=""
                                                                           style="width:100%; max-width:140px">
                                                                </div>

                                                                <div
                                                                    class="col-10 col-sm-6 col-md-6 col-lg-6 col-xxl-6 mb-2 flex-grow-1 flex-shrink-1 warehouse-row-width-2 px-0">
                                                                    <label class="form-label"
                                                                           for=" select2-hide-search">Тип
                                                                        зберігання</label>
                                                                    <select class="select2 form-select hide-search"
                                                                            id=""
                                                                            data-placeholder="Виберіть тип зберігання">
                                                                        <option value=""></option>
                                                                        <option value="1">Тип зберігання 1</option>
                                                                        <option value="2">Тип зберігання 2</option>
                                                                        <option value="3">Тип зберігання 3</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <a data-bs-toggle="modal" data-bs-target="#animation"
                                                           class="btn btn-flat-primary  ps-0 pt-0"
                                                           href="{{route('transport.create')}}" style="left: -4px;">
                                                            <img class="plus-icon"
                                                                 src="{{asset('assets/icons/plus-yellow.svg')}}">Добавити
                                                            поверх
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Vertical Left Tabs ends -->

                            </div>

                            <div class="col-12 mt-1 pt-0">
                                <div class="d-flex float-end" style="column-gap: 30px;">
                                    <button class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати</button>
                                    <button class="btn btn-primary" id="condition_submit">Зберегти</button>
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

    <script src="{{asset('vendors/js/extensions/wNumb.min.js')}}"></script>
    <script src="{{asset('vendors/js/extensions/nouislider.min.js')}}"></script>

    <script src="{{asset('/js/scripts/extensions/ext-component-sliders.js')}}"></script>

    <script src="{{asset('/js/scripts/pages/app-ecommerce-details.js')}}"></script>
    <script src="{{asset('assets/js/entity/location/row/row.js')}}"></script>

@endsection
