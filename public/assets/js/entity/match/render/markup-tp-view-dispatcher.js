import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

export function markupTpViewDispatcher(
    transport_planning_id,
    supplier,
    uploading,
    price,
    payer,
    created,
    edited,
    driver,
    transport,
    additionalEquipment,
    capacity,
    reserved,
    comment,
    provider,
    pallet_count
) {
    return `                    
                                    <div class="d-flex gap-1 align-items-center pb-2">
                                        <div class=""><img src="${window.location.origin}/assets/icons/driver.svg" alt=""></div>
                                        <div class="">
                                            <h5 class="mb-0">${getLocalizedTextDispatcher('transport_planning')} № <span id="trip-number">${transport_planning_id}</span></h5>
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="fw-semibold">${getLocalizedTextDispatcher('planning_data')}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('supplier')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${supplier}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('loading_warehouse')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${uploading}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('trip_price')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p>${price} UAH</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('payer')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${payer}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('edited')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p>${edited}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('created')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p>${created}</p>
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="fw-semibold">${getLocalizedTextDispatcher('carrier_data')}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('carrier')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${provider}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('driver')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${driver}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('transport')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${transport}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('additional_equipment')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${additionalEquipment}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('capacity')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p>${capacity} ${getLocalizedTextDispatcher('pl')}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('reserved')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="match-yellow-text">${pallet_count} ${getLocalizedTextDispatcher('pl')}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p>${getLocalizedTextDispatcher('comment')}</p>
                                        </div>
                                        <div class="col-7">
                                            <p>${comment}</p>
                                        </div>
                                    </div>
    `;
}
