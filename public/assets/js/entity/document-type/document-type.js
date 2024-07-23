$(document).ready(function () {

    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    //Documents types start
    let items = [];
    const roles = ["admin", "storekeeper", "driver", "manager"];
    let numVisibleItems = 3;

    // знаходимо всі елементи з id, що починається з "active-layout-" додаємо до них обробник події click
    $("[id^=active-layout-]").click(function () {
        // знаходимо всі елементи з класом "active-layout" та "disable-layout"
        var $activeAndDisabledLayouts = $(".active-layout, .disable-layout");
        // видаляємо ці класи з усіх знайдених елементів
        $activeAndDisabledLayouts.removeClass("active-layout disable-layout");
        // додаємо класи до обраного елемента
        $(this).addClass("active-layout");
        $activeAndDisabledLayouts.not(this).addClass("disable-layout");
    });

    function updateActionUI() {
        let buttonTitle = $("#expand-btn-title");
        let chevronIcon = $("#chevron-icon");

        if (buttonTitle.text() === "Переглянути усі") {
            buttonTitle.text("Згорнути");
            chevronIcon.css("transform", "rotate(180deg)");
        } else {
            buttonTitle.text("Переглянути усі");
            chevronIcon.css("transform", "rotate(0deg)");
        }

        if ($("#myAccordion .accordion-item").length < 4) {
            $(".expand-btn").hide();
        }
    }

    function toggleHiddenItems() {
        let hiddenItems = $("#myAccordion .accordion-item").slice(numVisibleItems).toggle();
        updateActionUI();
    }

    $(".expand-btn").on("click", toggleHiddenItems);

    // Add all checked items to array
    $("#actionDoc input[type='checkbox']:checked").each(function () {
        let itemName = $(this).closest("div").attr("data-item-key");
        items.push(itemName);
    });

    // Add event listener for changes to checkbox inputs
    $("#actionDoc input[type='checkbox']").change(function () {
        let isChecked = $(this).is(":checked");
        let itemName = $(this).closest("div").attr("data-item-key");

        if (isChecked) {
            items.push(itemName);
        } else {
            let itemIndex = items.findIndex((item) => item === itemName);
            if (itemIndex > -1) {
                items.splice(itemIndex, 1);
            }
        }
        //console.log(items)
    });
    //console.log(items)

    $("#add-btn").on("click", function () {
        let isExpanded = $(".expand-btn").text() === "Згорнути";
        for (let i = 0; i < items.length; i++) {
            if (!$('div[data-accordion-key="' + items[i] + '"]').length) {
                let newItemName = $('label[data-key="' + items[i] + '"]').text();
                let display = "";
                // Check if less than 4 items and hide expand button
                if ($("#myAccordion")[0].childElementCount > 2) {
                    $(".expand-btn").show();
                    display = 'style="display: none"';
                }
                //console.log(display)
                const newItemHTML = `
                  <div ${display} class="accordion-item border-bottom-0" data-accordion-key="${items[i]}">
                    <h2 class="accordion-header d-flex" id="heading-${items[i]}">
                      <button class="accordion-button collapsed  ps-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${items[i]}" aria-expanded="false" aria-controls="collapse-${items[i]}">
                        <li class="me-1 ps-2" style="list-style: none;">
                          <img class="" src="/assets/icons/doctype-${items[i]}.svg">
                        </li>
                        <span class="accordion-list-item-title">${newItemName}<br/>
                        <div class="accordion-list-item-text">
                          <span>Дозволено автоматично:</span>
                          <span id="edit_roles">адміністратор, комірник, водій</span>
                        </div>
                      </button>
                      <li class="delete-btn d-flex justify-content-center align-items-center pe-2" style="list-style: none;">
                        <img class="pe-1" src="/assets/icons/vertical-divider.svg">
                        <a><img src="/assets/icons/trash.svg"></a>
                      </li>
                    </h2>
                    <div id="collapse-${items[i]}" class="accordion-collapse collapse" aria-labelledby="heading-${items[i]}" data-bs-parent="#myAccordion">
                      <div class="accordion-body ps-2 py-2 gap-2 d-flex flex-column">
                        <div class="form-check form-switch d-flex align-items-center">
                          <input type="checkbox" class="form-check-input" id="admin_${items[i]}" checked>
                          <label class="form-check-label ps-75 fw-bold">Адміністратор</label>
                        </div>
                        <div class="form-check form-switch d-flex align-items-center">
                          <input type="checkbox" class="form-check-input" id="storekeeper_${items[i]}" checked>
                          <label class="form-check-label ps-75 fw-bold">Комірник</label>
                        </div>
                        <div class="form-check form-switch d-flex align-items-center">
                          <input type="checkbox" class="form-check-input" id="driver_${items[i]}" checked>
                          <label class="form-check-label ps-75 fw-bold">Водій</label>
                        </div>
                        <div class="form-check form-switch d-flex align-items-center">
                          <input type="checkbox" class="form-check-input" id="manager_${items[i]}">
                          <label class="form-check-label ps-75 fw-bold">Менеджер</label>
                        </div>
                      </div>
                    </div>
                  </div>
                `;

                $("#myAccordion").append(newItemHTML);
                $(".delete-btn").show();
            }
        }

        if (isExpanded) {
            $(".accordion-item").show();
        }

        $("#exampleModalCenter").modal("hide");
        $(".modal-backdrop").remove();
    });

    // Delete added items from list
    function deleteAccordionItem(itemKey) {
        items = items.filter((items) => items !== itemKey);
        $('div[data-item-key="' + itemKey + '"]')
            .find('input[type="checkbox"]')
            .prop("checked", false);
        $('[data-accordion-key="' + itemKey + '"]').remove();

        if ($("#myAccordion .accordion-item:visible").last().index() < numVisibleItems) {
            $("#myAccordion .accordion-item:hidden").first().show();
        }

        updateActionUI();
    }

    $("#myAccordion").on("click", ".delete-btn", function () {
        let itemKey = $(this).closest(".accordion-item").data("accordion-key");
        deleteAccordionItem(itemKey);
        updateActionUI();
    });

    $("body").on("click", ".delete-btn", function () {
        let itemKey = $(this).closest(".accordion-item").data("accordion-key");
        deleteAccordionItem(itemKey);
        updateActionUI();
    });

    // Універсальний пошук
    function findListItem(inputElement, containerSelector, itemSelectorFunction) {
        $(inputElement).on("input", function () {
            const searchValue = $(this).val().toLowerCase();
            console.log(searchValue);
            $(containerSelector).each(function () {
                const listItemText = itemSelectorFunction($(this));
                console.log(listItemText);
                if (listItemText.includes(searchValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    }

    findListItem("#searchBarItem", "#actionDoc div", function (element) {
        return element.find("label").text().toLowerCase();
    });
    findListItem("#searchCreateFields", ".document-new-fields ul li", function (element) {
        return element.find("div.accordion-header div p").text().trim().toLowerCase();
    });
    findListItem("#searchBarItemModal", "#modalFieldTypeList li", function (element) {
        return element.find("h5").text().toLowerCase();
    });

    function getSettings() {
        let field_blocks = ["header", "nomenclature", "container", "services"];
        let field_blocks_custom_header = [];
        console.log(field_blocks_custom_header);
        let field_names = [];
        let settings = {};

        // Зчитування значень з блоків та заповнення масиву
        $(".new-fields-custom-block").each(function () {
            let value = $(this).find(".header-block-title");
            field_blocks_custom_header.push(
                String(value.attr("data-id-input-value"))
            );
            field_names.push(value.html());
        });

        settings["print_form"] = $("#document-type-print-form").val();
        settings["document_kind"] = $("#document-kind").val();

        settings["layout"] = $(".active-layout").data("value");
        if ($("#customSwitchDocument").is(":checked")) {
            settings["document_type"] = $("#document-type").val();
        } else {
            settings["document_type"] = [];
        }


        settings["actions"] = {};

        for (let j = 0; j < items.length; j++) {
            settings["actions"][items[j]] = {};
            for (let i = 0; i < roles.length; i++) {
                settings["actions"][items[j]][roles[i]] = $(
                    "#" + roles[i] + "_" + items[j]
                )[0].checked;
            }
        }
        console.log(settings["actions"])
        settings["fields"] = {};

        settings["header_name"] = $("#accordion-field-title").text();
        field_blocks.forEach((item) => {
            if (
                item == "header" ||
                $("#" + item + "_checked")[0].checked == true
            ) {
                // Reset field_id to 1 for specific blocks
                if (item === "nomenclature" || item === "container" || item === "services") {
                    field_id = 1;
                }

                let list = $("#" + item + "_fields").children();
                //console.log(list)
                settings["fields"][item] = getSettingsArray(list);
            }
        });

        settings["custom_blocks"] = {};
        settings["block_names"] = [];
        for (let i = 0; i < field_blocks_custom_header.length; i++) {
            let list = $(
                "#" + field_blocks_custom_header[i] + "_fields"
            ).children();
            settings["custom_blocks"][i] = getSettingsArray(list);
            settings["block_names"].push(field_names[i]);
        }

        return settings;
    }

    function sendRequest(url) {
        let settings = getSettings();
        console.log(settings);
        if (settings) {
            let formData = new FormData();
            formData.append("_token", csrf);
            formData.append("name", $("#document-type-name").val());
            formData.append("settings", JSON.stringify(settings));
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    window.location.href =
                        window.location.origin + "/document-type/";
                },
                error: function (error) {
                    $("#document-type-name-error").removeClass('d-none').text("Поле назва типу документу є обов'язковим для заповнення")
                },
            });
        }
    }

    $("#draft-save").on("click", function () {
        sendRequest(window.location.origin + "/document-type/draft");
    });

    $("#doctype-save").on("click", function () {
        // Check if doctype select was filled
        if ($("#customSwitchDocument")[0].checked) {
            if ($("#document-type").val() == "") {
                console.log($("#document-type").val());
                $("#document-type-switch").removeClass('d-none')
                return;
            }
        }

        // Check if blocks "Name" were filled
        const $inputs = $('.sortableList input[id*="titleInput"]');
        let isEmpty = false;
        $inputs.each(function () {
            if ($(this).val() === "") {
                isEmpty = true;
                return false;
            }
        });

        if (isEmpty) {
            $(".js-validate-titleInput").removeClass('d-none')
            return;
        }

        // Check if blocks "dictionary" were filled
        const $selects = $('.sortableList select[id*="directorySelect"]');
        let isSelectEmpty = false;
        $selects.each(function () {
            if ($(this).children('option:first-child').is(':selected')) {
                isSelectEmpty = true;
                return false;
            }
        });

        if (isSelectEmpty) {
            $(".js-validate-directorySelect").removeClass('d-none')
            return;
        }

        sendRequest(window.location.origin + "/document-type");
    });

    function sendEditRequest(url) {
        let settings = getSettings();
        console.log(settings);
        if (settings) {
            const currentUrl = window.location.href;
            const pattern = /\/(\d+)\/edit/;
            const matches = currentUrl.match(pattern);

            const number = matches[1];
            let formData = new FormData()
            formData.append('_token', csrf)
            formData.append('_method', 'PUT')
            formData.append('name', $('#document-type-name').val())
            formData.append('settings', JSON.stringify(settings))
            $.ajax({
                url: url + number,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    window.location.href = window.location.origin + '/document-type/';
                },
                error: function (error) {
                    alert(error.responseJSON.message);
                }
            });
        }
    }

    $('#draft-edit').on('click', function () {
        sendEditRequest(window.location.origin + '/document-type/draft/')
    })

    $('#doctype-edit').on('click', function () {
        // Check if doctype select was filled
        if ($("#customSwitchDocument")[0].checked) {
            if ($("#document-type").val() == "") {
                //console.log($("#document-type").val());
                $("#document-type-switch").removeClass('d-none')
                return;
            }
        }

        // Check if blocks "dictionary" were filled
        const $inputsEditing = $('.sortableList input[id*="titleInput"]');
        let isEmpty = false;
        $inputsEditing.each(function () {
            if ($(this).val() === "") {
                isEmpty = true;
                return false;
            }
        });

        if (isEmpty) {
            $(".js-validate-titleInput").removeClass('d-none')
            return;
        }

        // Check if blocks "dictionary" were filled
        const $selectsEditing = $('.sortableList select[id*="directorySelect"]');
        let isSelectEmpty = false;
        $selectsEditing.each(function () {
            if ($(this).children('option:first-child').is(':selected')) {
                isSelectEmpty = true;
                return false;
            }
        });

        if (isSelectEmpty) {
            $(".js-validate-directorySelect").removeClass('d-none')
            return;
        }

        sendEditRequest(window.location.origin + '/document-type/')
    })
    let field_id = 1;

    function getSettingsArray(list) {
        const settingsArray = {};

        for (let i = 0; i < list.length; i++) {
            const li = list.eq(i);
            const type = li.find(".accordion-header").data("type");
            const system = li.data("system");
            const title = li.find("#titleInput_" + system + "_" + type).val();
            const hint = li.find("#descInput_" + system + "_" + type).val() || "";
            const required = li.find('[id^="requiredCheck_"]').prop("checked");


            //console.log(type, system)
            const settings = {
                id: field_id,
                name: title,
                type: type,
                required: required,
                hint: hint
            };

            if (type === "select" || type === "label") {
                const directorySelect = li.find('[id^="directorySelect"]');
                const directoryBlock = li.find('[id^="directoryBlock"]');
                const selectedValue = $(directorySelect).val() || "";
                if (directoryBlock.hasClass("d-none")) {
                    const parameterList = li.find('[class^="parameter-list"]' + " .parameter-item");
                    const parameterData = [];
                    parameterList.each(function () {
                        const parameterItem = $(this);
                        const parameterName = parameterItem.data("value");
                        const is_checked = parameterItem.data("checked");
                        parameterData.push([{
                            name: `${parameterName}`,
                            is_checked: is_checked,
                        }]);
                    });
                    settings.data = parameterData;
                    //Виправити на null або прибрати
                    settings.directory = null;
                } else {

                    settings.directory = selectedValue;
                    settings.data = null;
                }
            }
            settingsArray[field_id + li.find("[data-key]").data("key") + "_" + field_id] = settings;
            field_id++;
        }

        return settingsArray;
    }

    // Document preview start
    function getSettingsForPreview() {
        let field_blocks = ["header", "nomenclature", "container", "services"];
        let field_blocks_custom_header = [];
        let field_names = [];
        let settings = {};

        $(".new-fields-custom-block").each(function () {
            let value = $(this).find(".header-block-title");
            field_blocks_custom_header.push(
                String(value.attr("data-id-input-value"))
            );
            field_names.push(value.html());
        });

        settings["print_form"] = $("#document-type-print-form").val();

        settings["layout"] = $(".active-layout").data("value");

        settings["actions"] = {};
        for (let j = 0; j < items.length; j++) {
            settings["actions"][items[j]] = {};
            for (let i = 0; i < roles.length; i++) {
                settings["actions"][items[j]][roles[i]] = $(
                    "#" + roles[i] + "_" + items[j]
                )[0].checked;
            }
        }

        settings["fields"] = {};

        settings["header_name"] = $("#accordion-field-title").text();
        field_blocks.forEach((item) => {
            if (
                item == "header" ||
                $("#" + item + "_checked")[0].checked == true
            ) {
                let list = $("#" + item + "_fields").children();
                settings["fields"][item] = getSettingsArray(list);
            }
        });

        settings["custom_blocks"] = {};
        settings["block_names"] = [];
        for (let i = 0; i < field_blocks_custom_header.length; i++) {
            let list = $(
                "#" + field_blocks_custom_header[i] + "_fields"
            ).children();
            settings["custom_blocks"][i] = getSettingsArray(list);
            settings["block_names"].push(field_names[i]);
        }
        return settings;
    }

    // Show data in preview
    $("#document-preview-button").click(function () {
        localStorage.removeItem("settings");
        const settingsPreview = getSettingsForPreview();
        const settingsObj = JSON.stringify(settingsPreview);
        localStorage.setItem("settings", settingsObj);
        const mainData = JSON.parse(localStorage.getItem("settings"));
        console.log(mainData)
        // Check if blocks were added to "Header" and "Nomenclature" fields
        if (
            Object.keys(mainData.fields.header).length === 0
        ) {
            $("#document-type-empty-header-error").removeClass('d-none')
            $("#preview-modal-large").on("hidden.bs.modal", function () {
            });
        } else {
            // Show/hide container and services tables in preview
            if (!mainData.fields.hasOwnProperty("nomenclature")) {
                $("#nomenclature-tab-preview, #nomenclature-tab-preview2").hide();
            } else {
                $("#nomenclature-tab-preview, #nomenclature-tab-preview2").show();
            }
            // Show/hide container and services tables in preview
            if (!mainData.fields.hasOwnProperty("container")) {
                $("#container-tab-preview, #container-tab-preview2").hide();
            } else {
                $("#container-tab-preview, #container-tab-preview2").show();
            }

            if (!mainData.fields.hasOwnProperty("services")) {
                $("#services-tab-preview, #services-tab-preview2").hide();
            } else {
                $("#services-tab-preview, #services-tab-preview2").show();
            }

            // Перевірка, якщо все відсутнє
            if (!mainData.fields.hasOwnProperty("nomenclature") && !mainData.fields.hasOwnProperty("container") && !mainData.fields.hasOwnProperty("services")) {
                $("#tabs-preview").hide();
                $("#tabs-preview2").hide();
            } else {
                $("#tabs-preview").show();
                $("#tabs-preview2").show();
            }

            // Show preview if fields were added
            $("#preview-modal-large").modal("show");
            const keys = Object.values(mainData.fields.header);

            if (
                $("#active-layout-1").hasClass("active-layout") ||
                $("#active-layout-4").hasClass("active-layout")
            ) {
                // Added header block data to preview - layout 1, 4
                $(".document-preview-main-data-title").append(`
                        <h4 class='mb-50 mt-1 px-1 fw-bolder'>
                            ${mainData.header_name}
                        </h4>
                        `);

                for (let i = 0; i < keys.length; i++) {
                    const columnId = i % 2 === 0 ? "document-preview-main-data" : "document-preview-main-data2";
                    const column = $("." + columnId);

                    column.append(`
                                <div class='row mx-0 d-flex flex-wrap'>
                                 <p class="col-12 col-md-6 col-lg-6">${keys[i]["name"]}</p>
                                 <p class="col-12 col-md-6 col-lg-6 fw-bolder">Приклад тексту</p>
                                </div>
                            `);
                }

                // Added custom blocks data to preview - layout 1, 4
                for (let i = 0; i < mainData.block_names.length; i++) {
                    const blockName = mainData.block_names[i];
                    const blockData = mainData.custom_blocks[i];

                    $(".custom-blocks").append(`
                    <hr>
                    <h4 class='mb-50 mt-1 px-1 fw-bolder'>
                        ${blockName}
                    </h4>
                    <div class="0 d-flex row mx-0 flex-wrap">
                        ${Object.values(blockData).map(field => `
                            <div class="col-12 col-md-12 col-lg-6 px-0 1">
                                <div class="row mx-0 d-flex flex-wrap">
                                    <p class="col-12 col-md-6 col-lg-6">${field.name}</p>
                                    <p class="col-12 col-md-6 col-lg-6 fw-bolder">Приклад тексту</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                `);
                }

            } else {
                // Added header block data to preview - layout 2, 3
                $(".document-preview-header-layout-2").append(`
                    <h4 class='mb-50 mt-1 px-1 fw-bolder'>${mainData.header_name}</h4>
                `);

                for (let i = 0; i < keys.length; i++) {
                    $(".document-preview-header-layout-2").append(`
                                <div class='row mx-0 d-flex flex-wrap'>
                                 <p class="col-12 col-md-6 col-lg-6">${keys[i]["name"]}</p>
                                 <p class="col-12 col-md-6 col-lg-6 fw-bolder">Приклад тексту</p>
                                </div>
                     `);
                }

                // Added custom blocks data to preview - layout 2, 3
                for (let i = 0; i < mainData.block_names.length; i++) {
                    const blockName = mainData.block_names[i];
                    const blockData = mainData.custom_blocks[i];

                    $(".document-preview-header-layout-2").append(`
                        <hr>
                        <h4 class='pb-1 mx-1'>${blockName}</h4>
                    `);

                    Object.values(blockData).forEach(field => {
                        $(".document-preview-header-layout-2").append(`
                                <div class="row mx-0 d-flex flex-wrap">
                                    <p class="col-12 col-md-6 col-lg-6">${field.name}</p>
                                    <p class="col-12 col-md-6 col-lg-6 fw-bolder">Приклад тексту</p>
                                </div>
                                `);
                    });
                }
            }
        }
    });

    // Delete all elememts from main data when modal is closed
    const previewModal = $("#preview-modal-large");
    previewModal.on("hidden.bs.modal", function () {
        $(".document-preview-main-data, .document-preview-main-data2, .document-preview-header-layout-2, .custom-blocks, .document-preview-main-data-title").empty();
    });

    // Change modal preview layout
    //console.log($(".active-layout"))
    const mainDataActionsContainer = $("#maindata-actions");
    const previewLayout = $(".preview-layout");
    const previewLayout2 = $(".preview-layout2");
    $(".layout-selector").click(function () {
        const layout = $(this).data("layout");
        switch (layout) {
            case "layout-1":
                mainDataActionsContainer.css("flex-direction", "row");
                previewLayout2.css("display", "none");
                previewLayout.css("display", "flex");
                break;
            case "layout-2":
                previewLayout2.css("flex-direction", "row");
                previewLayout2.css("display", "flex");
                previewLayout.css("display", "none");
                break;
            case "layout-3":
                previewLayout2.css("flex-direction", "row-reverse");
                previewLayout2.css("display", "flex");
                previewLayout.css("display", "none");
                break;
            case "layout-4":
                mainDataActionsContainer.css(
                    "flex-direction",
                    "row-reverse"
                );
                previewLayout2.css("display", "none");
                previewLayout.css("display", "flex");
                break;
        }
    });

    // Show main data block in edit document 2-3 layout
    const activeLayout = $(".active-layout").attr('id');
    switch (activeLayout) {
        case "active-layout-1":
            mainDataActionsContainer.css("flex-direction", "row");
            previewLayout2.css("display", "none");
            previewLayout.css("display", "flex");
            break;
        case "active-layout-2":
            previewLayout2.css("flex-direction", "row");
            previewLayout2.css("display", "flex");
            previewLayout.css("display", "none");
            break;
        case "active-layout-3":
            previewLayout2.css("flex-direction", "row-reverse");
            previewLayout2.css("display", "flex");
            previewLayout.css("display", "none");
            break;
        case "active-layout-4":
            mainDataActionsContainer.css(
                "flex-direction",
                "row-reverse"
            );
            previewLayout2.css("display", "none");
            previewLayout.css("display", "flex");
            break;
    }

});
// Document preview end
