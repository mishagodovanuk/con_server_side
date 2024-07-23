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
        <div style="margin-top: 253px">
            <div class="empty-company text-center">
                Додайте сектор складу
            </div>
            <div class="empty-company-title empty-company-title-m text-center mt-1">
                Додайте сектор складу в якому будуть знаходитись ряди з комірками
            </div>
            <div class="text-center mt-2">
                <a data-bs-toggle="modal" data-bs-target="#animation" class="btn btn-primary"
                   href="{{route('transport.create')}}">
                    <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">Додати сектор
                </a>
            </div>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal text-start" id="animation" tabindex="-1" aria-labelledby="myModalLabel6" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pt-4">
                </div>
                <div class="card popup-card">
                    <div class="popup-header">
                        Створення сектору
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row">

                            <div class="col-12 col-sm-12 mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label">Колір сектору</label>
                                    <div class="d-flex">
                                        <div class="form-check form-check-primary">
                                            <input type="radio" id="customColorRadio1" name="customColorRadio"
                                                   class="form-check-input"/>
                                        </div>
                                        <div class="form-check form-check-secondary">
                                            <input type="radio" id="customColorRadio2" name="customColorRadio"
                                                   class="form-check-input"/>
                                        </div>
                                        <div class="form-check form-check-success">
                                            <input type="radio" id="customColorRadio3" name="customColorRadio"
                                                   class="form-check-input"/>
                                        </div>
                                        <div class="form-check form-check-danger">
                                            <input type="radio" id="customColorRadio5" name="customColorRadio"
                                                   class="form-check-input"/>
                                        </div>
                                        <div class="form-check form-check-warning">
                                            <input type="radio" id="customColorRadio4" name="customColorRadio"
                                                   class="form-check-input"/>
                                        </div>
                                        <div class="form-check form-check-info">
                                            <input type="radio" id="customRadio6" name="customColorRadio"
                                                   class="form-check-input"/>
                                        </div>
                                        <div class="form-check form-check-info">
                                            <input type="radio" id="customRadio7" name="customColorRadio"
                                                   class="form-check-input"/>
                                        </div>
                                        <div class="form-check form-check-info">
                                            <input type="radio" id="customRadio8" name="customColorRadio"
                                                   class="form-check-input"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label">Символ</label>
                                <input placeholder="Виберіть любий символ" type="text" class="form-control" id="">
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label" for="condition_name select2-hide-search">Тип нумерації</label>
                                <select class="select2 form-select hide-search" id="condition_name"
                                        data-placeholder="Виберіть тип нумерації">
                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>

                            <div class="d-flex flex-row align-items-center">
                                <div class="form-check form-switch form-check-warning">
                                    <input type="checkbox" class="form-check-input checkbox"
                                           id="checkbox-1 customSwitch1" value="checkbox-1-block"/>
                                    <label class="form-check-label" for="checkbox-1 customSwitch1">
                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                    </label>
                                </div>
                                <label class="form-check-label" for="customSwitch1">Температурний режим</label>
                            </div>
                            <div class="col-12 mb-1 mt-3" id="checkbox-1-block" style="display: none;">
                                <div id="slider-1" class="slider-warning mt-md-1 mt-3 mb-4"></div>
                            </div>

                            <div class="d-flex flex-row align-items-center mt-2">
                                <div class="form-check form-switch form-check-warning">
                                    <input type="checkbox" class="form-check-input checkbox"
                                           id="checkbox-2 customSwitch2" value="checkbox-2-block"/>
                                    <label class="form-check-label" for="checkbox-2 customSwitch2">
                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                    </label>
                                    <label class="form-check-label" for="customSwitch2">Вологість</label>

                                </div>
                            </div>
                            <div class="col-12 mb-1 mt-3" id="checkbox-2-block" style="display: none;">
                                <div id="slider-2" class="slider-warning  mt-md-1 mt-3 mb-4"></div>
                            </div>

                            <a download class="mt-2" href="">Завантажити мапу сектора</a>

                            <div class="col-12 mt-1">
                                <div class="d-flex float-end">
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

    <script src="{{asset('assets/js/utils/initSliderModal.js')}}"></script>
    <script src="{{asset('assets/js/entity/location/sector/sector.js')}}"></script>

@endsection
