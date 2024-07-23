<div class="tab-pane active" id="vertical-pill-2" role="tabpanel" aria-labelledby="stacked-pill-2"
    aria-expanded="false">


    <div class="">

    <div class="card tabs-container-logist" id="table-page">
            <div id="tabs" class="">
                <ul class="d-flex  tabsHeader">
                    <li class="d-flex align-items-center">{{__('local_logist.logist_tab_replenish')}} <span
                            class=" alert alert-primary " style="padding:4px 8px">3</span></li>
                    <li class="d-flex align-items-center"> {{__('local_logist.logist_tab_backhaul')}}<span
                            class=" alert alert-primary " style="padding:4px 8px">0</span>
                    </li>
                    <li class="d-flex align-items-center">{{__('local_logist.logist_tab_joint_ftl')}} <span
                            class=" alert alert-primary " style="padding:4px 8px">0</span></li>
                    <li class="d-flex align-items-center">{{__('local_logist.logist_tab_larger_vehicle')}} <span
                            class=" alert alert-primary " style="padding:4px 8px">0</span></li>
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


        <div class="container-fluid ps-0 pe-0 d-none" id="view-consolid-page">
            <!---->
            <div
                class="d-flex justify-content-between flex-column  flex-sm-column flex-md-row flex-lg-row flex-xxl-row">
                <div class=" pb-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-slash">
                            <li class="breadcrumb-item"><a href="#" style="color: #4B465C;" id="open-table-page">
                                    {{__('local_logist.logist_cab_in_progress')}}</a></li>
                            <li class="breadcrumb-item fw-bolder active" aria-current="page">
                                {{__('local_logist.log_trans_planning')}} № <span
                                    id="number-planning-bredcrumb">237000123</span>
                            </li>

                        </ol>
                    </nav>
                </div>

            </div>
            <!-- = -->

            <div class="card mb-0 heigh-79vh-lg">
                <div class="d-flex flex-column h-100">

                    <div class="flex-grow-1">
                        <div class="row m-0 h-100">
                            <div class="col-12 col-lg-7 border-right-lg  h-100 px-0">
                                <div class="p-1  p-lg-2" id="list-for-action"
                                    style="max-height:70vh; overflow-y: auto;">


                                    <!-- список дій з тнками! генерується рядок-розмітка -->
                                    <!-- =====================================  -->


                                </div>

                            </div>
                            <div class="col-12 col-lg-5 px-0 " style="">
                                <div class="h-100 d-flex flex-column container-route-tabs">
                                    <!-- таби з товарними накладними та витратами   -->
                                    <div class="custom-nav-tabs " style="height: 90%">
                                        <ul class="nav nav-tabs nav-fill nav-underline border-bottom mb-0"
                                            role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tns-tab" data-bs-toggle="tab" href="#tns"
                                                    aria-controls="tns" role="tab" aria-selected="true">
                                                    {{__('local_logist.log_progress_consignment_notes')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="costs-tab" data-bs-toggle="tab" href="#costs"
                                                    aria-controls="costs" role="tab" aria-selected="false">
                                                    {{__('local_logist.log_progress_cost_calculations')}}
                                                </a>
                                            </li>

                                        </ul>
                                        <div class="tab-content  overflow-cont-tns"
                                            style=" overflow-y: auto;">
                                            <div class="tab-pane active p-2 pt-1" id="tns" aria-labelledby="tns-tab"
                                                role="tabpanel">
                                                <!-- список тнок з компанією! генерується рядок-розмітка -->
                                                <div id="tns-w-titleCompany"></div>
                                                <!-- =====================================  -->

                                            </div>
                                            <div class="tab-pane p-2 pt-1" id="costs" aria-labelledby="costs-tab"
                                                role="tabpanel">

                                                <div class="accordion " id="accordionCost">
                                                    <div class="accordion-item">
                                                        <div class="accordion-header" id="headingOne-cost">
                                                            <button
                                                                class="accordion-button fw-semibold bg-c-transparent fs-5 p-0 pb-2"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionOne-cost" aria-expanded="true"
                                                                aria-controls="accordionOne-cost">
                                                                {{__('local_logist.log_progress_operating_expenses')}}
                                                            </button>
                                                        </div>
                                                        <div id="accordionOne-cost"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="headingOne-cost"
                                                            data-bs-parent="#accordionCost">
                                                            <div class="accordion-body p-0">
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="mt-0 fw-bold">1. RÖHLIG SUUS</p>
                                                                    <p class="mt-0 fw-bold">3000
                                                                        {{__('local_logist.logist_w_uah')}}</p>
                                                                </div>
                                                                <div class="d-flex justify-content-between ps-1">
                                                                    <p class="mt-0">
                                                                        {{__('local_logist.log_progress_distanse_increase')}}:
                                                                    </p>
                                                                    <p class="mt-0">100 km</p>
                                                                </div>
                                                                <div class="d-flex justify-content-between ps-1">
                                                                    <p class="mt-0">
                                                                        {{__('local_logist.log_progress_extra_points')}}:
                                                                    </p>
                                                                    <p class="mt-0">2</p>
                                                                </div>
                                                                <div class="d-flex justify-content-between ps-1">
                                                                    <p class="mt-0">
                                                                        {{__('local_logist.log_progress_route_time')}}:
                                                                    </p>
                                                                    <p class="mt-0">24 h</p>
                                                                </div>
                                                                <div class="input-group mb-1">
                                                                    <input type="number" class="form-control"
                                                                        placeholder="3000" id="sku_height">
                                                                    <span
                                                                        class="input-group-text">{{__('local_logist.logist_w_uah')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo-cost">
                                                            <button
                                                                class="accordion-button fw-semibold bg-c-transparent fs-5 p-0 py-2"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionTwo-cost"
                                                                aria-expanded="false" aria-controls="accordionTwo-cost">
                                                                {{__('local_logist.log_progress_transportation_cost')}}
                                                            </button>
                                                        </h2>
                                                        <div id="accordionTwo-cost"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="headingTwo-cost"
                                                            data-bs-parent="#accordionCost">
                                                            <div class="accordion-body p-0">
                                                                <div class="mb-1">
                                                                    <div class="d-flex justify-content-between">
                                                                        <p class="mt-0 fw-bold">1. LLC Silpo </p>
                                                                        <p class="mt-0 fw-bold">6000
                                                                            {{__('local_logist.logist_w_uah')}}</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between ps-1">
                                                                        <p class="mt-0">
                                                                            {{__('local_logist.log_progress_cost_without_consilid')}}:
                                                                        </p>
                                                                        <p class="mt-0">7500
                                                                            {{__('local_logist.logist_w_uah')}}</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between ps-1">
                                                                        <p class="mt-0">
                                                                            {{__('local_logist.log_progress_cost_w_consilid')}}:
                                                                        </p>
                                                                        <p class="mt-0">6000
                                                                            {{__('local_logist.logist_w_uah')}}</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between ps-1">
                                                                        <p class="mt-0">
                                                                            {{__('local_logist.log_progress_reduction')}}:
                                                                        </p>
                                                                        <div class=""> <span
                                                                                class="alert alert-success m-0"
                                                                                style="padding:2px 4px;">-20%</span>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <p class="mt-0 fw-bold">2. LLC Auchan </p>
                                                                        <p class="mt-0 fw-bold">21500
                                                                            {{__('local_logist.logist_w_uah')}}</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between ps-1">
                                                                        <p class="mt-0">
                                                                        {{__('local_logist.log_progress_cost_without_consilid')}}:
                                                                        </p>
                                                                        <p class="mt-0">23000
                                                                            {{__('local_logist.logist_w_uah')}}</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between ps-1">
                                                                        <p class="mt-0">
                                                                        {{__('local_logist.log_progress_cost_w_consilid')}}:
                                                                        </p>
                                                                        <p class="mt-0">21500
                                                                            {{__('local_logist.logist_w_uah')}}</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between ps-1">
                                                                        <p class="mt-0">
                                                                            {{__('local_logist.log_progress_reduction')}}:
                                                                        </p>
                                                                        <div class=""> <span
                                                                                class="alert alert-success m-0"
                                                                                style="padding:2px 4px;">7%</span>
                                                                        </div>
                                                                    </div>

                                                                </div>




                                                                <div class="mt-1">
                                                                    <div class="d-flex justify-content-between">
                                                                        <p class="mt-0 fw-bold">3. RÖHLIG SUUS </p>
                                                                        <p class="mt-0 fw-bold">1500
                                                                            {{__('local_logist.logist_w_uah')}}</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between ps-1">
                                                                        <p class="mt-0">
                                                                            Total profit:
                                                                        </p>
                                                                        <p class="mt-0">1500
                                                                            {{__('local_logist.logist_w_uah')}}</p>
                                                                    </div>
                                                                 
                                                                    <!-- <div class="d-flex justify-content-between ps-1">
                                                                        <p class="mt-0">
                                                                            {{__('local_logist.log_progress_reduction')}}:
                                                                        </p>
                                                                        <div class=""> <span
                                                                                class="alert alert-success m-0"
                                                                                style="padding:2px 4px;">8%</span>
                                                                        </div>
                                                                    </div> -->

                                                                </div>






                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--  -->
                                    <!-- маршрут рейсу -->
                                    <div style="" class="accordion border-top container-route" id="accordionForRoute">
                                        <div class="accordion-item bg-c-transparent">
                                            <h2 class=" accordion-header mx-2" id="headingOne">

                                                <button class="bg-c-transparent accordion-button initialize-map"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#accordionRoute" aria-expanded="true"
                                                    aria-controls="accordionRoute">
                                                    {{__('local_logist.log_progress_route_path')}}
                                                </button>
                                            </h2>
                                            <div id="accordionRoute" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionForRoute">
                                                <div class="accordion-body p-2 pt-0">
                                                    <div class=" leaflet-map rounded " id="basic-map"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="flex-shrink-0 row m-0 border-top">

                    <div class="col-12 col-lg-7 p-1 pb-0 p-lg-2 border-right-lg" style="background-color:white;">
                        <button class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#create-action-modal"><i data-feather='plus'
                                style="margin-right: 5px;"></i>{{__('local_logist.logist_btbs_add_to_action')}}
                        </button>
                    </div>
                    <div class="col-12 col-lg-5 p-1  p-lg-2 d-flex " style="background-color:white;">
                        <button data-bs-toggle="modal" data-bs-target="#leave-from-tp-modal" type='button'
                            class="w-100 btn btn-flat-danger mr-1 " tabindex="4" id=""><i data-feather="trash"
                                class="me-25"></i>
                            {{__('local_logist.logist_bths_reject')}}
                        </button>
                        <button type="button"  class="w-100 btn btn-primary" tabindex="4" id="save-actions-consolidation" disabled>
                            <span class="align-middle d-sm-inline-block"> {{__('local_logist.logist_btbs_save')}}</span>
</button>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <!-- модаллки -->

    <!-- створення дії        data-bs-toggle="modal" data-bs-target="#create-action-modal"                -->
    <div class="modal fade" id="create-action-modal" tabindex="-1" aria-labelledby="create-action-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md " style="max-width: 680px">
            <div class="p-4 modal-content">
                <h2 class=" text-center">{{__('local_logist.log_modal_add_an_action')}}</h2>
                <p class="mb-2 text-center">{{__('local_logist.log_modal_create_new_action')}}</p>

                <form class="" method="" action="#">
                    <div class="d-flex gap-1 mb-1">
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="radio" id="loading-create" checked>
                            <label class="form-check-label" for="loading-create">
                                {{__('local_logist.logist_w_loading')}}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="moving-create">
                            <label class="form-check-label" for="moving-create">
                                {{__('local_logist.logist_w_moving')}}
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="unloading-create">
                            <label class="form-check-label" for="unloading-create">
                                {{__('local_logist.logist_w_unloading')}}
                            </label>
                        </div>

                    </div>
                    <div class="mb-1 location-create-container">
                        <label class="form-label" for="location-create"> {{__('local_logist.logist_w_waypoint')}} <span
                                class="text-danger">*</span>
                        </label>
                        <select class="select2 form-select" id="location-create"
                            data-placeholder="{{__('local_logist.log_modal_choose_the_waypoint')}}">
                            <option value=""></option>
                            <option value="126 G, Bohdan Khmelnitsky St. Lviv">126 G, Bohdan Khmelnitsky St. Lviv

                            </option>
                            <option value="112 Mykhailo Hrushevskyi St. Dubno">112 Mykhailo Hrushevskyi St. Dubno
                            </option>
                            <option value="33 Zelena St. Kyiv">33 Zelena St. Kyiv
                            </option>
                            <option value="45,Shevchenka St. Kyiv">45,Shevchenka St. Kyiv
                            </option>
                        </select>
                    </div>
                    <div class="mb-1 transporter-create-container d-none">
                        <label class="form-label" for="transporter-create">{{__('local_logist.logist_w_carrier')}} <span
                                class="text-danger">*</span></label>
                        <select class="select2 form-select" id="transporter-create"
                            data-placeholder="{{__('local_logist.log_modal_choose_the_carrier')}}">
                            <option value=""></option>
                            <option value="126 G, Bohdan Khmelnitsky St. Lviv">CargoTrans</option>
                            <option value="112 Mykhailo Hrushevskyi St. Dubno">MasterTrans</option>
                            <option value="33 Zelena St. Kyiv">Ekol</option>
                            <option value="45,Shevchenka St. Kyiv">Sku Logistic</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class=" col-sm-12 col-md-6  col-lg-6 mb-1">
                            <label class="form-label" for="">{{__('local_logist.logist_w_date')}} <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="date-create" class="form-control flatpickr-basic"
                                placeholder="YYYY-MM-DD" />
                        </div>
                        <div class=" col-sm-12 col-md-6  col-lg-6 mb-1">
                            <label class="form-label" for="">{{__('local_logist.logist_w_time')}} <span
                                    class="text-danger">*</span></label>
                            <div class="d-flex"> <input type="text" id="time-create-from"
                                    class="form-control flatpickr-time text-start" placeholder="HH:MM" /> <img
                                    class="align-self-center" style="width: 30px;height: 2px"
                                    src="{{asset('assets/icons/line-schedule.svg')}}"><input type="text"
                                    id="time-create-to" class="form-control flatpickr-time text-start"
                                    placeholder="HH:MM" /></div>
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label"
                            for="tn-list-create">{{__('local_logist.log_modal_add_cns_to_process')}} </label>
                        <select class="select2 form-select" id="tn-list-create" multiple>
                            <option value=""></option>
                            <option value="1">№235000123</option>
                            <option value="2">№235000138</option>
                            <option value="3">№235000135</option>
                            <option value="4">№235000131</option>
                            <option value="5">№235000134</option>
                        </select>
                    </div>

                    <!-- <div class="mb-1">
                        <label class="form-label" for="number-action-create">{{__('local_logist.log_modal_step')}}
                        </label>
                        <select class="select2 form-select" id="number-action-create"
                            data-placeholder="Оберіть номер дії в загальному транспортному плануванні">
                            <option value=""></option>
                            <option value="1">1</option>

                        </select>
                    </div> -->

                    <div class="d-flex justify-content-end pt-2">
                        <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">
                            {{__('local_logist.logist_btbs_cancel')}}
                        </a>
                        <button type="button" class="btn btn-primary" id="create-new-action" disabled>
                            {{__('local_logist.logist_btbs_confirm')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- редагування дії        data-bs-toggle="modal" data-bs-target="#edit-action-modal"               -->
    <div class="modal fade" id="edit-action-modal" tabindex="-1" aria-labelledby="edit-action-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md " style="max-width: 680px">
            <div class="p-4 modal-content">
                <h2 class=" text-center">{{__('local_logist.log_modal_edit_action')}} №<span
                        class="title-action"></span> "</h2>
                <p class="mb-2 text-center">{{__('local_logist.log_modal_edit_the_step')}}</p>

                <form class="" method="" action="#">
                    <div class="d-flex gap-1 mb-1">
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="radio" id="loading-edit" checked>
                            <label class="form-check-label" for="loading-edit">
                                {{__('local_logist.logist_w_loading')}}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="moving-edit">
                            <label class="form-check-label" for="moving-edit">
                                {{__('local_logist.logist_w_moving')}}
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="unloading-edit">
                            <label class="form-check-label" for="unloading-edit">
                                {{__('local_logist.logist_w_unloading')}}
                            </label>
                        </div>

                    </div>
                    <div class="mb-1 location-edit-container">
                        <label class="form-label" for="location-edit">{{__('local_logist.logist_w_waypoint')}} <span
                                class="text-danger">*</span>
                        </label>
                        <select class="select2 form-select" id="location-edit"
                            data-placeholder="{{__('local_logist.log_modal_choose_the_waypoint')}}">
                            <option value=""></option>
                            <option value="126 G, Bohdan Khmelnitsky St. Lviv">126 G, Bohdan Khmelnitsky St. Lviv

                            </option>
                            <option value="112 Mykhailo Hrushevskyi St. Dubno">112 Mykhailo Hrushevskyi St. Dubno
                            </option>
                            <option value="33 Zelena St. Kyiv">33 Zelena St. Kyiv
                            </option>
                            <option value="45,Shevchenka St. Kyiv">45,Shevchenka St. Kyiv
                            </option>
                        </select>
                    </div>
                    <div class="mb-1 transporter-edit-container d-none">
                        <label class="form-label" for="transporter-edit">{{__('local_logist.logist_w_carrier')}} <span
                                class="text-danger">*</span></label>
                        <select class="select2 form-select" id="transporter-edit"
                            data-placeholder="{{__('local_logist.log_modal_choose_the_carrier')}}">
                            <option value=""></option>
                            <option value="126 G, Bohdan Khmelnitsky St. Lviv">CargoTrans</option>
                            <option value="112 Mykhailo Hrushevskyi St. Dubno">MasterTrans</option>
                            <option value="33 Zelena St. Kyiv">Ekol</option>
                            <option value="45,Shevchenka St. Kyiv">Sku Logistic</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class=" col-sm-12 col-md-6  col-lg-6 mb-1">
                            <label class="form-label" for="">{{__('local_logist.logist_w_date')}} <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="date-edit" class="form-control flatpickr-basic"
                                placeholder="YYYY-MM-DD" />
                        </div>
                        <div class=" col-sm-12 col-md-6  col-lg-6 mb-1">
                            <label class="form-label" for="">{{__('local_logist.logist_w_time')}} <span
                                    class="text-danger">*</span></label>
                            <div class="d-flex"> <input type="text" id="time-edit-from"
                                    class="form-control flatpickr-time text-start" placeholder="HH:MM" /> <img
                                    class="align-self-center" style="width: 30px;height: 2px"
                                    src="{{asset('assets/icons/line-schedule.svg')}}"><input type="text"
                                    id="time-edit-to" class="form-control flatpickr-time text-start"
                                    placeholder="HH:MM" /></div>
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="tn-list-edit">{{__('local_logist.log_modal_add_cns_to_process')}}
                        </label>
                        <select class="select2 form-select" id="tn-list-edit" multiple>
                            <option value=""></option>
                            <option value="1">№235000123</option>
                            <option value="2">№235000138</option>
                            <option value="3">№235000135</option>
                            <option value="4">№235000131</option>
                            <option value="5">№235000134</option>
                        </select>
                    </div>

                    <!-- <div class="mb-1">
                        <label class="form-label" for="number-action-edit">{{__('local_logist.log_modal_step')}}
                        </label>
                        <select class="select2 form-select" id="number-action-edit"
                            data-placeholder="Оберіть номер дії в загальному транспортному плануванні">
                            <option value=""></option>
                            <option value="1">1</option>
                        </select>
                    </div> -->

                    <div class="d-flex justify-content-end pt-2">
                        <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">
                            {{__('local_logist.logist_btbs_cancel')}}
                        </a>
                        <button id="update-action-btn" type="button" class="btn btn-primary">
                            {{__('local_logist.logist_btbs_confirm')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- додати тн до дії        data-bs-toggle="modal" data-bs-target="#add-tn-to-action-modal"               -->
    <div class="modal fade" id="add-tn-to-action-modal" tabindex="-1" aria-labelledby="add-tn-to-action-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 680px">
            <div class="p-4 modal-content">

                <div id="content-about-tn">

                </div>

                <hr>

                <form class="" method="" action="#">
                    <div class="d-flex gap-1 mb-1">
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="radio" id="loading-add-tn-to" checked>
                            <label class="form-check-label" for="loading-add-tn-to">
                                {{__('local_logist.logist_w_loading')}}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="moving-add-tn-to">
                            <label class="form-check-label" for="moving-add-tn-to">
                                {{__('local_logist.logist_w_moving')}}
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="unloading-add-tn-to">
                            <label class="form-check-label" for="unloading-add-tn-to">
                                {{__('local_logist.logist_w_unloading')}}
                            </label>
                        </div>

                    </div>

                    <div class="mb-1 ">
                        <div class="loading-action-list-container">
                            <label class="form-label" for="loading-action-list">
                                {{__('local_logist.logist_w_add_to_loading')}}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="select2 form-select" id="loading-action-list"
                                data-placeholder=" {{__('local_logist.log_modal_action_adress')}}">
                            </select>
                        </div>
                        <div class="moving-action-list-container d-none">
                            <label class="form-label" for="moving-action-list">
                                {{__('local_logist.logist_w_add_to_moving')}}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="select2 form-select" id="moving-action-list"
                                data-placeholder=" {{__('local_logist.log_modal_action_adress')}}">
                            </select>
                        </div>
                        <div class="unloading-action-list-container d-none">
                            <label class="form-label" for="unloading-action-list">
                                {{__('local_logist.logist_w_add_to_unloading')}}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="select2 form-select" id="unloading-action-list"
                                data-placeholder=" {{__('local_logist.log_modal_action_adress')}}">

                            </select>
                        </div>

                    </div>
                    <p> {{__('local_logist.log_modal_or')}} <a href="#"
                            id="open-create-action-modal">{{__('local_logist.log_modal_create_action_link')}}</a>
                        {{__('local_logist.log_modal_on_this_cn')}}
                    </p>

                    <div class="d-flex justify-content-end pt-2">
                        <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">
                            {{__('local_logist.logist_btbs_cancel')}}
                        </a>
                        <button type="button" id="confirm-tn-to-action" class="btn btn-primary" disabled>
                            {{__('local_logist.logist_btbs_confirm')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- видалення  дії        data-bs-toggle="modal" data-bs-target="#remove-action-modal"               -->
    <div class="modal fade" id="remove-action-modal" tabindex="-1" aria-labelledby="remove-action-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md " style="max-width: 500px">
            <div class="p-4 modal-content">
                <h4 class="mb-2 "> {{__('local_logist.log_modal_remove_action')}} №<span class="title-action"></span> "
                </h4>
                <p class="mb-2 "> {{__('local_logist.log_modal_sure_remove_action')}}</p>
                <form class="" method="" action="#">

                    <div class="d-flex justify-content-end pt-2">
                        <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">
                            {{__('local_logist.logist_btbs_cancel')}}
                        </a>
                        <button type="button" class="btn btn-primary" id="confirm-remove-action">
                            {{__('local_logist.logist_btbs_confirm')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- вийти з створення транспортного планування          data-bs-toggle="modal" data-bs-target="#leave-from-tp-modal"               -->
    <div class="modal fade" id="leave-from-tp-modal" tabindex="-1" aria-labelledby="leave-from-tp-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md " style="max-width: 500px">
            <div class="p-4 modal-content">
                <h4 class="mb-2 ">{{__('local_logist.log_modal_cancel_creating_consolidation')}} №653876 </h4>
                <p class="mb-2 "> {{__('local_logist.log_modal_cancel_creating_c_info')}}</p>
                <form class="" method="" action="#">

                    <div class="d-flex justify-content-end pt-2">
                        <a class="btn btn-flat-secondary float-start mr-2" data-bs-dismiss="modal" aria-label="Close">
                            {{__('local_logist.logist_btbs_cancel')}}
                        </a>
                        <a href="/match/logistician" class="btn btn-primary">
                            {{__('local_logist.logist_btbs_confirm')}}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!--  -->
</div>