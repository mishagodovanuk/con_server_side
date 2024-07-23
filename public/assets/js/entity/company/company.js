$(function () {
    var statusCompanyCheckbox = $("#statusCompanyCheckboxes input[type='radio']:checked").attr("id");
    const defaultGraphic={"Monday":["09:00","18:00","13:00","14:00"],"Tuesday":["09:00","18:00","13:00","14:00"],"Wednesday":["09:00","18:00","13:00","14:00"],"Thursday":["09:00","18:00","13:00","14:00"],"Friday":["09:00","18:00","13:00","14:00"],"Saturday":"holiday","Sunday":"holiday"};

    let tab = 1;
    let url = window.location.origin
    let company_img = ''
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    function changeTab() {
        tab = $(this).attr('data-tab')
        $('.radio-card').removeClass('tab-active')
        $('.radio-card')[tab - 1].classList.add('tab-active')
        let previous_tab = tab % 2 + 1
        $('#tab-icon-' + previous_tab).removeClass('tab-filter')
        $('#tab-icon-' + tab).addClass('tab-filter')
        $('.form-check-input[value="tab' + tab + '"]')[0].checked = true
        $('#data_tab_' + previous_tab).css('display', "none")
        $('#data_tab_' + tab).css('display', 'block')
    }

    $('#tab_1, #tab_2').on('click', changeTab)

    $('#company-upload1').on('change', function () {

        const size =
            (this.files[0].size / 1024 / 1024).toFixed(2);

        if (size > 0.8) {
            $("#company-upload1").val('');
            alert("Файл повинен мати розмір не більше 800kB");
        } else {
            company_img = $("#company-upload1")[0].files[0]
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#company-upload-img1').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        }
    })

    $('#company-upload2').on('change', function () {

        const size =
            (this.files[0].size / 1024 / 1024).toFixed(2);

        if (size > 0.8) {
            $("#company-upload2").val('');
            alert("Файл повинен мати розмір не більше 800kB");
        } else {
            company_img = $("#company-upload2")[0].files[0]
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#company-upload-img2').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        }
    })

    $("#company-reset").on('click', function () {
        company_img = ''
        $('#company-upload-img1').attr('src', url + "/assets/icons/empty-company.svg");
    })

    $("#company-reset2").on('click', function () {
        company_img = ''
        $('#company-upload-img2').attr('src', url + "/assets/icons/empty-company.svg");
    })

    $("#update-company-reset").on("click", (function () {
        if ($('#edit').length) {
            let company_id = $('#edit').data('id')
        } else {
            let company_id = $('#edit_2').data('id')
        }

        $.ajax({
            url: url + '/company/delete-image/' + company_id,
            method: 'post',
            data: {_token: csrf},
            success: function () {
                location.reload()
            }
        });
    }))

    $('#add-to-company-list').on('click', function () {
        let company_id = $('#request-company-card').attr('company-id')

        $.ajax({
            url: url + '/company/add-to-workspace/' + company_id,
            method: 'post',
            data: {_token: csrf},
            success: function () {
                window.location.href = window.location.origin + '/company/'
            }
        });
    })

    $('#pdv').on('change', function () {
        if ($(this)[0].checked) {
            $('#ipn_2').removeAttr('disabled')
            $('#reg_doc').removeAttr('disabled')
            $('#ust_doc').removeAttr('disabled')
            $('#reg_doc-reset').removeAttr('disabled')
            $('#ust_doc-reset').removeAttr('disabled')
            $('#reg_doc-reset').removeClass('disabled-btn-c')
            $('#ust_doc-reset').removeClass('disabled-btn-c')
        } else {
            $('#ipn_2').attr('disabled', true)
            $('#reg_doc').attr('disabled', true)
            $('#ust_doc').attr('disabled', true)
            $('#reg_doc-reset').attr('disabled', true)
            $('#ust_doc-reset').attr('disabled', true)
            $('#reg_doc-reset').addClass('disabled-btn-c')
            $('#ust_doc-reset').addClass('disabled-btn-c')
        }
    })
    $("#reg_doc-reset").on('click', function () {
        $('#reg_doc').val('');
    })

    $("#ust_doc-reset").on('click', function () {
        $('#ust_doc').val('');
    })


    function getPhysicalFormData() {
        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('image', company_img)
        formData.append('firstName', $('#first_name').val())
        formData.append('lastName', $('#last_name').val())
        formData.append('patronymic', $('#patronymic').val())
        formData.append('ipn', $('#ipn').val())
        formData.append('email', $('#email').val())
        formData.append('country', $('#country').val())
        formData.append('category', $('#category').val())
        formData.append('city', $('#city').val())
        formData.append('street', $('#street').val())
        formData.append('building_number', $('#building_number').val())
        formData.append('flat', $('#flat').val())
        formData.append('gln', $('#gln').val())
        formData.append('bank', $('#bank').val())
        formData.append('iban', $('#iban').val())
        formData.append('mfo', $('#mfo').val())
        formData.append('about', $('#about').val())
        formData.append('currency', $('#currency').val())

        return formData
    }

    async function physicalValidation(response) {
        let res = await response.json()
        let data = res.errors
        if (data.hasOwnProperty('firstName') || data.hasOwnProperty('lastName') ||
            data.hasOwnProperty('patronymic') || data.hasOwnProperty('email') ||
            data.hasOwnProperty('ipn')) {
            appendAlert('#private-data-message', 'danger', Object.values(data)[0])
        } else if (data.hasOwnProperty('country') || data.hasOwnProperty('city') ||
            data.hasOwnProperty('street') || data.hasOwnProperty('building_number') ||
            data.hasOwnProperty('gln')) {
            appendAlert('#address-message', 'danger', Object.values(data)[0])
        } else if (data.hasOwnProperty('bank') || data.hasOwnProperty('iban') ||
            data.hasOwnProperty('mfo')) {
            appendAlert('#requisite-message', 'danger', Object.values(data)[0])
        } else {
            appendAlert('#about-message', 'danger', Object.values(data)[0])
        }
    }

    async function legalValidation(response) {
        let res = await response.json()
        let data = res.errors
        if (data.hasOwnProperty('image') || data.hasOwnProperty('edrpou') ||
            data.hasOwnProperty('email') || data.hasOwnProperty('company_name') ||
            data.hasOwnProperty('legal_entity')) {
            appendAlert('#private-data-message2', 'danger', Object.values(data)[0])
        } else if (data.hasOwnProperty('country') || data.hasOwnProperty('city') ||
            data.hasOwnProperty('street') || data.hasOwnProperty('building_number') ||
            data.hasOwnProperty('gln')) {
            appendAlert('#address-message2', 'danger', Object.values(data)[0])
        } else if (data.hasOwnProperty('u_country') || data.hasOwnProperty('u_city') ||
            data.hasOwnProperty('u_street') || data.hasOwnProperty('u_building_number') ||
            data.hasOwnProperty('u_gln')) {
            appendAlert('#u-address-message', 'danger', Object.values(data)[0])
        } else if (data.hasOwnProperty('bank') || data.hasOwnProperty('iban') ||
            data.hasOwnProperty('mfo')) {
            appendAlert('#requisite-message2', 'danger', Object.values(data)[0])
        } else if (data.hasOwnProperty('ipn') || data.hasOwnProperty('reg_doc') ||
            data.hasOwnProperty('ust_doc')) {
            appendAlert('#pdv-message', 'danger', Object.values(data)[0])
        } else {
            appendAlert('#about_company_message_2', 'danger', Object.values(data)[0])
        }
    }

    function getLegalFormData() {
        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('image', company_img)
        formData.append('edrpou', $('#edrpou').val())
        formData.append('email', $('#email_2').val())
        formData.append('company_name', $('#company_name').val())
        formData.append('company_category', $('#company_category').val())
        formData.append('legal_entity', $('#legal_entity').val())
        // formData.append('three_pl', $('#3PLOperator')[0].checked)

        formData.append('country', $('#country_2').val())
        formData.append('city', $('#city_2').val())
        formData.append('street', $('#street_2').val())
        formData.append('building_number', $('#building_number_2').val())
        formData.append('flat', $('#flat_2').val())
        formData.append('gln', $('#gln_2').val())

        formData.append('u_country', $('#u_country').val())
        formData.append('u_city', $('#u_city').val())
        formData.append('u_street', $('#u_street').val())
        formData.append('u_building_number', $('#u_building_number').val())
        formData.append('u_flat', $('#u_flat').val())
        formData.append('u_gln', $('#u_gln').val())

        formData.append('bank', $('#bank_2').val())
        formData.append('iban', $('#iban_2').val())
        formData.append('mfo', $('#mfo_2').val())
        formData.append('currency', $('#currency_u').val())

        formData.append('about', $('#about_2').val())

        if ($('#pdv')[0].checked) {
            formData.append('ipn', $('#ipn_2').val())
            formData.append('registration_doc', $("#reg_doc")[0].files[0])
            formData.append('ust_doc', $("#ust_doc")[0].files[0])
        }

        return formData
    }

    $('#save').on('click', async function () {
        let formData = getPhysicalFormData()
        formData.append('has_creator', statusCompanyCheckbox === "myCompanyCheck")
        await fetch(url + '/company/create-physical', {
            method: 'POST',
            body: formData
        }).then(async response => {
            if (response.status === 200) {
                // if (statusCompanyCheckbox === "myCompanyCheck") {
                //     markupForVerificationModal();
                //     $('#verificationRequest').modal('show');
                // } else {
                //     window.location.href = url + '/company'
                // }
                window.location.href = url + '/company'
            } else {
                physicalValidation(response)
            }
        })
    })

    $('#save_2').on('click', async function () {
        let formData = getLegalFormData()
        formData.append('has_creator', statusCompanyCheckbox === "myCompanyCheck")
        await fetch(url + '/company/create-legal', {
            method: 'POST',
            body: formData
        }).then(async response => {
            if (response.status === 200) {
                // if(statusCompanyCheckbox==="myCompanyCheck")  {    markupForVerificationModal();  $('#verificationRequest').modal('show');}else{  window.location.href = url + '/company'}
                window.location.href = url + '/company'
                //    додати флоу переходу на  window.location.href = url + '/company/ID створеного company'
            } else {
                legalValidation(response)
            }
        })
    })

    function appendAlert(selector, type, message) {
        $(selector)[0].innerHTML = null
        let block = document.createElement('div')
        block.className = 'alert alert-' + type + ' alert-dismissible fade show'
        block.setAttribute('role', 'alert')
        block.innerHTML = message
        let innerBtn = document.createElement('div')
        innerBtn.setAttribute('type', 'button')
        innerBtn.setAttribute('data-bs-dismiss', 'alert')
        innerBtn.setAttribute('aria-label', 'Close')
        innerBtn.className = 'close'
        block.append(innerBtn)
        let span = document.createElement('span')
        span.setAttribute('aria-hidden', 'true')
        span.innerHTML = "&times;"
        innerBtn.append(span)
        $(selector).append(block)
    }

    $('#edit').on('click', async function () {

        await fetch(url + '/company/update-physical/' + $(this).attr('data-id'), {
            method: 'POST',
            body: getPhysicalFormData()
        }).then(async response => {
            if (response.status === 200) {
                window.location.href = url + '/company'
            } else {
                let res = await response.json()
                let data = res.errors
                // console.log(data)
                if (data.hasOwnProperty('firstName') || data.hasOwnProperty('lastName') ||
                    data.hasOwnProperty('patronymic') || data.hasOwnProperty('email') ||
                    data.hasOwnProperty('ipn')) {
                    appendAlert('#private-data-message', 'danger', Object.values(data)[0])
                } else if (data.hasOwnProperty('country') || data.hasOwnProperty('city') ||
                    data.hasOwnProperty('street') || data.hasOwnProperty('building_number') ||
                    data.hasOwnProperty('gln')) {
                    appendAlert('#address-message', 'danger', Object.values(data)[0])
                } else if (data.hasOwnProperty('bank') || data.hasOwnProperty('iban') ||
                    data.hasOwnProperty('mfo')) {
                    appendAlert('#requisite-message', 'danger', Object.values(data)[0])
                } else {
                    appendAlert('#about-message', 'danger', Object.values(data)[0])
                }
            }
        })
    })

    $('#edit_2').on('click', async function () {
        let formData = getLegalFormData()
        formData.append('need_file', $('#need_file').val())
        await fetch(url + '/company/update-legal/' + $(this).attr('data-id'), {
            method: 'POST',
            body: formData
        }).then(async response => {
            if (response.status === 200) {
                window.location.href = url + '/company'
            } else {
                let res = await response.json()
                let data = res.errors
                if (data.hasOwnProperty('image') || data.hasOwnProperty('edrpou') ||
                    data.hasOwnProperty('email') || data.hasOwnProperty('company_name') ||
                    data.hasOwnProperty('legal_entity')) {
                    appendAlert('#private-data-message2', 'danger', Object.values(data)[0])
                } else if (data.hasOwnProperty('country') || data.hasOwnProperty('city') ||
                    data.hasOwnProperty('street') || data.hasOwnProperty('building_number') ||
                    data.hasOwnProperty('gln')) {
                    appendAlert('#address-message2', 'danger', Object.values(data)[0])
                } else if (data.hasOwnProperty('u_country') || data.hasOwnProperty('u_city') ||
                    data.hasOwnProperty('u_street') || data.hasOwnProperty('u_building_number') ||
                    data.hasOwnProperty('u_gln')) {
                    appendAlert('#u-address-message', 'danger', Object.values(data)[0])
                } else if (data.hasOwnProperty('bank') || data.hasOwnProperty('iban') ||
                    data.hasOwnProperty('mfo')) {
                    appendAlert('#requisite-message2', 'danger', Object.values(data)[0])
                } else if (data.hasOwnProperty('ipn') || data.hasOwnProperty('reg_doc') ||
                    data.hasOwnProperty('ust_doc')) {
                    appendAlert('#pdv-message', 'danger', Object.values(data)[0])
                } else {
                    appendAlert('#about_company_message_2', 'danger', Object.values(data)[0])
                }
            }
        })
    })

    function getImgCompany(){
            const fileName = company_img.name;
            const fileExtension = fileName.split('.').pop();
            const blob = new Blob([company_img], { type: `image/${fileExtension}` });
            const objectImgURL = URL.createObjectURL(blob);
            $('#company-img').attr('src', objectImgURL)
    }

    $('#onboarding_save').on('click', async function () {
        let formData = getPhysicalFormData()
        formData.append('has_creator', 'true')
        const $blocks = $("#personal-info-user, #find-company, #create-company, #create-workspace, #send-join");
        $('#back-create-new-company').attr('company_type', 'physical')
        await fetch(url + '/company/create-physical', {
            method: 'POST',
            body: formData
        }).then(async response => {
                if (response.status === 200) {
                    let res = await response.json()
                    $('#title-company')[0].innerHTML = $('#last_name').val() + ' ' + $('#first_name').val()
                    $('#title-payment-details')[0].innerHTML = ' <p class="mb-0 fw-normal">ІПН: </p>\n' +
                        '<p class="fw-bold mb-0" >' + $('#ipn').val() + '</p>'
                    var selectElement = document.getElementById('country');
                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                    $('#title-country')[0].innerHTML = selectedOption.innerHTML
                    $('#back-find-company').attr('company_id', res.id)
                    $('#edit_save').attr('company_id', res.id)
                    $('#condition_submit').attr('href', window.location.origin +
                        '/workspace/create/' + res.id)
                    $blocks.addClass("d-none");
                    $("#create-workspace").removeClass("d-none");
                  if(company_img) {  getImgCompany() ;}

                    $.ajax({
                        url: '/onboarding/admin',
                        type: 'POST',
                        data: {
                            _token: csrf,
                            company_id: res.id,
                            schedule: defaultGraphic
                        }
                    });

                } else {
                    physicalValidation(response)
                }
            }
        )
    })

    $('#onboarding_save_2').on('click', async function () {
        let formData = getLegalFormData()
        formData.append('has_creator', 'true')
        const $blocks = $("#personal-info-user, #find-company, #create-company, #create-workspace, #send-join");
        $('#back-create-new-company').attr('company_type', 'legal')
        await fetch(url + '/company/create-legal', {
            method: 'POST',
            body: formData
        }).then(async response => {
            if (response.status === 200) {
                let res = await response.json()

                $('#back-find-company-2').data('company_id', res.id)

                $('#title-company')[0].innerHTML = $('#company_name').val()
                $('#title-payment-details')[0].innerHTML = ' <p class="mb-0 fw-normal">ЕДРПОУ: </p>\n' +
                    '<p class="fw-bold mb-0" >' + $('#edrpou').val() + '</p>'
                var selectElement = document.getElementById('country_2');
                var selectedOption = selectElement.options[selectElement.selectedIndex];
                $('#title-country')[0].innerHTML = selectedOption.innerHTML

                $('#back-find-company').attr('company_id', res.id)

                $blocks.addClass("d-none");
                $("#create-workspace").removeClass("d-none");
                $('#edit_save_2').attr('company_id', res.id)
                $('#condition_submit').attr('href', window.location.origin +
                    '/workspace/create/' + res.id)
                    if(company_img) {  getImgCompany() ;}
                $.ajax({
                    url: '/onboarding/admin',
                    type: 'POST',
                    data: {
                        _token: csrf,
                        company_id: res.id,
                        schedule: defaultGraphic
                    }
                });

            } else {
                legalValidation(response)
            }
        })
    })

    $('#edit_save').on('click', async function () {
        const $blocks = $("#personal-info-user, #find-company, #create-company, #create-workspace, #send-join");
        let formData = getPhysicalFormData()
        await fetch(url + '/company/update-physical/' + $(this).attr('company_id'), {
            method: 'POST',
            body: formData
        }).then(async response => {
            if (response.status === 200) {
                $('#title-company')[0].innerHTML = $('#last_name').val() + ' ' + $('#first_name').val()
                $('#title-payment-details')[0].innerHTML = ' <p class="mb-0 fw-normal">ІПН: </p>\n' +
                    '<p class="fw-bold mb-0" >' + $('#ipn').val() + '</p>'
                var selectElement = document.getElementById('country');
                var selectedOption = selectElement.options[selectElement.selectedIndex];
                $('#title-country')[0].innerHTML = selectedOption.innerHTML
                $blocks.addClass("d-none");
                $("#create-workspace").removeClass("d-none");
                if(company_img) {  getImgCompany() ;}

            } else {
                physicalValidation(response)
            }
        })
    })

    $('#edit_save_2').on('click', async function () {
        const $blocks = $("#personal-info-user, #find-company, #create-company, #create-workspace, #send-join");
        let formData = getLegalFormData()
        await fetch(url + '/company/update-legal/' + $(this).attr('company_id'), {
            method: 'POST',
            body: formData
        }).then(async response => {
            if (response.status === 200) {
                $('#title-company')[0].innerHTML = $('#company_name').val()
                $('#title-payment-details')[0].innerHTML = ' <p class="mb-0 fw-normal">ЕДРПОУ: </p>\n' +
                    '<p class="fw-bold mb-0" >' + $('#edrpou').val() + '</p>'
                var selectElement = document.getElementById('country_2');
                var selectedOption = selectElement.options[selectElement.selectedIndex];
                $('#title-country')[0].innerHTML = selectedOption.innerHTML

                $blocks.addClass("d-none");
                $("#create-workspace").removeClass("d-none");
                if(company_img) {  getImgCompany() ;}
            } else {
                legalValidation(response)
            }
        })
    })

    $('#back-find-company').on('click', function () {
        $('#about_company_message_2')[0].innerHTML = ''
        $('#pdv-message')[0].innerHTML = ''
        $('#requisite-message2')[0].innerHTML = ''
        $('#u-address-message')[0].innerHTML = ''
        $('#address-message2')[0].innerHTML = ''
        $('#private-data-message2')[0].innerHTML = ''

        $('#private-data-message')[0].innerHTML = ''
        $('#address-message')[0].innerHTML = ''
        $('#requisite-message')[0].innerHTML = ''
        $('#about-message')[0].innerHTML = ''

        company_img = ''
        $('#company-upload-img1').attr('src', url + "/assets/images/empty-company.png");
        $('#company-upload-img2').attr('src', url + "/assets/images/empty-company.png");

        $('#u_country').val('').trigger('change')
        $('#edrpou').val('')
        $('#email_2').val('')
        $('#company_name').val('')
        $('#legal_entity').val('').trigger('change')
        $('#country_2').val('').trigger('change')
        $('#street_2').val('').trigger('change')
        $('#city_2').val('').trigger('change')
        $('#building_number_2').val('')
        $('#flat_2').val('')
        $('#gln_2').val('')
        $('#u_city').val('').trigger('change')
        $('#u_street').val('').trigger('change')
        $('#u_building_number').val('')
        $('#u_gln').val('')
        $('#u_flat').val('').trigger('change')
        $('#bank_2').val('')
        $('#iban_2').val('')
        $('#mfo_2').val('')
        $('#currency_u').val('').trigger('change')
        $('#about_2').val('')
        $('#ipn_2').val('')
        $("#reg_doc").val('')
        $("#ust_doc").val('')
        $('#first_name').val('')
        $('#last_name').val('')
        $('#patronymic').val('')
        $('#ipn').val('')
        $('#email').val('')
        $('#country').val('').trigger('change')
        $('#city').val('').trigger('change')
        $('#street').val('').trigger('change')
        $('#building_number').val('')
        $('#flat').val('')
        $('#gln').val('')
        $('#bank').val('')
        $('#iban').val('')
        $('#mfo').val('')
        $('#about').val('')
        $('#currency').val('').trigger('change')
        $('#onboarding_save').removeClass('d-none')
        $('#edit_save').addClass('d-none')
        $('#onboarding_save_2').addClass('d-none')
        $('#edit_save_2').addClass('d-none')
        $('input[name="tabs"][value="tab1"]').prop('checked', true);
        $('#data_tab_1').css('display', 'block')
        $('#data_tab_2').css('display', 'none')

        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('_method', 'DELETE')
        fetch(url + '/company/' + $(this).attr('company_id'), {
            method: 'POST',
            body: formData
        })
    })

    $('#back-create-new-company').on('click', function () {
        if ($(this).attr('company_type') == 'legal') {
            $('#onboarding_save_2').addClass('d-none')
            $('#edit_save_2').removeClass('d-none')
        } else {
            $('#onboarding_save').addClass('d-none')
            $('#edit_save').removeClass('d-none')
        }
    })


    // Відслідковуємо зміну стану чекбоксів чи фізична особа, чи юридична і міняємо кнопку зберегти
    $('.tabsActiveStatus').on('click', function () {
        var selectedCheckbox = $('.tab-active.tabsActiveStatus');

        // Показуємо або приховуємо відповідні елементи в залежності від вибраного чекбоксу
        if (selectedCheckbox.hasClass('tab1')) {
            $('.saveBtn-1').removeClass('d-none');
            $('.saveBtn-2').addClass('d-none');
        } else if (selectedCheckbox.hasClass('tab2')) {
            $('.saveBtn-1').addClass('d-none');
            $('.saveBtn-2').removeClass('d-none');
        }
    });

// відслідковуємо зміну статусу компанії
    $("#link-to-create-page").on('click', function () {
        statusCompanyCheckbox = $("#statusCompanyCheckboxes input[type='radio']:checked").attr("id");
        //    console.log(statusCompanyCheckbox);

    });

    //  дані всередині модалки верифікації
    function markupForVerificationModal() {
        let obj = {}
        var selectedCheckbox = $('.tab-active.tabsActiveStatus');

        if (selectedCheckbox.hasClass('tab1')) {
            //  фіз особа
            let formData = getPhysicalFormData();
            formData.forEach(function (value, key) {
                obj[key] = value;
            });
            const {firstName, lastName, ipn, iban, mfo} = obj;
            const $verificationModal = $('#data-in-verificationModal').empty();
            $verificationModal.append(htmlDataPhysical(firstName, lastName, ipn, iban, mfo));

        } else if (selectedCheckbox.hasClass('tab2')) {
            // юр ос
            let formData = getLegalFormData();
            formData.forEach(function (value, key) {
                obj[key] = value;
            });
            const {edrpou, company_name, iban, mfo} = obj;
            const $verificationModal = $('#data-in-verificationModal').empty();
            $verificationModal.append(htmlDataLegal(edrpou, company_name, iban, mfo));

        }
        obj = {}

        function htmlDataPhysical(firstName, lastName, ipn, iban, mfo) {
            return `  <p class="mb-1 ">Назва компанії: <span class="fw-medium-c ps-1">${firstName, ' ', lastName}</span> </p>
 <p class="mb-1 ">Тип юридичної особи: <span class="fw-medium-c ps-1">Фіз. особа</span> </p>
<p class="mb-1 ">ІПН: <span class="fw-medium-c ps-1">${ipn}</span> </p>
     <p class="mb-1 ">Банк: <span class="fw-medium-c ps-1">АТ КБ "ПРИВАТБАНК"</span> </p>
     <p class="mb-1 ">IBAN: <span class="fw-medium-c ps-1">${iban}</span> </p>
     <p class="mb-1 ">МФО: <span class="fw-medium-c ps-1">${mfo}</span> </p>`
        }

        function htmlDataLegal(edrpou, company_name, iban, mfo) {
            return `  <p class="mb-1 ">Назва компанії: <span class="fw-medium-c ps-1">${company_name}</span> </p>
     <p class="mb-1 ">Тип юридичної особи: <span class="fw-medium-c ps-1">TOB</span> </p>
     <p class="mb-1 ">ЄДРПОУ: <span class="fw-medium-c ps-1">${edrpou}</span> </p>
     <p class="mb-1 ">Банк: <span class="fw-medium-c ps-1">АТ КБ "ПРИВАТБАНК"</span> </p>
     <p class="mb-1 ">IBAN: <span class="fw-medium-c ps-1">${iban}</span> </p>
     <p class="mb-1 ">МФО: <span class="fw-medium-c ps-1">${mfo}</span> </p>`
        }

    }

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
        }

    });


})



