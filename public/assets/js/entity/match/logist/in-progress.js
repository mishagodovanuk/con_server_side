import { customDataTns } from "../db/data-tns-in-work.js";
import { markupTnsWithTitleCompany } from "../render/logist/markup-tns-w-titleCompany.js";
import { markupActionWithTns } from "../render/logist/markup-action-w-ths.js";
import { markupTnChldForAction } from "../render/logist/markup-tnChild-forAction.js";
import { initializeMap } from "./route-map.js";
import { markupModalTnToAction } from "../render/logist/markup-modal-tn-to-action.js";
import { fillSelect } from "./utils/fill-select.js";
import { checkFieldTnToAction } from "./utils/check-field-tn-to-action.js";
import { setCustomPopover } from "./utils/set-custom-popover.js";
import { numberActionElements } from "./utils/number-action-elements.js";
import { checkFieldsEditAction } from "./utils/check-fields-edit-action.js";
import { groupByCompany } from "./utils/group-by-company.js";
import { numberTnsElements } from "./utils/number-tns-elements.js";
import { generationIcons } from "./utils/generation-icons.js";
import { clearModalInputs } from "./utils/clear-modal-inputs.js";
import { updateSaveButtonState } from "./utils/update-btn-save-action.js";

var dataTns = customDataTns;

renderFirstPage();

// drag and drop
function initDragAndDrop() {
    $(".child-other").draggable({
        revert: "invalid",
        cursor: "move",
        helper: "clone",
    });

    $(".family").droppable({
        accept: ".child-other",
        drop: function (event, ui) {
            const dataId = ui.helper.data("id");
            const foundItemTn = dataTns.find((el) => el.id == dataId);
            const newChild = markupTnChldForAction(foundItemTn);
            $(this).append(newChild);
            $(".btns-in-action, .icon-delete, .icon-drop").hide();
            generationIcons();
            sortDataActionsByDataId(dataActions);
        },
    });

    $("#list-for-action").sortable({
        connectWith: "#list-for-action",
        items: ".family",
        placeholder: "ui-state-highlight",
        tolerance: "pointer",
        update: function (event, ui) {
            numberActionElements();
            sortDataActionsByDataId(dataActions);
        },
    });

    $(".family").sortable({
        connectWith: ".family",
        items: "> .child",
        placeholder: "ui-state-highlight",
        tolerance: "pointer",
        receive: function (event, ui) {
            var parent = ui.item.closest(".family");
            if (ui.item.hasClass("child")) {
                ui.item.appendTo(parent);
            }
            sortDataActionsByDataId(dataActions);
        },
        update: function () {
            numberTnsElements();
        },
    });

    generationIcons();
}

// клік по додавання тн до дії “
const btnConfirmTnToAction = $("#add-tn-to-action-modal").find(
    "#confirm-tn-to-action"
);
$(document).on("click", ".icon-plus", function (e) {
    checkFieldTnToAction();
    const accordionBtn = $(this).closest(".accordion-button");
    const accordionItem = $(accordionBtn).closest(".accordion-item");
    const itemTnsCompany = $(accordionBtn).closest(".item-tns-w-company");
    const accordionShow = $(accordionItem).find(".accordion-collapse");

    const tnId = $(this).data("idtn");
    btnConfirmTnToAction.attr("data-idtn", tnId);
    const itemTn = dataTns.find((el) => el.id == tnId);

    $("#content-about-tn").empty();
    $("#content-about-tn").html(markupModalTnToAction(itemTn, dataActions));

    fillSelect(
        "#loading-action-list",
        dataActions.filter((item) => item.name === "loading")
    );
    fillSelect(
        "#moving-action-list",
        dataActions.filter((item) => item.name === "moving")
    );
    fillSelect(
        "#unloading-action-list",
        dataActions.filter((item) => item.name === "unloading")
    );

    $("#add-tn-to-action-modal").modal("show");

    setTimeout(function () {
        $(accordionShow).removeClass("show");
        itemTnsCompany.removeClass("border rounded");
        itemTnsCompany.addClass("border-0");
        enableHover = true;

        $(accordionItem).find(".icon-drop").hide();
    }, 400);
});

