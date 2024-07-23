$((function () {

    let url = window.location.origin
    let additional_equipment_img = ''
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    $('#additional-equipment-upload').on('change', function () {

        const size =
            (this.files[0].size / 1024 / 1024).toFixed(2);

        if (size > 0.8) {
            $("#additional-equipment-upload").val('');
            alert("Файл повинен мати розмір не більше 800kB");
        } else {
            additional_equipment_img = $("#additional-equipment-upload")[0].files[0]
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#additional-equipment-upload-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        }
    })

    $('#mark-equipment').on('change', async function () {

        let modelSelect = $('#model')
        modelSelect.removeAttr('disabled')
        modelSelect.empty()
        await fetch(url + '/equipment-model-by-brand/' + $(this).val(), {
            method: 'GET',
        }).then(async response => {
            let res = await response.json()
            let disabledOption = document.createElement('option')
            disabledOption.setAttribute('disabled', '')
            disabledOption.setAttribute('selected', '')

            //disabledOption.innerHTML = "Виберіть модель обладнання"
            //modelSelect.append(disabledOption)

            res.data.forEach(el => {
                let option = document.createElement('option')
                option.value = el.id
                option.innerHTML = el.name
                modelSelect.append(option)
            })
        })
    })

    $("#additional-equipment-reset").on('click', function () {
        additional_equipment_img = ''
        $("#additional-equipment-upload-img").attr(
            "src",
            url + "/assets/images/additional-equipment-empty.png"
        );
    })

    $("#update-equipment-reset").on('click', function () {
        $.ajax({
            url: url + '/transport-equipment/delete-image/' + $(this).attr('data-id'),
            method: 'post',
            data: {_token: csrf},
            success: function () {
                location.reload()
            }
        });
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

    $('#country').on('change', function () {
        if ($(this).val() === 1) {
            $('#license_plate').attr('placeholder', 'AA0000AA')
        } else {
            $('#license_plate').attr('placeholder', '')
        }
    })

    function makeFormData() {
        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('image', additional_equipment_img)
        formData.append('mark', $('#mark-equipment').val())
        formData.append('model', $('#model').val())
        formData.append('type', $('#type-equipment').val())
        // видалити на беку weight
        // formData.append('weight', $('#weight').val())

        formData.append('license_plate', $('#license_plate').val().toUpperCase())

        // if ($('#country').val() == 1) {
        //     formData.append('license_plate', $('#license_plate').val().toUpperCase())
        // } else {
        //     formData.append('license_plate_without_mask', $('#license_plate').val().toUpperCase())
        // }
        formData.append('transport', $('#transport').val())
        formData.append('registration_country', $('#country').val())
        formData.append('manufacture_year', $('#manufacture_year').val())
        formData.append('company', $('#company').val())
        formData.append('download_methods', JSON.stringify($('#download_method').val()))
        formData.append('adr', $('#adr').val())
        formData.append('carrying_capacity', $('#carrying_capacity').val())
        formData.append('length', $('#length').val())
        formData.append('width', $('#width').val())
        formData.append('height', $('#height').val())
        formData.append('volume', $('#volume').val())
        formData.append('capacity_eu', $('#capacity_eu').val())
        formData.append('capacity_am', $('#capacity_am').val())
        formData.append('hydroboard', $('#hydroboard').prop('checked'))
        return formData
    }

    async function callback(response) {
        if (response.status === 200) {
            window.location.href = url + '/transport-equipment'
        } else {
            let res = await response.json();
            let data = res.errors;
            if (
                data.hasOwnProperty("image") ||
                data.hasOwnProperty("mark") ||
                data.hasOwnProperty("model") ||
                data.hasOwnProperty("type") ||
                data.hasOwnProperty("license_plate") ||
                data.hasOwnProperty("registration_country") ||
                data.hasOwnProperty("download_methods") ||
                data.hasOwnProperty("manufacture_year") ||
                data.hasOwnProperty("company") ||
                data.hasOwnProperty("transport")
            ) {
                appendAlert(
                    "#main-data-message",
                    "danger",
                    Object.values(data)[0]
                );
            } else {
                appendAlert(
                    "#capacity-data-message",
                    "danger",
                    Object.values(data)[0]
                );
            }
        }
    }

    $('#save').on('click', async function () {

        let formData = makeFormData()

        await fetch(url + "/transport-equipment/", {
            method: "POST",
            body: formData,
        }).then(async (response) => {
            callback(response)
        })
    })


    $('#edit').on('click', async function () {

        let formData = makeFormData()
        formData.append('_method', 'PUT')

        await fetch(url + "/transport-equipment/" + $(this).attr('data-id'), {
            method: 'POST',
            body: formData
        }).then(async response => {
            callback(response)
        })
    })

}))


