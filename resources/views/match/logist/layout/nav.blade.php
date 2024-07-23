@php
    $currentURI = basename(parse_url(url()->current(), PHP_URL_PATH));
@endphp
<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xxl-2 px-0">
                <div class="card-header pb-2 pt-0">
                    <h4 class="card-title fw-bolder">{{__('local_logist.logist_cab')}}</h4>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item " style="background-color: #00000000; border-bottom: none;">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button ps-0 " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne"
                                    style="background-color: #00000000;">
                                    {{__('local_logist.logist_cab_queries')}}
                            </button>
                        </h2>
                        <div id="accordionOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                            <div class="accordion-body ps-0 pb-0">
                                <div class="card-body">
                                    <div class="col-md-3 col-sm-12 upload-nav-links" style="width: 100%;">
                                        <ul class="nav nav-pills flex-column">
                                            <li class="nav-item">
                                            <a class="nav-link {{ in_array($currentURI, ['logistician', 'pending-review']) ? 'active' : '' }} justify-content-start align-items-start"
                                       id="stacked-pill-1"
                                       aria-expanded={{in_array($currentURI, ['logistician', 'pending-review']) ? 
                                        'true' : 'false href='.route('match.logistician.pending-review') }}>
                                                   {{__('local_logist.logist_cab_pending_review')}}
                                                </a>
                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background-color: #00000000;">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed ps-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo"
                                    style="background-color: #00000000;">
                                    {{__('local_logist.logist_cab_consolidation')}}
                            </button>
                        </h2>
                        <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                            <div class="accordion-body ps-0">
                                <div class="card-body">
                                    <div class="col-md-3 col-sm-12 upload-nav-links" style="width: 100%;">
                                        <ul class="nav nav-pills flex-column">
                                            <li class="nav-item">
                                            <a class="nav-link {{$currentURI== 'in-progress' ? 'active': ''}} justify-content-start align-items-start"
                                       id="stacked-pill-1"
                                       aria-expanded={{$currentURI == 'in-progress' ?
                                        'true' : 'false href='.route('match.logistician.in-progress') }}>
                                                   {{__('local_logist.logist_cab_in_progress')}}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link {{$currentURI== 'confirmed' ? 'active-nav-log-confirmed': ''}} justify-content-start align-items-start"
                                       id="stacked-pill-1"
                                       aria-expanded={{$currentURI == 'confirmed' ?
                                        'true' : 'false href='.route('match.logistician.confirmed') }}>
                                                   {{__('local_logist.logist_cab_confirmed')}}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link {{$currentURI== 'rejected' ? 'active': ''}} justify-content-start align-items-start"
                                       id="stacked-pill-1"
                                       aria-expanded={{$currentURI == 'rejected' ?
                                        'true' : 'false href='.route('match.logistician.rejected') }}>
                                                   {{__('local_logist.logist_cab_rejected')}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>