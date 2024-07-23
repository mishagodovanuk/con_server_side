import { getLocalizedTextDispatcher } from "../localization/getLocalizedText_dispatcher.js";

export function markupCreatedConsolidationView(data, id) {
    const {
        cargo_types,
        comment,
        common_weight,
        consolidation_type,
        created,
        created_by,
        members,
        route,
        status,
        trip_duration,
    } = data;

    return `<div class="d-flex gap-1 align-items-center pb-2">
    <div class="">
        <h5 class="mb-0">${getLocalizedTextDispatcher(
            "created_view_cons"
        )} № <span id="tn-number-value">${id}</span></h5>
    </div>
</div>
<div class="">
    <p class="fw-semibold">${getLocalizedTextDispatcher(
        "created_view_data_plan"
    )}</p>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_status")}</p>
    </div>
    <div class="col-7">
        <span class=" text-capitalize created-status alert alert-${
            status === "unapproved"
                ? "danger"
                : status === "approved"
                ? "success"
                : status == "review"
                ? "info"
                : status === "draft"
                ? "secondary"
                : "primary"
        }"  style="padding : 2px 10px !important;"
                    >${status} </span>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_create")}</p>
    </div>
    <div class="col-7">
        <p class="">${created} <span class="match-yellow-text text-capitalize">${
        created_by.name
    }</span></p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_type")}</p>
    </div>
    <div class="col-7">
        <p class="match-yellow-text text-capitalize">${consolidation_type}
        </p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_route")}</p>
    </div>
    <div class="col-7">
        <p>${route}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_duration")}</p>
    </div>
    <div class="col-7">
        <p class="">${trip_duration}</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_participants")}</p>
    </div>
    <div class="col-7">
    ${members
        .map((el) => `<p class="match-yellow-text">${el.name}</p>`)
        .join("")}
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_points")}</p>
    </div>
    <div class="col-7">
        <p class="">2</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_unload_points")}</p>
    </div>
    <div class="col-7">
        <p class="">2</p>
    </div>
</div>
<div class="">
    <p class="fw-semibold">${getLocalizedTextDispatcher(
        "created_view_cargo"
    )}</p>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_cargo_type")}</p>
    </div>
    <div class="col-7">
        ${cargo_types.map((el) => `<p>${el}</p>`).join("")}
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_pallets")}</p>
    </div>
    <div class="col-7">
        <p>28/33</p>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <p>${getLocalizedTextDispatcher("created_view_weight")}</p>
    </div>
    <div class="col-7">
        <p>${common_weight} ${getLocalizedTextDispatcher("kg")}</p>
    </div>
</div>
<div>
    <p class="fw-semibold">${getLocalizedTextDispatcher(
        "created_view_comment"
    )}</p>
</div>
<div class="row">
<div class="col-1">
<img src=${created_by.image_link} alt=""
    style="width:26px;height:26px;border-radius:50%">
</div>
<div class="col-11">
    <p class="match-yellow-text text-capitalize">${created_by.name}</p>
    <p class="text-capitalize">${comment}</p>
</div>
</div>
`;
}