// confitn tn to item action
$(btnConfirmTnToAction).click(function (e) {
    const tnId = e.target.dataset.idtn;

    const nameAction = $(
        "#add-tn-to-action-modal input[name='radio']:checked"
    ).attr("id");
    let actionId = "";

    switch (nameAction) {
        case "loading-add-tn-to":
            actionId = $("#loading-action-list").val();
            break;
        case "moving-add-tn-to":
            actionId = $("#moving-action-list").val();
            break;
        case "unloading-add-tn-to":
            actionId = $("#unloading-action-list").val();
            break;
    }

    const objAction = dataActions.find((el) => el.id == actionId);
    objAction.tns.push(tnId);
    renderActions();

    updateFunctional();
    $("#add-tn-to-action-modal").modal("hide");
});

//open-create-action-modal
$("#open-create-action-modal").click(function (e) {
    $("#add-tn-to-action-modal").modal("hide");
    $("#create-action-modal").modal("show");
});

//  render action and tns
function renderActions() {
    $("#list-for-action").empty();
    $("#list-for-action").html(markupActionWithTns(dataActions, dataTns));

    numberActionElements();
    initDragAndDrop();
    // btns with hover
    $(".btns-in-action, .icon-drop, .icon-delete").hide();
}

//  render tns with titles Company
function renderTnsWTitleCompany(dataActions) {
    $("#tns-w-titleCompany").empty();
    $("#tns-w-titleCompany").html(
        markupTnsWithTitleCompany(groupByCompany(dataTns), dataActions)
    );
    setCustomPopover();
    $(".icon-plus").css("border", "none");

    updateSaveButtonState();
}

function renderFirstPage() {
    renderActions();
    initializeMap();
    sortDataActionsByDataId(dataActions);
}

// add action to actions
$("#create-new-action").click(function (e) {
    const nameAction = $(
        "#create-action-modal input[name='radio']:checked"
    ).attr("id");
    let address = "";

    switch (nameAction) {
        case "loading-create":
        case "unloading-create":
            address = $("#location-create").val();
            break;
        case "moving-create":
            address = $("#transporter-create").val();
            break;
    }
    const dataActionObj = { time: {} };

    dataActionObj.id = (
        Math.max(...dataActions.map((item) => parseInt(item.id, 10))) + 1
    ).toString();
    dataActionObj.name = nameAction.slice(0, nameAction.indexOf("-"));
    dataActionObj.address = address;
    dataActionObj.time.date = $("#date-create").val();
    dataActionObj.time.period =
        $("#time-create-from").val() + "-" + $("#time-create-to").val();
    dataActionObj.tns = $("#tn-list-create").val();

    $("#list-for-action").append(markupActionWithTns([dataActionObj], dataTns));
    dataActions.push(dataActionObj);
    $("#create-action-modal").modal("hide");

    // btns with hover
    $(".btns-in-action, .icon-drop, .icon-delete").hide();

    updateFunctional();
    clearModalInputs("create");
});

//  open modal remove action
var confirmDeleteButton = $("#remove-action-modal").find(
    "#confirm-remove-action"
);
$("body").on("click", ".remove-action", function (e) {
    const id = $(this).data("id");
    const title = $('.action-with-tns[data-id="' + id + '"]')
        .find("h4")
        .text();
    confirmDeleteButton.attr("data-id", id);
    $("#remove-action-modal").find(".title-action").text(title);
    $("#remove-action-modal").modal("show");
});

// remove action
$(confirmDeleteButton).click(function (e) {
    const id = e.target.dataset.id;
    removeAction(id);
    $("#remove-action-modal").modal("hide");
});

function removeAction(id) {
    $('.action-with-tns[data-id="' + id + '"]').remove();
    dataActions.splice(
        dataActions.findIndex((obj) => obj.id == id),
        1
    );

    updateFunctional();
}

// open modal update action
$("body").on("click", ".update-action", function (e) {
    const id = $(this).data("id");
    const title = $('.action-with-tns[data-id="' + id + '"]')
        .find("h4")
        .text();
    $("#edit-action-modal").find(".title-action").text(title);
    $("#edit-action-modal").find("#update-action-btn").attr("data-id", id);

    const { name, address, time, tns } = dataActions.find(
        (obj) => obj.id == id
    );
    const nameAction = name + "-edit";

    $("input[name='radio']").each(function () {
        if ($(this).attr("id") === nameAction) {
            $(this).prop("checked", true);
        }
    });
    switch (name) {
        case "loading":
        case "unloading":
            $(".location-edit-container").removeClass("d-none");
            $(".transporter-edit-container").addClass("d-none");
            break;
        case "moving":
            $(".location-edit-container").addClass("d-none");
            $(".transporter-edit-container").removeClass("d-none");
            break;
    }

    $("#location-edit").val(null).trigger("change");
    $("#transporter-edit").val(null).trigger("change");

    switch (name) {
        case "loading":
        case "unloading":
            $("#location-edit").val(address).trigger("change");
            break;
        case "moving":
            $("#transporter-edit").val(address).trigger("change");
            break;
    }

    $("#tn-list-edit").val(tns).trigger("change");
    $("#date-edit").val(time.date);
    const timePeriod = time.period.split("-");
    $("#time-edit-from").val(timePeriod[0]);
    $("#time-edit-to").val(timePeriod[1]);

    $("#edit-action-modal").modal("show");
    checkFieldsEditAction();
});

