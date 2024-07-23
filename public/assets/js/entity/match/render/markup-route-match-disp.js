import {getLocalizedText} from '../localization/getLocalizedText.js'

export function markupRouteMatchDisp(route) {
    return route.map(({time_from, time_to, warehouse_city_or_name, type, warehouse_address, time_range, time},i)=>`    <div class="row">
    <div class="col-2">
        <div class="d-flex justify-content-between">
            <div class="" style="display: flex; flex-direction: column; gap: 8px;">
                <div class="">
                    <span>${time_from}</span>
                </div>
                <div class="">
                    <span>${time_to}</span>
                </div>
            </div>
            <div class="">
           <div class=""><img src="${window.location.origin}/assets/icons/${i !== route.length - 1 ? 'timeline2':'timeline' }.svg" /></div>
            </div>
        </div>
    </div>
    <div class="col-6" style="display: flex; flex-direction: column; gap: 8px;">
        <div class="fw-5 text-black"><span>${warehouse_city_or_name} (${type})</span></div>
        <div class=""><span>${warehouse_address}</span></div>
        <div class=""><span>${time_range}</span></div>
    </div>
    <div class="col-4">
        <p class="fw-5 color-l-gray text-end">${time} ${getLocalizedText("min")}</p>
    </div>
</div>
`)
}

  