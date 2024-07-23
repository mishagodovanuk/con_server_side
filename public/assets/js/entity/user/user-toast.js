$(document).ready(function () {

    if (localStorage.hasOwnProperty('email') && localStorage.hasOwnProperty('password')) {
        var email = localStorage.email
        var password = localStorage.password
        $('.toast').css('display', 'block')
        $('#alert-body')[0].innerHTML = "<p>Відправити пароль на пошту користувача <b>" + email + "</b> ?</p>" +
            "<p>" + "Пароль - <b>" + password + "</b></p>"
        localStorage.removeItem('email')
        localStorage.removeItem('password')
    }

    $('#copy').on('click', function () {

        let temp = document.getElementById('temp');
        temp.value = "Email - " + email + "\n" + "Пароль - " + password;
        temp.select();
        document.execCommand("copy")
    })
    $('#send_email').on('click', function () {
        $.ajax({
            url: '/user/send-password',
            type: 'POST',
            data: {
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                email: email,
                password: password
            },
           })
    })
});
