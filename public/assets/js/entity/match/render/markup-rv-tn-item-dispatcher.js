import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

export function markupRvTnItemDispatcher(
    number,
    company,
    uploading,
    price,
    offloading,
    weight,
    route,
    type,
    pallets
) {
    return `
    <div class="d-flex flex-column gap-1" style="width: 440px; border: 1px solid rgba(168, 170, 174, 0.16); padding: 20px; border-radius: 6px;">
    <div class="d-flex align-items-center gap-1">
    <span class="fw-semibold">${getLocalizedTextDispatcher('rv_route')} № ${number}</span> <img src="${
        window.location.origin
    }/assets/icons/consolidation-icon.svg" alt="">
</div>
<div class="">
    <span class="fw-semibold">Top-up</span> <span>${price} ${getLocalizedTextDispatcher('hrn')}</span>
</div>
<div class="">
    <span>(${pallets} ${getLocalizedTextDispatcher('pl')} / ${weight} ${getLocalizedTextDispatcher('kg')})</span> <span>${type}</span>
</div>
<div class="row">
    <div class="col-3 d-flex flex-column justify-content-between">
        <div class=""><span>${route[0].time.date}</span></div>
        <div class=""><span>${route[route.length - 1].time.date}</span></div>
    </div>
    <div class="col-1 d-flex"><img src="${
        window.location.origin
    }/assets/icons/timeline3.svg" alt=""></div>
    <div class="col-8 d-flex flex-column justify-content-between">
        <div class=""><span>${uploading}</span></div>
        <div class=""><span>${offloading}</span></div>
    </div>
</div>
</div>`;
}
