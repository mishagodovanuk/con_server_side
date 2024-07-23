import { markupUploadModalInfo } from "./render/markup-dispatcher-modal-info.js";
import { markupUploadModalTnList } from "./render/markup-dispatcher-modal-tn-list.js";
import { markupRvRequestViewDispatcher } from "./render/markup-rv-request-view-dispatcher.js";
import { markupRvItemRoute } from "./render/markup-rv-item-route.js";
import { markupRvTpItemDispatcher } from "./render/markup-rv-tp-item-dispatcher.js";
import { markupRvTnViewDispatcher } from "./render/markup-rv-tn-view-dispatcher.js";
import { markupRvTnItemDispatcher } from "./render/markup-rv-tn-item-dispatcher.js";
import { markupSummaryDispatcher } from "./render/markup-summary-dispatcher.js";

let tpRvData = [];
let tnRvData = [];

function totalParticipants() {
    let firstArraySum = tpRvData.length;
    let secondArraySum = tnRvData.length;
    let totalSum = firstArraySum + secondArraySum;
    $("#rv-loading-participants").empty();
    $("#rv-loading-participants").text(totalSum);
}

function calculatePalletsSum(data) {
    let sum = 0;
    let reserverTp = Number(tpRvData[0].reserved);
    for (const item of data) {
        const pallets = parseInt(item.pallets);
        if (!isNaN(pallets)) {
            sum += pallets;
        }
    }

    let totalPallets = sum + reserverTp;
    $("#rv-tp-reserved-container").empty();
    $("#rv-tp-reserved-container").text(totalPallets);
}

function calculateWeightSum(data) {
    let sum = 0;
    let weightTp = Number(tpRvData[0].weight);
    for (const item of data) {
        const tnWeight = parseInt(item.weight);
        if (!isNaN(tnWeight)) {
            sum += tnWeight;
        }
    }

    let totalWeight = sum + weightTp;
    $("#rv-tp-weight-container").empty();
    $("#rv-tp-weight-container").text(totalWeight);
}

// changing rv-loading views
$($(".rv-transport-tp-view").hide());
$($(".rv-loading-tn-view").hide());
$($("#rv-added-consolidation-view").hide());
$($(".rv-loading-items-view").hide());

$(
    $("#choose-rv-loading-view").click(function () {
        $(".rv-loading-wizard-container").show();
        $(".rv-transport-tp-view").hide();
    })
);

$(
    $("#add-to-consolidation-rv").click(function () {
        $(".rv-loading-items-view").show();
        $(".rv-transport-tp-view").hide();
    })
);

$(
    $("#choose-rv-loading-view2").click(function () {
        $(".rv-loading-items-view").show();
        $(".rv-loading-tn-view").hide();
    })
);

$(
    $("#rv-add-new-consolidation-btn").click(function () {
        $(".rv-loading-items-view").show();
        $(".rv-loading-tn-view").hide();
    })
);

$(document).on("click", "#rv-consolidation-button", function (e) {
    $("#tabs8").hide();
    $(".modal-footer-rv").hide();
    $("#rv-added-consolidation-view").show();
});

$(
    $("#rv-continue-working-button, #rv-cancel-consolidation-button").click(
        function () {
            $("#tabs8").show();
            $(".modal-footer-rv").show();
            $("#rv-added-consolidation-view").hide();
        }
    )
);

// dispatcher backhaul view page
$(document).on("click", ".btn-table-cell-add-rv", function (e) {
    var dataId = $(this).data("id");

    $.ajax({
        url: "/match/cargo-request/get-info/" + dataId,
        type: "GET",
        contentType: "application/json",
        success: async function (response) {
            const { data } = await response;
            console.log(data);
            backhaulRequestView(data);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
    });

    function backhaulRequestView(data) {
        const {
            id,
            company,
            transport,
            additional_equipment,
            driver,
            auto_capacity,
            max_cargo_price,
            cargo_type,
            route,
        } = data;

        $("#data-plan-rv-container").empty();
        $("#data-trip-rv-container").empty();
        $("#data-plan-rv-container").html(
            markupRvRequestViewDispatcher(
                id,
                company.name,
                transport.name,
                additional_equipment.name,
                driver.name,
                auto_capacity,
                max_cargo_price,
                cargo_type
            )
        );
        $("#data-trip-rv-container").html(markupRvItemRoute(route));
        $("#tp-rv-loading-view").text(id);
    }
});

// dispatcher add backhaul request item to list from view page
$(
    $(document).on("click", "#add-to-consolidation-rv", function (e) {
        const tripNumber = String($("#trip-number").text());
        // cargoRequestId = tripNumber; - змінна у backhaul.blade.php
        $.ajax({
            url: "/match/cargo-request/get-info/" + tripNumber,
            type: "GET",
            contentType: "application/json",
            success: async function (response) {
                const { data } = await response;
                addBackhaulItem(data);
                totalParticipants();
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error);
            },
        });

        function addBackhaulItem(data) {
            const {
                id,
                company,
                max_cargo_price,
                auto_capacity,
                weight,
                route,
                cargo_type,
            } = data;
            tpRvData.push(data);

            $(".rv-tn-item-container").empty();
            $(".rv-tn-item-container").html(
                markupRvTpItemDispatcher(
                    id,
                    company.name,
                    max_cargo_price,
                    auto_capacity,
                    weight,
                    route,
                    cargo_type
                )
            );
            $("#rv-tp-reserved-container").text("0");
            $("#rv-tp-capacity-container").text(auto_capacity);
            $("#rv-tp-weight-container").text("0");
            $("#rv-tp-max-weight-container").text(weight);
        }
    })
);

