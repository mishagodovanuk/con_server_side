$("#jqxLoader").jqxLoader({width: 250, height: 150, autoOpen: true});

// Затримка для приховання лоадера після ініціалізації jqxTabs
setTimeout(function () {
    $('#jqxLoader').jqxLoader('close');
    $('#table-loader').removeClass("invisible")
}, 500); // Задайте відповідну затримку, залежно від складності завантаження

