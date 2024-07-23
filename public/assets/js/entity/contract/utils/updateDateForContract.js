// Function to update text based on selection
export function updateDateForContract($selector) {
    var selectedValue = $selector.val();
    var text = '';

    if ($selector.attr('id') === 'side') {
        text = selectedValue === "0" ? "Замовник" : "Постачальник";
        $('#retail-list-regulations-side').text(text);
        $('#one-regulation-side-regulation').text(text);

    } else if ($selector.attr('id') === 'typeContract') {
        if (selectedValue === "0") {
            text = "Торгові";
        } else if (selectedValue === "1") {
            text = "Складські";
        } else if (selectedValue === "2") {
            text = "Транспортні";
        }
        $('#retail-list-regulations-type-text').text(text);
    }

    updateMissingRegulationsText();
}

function updateMissingRegulationsText() {
    var typeContractText = $('#retail-list-regulations-type-text').text().toLowerCase();
    var sideText = $('#retail-list-regulations-side').text();

    $('#missingRegulationsTitleType').text(typeContractText);
    $('#missingRegulationsTitleSide').text(sideText);
}

// disabled on fileinput, dateSigningContract
export function checkContractSigned() {
    if ($("#contractSigned").is(":checked")) {
        $("#dateSigningContract, #fileInput").prop("disabled", false);
    } else {
        $("#dateSigningContract, #fileInput").prop("disabled", true);
    }
}

export function hideAllVarElements(defaultHiddenElsArr) {

    $.each(defaultHiddenElsArr, function (i, el) {
        if (!$(el).hasClass("d-none")) {
            $(el).addClass("d-none");
        }
    });
}
