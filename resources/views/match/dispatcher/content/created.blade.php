<div class="tab-pane active card mb-0" id="vertical-pill-5" role="tabpanel" aria-labelledby="stacked-pill-5"
    aria-expanded="false">
    <div class="px-2">
        <div class="created-consolidation-list">
            <div class="pt-2 pb-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item" id=""><a href="#">{{__('localization.created_dispatcher')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb_label }}</li>
                    </ol>
                </nav>
            </div>
            <!-- Table with tabs -->
            <div class="col-xl-12 col-lg-12" id="created-consolidation-tables">
                <div class="card-body px-0 py-2">
                    <div class="d-flex justify-content-between tp-tables">

                        <div class="transport-planning-table-tabs" id="tabs">
                            <ul class="d-flex ">
                                <li>{{__('localization.created_uploading')}} <span class="uploading-tabs">23</span></li>
                                <li>{{__('localization.created_common_ftl')}} <span class="uploading-tabs">31</span>
                                </li>
                                <li>{{__('localization.created_lg_transport')}} <span class="uploading-tabs">26</span>
                                </li>
                                <li>{{__('localization.created_rv_loading')}} <span class="uploading-tabs">43</span>
                                </li>
                            </ul>

                            <div id="t1">
                                @include('match.dispatcher.content.tables.created')
                            </div>
                            <div id="t2">

                            </div>
                            <div id="t3">

                            </div>
                            <div id="t4">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="created-consolidation-view d-none">
            <div class="pt-2 pb-3" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-slash">
                            <li class="breadcrumb-item" id="created-list-view"><a href="#">{{ $breadcrumb_label }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{__('localization.created_consolidation_view')}} № <span
                                    class="consolidation-number"></span></li>
                        </ol>
                    </nav>
                </div>
                <div class="d-none" id="created-btns-actions" style="display: flex; gap: 1em;">
                    <button type="button" class="btn btn-flat-danger waves-effect d-flex align-items-center"
                        data-bs-toggle="modal" data-bs-target="#created-delete-modal"><img
                            src="{{asset('assets/icons/trash-red2.svg')}}"
                            style="padding-right: 5px;">{{__('localization.created_delete')}}</button>
                    <button type="button"
                        class="btn btn-primary waves-effect waves-float waves-light d-flex align-items-center"
                        id="return-to-work-consolidation">{{__('localization.created_return')}}</button>
                </div>

                <div class="d-none" id="draft-btns-actions" style="display: flex; gap: 1em;">
                    <button type="button" class="btn btn-flat-danger waves-effect d-flex align-items-center"
                        data-bs-toggle="modal" data-bs-target="#created-delete-modal"><img
                            src="{{asset('assets/icons/trash-red2.svg')}}"
                            style="padding-right: 5px;">{{__('localization.draft_delete')}}</button>
                    <button type="button" id="edit-consilidation-draft"
                        class="btn btn-outline-primary waves-effect">{{__('localization.draft_edit')}}</button>
                    <button type="button"
                        class="btn btn-primary waves-effect waves-float waves-light d-flex align-items-center"
                        data-bs-toggle="modal"
                        data-bs-target="#draft-return-modal">{{__('localization.draft_send')}}</button>
                </div>

            </div>

            <div class="row justify-content-between px-2 pb-2">
                <div class="col-6" id="data-created-consolidation-view"
                    style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">
                </div>
                <div class="col-6"
                    style="border: 1px solid rgba(219, 218, 222, 1); width:49%; padding: 20px; border-radius: 8px;">
                    <div class="pb-2">
                        <h5 class="mb-0">{{__('localization.created_tp_trip')}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <p class="match-light-gray-text">{{__('localization.created_time')}} <img
                                    data-bs-toggle="tooltip"
                                    title="The time suggested by the system takes into account the work of the warehouse"
                                    src="{{asset('assets/icons/info-circle.svg')}}" />
                            </p>
                        </div>

                        <div class="col-6">
                            <p class="match-light-gray-text">{{__('localization.created_points')}}</p>
                        </div>
                        <div class="col-4">
                            <p class="match-light-gray-text text-end">{{__('localization.created_uploading_time')}}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-1" id="data-created-consolidation-trip-container">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="canceledConsolidation" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3 mx-2">
                    <h3 class="text-center pb-2">{{__('localization.created_reasons')}}</h3>
                    <p class="canceled-modal-title">{{__('localization.created_connected')}}</p>
                    <ul class="canceled-list">
                        <li>{{__('localization.created_dates')}}</li>
                        <li>{{__('localization.created_products')}}</li>
                    </ul>
                    <p class="canceled-modal-title">{{__('localization.created_connected_participants')}}</p>
                    <ul class="canceled-list">
                        <li>{{__('localization.created_fejected')}}</li>
                    </ul>
                    <p class="canceled-modal-title">{{__('localization.created_comment_logist')}}</p>
                    <div class="row">
                        <div class="col-1">
                            <img src="{{asset('assets/images/match-avatar.svg')}}" alt=""
                                style="width:26px;height:26px;border-radius:50%">
                        </div>
                        <div class="col-11">
                            <p class="match-yellow-text">{{__('localization.created_logist')}}</p>
                            <p class="">{{__('localization.created_comment')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="created-delete-modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-2">
                    <h3 class="pb-2">{{__('localization.created_delete_consolidation')}} № <span
                            class="consolidation-number"></span></h3>
                    <p class="">{{__('localization.created_delete_consolidation2')}}</p>
                </div>
                <div class="modal-footer" style="border-top: none;">
                    <button type="button" class="btn btn-flat-secondary waves-effect"
                        data-bs-dismiss="modal">{{__('localization.created_cancel')}}</button>
                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light"
                        id="delete-consolidation-confirm"
                        data-bs-dismiss="modal">{{__('localization.created_submit')}}</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal return -->
    <div class="modal fade" id="draft-return-modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-2">
                    <h3 class="pb-2">{{__('localization.draft_return')}} № <span class="consolidation-number"></span>
                    </h3>
                    <p class="">{{__('localization.draft_return2')}}</p>
                </div>
                <div class="modal-footer" style="border-top: none;">
                    <button type="button" class="btn btn-flat-secondary waves-effect"
                        data-bs-dismiss="modal">{{__('localization.draft_cancel')}}</button>
                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light"
                        id="consolidation-to-start-processing"
                        data-bs-dismiss="modal">{{__('localization.draft_submit')}}</button>
                </div>
            </div>
        </div>
    </div>






</div>