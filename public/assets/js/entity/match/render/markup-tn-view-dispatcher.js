import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

export function markupTnViewDispatcher(
    id,
    created_at,
    status,
    contract_id,
    order_id,
    price_3pl,
    company_provider,
    company_recipient,
    location_provider,
    location_recipient,
    download_time,
    upload_time,
    comment
) {
    return `<div class="d-flex gap-1 align-items-center pb-2">
    <div class=""><img src="${window.location.origin}/assets/icons/transport-doc.svg" alt=""></div>
    <div class="">
        <h5 class="mb-0">${getLocalizedTextDispatcher('cn')} № <span id="tn-number-value">${id}</span></h5>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_created')}:</p>
    </div>
    <div class="col-7">
        <p>${created_at}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_status')}:</p>
    </div>
    <div class="col-7">
        <span class="badge badge-light-success">${status}</span>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_contract')}:</p>
    </div>
    <div class="col-7">
        <p class="match-yellow-text">№ ${contract_id}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_order_num')}:</p>
    </div>
    <div class="col-7">
        <p class="match-yellow-text">№ ${order_id}
        </p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_price')}:</p>
    </div>
    <div class="col-7">
        <p>${price_3pl} ${getLocalizedTextDispatcher('hrn')}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_supplier')}:</p>
    </div>
    <div class="col-7">
        <p class="match-yellow-text">${company_provider}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_recipient')}:</p>
    </div>
    <div class="col-7">
        <p class="match-yellow-text">${company_recipient}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_supplier_warehouse')}:</p>
    </div>
    <div class="col-7">
        <p class="match-yellow-text">${location_provider}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_recipient_warehouse')}:</p>
    </div>
    <div class="col-7">
        <p class="match-yellow-text">${location_recipient}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_loading_time')}:</p>
    </div>
    <div class="col-7">
        <p><span>${download_time}</span><br>
            <span style="color: rgba(75, 70, 92, 0.5);">(<span>${download_time}</span>)</span>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_unloading_time')}:</p>
    </div>
    <div class="col-7">
        <p><span><span>${upload_time}</span><br>
            <span style="color: rgba(75, 70, 92, 0.5);">(<span>${upload_time}</span>)</span>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('cn_comment')}:</p>
    </div>
    <div class="col-7">
        <p>${comment}</p>
    </div>
</div>`;
}
