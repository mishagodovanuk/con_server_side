$((function () {

    let url = window.location.origin
    let transport_img = ''
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    $('#transport-upload').on('change', function () {

        const size =
            (this.files[0].size / 1024 / 1024).toFixed(2);

        if (size > 0.8) {
            $("#transport-upload").val('');
            alert("Файл повинен мати розмір не більше 800kB");
        } else {
            transport_img = $("#transport-upload")[0].files[0]
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#transport-upload-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        }
    })

    $('#category').on('change', function () {

        if ($(this).val() == 2) {
            $('#additional-data').css('display', 'block')
        } else {
            $('#additional-data').css('display', 'none')
        }

    })

    $('#mark').on('change', async function () {

        let modelSelect = $('#model')
        modelSelect.removeAttr('disabled')
        modelSelect.empty()
        await fetch(url + '/transport/model-by-brand/' + $(this).val(), {
            method: 'GET',
        }).then(async response => {
            let res = await response.json()
            let disabledOption = document.createElement('option')
            disabledOption.setAttribute('disabled', '')
            disabledOption.setAttribute('selected', '')

            res.data.forEach(el => {
                let option = document.createElement('option')
                option.value = el.id
                option.innerHTML = el.name
                modelSelect.append(option)
            })
        })
    })

    $("#transport-reset").on('click', function () {
        transport_img = ''
        $('#transport-upload-img').attr('src', url + "/assets/images/transport-empty.png");
    })

    $("#update-transport-reset").on('click', function () {
        $.ajax({
            url: url + '/transport/delete-image/' + $('#data_tab_1').attr('data-id'),
            method: 'post',
            data: {_token: csrf},
            success: function () {
                location.reload()
            }
        });
    })

    $('#country').on('change', function () {
        if ($(this).val() === 1) {
            $('#license_plate').attr('placeholder', 'AA0000AA')
        } else {
            $('#license_plate').attr('placeholder', '')
        }
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

    function makeFormData() {
        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('image', transport_img)
        formData.append('mark', $('#mark').val())
        formData.append('model', $('#model').val())
        formData.append('type', $('#type').val())
        formData.append('category', $('#category').val())
        formData.append('weight', $('#weight').val())

        formData.append('license_plate', $('#license_plate').val().toUpperCase())

        // if ($('#country').val() == 1) {
        //     formData.append('license_plate', $('#license_plate').val().toUpperCase())
        // } else {
        //     formData.append('license_plate_without_mask', $('#license_plate').val().toUpperCase())
        // }
        formData.append('equipment', $('#additional_equipment').val())
        formData.append('registration_country', $('#country').val())
        formData.append('manufacture_year', $('#manufacture_year').val())
        formData.append('company', $('#company').val())
        formData.append('driver', $('#driver').val())
        if ($('#category').val() == 2) {
            formData.append('download_methods', JSON.stringify($('#download_methods').val()))
            formData.append('adr', $('#adr').val())
            formData.append('carrying_capacity', $('#carrying_capacity').val())
            formData.append('length', $('#length').val())
            formData.append('width', $('#width').val())
            formData.append('height', $('#height').val())
            formData.append('volume', $('#volume').val())
            formData.append('capacity_eu', $('#capacity_eu').val())
            formData.append('capacity_am', $('#capacity_am').val())
            formData.append('hydroboard', $('#hydroboard').prop('checked'))
        }
        formData.append('spending_empty', $('#spending_empty').val())
        formData.append('spending_full', $('#spending_full').val())

        return formData
    }

    $('#save').on('click', async function () {
        let formData = makeFormData()
        let send_url = url + '/transport/'

        if ($('#category').val() == 2) {
            send_url = url + '/transport/store-with-additional'
        }

        await fetch(send_url, {
            method: 'POST',
            body: formData
        }).then(async response => {
            if (response.status === 200) {
                window.location.href = url + '/transport'
            } else {
                let res = await response.json()
                let data = res.errors
                if (data.hasOwnProperty('image') || data.hasOwnProperty('mark') ||
                    data.hasOwnProperty('model') || data.hasOwnProperty('type') ||
                    data.hasOwnProperty('kind') || data.hasOwnProperty('license_plate') ||
                    data.hasOwnProperty('registration_country') || data.hasOwnProperty('spending_empty') ||
                    data.hasOwnProperty('manufacture_year') || data.hasOwnProperty('company')
                    || data.hasOwnProperty('driver') || data.hasOwnProperty('spending_full')
                    || data.hasOwnProperty('weight')) {
                    appendAlert('#main-data-message', 'danger', Object.values(data)[0])
                } else {
                    appendAlert('#capacity-data-message', 'danger', Object.values(data)[0])
                }
            }
        })
    })


    $('#update').on('click', async function () {

        let formData = makeFormData()
        formData.append('_method', 'PUT')
        let transport_id = $('#data_tab_1').attr('data-id')
        let send_url = url + '/transport/' + transport_id

        if ($('#type').val() == 2) {
            send_url = url + '/transport/update-with-additional/' + transport_id
        }
        console.log(formData)

        await fetch(send_url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrf
            }
        }).then(async response => {
            if (response.status === 200) {
                window.location.href = url + '/transport/' + transport_id
            } else {
                let res = await response.json()
                let data = res.errors
                if (data.hasOwnProperty('image') || data.hasOwnProperty('mark') ||
                    data.hasOwnProperty('model') || data.hasOwnProperty('type') ||
                    data.hasOwnProperty('kind') || data.hasOwnProperty('license_plate') ||
                    data.hasOwnProperty('registration_country') || data.hasOwnProperty('spending_empty') ||
                    data.hasOwnProperty('manufacture_year') || data.hasOwnProperty('company')
                    || data.hasOwnProperty('driver') || data.hasOwnProperty('spending_full')
                    || data.hasOwnProperty('weight')) {
                    appendAlert('#main-data-message', 'danger', Object.values(data)[0])
                } else {
                    appendAlert('#capacity-data-message', 'danger', Object.values(data)[0])
                }
            }
        })

    })

    $('.cancel-btn').on('click', function () {
        $('.modal').modal('hide')

    });
}))

