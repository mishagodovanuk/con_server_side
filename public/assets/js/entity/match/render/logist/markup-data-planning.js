import { getLocalizedText } from "../../localization/getLocalizedText.js";

export function markupDataPlanning(data) {
    const url = window.location.origin;
    const {
        status,
        consolidation_type,
        created,
        route,
        members,
        download_point_count,
        trip_duration,
        cargo_types,
        unload_point_count,
        weight,
        pallets,
    } = data;

    var styleStatus;
    switch (status) {
        case "review":
            styleStatus = "alert-primary";
            break;
        case "draft":
            styleStatus = "alert-secondary";
            break;
        case "Підписано всіма":
        case "Signed by all":
            styleStatus = "alert-success";
            break;
        case "unapproved":
            styleStatus = "alert-danger";
            break;
        default:
            styleStatus = "alert-primary";
            break;
    }

    return ` <h6 class="fw-5 mb-1">${getLocalizedText("planning_data")}</h6>
    <div class="card-body px-0 py-0">
        <div class="d-flex">
            <p class="color-l-gray" style="width:180px; ">${getLocalizedText(
                "status"
            )}:</p>
            <div >
                <div class=" alert ${styleStatus} p-0 d-flex align-items-center gap-1 text-capitalize" style="padding : 2px 10px !important;">
                 ${status} ${
        status === "unapproved" ? `<i data-feather='eye'></i>` : ""
    }

                </div>
            </div>
        </div>
        <div class="d-flex">
            <p class="color-l-gray" style="width:180px; ">${getLocalizedText(
                "creation"
            )}:</p>
            <p>${created}</p>
        </div>
        <div class="d-flex">
            <p class="color-l-gray text-capitalize" style="width:180px; ">${getLocalizedText(
                "type_of_consolidation"
            )}:</p>
            <p>${consolidation_type}</p>
        </div>
        <div class="d-flex">
            <p class="color-l-gray" style="width:180px; ">${getLocalizedText(
                "route_points"
            )}:</p>
            <p>${route}</p>
        </div>
        <div class="d-flex">
            <p class="color-l-gray" style="width:180px; ">${getLocalizedText(
                "delivery_terms"
            )}:</p>
            <p>${trip_duration}</p>
        </div>
        <div class="d-flex">
            <p class="color-l-gray" style="width:180px; ">${getLocalizedText(
                "consolidation_participants"
            )}:</p>
            <div >
               ${members
                   .map(
                       (el) =>
                           `<a href=${
                               url + "/company/" + el.id
                           } class="d-block">${el.name}</a>`
                   )
                   .join("")}
            </div>
        </div>
        <div class="d-flex">
            <p class="color-l-gray" style="width:180px; ">${getLocalizedText(
                "truck_loading_points"
            )}:</p>
            <p>${download_point_count}</p>
        </div>
        <div class="d-flex">
            <p class="color-l-gray mb-0" style="width:180px; ">${getLocalizedText(
                "truck_unloading_points"
            )}:</p>
            <p class="mb-0">${unload_point_count}</p>
        </div>
    </div>
    <h6 class="fw-5 my-1">${getLocalizedText("freight")}</h6>
    <div class="card-body px-0 py-0">
        <div class="d-flex">
            <p class="color-l-gray" style="width:180px; ">${getLocalizedText(
                "freight_type"
            )}:</p>
            ${cargo_types.map((el) => `<p >${el}</p>`).join("")}
        </div>
        <div class="d-flex">
            <p class="color-l-gray" style="width:180px; ">${getLocalizedText(
                "pallet_space"
            )}:</p>
            <p>${pallets}/33</p>
        </div>
        <div class="d-flex">
            <p class="color-l-gray mb-0" style="width:180px; ">${getLocalizedText(
                "total_weight"
            )}:</p>
            <p class="mb-0">${weight}</p>
        </div>
    </div>
`;
}
