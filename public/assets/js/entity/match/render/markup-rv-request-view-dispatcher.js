import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

export function markupRvRequestViewDispatcher(
    id,
    company,
    transport,
    additional_equipment,
    driver,
    auto_capacity,
    max_cargo_price,
    cargo_type
) {
    return `                    
                                    <div class="d-flex gap-1 align-items-center pb-2">
                                        <div class=""><img src="${window.location.origin}/assets/icons/truck-rv.svg" alt=""></div>
                                        <div class="">
                                            <h5 class="mb-0">${getLocalizedTextDispatcher('rv_request')} № <span id="trip-number">${id}</span></h5>
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="fw-semibold">${getLocalizedTextDispatcher('rv_main_info')}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_company')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${company}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_transport')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${transport}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_add_equipt')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${additional_equipment}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_driver')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${driver}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_capacity')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p>${auto_capacity}</p>
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="fw-semibold">${getLocalizedTextDispatcher('rv_cargo')}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_limit')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="">${max_cargo_price} ${getLocalizedTextDispatcher('hrn')}</p>
                                        </div>
                                    </div>
                                    <div class="row pb-1">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_allowed')}</p>
                                        </div>
                                        <div class="col-7">
                                            ${cargo_type
                                            .map((el) => `<p class="mb-0">${el}</p>`)
                                            .join("")}
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="fw-semibold">${getLocalizedTextDispatcher('rv_price')}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_price_km')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="">30 ${getLocalizedTextDispatcher('hrn')}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_price_min')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="">20 000 ${getLocalizedTextDispatcher('hrn')}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_date')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p>14 ${getLocalizedTextDispatcher('rv_days')}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('rv_return')}:</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="">${getLocalizedTextDispatcher('rv_yes')}</p>
                                        </div>
                                    </div>
    `;
}
