
export function updateSaveButtonState() {
  var $container = $("#tns-w-titleCompany");
  var $alertPrimary = $container.find(".alert-primary");
  var $alertDanger = $container.find(".alert-danger");
  var $saveButton = $("#save-actions-consolidation");

  if ($alertPrimary.length || $alertDanger.length) {
    $saveButton.prop("disabled", true);
  } else {
    $saveButton.prop("disabled", false);
  }
}