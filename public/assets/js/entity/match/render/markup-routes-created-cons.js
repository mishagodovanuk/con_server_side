import { getLocalizedText } from "../localization/getLocalizedText.js";

export function markupRoutesCreatedConsolid(route) {
    const url = window.location.origin;
    return route.map(
        (
            {
                time_from,
                time_to,
                warehouse_city_or_name,
                type,
                warehouse_address,
                time_range,
                time,
                members,
                self_pallets,
                common_pallets,
                weight,
                common_weight,
            },
            i
        ) => `    <div class="row">
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
           <div class=""><img src="${url}/assets/icons/${
            i !== route.length - 1 ? "timeline-lg" : "timeline"
        }.svg" /></div>
            </div>
        </div>
    </div>
    <div class="col-6" style="display: flex; flex-direction: column; gap: 8px;">
        <div class="fw-5 text-black"><span>${warehouse_city_or_name} (${type})</span></div>
        <div class=""><span>${warehouse_address}</span></div>
        <div class=""><span>${time_range}</span></div>
      
    </div>
    <div class="col-4">
        <p class="fw-5 color-l-gray text-end">${time} ${getLocalizedText(
            "min"
        )}</p>
    </div>
</div>
`
    );
}



  // <div class="d-flex" style="gap: 10px;">
        //     <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
        //      <img src="${url}/assets/icons/users.svg"/> <p class="match-light-gray-text m-0">${members}</p>
        //     </div>
        //     <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:8px;">
        //         <img src="${url}/assets/icons/box-multiple.svg"/> <p class="match-light-gray-text m-0 ">${self_pallets}/${common_pallets}</p>
        //     </div>
        //     <div class="d-flex align-items-center" style="background: rgba(168, 170, 174, 0.16); padding: 2px 10px; border-radius: 4px; gap:5px;">
        //         <img src="${url}/assets/icons/scale-outline.svg" /> <p class="match-light-gray-text m-0 ">${weight} / ${common_weight} ${getLocalizedText(
        //     "kg"
        // )}</p>
        //     </div>
        // </div>