// Choose avatar start
$(document).ready(function () {
    let url = window.location.origin;
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    let workspaceImg;
    let avatar_color = workspace.avatar_color;

    $(".workspace-avatar").click(function () {
        $(".workspace-avatar").removeClass("workspace-selected");
        $(this).addClass("workspace-selected");

        const avatarColor = $(this).css("background-color");

        function componentToHex(c) {
            var hex = c.toString(16);
            return hex.length == 1 ? "0" + hex : hex;
        }

        function rgbToHex(r, g, b) {
            return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
        }

        let rgb = avatarColor.split(',');

        avatar_color = rgbToHex(parseInt(rgb[0].substring(4)), parseInt(rgb[1]), parseInt(rgb[2]));

        $("#workspace-preview")
            .removeClass()
            .addClass("workspace-avatar")
            .addClass($(this).data("workspace-avatar"))
            .text($("#workspace-username").val().charAt(0).toUpperCase())
            .css("background-color", avatarColor);
    });

    $('#avatar-input-container').click(function () {
        $('#workspace-file-input').click();
    });

    $('#workspace-file-input').change(function (e) {
        const size = (this.files[0].size / 1024 / 1024).toFixed(2);

        if (size > 0.8) {
            $(this).val('');
            alert("Файл повинен мати розмір не більше 800kB");
        } else {
            workspaceImg = $(this)[0].files[0];
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#workspace-avatar-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        }
    });

    $("#submit-workspace-detail").click(async function (e) {
        e.preventDefault();
        let formData = new FormData()
        formData.append('_method', 'PUT');
        formData.append('avatar', workspaceImg);
        formData.append('avatar_color', avatar_color);
        formData.append('name', $('#workspace-username').val());

        await fetch(url + `/workspace/${workspace.id}`, {
            method: 'POST',
            body: formData,
            headers: {
                "X-CSRF-Token": csrf
            },
        }).then(() => {
            location.reload();
        });
    });

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

    //workspace tariffs
    $(function submitWorkspaceTariffs() {
        $('#submit-workspace-tariff').click(async function (e) {
            e.preventDefault();

            let formData = new FormData()
            formData.append('_method', 'PUT');
            formData.append('employees_count', $('#workspace-employee-quantity').val());

            await fetch(url + `/workspace/${workspace.id}`, {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-Token": csrf
                },
            }).then(() => {
                location.reload();
            });
        })
    });

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

    // Workspace settings show-hide tab content
    $(function showHideWorkspaceDetails() {
        $(".workspace-details").hide();
        $("#workspace-details-wrapper").click(function (e) {
            e.preventDefault();
            $(".workspace-tab").hide();
            $(".workspace-details").show();
        });
        $(".back-to-workspace-settings").click(function () {
            $(".workspace-details").hide();
            $(".workspace-tab").show();
        });
    });

    $(function showHideIntegrations() {
        $(".workspace-integrations, .worspace-intergrations-company").hide();
        $("#workspace-integrations-button").click(function () {
            $(".workspace-tab").hide();
            $(".workspace-integrations").show();
        });
        $(".back-to-workspace-settings").click(function () {
            $(".workspace-integrations").hide();
            $(".workspace-tab").show();
        });

        // Workspace setting integrations show/hide company details
        $("#workspace-integrations-item-vchasno").click(function () {
            $(".workspace-integrations-list").hide();
            $(".worspace-intergrations-company").show();
        });
        $(".back-to-workspace-settings-list").click(function () {
            $(".worspace-intergrations-company").hide();
            $(".workspace-integrations-list").show();
        });
    });

    // Workspace-settings tariff plan
    $(function showHideTariffPlan() {
        $(".workspace-tariff").hide();
        $("#workspace-tariff-plan-wrapper").click(function () {
            $(".workspace-tab").hide();
            $(".workspace-tariff").show();
        });
        $(".back-to-workspace-settings").click(function () {
            $(".workspace-tariff").hide();
            $(".workspace-tab").show();
        });
    });

    // show api details API
    $(function () {
        $(".api-details").hide();
        $("#api-details-wrapper").click(function () {
            $(".workspace-tab").hide();
            $(".api-details").show();
        });
        $("#back-to-workspace-settings-2").click(function () {
            $(".api-details").hide();
            $(".workspace-tab").show();
        });
    });
    // show api keys details
    $(function () {
        $(".apiKeys-details").hide();
        $("#apiKeys-details-wrapper").click(function () {
            $(".api-details").hide();
            $(".apiKeys-details").show();
        });
        $("#back-to-api-details").click(function () {
            $(".apiKeys-details").hide();
            $(".api-details").show();
        });
    });

    // create new api key  /edit api/ example api

    // при створенні нового ключа приховано багато елементів та при виходженні в табмені ключів
    function defaultHideElApiKeyPage() {
        $(".edit-newApiKey__title").hide();
        $("#edit-newApiKey__input").hide();
        $("#btns-change-apiKey").hide();
        $(".edit-newApiKey-alert").hide();

        $(".create-newApiKey__title").show();
        $(".btn-create-newApiKeys").show();
        $(".create-newApiKey-alert").show();
        $(".input-name-apiKeys").val("");
    }

    // при переході на зміну або створення приховані, або показані елементи

    function defaultHideELChangeApiKeyPage() {
        $(".btn-create-newApiKeys").hide();
        $(".create-newApiKey-alert").hide();
        $(".create-newApiKey__title").hide();
        $(".edit-newApiKey-alert").hide();

        $("#btns-change-apiKey").show();
        $(".edit-newApiKey__title").show();
        $("#edit-newApiKey__input").show();
    }

    // return api keys details page
    function returnToApiKeysDetails() {
        $(".create-newApiKey").hide();
        $(".apiKeys-details").show();
        defaultHideElApiKeyPage();
    }

    //  clicks with api keys details
    $(function () {
        $(".create-newApiKey").hide();

        // open page create new api  CLICK
        $("#create-newApiKey-wrapper").click(function () {
            $(".apiKeys-details").hide();
            $(".create-newApiKey").show();
            defaultHideElApiKeyPage();
        });

        // create full new api key   CLICK
        $(".btn-create-newApiKeys").click(function () {
            defaultHideELChangeApiKeyPage();
            $(".edit-newApiKey-alert").show();
            setTimeout(function () {
                $(".edit-newApiKey-alert").hide();
            }, 4000);
        });

        // open  change api key  page  CLICK
        $(".btn-open-done-apiKeys").click(function () {
            const textNameKey =
                $(this).find(".textNameKey").prevObject[0].innerText;
            $(".input-name-apiKeys").val(textNameKey);

            $(".apiKeys-details").hide();
            $(".create-newApiKey").show();
            defaultHideELChangeApiKeyPage();
        });

        // back-to-apiKeys-details tabs CLICK
        $("#back-to-apiKeys-details").click(function () {
            returnToApiKeysDetails();
        });

        // розкоментувати потім при роботі з беком і додати
        //  до логіки переходу на сторінку, якщо все видалння,
        //   або збереження змін

        // $(".btn-remove-newApiKeys").click(function () {
        //     returnToApiKeysDetails()
        // });
        // $(".btn-edit-newApiKeys").click(function () {
        //     returnToApiKeysDetails()
        // });
    });
});

