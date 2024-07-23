var header_ids = {};

$(document).ready(function () {
    let url = window.location.href;
    const csrf = document.querySelector('meta[name="csrf-token"]').content
    let regex = /\/(\d+)\/edit$/;
    let match = url.match(regex);
    let document_id = match[1];

    $('.doctype-menu-item').click(function () {
        window.location.href = $(this).data('href');
    });

    $('.cancel-btn').on('click', function (e) {
        e.preventDefault()
        let modal = $(this).closest('.modal');
        modal.css('display', 'none');
    })

    function validateData(id) {
        let form = document.querySelector('#' + id);
        // Знаходимо всі обов'язкові поля, селекти, чекбокси та поля вводу файлів
        const requiredFields = form.querySelectorAll('.required-field');
        const requiredSelects = form.querySelectorAll('.required-field-select');
        const requiredCheckboxes = form.querySelectorAll('.required-field-switch');
        const requiredFileInputs = form.querySelectorAll('input[type="file"].required-field');

        // Перевіряємо, чи всі обов'язкові поля, селекти, чекбокси та поля вводу файлів заповнені
        let allFieldsValid = true;
        let allFieldsValidSelect = true;
        let allFieldsValidSwitch = true;
        let allFieldsValidFileInput = true;

        requiredFields.forEach(field => {
            if (field.value === '') {
                allFieldsValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        requiredSelects.forEach(select => {
            if (select.value === '') {
                allFieldsValidSelect = false;
                select.classList.add('error');
            } else {
                select.classList.remove('error');
            }
        });

        requiredCheckboxes.forEach(checkbox => {
            if (!checkbox.checked) {
                allFieldsValidSwitch = false;
                checkbox.classList.add('is-invalid');
            } else {
                checkbox.classList.remove('is-invalid');
            }
        });

        requiredFileInputs.forEach(fileInput => {
            if (fileInput.files.length === 0) {
                allFieldsValidFileInput = false;
                fileInput.classList.add('is-invalid');
            } else {
                fileInput.classList.remove('is-invalid');
            }
        });

        if (!allFieldsValid || !allFieldsValidSelect || !allFieldsValidSwitch || !allFieldsValidFileInput) {
            form.classList.add('was-validated');
        }

        //console.log(allFieldsValid, allFieldsValidSelect, allFieldsValidSwitch, allFieldsValidFileInput)

        return allFieldsValid && allFieldsValidSelect && allFieldsValidSwitch && allFieldsValidFileInput;
    }

    $(document).ready(function () {
        // Attach a change event listener to all select elements with the class 'required-field-select'
        $('.required-field-select').on('change', function () {
            // Check if the selected value is not empty and the element has the 'error' class
            if ($(this).val() !== '' && $(this).hasClass('error')) {
                // If not empty and has 'error' class, remove the 'error' class
                $(this).removeClass('error');
                $(this).addClass('success');
            }
        });
    });

    for (let i = 0; i < relatedDocuments.length; i++) {

        $('#add_document_' + i).on('click', async function (e) {
            e.preventDefault()


            let documentForm = document.querySelector('#form-document-' + i);
            const formData = new FormData(documentForm);
            formData.append('type_id', relatedDocuments[i]['id'])
            formData.append('document_id', document_id)

            await fetch(window.location.origin + '/document/table/create', {
                method: 'POST',
                body: formData
            }).then(async function (res) {
                if (res.status != 200) {
                    alert('Something is wrong, please reload the page')
                }
                $('#update-document-' + relatedDocuments[i]['id']).jqxGrid('updatebounddata');
            })

            $('#modal-document-' + i).modal('hide')
            clearDocumentForm(documentForm)

        })
    }

    async function sendRequest(status) {
        const elements = document.getElementsByClassName('custom-block');

        let custom_blocks = {}

        let allFieldsValid = validateData('header_form')

        if (allFieldsValid) {
            const formData = new FormData();

            let dataObject = {
                header: getFormObjectById('header_form', ''),
                header_ids
            }

            for (let i = 0; i < elements.length; i++) {
                const element = elements[i];
                const id = element.id;
                custom_blocks[i] = getFormObjectById(id, '-custom');
                if (!validateData(id)) {
                    return
                }
            }

            dataObject['custom_blocks'] = custom_blocks;

            formData.append('_token', csrf)
            formData.append('_method', 'PUT')
            formData.append('data', JSON.stringify(dataObject))
            formData.append('status_id', status)
            await fetch(window.location.origin + '/document/' + document_id, {
                method: 'POST',
                body: formData
            })

            window.location.href = window.location.origin + '/document/table/' + $('#header_form').data('type')
        }
    }

    $('#document-save').on('click', function () {
        sendRequest(1)
    })
    $('#draft-save').on('click', function () {
        sendRequest(2)
    })

    function getList(sku_id) {
        $.ajax({
            url: window.location.origin + '/sku/all-data/' + sku_id,
            method: 'GET',
            success: function (response) {
                let sku = response;
                $('#empty_packing').addClass('d-none')
                $('#info-block').removeClass('d-none')
                $('#sku-name').html(sku.name)
                $('#sku-height').html(sku.height)
                $('#sku-width').html(sku.width)
                $('#sku-length').html(sku.length)
                $('#sku-weight').html(sku.weight)
                $('#sku-weight-netto').html(sku.weight_netto)
                $('#sku-weight-brutto').html(sku.weight_brutto)
                $('#sku-temperature').html(sku.temperature)
                $('#sku-wms-leftovers').html(sku.wms_leftovers)
                $('#sku-erp-leftovers').html(sku.erp_leftovers)
                $('#measurement-unit').html(sku.measurement_unit)

                if (settings['document_kind'] !== 1) {
                    sku.consignments.forEach(item => {
                        var data = {
                            id: item,
                            text: item
                        };

                        var newOption = new Option(data.text, data.id, false, false);
                        $('#consignment').append(newOption);
                    });
                    $('#consignment').trigger('change');
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    }

    function getContainerList(container_id) {
        $.ajax({
            url: window.location.origin + '/containers/all-data/' + container_id,
            method: 'GET',
            success: function (response) {
                let container = response;
                $('#container-empty-packing').addClass('d-none')
                $('#container-info-block').removeClass('d-none')
                $('#container-name').html(container.name)
                $('#container-height').html(container.height)
                $('#container-width').html(container.width)
                $('#container-length').html(container.length)
                $('#container-weight').html(container.weight)
                $('#container-wms-leftovers').html(container.wms_leftovers)
                $('#container-erp-leftovers').html(container.erp_leftovers)
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    }

    $('#sku_category').on('change', function () {
        let category_id = $(this).val()
        $.ajax({
            url: window.location.origin + '/sku/get-by-category/' + category_id,
            method: 'GET',
            success: function (response) {
                let sku = response.data;
                let select = $('#sku_list')
                let selectStr = ''
                sku.forEach(item => {
                    selectStr += '<option value="' + item.id + '">' + item.name + '</option>'
                })
                select.html(selectStr);
                // Remove 'error' class if it exists
                if (select.hasClass('error')) {
                    select.removeClass('error');
                }
                let sku_id = select.val()
                getList(sku_id)
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    })

    $('#container_category').on('change', function () {
        let category_id = $(this).val()
        $.ajax({
            url: window.location.origin + '/containers/get-by-type/' + category_id,
            method: 'GET',
            success: function (response) {
                let containers = response.data;
                let select = $('#container_list')
                let selectStr = ''
                containers.forEach(item => {
                    selectStr += '<option value="' + item.id + '">' + item.name + '</option>'
                })
                select.html(selectStr);
                // Remove 'error' class if it exists
                if (select.hasClass('error')) {
                    select.removeClass('error');
                }
                let container_id = select.val()
                getContainerList(container_id)
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    })

    $('#service_category').on('change', function () {
        let category_id = $(this).val()
        $.ajax({
            url: window.location.origin + '/services/get-by-type/' + category_id,
            method: 'GET',
            success: function (response) {
                let containers = response.data;
                let select = $('#service_list')
                let selectStr = ''
                containers.forEach(item => {
                    selectStr += '<option value="' + item.id + '">' + item.name + '</option>'
                })
                select.html(selectStr);
                // Remove 'error' class if it exists
                if (select.hasClass('error')) {
                    select.removeClass('error');
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    })


    $('#sku_list').on('change', function () {
        let sku_id = $(this).val()
        getList(sku_id)
    })

    $('#add_sku').on('click', function () {
        if (validateData('sku-form')) {
            let skuForm = document.querySelector('#sku-form');
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content)
            formData.append('document_id', document_id)
            formData.append('data', JSON.stringify(getFormObjectById('sku-form')))

            skuForm.reset();

            fetch(window.location.origin + "/document/sku/table/", {
                method: "POST",
                body: formData
            }).then(() => {
                $("#updateSkuDataTable").jqxGrid("updatebounddata");
            })

            clearSKUForm(skuForm)
        }
    })

    $('#container_list').on('change', function () {
        let container_id = $(this).val()
        getContainerList(container_id)
    })

    $('#add_container').on('click', function () {
        if (validateData('container-form')) {
            let containerForm = document.querySelector('#container-form');
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content)
            formData.append('document_id', document_id)
            formData.append('data', JSON.stringify(getFormObjectById('container-form')))

            containerForm.reset();

            fetch(window.location.origin + "/document/container/table/", {
                method: "POST",
                body: formData
            }).then(() => {
                $("#updateСontainerDataTable").jqxGrid("updatebounddata");
            })

            clearContainerForm(containerForm)
        }
    })

    $('#add_service').on('click', function () {
        if (validateData('service-form')) {
            let serviceForm = document.querySelector('#service-form');
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content)
            formData.append('document_id', document_id)
            formData.append('data', JSON.stringify(getFormObjectById('service-form')))

            serviceForm.reset();

            fetch(window.location.origin + "/document/service/table/", {
                method: "POST",
                body: formData
            }).then(() => {
                $("#updateServicesDataTable").jqxGrid("updatebounddata");
            })

            clearServiceForm(serviceForm)
        }
    })


    function clearContainerForm(skuForm) {
        const selectElements = skuForm.querySelectorAll('select');
        $('#add_container_doc').modal('hide')
        $('.modal-backdrop').remove();
        $('#container_list').html('')
        $('#container-empty-packing').removeClass('d-none')
        $('#container-info-block').addClass('d-none')
        selectElements.forEach(selectElement => {
            selectElement.selectedIndex = -1;
            $(selectElement).select2();
        })
    }

    function clearDocumentForm(form) {
        const selectElements = form.querySelectorAll('select');
        selectElements.forEach(selectElement => {
            selectElement.selectedIndex = -1;
            $(selectElement).select2();
        })
    }

    function clearSKUForm(skuForm) {
        const selectElements = skuForm.querySelectorAll('select');
        $('#add_sku_doc').modal('hide')
        $('.modal-backdrop').remove();
        $('#sku_list').html('')
        $('#empty_packing').removeClass('d-none')
        $('#info-block').addClass('d-none')
        $('#sku_category').get(0).selectedIndex = -1
        $('#sku_category').select2()
        selectElements.forEach(selectElement => {
            selectElement.selectedIndex = -1;
            $(selectElement).select2();
        })
    }

    function clearServiceForm(skuForm) {
        const selectElements = skuForm.querySelectorAll('select');
        $('#add_service_doc').modal('hide')
        $('.modal-backdrop').remove();
        $('#service_list').html('')

        selectElements.forEach(selectElement => {
            selectElement.selectedIndex = -1;
            $(selectElement).select2();
        })
    }

})


function getFormObjectById(formId, popUpID) {
    const formElement = document.getElementById(formId);
    const formData = new FormData(formElement);

    const formObject = {};

    for (const [key, value] of formData.entries()) {
        if (key.includes("[]")) {
            // Remove brackets '[]' from key name
            let newKey = key.replace("[]", "");
            // Initialize the array if not already done
            if (value != '') {
                if (newKey.includes('dateTimeRange_') || newKey.includes('dateTime_') || newKey.includes('range_field_')) {
                    if (!formObject[newKey]) {
                        formObject[newKey] = [];
                    }
                    formObject[newKey].push(value);
                } else {
                    let obj = $(`select[name="${key}"]`).find(`option[value="${value}"]`);

                    if (!formObject[newKey]) {
                        formObject[newKey] = [];
                        header_ids[`${newKey}_id`] = [];
                    }

                    // Push the value into the array
                    formObject[newKey].push(obj.text());
                    header_ids[`${newKey}_id`].push(obj.val());
                }
            }
        } else if (key.includes("uploadFile_") && value != '') {
            if (!formObject[key]) formObject[key] = [];
            formObject[key].push(value.name)
        } else if (key.includes("switch_") && value != '') {
            formObject[key] = $('#' + key)[0].checked;
        } else if (key.includes("dateRange") && value != '') {
            let dates = value.split(' to ');
            formObject[key] = []
            formObject[key][0] = dates[0]
            formObject[key][1] = dates[1]
        } else {
            if (key.includes('select_field_')) {
                formObject[key] = $(`select[name="${key}"]`).find('option:selected').text();
                header_ids[`${key}_id`] = $(`select[name="${key}"]`).val();
            } else {
                formObject[key] = value;
            }
        }
    }

    return formObject;
}

