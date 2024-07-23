<div class="tab-pane card mb-0 active mt-2" id="vertical-pill-2" role="tabpanel" aria-labelledby="stacked-pill-2" aria-expanded="false">
    <div class="">
        <section class="modern-horizontal-wizard">
            <div class="bs-stepper wizard-modern modern-wizard-example">
                <div class="bs-stepper-header" id="main-wizard">
                    <div class="step" data-target="#account-details-modern" role="tab" id="account-details-modern-trigger">
                        <button type="button" class="step-trigger" id="wizard-button-1" disabled style="opacity: 1;">
                            <span class="bs-stepper-box">
                                1
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">{{ $wizard_step_1 }}</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i data-feather="chevron-right" class="font-medium-2"></i>
                    </div>
                    <div class="step" data-target="#personal-info-modern" role="tab" id="personal-info-modern-trigger">
                        <button type="button" class="step-trigger" id="wizard-button-2" disabled style="opacity: 1;">
                            <span class="bs-stepper-box">
                                2
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">{{ $wizard_step_2 }}</span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content" style="box-shadow: none;">
                    <div id="account-details-modern" class="content" role="tabpanel" aria-labelledby="account-details-modern-trigger">
                        <div class="">
                            <div class="" id="consolidation-list" style="border: 1px solid rgba(219, 218, 222, 1); padding: 20px; height: 265px; border-radius: 6px;">
                                <div class="content-header">
                                    <h5 class="mb-0">{{__('localization.uploading_create_new_consolidation')}}</h5>
                                </div>
                                <div class="" style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
                                    <div class="">
                                        <h5 class="text-center">{{__('localization.uploading_empty_list')}}</h5>
                                    </div>
                                    <div class="">
                                        <p class="text-center">{{__('localization.uploading_choose_trip_from_list')}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Created consolidation toast -->
                        <div class="toast-container">
                            <div class="toast basic-toast position-fixed top-0 end-0 m-2" id="consolidation-toast" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: #ffffff; width: 420px">
                                <div class="toast-body" style="font-size: 13px;">
                                    <div class="row">
                                        <div class="col-1"><img class="plus-icon" src="{{asset('assets/icons/green-check.svg')}}"></div>
                                        <div class="col-9">
                                            <h4 style="font-size: 16px;">Консолідацію створено успішно</h4>
                                            <p>Консолідацію <b>№ <span id="consolidation-number"></span></b> було успішно створено. Щоб переглянути її, перейдіть на вкладку "Консолідації" -> "Створені".</p>
                                            <a href="/match/dispatcher/consolidation/created"><button class="btn btn-primary">Переглянути консолідацію</button></a>
                                        </div>
                                        <div class="col-1"><button type="button" class="ms-1 btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Created consolidation toast end -->

                        <!-- Created consolidation draft toast -->
                        <div class="toast-container">
                            <div class="toast basic-toast position-fixed top-0 end-0 m-2" id="draft-consolidation-toast" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: #ffffff; width: 420px">
                                <div class="toast-body" style="font-size: 13px;">
                                    <div class="row">
                                        <div class="col-1"><img class="plus-icon" src="{{asset('assets/icons/green-check.svg')}}"></div>
                                        <div class="col-9">
                                            <h4 style="font-size: 16px;">Чернетку створено</h4>
                                            <p>Консолідацію <b>№ <span id="draft-consolidation-number"></span></b> було додано до чернеток. Щоб переглянути її, перейдіть на вкладку "Консолідації" -> "Чернетки".</p>
                                            <a href="/match/dispatcher/consolidation/draft"><button class="btn btn-primary">Переглянути чернетку</button></a>
                                        </div>
                                        <div class="col-1"><button type="button" class="ms-1 btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Created consolidation toast end -->

                        <div class="card m-0 mt-0 mt-2" id="choose-tp-view">
                            <div class="card-header border row mx-0">
                                <div class="d-flex justify-content-between align-items-center px-0">
                                    <h5 class="col-9">{{__('localization.uploading_tp_need_upload')}}</h5>
                                </div>
                            </div>

                            @include('match.dispatcher.content.tables.transport-planning')

                        </div>

                        <div class="px-2" id="tp-view-container">
                            <div class="d-flex justify-content-between align-items-center pb-3">
                                <div class="">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-slash">
                                            <li class="breadcrumb-item" id="to-main-page-from-tp"><a href="#">{{ $breadcrumb_label }}</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                {{__('localization.uploading_tp_view')}} № <span id="tp-number-span"></span>
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light" id="add-tp-to-consolidation"><img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">{{__('localization.uploading_add_to_consolidation')}}
                                    </button>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-6" id="data-plan-container" style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">

                                </div>
                                <div class="col-6" style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">
                                    <div class="pb-2">
                                        <h5 class="mb-0">{{__('localization.uploading_tp_way')}}</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <p class="match-light-gray-text">{{__('localization.uploading_time')}} <img data-bs-toggle="tooltip" title="The time suggested by the system takes into account the work of the warehouse" src="{{asset('assets/icons/info-circle.svg')}}" />
                                            </p>
                                        </div>

                                        <div class="col-6">
                                            <p class="match-light-gray-text">{{__('localization.uploading_points')}}</p>
                                        </div>
                                        <div class="col-4">
                                            <p class="match-light-gray-text text-end">
                                                {{__('localization.uploading_upload_time')}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-1" id="data-trip-container">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="personal-info-modern" class="content" role="tabpanel" aria-labelledby="personal-info-modern-trigger">
                        <div id="summary" style="display: flex; gap: 20px;">
                            <div class="" id="consolidation-list" style="border: 1px solid rgba(219, 218, 222, 1); padding: 20px; border-radius: 6px; display:flex; flex: 5; flex-direction: column">
                                <div class="content-header d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-1 align-items-center">
                                        <div class="">
                                            <h5 class="mb-0">{{__('localization.uploading_create_new_consolidation')}}
                                            </h5>
                                        </div>
                                        <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px;">
                                            <img src="{{asset('assets/icons/users.svg')}}" style="padding-right: 10px;" /><span id="total-participants"></span>
                                        </div>
                                        <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px;">
                                            <img src="{{asset('assets/icons/box-multiple.svg')}}" style="padding-right: 10px;" /><span id="tp-reserved-container"></span><span>/</span><span id="tp-capacity-container"></span>
                                        </div>
                                        <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px;">
                                            <img src="{{asset('assets/icons/scale-outline.svg')}}" style="padding-right: 10px;" /><span id="tp-weight-container"></span>/<span id="tp-weight-capacity-container" style="padding-right: 5px"></span><span>{{__('localization.uploading_kg')}}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-flat-danger waves-effect d-flex align-items-center" id="uploading-delete-btn"><img class="" src="{{asset('assets/icons/trash-red2.svg')}}" style="padding-right: 5px;">{{__('localization.uploading_delete_all')}}
                                        </button>
                                    </div>
                                </div>
                                <div class="" style="display: flex; flex-direction: column;">
                                    <div class="d-flex gap-1 flex-wrap tn-item-container" id="" style="overflow-x: auto; height: 210px; flex-direction: column; align-content: flex-start;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table with tabs -->
                        <div class="col-xl-12 col-lg-12" id="all-consolidation-tables">
                            <div class="card-body px-0 py-2 pb-0">
                                <div class="d-flex justify-content-between tp-tables">

                                    <div class="transport-planning-table-tabs" id="tabs">
                                        <ul class="d-flex">
                                            <li data-type="all">{{__('localization.uploading_common_all_trips')}} <span class="uploading-tabs" id="uploading_all_count">228</span></li>
                                            <li data-type="common_trip">{{__('localization.uploading_common_trip')}}
                                                <span class="uploading-tabs" id="uploading_common_trip_count">22</span>
                                            </li>
                                            <li data-type="start_point">
                                                {{__('localization.uploading_common_start_point')}} <span class="uploading-tabs" id="uploading_start_point_count">45</span>
                                            </li>
                                            <li data-type="end_point">{{__('localization.uploading_common_end_point')}}
                                                <span class="uploading-tabs" id="uploading_end_point_count">48</span>
                                            </li>
                                            {{-- <li>{{__('localization.uploading_common_part_of_trip')}} <span--}} {{--                                                    class="uploading-tabs">113</span></li>--}} </ul>
                                                <div id="t1">
                                                </div>
                                                <div id="t2">
                                                </div>
                                                <div id="t3">
                                                </div>
                                                {{-- <div id="t4">--}}
                                                {{-- </div>--}}
                                                <div id="t5">

                                                    @include('match.dispatcher.content.tables.goods-invoices')

                                                </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="add-new-consolidation-view">
                            <div class="px-2" id="tp-view-container2">
                                <div class="d-flex justify-content-between align-items-center pb-3">
                                    <div class="">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb breadcrumb-slash">
                                                <li class="breadcrumb-item" id="to-main-page-from-tn"><a href="#">{{ $breadcrumb_label }}</a>
                                                </li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    {{__('localization.uploading_tn_view')}} № <span id="tn-number-span"></span>
                                                </li>
                                            </ol>
                                        </nav>
                                    </div>
                                    <div class="">
                                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light" id="add-tn-to-consolidation"><img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">{{__('localization.uploading_add_to_consolidation')}}
                                        </button>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6" id="tn-data-view2" style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">
                                    </div>
                                    <div class="col-6" style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">
                                        <div class="pb-2">
                                            <h5 class="mb-0">{{__('localization.uploading_trip_match')}} №
                                                <span id="tp-tn-match"></span>
                                            </h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <p class="match-light-gray-text">{{__('localization.uploading_time')}}
                                                    <img data-bs-toggle="tooltip" title="The time suggested by the system takes into account the work of the warehouse" src="{{asset('assets/icons/info-circle.svg')}}" />
                                                </p>
                                            </div>

                                            <div class="col-6">
                                                <p class="match-light-gray-text">{{__('localization.uploading_points')}}
                                                </p>
                                            </div>
                                            <div class="col-4">
                                                <p class="match-light-gray-text text-end">
                                                    {{__('localization.uploading_upload_time')}}
                                                </p>
                                            </div>
                                        </div>
                                        <div id="data-match-trip-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="modal-size-lg d-inline-block">
    <!-- Modal -->
    <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content px-2">
                <div class="modal-header pt-2">
                    <h4 class="modal-title" id="myModalLabel17">{{__('localization.uploading_creating_consolidation')}}</h4>
                    <img data-bs-dismiss="modal" aria-label="Close" src="{{asset('assets/icons/close-button.svg')}}" alt="" style="cursor: pointer;">
                </div>
                <div class="modal-body" id="match-modals">
                    <div class="" id="tabs2" style="border: none;">
                        <ul class="">
                            <li>{{__('localization.uploading_general_information')}}</li>
                            <li>{{__('localization.uploading_tn_list')}}</li>
                            <li>{{__('localization.uploading_trip_details')}}</li>
                            <li>Costs and calculations</li>
                        </ul>
                        <div class="pt-2" style="overflow: hidden;">
                            <div class="pb-1" id="upload-modal-info"></div>
                            <div class="w-100 pt-1">
                                <div class="d-flex align-items-center gap-1" style="padding: 12px 14px; background: rgba(255, 159, 67, 0.16); border-radius: 6px;">
                                    <img src="{{asset('assets/icons/time-icon.svg')}}" alt=""><span style="color: #FF9F43;">{{__('localization.uploading_time_delay')}}
                                        (+3{{__('localization.uploading_hour')}})</span>
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
                                                <span class="match-modals-text-color"><span class="match-yellow-text pe-1">№ <span id="tp-item-number"></span></span>
                                                    {{__('localization.uploading_pallets')}}: <span class="" style="font-weight: 500;"><span id="tp-item-pallets"></span>
                                                        (<span id="tp-item-weight"></span>{{__('localization.uploading_kg')}})</span></span>
                                            </div>
                                            <div class="">
                                                <span class="match-modals-text-color">{{__('localization.uploading_supplier')}}:
                                                    <span class="" style="font-weight: 500;" id="tp-item-supplier"></span></span>
                                            </div>
                                            <div class="">
                                                <span class="match-modals-text-color">{{__('localization.uploading_warehouse_upload')}}:
                                                    <span class="" style="font-weight: 500;" id="tp-item-uploading"></span></span>
                                            </div>
                                            <div class="">
                                                <span class="match-modals-text-color">{{__('localization.uploading_customer')}}:
                                                    <span class="" style="font-weight: 500;" id="tp-item-customer"></span></span>
                                            </div>
                                            <div class="">
                                                <span class="match-modals-text-color">{{__('localization.uploading_warehouse_offload')}}:
                                                    <span class="" style="font-weight: 500;" id="tp-item-offloading"></span></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-1" id="upload-modal-tn-list"></div>
                                <div class="w-100 pt-1">
                                    <div class="d-flex align-items-center gap-1" style="padding: 12px 14px; background: rgba(255, 159, 67, 0.16); border-radius: 6px;">
                                        <img src="{{asset('assets/icons/time-icon.svg')}}" alt=""><span style="color: #FF9F43;">{{__('localization.uploading_time_delay')}}
                                            (+3{{__('localization.uploading_hour')}})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="" style="overflow: hidden;">
                            <div class="row pt-2 pb-1">
                                <div class="col-2">
                                    <p class="match-light-gray-text">{{__('localization.uploading_time')}} <img data-bs-toggle="tooltip" title="The time suggested by the system takes into account the work of the warehouse" src="{{asset('assets/icons/info-circle.svg')}}" />
                                    </p>
                                </div>

                                <div class="col-6">
                                    <p class="match-light-gray-text">{{__('localization.uploading_points')}}</p>
                                </div>
                                <div class="col-4">
                                    <p class="match-light-gray-text text-end">
                                        {{__('localization.uploading_upload_time')}}
                                    </p>
                                </div>
                            </div>
                            <div id="modal-all-routes"></div>

                            <div class="w-100 pt-2">
                                <div class="d-flex align-items-center gap-1" style="padding: 12px 14px; background: rgba(255, 159, 67, 0.16); border-radius: 6px;">
                                    <img src="{{asset('assets/icons/time-icon.svg')}}" alt=""><span style="color: #FF9F43;">{{__('localization.uploading_time_delay')}}
                                        (+3{{__('localization.uploading_hour')}})</span>
                                </div>
                            </div>
                        </div>
                        <div class="" style="overflow: hidden;">
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
                                        <p class="match-total-heading">The cost of the route for each participant</p>
                                    </div>
                                    <div class="row pb-1">
                                        <div class="col-7">
                                            <p class="match-total-title">1. LLC "Auchan"</p>
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
                                            <p class="match-total-title">2. LLC “Silpo”</p>
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
                                    <img src="{{asset('assets/icons/info-square2.svg')}}" alt=""><span style="color: rgba(168, 170, 174, 1);">These calculations are exclusive of
                                        additional carrier costs.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="" id="added-consolidation-view" style="display: flex; height: 40vh; justify-content: center; align-items: center;">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="text-center">{{__('localization.uploading_consolidation')}}</h4>
                            <p class="text-center">{{__('localization.uploading_you_can_find_it')}}
                            </p>
                            <div class="d-flex justify-content-center gap-1 pt-2">
                                <button type="button" data-bs-dismiss="modal" class="btn btn-flat-secondary waves-effect" id="cancel-consolidation-button">
                                    {{__('localization.uploading_cancel_consolidation')}}
                                </button>
                                <button type="button" data-bs-dismiss="modal" class="btn btn-primary waves-effect waves-float waves-light" id="confirm-consolidation-btn">{{__('localization.uploading_continue_working')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-2" style="border-top: none;">
                    <div class="d-flex w-100 justify-content-between">
                        <div class="">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-flat-danger waves-effect d-flex align-items-center" id="delete-all-modal-button"><img class="" src="{{asset('assets/icons/trash-red2.svg')}}" style="padding-right: 5px;">{{__('localization.uploading_delete_all')}}
                            </button>
                        </div>
                        <div class="d-flex gap-1">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary waves-effect" id="draft-create-consolidation">
                                {{__('localization.uploading_draft')}}
                            </button>
                            <button type="button" class="btn btn-primary waves-effect waves-float waves-light d-flex align-items-center" id="create-consolidation-btn"><img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">{{__('localization.uploading_create_consolidation')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>