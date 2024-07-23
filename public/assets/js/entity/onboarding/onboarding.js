$(document).ready(function () {
    let url = window.location.origin;
    let csrf = document.querySelector('meta[name="csrf-token"]').content;
    //Перемикання між сторінками
    const $blocks = $("#personal-info-user, #find-company, #create-company, #create-workspace, #send-join");

    let prevResponseStatus = null;
    let prevFormData = null;

    // Функція для перевірки полів і стану кнопки
    function checkFieldsAndButton() {
        const name = $('#name').val();
        const surname = $('#surname').val();
        const patronymic = $('#_patronymic').val();

        const $submitButton = $("#next-find-company");

        if (name === '' || surname === '' || patronymic === '') {
            $submitButton.addClass('disabled');
        } else {
            $submitButton.removeClass('disabled');
        }
    }

    // Відстежуємо зміни в полях вводу
    $('#name, #surname, #_patronymic').on('input', checkFieldsAndButton);

    $("#next-find-company").click(async function () {

        $('#full-name-user').text('');
        const name = $('#name').val();
        const surname = $('#surname').val();
        const patronymic = $('#_patronymic').val()
        const fullNameUser =name+' '+surname+" "+patronymic;
        $('#full-name-user').text(fullNameUser);

        let formData = new FormData();
        formData.append('_token', csrf);
        formData.append('name', $('#name').val());
        formData.append('surname', $('#surname').val());
        formData.append('patronymic', $('#_patronymic').val());

        if ($('#email').is('[data-required]')) {
            // console.log(1);
            formData.append('email', $('#_email').val());
        } else {
            // console.log(2);
            formData.append('phone', $('#phone').val());
        }

        if (JSON.stringify(prevFormData) === JSON.stringify(formData) && prevResponseStatus === 200) {
            // Data and response status match previous, so no need to make the same request again.
            $blocks.addClass("d-none");
            $("#find-company").removeClass("d-none");
            return;
        }

        const response = await fetch(url + '/user/update/onboarding', {
            method: 'POST',
            body: formData
        });

        if (response.status === 200) {
            $blocks.addClass("d-none");
            $("#find-company").removeClass("d-none");
        } else if (response.status === 422) {
            const responseData = await response.json();
            if (responseData.errors && responseData.errors.phone) {
                // Show the error message for the "phone" field.
                alert(responseData.errors.phone[0]);
            } else {
                alert('Unprocessable Entity');
            }
        } else {
            alert('Something wrong');
        }

        prevResponseStatus = response.status;
        prevFormData = formData;
    });


    $("#back-personal-info").click(function () {
        $blocks.addClass("d-none");
        $("#personal-info-user").removeClass("d-none");
    });

    $(document).on('click', '#company-send-join', function () {
        $blocks.addClass("d-none");
        $("#send-join").removeClass("d-none");
        $('#send-request').attr('company-id', $(this).attr('company-id'))
        $('#request-company-card')[0].innerHTML = $(this)[0].innerHTML
    });

    $("#back-find-company-2").click(function () {
        $blocks.addClass("d-none");
        $("#find-company").removeClass("d-none");
    });


    $("#create-new-company, #create-new-company-link").click(function () {
        $blocks.addClass("d-none");
        $("#create-company").removeClass("d-none");
    });


    $("#back-find-company").click(function () {
        $blocks.addClass("d-none");
        $("#find-company").removeClass("d-none");
    });

    $("#back-create-new-company").click(function () {
        $blocks.addClass("d-none");
        $("#create-company").removeClass("d-none");

    });


    // Перевірка на пусте значення в personal-info-user
    $("#userName, #userLastName, #userPatronymic, #userBirthday, #userEmail").on("input", function () {
        var empty = false;
        $("#userName, #userLastName, #userPatronymic, #userBirthday, #userEmail").each(function () {
            if ($(this).val() == '') {
                empty = true;
            }
        });
        if (empty) {
            $("#next-find-company").prop("disabled", true);
        } else {
            $("#next-find-company").prop("disabled", false);
        }
    });

    // Створення елементу компанії

    //Пошук компанії
    $('#searchCompanyButton').click(function () {

        const titleCountryFull = $('.inpSelectCountry .iti__selected-flag').attr('title');
        let countryTitle = titleCountryFull.match(/^([\w\s]+?)(?=\s*[(:])/)[0].trim()
        // console.log("country: ", countryTitle); назва вибраної країни
        if (countryTitle === "Ukraine"){
            countryTitle = 'Україна'
        }
        const searchTerm = $('#searchCompany').val() // get the search term and convert to lowercase
        //console.log(searchTerm)
        let endpoint = `/company/find?query=${searchTerm}&country=${countryTitle}`;
        let requestUrl = url + endpoint;
        //console.log(requestUrl)
        fetch(requestUrl)
            .then(response => response.json())
            .then(({data}) => {
                const list = document.getElementById('listItemCompany');
                list.innerHTML = '';
                let generatedCount = 0;

                data.forEach(item => {
                    console.log("data")
                    const edrpou = item.edrpou ? "" + item.edrpou : "";
                    const ipn = item.ipn ? "" + item.ipn : "";
                    const country = countryTitle;
                    //console.log(edrpou, ipn, country)

                    const searchFields = item.company_type_id === 1 ?
                        [item.surname, edrpou, ipn, country] :
                        [item.name, edrpou, ipn, country];

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
                        $('#searchCompanyResult').addClass('d-none');
                        $('#listFindCompany').removeClass('d-none');
                        $('#onbording-link-proposition').removeClass('d-none');
                        generatedCount++;
                        const resultText = generatedCount === 1 ? 'результат' :
                            generatedCount >= 2 && generatedCount <= 4 ? 'результата' :
                                'результатів';
                        $('#countCompanyItem').text(`Найдено ${generatedCount} ${resultText}`);
                    }

                });
            })
            .catch(error => {
                console.error(error);
                $('#searchCompanyResult').removeClass('d-none');
                $('#notFoundCompany').removeClass('d-none');
                $('#create-new-company').removeClass('d-none');
                $('#findCompany').addClass('d-none');
                $('#listFindCompany').addClass('d-none');
                $('#onbording-link-proposition').addClass('d-none');
            });

    });

    function createCompanyItem(name, edrpou, ipn, company_type_id, country, created_at, img_type, id, workspace) {
        // Створення елементів з вказаними параметрами

        const $item = $('<button id="company-send-join" company-id="' + id + '" class="col-12 px-0 border onboarding-item-company mt-1 link-dark" style="border-radius: 6px; background-color: #fff"></button>');
        const $row = $('<div class="row mx-0"></div>');
        const $colIcon = $('<div class="col-auto p-0"></div>');
        const $iconCompany = $(`<div class="" style="background-color: #A8AAAE14; width: 138px"><img style="border-radius: 6px 0 0 6px" width="138px" height="138px" src="${window.location.origin}/uploads/company/image/${id}.${img_type}"></div>`);
        const $icon = $(`<div class="p-2" style="background-color: #A8AAAE14; width: 138px"><img src="${window.location.origin}/assets/icons/building-community.svg"></div>`);

        const $colContent = $('<div class="col-9 py-1 flex-grow-1"></div>');
        const $nameRow = $('<div class="d-flex align-items-center" style="gap: 12px"></div>');
        const $name = $('<h4 class="fw-bolder mb-0 text-capitalize"></h4>').text(name);
        let $badgeNoAdmin
        if (workspace === null) {
            $badgeNoAdmin = $('<span class="badge badge-light-primary">Без адміністратора</span>');
        } else {
            $badgeNoAdmin = $('<span class="badge badge-light-warning">Сторонній адміністратор</span>');
        }

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

    // Перемикання кнопки зберегти для певного виду компанії
    $(".onboarding-radio-card").on("click", function () {
        // Перевіряємо, чи є блок "onboarding-radio-card" з класом "tab-active" і дочірнім блоком з ID "tab_1"
        if ($(this).hasClass("tab-active") && $(this).find("#tab_1").length) {
            // Якщо блок з ID "tab_1" має клас "tab-active", то приховуємо кнопку "save_2"
            $("#onboarding_save_2").addClass("d-none");
            $("#onboarding_save").removeClass("d-none");
        } else {
            // Інакше, якщо блок має клас "tab-active", але не містить дочірній блок з ID "tab_1", то приховуємо кнопку "save"
            $("#onboarding_save").addClass("d-none");
        }

        // Перевіряємо, чи є блок "onboarding-radio-card" з класом "tab-active" і дочірнім блоком з ID "tab_2"
        if ($(this).hasClass("tab-active") && $(this).find("#tab_2").length) {
            // Якщо блок з ID "tab_2" має клас "tab-active", то приховуємо кнопку "save"
            $("#onboarding_save").addClass("d-none");
            $("#onboarding_save_2").removeClass("d-none");
        } else {
            // Інакше, якщо блок має клас "tab-active", але не містить дочірній блок з ID "tab_2", то приховуємо кнопку "save_2"
            $("#onboarding_save_2").addClass("d-none");
        }
    });

    $('#send-request').on('click', function () {
        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('user_id', $(this).attr('user-id'))
        formData.append('company_id', $(this).attr('company-id'))

        fetch(url + '/workspace/request/send', {
            method: 'POST',
            body: formData
        })
    })
})


////=========================================================
// інпут пошуку компанії вказуючи країну
const input = document.querySelector("#searchCompany");
const iti = window.intlTelInput(input, {

    initialCountry: "auto",
    geoIpLookup: function (callback) {
        $.get('https://ipinfo.io', function () {
        }, "jsonp").always(function (resp) {
            const countryCode = (resp && resp.country) ? resp.country : "ua";
            callback(countryCode);
        });
    },
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/js/utils.js",
    //   separateDialCode: true,
    onlyCountries: ["ua", "pl", "gb", "us", "de"]

});

// перехід між інпутом емейл і номер

$('.input-number-group').hide()

$('.input-number-group input').attr('aria-selected', 'false');
$('.input-email-group input').attr('aria-selected', 'true');

$(".link-to-numberInput").click(function (e) {
    $('.input-email-group').hide();
    $('.input-number-group').show();
    $('.input-email-group input').attr('aria-selected', 'false');
    $('.input-number-group input').attr('aria-selected', 'true');
});

$(".link-to-emailInput").click(function (e) {
    $('.input-number-group').hide();
    $('.input-email-group').show();
    $('.input-number-group input').attr('aria-selected', 'false');
    $('.input-email-group input').attr('aria-selected', 'true');
});


let url = window.location.origin;
let csrf = document.querySelector('meta[name="csrf-token"]').content;

$('#feedback-form').on('submit', async function (e) {
    e.preventDefault();
    const inpEmail = $('#feedBackEmailInp');
    const inpNumber = $('#feedBackEmailInpOnbording');
    const loginValue = inpEmail.attr('aria-selected') === "true" ? inpEmail.val() : inpNumber.val();
    await fetch(url + '/contact-admin', {
        method: 'POST',
        body: JSON.stringify({
            _token: csrf,
            login: loginValue,
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    }).then(async response => {
        window.location = '/';
    });
});


// оборобляємо співпадінна адрес
$('#matchingAddress').on('change', function () {

    if ($(this).is(':checked')) {
        $('#u_country').val($('#country_2').val());
        $('#u_country option').filter(function () {
            return $(this).text() === $('#country_2 option:selected').text();
        }).prop('selected', true);
        $('#u_country').select2();

        $('#u_city').val($('#city_2').val());
        $('#u_city option').filter(function () {
            return $(this).text() === $('#city_2 option:selected').text();
        }).prop('selected', true);
        $('#u_city').select2();

        $('#u_street').val($('#street_2').val());
        $('#u_street option').filter(function () {
            return $(this).text() === $('#street_2 option:selected').text();
        }).prop('selected', true);
        $('#u_street').select2();

        $('#u_building_number').val($('#building_number_2').val());
        $('#u_flat').val($('#flat_2').val());
        $('#u_gln').val($('#gln_2').val());
    } else {
        $('#u_country').val('');
        $('#u_country option').filter(function () {
            return $(this).text() === ''
        }).prop('selected', true);
        $('#u_country').select2();

        $('#u_city').val('');
        $('#u_city option').filter(function () {
            return $(this).text() === ''
        }).prop('selected', true);
        $('#u_city').select2();

        $('#u_street').val('');
        $('#u_street option').filter(function () {
            return $(this).text() === ''
        }).prop('selected', true);
        $('#u_street').select2();

        $('#u_building_number').val('');
        $('#u_flat').val('');
        $('#u_gln').val('');
    }
});
