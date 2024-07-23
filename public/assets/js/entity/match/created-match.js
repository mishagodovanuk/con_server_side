import { markupCreatedConsolidationView } from "./render/markup-created-cons-view-dispatcher.js";
import { markupRoutesCreatedConsolid } from "./render/markup-routes-created-cons.js";
import { getInfoConsolidation } from "./utils/getInfoConsolidation.js";

let consolidationId = null;

// default hidden page
$(".created-consolidation-view, #created-btns-actions").hide();
$(".created-consolidation-view, #created-btns-actions").removeClass("d-none");
if (getInfoConsolidation().name === "drafts") {
    $("#draft-btns-actions").removeClass("d-none");
}

// open view page
$(document).on("click", ".open-view-consolidation-page", function (e) {
    const id = $(this).data("id");
    consolidationId = id;
    $.ajax({
        url: "/match/consolidation/" + id,
        type: "GET",
        contentType: "application/json",
        success: async function (response) {
            const { data } = response;
            consolidationViewRender(data);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
    });

    function consolidationViewRender(data) {
        $("#data-created-consolidation-view").empty();
        $("#data-created-consolidation-trip-container").empty();
        $("#data-created-consolidation-view").html(
            markupCreatedConsolidationView(data, id)
        );
        $("#data-created-consolidation-trip-container").html(
            markupRoutesCreatedConsolid(data.routeInfo)
        );

        $(".consolidation-number").text(id);

        //  доробити модалкy відхилення, і  потестити  ці статуси, коли будуть дані від беку по статусах всіх ( після опрацювання логістом) .

        if (data.status == "unapproved") {
            $($("#created-btns-actions").show());
            $(".created-status").append(
                `<img class="canceled-icon" data-bs-toggle="modal" data-bs-target="#canceledConsolidation" style="cursor: pointer" src="${window.location.origin}/assets/icons/red-eye.svg">`
            );
        } else {
            $($("#created-btns-actions").hide());
            $(".created-status").find(".canceled-icon").remove();
        }

        // change pages
        $(".created-consolidation-list").hide();
        $(".created-consolidation-view").show();
    }
});

// created  Unapproved  consolidation return to work
$("#return-to-work-consolidation").click(function (e) {
    $.ajax({
        url: "/match/consolidation/return-to-work/" + consolidationId,
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
});

// delete consolidation
$("#delete-consolidation-confirm").click(function (e) {
    $.ajax({
        url: "/match/consolidation/" + consolidationId,
        type: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        success: function (response) {
            console.log(response);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
});

// draft btn edit consilidation
$("#edit-consilidation-draft").click(function (e) {
    window.location.href =
        window.location.href.replace(/\/\w+$/, "") +
        "/" +
        consolidationId +
        "/edit";
});

// draft btn to to start processing
$("#consolidation-to-start-processing").click(function (e) {});

// return to main page
$("#created-list-view, #created-draft-btn").click(function () {
    $(".created-consolidation-list").show();
    $(".created-consolidation-view").hide();
});
