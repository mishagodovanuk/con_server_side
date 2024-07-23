//sku використовується в файлі sku-table, як Data source,
// documentArray в document-types.js
const csrf = document.querySelector('meta[name="csrf-token"]').content
var sku = []
var container = []
var service = []
var documentArray = []
let s_id = 1
let c_id = 1
let service_id = 1

var header_ids = {};

$('.doctype-menu-item').click(function () {
    window.location.href = $(this).data('href');
});
$('.jqx-tabs-title').on('click', function () {
    $('.modal-btn:visible').css('display', 'none')
    $('#' + $(this).data('modal')).css('display', 'block')
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

async function sendRequest(status) {
    const elements = document.getElementsByClassName('custom-block');
    let isRedirect = true
    let custom_blocks = {}

    let allFieldsValid = validateData('header_form')
    console.log(allFieldsValid)
    if (allFieldsValid) {
        // Якщо всі поля заповнені, надсилаємо форму на бекенд
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

        dataObject['custom_blocks'] = custom_blocks

        formData.append('_token', csrf)
        formData.append('data', JSON.stringify(dataObject))
        formData.append('status_id', status)
        formData.append('type_id', $('#header_form').data('type'))
        formData.append('related_documents', JSON.stringify(documentArray))

        const fileField = document.getElementsByClassName('upload-file');

        for (let i = 0; i < fileField.length; i++) {
            const files = fileField[i].files; // This gives you a FileList of File objects
            console.log(fileField[i])

            for (let j = 0; j < files.length; j++) {
                formData.append(fileField[i].name + '_' + j, files[j]);
            }
        }

        await fetch(window.location.origin + '/document', {
            method: 'POST', body: formData
        }).then(async function (res) {
            let response = await res.json()
            if ($('#skuDataTable').length) {
                let skuFormData = new FormData()
                skuFormData.append('_token', csrf)

                const modifiedSKU = sku.map((jsonString) => {
                    const obj = JSON.parse(jsonString);
                    delete obj.name;
                    return JSON.stringify(obj);
                });

                skuFormData.append('data', modifiedSKU)
                skuFormData.append('document_id', response.document_id)

                fetch(window.location.origin + '/document/sku', {
                    method: 'POST', body: skuFormData
                }).then(async function (res) {
                    let status = await res.status
                    if (status !== 200) {
                        isRedirect = false
                    }
                })
            }
            if ($('#containerDataTable').length) {
                let containerFormData = new FormData()
                containerFormData.append('_token', csrf)
                containerFormData.append('data', container)
                containerFormData.append('document_id', response.document_id)
                fetch(window.location.origin + '/document/container', {
                    method: 'POST', body: containerFormData
                }).then(async function (res) {
                    let status = await res.status
                    if (status !== 200) {
                        isRedirect = false
                    }
                })
            }
            if ($('#servicesDataTable').length) {
                let serviceFormData = new FormData()
                serviceFormData.append('_token', csrf)
                serviceFormData.append('data', service)
                serviceFormData.append('document_id', response.document_id)
                fetch(window.location.origin + '/document/service', {
                    method: 'POST', body: serviceFormData
                }).then(async function (res) {
                    let status = await res.status
                    console.log(status)
                    if (status != 200) {
                        isRedirect = false
                    }
                })
            }
        })
            .finally(async function () {
                    if (isRedirect) {
                        let url = window.location.href
                        window.location.href = url.replace("create", "table")
                    } else {
                        alert('Something wrong, please refresh page')
                    }
                }
            )
    }
}

$('#document-save').on('click', function () {
    sendRequest(1)
})
$('#draft-save').on('click', function () {
    sendRequest(2)
})

function getDataPackages(sku_id) {
    const urlPackages = window.location.origin + `/sku/table/${sku_id}/package-filter`;
    console.log('url:', urlPackages)
    $.ajax({
        url: urlPackages, method: 'GET', dataType: 'json', success: function (data) {
            var arrForSelect = data.data.map(function (obj) {
                return {id: obj.type_id, name: obj.type};
            });
            console.log('таска в джирі 611 . цей масив запушити в селект замість селекта одинці вимір. і назвати його пакування. (в редагуванні не забути)', arrForSelect)

        }, error: function (xhr, status, error) {
            console.error(error);
        }
    });
}

function getList(sku_id) {
    getDataPackages(sku_id)
    $.ajax({
        url: window.location.origin + '/sku/all-data/' + sku_id, method: 'GET', success: function (response) {
            let sku = response;
            $('#empty_packing').addClass('d-none')
            $('#info-block').removeClass('d-none')
            $('#sku-name').html(sku.name)
            if (sku.height || sku.width || sku.length || sku.weight || sku.weight_netto || sku.weight_brutto || sku.temperature) {
                $('#params-data').removeClass('d-none')
                $('#sku-height').html(sku.height ?? '-')
                $('#sku-width').html(sku.width ?? '-')
                $('#sku-length').html(sku.length ?? '-')
                $('#sku-weight').html(sku.weight ?? '-')
                $('#sku-weight-netto').html(sku.weight_netto ?? '-')
                $('#sku-weight-brutto').html(sku.weight_brutto ?? '-')
                $('#sku-temperature').html(sku.temperature ?? '-')
            } else {
                $('#empty-data').removeClass('d-none')
            }

            $('#sku-wms-leftovers').html(sku.wms_leftovers ?? '-')
            $('#sku-erp-leftovers').html(sku.erp_leftovers ?? '-')
            $('#measurement-unit').html(sku.measurement_unit ?? '-')

            if (settings['document_kind'] !== 1) {
                sku.consignments.forEach(item => {
                    var data = {
                        id: item, text: item
                    };

                    var newOption = new Option(data.text, data.id, false, false);
                    $('#consignment').append(newOption);
                });
                $('#consignment').trigger('change');
            }
        }, error: function (xhr, status, error) {
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

$('#container_list').on('change', function () {
    let container_id = $(this).val()
    getContainerList(container_id)
})

$('.cancel-btn').on('click', function (e) {
    e.preventDefault()
    let modal = $(this).closest('.modal');
    modal.css('display', 'none');
})
$('#add_sku').on('click', function () {
    if (validateData('sku-form')) {
        let skuForm = document.querySelector('#sku-form');

        var myGrid = $('#skuDataTable').jqxGrid('getInstance');

        var selectName = document.getElementById("sku_list");
        var selectedName = selectName.options[selectName.selectedIndex];

        const formObject = getFormObjectById('sku-form', '-popup-goods')

        formObject['name'] = selectedName.text

        let newRowData = formatData(formObject, s_id)

        sku.push(JSON.stringify(formObject))
        skuForm.reset();
        myGrid.addrow(null, newRowData);
        clearSKUForm(skuForm)
        s_id++;
    }
})

$('#add_container').on('click', function () {
    if (validateData('container-form')) {
        let containerForm = document.querySelector('#container-form');

        var myGrid = $('#containerDataTable').jqxGrid('getInstance');

        const formObject = getFormObjectById('container-form', '-popup-container')

        let newRowData = formatData(formObject, c_id)

        container.push(JSON.stringify(formObject))
        containerForm.reset();
        myGrid.addrow(null, newRowData);
        clearContainerForm(containerForm)
        c_id++;
    }
})

$('#add_service').on('click', function () {
    if (validateData('service-form')) {
        let serviceForm = document.querySelector('#service-form');

        var myGrid = $('#servicesDataTable').jqxGrid('getInstance');

        const formObject = getFormObjectById('service-form', '-popup-service')

        let newRowData = formatData(formObject, c_id)

        service.push(JSON.stringify(formObject))
        serviceForm.reset();
        myGrid.addrow(null, newRowData);
        clearServiceForm(serviceForm)
        service_id++;
    }
})


function formatData(formObject, id) {
    var newRowData = {};
    newRowData['id'] = id
    for (let key in formObject) {

        if (key.startsWith('range_') || key.startsWith('timeRange_') || key.startsWith('dateRange_')) {
            console.log(formObject[key])
            newRowData[key] = formObject[key][0] + '-' + formObject[key][1];
        } else if (key.startsWith('dateTimeRange_')) {
            newRowData[key] = formObject[key][0] + ' ' + formObject[key][1] + '-' + formObject[key][2];
        } else if (key.startsWith('dateTime_')) {
            newRowData[key] = formObject[key][0] + ' ' + formObject[key][1];
        } else if (key.startsWith('switch_')) {
            newRowData[key] = formObject[key] ? 'Включено' : 'Виключено';
        } else {
            newRowData[key] = formObject[key];
        }
    }

    return newRowData;
}


function clearSKUForm(skuForm) {
    const selectElements = skuForm.querySelectorAll('select');
    $('#add_sku_doc').modal('hide')
    $('.modal-backdrop').remove();
    $('#sku_list').html('')
    $('#empty_packing').removeClass('d-none')
    $('#info-block').addClass('d-none')
    $('#empty-data').addClass('d-none')
    selectElements.forEach(selectElement => {
        selectElement.selectedIndex = -1;
        $(selectElement).select2();
    })
}

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

function clearDocumentForm(form) {
    const selectElements = form.querySelectorAll('select');
    selectElements.forEach(selectElement => {
        selectElement.selectedIndex = -1;
        $(selectElement).select2();
    })
}

function getFormObjectById(formId, popUpID) {
    const formElement = document.getElementById(formId);
    const formElements = formElement.elements;
    const formObject = {};

    for (let i = 0; i < formElements.length; i++) {
        const element = formElements[i];

        if (!element.name) continue; // Skip elements without a name

        if (element.name.includes("[]")) {
            let newKey = element.name.replace("[]", "");

            if (!formObject[newKey]) {
                formObject[newKey] = [];
            }

            if (element.value !== '') {
                if (newKey.includes('dateTimeRange_') || newKey.includes('dateTime_') || newKey.includes('range_field_')) {
                    formObject[newKey].push(element.value);
                } else {
                    let optionText = element.options[element.selectedIndex].text;
                    //console.log(optionText)
                    let optionValue = element.value;
                    formObject[newKey].push(optionText);
                    if (!header_ids[`${newKey}_id`]) {
                        header_ids[`${newKey}_id`] = [];
                    }
                    header_ids[`${newKey}_id`].push(optionValue);
                }
            }
        } else if (element.type === 'file' && element.name.includes("uploadFile_")) {
            if (!formObject[element.name]) formObject[element.name] = [];
            Array.from(element.files).forEach(file => {
                formObject[element.name].push(file.name);
            });
        } else if (element.type === 'checkbox' || element.type === 'radio') {
            formObject[element.name] = element.checked;
        } else if (element.name.includes("dateRange") && element.value !== '') {
            let dates = element.value.split(' to ');
            formObject[element.name] = [dates[0], dates[1]];
        } else if (element.name.includes('select_')) {

            if (popUpID === '-custom') {
                header_ids[`${element.name}_id`] = $(`#${element.name + popUpID}`).val();
                formObject[element.name] = $(`#${element.name}` + popUpID).find('option:selected').text();
            } else {
                header_ids[`${element.name}_id`] = $(`#${element.name}`).val();
                formObject[element.name] = $(`#${element.name}` + popUpID).find('option:selected').text();
            }
            //console.log(formObject[element.name])
        } else {
            formObject[element.name] = element.value;
        }
    }
    //console.log(formObject)
    return formObject;

}

