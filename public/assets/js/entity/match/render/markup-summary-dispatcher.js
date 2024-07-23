export function markupSummaryDispatcher(button, modal, tpSupplier, company) {
    return `
    <div id="summary-container" class="" style="display: flex; width: 100%; height: 304px; border-radius: 6px; box-shadow: 0px 4px 18px 0px rgba(75, 70, 92, 0.10); flex: 2; position: relative;">
    <div class="d-flex" style="background-color: #28C76F; color: #fff; position: absolute; right: 0; border-top-right-radius: 6px; border-bottom-left-radius: 6px; padding-left: 10px; padding-right: 10px"><span>-24%</span></div>
    <div class="d-flex flex-column justify-content-between p-2" style="height: 100%; width: 100%">
        <div class="">
            <div class="d-flex justify-content-between">
                <div class="">
                    <p class="match-summary-title">Price per route:</p>
                </div>
                <div class="">
                    <p class="match-summary-text">26 000 ₴ <span style="text-decoration-line: line-through; opacity: 0.5">30 500 ₴</span></p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <span class="match-summary-title">Profit:</span>
                </div>
                <div class="d-flex align-items-center" style="gap: 8px">
                    <div class=""><img data-bs-toggle="tooltip" title="The price is indicated without additional costs" src="${window.location.origin}/assets/icons/info-circle.svg" /></div>
                    <div class=""><span class="match-summary-text" style="font-size: 18px; font-weight: 600">4 500 ₴</span></div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div class="">
                    <p class="match-summary-title">${tpSupplier}:</p>
                </div>
                <div class="">
                    <p class="match-summary-text">- 2000 ₴ <span style="background-color: rgba(40, 199, 111, 0.2); padding: 4px 10px; border-radius: 6px; color: rgba(40, 199, 111, 1); font-weight: 600">-10%</span></p>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="">
                    <p class="match-summary-title">${company}</p>
                </div>
                <div class="">
                    <p class="match-summary-text">- 2000 ₴ <span style="background-color: rgba(40, 199, 111, 0.2); padding: 4px 10px; border-radius: 6px; color: rgba(40, 199, 111, 1); font-weight: 600">-10%</span></p>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <button type="button" class="btn btn-primary waves-effect waves-float waves-light w-100" id="${button}" data-bs-toggle="modal" data-bs-target="${modal}">Create consolidation
            </button>
        </div>
    </div>
</div>`;
}
