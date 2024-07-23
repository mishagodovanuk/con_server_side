import { markupTpViewDispatcher } from "./render/markup-tp-view-dispatcher.js";
import { markupItemRouteDisp } from "./render/markup-item-route-disp.js";
import { markupRouteMatchDisp } from "./render/markup-route-match-disp.js";
import { markupTpItemDispatcher } from "./render/markup-tp-item-dispatcher.js";
import { markupTnViewDispatcher } from "./render/markup-tn-view-dispatcher.js";
import { markupTnItemDispatcher } from "./render/markup-tn-item-dispatcher.js";
import { markupUploadModalInfo } from "./render/markup-dispatcher-modal-info.js";
import { markupUploadModalTnList } from "./render/markup-dispatcher-modal-tn-list.js";
import { markupSummaryDispatcher } from "./render/markup-summary-dispatcher.js";
import { markupModalRoutesDisp } from "./render/markup-modal-routes-disp.js";
import { getInfoConsolidation } from "./utils/getInfoConsolidation.js";

let tpData = [];
let tnData = [];

// hidden default pages
$(
    "#tp-view-container, #add-new-consolidation-view, #added-consolidation-view"
).hide();

//  add TP item from table to consolidation
$(document).on("click", ".add-item-tp", function () {
    const tpId = $(this).data("id");
    fetchAndRenderTpItem(tpId);
    transportPlanningId = tpId;
});

//  add TP item from view page  to consolidation
$(document).on("click", "#add-tp-to-consolidation", function (e) {
    const tpId = String($("#trip-number").text());
    fetchAndRenderTpItem(tpId);
    transportPlanningId = tpId;

    $("#tp-view-container").hide();
});

function fetchAndRenderTpItem(id) {
    goodsInvoiceDataSource.url =
        window.location.origin +
        "/match/goods-invoice/filter?transportPlanningId=" +
        id +
        "&tab=all";

    $("#goods-invoices-table").jqxGrid("updatebounddata");

    //Reserve tp
    fetch("/match/transport-planning/reserve", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            _token: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            id: id,
        }),
    });

    //Add tp item
    $.ajax({
        url: "/match/transport-planning/get-info/" + id,
        type: "GET",
        contentType: "application/json",
        success: async function (response) {
            const data = await response;
            tpData.push(data);
            renderTpItem(data);
            calculateSum(id);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
    });

    function renderTpItem(data) {
        const {
            transport_planning_id,
            company_supplier,
            price,
            pallet_count,
            route,
            weight,
        } = data;

        const cargoType = $("#cargo-type" + transport_planning_id).text();
        $(".tn-item-container").empty();
        $(".tn-item-container").html(
            markupTpItemDispatcher(
                transport_planning_id,
                company_supplier.name,
                price,
                pallet_count,
                weight,
                route,
                cargoType
            )
        );
    }

    $("#main-wizard, #choose-tp-view, #consolidation-list").show();
    $("#account-details-modern-trigger").removeClass("active");
    $("#personal-info-modern-trigger").addClass("active");
    $("#account-details-modern").removeClass("active dstepper-block");
    $("#personal-info-modern").addClass("active dstepper-block");
    $("#account-details-modern-trigger").addClass("crossed");
}

