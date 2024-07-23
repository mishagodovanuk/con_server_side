
//  check fields in creating action
export function checkFieldsCreateAction() {
    var nameAction = $("#create-action-modal input[name='radio']:checked").attr(
        "id"
    );
    var location = $("#location-create").val();
    var transporter = $("#transporter-create").val();
    var date = $("#date-create").val();
    var timeFrom = $("#time-create-from").val();
    var timeTo = $("#time-create-to").val();

    if (nameAction === "loading-create" || nameAction === "unloading-create") {
        if (location && date && timeFrom && timeTo) {
            $("#create-new-action").prop("disabled", false);
        } else {
            $("#create-new-action").prop("disabled", true);
        }
    } else if (nameAction === "moving-create") {
        if (transporter && date && timeFrom && timeTo) {
            $("#create-new-action").prop("disabled", false);
        } else {
            $("#create-new-action").prop("disabled", true);
        }
    } else {
        $("#create-new-action").prop("disabled", true);
    }
}