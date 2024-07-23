$((function () {
    let csrf = document.querySelector('meta[name="csrf-token"]').content;
    let url = window.location.origin
    let isDriver = false
    let driving_license, health_book
    let graphic = {}

    function sendRequest(uri, formData, selector, callback) {
        fetch(url + uri, {
            method: 'POST',
            body: formData
        }).then(response => response = response.json())
            .then(data => {
                if (Object.keys(data)[0] === 'success') {
                    appendAlert(selector, 'success', data.success)

                    callback && callback()

                } else {

                    appendAlert(selector, 'danger', Object.values(data.errors)[0])
                }
            })

    }

    function appendAlert(selector, type, message) {
        $(selector).each(function () {
            $(this)[0].innerHTML = null;
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
            $(this).append(block)// Використовуємо clone() для створення копії блоку
        });

    }

    $("#account-reset").on("click", (function () {
        $.ajax({
            url: url + '/user/delete-avatar/' + user_id,
            method: 'post',
            data: {_token: csrf},
            success: function () {
                location.reload()
            }
        });
    }))

    $('#account-upload').on('change', function () {

        const size =
            (this.files[0].size / 1024 / 1024).toFixed(2);

        if (size > 0.8) {
            $("#account-upload").val('');
            alert("Файл повинен мати розмір не більше 800kB");
        } else {
            let formData = new FormData()
            formData.append('_token', csrf)
            formData.append('avatar', $("#account-upload")[0].files[0])
            $.ajax({
                url: url + '/user/change-avatar/' + user_id,
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    location.reload()
                }
            });
        }
    });

    $('#generate-code').click(function () {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        for (var i = 0; i < 16; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        $('#code').val(text)
    })

    $('#position').on('change', function () {
        if ($(this).find(':selected').val() === 'driver') {
            isDriver = true
            $('#driver_block').css('display', 'flex')
        } else {
            isDriver = false
            $('#driver_block').css('display', 'none')
        }
    })


    $('#change-password').click(function () {
        let formData = new FormData()
        formData.append('_token', csrf)
        //formData.append('login', $('#passwordEmail').val())
        formData.append('password', $('#old-password').val())
        formData.append('new_password', $('input[name="new_password"]').val())
        formData.append('confirm_password', $('input[name="confirm_password"]').val())
        callback = function () {
            $('input[name="password"]').val('')
            $('input[name="new_password"]').val('')
            $('input[name="confirm_password"]').val('')

        }
        sendRequest('/user/change-password/' + user_id, formData, '#change-password-message', callback)
        $("#edit_user_pass").modal('hide');
    })

    $('#driving_license').on('change', function () {
        driving_license = $('#driving_license')[0].files[0]
    })

    $('#health_book').on('change', function () {
        health_book = $('#health_book')[0].files[0]
    })


    function schedule() {
        for (let i = 0; i < 7; i++) {
            if ($('#' + days[i] + '-check')[0].checked) {
                graphic[days[i]] = 'holiday'
            } else {
                let graphicArray = []
                for (let j = 0; j < 4; j++) {
                    graphicArray[j] = $('#' + days[i] + '-' + (j + 1)).val()

                }
                graphic[days[i]] = graphicArray
            }

        }
    }

    $('#save').click(function () {
        if (checkHoursInSchedule('.two-input-for-schedule')) {
            return
        }
        schedule()

        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('surname', $('#accountLastName').val())
        formData.append('name', $('#accountFirstName').val())
        formData.append('patronymic', $('#patronymic').val())
        formData.append('birthday', $('#birthday').val())
        formData.append('phone', $('#phone').val())
        formData.append('email', $('#accountEmail').val())
        formData.append('sex', $('#sex').val())
        formData.append('position', $('#position').val())
        formData.append('company_id', $('#company_id').val())
        formData.append('role', $('#role').val())
        formData.append('schedule', JSON.stringify(graphic))
        formData.append('conditions', JSON.stringify(conditions))
        formData.append('need_file', $('#need_file').val())
        if ($('#position').val() === 'driver') {
            formData.append('health_book_number', $('#health_book_number').val())
            formData.append('driving_license_number', $('#driving_license_number').val())
            formData.append('health_book_date', $('#health_book_date').val())
            formData.append('driver_license_date', $('#driver_license_date').val())
            formData.append('health_book', health_book)
            formData.append('driving_license', driving_license)
        }

        callback = function () {
            window.location.href = window.location.origin + '/user/all';
        }


        sendRequest('/user/account/update/' + user_id, formData, '.alert-data-message', callback)
    })


    function checkHoursInSchedule(blockClass) {
        let errorMessageShown = false;
        let hasErrors = false;
        $(blockClass).each(function () {
            const block = $(this);
            const inputs = block.find('input');

            if (parseInt(inputs.eq(0).val()) >= parseInt(inputs.eq(1).val()) && inputs.eq(0).val() !== "" && inputs.eq(1).val() !== "") {
                inputs.eq(0).addClass('border-error');
                inputs.eq(1).addClass('border-error');
                if (!errorMessageShown) {
                    alert("Введені години в графіку не можуть бути однакові, або від‘ємні! ");
                    errorMessageShown = true;
                }
                hasErrors = true;
            }
        });
        return hasErrors;
    }

    $('.two-input-for-schedule').each(function () {
        const inputs = $(this).find('input');


        inputs.eq(0).on('input', function () {
            if (parseInt(inputs.eq(0).val()) < parseInt(inputs.eq(1).val())) {
                inputs.eq(0).removeClass('border-error');
                inputs.eq(1).removeClass('border-error');
            }
        });

        inputs.eq(1).on('input', function () {
            if (parseInt(inputs.eq(0).val()) < parseInt(inputs.eq(1).val())) {
                inputs.eq(0).removeClass('border-error');
                inputs.eq(1).removeClass('border-error');
            }
        });
    });


}))(user_id)