// update action
$("#update-action-btn").click(function (e) {
    const id = e.target.dataset.id;
    const nameAction = $("#edit-action-modal input[name='radio']:checked").attr(
        "id"
    );
    let address = "";

    switch (nameAction) {
        case "loading-edit":
        case "unloading-edit":
            address = $("#location-edit").val();
            break;
        case "moving-edit":
            address = $("#transporter-edit").val();
            break;
    }
    const dataActionObj = { time: {} };

    dataActionObj.id = id;
    dataActionObj.name = nameAction.slice(0, nameAction.indexOf("-"));
    dataActionObj.address = address;
    dataActionObj.time.date = $("#date-edit").val();
    dataActionObj.time.period =
        $("#time-edit-from").val() + "-" + $("#time-edit-to").val();
    dataActionObj.tns = $("#tn-list-edit").val();

    dataActions.splice(
        dataActions.findIndex((obj) => obj.id == id),
        1,
        dataActionObj
    );
    $('.action-with-tns[data-id="' + id + '"]').replaceWith(
        markupActionWithTns([dataActionObj], dataTns)
    );
    $("#edit-action-modal").modal("hide");

    updateFunctional();

    // btns with hover
    $(".btns-in-action, .icon-drop, .icon-delete").hide();
});

// remove tn in actions
$("body").on("click", ".remove-tn-in-action", function (e) {
    const actionId = $(this).closest(".action-with-tns").data("id");
    const tnId = $(this).data("idtn");
    const actionObj = dataActions.find((obj) => obj.id == actionId);
    const newTns = actionObj.tns.filter((el) => el != tnId);
    actionObj.tns = newTns;

    $(
        '.action-with-tns[data-id="' +
            actionId +
            '"] .item-tn-in-action[data-idtn="' +
            tnId +
            '"] '
    ).remove();

    sortDataActionsByDataId(dataActions);
    initDragAndDrop();
});

// cчитати всі дії з тнками та оновити статуси і т д
function sortDataActionsByDataId(dataActionsOld) {
    const containers = document.querySelectorAll(".action-with-tns");

    const dataIds = Array.from(containers).map(
        (container) => container.dataset.id
    );

    const idIndexMap = {};
    dataActionsOld.forEach((action, index) => {
        idIndexMap[action.id] = index;
    });

    const sortedDataActions = dataIds.map(
        (dataId) => dataActionsOld[idIndexMap[dataId]]
    );

    sortedDataActions.forEach((action) => {
        const container = document.querySelector(
            `.action-with-tns[data-id="${action.id}"]`
        );
        if (container) {
            const tns = Array.from(
                container.querySelectorAll(".item-tn-in-action")
            ).map((item) => item.dataset.idtn);
            action.tns = Array.from(new Set(tns));
        }
    });

    dataTns.forEach((dbAction) => {
        dbAction.action = {};
        dbAction.action.loading = [];
        dbAction.action.moving = [];
        dbAction.action.unloading = [];

        sortedDataActions.forEach((action) => {
            if (action.tns.includes(dbAction.id)) {
                dbAction.action[action.name] = [
                    ...dbAction.action[action.name],
                    action.id,
                ];
            }
        });
    });

    dataActions = sortedDataActions;
    renderTnsWTitleCompany(dataActions);
    numberTnsElements();
    initDragAndDrop();

    // console.log("dataActions", dataActions);
    // console.log("dataTns", dataTns);
}

function updateFunctional() {
    numberActionElements();
    sortDataActionsByDataId(dataActions);
    initializeMap();
}

$("#save-actions-consolidation").click(function (e) {
    window.location.href =
        window.location.origin + "/match/logistician/confirmed";
});
