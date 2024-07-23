$(document).ready(function () {
    let workspace_img

    $(".workspace-avatar").click(function () {
        $(".workspace-avatar").removeClass("workspace-selected");
        $(this).addClass("workspace-selected");

        const avatarColor = $(this).css("background-color");
        $("#workspace-preview")
            .removeClass()
            .addClass("workspace-avatar")
            .addClass($(this).data("workspace-avatar"))
            .text($("#workspace-username").val().charAt(0).toUpperCase())
            .css("background-color", avatarColor);
    });

    $('#workspace-upload').on('change', function () {

        const size =
            (this.files[0].size / 1024 / 1024).toFixed(2);

        if (size > 0.8) {
            $("#company-upload1").val('');
            alert("Файл повинен мати розмір не більше 800kB");
        } else {
            workspace_img = $(this)[0].files[0]
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#workspace-upload-image').attr('src', e.target.result);
                    $('#workspace-upload-image').css('border', 'none')
                }

                reader.readAsDataURL(this.files[0]);
            }
        }
    })

    $("#workspace-username").on("input", function () {
        $("#workspace-preview").text($(this).val().charAt(0).toUpperCase());
    });

// Choose default or custom avatar
    $(".workspace-default-avatar").click(function () {
        $(".workspace-avatar").removeClass("workspace-selected");
        $(".workspace-default-avatar").addClass(
            "workspace-default-avatar-selected"
        );
    });

    $(".workspace-avatar").click(function () {
        $(".workspace-default-avatar").removeClass(
            "workspace-default-avatar-selected"
        );
    });
// Choose avatar end

// Tariff plan start
    $("#workspace-employee-quantity").on("input", function () {
        const inputVal = $(this).val();
        if (isNaN(inputVal)) {
            $(this).val("");
        } else {
            const outputVal = inputVal * 200;
            $(".total-price").text(outputVal + " $");
        }
    });

    $(".total-price-per-month").hide();
    $("#workspace-employee-quantity").on("input", function () {
        if ($("#workspace-employee-quantity").val()) {
            $(".total-price-per-month").show();
        } else {
            $(".total-price-per-month").hide();
        }
    });
// Tariff plan end

// Change background of checked checkboxes start
    $('input[type="checkbox"]').change(function () {
        if (this.checked) {
            $(this).parent().addClass("workspace-checked");
        } else {
            $(this).parent().removeClass("workspace-checked");
        }
    });


// Change background of checked checkboxes end

//Save data from create workspace form start
    $(function () {
        $("#workspace-form-next-btn").on("click", async function () {

            const link = window.location.href
            const segments = link.split("/");
            const company_id = segments[segments.length - 1];

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content)
            if (workspace_img) {
                formData.append('avatar', workspace_img)
            } else {
                formData.append('avatar_color', $('.workspace-selected').attr('data-value'))
            }
            const workspaceName = $("#workspace-username");
            formData.append("name", workspaceName.val());

            const warehouseCheckboxes = $(".workspace-row-wrapper").find(
                "input[type='checkbox']:checked"
            );
            let checkboxesArray = []
            warehouseCheckboxes.each(function () {
                checkboxesArray.push($(this).attr("name"))
            });

            formData.append('warehouse', JSON.stringify(checkboxesArray));

            const employeeCheckboxes = $(".workspace-employee-content-wrapper").find(
                "input[type='checkbox']:checked"
            );
            let employeeArray = []
            employeeCheckboxes.each(function () {
                employeeArray.push($(this).attr("name"))
            });
            formData.append('employees', JSON.stringify(employeeArray));

            const integrationCheckboxes = $(".workspace-integration-content-wrapper").find(
                "input[type='checkbox']:checked"
            );
            let integrationArray = []
            integrationCheckboxes.each(function () {
                integrationArray.push($(this).attr("name"))
            });
            formData.append('integration', JSON.stringify(integrationArray));

            const totalEmployeeQuantity = $("#workspace-employee-quantity");
            formData.append("employees_count", totalEmployeeQuantity.val());

            await fetch(window.location.origin + '/workspace/'+company_id, {
                method: 'POST',
                body: formData
            }).then(async function (res) {
                let response = await res.json()
                window.location.href = window.location.origin
            })
        });
    });
//Save data from create workspace form end

// Workspaces list start
//Show-hide dots at workspace-list
    $(function () {
        $(".dropstart").hide();
        $(".list-document-effect")
            .on("mouseenter", function () {
                $(".dropstart", this).show();
            })
            .on("mouseleave", function () {
                $(".dropstart", this).hide();
            });
    });
// Workspaces list end

