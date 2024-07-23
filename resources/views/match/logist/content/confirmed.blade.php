<div class="tab-pane active" id="vertical-pill-3" role="tabpanel" aria-labelledby="stacked-pill-3"
    aria-expanded="false">

    <div class="">

        <div class="card tabs-container-logist" id="table-page">
            <div id="tabs" class="">
                <ul class="d-flex  tabsHeader">
                    <li class="d-flex align-items-center">{{__('local_logist.logist_tab_replenish')}} <span
                            class=" alert alert-primary " style="padding:4px 8px">3</span></li>
                    <li class="d-flex align-items-center">  {{__('local_logist.logist_tab_joint_ftl')}}<span
                            class=" alert alert-primary " style="padding:4px 8px">0</span>
                    </li>
                    <li class="d-flex align-items-center"> {{__('local_logist.logist_tab_backhaul')}}<span
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

        <div class="container-fluid px-2 d-none" id="view-consolid-page">

            <div class="container-fluid ps-0 pe-0 " id="">
                <!---->
                <div
                    class="d-flex justify-content-between flex-column  flex-sm-column flex-md-row flex-lg-row flex-xxl-row">
                    <div class=" pb-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-slash">
                                <li class="breadcrumb-item"><a href="#" style="color: #4B465C;"
                                        id="open-table-page">
                                        {{__('local_logist.logist_cab_confirmed')}}</a></li>
                                <li class="breadcrumb-item fw-bolder active" aria-current="page">
                                    {{__('local_logist.logist_w_consolidation')}} № <span
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
                                    <div class="p-1  p-lg-2" id="list-for-action-confirmed"
                                        style="max-height:70vh; overflow-y: auto;">
                                        <!-- список дій з тнками! генерується рядок-розмітка -->
                                        <!-- =====================================  -->
                                    </div>

                                </div>
                                <div class="col-12 col-lg-5 px-0 " style="">
                                    <div class="h-100 d-flex flex-column container-route-tabs">
                                        <!-- таби з загальною інформацією та витратами   -->
                                        <div class="custom-nav-tabs " style="height: 90%">
                                            <ul class="nav nav-tabs nav-fill nav-underline border-bottom mb-0"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="tns-tab2" data-bs-toggle="tab"
                                                        href="#tns2" aria-controls="tns2" role="tab"
                                                        aria-selected="true">{{__('local_logist.log_confirmed_general_info')}}

                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link " id="costs-tab2" data-bs-toggle="tab"
                                                        href="#costs2" aria-controls="costs2" role="tab"
                                                        aria-selected="false">{{__('local_logist.log_progress_cost_calculations')}}
                                                    </a>
                                                </li>

                                            </ul>
                                            <div class="tab-content  overflow-cont-tns"
                                                style="max-height:500px; overflow-y: auto;">
                                                <div class="tab-pane active p-2 pt-1" id="tns2"
                                                    aria-labelledby="tns-tab2" role="tabpanel">

                                                    <!-- ====== загальна інфа =========  -->

                                                    <div class="mb-1">
                                                        <h5 class="fw-semibold mb-1">
                                                            {{__('local_logist.log_confirmed_data_plan')}}</h5>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 " style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_n_consolidation')}}
                                                                :</p>
                                                            <p class="f-15">237000123</p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_creating_date')}}:</p>
                                                            <p class="f-15 mt-0">04.11.2023 о 12:31 <a href="#">Mark
                                                                    Oveliuk
                                                                </a> </p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_operator')}}:</p>
                                                            <a class="f-15 mt-0" href="#">RÖHLIG SUUS</a>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 " style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_consol_type')}}:</p>
                                                            <p class="f-15  ">Top-up</p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 my-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_consol_participants')}}:
                                                            </p>
                                                            <a class="f-15 my-0" href="#">LLC Auchan</a>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class="mt-0" style="width:150px;"></p>
                                                            <a class="f-15 " href="#">LLC Silpo</a>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_route')}}:</p>
                                                            <p class="f-15">Lviv - Kyiv</p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_delivery_terms')}}:</p>
                                                            <p class="f-15">06.11.2023 - 07.11.2023</p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_loading_points')}}:</p>
                                                            <p class="f-15">2</p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_unloading_points')}}:
                                                            </p>
                                                            <p class="f-15">2</p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_total_price')}}:</p>
                                                            <p class="f-15">23 000 {{__('local_logist.logist_w_uah')}}
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="mb-1">
                                                        <h5 class="fw-semibold mb-1">
                                                            {{__('local_logist.log_pending_r_modal_planning')}}</h5>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_cargo_type')}}:</p>
                                                            <p class="f-15">Food products</p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_pallet_places')}}:</p>
                                                            <p class="f-15">28/33</p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.log_confirmed_total_weight')}}:</p>
                                                            <p class="f-15">19 000 / 20 000
                                                                {{__('local_logist.logist_w_kg')}}</p>
                                                        </div>


                                                    </div>
                                                    <div class="">
                                                        <h5 class="fw-semibold mb-1">
                                                            {{__('local_logist.log_confirmed_carrier_data')}}</h5>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.logist_w_carrier')}}:</p>
                                                            <a class="f-15 mt-0" href="#">RÖHLIG SUUS
                                                            </a>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.logist_w_driver')}}:</p>
                                                            <a class="f-15 mt-0" href="#">Mosiychuk А.І.</a>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.logist_w_сar')}}:</p>
                                                            <a class="f-15 mt-0" href="#">Scania S730</a>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class=" f-15 fw-4 mt-0"
                                                                style="width:150px;color:#A5A3AE">
                                                                {{__('local_logist.logist_w_trailer')}}:</p>
                                                            <a class="f-15 mt-0" href="#">MEGA MNL</a>
                                                        </div>

                                                    </div>
                                                    <!-- ===================== -->

                                                </div>
                                                <div class="tab-pane p-2 pt-1" id="costs2" aria-labelledby="costs-tab2"
                                                    role="tabpanel">
                                                    <!-- витати й розрахунки ===================== -->
                                                    <div class="mb-1">
                                                        <h5 class="fw-semibold mb-1">
                                                            {{__('local_logist.log_confirmed_final_cost')}}</h5>
                                                        <div class="row">
                                                            <div class="col-6 text-center">
                                                                <div style="background-color:#F8F8F9;border-top: 2px solid #D9B414;"
                                                                    class="py-1 rounded-top">
                                                                    <p class="mb-0 fs-18">LLC Silpo</p>
                                                                    <p class="mb-0 fs-18 fw-bold ">21500 ₴</p>
                                                                    <p class="mb-0 fs-18 text-decoration-line-through"
                                                                        style="color:#A5A3AE">23000 ₴ <i
                                                                            data-feather="info" class="ms-25"></i></p>
                                                                </div>
                                                                <div style="background-color:#B5E8CD;padding:3px 0px;"
                                                                    class="rounded-bottom">
                                                                    <p class="m-0 fw-bold text-success">-7%</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 text-center">
                                                                <div style="background-color:#F8F8F9;border-top: 2px solid #00CFE8;"
                                                                    class="py-1 rounded-top">
                                                                    <p class="mb-0 fs-18">LLC Auchan</p>
                                                                    <p class="mb-0 fs-18 fw-bold ">6 000 ₴</p>
                                                                    <p class="mb-0 fs-18 text-decoration-line-through"
                                                                        style="color:#A5A3AE">7 500 ₴<i
                                                                            data-feather="info" class="ms-25"></i></p>
                                                                </div>
                                                                <div style="background-color:#B5E8CD;padding:3px 0px;"
                                                                    class="rounded-bottom">
                                                                    <p class="m-0 fw-bold text-success">-20%</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <h5 class="fw-semibold mb-1">
                                                            {{__('local_logist.log_confirmed_calculations')}}</h5>

                                                        <div class="accordion " id="accordionCost2">
                                                            <div class="accordion-item">
                                                                <div class="accordion-header" id="headingOne-cost2">
                                                                    <div class="accordion-button bg-c-transparent fs-15 p-0 pb-1 w-100"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#accordionOne-cost2"
                                                                        aria-expanded="true"
                                                                        aria-controls="accordionOne-cost2">
                                                                        <div
                                                                            class="w-100 d-flex justify-content-between">
                                                                            <span>{{__('local_logist.log_confirmed_total_saving')}}</span>
                                                                            <span class="me-2">4500 ₴ </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="accordionOne-cost2"
                                                                    class="accordion-collapse collapse show"
                                                                    aria-labelledby="headingOne-cost2"
                                                                    data-bs-parent="#accordionCost2">
                                                                    <div class="accordion-body p-0">
                                                                        <div id="block_i_calc_totaleconomy"></div>
                                                                        <p> 4500₴ = 7500₴ - 3000₴</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <div class="accordion-header" id="headingOne-3">
                                                                    <div class="accordion-button bg-c-transparent fs-15 p-0 py-1 w-100"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#accordionOne-cost3"
                                                                        aria-expanded="true"
                                                                        aria-controls="accordionOne-cost3">
                                                                        <div
                                                                            class="w-100 d-flex justify-content-between">
                                                                            <span>{{__('local_logist.log_confirmed_saving_after_deduction')}}</span>
                                                                            <span class="me-2">3000 ₴ </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="accordionOne-cost3"
                                                                    class="accordion-collapse collapse show"
                                                                    aria-labelledby="headingOne-cost3"
                                                                    data-bs-parent="#accordionCost2">
                                                                    <div class="accordion-body p-0">
                                                                        <div id="block_i_economy_w_fee"></div>
                                                                        <p> 4500₴ / (2+1) = 1500₴</p>
                                                                        <div id="block_i_economy_w_fee-2"></div>
                                                                        <p> 4500₴ - 1500₴ = 3000₴</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="accordion-item ">
                                                                <h2 class="accordion-header" id="headingTwo-cost2">
                                                                    <div class="accordion-button  bg-c-transparent fs-5 p-0 py-1"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#accordionTwo-cost2"
                                                                        aria-expanded="false"
                                                                        aria-controls="accordionTwo-cost2">
                                                                        <div
                                                                            class="w-100 d-flex justify-content-between">
                                                                            <span>{{__('local_logist.log_confirmed_saving_per_pallets')}}</span>
                                                                            <span class="me-2">131,64 ₴ </span>
                                                                        </div>
                                                                    </div>
                                                                </h2>
                                                                <div id="accordionTwo-cost2"
                                                                    class="accordion-collapse collapse show"
                                                                    aria-labelledby="headingTwo-cost2"
                                                                    data-bs-parent="#accordionCost2">
                                                                    <div class="accordion-body p-0">
                                                                        <div id="block_i_saving_pallets"></div>

                                                                        <p>131,95₴ = 3 667₴ / 28</p>
                                                                    </div>
                                                                </div>
                                                            </div> -->

                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <h5 class="fw-semibold mb-1">
                                                            {{__('local_logist.log_confirmed_individual_saving')}}</h5>
                                                        <div class="row">
                                                            <div class="col-4 ">
                                                                <div class="text-center py-1 rounded"
                                                                    style="border-top: 2px solid #D9B414 !important;border: 2px dashed #DBDADE;">
                                                                    <p class="mb-0 fs-18">Silpo LLC</p>
                                                                    <p class="mb-0 fs-18" style="color:#A5A3AE">Saving
                                                                    </p>
                                                                    <p class="mb-0 fs-18 fw-bold ">1500 ₴</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-4 ">
                                                                <div class="text-center py-1 rounded"
                                                                    style="border-top: 2px solid #28C76F !important;border: 2px dashed #DBDADE;">
                                                                    <p class="mb-0 fs-18">Auchan LLC</p>
                                                                    <p class="mb-0 fs-18" style="color:#A5A3AE">Saving
                                                                    </p>
                                                                    <p class="mb-0 fs-18 fw-bold ">1500 ₴</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-4 ">
                                                                <div class="text-center py-1 rounded"
                                                                    style="border-top: 2px solid blue !important;border: 2px dashed #DBDADE;">
                                                                    <p class="mb-0 fs-18">RÖHLIG SUUS</p>
                                                                    <p class="mb-0 fs-18" style="color:A5A3AE">Profit
                                                                    </p>
                                                                    <p class="mb-0 fs-18 fw-bold ">1500 ₴</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <h5 class="fw-semibold mb-1">
                                                            {{__('local_logist.log_confirmed_your_additional_cost')}}
                                                        </h5>
                                                        <div class="d-flex justify-content-between">
                                                            <p>Consolid fee (for 5 pallets)</p>
                                                            <p>568 ₴ <i data-feather="info" class="me-25"></i></p>
                                                        </div>
                                                    </div>
                                                    <!-- =================== -->
                                                </div>

                                            </div>
                                        </div>
                                        <!--  -->
                                        <!-- маршрут рейсу -->
                                        <div style="" class="accordion border-top container-route"
                                            id="accordionForRoute2">
                                            <div class="accordion-item bg-c-transparent">
                                                <h2 class=" accordion-header mx-2" id="headingOne2">

                                                    <button class="bg-c-transparent accordion-button initialize-map"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#accordionRoute2" aria-expanded="true"
                                                        aria-controls="accordionRoute2">
                                                        {{__('local_logist.log_progress_route_path')}}
                                                    </button>
                                                </h2>
                                                <div id="accordionRoute2" class="accordion-collapse collapse "
                                                    aria-labelledby="headingOne2" data-bs-parent="#accordionForRoute2">
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

                        </div>
                        <div class="col-12 col-lg-5 p-1  p-lg-2 d-flex " style="background-color:white;">
                            <button type='button' class="w-100 btn btn-flat-danger mr-1 " tabindex="4" id=""><i
                                    data-feather="trash" class="me-25"></i>
                                {{__('local_logist.logist_bths_reject')}}
                            </button>
                            <button type='button' class="w-100 btn btn-outline-primary" tabindex="4" id="">
                                <span class="align-middle d-sm-inline-block"> <i data-feather="edit" class="me-25"></i>
                                    {{__('local_logist.logist_btbs_edit')}}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>

</div>