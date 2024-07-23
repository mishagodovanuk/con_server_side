function sendRequest(url) {
    let settings = getSettings();
    console.log(settings);
    if (settings) {
        let formData = new FormData();
        formData.append("_token", csrf);
        formData.append("name", $("#document-type-name").val());
        formData.append("settings", JSON.stringify(settings));
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                window.location.href =
                    window.location.origin + "/sku/";
            },
            error: function (error) {
                alert(error.responseJSON.message);
            },
        });
    }
}

$("#draft_save").on("click", function () {
    sendRequest(window.location.origin + "/sku/draft");
});

$("#save").on("click", function () {
    sendRequest(window.location.origin + "/sku");
});
