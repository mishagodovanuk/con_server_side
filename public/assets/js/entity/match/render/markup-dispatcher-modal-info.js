import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

export function markupUploadModalInfo(
    upload,
    offload,
    startDate,
    endDate,
    supplier,
    tnParticipants,
    price,
    uploadingQuantity,
    offloadingQuantity,
    filteredTnCargoTypes,
    totalPallets,
    totalWeight,
    capacity,
    consolidationType,
    common_weight
) {
    return `
    <div class="">
    <div class="">
        <p class="fw-semibold match-modals-text-color">${getLocalizedTextDispatcher('modal_data_plan')}</p>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_type')} </p>
        </div>
        <div class="col-8">
            <p class="match-modals-text-color" id="modalConsolidationType">${consolidationType}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_route')}</p>
        </div>
        <div class="col-8">
            <p class="match-modals-text-color">${upload} - ${offload}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_date')} </p>
        </div>
        <div class="col-8">
            <p class="match-modals-text-color">${startDate} - ${endDate}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_participants')}</p>
        </div>
        <div class="col-8">
            <div class="">
                <p class="match-yellow-text">${supplier}</p>
            </div>
            <div class="">
            ${tnParticipants.map(
                (el) => `<p class="match-yellow-text">${el.suplier}</p>`
            ).join('')}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_price')}</p>
        </div>
        <div class="col-8">
            <div class="">
                <p class="match-modals-text-color">
                ${supplier} - ${price} ${getLocalizedTextDispatcher('hrn')}
                </p>
            </div>
            <div class="">
                ${tnParticipants.map(
                    (el) =>
                        `<p class="match-modals-text-color">${el.suplier} - ${el.price} UAH</p>`
                ).join('')}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_points')}</p>
        </div>
        <div class="col-8">
            <p class="match-modals-text-color">${uploadingQuantity}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_points_unload')}</p>
        </div>
        <div class="col-8">
            <p class="match-modals-text-color">${offloadingQuantity}</p>
        </div>
    </div>
    <div class="">
        <p class="fw-semibold match-modals-text-color">${getLocalizedTextDispatcher('modal_cargo')}</p>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_cargo_type')}</p>
        </div>
        <div class="col-8">
            <span class="match-modals-text-color">${filteredTnCargoTypes.map(
                (el) =>
                    `<span class="match-modals-text-color">${el}</span>`
            ).join(', ')}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_pallets')}</p>
        </div>
        <div class="col-8">
            <p class="match-modals-text-color"><span id="modalTotalPallets">${totalPallets}</span>/<span id="modalCapacityPallets">${capacity}</span></p>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="match-modals-text-color">${getLocalizedTextDispatcher('modal_weight')}</p>
        </div>
        <div class="col-8">
            <p class="match-modals-text-color"><span id="modalTotalWeight">${totalWeight}</span>/<span id="modalCapacityWeight">${common_weight}</span> ${getLocalizedTextDispatcher('kg')}</p>
        </div>
    </div>
    <div class="">
        <p class="fw-semibold match-modals-text-color">${getLocalizedTextDispatcher('modal_comment')}</p>
    </div>
    <div class="row">
        <div class="col-12">
            <textarea
                class="form-control"
                id="exampleFormControlTextarea1"
                rows="3"
                placeholder="${getLocalizedTextDispatcher('modal_hint')}"
                style="max-height: 200px;"
            ></textarea>
        </div>
    </div>
    </div>
    `;
}