// dispatcher rv-loading add tp item from table
$(
    $(document).on("click", ".rv-loading-add-tp", function (e) {
        var dataId = $(this).data("id");
        // cargoRequestId = dataId; - змінна у backhaul.blade.php
        $.ajax({
            url: "/match/cargo-request/get-info/" + dataId,
            type: "GET",
            contentType: "application/json",
            success: async function (response) {
                const { data } = await response;
                addBackhaulItemFromTable(data);
                totalParticipants();
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error);
            },
        });

        function addBackhaulItemFromTable(data) {
            const {
                id,
                company,
                max_cargo_price,
                auto_capacity,
                weight,
                route,
                cargo_type,
            } = data;
            tpRvData.push(data);

            $(".rv-tn-item-container").empty();
            $(".rv-tn-item-container").html(
                markupRvTpItemDispatcher(
                    id,
                    company.name,
                    max_cargo_price,
                    auto_capacity,
                    weight,
                    route,
                    cargo_type
                )
            );
            $("#rv-tp-reserved-container").text("0");
            $("#rv-tp-capacity-container").text(auto_capacity);
            $("#rv-tp-weight-container").text("0");
            $("#rv-tp-max-weight-container").text(weight);
        }
    })
);

// dispatcher rv-loading tn view
$(document).on("click", ".rv-add-new-consolidation", function (e) {
    var dataValue = $(this).data("value");
    const chosenObj = data6.find((el) => el.number == dataValue);
    const {
        number,
        sending,
        delivery,
        uploadingCity,
        offloadingCity,
        created,
        status,
    } = chosenObj;
    const sendingDate = JSON.parse(sending).date;
    const deliveryDate = JSON.parse(delivery).date;
    fetch("")
        .then(function (response) {
            $("#rv-tn-data-view2").empty();
            $("#rv-tn-data-view2").html(
                markupRvTnViewDispatcher(
                    number,
                    sendingDate,
                    deliveryDate,
                    created,
                    status,
                    created,
                    uploadingCity,
                    offloadingCity
                )
            );
            $("#rv-tn-number-container").text(number);

            return response.json();
        })
        .then(function (data) {})
        .catch(function (error) {});
});

// delete all items from create rv-loading consolidation container
$(document).on(
    "click",
    "#rv-loading-delete-btn, #rv-delete-all-modal-button, #rv-continue-working-button, #rv-cancel-consolidation-button",
    function (e) {
        tpRvData = [];
        tnRvData = [];
        fetch("")
            .then(function (response) {
                $(".rv-tn-item-container").empty();
                $("#rv-create-consolidation").prop("disabled", true);
                $(".rv-loading-items-view").hide();
                $(".rv-loading-wizard-container").show();
                $("#summary-container").remove();
                return response.json();
            })
            .then(function (data) {})
            .catch(function (error) {});
    }
);

// dispatcher rv-loading tn item
$(
    $(document).on("click", "#rv-add-new-consolidation-btn", function (e) {
        const tnNumber = String($("#tn-number-value").text());
        const chosenObj = data6.find((el) => el.number == tnNumber);
        const tpSupplier = tpRvData[0].supplier;
        const {
            number,
            suplier,
            uploading,
            price,
            offloading,
            weight,
            route,
            type,
            pallets,
        } = chosenObj;
        tnRvData.push(chosenObj);

        if (tpRvData.length > 0 && tnRvData.length > 0) {
            $("#rv-create-consolidation").prop("disabled", false);
        } else {
            $("#rv-create-consolidation").prop("disabled", true);
        }

        const company = JSON.parse(suplier).company;

        totalParticipants();
        calculatePalletsSum(tnRvData);
        calculateWeightSum(tnRvData);

        fetch("")
            .then(function (response) {
                $(".rv-tn-item-container").append(
                    markupRvTnItemDispatcher(
                        number,
                        company,
                        uploading,
                        price,
                        offloading,
                        weight,
                        route,
                        type,
                        pallets
                    )
                );
                $("#summary-container").remove();
                $("#summary-rv-loading").append(
                    markupSummaryDispatcher(
                        "rv-create-consolidation",
                        "#rv-large",
                        tpSupplier,
                        company
                    )
                );
                return response.json();
            })
            .then(function (data) {})
            .catch(function (error) {});
    })
);

