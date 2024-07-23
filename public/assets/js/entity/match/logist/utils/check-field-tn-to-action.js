export function checkFieldTnToAction() {
    const nameAction = $(
        "#add-tn-to-action-modal input[name='radio']:checked"
    ).attr("id");
    const loading = $("#loading-action-list").val();
    const moving = $("#moving-action-list").val();
    const unloading = $("#unloading-action-list").val();

    $("#confirm-tn-to-action").prop("disabled", function () {
        if (nameAction === "loading-add-tn-to") {
            return !loading;
        } else if (nameAction === "moving-add-tn-to") {
            return !moving;
        } else if (nameAction === "unloading-add-tn-to") {
            return !unloading;
        } else {
            return true;
        }
    });
}