//  view TP details
$(document).on("click", ".btn-view-tp-details", function (e) {
    let tpID = $(this).data("id");

    $.ajax({
        url: "/match/transport-planning/get-info/" + tpID,
        type: "GET",
        contentType: "application/json",
        success: async function (response) {
            const data = await response;
            tpViewRender(data);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
    });

    function tpViewRender(data) {
        const {
            transport_planning_id,
            company_supplier,
            download_warehouse,
            price,
            payer,
            created_at,
            updated_at,
            driver,
            transport,
            additional_equipment,
            reserved,
            comment,
            provider,
            pallet_count,
            route,
        } = data;

        $("#data-plan-container").empty();
        $("#data-trip-container").empty();
        $("#data-plan-container").html(
            markupTpViewDispatcher(
                transport_planning_id,
                company_supplier.name,
                download_warehouse.name,
                price,
                payer.name,
                created_at,
                updated_at,
                driver.full_name,
                transport.license_plate,
                additional_equipment.license_plate,
                additional_equipment.carrying_capacity,
                reserved,
                comment,
                provider.name,
                pallet_count
            )
        );
        $("#data-trip-container").html(markupItemRouteDisp(route));
        $("#tp-number-span").text(transport_planning_id);
    }

    $("#main-wizard, #choose-tp-view, #consolidation-list").hide();
    $("#tp-view-container").show();
});

//  add TN item from table to consolidation
$(document).on("click", ".add-tn-item", function (e) {
    const tnId = $(this).data("id");
    const tpId = $("#tp-item-id").text();

    fetchAndRenderTnItem(tnId, tpId);
});

//  add TN item from view page to consolidation
$(document).on("click", "#add-tn-to-consolidation", function (e) {
    const tnId = String($("#tn-number-value").text());
    const tpId = $("#tp-item-id").text();

    fetchAndRenderTnItem(tnId, tpId);

    $(
        "#main-wizard, #consolidation-list, #all-consolidation-tables, #summary-container"
    ).show();
    $("#add-new-consolidation-view").hide();
});

function fetchAndRenderTnItem(tnId, tpId) {
    $.ajax({
        url:
            "/match/goods-invoice/get-info/" +
            tnId +
            "?transport_planning_id=" +
            tpId,
        type: "GET",
        contentType: "application/json",
        success: async function (response) {
            const { data } = await response;
            // check if tnData has duplicate objects
            const isObjectExists = tnData.some((obj) => obj.id === data.id);
            if (isObjectExists) {
                alert("Обрана ТН уже додана до консолідації");
                return;
            } else {
                tnData.push(data);
                renderTnItem(data);
                calculateParticipants();
                calculatePalletsSum(tnData);
                calculateWeightSum(tnData);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
    });

    function renderTnItem(data) {
        const {
            id,
            company_provider,
            price_3pl,
            palletsCount,
            weight,
            categories,
            route,
        } = data;

        const tpSupplier = tpData[0].company_supplier.name;
        const company = company_provider.name;

        $(".tn-item-container").append(
            markupTnItemDispatcher(
                id,
                company_provider.name,
                price_3pl,
                palletsCount,
                weight,
                categories,
                route
            )
        );
        $("#summary-container").remove();
        $("#summary").append(
            markupSummaryDispatcher(
                "create-consolidation",
                "#large",
                tpSupplier,
                company
            )
        );
    }
}

//  view TN item
$(document).on("click", ".btn-view-tn-item", function (e) {
    const tnId = $(this).data("id");
    const tpId = $("#tp-item-id").text();

    $.ajax({
        url:
            "/match/goods-invoice/get-info/" +
            tnId +
            "?transport_planning_id=" +
            tpId,
        type: "GET",
        contentType: "application/json",
        success: async function (response) {
            const { data } = await response;
            tnViewRender(data);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
    });

    function tnViewRender(data) {
        const {
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
            comment,
            route,
        } = data;

        $("#tn-data-view2").empty();
        $("#tn-data-view2").html(
            markupTnViewDispatcher(
                id,
                created_at,
                status,
                contract_id,
                order_id,
                price_3pl,
                company_provider.name,
                company_recipient.name,
                location_provider.name,
                location_recipient.name,
                download_time,
                upload_time,
                comment
            )
        );
        $("#data-match-trip-container").html(markupRouteMatchDisp(route));
        $("#data-match-trip-container > div:first-child").css("opacity", "0.5");
        $("#data-match-trip-container > div:last-child").css("opacity", "0.5");
        $("#tp-tn-match").text(tpId);
        $("#tn-number-span").text(id);
    }

    $(
        "#main-wizard, #consolidation-list, #all-consolidation-tables, #summary-container"
    ).hide();
    $("#add-new-consolidation-view").show();
});

// Delete tn item from create consolidation container
$(document).on("click", ".tn-delete-item-button", function () {
    const tnId = $(this).closest(".tn-item").find(".tn-item-id").text();
    tnData = tnData.filter(function (obj) {
        return obj.id != tnId;
    });
    if (tpData.length > 0 && tnData.length > 0) {
        $("#create-consolidation").prop("disabled", false);
    } else {
        $("#create-consolidation").prop("disabled", true);
    }
    $(this).closest(".tn-item").remove();
});

// delete all items from create consolidation container
$(document).on(
    "click",
    "#uploading-delete-btn, #delete-all-modal-button, #continue-working-button, #cancel-consolidation-button",
    function (e) {
        tpData = [];
        tnData = [];
        unreserveTp();
        $(".tn-item-container").empty();
        $("#account-details-modern-trigger").addClass("active");
        $("#personal-info-modern-trigger").removeClass("active");
        $("#account-details-modern").addClass("active dstepper-block");
        $("#personal-info-modern").removeClass("active dstepper-block");
        $("#account-details-modern-trigger").removeClass("crossed");
        $("#create-consolidation").prop("disabled", true);
        $("#summary-container").remove();
    }
);

// create previously !!! consolidation and get all info
$(document).on("click", "#create-consolidation", function (e) {
    const {
        company_supplier,
        price,
        additional_equipment,
        pallet_count,
        weight,
        route,
        common_weight,
        transport_planning_id,
        provider,
    } = tpData[0];

    // General Info Modal
    const startDate = route[0].time_range.split(" ")[0];
    const endDate = route[route.length - 1].time_range.split(" ")[0];
    const uploadLocation = route[0].warehouse_city_or_name;
    const offloadLocation = route[route.length - 1].warehouse_city_or_name;

    const tnParticipants = tnData.map(
        ({ company_provider: { name }, price_3pl }) => ({
            suplier: name,
            price: price_3pl,
        })
    );
    const tnCargoTypes = tnData.map(({ categories }) => categories.join(""));
    const filteredTnCargoTypes = [...new Set(tnCargoTypes)];

    const tpUploadingQuantity = route.filter(
        ({ type }) => type === "download"
    ).length;
    const tpOffloadingQuantity = route.filter(
        ({ type }) => type === "upload"
    ).length;

    const tnUploadingQuantity = tnData.filter((obj) =>
        obj.route.some((routeObj) => routeObj.type === "download")
    ).length;
    const tnOffloadingQuantity = tnData.filter((obj) =>
        obj.route.some((routeObj) => routeObj.type === "upload")
    ).length;

    const uploadingQuantity = (
        tpUploadingQuantity + tnUploadingQuantity
    ).toString();
    const offloadingQuantity = (
        tnOffloadingQuantity + tpOffloadingQuantity
    ).toString();

    const tnPalletsSum = tnData.reduce(
        (sum, { palletsCount }) => sum + parseInt(palletsCount),
        0
    );
    const totalPallets = (tnPalletsSum + parseInt(pallet_count)).toString();

    const tnWeightSum = tnData.reduce(
        (sum, { weight }) => sum + parseInt(weight),
        0
    );
    const totalWeight = (tnWeightSum + parseInt(weight)).toString();

    $("#upload-modal-info").empty();
    $("#upload-modal-info").html(
        markupUploadModalInfo(
            uploadLocation,
            offloadLocation,
            startDate,
            endDate,
            company_supplier.name,
            tnParticipants,
            price,
            uploadingQuantity,
            offloadingQuantity,
            filteredTnCargoTypes,
            totalPallets,
            totalWeight,
            additional_equipment.carrying_capacity,
            getInfoConsolidation().name,
            common_weight
        )
    );

    // modal tn list info
    const count = 2;

    $("#upload-modal-tn-list").empty();
    $("#tp-item-number").text(transport_planning_id);
    $("#tp-item-pallets").text(pallet_count);
    $("#tp-item-weight").text(weight);
    $("#tp-item-supplier").text(company_supplier.name);
    $("#tp-item-uploading").text(route[0].warehouse_address);
    $("#tp-item-offloading").text(route[route.length - 1].warehouse_address);
    $("#tp-item-customer").text(provider.name);
    $("#upload-modal-tn-list").append(markupUploadModalTnList(tnData, count));

    // Get all routes for modal
    let invoicesUrl = "";
    tnData.forEach(({ id }, i) => {
        invoicesUrl += "goods_invoices[]=" + id;
        if (i < tnData.length - 1) {
            invoicesUrl += "&";
        }
    });

    $.ajax({
        url:
            "/match/get-route-by-planning/" +
            transport_planning_id +
            "?" +
            invoicesUrl,
        type: "GET",
        contentType: "application/json",
        success: async function (response) {
            const route = await response;

            $("#modal-all-routes").html(markupModalRoutesDisp(route));
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
    });
});

// Show final modal in create consolidation
$(document).on("click", "#create-consolidation-btn", function (e) {
    $("#tabs2, .modal-footer").hide();
    $("#added-consolidation-view").show();
});

// Sending create consolidation data
$(document).on("click", "#confirm-consolidation-btn", function (e) {
    createConsolidation();
    $("#tabs2, .modal-footer").show();
    $("#added-consolidation-view").hide();
});

// Sending draft create consolidation data
$(document).on("click", "#draft-create-consolidation", function (e) {
    createConsolidation("drafts");
});

function createConsolidation(status = "") {
    const tnCargoTypeId = [...tnData].map((item) => item.cargoTypeIds.join());
    const tpCargoTypeId = [...tpData].map((item) => item.cargoTypeIds.join());
    const tpTnCargoTypeId = tpCargoTypeId.concat(tnCargoTypeId);
    const comment = $("#exampleFormControlTextarea1").val();

    var formData = new FormData();
    formData.append(
        "_token",
        document.querySelector('meta[name="csrf-token"]').content
    );

    if (status === "drafts") {
        formData.append("status", "draft");
    }
    formData.append("members", $("#total-participants").text());
    formData.append("transport_planning_id", $("#tp-item-number").text());
    formData.append("pallets_available", $("#modalCapacityPallets").text());
    formData.append("pallets_booked", $("#modalTotalPallets").text());
    formData.append("weight_available", $("#modalCapacityWeight").text());
    formData.append("weight_booked", $("#modalTotalWeight").text());
    formData.append("comment", comment ? comment : "no comments");
    formData.append("type", getInfoConsolidation().type);
    tpTnCargoTypeId.forEach((el, i) => {
        formData.append("cargo_types[]", el);
    });
    tnData.forEach(({ id }, i) => {
        formData.append("goods_invoices[]", id);
    });

    $.ajax({
        url: "/match/consolidation",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
    })
        .done(function (response) {
            console.log(response);
            removeBeforeUnloadListener();
            deleteAlldata();
            if (status !== "drafts") {
                $("#consolidation-toast").toast("show");
                $("#consolidation-number").text(response.id);
            }
            if (status === "drafts") {
                $("#draft-consolidation-toast").toast("show");
                $("#draft-consolidation-number").text(response.id);
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log("Error:", errorThrown);
        });
}

// delete all items from create consolidation container
function deleteAlldata() {
    tpData = [];
    tnData = [];
    $(".tn-item-container").empty();
    $("#account-details-modern-trigger").addClass("active");
    $("#personal-info-modern-trigger").removeClass("active");
    $("#account-details-modern").addClass("active dstepper-block");
    $("#personal-info-modern").removeClass("active dstepper-block");
    $("#account-details-modern-trigger").removeClass("crossed");
    $("#create-consolidation").prop("disabled", true);
    $("#summary-container").remove();
}

//  functions for counting
function calculateParticipants() {
    const firstArraySum = tpData.length;
    const secondArraySum = tnData.length;
    const totalSum = firstArraySum + secondArraySum;
    $("#total-participants").text(totalSum);
}

function calculatePalletsSum(data) {
    const reservedPallets = Number(tpData[0].pallet_count);
    const sum = data.reduce((acc, item) => {
        const pallets = parseInt(item.palletsCount);
        return isNaN(pallets) ? acc : acc + pallets;
    }, 0);

    const totalPallets = sum + reservedPallets;
    $("#tp-reserved-container").text(totalPallets);
}

function calculateWeightSum(data) {
    const weightTp = Number(tpData[0].weight);
    const sum = data.reduce((acc, item) => {
        const tnWeight = parseInt(item.weight);
        return isNaN(tnWeight) ? acc : acc + tnWeight;
    }, 0);

    const totalWeight = sum + weightTp;
    $("#tp-weight-container").text(totalWeight);
}

function calculateSum(id) {
    $.ajax({
        url: "/match/transport-planning/get-total/" + id,
        type: "GET",
        contentType: "application/json",
        success: async function (response) {
            const data = await response;
            $("#total-participants").text(data.members.length);
            $("#tp-reserved-container").text(data.pallet_count);
            $("#tp-capacity-container").text(data.common_count);
            $("#tp-weight-container").text(data.weight);
            $("#tp-weight-capacity-container").text(data.common_weight);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
    });
}

// unreserve all tp
$(window).bind("beforeunload", function (event) {
    unreserveTp();
});

function unreserveTp() {
    if (transportPlanningId) {
        fetch("/match/transport-planning/unreserve", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                _token: document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                id: transportPlanningId,
            }),
        });
    }
}

function removeBeforeUnloadListener() {
    $(window).unbind("beforeunload");
}

// clicks for change styles
$("#to-main-page-from-tp").click(function () {
    $(
        "#main-wizard, #choose-tp-view, #consolidation-list, #summary-container"
    ).show();
    $("#tp-view-container").hide();
});

$("#to-main-page-from-tn").click(function () {
    $("#main-wizard, #consolidation-list, #all-consolidation-tables").show();
    $("#summary-container").css("display", "flex");
    $("#add-new-consolidation-view").hide();
});

$("#continue-working-button, #cancel-consolidation-button").click(function () {
    $("#tabs2, .modal-footer").show();
    $("#added-consolidation-view").hide();
});