// dispatcher rv-loading add tn item from table
$(
    $(document).on("click", ".rv-loading-add-tn", function (e) {
        let dataId = $(this).data("id");
        const chosenObj = data6.find((el) => el.id == dataId);
        const tpSupplier = tpRvData[0].supplier;
        const {
            number,
            suplier,
            uploading,
            price,
            offloading,
            weight,
            route,
            type,
            pallets,
        } = chosenObj;
        tnRvData.push(chosenObj);

        if (tpRvData.length > 0 && tnRvData.length > 0) {
            $("#rv-create-consolidation").prop("disabled", false);
        } else {
            $("#rv-create-consolidation").prop("disabled", true);
        }

        const company = JSON.parse(suplier).company;

        totalParticipants();
        calculatePalletsSum(tnRvData);
        calculateWeightSum(tnRvData);

        fetch("")
            .then(function (response) {
                $(".rv-tn-item-container").append(
                    markupRvTnItemDispatcher(
                        number,
                        company,
                        uploading,
                        price,
                        offloading,
                        weight,
                        route,
                        type,
                        pallets
                    )
                );
                $("#summary-container").remove();
                $("#summary-rv-loading").append(
                    markupSummaryDispatcher(
                        "rv-create-consolidation",
                        "#rv-large",
                        tpSupplier,
                        company
                    )
                );
                return response.json();
            })
            .then(function (data) {})
            .catch(function (error) {});
    })
);

// dispatcher rv-loading modal info
$(document).on("click", "#rv-create-consolidation", function (e) {
    const { type, supplier, price, capacity, reserved, weight, route } =
        tpRvData[0];
    const startDate = route[0].time.date;
    const endDate = route[route.length - 1].time.date;
    const upload = route[0].city;
    const offload = route[route.length - 1].city;
    const tnParticipants = [...tnRvData].map((el) => {
        return {
            suplier: JSON.parse(el.suplier).company,
            price: el.price,
        };
    });
    const tpUploadingQuantity = route.filter(
        (routeObj) => routeObj.terminal === "Завантаження"
    ).length;
    const tpOffloadingQuantity = route.filter(
        (routeObj) => routeObj.terminal === "Розвантаження"
    ).length;
    const tnUploadingQuantity = tnRvData.filter((obj) =>
        obj.route.filter((routeObj) => routeObj.terminal === "Завантаження")
    ).length;
    const tnOffloadingQuantity = tnRvData.filter((obj) =>
        obj.route.filter((routeObj) => routeObj.terminal === "Розвантаження")
    ).length;
    const uploadingQuantity = (
        tpUploadingQuantity + tnUploadingQuantity
    ).toString();
    const offloadingQuantity = (
        tnOffloadingQuantity + tpOffloadingQuantity
    ).toString();
    const tnPalletsSum = tnRvData.reduce((sum, item) => {
        return sum + parseInt(item.pallets);
    }, 0);
    const totalPallets = (tnPalletsSum + parseInt(reserved)).toString();
    const tnWeightSum = tnRvData.reduce((sum, item) => {
        return sum + parseInt(item.weight);
    }, 0);
    const totalWeight = (tnWeightSum + parseInt(weight)).toString();

    fetch("")
        .then(function (response) {
            $("#rv-loading-modal-info").empty();
            $("#rv-loading-modal-info").html(
                markupUploadModalInfo(
                    upload,
                    offload,
                    startDate,
                    endDate,
                    supplier,
                    tnParticipants,
                    price,
                    uploadingQuantity,
                    offloadingQuantity,
                    type,
                    totalPallets,
                    totalWeight,
                    capacity
                )
            );
            return response.json();
        })
        .then(function (data) {})
        .catch(function (error) {});
});

// dispatcher rv-loading modal tn list
$(document).on("click", "#rv-create-consolidation", function (e) {
    const {
        number,
        reserved,
        weight,
        supplier,
        uploading,
        offloading,
        customer,
    } = tpRvData[0];
    const count = 2;
    fetch("")
        .then(function (response) {
            $("#rv-loading-modal-tn-list").empty();
            $("#rv-tp-item-number").text(number);
            $("#rv-tp-item-pallets").text(reserved);
            $("#rv-tp-item-weight").text(weight);
            $("#rv-tp-item-supplier").text(supplier);
            $("#rv-tp-item-uploading").text(uploading);
            $("#rv-tp-item-offloading").text(offloading);
            $("#rv-tp-item-customer").text(customer);
            $("#rv-loading-modal-tn-list").append(
                markupUploadModalTnList(tnRvData, count)
            );
            return response.json();
        })
        .then(function (data) {})
        .catch(function (error) {});
});
