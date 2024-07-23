$(document).ready(function () {
    let url = window.location.origin;
    let csrf = document.querySelector('meta[name="csrf-token"]').content;
    let documentIds = JSON.parse(localStorage.getItem("documentIds")) || []; // Завантажуємо масив documentIds з localStorage або створюємо новий масив

    // Функція, яка перевіряє, чи documentId вже існує в масиві
    function isDocumentIdInArray(documentId) {
        return documentIds.includes(documentId);
    }

    $('#process_manually').click(async function (e) {
        e.preventDefault();

        if (!isDocumentIdInArray(documentId)) {
            $.ajax({
                url: url + `/leftovers/add/${documentId}`,
                type: "POST",
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-Token": csrf
                },
                success: function (data) {
                    console.log(data);
                    documentIds.push(documentId);
                    localStorage.setItem("documentIds", JSON.stringify(documentIds));
                    $('#process_manually').addClass("disabled");
                },
                error: function (error) {
                    alert(error.responseJSON.message);
                }
            });
        }
    });

    if (isDocumentIdInArray(documentId)) {
        $('#process_manually').addClass("disabled");
    }
});
