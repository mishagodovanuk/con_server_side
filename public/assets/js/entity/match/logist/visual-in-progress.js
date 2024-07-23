import { initializeMap } from "./route-map.js";
import { checkFieldTnToAction } from "./utils/check-field-tn-to-action.js";
import { checkFieldsCreateAction } from "./utils/check-fields-create-action.js";
import { checkFieldsEditAction } from "./utils/check-fields-edit-action.js";

//відкрити таблицю
$("#open-table-page").click(function (e) {
    $("#table-page").removeClass("d-none");
    $("#view-consolid-page").addClass("d-none");
});

// відкрити перегляд консолід page
$(document).on("click", ".open-view-consolid", function (e) {
    $("#table-page").addClass("d-none");
    $("#view-consolid-page").removeClass("d-none");
    initializeMap();
});

// Показати/приховати .btns-in-action для .family
$(document)
    .on("mouseenter", ".family", function () {
        $(this).find(".btns-in-action").stop().fadeIn(380);
    })
    .on("mouseleave", ".family", function () {
        $(this).find(".btns-in-action").stop().fadeOut(380);
    });

//  показати/приховати .icon-drop та .icon-delete для .child
$(document)
    .on("mouseenter", ".child", function () {
        $(this).find(".icon-drop, .icon-delete").stop().fadeIn(380);
    })
    .on("mouseleave", ".child", function () {
        $(this).find(".icon-drop, .icon-delete").stop().fadeOut(380);
    });
// tn with hover
// $(".item-tns-w-company").hover(getHoverEl, takeHoverEl);

$(document).on("mouseenter", ".item-tns-w-company", getHoverEl);
$(document).on("mouseleave", ".item-tns-w-company", takeHoverEl);
// ====
// Обробник подій для кліку на accordion-button

$(document).on("click", ".accordion-button", function () {
    const itemTnsCompany = $(this).closest(".item-tns-w-company");
    const accordionButton = $(this);

    if (accordionButton.hasClass("collapsed")) {
        $(this).find(".icon-drop").hide();
        itemTnsCompany.removeClass("border rounded");
        itemTnsCompany.addClass("border-0");
        enableHover = true;
    } else {
        enableHover = false;

        itemTnsCompany.addClass("border rounded");
        itemTnsCompany.removeClass("border-0");
        $(this).find(".icon-drop").show();
        $(this).removeClass("bg-hover-grey");
        $(this).find("div").removeClass("bg-hover-grey");
    }
});

$(".icon-plus").css("border", "none");
function getHoverEl() {
    // Hover-функція
    if (enableHover) {
        $(this).find(".icon-drop").fadeIn("");
        $(this)
            .find(".accordion-button, .accordion-button div")
            .addClass("bg-hover-grey");
        $(this).find(".icon-plus").trigger("focus");
    }
}
function takeHoverEl() {
    // Функція, коли курсор покидає елемент
    if (enableHover) {
        $(this).find(".icon-drop").fadeOut("");
        $(this)
            .find(".accordion-button, .accordion-button div")
            .removeClass("bg-hover-grey");
        $(this).find(".icon-plus").trigger("blur");
    }
}

$(
    "#loading-action-list, #moving-action-list, #unloading-action-list, #add-tn-to-action-modal input[name='radio']"
).on("change", checkFieldTnToAction);

//  check fields in creating action
$(
    "#location-create, #transporter-create, #date-create, #time-create-from, #time-create-to,#create-action-modal input[name='radio']"
).on("change", checkFieldsCreateAction);

//  check fields in editing action
$(
    "#location-edit, #transporter-edit, #date-edit, #time-edit-from, #time-edit-to,#edit-action-modal input[name='radio']"
).on("change", checkFieldsEditAction);

// Функція для встановлення max-height для блоку з тнками з заголовками
$(document).ready(function () {
    function setMaxHeight() {
        const customNavTabsHeight = $(".custom-nav-tabs").outerHeight();
        const navTabsHeight = $(".custom-nav-tabs .nav-tabs").outerHeight();
        const maxHeightValue = customNavTabsHeight - navTabsHeight - 5;

        $(".overflow-cont-tns").css("max-height", maxHeightValue + "px");
    }
    setMaxHeight();
    $(document).on("DOMSubtreeModified", function () {
        setMaxHeight();
    });
});

// додатково ініцілізувати мапу
$(".initialize-map").click(function (e) {
    initializeMap();
});

// Обробник події change на радіо-кнопках модалка радіо кнопок
$("input[type='radio']").change(function () {
    const selectedValue = $(this).attr("id");

    switch (selectedValue) {
        case "loading-create":
        case "unloading-create":
            $(".location-create-container").removeClass("d-none");
            $(".transporter-create-container").addClass("d-none");
            break;
        case "moving-create":
            $(".location-create-container").addClass("d-none");
            $(".transporter-create-container").removeClass("d-none");
            break;
        case "loading-edit":
        case "unloading-edit":
            $(".location-edit-container").removeClass("d-none");
            $(".transporter-edit-container").addClass("d-none");
            break;
        case "moving-edit":
            $(".location-edit-container").addClass("d-none");
            $(".transporter-edit-container").removeClass("d-none");
            break;
        case "loading-add-tn-to":
            $(".loading-action-list-container").removeClass("d-none");
            $(".moving-action-list-container").addClass("d-none");
            $(".unloading-action-list-container").addClass("d-none");
            break;
        case "unloading-add-tn-to":
            $(".loading-action-list-container").addClass("d-none");
            $(".moving-action-list-container").addClass("d-none");
            $(".unloading-action-list-container").removeClass("d-none");
            break;
        case "moving-add-tn-to":
            $(".loading-action-list-container").addClass("d-none");
            $(".moving-action-list-container").removeClass("d-none");
            $(".unloading-action-list-container").addClass("d-none");
            break;
    }
});
