<script>
    function prepareFieldData(source) {
        let result = {fields: [], columns: [], listSourceArray: []}

        for (let key in source) {
            if (source.hasOwnProperty(key)) {
                let item = source[key];
                result.fields.push({name: 'data->'+key, type: 'string'});
                result.columns.push({
                    minwidth: "150",
                    dataField: 'data->'+key,
                    align: 'left',
                    cellsalign: 'left',
                    text: item.name,
                });
                result.listSourceArray.push({label: item.name, value: 'data->'+key, checked: true});
            }
        }

        return result;
    }

    let settings = {!!$documentType->settings !!};

    if (settings['fields'].hasOwnProperty('nomenclature')) {
        let fieldsDataType = JSON.parse(JSON.stringify(settings['fields']['nomenclature']));
        var fieldData = prepareFieldData(fieldsDataType);
    }
    if (settings['fields'].hasOwnProperty('container')) {
        let containerFieldsData = JSON.parse(JSON.stringify(settings['fields']['container']));
        var containerData = prepareFieldData(containerFieldsData);
    }

    if (settings['fields'].hasOwnProperty('services')) {
        let serviceFieldsData = JSON.parse(JSON.stringify(settings['fields']['services']));
        var serviceData = prepareFieldData(serviceFieldsData);
    }

    let relatedDocuments = {!! json_encode($relatedDocumentsArray) !!};

</script>
