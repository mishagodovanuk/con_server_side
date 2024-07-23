<div class="tab-pane active" id="vertical-pill-1" role="tabpanel" aria-labelledby="stacked-pill-1"
    aria-expanded="false">

    <div>

        <div class="card tabs-container-logist" id="table-page">
            <div id="tabs">
                <ul class="d-flex  tabsHeader">
                    <li class="d-flex align-items-center">{{__('local_logist.logist_tab_replenish')}} <span
                            class=" alert alert-primary " style="padding:4px 8px">1</span></li>
                    <li class="d-flex align-items-center"> {{__('local_logist.logist_tab_joint_ftl')}} <span
                            class=" alert alert-primary " style="padding:4px 8px">1</span>
                    </li>
                    <li class="d-flex align-items-center">{{__('local_logist.logist_tab_backhaul')}} <span
                            class=" alert alert-primary " style="padding:4px 8px">1</span></li>
                    <li class="d-flex align-items-center">{{__('local_logist.logist_tab_larger_vehicle')}} <span
                            class=" alert alert-primary " style="padding:4px 8px">1</span></li>
                </ul>
                <div id="t1">
                </div>
                <div id="t2">
                </div>
                <div id="t3">
                </div>
                <div id="t4">
                </div>
                <div id="t5">
                    @include('match.logist.content.tables.logist-table')
                </div>
            </div>

        </div>

        <div class="container-fluid px-2 d-none" id="view-consolid-page">
            <!---->
            <div
                class="d-flex justify-content-between flex-column  flex-sm-column flex-md-row flex-lg-row flex-xxl-row">
                <div class=" pb-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-slash">
                            <li class="breadcrumb-item"><a href="#" style="color: #4B465C;"
                                    id="open-table-page">{{ $breadcrumb_label }}</a></li>

                            <li class="breadcrumb-item fw-bolder active " aria-current="page">
                                {{__('local_logist.log_pending_r_revision_consolidation')}} № <span
                                    class="number-consolid"></span>
                            </li>

                        </ol>
                    </nav>
                </div>
                <div id="actions-review-btns" class="d-none">
                    <button type='button' class="btn btn-flat-danger mr-1  border-0" tabindex="4" data-bs-toggle="modal"
                        data-bs-target="#reject-modal"><i data-feather="trash" class="me-25"></i>
                        {{__('local_logist.logist_bths_reject')}}
                    </button>
                    <button  type='button' class="btn btn-primary" tabindex="4" id="send-to-in-progress-btn">
                        <span
                            class="align-middle d-sm-inline-block">{{__('local_logist.logist_cab_in_progress')}}</span>
                    </button>
                </div>


                <div id="actions-rejected-btns" class="d-none">

                    <button type='button' class="btn btn-primary" tabindex="4" id="return-to-work-btn">
                        <span
                            class="align-middle d-sm-inline-block">{{__('local_logist.logist_btbs_return_to_work')}}</span>
                        </button>
                </div>
            </div>
            <!-- = -->

            <div class="row">
                <div class="col-12 col-xl-6">
                    <!-- перегляд консолідації інфо -->
                    <div class="card p-2 mb-1 pe-0">
                        <div class=" px-0 d-flex gap-1">
                            <h4 class="card-title fw-bolder py-0 ">
                                {{__('local_logist.logist_w_consolidation')}} № <span class="number-consolid"></span>
                            </h4>
                        </div>
                        <div class="" id="block-for-data-planning">


                        </div>
                        <h6 class="fw-5 my-1">{{__('local_logist.logist_w_comment_disp')}}</h6>
                        <div id="block-for-comments"></div>

                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <!-- маршрут -->
                    <div class="card p-2">
                        <div class="pb-2">
                            <h5 class="mb-0">{{__('local_logist.logist_w_route_path')}}</h5>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <p class="fw-5 color-l-gray">{{__('local_logist.logist_w_time')}}<i data-feather="info"
                                        class="ms-25"></i></p>
                            </div>

                            <div class="col-6">
                                <p class="fw-5 color-l-gray">{{__('local_logist.logist_w_way_points')}}</p>
                            </div>
                            <div class="col-4">
                                <p class="fw-5 color-l-gray text-end">{{__('local_logist.logist_w_loading_time')}}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-1" id="block-for-route">


                        </div>

                    </div>
                </div>
            </div>

        </div>


        <!-- modal reject -->
        <div class="modal fade" id="reject-modal" tabindex="-1" aria-labelledby="reject-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 580px">
                <div class="p-4 modal-content">
                    <h2 class=" text-center">{{__('local_logist.log_pending_r_modal_rejected')}}</h2>
                    <p class="mb-2 text-center">{{__('local_logist.log_pending_r_modal_chose')}}</p>

                    <form class="" method="" action="#">
                        <h6 class="fw-5 mb-1">{{__('local_logist.log_pending_r_modal_planning')}}</h6>
                        <div class="form-check  mb-1">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label"
                                for="">{{__('local_logist.log_pending_r_modal_price_increase')}}</label>
                        </div>
                        <div class="form-check  mb-1">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label"
                                for="">{{__('local_logist.log_pending_r_modal_date_mismatch')}} </label>
                        </div>
                        <div class="form-check  mb-1">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label"
                                for="">{{__('local_logist.log_pending_r_modal_no_transport')}}</label>
                        </div>
                        <div class="form-check  mb-1">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label"
                                for="">{{__('local_logist.log_pending_r_modal_incompatible_product')}}</label>
                        </div>
                        <div class="form-check  mb-1">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label"
                                for="">{{__('local_logist.log_pending_r_modal_incompatible_trading')}}</label>
                        </div>
                        <div class="form-check  mb-1">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label"
                                for="">{{__('local_logist.log_pending_r_modal_cargo_dimensions')}}</label>
                        </div>
                        <h6 class="fw-5 mb-1">{{__('local_logist.log_pending_r_modal_participants')}}</h6>
                        <div class="form-check  mb-1">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label"
                                for="">{{__('local_logist.log_pending_r_modal_participant_rejection')}}</label>
                        </div>
                        <div class="form-check  mb-2">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label"
                                for="">{{__('local_logist.log_pending_r_modal_not_respond')}}</label>
                        </div>
                        <div class="form-check  mb-1">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label"
                                for="">{{__('local_logist.log_pending_r_modal_other')}}</label>
                        </div>
                        <textarea class="form-control" id="text-for-comment" rows="3"
                            placeholder="{{__('local_logist.log_pending_r_modal_details_reject')}}"></textarea>
                        <div class="d-flex justify-content-end pt-2">
                            <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                {{__('local_logist.logist_btbs_cancel')}}
                            </a>
                            <button type='button' id="send-to-rejected-btn" class="btn btn-primary">
                                {{__('local_logist.logist_btbs_confirm')}}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>