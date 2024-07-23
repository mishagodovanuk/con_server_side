
//  check fields in editing action
export function checkFieldsEditAction() {
    var nameAction = $("#edit-action-modal input[name='radio']:checked").attr(
        "id"
    );
    var location = $("#location-edit").val();
    var transporter = $("#transporter-edit").val();
    var date = $("#date-edit").val();
    var timeFrom = $("#time-edit-from").val();
    var timeTo = $("#time-edit-to").val();

    if (nameAction === "loading-edit" || nameAction === "unloading-edit") {
        if (location && date && timeFrom && timeTo) {
            $("#update-action-btn").prop("disabled", false);
        } else {
            $("#update-action-btn").prop("disabled", true);
        }
    } else if (nameAction === "moving-edit") {
        if (transporter && date && timeFrom && timeTo) {
            $("#update-action-btn").prop("disabled", false);
        } else {
            $("#update-action-btn").prop("disabled", true);
        }
    } else {
        $("#edit-new-action").prop("disabled", true);
    }
}