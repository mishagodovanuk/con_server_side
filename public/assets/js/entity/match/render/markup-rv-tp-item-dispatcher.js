import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

export function markupRvTpItemDispatcher(
    id,
    company,
    max_cargo_price,
    auto_capacity,
    weight,
    route,
    cargo_type
) {
    return `<div class="d-flex flex-column gap-1" style="width: 440px; border: 1px solid rgba(168, 170, 174, 0.16); padding: 20px; border-radius: 6px;">
    <div class="d-flex align-items-center gap-1">
    <span class="fw-semibold">${getLocalizedTextDispatcher('rv_name')} № ${id}</span> <img src="${
        window.location.origin
    }/assets/icons/truck-rv.svg" alt="">
</div>
<div class="">
    <span class="fw-semibold">${company}</span> <span>${max_cargo_price} ${getLocalizedTextDispatcher('hrn')}</span>
</div>
<div class="">
    <span>(${auto_capacity} ${getLocalizedTextDispatcher('pl')} / ${weight} ${getLocalizedTextDispatcher('kg')})</span> <span>${cargo_type
        .map((el) => `<span class="mb-0">${el}</span>`)
        .join(", ")}</span>
</div>
<div class="row">
    <div class="col-3 d-flex flex-column justify-content-between">
        <div class=""><span>${route[0].date.split(' ')[0]}</span></div>
        <div class=""><span>${route[route.length - 1].date.split(' ')[0]}</span></div>
    </div>
    <div class="col-1 d-flex"><img src="${
        window.location.origin
    }/assets/icons/timeline3.svg" alt=""></div>
    <div class="col-8 d-flex flex-column justify-content-between">
        <div class=""><span>${route[0].city} </span><span>(+${route[0].radius} км)</span></div>
        <div class=""><span>${route[route.length - 1].city} </span><span>(+${route[route.length - 1].radius} км)</span></div>
    </div>
</div>
</div>`;
}
