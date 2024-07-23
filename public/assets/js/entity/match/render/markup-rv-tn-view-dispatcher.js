import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

export function markupRvTnViewDispatcher(
    number,
    sendingDate,
    deliveryDate,
    created,
    status,
    uploadingCity,
    offloadingCity
) {
    return `<div class="d-flex gap-1 align-items-center pb-2">
    <div class=""><img src="${window.location.origin}/assets/icons/consolidation-icon.svg" alt=""></div>
    <div class="">
        <h5 class="mb-0">${getLocalizedTextDispatcher('rv_consolidation')} № <span id="tn-number-value">${number}</span></h5>
    </div>
</div>
<div class="">
    <p class="fw-semibold">${getLocalizedTextDispatcher('rv_data_plan')}</p>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_status')}</p>
    </div>
    <div class="col-7">
        <span class="badge badge-light-primary">${status}</span>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_created')}</p>
    </div>
    <div class="col-7">
        <p class="">${created}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_type')}</p>
    </div>
    <div class="col-7">
        <p class="match-yellow-text">Top-up
        </p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_route')}</p>
    </div>
    <div class="col-7">
        <p>${uploadingCity} - ${offloadingCity}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_duration')}</p>
    </div>
    <div class="col-7">
        <p class="">${sendingDate} - ${deliveryDate}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_participants')}</p>
    </div>
    <div class="col-7">
        <p class="match-yellow-text">LLC "Kormotech"</p>
        <p class="match-yellow-text">LLC "Svitoch"</p>
        <p class="match-yellow-text">LLC "Textile plus"</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_points')}</p>
    </div>
    <div class="col-7">
        <p class="">3</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_unload_points')}</p>
    </div>
    <div class="col-7">
        <p class="">3</p>
    </div>
</div>
<div class="">
    <p class="fw-semibold">${getLocalizedTextDispatcher('rv_tn_cargo')}</p>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_cargo_type')}</p>
    </div>
    <div class="col-7">
        <p>Food products</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_pallets')}</p>
    </div>
    <div class="col-7">
        <p>35/33</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher('rv_tn_weight')}</p>
    </div>
    <div class="col-7">
        <p>23 400/20 000 ${getLocalizedTextDispatcher('kg')}</p>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center">
    <div><p class="fw-semibold">${getLocalizedTextDispatcher('rv_tn_comment')}</p></div>
    <div><img src="${window.location.origin}/assets/icons/edit-btn.svg" alt=""></div>
</div>
<div class="row">
    <div class="col-12">
        <textarea class="w-100" style="height: 100px; resize: none; border: 1px solid #DBDADE; color: rgba(75, 70, 92, 0.5); padding: 8px;"></textarea>
    </div>
</div>
`;
}
