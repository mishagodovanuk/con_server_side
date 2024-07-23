import {translit} from "../../utils/translit.js";

$(document).ready(function () {

    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    const doctypeFieldsBase = doctypeFields
    //console.log(doctypeFieldsBase)

    // Змінні для збереження останнього id
    var lastIdSelect = null;
    var lastIdRequired = null;

    // Лічильник
    let countIdItem = 1;
    var click = 0;

    // Знаходимо елемент <ul>, до якого будемо додавати елементи <li>
    const ulElementSystemCustom = $(".arrTypeSystemFieldsCustom");

    const ulElementText = $(".arrTypeSystemFieldsListText");
    const ulElementRange = $(".arrTypeSystemFieldsListRange");

    const ulElementDate = $('.arrTypeSystemFieldsListDate');
    const ulElementDateRange = $('.arrTypeSystemFieldsListDateRange');
    const ulElementDateTimeRange = $('.arrTypeSystemFieldsListDateTimeRange');
    const ulElementTimeRange = $('.arrTypeSystemFieldsListTimeRange');
    const ulElementDateTime = $('.arrTypeSystemFieldsListTimeRange');

    const ulElementSelect = $(".arrTypeSystemFieldsListSelect");
    const ulElementLabel = $(".arrTypeSystemFieldsLabel");

    const ulElementSwitch = $(".arrTypeSystemFieldsListSwitch");
    const ulElementUploadFile = $(".arrTypeSystemFieldsListUploadFile");
    const ulElementComment = $(".arrTypeSystemFieldsListComment");

    const ulElements = {
        text: ulElementText,
        range: ulElementRange,

        select: ulElementSelect,
        label: ulElementLabel,

        date: ulElementDate,
        dateRange: ulElementDateRange,
        dateTimeRange: ulElementDateTimeRange,
        timeRange: ulElementTimeRange,
        dateTime: ulElementDateTime,


        switch: ulElementSwitch,
        uploadFile: ulElementUploadFile,
        comment: ulElementComment,
    };

    // Hover in Header Title
    var header_default = $('#accordion-field-header');
    var titleInput_default = $('#header-block-title-input');
    var titleH5_default = $('#accordion-field-title');

    const addItemParameterButton = $('#customAddItemParameter');
    const inputParameter = $('#inputParameter');
    const addItemDirectoryButton = $('#addItemInDirectory');
    const parameterBlock = $('#parameterBlock');
    const directoryBlock = $('#directoryBlock');
    const parameterList = $('.parameter-list');

    let parameterListItemsCustom = [[
        {
            "name": "Параметр 1",
            "is_checked": 1
        }],
        [{
            "name": "Параметр 2",
            "is_checked": 0
        }]
    ];

    const sections = ["nomenclature", "container", "services"];

    function generateListItem(field) {
        if (field.description === null) {
            field.description = 'Підказка'
        }
        //console.log(field)
        const li = `
        <li class="group sortable-item" data-desc="${field.description}" data-system="${field.system}">
            <div class="accordion-header ui-accordion-header mb-0 bg-white" data-type="${field.type}">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1" src="/assets/icons/create-type/${getIconSrc(field.type)}" alt="${field.type}">
                        <p class="system-title m-0" data-key="${field.key}">${field.title}</p>
                    </div>
                    ${field.system ? getSystemBadge(field.system) : getSystemBadge(field.system) + getRemoveButton()}
                </div>
            </div>
            <div class="document-field-accordion-body d-none" id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>
                        <label class="form-label" for="titleInput_${field.system}_${field.type}">Назва поля</label>
                        <input id="titleInput_${field.system}_${field.type}" class="form-control" type="text" placeholder="Назва поля приклад" value="${field.title}">
                    </div>
                    ${getAdditionalFields(field.type, field.system, field.description, field.id, field.parameters, field.model)}
                </div>
                <hr>
                <div class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">

                 ${field.type === "text" ? ` <div class="form-check form-check-warning pe-1">
                        <input type="checkbox" class="js-form-check-input form-check-input" id="requiredCheck_${field.system}_${field.type}">
                        <label class="js-form-check-label form-check-label" for="requiredCheck_${field.system}_${field.type}">Тільки числове значення</label>
                    </div>` : getSystemBadge(field.system) + getRemoveButton()}

                    <div class="form-check form-check-warning pe-1">
                        <input type="checkbox" class="js-form-check-input form-check-input" id="requiredCheck_${field.system}_${field.type}">
                        <label class="js-form-check-label form-check-label" for="requiredCheck_${field.system}_${field.type}">Обов'язкове</label>
                    </div>
                    <div>
                        <button type="button" id="removeButton_${field.system}_${field.type}" class="btn btn-flat-danger  d-flex align-items-center">
                            <img class="trash-red" src="/assets/icons/trash-red2.svg" alt="trash-red2">
                            <span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>`;

        return $(li);
    }

    function generateListItemCreateField(field) {
        if (field.description === null) {
            field.description = 'Підказка'
        }
        const li = `
    <li class="group sortable-item group-create" data-desc="${field.description}" data-system="${field.system}">
      <div class="group-create-padding accordion-header ui-accordion-header mb-0 bg-white" data-type="${field.type}">
        <div class="d-flex group-create-flex-center justify-content-between align-items-center" id="contentCreate">
          <div class="group-create-flex d-flex align-items-center justify-content-start" id="titleElemCreate">
            <img class="group-create-padding-end pe-1" id="iconCreate" src="/assets/icons/create-type/${getIconSrc(field.type)}" alt="${field.type}">
            <p class="system-title m-0 text-center" data-key="${field.key}">${field.title}</p>
          </div>
          ${field.system ? getSystemBadge(true) : getSystemBadge(false) + getRemoveButton()}
        </div>
      </div>
      <div class="document-field-accordion-body d-none" id="field-accordion-body">
        <div class="document-field-accordion-body-form">
          <div class="mb-1">
            <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>
            <label class="form-label" for="titleInput_${field.system}_${field.type}">Назва поля</label>
            <input id="titleInput_${field.system}_${field.type}" class="form-control" type="text" placeholder="Назва поля приклад" value="">
          </div>
                    ${getAdditionalFields(field.type, field.system, field.description, field.id, field.parameters, field.model)}
        </div>
        <hr>
        <div class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
          <div class="form-check form-check-warning pe-1">
            <input type="checkbox" class="js-form-check-input form-check-input" id="requiredCheck_${field.system}_${field.type}">
            <label class="js-form-check-label form-check-label" for="requiredCheck_${field.system}_${field.type}">Обов'язкове</label>
          </div>
          <div>
            <button type="button" id="removeButton_${field.system}_${field.type}" class="btn btn-flat-danger d-flex align-items-center">
              <img class="trash-red" src="/assets/icons/trash-red2.svg" alt="trash-red2">
              <span>Видалити</span>
            </button>
          </div>
        </div>
      </div>
    </li>`;

        return $(li);
    }

    function getIconSrc(type) {
        switch (type) {
            case "text":
                return "letter-case.svg";
            case "range":
                return "letter-case.svg";
            case "date":
                return "calendar-event.svg";
            case "dateRange":
                return "calendar-event.svg";
            case "dateTime":
                return "calendar-event.svg";
            case "dateTimeRange":
                return "calendar-event.svg";
            case "timeRange":
                return "clock.svg";
            case "select":
                return "arrow-down-circle.svg";
            case "label":
                return "label.svg";
            case "switch":
                return "checkbox.svg";
            case "uploadFile":
                return "upload.svg";
            case "comment":
                return "align-justified.svg";
            default:
                return "users.svg";
        }
    }

    function getSystemBadge(system) {
        //console.log(system)
        return `
        <div class="d-flex d-none" id="header-badge">
            <div>
                ${system ? '<span class="badge badge-light-secondary mx-2">Системне</span>' : ''}
                <span class="badge badge-light-secondary mx-2 d-none" id="field-badge-required">Обовʼязкове</span>
            </div>
            <div class="js-chevron-configurator">
                <img id="accordion-chevron" width="16px" src="/assets/icons/chevron-right.svg" alt="chevron">
            </div>
        </div>`;
    }

    function getRemoveButton() {
        return `<div class="removeButtonBaseField" id="removeButton"><img src="/assets/icons/close-field-base.svg" alt="close-field-base"></div>`;
    }

    function createParameterItem(value, checked, id = null) {
        const uniqueId = Math.random().toString(36).substring(2, 15);
        let checkboxId;
        let buttonRemoveId;

        if (id === null) {
            checkboxId = `requiredCheck_${uniqueId}`;
            buttonRemoveId = "removeButtonParemeters";
        } else {
            checkboxId = `requiredCheck_${id}_${uniqueId}`;
            buttonRemoveId = `removeButtonParemeters_${id}`;
        }

        let newParameterItem = `
    <li class="parameter-item" data-value="${value}" data-checked="${checked}">
    <div class="parameter-item-title">
        <img class="" src="/assets/icons/grip-vertical.svg" alt="grip-vertical"> ${value}
    </div>
    <div class='removeButtonBaseFieldParam align-items-center'>
        <div class="js-input-parameter ${checked ? 'checked-js-input-parameter' : ''}">
            <div class="form-check form-check-warning pe-1">
                <input type="radio" class="form-check-input" id="${checkboxId}" ${checked ? 'checked' : ''}>
                <label class="form-check-label" for="${checkboxId}">За замовчуванням</label>
            </div>
        </div>
        <div class="${buttonRemoveId}">
            <img src='/assets/icons/close-field-base.svg' alt='close-field-base'>
        </div>
    </div>
   </li>
    `;

        return newParameterItem;
    }

    // Function to add a new parameter to the list
    function addParameterToList(value, checked, id = null) {
        let parameterList;
        if (id === null) {
            parameterList = $('.parameter-list');
        } else {
            parameterList = $(`.parameter-list_${id}`);
        }
        const newParameter = createParameterItem(value, checked, id);
        parameterList.append(newParameter);

    }

    function initParam(parameterListItemsCustom, id = null) {
        // Initialize the parameter list
        for (const parameterGroup of parameterListItemsCustom) {
            for (const parameter of parameterGroup) {
                addParameterToList(parameter.name, parameter.is_checked, id);
            }
        }
    }

    function initParamBD(parameterListItemsCustom, id = null) {
        // Initialize the parameter list
        let parameterListHTML = '';

        for (const parameterGroup of parameterListItemsCustom) {
            for (const parameter of parameterGroup) {
                parameterListHTML += createParameterItem(parameter.name, parameter.is_checked, id);
            }
        }

        return parameterListHTML;
    }

    function getAdditionalFields(type, system, description, id, parameters = null, model = null) {
        let parameterListItems = []; // Оголошуємо порожній масив
        // Перевірити, чи є параметри та перетворити їх у бажаний формат
        //console.log(parameters)

        if (parameters !== null) {
            if (typeof parameters === 'string') {
                // Якщо parameters - рядок, то робимо JSON парсинг
                parameterListItems = JSON.parse(parameters);
            } else {
                // Якщо parameters вже є об'єктом, залишаємо його без змін
                parameterListItems = parameters;
            }
        }

        switch (type) {
            case "text":
                return `
                <div class="mb-1">
                    <label class="form-label" for="descInput_${system}_${type}">Підказка</label>
                    <input id="descInput_${system}_${type}" class="form-control" type="text" placeholder="Поясніть як користувачі можуть використовувати це поле" value="${description}">
                </div>`;
            case "date":
                return `
                <div class="mb-1">
                    <label class="form-label" for="descInput_${system}_${type}">Підказка</label>
                    <input id="descInput_${system}_${type}" class="form-control" type="text" placeholder="Поясніть як користувачі можуть використовувати це поле" value="${description}">
                </div>`;
            case "select":
                return `
                <div class="mb-1">
                    <label class="form-label" for="descInput_${system}_${type}">Підказка</label>
                    <input id="descInput_${system}_${type}" class="form-control" type="text" placeholder="Поясніть як користувачі можуть використовувати це поле" value="${description}">
                </div>

                <div class="js-validate-directorySelect text-danger mb-1 d-none">Оберіть довідник в полі</div>

                <div class="blockDataParam_${id}">
                <div id="directoryBlock_${id}" class="mb-1 ${model === null ? 'd-none' : ''}" >

                    <label class="form-label" for="directorySelect_${system}_${type}">Довідник</label>
                    <select id="directorySelect_${system}_${type}" class="select2 form-select" data-placeholder="Виберіть довідник для цього селекту">
                        <option value=""></option>
                        ${generateSelectOptions(dictionaryList)}
                    </select>
               <button id="parameterBtnShow_${id}" class="btn text-primary mt-1">
               Додати власні опції
                </button>
                </div>

                <div id="parameterBlock_${id}" class="mb-1 ${parameters === null ? 'd-none' : ''} ">
                <label class="form-label" for="inputParameter">Параметр</label>
                <div class="d-flex row mx-0" style="gap: 16px">
                    <div class="col-9 px-0">
                        <input id="inputParameter_${id}" class="form-control" type="text"
                               placeholder="Вкажіть параметр"/>
                    </div>

                    <button id="addItemParameter_${id}"
                            class="btn btn-outline-primary flex-grow-1 col-2 text-primary">
                        Додати
                    </button>
                </div>
                <ul class="parameter-list_${id} p-0 col-9">
                ${initParamBD(parameterListItems, id)}
                </ul>

                <button id="addItemInDirectory_${id}" class="btn text-primary">Додати довідник
                </button>

                </div>
                </div>
                `;

            case "label":
                return `
                <div class="mb-1">
                    <label class="form-label" for="descInput_${system}_${type}">Підказка</label>
                    <input id="descInput_${system}_${type}" class="form-control" type="text" placeholder="Поясніть як користувачі можуть використовувати це поле" value="${description}">
                </div>

                <div class="js-validate-directorySelect text-danger mb-1 d-none">Оберіть довідник в полі</div>

                <div class="mb-1">
                    <label class="form-label" for="directorySelect_${system}_${type}">Довідник</label>
                    <select  id="directorySelect_${system}_${type}" class="select2 form-select" data-placeholder="Виберіть довідник для цього селекту">
                        <option value=""></option>
                        ${generateSelectOptions(dictionaryList)}
                    </select>
                </div>`;
            default:
                return `<div class="d-none"></div>`;
        }
    }

    function generateSelectOptions(dictionaryList) {
        let options = "";
        for (let key in dictionaryList) {
            options += `<option value="${key}">${dictionaryList[key]}</option>`;
        }
        return options;
    }

    doctypeFields.forEach((field) => {
        const ulElement = field.system && field.key.startsWith("empty") ? ulElementSystemCustom : ulElements[field.type];
        const liElement = field.system && field.key.startsWith("empty") ?
            generateListItemCreateField(field) :
            generateListItem(field);

        ulElement.append(liElement);
    });

    $("#create-custom-btn").on("click", function () {
        const fieldTypes = ['text', 'range', 'select', 'label', 'date', 'dateRange', 'dateTime', 'dateTimeRange', 'timeRange', 'switch', 'uploadFile', 'comment'];

        for (const fieldType of fieldTypes) {
            //console.log(fieldType)
            const titleInput = $(`#additional-settings-field-type-${fieldType}-title`).val();
            // console.log(titleInput)

            const descInput = $(`#additional-settings-field-type-${fieldType}-desc`).val();
            //console.log(descInput)

            const key = fieldType + "_" + translit(titleInput);
            //console.log(key)

            let directory = null
            let data = parameterListItemsCustom;

            if (titleInput !== "") {
                let formData = new FormData();
                formData.append("_token", csrf);
                formData.append("key", key);
                formData.append("description", descInput);
                formData.append("title", titleInput);
                formData.append("type", fieldType);
                formData.append("system", 0);

                if (fieldType === "label") {
                    directory = $(`#additional-settings-field-type-${fieldType}-parameter`).val();
                    //console.log(directory)

                    // Додайте масив значень до formData
                    // formData.append(
                    //     "parameters", JSON.stringify(directory)
                    // );
                    formData.append(
                        "model", directory
                    );
                } else if (fieldType === "select") {
                    if ($("#parameterBlock").hasClass("d-none")) {
                        // If directoryBlock is hidden, read data from parameterBlock
                        // Example: Reading the parameter input data
                        // If directoryBlock is visible, read data from the select element
                        directory = $(`#additional-settings-field-type-${fieldType}-model`).val();
                        formData.append("model", directory);
                        // Add this parameter input data to formData or process as needed
                    } else {

                        formData.append("parameters", JSON.stringify(data))
                    }
                }


                fetch(window.location.origin + "/document-type/field", {
                    method: "POST",
                    body: formData,
                    processData: false,
                    contentType: false,
                });

                addCustomFieldToList(titleInput, descInput, fieldType, key, directory, data);
                $(`#additional-settings-field-type-${fieldType}-title`).val("");
                $(`#additional-settings-field-type-${fieldType}-desc`).val("");
                directory = $(`#additional-settings-field-type-${fieldType}-model`).val("").trigger("change");

                parameterList.empty()
                parameterListItemsCustom = [[
                    {
                        "name": "Параметр 1",
                        "is_checked": 1
                    }],
                    [{
                        "name": "Параметр 2",
                        "is_checked": 0
                    }]
                ];
                initParam(parameterListItemsCustom)
            }
        }

        $(".additional-settings, #create-custom-btn, #back-custom-btn").hide();
        $(".field-type-list, #next-custom-btn").show();
        $("#custom-modal-title").text("Виберіть новий тип поля");

        $("#customField").modal("hide");
        $(".modal-backdrop").remove();
        $("#directoryBlock").removeClass("d-none");
        $("#parameterBlock").addClass("d-none");


    });

    function makeDraggable(element, isList) {
        element.draggable({
            cursor: "move",
            cursorAt: {top: 56, left: 56},
            helper: "clone",
            revert: "invalid",
            connectWith: ".sortableList",
            clone: true,
            start: function (event, ui) {
                $("#trash").hide();
                $("#add-field").show();
                $(".sortableList").addClass("sortableList-over");

                if (!isList) {
                    var closeButton = ui.helper.find('.removeButtonBaseField');
                    if (closeButton.length > 0) {
                        closeButton.addClass("d-none");
                    }
                }
            },
            stop: function (event, ui) {
                $("#trash").hide();
                $("#add-field").show();
            },
            over: function (event, ui) {
                if (!isList) {
                    // Additional behavior specific to list items
                }
            },
        });
    }

    // Використання функції для налаштування перетягування групи та елемента li
    makeDraggable($("#add-field .group"), true);

    function makeDraggableLiElement(element, isSortableItem, additionalSettingsCustomFields = null) {
        element.draggable({
            connectToSortable: ".sortableList",
            cursor: "move",
            cursorAt: {top: 56, left: 56},
            distance: 10,
            revert: false,
            stop: function (event, ui) {
                if (ui.helper.closest(".sortableList").length > 0) {
                    ui.helper.removeClass("sortable-item");
                    if (isSortableItem) {
                        ui.helper.removeClass("sortable-item");
                        ui.helper.removeClass("group-create");

                        var group = ui.helper.find(".accordion-header");
                        if (group.length > 0) {
                            group.removeClass("group-create-padding");
                        }

                        var contentCreate = ui.helper.find("#contentCreate");
                        if (contentCreate.length > 0) {
                            contentCreate.removeClass("group-create-flex-center");
                        }

                        var titleElemCreate = ui.helper.find("#titleElemCreate");
                        if (titleElemCreate.length > 0) {
                            titleElemCreate.removeClass("group-create-flex");
                        }

                        var iconCreate = ui.helper.find("#iconCreate");
                        if (iconCreate.length > 0) {
                            iconCreate.removeClass("group-create-padding-end");
                        }
                    }

                    var headerBadge = ui.helper.find("#header-badge");
                    if (headerBadge.length > 0) {
                        headerBadge.removeClass("d-none");
                    }

                    var headerParameters = ui.helper.find(".removeButtonBaseField");
                    if (headerParameters.length > 0) {
                        headerParameters.removeClass("d-none");
                    }

                    var directorySelect_1_select = ui.helper.find('.select2');
                    var itemCurrentKey = ui.helper.find("[data-key]");
                    var dataCurrentKey = itemCurrentKey.data("key");

                    let requiredCheckInput = ui.helper.find(".js-form-check-input");
                    let requiredCheckLabel = ui.helper.find(".js-form-check-label");

                    doctypeFields.forEach((field) => {
                        //console.log(field)

                        if ((field.type.startsWith('select') || field.type.startsWith('label')) && field.key === dataCurrentKey) {
                            if (field.id === undefined) {
                                field.id = 1;
                            }

                            let id = `directorySelect_${field.system}_${field.type}_${field.id}_copy_${countIdItem}`;

                            if (lastIdSelect === id) {
                                countIdItem++;
                                id = `directorySelect_${field.system}_${field.type}_${field.id}_copy_${countIdItem}`;
                            } else {
                                countIdItem = 1;
                            }

                            directorySelect_1_select.attr('id', id);
                            lastIdSelect = id;

                            var labelParameters = isSortableItem ? field.model : additionalSettingsCustomFields.model;
                            if (labelParameters !== null) {
                                directorySelect_1_select.val(labelParameters).trigger("change");
                            }
                        }

                        if (field.type.startsWith(field.type) && field.key === dataCurrentKey) {
                            let idRequired = `requiredCheck_${field.system}_${field.type}_${field.id}_copy_${countIdItem}`;
                            if (lastIdRequired === idRequired) {
                                countIdItem++;
                                idRequired = `requiredCheck_${field.system}_${field.type}_${field.id}_copy_${countIdItem}`;
                            } else {
                                countIdItem = 1;
                            }
                            //console.log(idRequired)
                            requiredCheckInput.attr('id', idRequired);
                            requiredCheckLabel.attr('for', idRequired);
                            lastIdRequired = idRequired;
                        }
                    });
                    //console.log("_________________________________________-")
                    directorySelect_1_select.select2();
                    sortParam($(`[class^="parameter-list"]`), false)

                }
                $(".sortableList").removeClass("sortableList-over");
            },
        });
    }

    // Initialize draggable items for sortableList
    makeDraggableLiElement($(".sortable-item"), true);

    function addCustomFieldToList(title, desc, type, key, directory, param) {
        const additionalSettingsCustomFields = {
            title: title,
            description: desc,
            system: false,
            type: type,
            key: key,
        };

        if (directory !== null) {
            additionalSettingsCustomFields.model = directory;
            //console.log(directory)
        } else {
            additionalSettingsCustomFields.model = null;
        }

        if (param !== null) {
            additionalSettingsCustomFields.parameters = param;
            //console.log(directory)
        } else {
            additionalSettingsCustomFields.parameters = null;
        }

        doctypeFields.push(additionalSettingsCustomFields);
        const ulElement = ulElements[type];
        const liElement = generateListItem(additionalSettingsCustomFields);
        //console.log(liElement)

        ulElement.append(liElement);
        makeDraggable(liElement, false);
        makeDraggableLiElement(liElement, false, additionalSettingsCustomFields);
    }

    // Створюємо слухача подій для інпута 'titleInput_'
    $(".fields-list").on("input", '[id^="titleInput_"]', function () {
        // Отримуємо текст, введений користувачем в інпут
        const inputText = $(this).val();
        // Отримуємо батьківський елемент, який містить input
        const group = $(this).closest(".group");
        // Знайдемо елемент 'titleText' всередині блоку 'group' і змінимо його текст
        group.find('[id^="titleElem"] p.system-title').text(inputText);
        group.find("p.system-title").text(inputText);
        // Змінюємо атрибут 'value' для даного інпута
        $(this).attr("value", inputText);
    });

    function initializeSortable(selector) {
        $(selector).sortable({
            connectWith: selector,
            revert: false,
            cursor: "move",
            cursorAt: {top: 56, left: 56},
            distance: 10,
            placeholder: "sortable-placeholder",
            start: function (event, ui) {
                if (ui.item.hasClass("group")) {
                    $("#trash").show();
                    $("#add-field").hide();
                } else {
                    $("#trash").hide();
                    $("#add-field").show();
                }
                $(selector).addClass("sortableList-over");

                // // Перевірка, чи список порожній
                // if ($(".sortableList").children("li").length === 0) {
                //     // Додаємо псевдоелемент ::before до .sortableList-over
                //     $(".sortableList").addClass("empty-ul");
                //     $(".sortableList").html('<div class="sortableList-before">Хахахах</div>');
                // }

                var showBodyButton = ui.item.find('.js-chevron-configurator');
                if (showBodyButton.length > 0) {
                    showBodyButton.addClass("d-none")
                }

                var directorySelect_1_select = ui.item.find('.select2');
                if (directorySelect_1_select.length > 0) {
                    directorySelect_1_select.select2()
                }
            },
            stop: function (event, ui) {
                if (ui.item.hasClass("group")) {
                    $("#trash").hide();
                    $("#add-field").show();
                }
                $(selector).removeClass("sortableList-over");

                var showBodyButton = ui.item.find('.js-chevron-configurator');
                if (showBodyButton.length > 0) {
                    showBodyButton.removeClass("d-none")
                }

                sections.forEach(section => {
                    const $sortableList = $(`.sortableList#${section}_fields`);
                    const $checkbox = $(`#${section}_checked`);
                    const $defaultField = $(`#default_${section}_fields`);
                    if ($sortableList.children("li").length !== 0) {
                        $checkbox.prop('checked', true);
                        $defaultField.removeClass('d-none')
                    } else {
                        $checkbox.prop('checked', false);
                        $defaultField.addClass('d-none')
                    }
                });

            },
            over: function (event, ui) {
                if (ui.item.hasClass("sortable-item")) {
                    $("#trash").hide();
                    $("#add-field").show();
                }
            },
            out: function (event, ui) {
                if (ui.item.hasClass("sortable-item")) {
                    $("#trash").hide();
                    $("#add-field").show();
                }
            },
            update: function (event, ui) {
                // if ($(selector).children().length === 0) {
                //     $(selector).height(70);
                // }
            },
        });
    }

    initializeSortable(".sortableList");

    function makeDroppableTrash() {
        // Initialize droppable trash
        $("#trash").droppable({
            drop: function (event, ui) {
                ui.draggable.remove();
            },
        });
    }

    makeDroppableTrash()

    function handleAccordionClick($headers, $selectorClick, $bodies, selectorShowBody, $chevrons, findBody) {
        $headers.on("click", $selectorClick, function () {
            var $accordionBody = $(this).closest($bodies).find(findBody);
            selectorShowBody.not($accordionBody).removeClass("d-block").addClass("d-none");
            $accordionBody.toggleClass("d-none d-block");
            var $accordionChevron = $(this).find("#accordion-chevron");
            $chevrons.not($accordionChevron).removeClass("accordion-chevron-active");
            $accordionChevron.toggleClass("accordion-chevron-active");
        });
    }

    // Виклик функції для першого набору
    handleAccordionClick($(".fields-list"), ".group .accordion-header", ".group", $(".document-field-accordion-body"), $(".accordion-chevron-active"), ".document-field-accordion-body");

    // Виклик функції для другого набору
    handleAccordionClick($(".document-new-fields"), ".accordion-group-field .accordion-header-castom", ".accordion-group-field", $(".accordion-group-field-body"), $(".accordion-group-field-body"), ".accordion-group-field-body");

    $("body").on("click", '.group [id^="removeButton"]', function () {
        var dataKey = $(this).closest(".group").find(".system-title").attr("data-key");
        fetch(window.location.origin + "/document-type/field/" + dataKey, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrf,
                "Content-Type": "application/json",
            },
        });

        $(this).closest(".group").remove();
    });

    $("body").on("click", "input[type='checkbox']", function () {
        if ($(this).is(":checked")) {
            $(this).closest(".group").find("#field-badge-required.d-none").removeClass("d-none").addClass("ms-0");
        } else {
            $(this).closest(".group").find("#field-badge-required").addClass("d-none").removeClass("ms-0");
        }
    });

    // Custom field modal start
    $(function hideAdditionalSettingsAndButtons() {
        $(".additional-settings, #create-custom-btn, #back-custom-btn").hide();
    });

    $(function customModalCloseButton() {
        $("#custom-close-btn").on("click", function () {
            $(".additional-settings, #create-custom-btn").hide();
            $(".field-type-list, #next-custom-btn").show();
            $("#custom-modal-title").text("Виберіть новий тип поля");
        });
    });

    $(function addActiveType() {
        // Зберігаємо кнопку з id "next-custom-btn" у змінну
        var nextBtn = $("#next-custom-btn");

        // Додавання обробника подій для кожного елемента з класом "field-type"
        $(".field-type").click(function () {
            // Перевірка, чи вже містить елемент клас "active"
            if ($(this).hasClass("field-type-active")) {
                return;
            }
            // Забираємо клас "active" з інших елементів з класом "field-type"
            $(".field-type.field-type-active").removeClass("field-type-active");

            // Додаємо клас "active" до натиснутого елемента
            $(this).addClass("field-type-active");

            // Забираємо клас "disabled" з кнопки "next-custom-btn"
            nextBtn.removeClass("disabled");
        });
    });

    $(function showAdditionalSettings() {
        $("#next-custom-btn").on("click", function () {
            var activeLi = $("li.field-type-active");
            var activeLiTitle = $("li.field-type-active h5").text();
            //console.log(activeLiTitle)
            if (activeLi.length) {
                var activeLiId = activeLi.attr("id");
                $("#additional-settings-" + activeLiId + ", #create-custom-btn, #back-custom-btn").show();
                //console.log(activeLiId)
                $(".field-type-list, #next-custom-btn").hide();
                $("#custom-modal-title").text('Налаштуйте поле "' + activeLiTitle + '"');
            }
        });
    });

    $(function showFieldsTypesList() {
        $("#back-custom-btn").on("click", function () {
            var activeLi = $("li.field-type-active");
            if (activeLi.length) {
                var activeLiId = activeLi.attr("id");
                $("#additional-settings-" + activeLiId + ", #create-custom-btn, #back-custom-btn").hide();
                $(".field-type-list, #next-custom-btn").show();
                $("#custom-modal-title").text("Виберіть новий тип поля");
            }
        });
    });

    $("#accordion").accordion({
        header: ".accordion-header",
        collapsible: true,
        active: false,
        animate: 200,
    }).find(".dropdown-menu").on("mousedown", function (e) {
        $(".accordion-header").stopPropagation();
    }).end().sortable({
        items: "",
        stop: function (event, ui) {
            // IE doesn't register the blur when sorting
            // so trigger focusout handlers to remove .ui-state-focus
            ui.item.children("p").triggerHandler("focusout");

            // Refresh accordion to handle new order
            $(this).accordion("refresh");
        },
    });

    // Функція для обробки подій наведення курсора і відведення курсора
    function handleBlockHover(header, titleInput, titleH5, BtnDelete = null) {
        header.hover(
            function () {
                header.addClass("header-hover");
                titleInput.removeClass('d-none');
                titleH5.addClass('d-none');
                if (BtnDelete !== null) {
                    BtnDelete.removeClass('d-none');
                }
            },
            function () {
                var inputText = titleInput.val();
                titleInput.addClass('d-none');
                titleH5.removeClass('d-none').text(inputText);
                if (BtnDelete !== null) {
                    BtnDelete.addClass('d-none');
                }
                header.removeClass("header-hover");
            }
        );
    }

    handleBlockHover(header_default, titleInput_default, titleH5_default)

    $("#add-new-block-item").click(function () {
        click += 1;
        var inputValue = "Новий блок";
        let inputValueTranslit = translit(inputValue);
        let mathRandomValue = Math.floor(Math.random() * 100);

        // Створення нового блоку div з вказаним вмістом за допомогою шаблонних рядків
        var newDiv = $(`
        <div class="new-fields-custom-block">
            <div class="accordion-field-header align-items-center d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h4 class="m-0 header-block-title fw-bolder" data-id-input-value="custom_block-${click}">${inputValue}</h4>
                    <input type="text" class="m-0 fw-bolder w-100 header-block-title-input bg-transparent border-0 d-none" value="${inputValue}">
                </div>
                <button class="btn btn-flat-secondary p-25 d-none" id="delete-new-block-item">
                    <img src="/assets/icons/close-field-base.svg" alt="close-field-base">
                </button>
            </div>
            <ul class="sortableList" id="custom_block-${click}_fields"></ul>
        </div>`);

        // Вставка нового блоку після блоку кнопки
        $(".btn-add-new-block").after(newDiv);

        // Отримання елементів заголовка блоку
        var header = newDiv.find('.accordion-field-header');
        var titleInput = header.find('.header-block-title-input');
        var titleH5 = header.find('h4');
        var BtnDelete = header.find('#delete-new-block-item');

        // Виклик функції для обробки подій наведення курсора і відведення курсора
        handleBlockHover(header, titleInput, titleH5, BtnDelete);

        // Обробник події кліку на кнопку видалення
        BtnDelete.click(function () {
            newDiv.remove();
        });

        initializeSortable(newDiv.find(".sortableList"));

        // Ініціалізація draggable для нового блоку
        makeDraggableLiElement(newDiv.find(".sortable-item"), true)
    });

    // Обробка подій наведення курсора і відведення курсора для зарендерених блоків
    $('.new-fields-custom-block').each(function () {
        var renderEditDivCustomBlock = $(this);
        var header = renderEditDivCustomBlock.find('.accordion-field-header');
        var titleInput = header.find('.header-block-title-input');
        var titleH5 = header.find('h4');
        var BtnDelete = header.find('#delete-new-block-item');

        // Виклик функції для обробки подій наведення курсора і відведення курсора
        handleBlockHover(header, titleInput, titleH5, BtnDelete);

        // Обробник події кліку на кнопку видалення
        BtnDelete.click(function () {
            renderEditDivCustomBlock.remove();
        });
    });

    // Use event delegation to handle dynamic elements with multiple blocks
    $("body").on("click", '[id^="parameterBtnShow"]', function () {
        // Get the corresponding parameterBlock and directoryBlock based on the clicked button's ID
        const buttonId = $(this).attr('id');
        const idParts = buttonId.split('_'); // Split the button's ID
        const blockNumber = idParts[idParts.length - 1]; // Get the block number
        const parameterBlock = $(`#parameterBlock_${blockNumber}`);
        const directoryBlock = $(`#directoryBlock_${blockNumber}`);

        // Show parameterBlock and hide directoryBlock
        parameterBlock.removeClass('d-none');
        directoryBlock.addClass('d-none');
    });

    // Handle the click event for the "Добавить довідник" button
    $("body").on("click", '[id^="addItemInDirectory"]', function () {
        // Get the corresponding parameterBlock and directoryBlock based on the clicked button's ID
        const buttonId = $(this).attr('id');
        const idParts = buttonId.split('_'); // Split the button's ID
        const blockNumber = idParts[idParts.length - 1]; // Get the block number
        const parameterBlock = $(`#parameterBlock_${blockNumber}`);
        const directoryBlock = $(`#directoryBlock_${blockNumber}`);

        // Show directoryBlock and hide parameterBlock
        parameterBlock.addClass('d-none');
        directoryBlock.removeClass('d-none');
    });

    $("body").on("click", '[id^="parameterBtnShow"]', function () {
        const parameterBlock = $('[id^="parameterBlock"]');
        const directoryBlock = $('[id^="directoryBlock"]');
        parameterBlock.removeClass('d-none');
        directoryBlock.addClass('d-none');
        //console.log(parameterListItems);
    });

    $("body").on("click", '[id^="addItemInDirectory"]', function () {
        const parameterBlock = $('[id^="parameterBlock"]');
        const directoryBlock = $('[id^="directoryBlock"]');
        parameterBlock.addClass('d-none');
        directoryBlock.removeClass('d-none');

    });

    initParam(parameterListItemsCustom)

    addItemParameterButton.on('click', () => {
        const value = inputParameter.val().trim();
        if (value) {
            const checked = 0
            //console.log(checked)
            addParameterToList(value, checked, null);
            inputParameter.val('');

            parameterListItemsCustom.push([{'name': value, 'is_checked': 0}]);
            //console.log(parameterListItemsCustom)
        }
    });

    // Handle clicks on the "Добавити параметр" buttons with the common class
    $("body").on("click", '[id^="addItemParameter"]', function () {

        const buttonId = $(this).attr('id');
        const idParts = buttonId.split('_'); // Split the button's ID
        const blockNumber = idParts[idParts.length - 1]; // Get the block number
        // Extract the block number from the clicked button's class

        // Find the corresponding input element and checkbox
        const inputParameter = $(`#inputParameter_${blockNumber}`);

        const value = inputParameter.val().trim();
        if (value) {
            const checked = 0
            addParameterToList(value, checked, blockNumber);
            inputParameter.val('');
        }

        sortParam($(`.parameter-list_${blockNumber}`), false)
    });

    function sortParam(selector, custom = true) {
        // Ініціалізація sortable
        selector.sortable({
            distance: 10,
            update: function () {
                clearAndRepopulateParameterListItems(custom);
            }
        });
    }

    sortParam($(`.parameter-list`))

    sortParam($(`[class^="parameter-list"]`), false)

    // Функція для очищення масиву та запису даних заново з урахуванням нового порядку
    function clearAndRepopulateParameterListItems(custom) {
        if (custom === true) {
            parameterListItemsCustom.length = 0; // Очищення масиву
        }

        // Отримання елементів зі списку та запис їх в parameterListItems
        $('.parameter-list .parameter-item').each(function () {
            const value = $(this).attr('data-value');
            const checked = $(this).find('input[type="checkbox"]').prop('checked') ? 1 : 0;

            if (custom === true) {
                // Додавання до parameterListItems
                parameterListItemsCustom.push([{'name': value, 'is_checked': checked}]);
            }

        });
    }

    $('.parameter-list').on('click', '.removeButtonParemeters', function () {
        const parameterItem = $(this).closest('.parameter-item');
        const value = parameterItem.attr('data-value');
        const checked = parameterItem.find('input[type="radio"]').prop('checked');

        // Find and remove the element from parameterListItems
        for (let i = 0; i < parameterListItemsCustom.length; i++) {
            const group = parameterListItemsCustom[i];
            const index = group.findIndex(parameter => parameter.name === value);
            if (index !== -1) {
                group.splice(index, 1);
                if (group.length === 0) {
                    parameterListItemsCustom.splice(i, 1); // Remove the empty sub-array
                }
                break; // Exit the loop if the item is found and removed
            }
        }

        parameterItem.remove();

        if (checked) {
            // If the removed item was checked, find the next available item and set it as checked
            let nextItemChecked = false;
            for (const parameterGroup of parameterListItemsCustom) {
                for (const parameter of parameterGroup) {
                    const item = $(`.parameter-item[data-value="${parameter.name}"]`);
                    if (item.length > 0 && !nextItemChecked) {
                        item.find('input[type="radio"]').prop('checked', true);
                        item.find('.js-input-parameter').addClass('checked-js-input-parameter');
                        item.attr('data-checked', 1); // Update data-checked attribute
                        nextItemChecked = true;
                    } else if (item.length > 0) {
                        item.attr('data-checked', 0); // Update data-checked attribute for other items
                    }
                }
            }

            if (!nextItemChecked) {
                // If there are no more available items, find the first one and set it as checked
                for (const parameterGroup of parameterListItemsCustom) {
                    for (const parameter of parameterGroup) {
                        const item = $(`.parameter-item[data-value="${parameter.name}"]`);
                        if (item.length > 0) {
                            item.find('input[type="radio"]').prop('checked', true);
                            item.find('.js-input-parameter').addClass('checked-js-input-parameter');
                            item.attr('data-checked', 1); // Update data-checked attribute
                            break;
                        }
                    }
                }
            }
        }
    });

    // Додаємо обробку подій на батьківський контейнер "parameter-list_56"
    $("body").on('click', '[class^="removeButtonParemeters"]', function () {
        const parameterItem = $(this).closest('.parameter-item');
        const value = parameterItem.attr('data-value');
        const checked = parameterItem.find('input[type="radio"]').prop('checked');

        // Remove the element parameterItem
        parameterItem.remove();

        if (checked) {
            // If the removed item was checked, find the next available item and set it as checked
            let nextItemChecked = false;
            const parameterItems = $('[class^="parameter-list"] .parameter-item');
            parameterItems.each(function (index, item) {
                const dataValue = $(item).attr('data-value');
                const dataChecked = $(item).attr('data-checked');

                if (!nextItemChecked && dataValue !== value && dataChecked !== '1') {
                    $(item).find('input[type="radio"]').prop('checked', true);
                    $(item).find('.js-input-parameter').addClass('checked-js-input-parameter');
                    $(item).attr('data-checked', 1); // Update data-checked attribute
                    nextItemChecked = true;
                } else {
                    $(item).attr('data-checked', 0); // Update data-checked attribute for other items
                }
            });

            if (!nextItemChecked) {
                // If there are no more available items, find the first one and set it as checked
                const firstItem = parameterItems.first();
                firstItem.find('input[type="radio"]').prop('checked', true);
                firstItem.find('.js-input-parameter').addClass('checked-js-input-parameter');
                firstItem.attr('data-checked', 1); // Update data-checked attribute
            }
        }
    });

    $('.parameter-list').on('change', 'input[type="radio"]', function () {
        const parameterItem = $(this).closest('.parameter-item');
        const parameterList = parameterItem.closest('.parameter-list');
        const checkboxes = parameterList.find('input[type="radio"]');
        const value = parameterItem.data('value');
        const isChecked = $(this).prop('checked');

        if (!isChecked) {
            // If the clicked radio is being unchecked, no need to update the data-checked attribute.
            return;
        }

        // Uncheck other radio inputs in the same parameter list and update data-checked attribute
        parameterList.find('.parameter-item').not(parameterItem).each(function () {
            $(this).find('input[type="radio"]').prop('checked', false);
            $(this).attr('data-checked', 0);
        });

        parameterList.find('.js-input-parameter').removeClass('checked-js-input-parameter');

        // Add the 'checked-js-input-parameter' class to the current element
        parameterItem.find('.js-input-parameter').addClass('checked-js-input-parameter');

        // Update the data-checked attribute for the current element
        parameterItem.attr('data-checked', isChecked ? 1 : 0);

        for (const parameterGroup of parameterListItemsCustom) {
            for (const parameter of parameterGroup) {
                if (parameter.name === value) {
                    parameter.is_checked = isChecked ? 1 : 0;
                } else {
                    parameter.is_checked = 0;
                }
            }
        }
    });

    $("body").on('change', 'input[type="radio"]', function () {

        const parameterItem = $(this).closest('.parameter-item');
        const parameterList = parameterItem.closest("[class^='parameter-list']");
        const isChecked = $(this).prop('checked');

        if (!isChecked) {
            // If the clicked radio is being unchecked, no need to update the data-checked attribute.
            return;
        }

        // Uncheck other radio inputs in the same parameter list and update data-checked attribute
        parameterList.find('.parameter-item').not(parameterItem).each(function () {
            $(this).find('input[type="radio"]').prop('checked', false);
            $(this).attr('data-checked', 0);
        });

        parameterList.find('.js-input-parameter').removeClass('checked-js-input-parameter');

        // Add the 'checked-js-input-parameter' class to the current element
        parameterItem.find('.js-input-parameter').addClass('checked-js-input-parameter');

        // Update the data-checked attribute for the current element
        parameterItem.attr('data-checked', isChecked ? 1 : 0);

    });


    // Функція для обробки зміни стану чекбокса та відповідного поля
    function handleSectionCheckboxChange(section) {
        const $checkbox = $(`#${section}_checked`);
        const $field = $(`#default_${section}_fields`);

        $checkbox.on("change", function () {
            if (this.checked) {
                $field.removeClass('d-none');
            } else {
                $field.addClass('d-none');
            }
        });
    }

    // Виклик функції для кожної секції
    sections.forEach(section => {
        handleSectionCheckboxChange(section);
    });

});