// Workspace settings show-hide tab content start
    $(function () {
        $(".workspace-details").hide();
        $("#workspace-details-wrapper").click(function () {
            $(".workspace-tab").hide();
            $(".workspace-details").show();
        });
        $("#back-to-workspace-settings").click(function () {
            $(".workspace-details").hide();
            $(".workspace-tab").show();
        });
    });

    $('#condition_submit').on('click', function () {
        $('#create-workspace').addClass('d-none')
        $('#workspace').removeClass('d-none')
        $('#animation').modal('hide');
    })

    function createCompanyItem(name, edrpou, ipn, company_type_id, country, created_at, img_type, id, workspace) {
        // Створення елементів з вказаними параметрами
        const $item = $(`<button id="company-send-join" class="col-12 px-0 border onboarding-item-company mt-1 link-dark" style="border-radius: 6px; background-color: #fff"></button>`);
        const $row = $('<div class="row mx-0"></div>');
        const $colIcon = $('<div class="col-auto p-0"></div>');
        const $iconCompany = $(`<div class="" style="background-color: #A8AAAE14; width: 138px"><img style="border-radius: 6px 0 0 6px" width="138px" height="138px" src="uploads/company/image/${id}.${img_type}"></div>`);
        const $icon = $('<div class="p-2" style="background-color: #A8AAAE14; width: 138px"><img src="assets/icons/building-community.svg"></div>');

        const $colContent = $('<div class="col-9 py-1 flex-grow-1"></div>');
        const $nameRow = $('<div class="d-flex align-items-center" style="gap: 12px"></div>');
        const $name = $('<h4 class="fw-bolder mb-0 text-capitalize"></h4>').text(name);
        const $badgeNoAdmin = $('<span class="badge badge-light-primary">Без адміністратора</span>');

        //Ну в теорії в залежності від того чи є компанія в середовищі має мінятися badge
        const $badgeAdmin = $('<span class="badge badge-light-warning">Сторонній адміністратор</span>');

        const $edrpouRow = $('<div class="d-flex align-items-center mt-1" style="gap: 5px; font-size: 15px!important;"></div>');
        const $edrpouLabel = $('<p class="mb-0 fw-normal">ЄДРПОУ: </p>');
        const $edrpou = $('<p class="fw-bold mb-0"></p>').text(edrpou);

        const $ipnRow = $('<div class="d-flex align-items-center mt-1" style="gap: 5px; font-size: 15px!important;"></div>');
        const $ipnLabel = $('<p class="mb-0 fw-normal">ІПН: </p>');
        const $ipn = $('<p class="fw-bold mb-0"></p>').text(ipn);
        const $countryRow = $('<div class="d-flex align-items-center" style="gap: 5px; margin-top: 6px; font-size: 15px!important;"></div>');
        const $countryLabel = $('<p class="mb-0 fw-normal">Країна реєстрації:</p>');
        const $country = $('<p class="fw-bold mb-0"></p>').text(country);
        const $createdRow = $('<div class="d-flex align-items-center" style="gap: 5px; margin-top: 6px; font-size: 15px!important;"></div>');
        const $createdLabel = $('<p class="mb-0 fw-normal">Додана в CONSOLID:</p>');
        const $createdDate = $('<p class="fw-bold mb-0"></p>').text(created_at);
        const $createdByLabel = $('<p class="mb-0 fw-normal">компанією: </p>');
        const $createdBy = $('<p class="fw-bold mb-0"></p>').text('Гал. Авто світ');

        // Додавання елементів до DOM
        $item.append($row);
        $row.append($colIcon);
        if (img_type == null) {
            $colIcon.append($icon);
        } else {
            $colIcon.append($iconCompany);
        }
        $row.append($colContent);
        $colContent.append($nameRow);
        $nameRow.append($name, $badgeNoAdmin);
        if (company_type_id === 2) {

            $edrpouRow.append($edrpouLabel);
            $edrpouRow.append($edrpou);

        } else if (company_type_id === 1) {

            $ipnRow.append($ipnLabel);
            $ipnRow.append($ipn);
        }
        $nameRow.append($name);
        $nameRow.append($badgeNoAdmin);
        $countryRow.append($countryLabel);
        $countryRow.append($country);
        $createdRow.append($createdLabel);
        $createdRow.append($createdDate);
        $createdRow.append($createdByLabel);
        $createdRow.append($createdBy);
        $colContent.append($nameRow);
        if (company_type_id === 2) {
            $colContent.append($edrpouRow);
        } else if (company_type_id === 1) {
            $colContent.append($ipnRow);
        }
        $colContent.append($countryRow);
        $colContent.append($createdRow);
        $row.append($colIcon);
        $row.append($colContent);

        // Повернення створеного елементу
        return $item;
    }

})
