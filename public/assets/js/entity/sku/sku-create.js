$(document).ready(function () {
    let url = window.location.origin;
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    const packageTypesUrl = `${window.location.origin}/dictionary/package_type`;
    var packageTypes;
    ;

    function fetchDataAndStore(url) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    resolve(data);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    reject(error);
                }
            });
        });
    }

    fetchDataAndStore(packageTypesUrl)
        .then(data => {
            packageTypes = data.data;
        })
        .catch(error => {
            console.log('error', error)
        });


    function getFormData() {

        let formData = new FormData();
        formData.append("_token", csrf);
        formData.append("name", $("#name_sku").val());
        formData.append("company_id", $("#company_owner").val());
        formData.append("party", $("#fp-default").val());
        formData.append("cargo_type_id", $("#cargo_type").val());
        formData.append("category_id", $("#category_sku").val());
        formData.append("manufacturer_id", $("#producer").val());
        formData.append("manufacturer_country_id", $("#producerСountry").val());
        formData.append("adr_id", $("#adr").val());
        formData.append("measurement_unit_id", $("#unit_sku").val());
        formData.append("weight_netto", $("#sku_net_weight").val());
        formData.append("weight_brutto", $("#sku_gross_weight").val());
        formData.append("temp_from", $("#temperature_regime_from").val());
        formData.append("temp_to", $("#temperature_regime_to").val());
        formData.append("height", $("#sku_height").val());
        formData.append("width", $("#sku_width").val());
        formData.append("depth", $("#sku_length").val());
        formData.append("comment", $("#comment_goods").val());

        return formData
    }

    function getData() {

        let formData = getFormData()
        var allPackets = $("#packing-table").jqxGrid("getrows");
        var allBarcode = $("#barcode-table").jqxGrid("getrows");

        let newPackages = allPackets.map((val) => {
            return {
                type_id: val.type,
                packingSetMain: val.packingSetMain ? true : "",
                number: val.count,
                weight: val.packingWeight,
                weight_netto: val.weightNet,
                weight_brutto: val.weightGross,
                height: val.size.height,
                width: val.size.width,
                depth: val.size.length,
            };
        });

        newPackages.forEach((item, index) => {
            for (const [key, value] of Object.entries(item)) {
                formData.append(`packages[${index}][${key}]`, value);
            }
        });

        let newBarcodes = allBarcode.map((item) => {
            return item.barcode;
        });

        newBarcodes.forEach((item) => {
            formData.append("barcodes[]", item);
        });

        return formData;
    }

    function getDataEditSku() {
        let formData = getFormData()
        formData.append("_method", "PUT");

        var allPackets = $("#packing-table").jqxGrid("getrows");
        var allBarcode = $("#barcode-table").jqxGrid("getrows");

        let newPackages = allPackets.map((val) => {
            return {
                type_id: !isNumeric(val.type)
                    ? packageTypes.find((el) => el.name === val.type).id
                    : val.type,
                packingSetMain: val.packingSetMain ? true : "",
                number: val.count,
                weight: val.packingWeight,
                weight_netto: val.weightNet,
                weight_brutto: val.weightGross,
                height: val.size.height,
                width: val.size.width,
                depth: val.size.length,
                id: val.id || "",
            };
        });

        newPackages.forEach((item, index) => {
            for (const [key, value] of Object.entries(item)) {
                formData.append(`packages[${index}][${key}]`, value);
            }
        });

        let newBarcodes = allBarcode.map((item) => {
            return item.barcode;
        });

        newBarcodes.forEach((item) => {
            formData.append("barcodes[]", item);
        });

        return formData;
    }

    async function validateSku(response) {
        let res = await response.json();
        let data = res.errors;
        if (
            data.hasOwnProperty("name") ||
            data.hasOwnProperty("company_id") ||
            data.hasOwnProperty("party") ||
            data.hasOwnProperty("measurement_unit_id") ||
            data.hasOwnProperty("category_id") ||
            data.hasOwnProperty("manufacturer_id") ||
            data.hasOwnProperty("adr_id") ||
            data.hasOwnProperty("manufacturer_country_id")
        ) {
            appendAlert(
                "#basic-data-message",
                "danger",
                Object.values(data)[0]
            );
        } else if (
            data.hasOwnProperty("height") ||
            data.hasOwnProperty("depth") ||
            data.hasOwnProperty("temp_from") ||
            data.hasOwnProperty("temp_to") ||
            data.hasOwnProperty("weight_netto") ||
            data.hasOwnProperty("width") ||
            data.hasOwnProperty("weight_brutto") ||
            data.hasOwnProperty("packages")
        ) {
            appendAlert(
                "#parameters-message",
                "danger",
                Object.values(data)[0]
            );
        }
    }

    $("#save").on("click", async function () {
        await fetch(url + "/sku", {
            method: "POST",
            body: getData(),
        }).then(async (response) => {
            if (response.status === 200) {
                window.location.href = url + "/sku";
            } else {
                validateSku(response);
            }
        });
    });

    $("#edit").on("click", async function (e) {
        e.preventDefault();
        const id = e.target.dataset.id;
        await fetch(url + "/sku/" + id, {
            method: "POST",
            body: getDataEditSku(),
            headers: {
                "X-CSRF-Token": csrf,
            },
        }).then(async (response) => {
            if (response.status === 200) {
                window.location.href = url + "/sku";
            } else {
                validateSku(response);
            }
        });
    });

    // Collect data from add packing modal and render them in packing table
    function getPackingData() {
        const packingType = $("#add_paking_name").val();
        const packingQuantity = $("#packing-quantity").val();
        const packingWeight = $("#packing-weight").val();
        const packingNetWeight = $("#packing-net-weight").val();
        const packingGrossWeight = $("#packing-gross-weight").val();
        const packingHeight = $("#packing-height").val();
        const packingWidth = $("#packing-width").val();
        const packingLength = $("#packing-length").val();
        const packingSetMain = $("#packing-setMain").prop("checked");
        var packingObj = {
            type: packingType,
            packingSetMain: packingSetMain,
            count: packingQuantity,
            packingWeight: packingWeight,
            weightNet: packingNetWeight,
            weightGross: packingGrossWeight,
            size: {
                height: packingHeight,
                width: packingWidth,
                length: packingLength,
            },
        };
        return packingObj;
    }

    $("#package_submit").click(function () {
        var allPackets = $("#packing-table").jqxGrid("getrows");
        const data = getPackingData();
        const rowData = {
            type: data.type,
            count: data.count,
            packingWeight: data.packingWeight,
            weightNet: data.weightNet,
            weightGross: data.weightGross,
            size: data.size,
            packingSetMain: data.packingSetMain,
        };

        if (rowData.packingSetMain) {
            allPackets.forEach((el) => {
                if (el.packingSetMain) {
                    $("#packing-table").jqxGrid("updaterow", el.uid, {
                        ...el,
                        packingSetMain: !el.packingSetMain,
                    });
                }
            });
        }

        $("#packing-table").jqxGrid("addrow", null, rowData);
        $("#add_paking_name").val("").trigger("change.select2");
        $("#packing-quantity").val("");
        $("#packing-weight").val("");
        $("#packing-net-weight").val("");
        $("#packing-gross-weight").val("");
        $("#packing-height").val("");
        $("#packing-width").val("");
        $("#packing-length").val("");
        $("#packing-setMain").prop("checked", false);
    });

    function getEditPackingData() {
        $("#edit_paking").removeData("uidrow");
        const packingType = $("#edit_paking_name").val();
        const packingQuantity = $("#edit_quantity_packing").val();
        const packingWeight = $("#edit_weight_packing").val();
        const packingNetWeight = $("#edit_net_weight").val();
        const packingGrossWeight = $("#edit_gross_weight").val();
        const packingHeight = $("#edit_size_height").val();
        const packingWidth = $("#edit_size_width").val();
        const packingLength = $("#edit_size_depth").val();
        const packingSetMain = $("#edit_packing-setMain").prop("checked");
        const packing_uid = $("#edit_paking").data("uidrow");
        var packingObj = {
            type: packingType,
            packingSetMain: packingSetMain,
            count: packingQuantity,
            packingWeight: packingWeight,
            weightNet: packingNetWeight,
            weightGross: packingGrossWeight,
            size: {
                height: packingHeight,
                width: packingWidth,
                length: packingLength,
            },
            uid: packing_uid,
        };

        return packingObj;
    }

    $("#edit_condition_submit").click(async function () {
        var allPackets = $("#packing-table").jqxGrid("getrows");
        const data = getEditPackingData();
        const rowData = {
            type: data.type,
            count: data.count,
            packingWeight: data.packingWeight,
            weightNet: data.weightNet,
            weightGross: data.weightGross,
            size: data.size,
            packingSetMain: data.packingSetMain,
        };
        await performTablePacking(allPackets, rowData);
        await $("#packing-table").jqxGrid("updaterow", data.uid, rowData);
    });

    async function performTablePacking(allPackets, rowData) {
        if (rowData.packingSetMain) {
            allPackets.forEach((el) => {
                if (el.packingSetMain && el.uid !== rowData.uid) {
                    $("#packing-table").jqxGrid("updaterow", el.uid, {
                        ...el,
                        packingSetMain: !el.packingSetMain,
                    });
                }
            });
        }
    }

    // Collect data from add barcode modal and render them in barcode table
    function getBarcodeData() {
        const barcodeInput = $("#add_bar_code_input");
        const inputValue = barcodeInput.val();
        var barcodeObj = {
            barcode: inputValue,
        };

        return barcodeObj;
    }

    $("#create_barcode").click(function () {
        const data = getBarcodeData();
        const rowData = {
            barcode: data.barcode,
        };
        $("#barcode-table").jqxGrid("addrow", null, rowData);
        $("#add_bar_code_input").val("");
    });

    function getEditBarcodeData() {
        $("#edit_bar_code").removeData("uidrow");
        const barcodeInput = $("#add_bar_code_input");
        const barcode_uid = $("#edit_bar_code").data("uidrow");

        const inputValue = barcodeInput.val();
        var barcodeObj = {
            barcode: inputValue,
            uid: barcode_uid,
        };

        return barcodeObj;
    }

    // Fill inputs in editing barcode
    $(document).on("click", '[data-bs-target="#edit_bar_code"]', function () {
        const barcode = $(this).data("barcode");
        const uid = $(this).data("uid");
        $("#edit_bar_code").attr("data-uidrow", uid);
        $("#edit_bar_code").find("#edit_barcode").val(barcode);

        // $("#barcode-table").jqxGrid("updaterow", data.uid, rowData);
    });

    // Fill inputs in editing packing
    $(document).on("click", '[data-bs-target="#edit_paking"]', function () {
        const packetObj = $(this).data("packet");
        const namePacking = isNumeric(packetObj.type) ? packageTypes.find((el) => el.id == packetObj.type).name : packetObj.type;
        const idPacking = !isNumeric(packetObj.type) ? packageTypes.find((el) => el.name === packetObj.type).id : packetObj.type;
        $("#edit_paking").attr("data-id", packetObj.id);
        $("#edit_paking").attr("data-uidrow", packetObj.uid);
        $("#select2-edit_paking_name-container").text(namePacking);
        $("#edit_paking_name").val(idPacking);
        $("#edit_quantity_packing").val(packetObj.count);
        $("#edit_weight_packing").val(packetObj.packingWeight);
        $("#edit_net_weight").val(packetObj.weightNet);
        $("#edit_gross_weight").val(packetObj.weightGross);
        $("#edit_size_height").val(packetObj.size.height);
        $("#edit_size_width").val(packetObj.size.width);
        $("#edit_size_depth").val(packetObj.size.length);
        $("#edit_packing-setMain").prop("checked", packetObj.packingSetMain);
    });

    // Disable add barcode button if input is empty
    $("#button_bar_code").click(function () {
        var $inputField = $("#add_bar_code_input");
        var $myButton = $("#create_barcode");

        function checkInputValue() {
            var inputValue = $inputField.val().trim();
            if (inputValue !== "") {
                $myButton.prop("disabled", false);
            } else {
                $myButton.prop("disabled", true);
            }
        }

        checkInputValue();
        $inputField.on("input", function () {
            checkInputValue();
        });
    });

    // Disable add packing button if inputs are empty
    function checkFields() {
        const packingTypeVal = $("#add_paking_name").val();
        const packingQuantityVal = $("#packing-quantity").val();
        const packingWeightVal = $("#packing-weight").val();
        const packingNetWeightVal = $("#packing-net-weight").val();
        const packingGrossWeightVal = $("#packing-gross-weight").val();
        const packingHeightVal = $("#packing-height").val();
        const packingWidthVal = $("#packing-width").val();
        const packingLengthVal = $("#packing-length").val();

        if (
            packingTypeVal &&
            packingQuantityVal &&
            packingWeightVal &&
            packingNetWeightVal &&
            packingGrossWeightVal &&
            packingHeightVal &&
            packingWidthVal &&
            packingLengthVal
        ) {
            $("#package_submit").prop("disabled", false);
        } else {
            $("#package_submit").prop("disabled", true);
        }
    }

    $("#button_paking").click(function () {
        checkFields();
        $("input, select").on("input change", function () {
            checkFields();
        });
    });

    // Editing row data in barcode-table
    $("#edit_condition_barcode_submit").on("click", function (event) {
        const updatedValue = $("#edit_barcode").val();
        const data = getEditBarcodeData();
        const rowData = {
            barcode: updatedValue,
        };
        if (updatedValue !== "") {
            $("#barcode-table").jqxGrid("updaterow", data.uid, rowData);
        }
    });

    function appendAlert(selector, type, message) {
        $(selector)[0].innerHTML = null;
        let block = document.createElement("div");
        block.className =
            "alert alert-" + type + " alert-dismissible fade show";
        block.setAttribute("role", "alert");
        block.innerHTML = message;
        let innerBtn = document.createElement("div");
        innerBtn.setAttribute("type", "button");
        innerBtn.setAttribute("data-bs-dismiss", "alert");
        innerBtn.setAttribute("aria-label", "Close");
        innerBtn.className = "close";
        block.append(innerBtn);
        let span = document.createElement("span");
        span.setAttribute("aria-hidden", "true");
        span.innerHTML = "&times;";
        innerBtn.append(span);
        $(selector).append(block);
    }

    function isNumeric(str) {
        return !isNaN(str) && !isNaN(parseFloat(str));
    }
});
