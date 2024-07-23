import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

export function markupTpItemDispatcher(
                    transport_planning_id,
                    company_supplier,
                    price,
                    pallet_count,
                    weight,
                    route,
                    cargo_type
) {
    return `<div class="d-flex flex-column gap-1" style="width: 440px; border: 1px solid rgba(168, 170, 174, 0.16); padding: 20px; border-radius: 6px;">
    <div class="d-flex align-items-center gap-1">
    <span class="fw-semibold">${getLocalizedTextDispatcher('trip_tp')} № <span id="tp-item-id">${transport_planning_id}</span></span> <img src="${
        window.location.origin
    }/assets/icons/driver.svg" alt="">
</div>
<div class="">
    <span class="fw-semibold">${company_supplier}</span> <span>${price} ${getLocalizedTextDispatcher('hrn')}</span>
</div>
<div class="">
    <span>(${pallet_count} ${getLocalizedTextDispatcher('pl')} / ${weight} ${getLocalizedTextDispatcher('kg')})</span> <span>${cargo_type}</span>
</div>
<div class="row">
    <div class="col-3 d-flex flex-column justify-content-between">
        <div class=""><span>${route[0].time_range.split(' ')[0]}</span></div>
        <div class=""><span>${route[route.length - 1].time_range.split(' ')[0]}</span></div>
    </div>
    <div class="col-1 d-flex"><img src="${
        window.location.origin
    }/assets/icons/timeline3.svg" alt=""></div>
    <div class="col-8 d-flex flex-column justify-content-between">
        <div class=""><span>${route[0].warehouse_address}</span></div>
        <div class=""><span>${route[route.length - 1].warehouse_address}</span></div>
    </div>
</div>
</div>`;
}
