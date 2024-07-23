import { markupCommentDispatcher } from "../render/logist/markup-comment-dispatcher.js";
import { markupDataPlanning } from "../render/logist/markup-data-planning.js";
import { markupItemRoute } from "../render/logist/markup-item-route.js";
import { getInfoConsolidation } from "../utils/getInfoConsolidation.js";
import { generationIcons } from "./utils/generation-icons.js";

let consolidationId =null;

// default hidden containers
if (getInfoConsolidation().name === "rejected") {
    $("#actions-rejected-btns").removeClass("d-none");
}else{
    $("#actions-review-btns").removeClass("d-none");
}


// open main page with table
$("#open-table-page").click(function (e) {
    $("#table-page").removeClass("d-none");
    $("#view-consolid-page").addClass("d-none");
});

// open view page
$(document).on("click", ".open-view-consolid", function (e) {
    var id = $(this).data("id");
    consolidationId=id;
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
        $("#block-for-data-planning").empty();
        $("#block-for-comments").empty();
        $("#block-for-route").empty();
        $("#block-for-data-planning").html(markupDataPlanning(data));
        $("#block-for-comments").html(markupCommentDispatcher(data));
        $("#block-for-route").html(markupItemRoute(data.routeInfo));
        $(".number-consolid").text(id);

        $("#table-page").addClass("d-none");
        $("#view-consolid-page").removeClass("d-none");

        generationIcons() 
    }
});


$("#return-to-work-btn").click(function (e) {
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


$('#send-to-in-progress-btn').click(function (e) { 
    
});

$('#send-to-rejected-btn').click(function (e) { 

});






