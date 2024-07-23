$(document).ready(function () {
    let url = window.location.origin;
    let csrf = document.querySelector('meta[name="csrf-token"]').content;
    //Перемикання між сторінками
    const $blocks = $(
        "#personal-info-user, #find-company, #create-company, #create-workspace, #send-join"
    );


    $("#back-to-find-company").click(function () {
        $("#listFindCompany").addClass("d-none");
        $("#onbording-link-proposition").addClass("d-none");
        $("#notFoundCompany").addClass("d-none");
        $("#back-to-find-company").addClass("d-none");

        $("#findCompany").removeClass("d-none");
        $("#searchCompanyResult").removeClass("d-none");
    });

    $(document).on("click", "#company-send-join", function () {

        $blocks.addClass("d-none");
        $("#send-join").removeClass("d-none");
        $("#send-request").attr("company_id", $(this).attr("company_id"));

        $("#request-company-card").attr("company-id", $(this).attr("company-id"))
        $("#request-company-card")[0].innerHTML = $(this)[0].innerHTML;

    });

    $("#back-find-company-2").click(function () {
        $("#send-join").addClass("d-none");
        $("#find-company").removeClass("d-none");
    });

    // Створення елементу компанії

    //Пошук компанії
    $("#searchCompanyButton").click(function () {
        const titleCountryFull = $(
            ".inpSelectCountry .iti__selected-flag"
        ).attr("title");
        let countryTitle = titleCountryFull
            .match(/^([\w\s]+?)(?=\s*[(:])/)[0]
            .trim();
        // console.log("country: ", countryTitle); назва вибраної країни
        if (countryTitle === "Ukraine"){
            countryTitle = 'Україна'
        }

        const searchTerm = $("#searchCompanyInpCountry").val(); // get the search term and convert to lowercase
        let endpoint = `/company/find?query=${searchTerm}&country=${countryTitle}`;
        let requestUrl = url + endpoint;

        fetch(requestUrl)
            .then((response) => response.json())
            .then(({data}) => {
                const list = document.getElementById("listItemCompany");
                list.innerHTML = "";
                let generatedCount = 0;
                data.forEach((item) => {
                    const edrpou = item.edrpou ? "" + item.edrpou : "";
                    const ipn = item.ipn ? "" + item.ipn : "";
                    const country = countryTitle;

                    const searchFields =
                        item.company_type_id === 1
                            ? [
                                item.first_name,
                                edrpou,
                                ipn,
                                country,
                            ]
                            : [item.name, edrpou, ipn, country];

                    if (searchTerm.trim()) {
                        const $companyItem = createCompanyItem(
                            item.company_type_id === 1 ?
                                `${item.surname} ${item.first_name}` :
                                item.name,
                            item.edrpou,
                            item.ipn,
                            item.company_type_id,
                            item.country ? "" + item.country : "Україна",
                            item.created_at,
                            item.img_type,
                            item.id,
                            item.creator_id
                        );
                        list.appendChild($companyItem[0]);
                        $("#searchCompanyResult").addClass("d-none");
                        $("#listFindCompany").removeClass("d-none");
                        $("#onbording-link-proposition").removeClass("d-none");
                        $("#back-to-find-company").removeClass("d-none");

                        generatedCount++;
                        const resultText =
                            generatedCount === 1
                                ? "результат"
                                : generatedCount >= 2 && generatedCount <= 4
                                    ? "результата"
                                    : "результатів";
                        $("#countCompanyItem").text(
                            `Найдено ${generatedCount} ${resultText}`
                        );
                    }
                });
            })
            .catch((error) => {
                console.error(error);
                $("#searchCompanyResult").removeClass("d-none");
                $("#notFoundCompany").removeClass("d-none");
                $("#create-new-company").removeClass("d-none");
                $("#findCompany").addClass("d-none");
                $("#listFindCompany").addClass("d-none");
                $("#onbording-link-proposition").addClass("d-none");
                $("#back-to-find-company").removeClass("d-none");
            });
    });

    function createCompanyItem(
        name,
        edrpou,
        ipn,
        company_type_id,
        country,
        created_at,
        img_type,
        id,
        workspace
    ) {
        // Створення елементів з вказаними параметрами
        const $item = $(
            '<button id="company-send-join" company-id="' +
            id +
            '" class="col-12 px-0 border onboarding-item-company mt-1 link-dark" style="border-radius: 6px; background-color: #fff"></button>'
        );
        const $row = $('<div class="row mx-0"></div>');
        const $colIcon = $('<div class="col-auto p-0"></div>');

        const $iconCompany = $(`<div class="" style="background-color: #A8AAAE14; width: 138px"><img style="border-radius: 6px 0 0 6px" width="138px" height="138px" src="${window.location.origin}/uploads/company/image/${id}.${img_type}"></div>`);
        const $icon = $(`<div class="p-2" style="background-color: #A8AAAE14; width: 138px"><img src="${window.location.origin}/assets/icons/building-community.svg"></div>`);

        const $colContent = $('<div class="col-9 py-1 flex-grow-1"></div>');
        const $nameRow = $(
            '<div class="d-flex align-items-center" style="gap: 12px"></div>'
        );
        const $name = $('<h4 class="fw-bolder mb-0 text-capitalize"></h4>').text(name);

        let $badgeNoAdmin

        if (workspace === null) {
            $badgeNoAdmin = $('<span class="badge badge-light-primary">Без адміністратора</span>');
        } else {
            $badgeNoAdmin = $('<span class="badge badge-light-warning">Сторонній адміністратор</span>');
        }

        const $edrpouRow = $(
            '<div class="d-flex align-items-center mt-1" style="gap: 5px; font-size: 15px!important;"></div>'
        );
        const $edrpouLabel = $('<p class="mb-0 fw-normal">ЄДРПОУ: </p>');
        const $edrpou = $('<p class="fw-bold mb-0"></p>').text(edrpou);

        const $ipnRow = $(
            '<div class="d-flex align-items-center mt-1" style="gap: 5px; font-size: 15px!important;"></div>'
        );
        const $ipnLabel = $('<p class="mb-0 fw-normal">ІПН: </p>');
        const $ipn = $('<p class="fw-bold mb-0"></p>').text(ipn);
        const $countryRow = $(
            '<div class="d-flex align-items-center" style="gap: 5px; margin-top: 6px; font-size: 15px!important;"></div>'
        );
        const $countryLabel = $(
            '<p class="mb-0 fw-normal">Країна реєстрації:</p>'
        );
        const $country = $('<p class="fw-bold mb-0"></p>').text(country);
        const $createdRow = $(
            '<div class="d-flex align-items-center" style="gap: 5px; margin-top: 6px; font-size: 15px!important;"></div>'
        );
        const $createdLabel = $(
            '<p class="mb-0 fw-normal">Додана в CONSOLID:</p>'
        );
        const $createdDate = $('<p class="fw-bold mb-0"></p>').text(created_at);
        const $createdByLabel = $('<p class="mb-0 fw-normal">компанією: </p>');
        const $createdBy = $('<p class="fw-bold mb-0"></p>').text(
            "Гал. Авто світ"
        );

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


    //  додати до списку компаній
    $('#add-to-company-list').click(function (e) {
        e.preventDefault();
        const companyId = $("#request-company-card").attr("company-id")

        console.log('додати об‘єкт по цьому айді на бек в список компаній таблиці :', companyId)
    });

});

// інпут пошуку компанії вказуючи країну
const input = document.querySelector("#searchCompanyInpCountry");
const iti = window.intlTelInput(input, {
    initialCountry: "auto",
    geoIpLookup: function (callback) {
        $.get("https://ipinfo.io", function () {
        }, "jsonp").always(function (
            resp
        ) {
            const countryCode = resp && resp.country ? resp.country : "ua";
            callback(countryCode);
        });
    },
    utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/js/utils.js",
    //   separateDialCode: true,
    onlyCountries: ["ua", "pl", "gb", "us", "de"],
});


// Відслідковуємо зміну стану чекбоксів статусу компанії
$('input[name="checkStatusCompany"]').change(function () {
    var selectedCheckbox = $('input[name="checkStatusCompany"]:checked').attr('id');

    // Показуємо або приховуємо відповідні елементи в залежності від вибраного чекбоксу
    if (selectedCheckbox === 'myCompanyCheck') {
        $('.titlesStatus .title-1').removeClass('d-none');
        $('.titlesStatus .title-2').addClass('d-none');
    } else if (selectedCheckbox === 'contractorCheck') {
        $('.titlesStatus .title-1').addClass('d-none');
        $('.titlesStatus .title-2').removeClass('d-none');
    }

});
