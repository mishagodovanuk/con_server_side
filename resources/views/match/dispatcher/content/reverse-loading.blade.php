<div class="tab-pane active card mb-0 mt-2" id="vertical-pill-4" role="tabpanel" aria-labelledby="stacked-pill-4" aria-expanded="false">
    <div class="">
        <div class="rv-loading-wizard-container p-2 pb-0">
            <div class="rv-loading-wizard-header">
                <div class="wizard-item">
                    <div class="wizard-num wizard-num-active">1</div>
                    <div class=""><span class="wizard-text wizard-text-active">{{__('localization.rvloading_choose_rv_loading')}}</span>
                    </div>
                </div>
                <div class="wizard-item"><img class="wizard-chevron" src="{{asset('assets/icons/chevron-wizard.svg')}}" alt="chevron"></div>
                <div class="wizard-item">
                    <div class="wizard-num">2</div>
                    <div class=""><span class="wizard-text">{{__('localization.rvloading_choose_consolidation_and_tp')}}</span>
                    </div>
                </div>
            </div>
            <div class="pt-3">
                <div class="" id="rv-loading-empty-list" style="border: 1px solid rgba(219, 218, 222, 1); padding: 20px; height: 265px; border-radius: 6px;">
                    <div class="content-header">
                        <h5 class="mb-0">{{__('localization.rvloading_creating_new_consolidation')}}</h5>
                    </div>
                    <div class="" style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
                        <div class="">
                            <h5 class="text-center">{{__('localization.rvloading_empty_list')}}</h5>
                        </div>
                        <div class="">
                            <p class="text-center">{{__('localization.rvloading_choose_trip')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="card m-0 mt-0 pt-2" id="rv-loading-choose-tp-view">
                    <div class="card-header border row mx-0">
                        <div class="d-flex justify-content-between align-items-center px-0">
                            <h5 class="col-9">{{__('localization.rvloading_applications')}}</h5>
                        </div>
                    </div>
                    <div class="card-grid">

                        <div id="offcanvas-end-example">
                            <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="settingTable" aria-labelledby="settingTableLabel" style="width: 400px; height:min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;" data-bs-scroll="true">
                                <div class="offcanvas-header">
                                    <h4 id="offcanvasEndLabel" class="offcanvas-title">{{__('localization.rvloading_table_settings')}}</h4>
                                    <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas" aria-label="Close" style="list-style: none;"><a class="nav-link nav-link-grid">
                                            <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                                    </li>
                                </div>
                                <div class="offcanvas-body p-0">
                                    <div class="" id="body-wrapper">
                                        <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                            <div class="form-check-label f-15">{{__('localization.rvloading_table_row_height')}}</div>
                                            <div class="form-check form-check-warning form-switch d-flex align-items-center" style="">
                                                <button class="changeMenu-3">
                                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                                <button class="changeMenu-2 active-row-table ">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>

                                            </div>
                                        </div>
                                        <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                            <label class="form-check-label f-15" for="changeFonts">{{__('localization.rvloading_table_bigger_font')}}</label>
                                            <div class="form-check form-check-warning form-switch">
                                                <input type="checkbox" class="form-check-input checkbox" id="changeFonts" />
                                            </div>
                                        </div>
                                        <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                            <label class="form-check-label f-15" for="changeCol">{{__('localization.rvloading_table_change_column')}}</label>
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
                        <div class="table-block" id="rv-transport-planning-table" style="border-top-right-radius: 0;border-top-left-radius: 0;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rv-transport-tp-view p-2">
            <div class="d-flex justify-content-between align-items-center pb-3 px-1">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-slash">
                            <li class="breadcrumb-item" id="choose-rv-loading-view"><a href="#">{{__('localization.rvloading_back_to_rv_loading')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('localization.rvloading_application_view')}} № <span id="tp-rv-loading-view"></span></li>
                        </ol>
                    </nav>
                </div>
                <div class="">
                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light" id="add-to-consolidation-rv"><img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">{{__('localization.rvloading_add_to_consolidation')}}
                    </button>
                </div>
            </div>
            <div class="row justify-content-between px-2">
                <div class="col-6" id="data-plan-rv-container" style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">
                </div>
                <div class="col-6" style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">
                    <div class="pb-2">
                        <h5 class="mb-0">{{__('localization.rvloading_tp_trip')}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <p class="match-light-gray-text">{{__('localization.rvloading_points')}}</p>
                        </div>
                        <div class="col-4">
                            <p class="match-light-gray-text text-end">{{__('localization.rvloading_uploading_zone')}}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-1" id="data-trip-rv-container">
                    </div>
                </div>
            </div>
        </div>
        <div class="rv-loading-items-view p-2 pb-0">
            <div class="rv-loading-wizard-header pb-3">
                <div class="wizard-item">
                    <div class="wizard-num">1</div>
                    <div class=""><span class="wizard-text">{{__('localization.rvloading_choose_rv_loading')}}</span>
                    </div>
                </div>
                <div class="wizard-item"><img class="wizard-chevron" src="{{asset('assets/icons/chevron-wizard.svg')}}" alt="chevron"></div>
                <div class="wizard-item">
                    <div class="wizard-num wizard-num-active">2</div>
                    <div class=""><span class="wizard-text wizard-text-active">{{__('localization.rvloading_choose_consolidation_and_tp')}}</span>
                    </div>
                </div>
            </div>
            <div id="summary-rv-loading" style="display: flex; gap: 20px;">
                <div id="consolidation-list-rv" style="border: 1px solid rgba(219, 218, 222, 1); padding: 20px; border-radius: 6px; display:flex; flex: 5; flex-direction: column">
                    <div class="content-header d-flex justify-content-between align-items-center pb-1">
                        <div class="d-flex gap-1 align-items-center">
                            <div class="">
                                <h5 class="mb-0">{{__('localization.rvloading_creating_new_consolidation')}}</h5>
                            </div>
                            <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px;">
                                <img src="{{asset('assets/icons/users.svg')}}" style="padding-right: 10px;" /><span id="rv-loading-participants"></span>
                            </div>
                            <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px;">
                                <img src="{{asset('assets/icons/box-multiple.svg')}}" style="padding-right: 10px;" /><span id="rv-tp-reserved-container"></span><span>/</span><span id="rv-tp-capacity-container"></span>
                            </div>
                            <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px;">
                                <img src="{{asset('assets/icons/scale-outline.svg')}}" style="padding-right: 10px;" /><span id="rv-tp-weight-container"></span><span>/</span><span style="padding-right: 5px" id="rv-tp-max-weight-container"></span><span>{{__('localization.rvloading_kg')}}</span>
                            </div>
                        </div>
                        <div class="d-flex gap-1">
                            <button type="button" class="btn btn-flat-danger waves-effect d-flex align-items-center" id="rv-loading-delete-btn"><img class="" src="{{asset('assets/icons/trash-red2.svg')}}" style="padding-right: 5px;">{{__('localization.rvloading_delete_all')}}
                            </button>
                        </div>
                    </div>
                    <div class="" style="display: flex; flex-direction: column;">
                        <div class="d-flex gap-1 flex-wrap rv-tn-item-container" id="" style="overflow-x: auto; height: 205px; flex-direction: column;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table with tabs -->
            <div class="col-xl-12 col-lg-12" id="rv-all-consolidation-tables">
                <div class="card-body px-0 py-2 pb-0">
                    <div class="d-flex justify-content-between tp-tables">
                        <div class="transport-planning-table-tabs" id="tabs20">
                            <ul class="d-flex ">
                                <li>{{__('localization.rvloading_all_trips')}} <span class="uploading-tabs">228</span>
                                </li>
                                <li>{{__('localization.rvloading_common_trip')}} <span class="uploading-tabs">22</span>
                                </li>
                                <li>{{__('localization.rvloading_start_point')}} <span class="uploading-tabs">45</span>
                                </li>
                                <li>{{__('localization.rvloading_end_point')}} <span class="uploading-tabs">48</span>
                                </li>
                                {{-- <li>{{__('localization.rvloading_part_of_trip')}} <span--}} {{--class="uploading-tabs">113</span></li>--}} </ul>

                                    <div id="t1">
                                    </div>
                                    <div id="t2">
                                    </div>
                                    <div id="t3">
                                    </div>
                                    {{-- <div id="t4">--}}
                                    {{-- </div>--}}
                                    <div id="t5">
                                        <div class="card-grid">

                                            <div id="offcanvas-end-example">
                                                <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="settingTable-6" aria-labelledby="settingTableLabel" style="width: 400px; height:min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 9999;" data-bs-scroll="true">
                                                    <div class="offcanvas-header">
                                                        <h4 id="offcanvasEndLabel" class="offcanvas-title">
                                                            {{__('localization.rvloading_table_settings')}}
                                                        </h4>
                                                        <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas" aria-label="Close" style="list-style: none;"><a class="nav-link nav-link-grid">
                                                                <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                                                        </li>
                                                    </div>
                                                    <div class="offcanvas-body p-0">
                                                        <div class="" id="body-wrapper">
                                                            <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                                                <div class="form-check-label f-15">{{__('localization.rvloading_table_row_height')}}
                                                                </div>
                                                                <div class="form-check form-check-warning form-switch d-flex align-items-center" style="">
                                                                    <button class="changeMenu-3">
                                                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                    <button class="changeMenu-2 active-row-table">
                                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                                <label class="form-check-label f-15" for="changeFonts-6">{{__('localization.rvloading_table_bigger_font')}}</label>
                                                                <div class="form-check form-check-warning form-switch">
                                                                    <input type="checkbox" class="form-check-input checkbox" id="changeFonts-6" />
                                                                </div>
                                                            </div>
                                                            <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                                <label class="form-check-label f-15" for="changeCol-6">{{__('localization.rvloading_table_change_column')}}</label>
                                                                <div class="form-check form-check-warning form-switch">
                                                                    <input type="checkbox" class="form-check-input checkbox" id="changeCol-6" />
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="d-flex flex-column justify-content-between h-100" id="">
                                                                <div>
                                                                    <div style="float: left;" id="jqxlistbox-6"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-block" id="rv-all-table">
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="rv-loading-tn-view">
            <div class="px-2">
                <div class="d-flex justify-content-between align-items-center pb-3 px-1 pt-2">
                    <div class="">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-slash">
                                <li class="breadcrumb-item" id="choose-rv-loading-view2"><a href="#">{{__('localization.rvloading_back_to_rv_loading')}}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('localization.rvloading_tn_view')}} № <span id="rv-tn-number-container"></span></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light" id="rv-add-new-consolidation-btn"><img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">{{__('localization.rvloading_add_to_consolidation')}}
                        </button>
                    </div>
                </div>
                <div class="row justify-content-between px-2 pb-2">
                    <div class="col-6" id="rv-tn-data-view2" style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">
                    </div>
                    <div class="col-6" style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">
                        <div class="pb-2">
                            <h5 class="mb-0">{{__('localization.rvloading_trip_match')}} № 234409001</h5>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <p class="match-light-gray-text">{{__('localization.rvloading_time')}} <img data-bs-toggle="tooltip" title="The time suggested by the system takes into account the work of the warehouse" src="{{asset('assets/icons/info-circle.svg')}}" />
                                </p>
                            </div>

                            <div class="col-6">
                                <p class="match-light-gray-text">{{__('localization.rvloading_points')}}</p>
                            </div>
                            <div class="col-4">
                                <p class="match-light-gray-text text-end">{{__('localization.rvloading_uploading_time')}}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <div class="row" style="opacity: 0.5;">
                                <div class="col-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <div class="">
                                                <span>08:00</span>
                                            </div>
                                            <div class="">
                                                <span>09:00</span>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class=""><img src="{{asset('assets/icons/timeline-lg.svg')}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class=""><span class="fw-semibold">Chernivtsi (Loading)</span>
                                    </div>
                                    <div class="">
                                        <span>2, Promyslova St., Chernivtsi</span>
                                    </div>
                                    <div class=""><span>07.11.2023 08:00-09:00</span></div>
                                </div>
                                <div class="col-4">
                                    <p class="text-end match-light-gray-text">60 min</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <div class="">
                                                <span>20:00</span>
                                            </div>
                                            <div class="">
                                                <span>20:20</span>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class=""><img src="{{asset('assets/icons/timeline-lg.svg')}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class=""><span class="fw-semibold">Odesa (Unloading)</span>
                                    </div>
                                    <div class=""><span>45, Pasichna St., Odesa</span></div>
                                    <div class=""><span>07.11.2023 20:00-20:20</span></div>
                                </div>
                                <div class="col-4">
                                    <p class="text-end" style="color: #EA5455;">20 min</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <div class="">
                                                <span>21:00</span>
                                            </div>
                                            <div class="">
                                                <span>22:00</span>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class=""><img src="{{asset('assets/icons/timeline-lg.svg')}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class=""><span class="fw-semibold">Odesa (Loading)</span>
                                    </div>
                                    <div class=""><span>112, Sportyvna St., Odesa</span></div>
                                    <div class=""><span>07.11.2023 21:00-22:00</span></div>
                                </div>
                                <div class="col-4">
                                    <p class="text-end" style="color: #EA5455;">60 min</p>
                                </div>
                            </div>
                            <div class="row" style="opacity: 0.5;">
                                <div class="col-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <div class="">
                                                <span>23:00</span>
                                            </div>
                                            <div class="">
                                                <span>23:20</span>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class=""><img src="{{asset('assets/icons/points.svg')}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class=""><span class="fw-semibold">Vinnytsia (Unloading)</span>
                                    </div>
                                    <div class=""><span>22, Shevchenka St., Vinnytsia</span></div>
                                    <div class=""><span>07.11.2023 23:00-23:20</span></div>
                                </div>
                                <div class="col-4">
                                    <p class="text-end match-light-gray-text">20 min</p>
                                </div>
                            </div>
                        </div>

                        <div class=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-size-lg d-inline-block">
        <!-- Modal -->
        <div class="modal fade text-start" id="rv-large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content px-2">
                    <div class="modal-header pt-2">
                        <h4 class="modal-title" id="myModalLabel17">{{__('localization.rvloading_creating_consolidation')}} № 5431234</h4>
                        <img data-bs-dismiss="modal" aria-label="Close" src="{{asset('assets/icons/close-button.svg')}}" alt="" style="cursor: pointer;">
                    </div>
                    <div class="modal-body" id="match-modals-rv-loading">
                        <div class="" id="tabs8" style="border: none;">
                            <ul class="">
                                <li>{{__('localization.rvloading_general_info')}}</li>
                                <li>{{__('localization.rvloading_tn_list')}}</li>
                                <li>{{__('localization.rvloading_trip_detail')}}</li>
                                <li>Costs and calculations</li>
                            </ul>
                            <div class="">
                                <div class="pt-2" id="rv-loading-modal-info" style="min-height: fit-content;">
                                </div>
                                <div class="w-100 pb-1 pt-2">
                                    <div class="d-flex align-items-center gap-1" style="padding: 12px 14px; background: rgba(255, 159, 67, 0.16); border-radius: 6px;">
                                        <img src="{{asset('assets/icons/time-icon.svg')}}" alt=""><span style="color: #FF9F43;">{{__('localization.rvloading_delay')}} (+3{{__('localization.rvloading_hour')}})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2">
                                <div class="d-flex flex-column gap-1">
                                    <div class="row px-1 py-2" style="background-color: rgba(168, 170, 174, 0.08); border-radius: 6px;">
                                        <div class="col-1 text-center">1</div>
                                        <div class="col-11">
                                            <div class="d-flex flex-column" style="gap: 10px;">
                                                <div class="">
                                                    <span class="match-modals-text-color"><span class="match-yellow-text pe-1">№ <span id="rv-tp-item-number"></span></span> {{__('localization.rvloading_pallets')}} <span class="" style="font-weight: 500;"><span id="rv-tp-item-pallets"></span> (<span id="rv-tp-item-weight"></span>{{__('localization.rvloading_kg')}})</span></span>
                                                </div>
                                                <div class="">
                                                    <span class="match-modals-text-color">{{__('localization.rvloading_supplier')}} <span class="" style="font-weight: 500;" id="rv-tp-item-supplier"></span></span>
                                                </div>
                                                <div class="">
                                                    <span class="match-modals-text-color">{{__('localization.rvloading_uploading_warehouse')}} <span class="" style="font-weight: 500;" id="rv-tp-item-uploading"></span></span>
                                                </div>
                                                <div class="">
                                                    <span class="match-modals-text-color">{{__('localization.rvloading_customer')}} <span class="" style="font-weight: 500;" id="rv-tp-item-customer"></span></span>
                                                </div>
                                                <div class="">
                                                    <span class="match-modals-text-color">{{__('localization.rvloading_offloading_warehouse')}} <span class="" style="font-weight: 500;" id="rv-tp-item-offloading"></span></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-1" id="rv-loading-modal-tn-list"></div>
                                </div>
                                <div class="w-100 pb-1 pt-2">
                                    <div class="d-flex align-items-center gap-1" style="padding: 12px 14px; background: rgba(255, 159, 67, 0.16); border-radius: 6px;">
                                        <img src="{{asset('assets/icons/time-icon.svg')}}" alt=""><span style="color: #FF9F43;">{{__('localization.rvloading_delay')}} (+3{{__('localization.rvloading_hour')}})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="row pt-2 pb-1">
                                    <div class="col-2">
                                        <p class="match-light-gray-text">{{__('localization.rvloading_time')}} <img data-bs-toggle="tooltip" title="The time suggested by the system takes into account the work of the warehouse" src="{{asset('assets/icons/info-circle.svg')}}" />
                                        </p>
                                    </div>

                                    <div class="col-6">
                                        <p class="match-light-gray-text">{{__('localization.rvloading_points')}}</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="match-light-gray-text text-end">{{__('localization.rvloading_uploading_time')}}</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <div class="">
                                                        <span class="match-modals-text-color">08:00</span>
                                                    </div>
                                                    <div class="">
                                                        <span class="match-modals-text-color">09:00</span>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class=""><img src="{{asset('assets/icons/timeline-lg.svg')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex flex-column" style="gap: 10px;">
                                            <div class=""><span class="match-modals-text-color" style="font-weight: 500;">Chernivtsi (Loading)</span>
                                            </div>
                                            <div class=""><span class="match-modals-text-color">2, Promyslova St., Chernivtsi</span>
                                            </div>
                                            <div class=""><span class="match-modals-text-color">07.11.2023 08:00-09:00</span></div>
                                            <div class="d-flex" style="gap: 10px;">
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/users.svg')}}" /><span class="match-light-gray-text">1</span>
                                                </div>
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/box-multiple.svg')}}" /><span class="match-light-gray-text">25/33</span>
                                                </div>
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/scale-outline.svg')}}" /><span class="match-light-gray-text">15000/20000 kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <p class="match-light-gray-text text-end">60 min</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <div class="">
                                                        <span class="match-modals-text-color">20:00</span>
                                                    </div>
                                                    <div class="">
                                                        <span class="match-modals-text-color">20:20</span>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class=""><img src="{{asset('assets/icons/timeline-lg.svg')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex flex-column" style="gap: 10px;">
                                            <div class=""><span class="match-modals-text-color" style="font-weight: 500;">Odesa (Unloading)</span>
                                            </div>
                                            <div class=""><span class="match-modals-text-color">45, Pasichna St., Odesa</span>
                                            </div>
                                            <div class=""><span class="match-modals-text-color">07.11.2023 20:00-20:20</span></div>
                                            <div class="d-flex" style="gap: 10px;">
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/users.svg')}}" /><span class="match-light-gray-text">0</span>
                                                </div>
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/box-multiple.svg')}}" /><span class="match-light-gray-text">0/33</span>
                                                </div>
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/scale-outline.svg')}}" /><span class="match-light-gray-text">/20000 kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <p class="match-light-gray-text text-end">20 min</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <div class="">
                                                        <span class="match-modals-text-color">21:00</span>
                                                    </div>
                                                    <div class="">
                                                        <span class="match-modals-text-color">22:00</span>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class=""><img src="{{asset('assets/icons/timeline-lg.svg')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex flex-column" style="gap: 10px;">
                                            <div class=""><span class="match-modals-text-color" style="font-weight: 500;">Odesa (Loading)</span>
                                            </div>
                                            <div class=""><span class="match-modals-text-color">112, Sportyvna St., Odesa</span>
                                            </div>
                                            <div class=""><span class="match-modals-text-color">07.11.2023 21:00-22:00</span></div>
                                            <div class="d-flex" style="gap: 10px;">
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/users.svg')}}" /><span class="match-light-gray-text">1</span>
                                                </div>
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/box-multiple.svg')}}" /><span class="match-light-gray-text">4/33</span>
                                                </div>
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/scale-outline.svg')}}" /><span class="match-light-gray-text">4000/20000 kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <p class="match-light-gray-text text-end">60 min</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <div class="">
                                                        <span class="match-modals-text-color">23:00</span>
                                                    </div>
                                                    <div class="">
                                                        <span class="match-modals-text-color">23:20</span>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class=""><img src="{{asset('assets/icons/timeline.svg')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex flex-column" style="gap: 10px;">
                                            <div class=""><span class="match-modals-text-color" style="font-weight: 500;">Vinnytsia (Unloading)</span>
                                            </div>
                                            <div class=""><span class="match-modals-text-color">22, Shevchenka St., Vinnytsia</span>
                                            </div>
                                            <div class=""><span class="match-modals-text-color">07.11.2023 23:00-23:20</span></div>
                                            <div class="d-flex" style="gap: 10px;">
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/users.svg')}}" /><span class="match-light-gray-text">0</span>
                                                </div>
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/box-multiple.svg')}}" /><span class="match-light-gray-text">0/33</span>
                                                </div>
                                                <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
                                                    <img src="{{asset('assets/icons/scale-outline.svg')}}" /><span class="match-light-gray-text">0/20000 kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <p class="match-light-gray-text text-end">20 min</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="w-100 pb-1 pt-2">
                                    <div class="d-flex align-items-center gap-1" style="padding: 12px 14px; background: rgba(255, 159, 67, 0.16); border-radius: 6px;">
                                        <img src="{{asset('assets/icons/time-icon.svg')}}" alt=""><span style="color: #FF9F43;">{{__('localization.rvloading_delay')}} (+3{{__('localization.rvloading_hour')}})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="pt-2">
                                    <div class="pb-2" style="width: 60%;">
                                        <div class="">
                                            <p class="match-total-heading">Total cost of the route</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                <p class="match-total-title">Price per route:</p>
                                                <p class="match-total-text">Cost without consolidation:</p>
                                                <p class="match-total-text">Cost with consolidation:</p>
                                                <p class="match-total-text">Reduction:</p>
                                            </div>
                                            <div class="col-5 text-end">
                                                <p class="match-total-title">26 000 UAH</p>
                                                <p class="match-total-text">30 500 UAH</p>
                                                <p class="match-total-text">26 000 UAH</p>
                                                <p class="match-total-text"><span style="background-color: rgba(40, 199, 111, 0.2); padding: 4px 10px; border-radius: 6px; color: rgba(40, 199, 111, 1); font-weight: 600">-10%</span>
                                                    4 500 UAH</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pb-2" style="width: 60%;">
                                        <div class="">
                                            <p class="match-total-heading">The cost of the route for each
                                                participant</p>
                                        </div>
                                        <div class="row pb-1">
                                            <div class="col-7">
                                                <p class="match-total-title">1. LLC "Novus"</p>
                                                <p class="match-total-text">Cost without consolidation:</p>
                                                <p class="match-total-text">Cost with consolidation:</p>
                                                <p class="match-total-text">Reduction:</p>
                                            </div>
                                            <div class="col-5 text-end">
                                                <p class="match-total-title">10 000 UAH</p>
                                                <p class="match-total-text">12 000 UAH</p>
                                                <p class="match-total-text">10 000 UAH</p>
                                                <p class="match-total-text"><span style="background-color: rgba(40, 199, 111, 0.2); padding: 4px 10px; border-radius: 6px; color: rgba(40, 199, 111, 1); font-weight: 600">-10%</span>
                                                    2 000 UAH</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                <p class="match-total-title">2. Yarych LLC</p>
                                                <p class="match-total-text">Price of a 3PL operator:</p>
                                                <p class="match-total-text">Price at consolidation:</p>
                                                <p class="match-total-text">Reduction:</p>
                                            </div>
                                            <div class="col-5 text-end">
                                                <p class="match-total-title">10 000 UAH</p>
                                                <p class="match-total-text">12 000 UAH</p>
                                                <p class="match-total-text">10 000 UAH</p>
                                                <p class="match-total-text"><span style="background-color: rgba(40, 199, 111, 0.2); padding: 4px 10px; border-radius: 6px; color: rgba(40, 199, 111, 1); font-weight: 600">-10%</span>
                                                    2 000 UAH</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 pb-1">
                                    <div class="d-flex align-items-center gap-1" style="padding: 12px 14px; background: rgba(168, 170, 174, 0.2); border-radius: 6px;">
                                        <img src="{{asset('assets/icons/info-square2.svg')}}" alt=""><span style="color: rgba(168, 170, 174, 1);">These calculations are exclusive of additional carrier costs.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="" id="rv-added-consolidation-view" style="display: flex; height: 40vh; justify-content: center; align-items: center;">
                            <div class="d-flex flex-column">
                                <h4 class="text-center">{{__('localization.rvloading_consolidation')}} №
                                    237000124 {{__('localization.rvloading_created_successful')}}</h4>
                                <p class="text-center">{{__('localization.rvloading_you_can_find_it')}} - <a style="color: #D9B414;">{{__('localization.rvloading_created')}}</a></p>
                                <div class="d-flex justify-content-center gap-1 pt-2">
                                    <button type="button" data-bs-dismiss="modal" class="btn btn-outline-danger waves-effect" id="rv-cancel-consolidation-button">
                                        {{__('localization.rvloading_cancel_consolidation')}}
                                    </button>
                                    <button type="button" data-bs-dismiss="modal" class="btn btn-primary waves-effect waves-float waves-light" id="rv-continue-working-button">{{__('localization.rvloading_continue_working')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-rv pb-2 px-1" style="border-top: none;">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="">
                                <button type="button" data-bs-dismiss="modal" class="btn btn-flat-danger waves-effect d-flex align-items-center" id="rv-delete-all-modal-button"><img class="" src="{{asset('assets/icons/trash-red2.svg')}}" style="padding-right: 5px;">{{__('localization.rvloading_delete_all')}}
                                </button>
                            </div>
                            <div class="d-flex gap-1">
                                <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary waves-effect">
                                    {{__('localization.rvloading_draft')}}
                                </button>
                                <button type="button" class="btn btn-primary waves-effect waves-float waves-light d-flex align-items-center" id="rv-consolidation-button"><img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">{{__('localization.rvloading_create_consolidation')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>