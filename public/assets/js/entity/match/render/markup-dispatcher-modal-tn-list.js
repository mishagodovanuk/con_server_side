import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

export function markupUploadModalTnList(data, count) {
    return data.map(({id, palletsCount, weight, route, company_provider, company_recipient}) => `<div class="row px-1 py-2" style="background-color: rgba(168, 170, 174, 0.08); border-radius: 6px;">
    <div class="col-1 text-center">${count++}</div>
    <div class="col-11">
        <div class="d-flex flex-column" style="gap: 10px;">
            <div class="">
                <span class="match-modals-text-color"><span class="match-yellow-text pe-1">№ ${id}</span> ${getLocalizedTextDispatcher('ftl_modal_list_pallets')} <span class="" style="font-weight: 500;">${palletsCount} (${weight} ${getLocalizedTextDispatcher('kg')})</span></span>
            </div>
            <div class="">
                <span class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_list_supplier')} <span class="" style="font-weight: 500;">${company_provider.name}</span></span>
            </div>
            <div class="">
                <span class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_list_loading')} <span class="" style="font-weight: 500;">${route[0].warehouse_address}</span></span>
            </div>
            <div class="">
                <span class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_list_customer')} <span class="" style="font-weight: 500;">${company_recipient.name}</span></span>
            </div>
            <div class="">
                <span class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_list_unloading')} <span class="" style="font-weight: 500;">${route[route.length - 1].warehouse_address}</span></span>
            </div>
        </div>
    </div>
</div>`);
}
