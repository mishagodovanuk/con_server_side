$(document).ready(function () {
    let url = window.location.origin;
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    $('#process_manually').click(async function (e) {
        e.preventDefault();

        $.ajax({
            url: url + `/leftovers/move/${documentId}`,
            type: "POST",
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-Token": csrf
            },
            success: function (data) {
                console.log(data)
            },
            error: function (error) {
                alert(error.responseJSON.message);
            }
        });
    });
});
