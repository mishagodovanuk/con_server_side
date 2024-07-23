$(document).ready(function () {

    const uriCreate = '/transport-planning'

    const createTransportPlanning = $('#create-transport-planning')

    let csrf = document.querySelector('meta[name="csrf-token"]').content;
    let url = window.location.origin

    let addNewGoodsInvoicesItem = $("#add-new-goods-invoices-item");
    let addTransportRequestItem = $('#add-new-transport-request-item')


    function sendRequest(url, uri, method, data, callback) {
        const apiUrl = url + uri;
        const requestOptions = {
            method: method,
            body: data,
        };
        fetch(apiUrl, requestOptions)
            .then(response => response.json())
            .then(data => {
                console.log('Success', data);
                callback()
                // You can perform further actions here after successful creation

            })
            .catch(error => {
                console.error('Error :', error);
                // Handle errors here
            });
    }

    let redirect = function () {
        window.location.href = window.location.origin + '/transport-planning';
    }

    function validateData() {
        const fieldsToValidate = [
            {id: 'comment', message: 'Будь ласка, заповніть поле коментар'},
            {id: 'select-driver', message: 'Будь ласка, заповніть поле водія'},
            {id: 'price', message: 'Будь ласка, заповніть поле ціни рейсу'},
            {id: 'select-payer', message: 'Будь ласка, заповніть поле платника'},
            {id: 'select-equipment', message: 'Будь ласка, заповніть поле додаткового обладнання'},
            {id: 'select-transport', message: 'Будь ласка, заповніть поле транспорту'},
            {id: 'select-company-transporter', message: 'Будь ласка, заповніть поле компанії перевізник'},
            {id: 'select-company-provider', message: 'Будь ласка, заповніть поле компанії постачальника'},

            // Додайте інші поля для перевірки
        ];

        let isValid = true;
        let errorMessage = '';

        fieldsToValidate.forEach(function (field) {
            const id = field.id; // Отримуємо ID-шник поля
            const value = $('#' + id).val(); // Отримуємо значення поля
            if (!value) {
                errorMessage = field.message;
                isValid = false;
                return false; // Зупиняємо цикл при першому незаповненому полі
            }
        });

        if (!isValid) {
            $('#validate-error').html('<div class="alert alert-danger">' + errorMessage + '</div>');
        } else {
            $('#validate-error').empty();
        }

        return isValid;
    }

    function getData() {
        let companyProvider = $('#select-company-provider').val()
        let companyTransporter = $('#select-company-transporter').val()
        let transport = $('#select-transport').val()
        let equipment = $('#select-equipment').val()
        let payer = $('#select-payer').val()
        let price = $('#price').val()
        let driver = $('#select-driver').val()
        const pdvCheckbox = $('#pdv');
        let pdv = pdvCheckbox.is(':checked') ? 1 : 0;
        let comment = $('#comment').val()
        let formData = new FormData()

        formData.append('_token', csrf)
        formData.append('three_pl',+$('#3pl-auto').prop('checked'))
        formData.append('auto_search',+$('#auto-search').prop('checked'))
        formData.append('init_transport',+$('#init-auto').prop('checked'))
        formData.append('company_provider_id', companyProvider)
        formData.append('company_carrier_id', companyTransporter)
        formData.append('transport_id', transport)
        //formData.append('documents', JSON.stringify(documents))
        formData.append('additional_equipment_id', equipment)
        formData.append('payer_id', payer)
        formData.append('driver_id', driver)
        formData.append('price', price)
        formData.append('with_pdv', pdv)
        formData.append('comment', comment)

        let documents = [];

        let docElements = $('#sortable').find('.goods-invoices-item');

        docElements.each((key, item) => {

            console.log($(item).find('#loading-date').val())

            let loadingDate = $(item).find('#loading-date').val();
            let unloadingDate = $(item).find('#loading-date').val();

            let obj = {
                id: item.dataset.goodsInvoiceId,
                download_start: `${loadingDate} ${$(item).find('#loading-start-at').val()}`,
                download_end: `${loadingDate} ${$(item).find('#loading-end-at').val()}`,
                unloading_start: `${unloadingDate} ${$(item).find('#unloading-start-at').val()}`,
                unloading_end: `${unloadingDate} ${$(item).find('#unloading-end-at').val()}`,
            };

            documents.push(obj);
        });

        formData.append('documents', JSON.stringify(documents))

        return formData
    }

    createTransportPlanning.on("click", function () {
        if (validateData()) {
            sendRequest(url, uriCreate, "POST", getData(), redirect)
        }
    });


    $('#tabs').bind('selected', function (event) {
        toggleButtons()
    });

    function toggleButtons() {

        if ($('#schedule-tab').hasClass('jqx-tabs-title-selected-top')) {
            addNewGoodsInvoicesItem.removeClass('d-none');
            addTransportRequestItem.addClass('d-none');
        } else if ($('#transport-request-tab').hasClass('jqx-tabs-title-selected-top')) {
            addNewGoodsInvoicesItem.addClass('d-none');
            addTransportRequestItem.removeClass('d-none');
        }
    }
})

