@php
    $currentURI = basename(parse_url(url()->current(), PHP_URL_PATH));
@endphp
<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xxl-2 px-0">
    <div class="card-header py-2">
        <h4 class="card-title fw-bolder">{{__('localization.dispatcher_cabinet')}}</h4>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item" style="background-color: #00000000; border-bottom: none;">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne"
                        style="background-color: #00000000;">
                    {{__('localization.dispatcher_trips')}}
                </button>
            </h2>
            <div id="accordionOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                <div class="accordion-body">
                    <div class="card-body">
                        <div class="col-md-3 col-sm-12 upload-nav-links" style="width: 100%;">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{$currentURI== 'dispatcher' ? 'active': ''}} justify-content-start align-items-start"
                                       id="stacked-pill-1"
                                       aria-expanded={{$currentURI == 'dispatcher' ?
                                        'true' : 'false href='.route('match.dispatcher.top-up') }}>
                                        {{__('localization.dispatcher_uploading')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{$currentURI == 'joint-ftl' ? 'active': ''}} d-flex justify-content-start align-items-start"
                                       id="stacked-pill-2" aria-expanded={{$currentURI == 'joint-ftl' ?
                                        'true' : 'false href='.route('match.dispatcher.joint-ftl')}}>
                                        {{__('localization.dispatcher_common_ftl')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{$currentURI == 'larger-transport' ? 'active': ''}} justify-content-start align-items-start"
                                       id="stacked-pill-3" aria-expanded={{$currentURI == 'larger-transport' ?
                                        'true' : 'false href='.route('match.dispatcher.larger-transport')}}>
                                        {{__('localization.dispatcher_lg_transport')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{$currentURI == 'reverse-loading' ? 'active': ''}} justify-content-start align-items-start"
                                       id="stacked-pill-4" aria-expanded={{$currentURI == 'reverse-loading' ?
                                        'true' : 'false href='.route('match.dispatcher.back-haul')}}>
                                        {{__('localization.dispatcher_rv_loading')}}
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
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo"
                        style="background-color: #00000000;">
                    {{__('localization.dispatcher_consolidation')}}
                </button>
            </h2>
            <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                <div class="accordion-body">
                    <div class="card-body">
                        <div class="col-md-3 col-sm-12 upload-nav-links" style="width: 100%;">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{$currentURI == 'created' ? 'active': ''}} justify-content-start align-items-start"
                                       id="stacked-pill-5" aria-expanded={{$currentURI == 'created' ?
                                        'true' : 'false href='.route('match.dispatcher.consolidation.created')}}>
                                        {{__('localization.dispatcher_created')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex {{$currentURI == 'draft' ? 'active': ''}} justify-content-start align-items-start"
                                       id="stacked-pill-6" aria-expanded={{$currentURI == 'draft' ?
                                        'true' : 'false href='.route('match.dispatcher.consolidation.draft')}}>
                                        {{__('localization.dispatcher_drafts')}}
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
