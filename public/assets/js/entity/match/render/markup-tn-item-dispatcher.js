import { getLocalizedTextDispatcher } from "../localization/getLocalizedText_dispatcher.js";

export function markupTnItemDispatcher(
    id,
    company_provider,
    price_3pl,
    palletsCount,
    weight,
    categories,
    route
) {
    // On hover, show the trash icon, delete tn item
    $(document).ready(function () {
        $(".tn-item").hover(
            function () {
                $(this).find(".tn-delete-item-button").show();
            },
            function () {
                $(this).find(".tn-delete-item-button").hide();
            }
        );
    });
    return `
    <div class="d-flex flex-column gap-1 tn-item" style="width: 440px; border: 1px solid rgba(168, 170, 174, 0.16); padding: 20px; border-radius: 6px;">
    <div class="d-flex align-items-center gap-1 justify-content-between">
    <div class="d-flex align-items-center gap-1"><span class="fw-semibold">${getLocalizedTextDispatcher(
        "cn_trip"
    )} № <span class="tn-item-id">${id}</span></span> <img src="${
        window.location.origin
    }/assets/icons/transport-doc.svg" alt=""></div>
    <div class=""><img class="tn-delete-item-button" src="${
        window.location.origin
    }/assets/icons/trash-delete.svg" alt="" style="cursor: pointer; display: none;"></div>
</div>
<div class="">
    <span class="fw-semibold">${company_provider}</span> <span>${price_3pl} ${getLocalizedTextDispatcher(
        "hrn"
    )}</span>
</div>
<div class="">
    <span>(${palletsCount} ${getLocalizedTextDispatcher(
        "pl"
    )} / ${weight} ${getLocalizedTextDispatcher(
        "kg"
    )})</span> <span>${categories.map((el) => el)}</span>
</div>
<div class="row">
    <div class="col-3 d-flex flex-column justify-content-between">
        <div class=""><span>${route[0].time_range.split(" ")[0]}</span></div>
        <div class=""><span>${
            route[route.length - 1].time_range.split(" ")[0]
        }</span></div>
    </div>
    <div class="col-1 d-flex"><img src="${
        window.location.origin
    }/assets/icons/timeline3.svg" alt=""></div>
    <div class="col-8 d-flex flex-column justify-content-between">
        <div class=""><span>${route[0].warehouse_address}</span></div>
        <div class=""><span>${
            route[route.length - 1].warehouse_address
        }</span></div>
    </div>
</div>
</div>`;
}