//  робота тостера при копіювальному інпуті
var userText = $("#copy-to-clipboard-input");
var btnCopy = $("#btn-copy"),
    isRtl = $("html").attr("data-textdirection") === "rtl";

// copy text on click
btnCopy.on("click", function () {
    userText.select();
    document.execCommand("copy");
    toastr["success"]("", "Ключ скопійовано!", {
        rtl: isRtl,
    });
});

$(document).ready(function () {
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
        $("#workspace-form-next-btn").on("click", function () {
            const formData = new FormData();

            const workspaceName = $("#workspace-username");
            formData.append("workspace-name", workspaceName.val());

            const checkboxes = $(".vertical-wizard").find(
                "input[type='checkbox']:checked"
            );
            checkboxes.each(function () {
                formData.append($(this).attr("id"), $(this).attr("name"));
            });

            const totalEmployeeQuantity = $("#workspace-employee-quantity");
            formData.append("employee-quantity", totalEmployeeQuantity.val());
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

    $('#condition_submit').on('click', function () {
        $('#create-workspace').addClass('d-none')
        $('#workspace').removeClass('d-none')
        $('#animation').modal('hide');
    })

    $('#back-create-new-company').on('click', function () {

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

    $('.user-approve').on('click', function () {
        $.ajax({
            url: '/workspace/approve',
            type: 'POST',
            data: {
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                user_id: $(this).data('user'),
                company_id: $(this).data('company')
            },
            success: function () {
                window.location.reload()
            }
        })

    });

    $('.user-unapprove').on('click', function () {
        $.ajax({
            url: '/workspace/unapprove',
            type: 'POST',
            data: {
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                user_id: $(this).data('user'),
                company_id: $(this).data('company')
            },
            success: function () {
                window.location.reload()
            }
        })
    });

})

$(function findListItemIntegration() {
    $("#find-integration").on("input", function () {
        const searchValue = $(this).val().toLowerCase();
        $(".workspace-integrations-items div").each(function () {
            const listItemText = $(this).find(".integration-title").text().toLowerCase();
            console.log(listItemText)
            if (listItemText.includes(searchValue)) {
                $('div', this).show();
            } else {
                $('div', this).hide();
            }
        });
    });
});

let url = window.location.origin;
let csrf = document.querySelector('meta[name="csrf-token"]').content;

$('*[id*=workspace-change-link-]').on('click', async function (e) {
    e.preventDefault();

    let id = $(this).data('id');

    await fetch(url + '/workspace/change-selected-workspace', {
        method: 'POST',
        body: JSON.stringify({
            _token: csrf,
            workspace_id: id
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    }).then(() => {
        document.location.href = url + `/`;
    });
})
