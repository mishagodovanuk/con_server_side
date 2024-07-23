export function clearModalInputs(action) {
    $(`#${action}-action-modal input`).val(null)
    $(`#location-${action}, #transporter-${action}, #tn-list-${action}`).val('').trigger('change');
    $(`#tn-list-${action}`).val([]).trigger("change");
    $(`#time-${action}-from, #time-${action}-to`).val('');
}
