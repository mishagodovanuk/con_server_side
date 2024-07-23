// export function selectDictionary(url, selector, selectedValue = null, search = true) {
//     // Виконуємо початковий запит із завантаженням опцій
//     initialLoad(url, selector);
    
//     const dictionaryUrls = {
//         'adr': ['[data-dictionary="adr"]', '#adr'],
//         'cell_type': ['[data-dictionary="cell_type"]'],
//         'cell_status': ['[data-dictionary="cell_status"]'],
//         'company_status': ['[data-dictionary="company_status"]'],
//         'country': ['[data-dictionary="country"]', '#country', '#country_2', '#u_country', '#producerСountry'],
//         'download_zone': ['[data-dictionary="download_zone"]'],
//         'measurement_unit': ['[data-dictionary="measurement_unit"]', '#unit_sku'],
//         'package_type': ['[data-dictionary="package_type"]', '#add_paking_name'],
//         'position': ['[data-dictionary="position"]'],
//         'storage_type': ['[data-dictionary="storage_type"]'],
//         'transport_brand': ['[data-dictionary="transport_brand"]', '#mark'],
//         'transport_download': ['[data-dictionary="transport_download"]', '#download_methods', '#download_method'],
//         'transport_kind': ['[data-dictionary="transport_kind"]', '#category'],
//         'transport_type': ['[data-dictionary="transport_type"]', '#type'],
//         'additional_equipment_brand': ['#mark-equipment'],
//         'additional_equipment_type': ['#type-equipment'],
//         'warehouse_type': ['[data-dictionary="warehouse_type"]'],
//         'company': ['[data-dictionary="company"]', '#company', '#company_owner', '#producer'],
//         'warehouse': ['[data-dictionary="warehouse"]'],
//         'transport': ['[data-dictionary="transport"]'],
//         'additional_equipment': ['[data-dictionary="additional_equipment"]'],
//         'user': ['[data-dictionary="user"]'],
//         'document_order': ['[data-dictionary="document_order"]'],
//         'document_goods_invoice': ['[data-dictionary="document_goods_invoice"]'],
//         'currencies': ['[data-dictionary="currencies"]', '#currency', '#currency_u'],
//         'driver': ['#driver'],
//         'goods_category': ['#category_sku'],
//         'container_type': ['#type_container'],
//         'service_category': ['#select-service-category'],
//     };

//     function initialLoad(url, selectElementSelector) {
//         fetch(url)
//             .then(response => response.json())
//             .then(data => {
//                 const selectElement = document.querySelector(selectElementSelector);
//                 if (search) {
//                     selectElement.innerHTML = ''; // Очищуємо список опцій перед додаванням нових
//                 }

//                 data.data.forEach(item => {
//                     const option = document.createElement('option');
//                     if (selectElementSelector === "#currency") {
//                         option.value = item.name;
//                     } else {
//                         option.value = item.id;
//                     }
//                     option.text = item.name;
//                     selectElement.appendChild(option);
//                 });
//                 if (search) {
//                     // Ініціалізуємо Select2 після завантаження початкових опцій
//                     initSelect2(selectElementSelector, selectedValue);
//                 } else {
//                     initSelect2NoSearch(selectElementSelector, selectedValue);
//                 }
//             })
//             .catch(error => {
//                 console.error('Помилка при отриманні даних: ', error);
//             });
//     }

//     function initSelect2(selectElementSelector, selectedValue) {
//         const $selectElement = $(selectElementSelector);
     
//         const getUrl = () => {
//             for (const [url, selectors] of Object.entries(dictionaryUrls)) {
//                 if (selectors.includes(selectElementSelector)) {
//                     return `${window.location.origin}/dictionary/${url}`;
//                 }
//             }
//             return '';
//         };
    
//         $selectElement.select2({
//             ajax: {
//                 url: getUrl,
//                 dataType: 'json',
//                 delay: 250,
//                 data: (params) => ({ query: params.term }),
//                 processResults: (data, params) => {
//                     params.page = 1;
    
//                     return {
//                         results: data.data.map(item => ({
//                             id: selectElementSelector === "#currency" ? item.name : item.id,
//                             text: item.name,
//                         })),
//                     };
//                 },
//                 cache: true,
//             },
//             placeholder: 'Пошук...',
//         });
    
//         if (selectedValue) {
//             $selectElement.html(`<option value="${selectedValue.id || selectedValue.name}" selected>${selectedValue.name}</option>`);
//             $selectElement.trigger('change');
//         } else {
//             $selectElement.val('').trigger('change');
//         }
//     }
    

//     function initSelect2NoSearch(selectElementSelector, selectedValue) {
//         const $selectElement = $(selectElementSelector);
    
//         const getUrl = () => {
//             const foundEntry = Object.entries(dictionaryUrls).find(([url, selectors]) => selectors.includes(selectElementSelector));
//             return foundEntry ? `${window.location.origin}/dictionary/${foundEntry[0]}` : '';
//         };
    
//         $selectElement.select2({
//             minimumResultsForSearch: Infinity,
//             ajax: {
//                 url: getUrl,
//                 dataType: 'json',
//                 delay: 250,
//                 data: (params) => ({ query: params.term }),
//                 processResults: (data, params) => {
//                     params.page = 1;
    
//                     return {
//                         results: data.data.map(item => ({
//                             id: selectElementSelector === "#currency" ? item.name : item.id,
//                             text: item.name,
//                         })),
//                     };
//                 },
//                 cache: true,
//             },
//             placeholder: 'Пошук...',
//         });
    
//         if (selectedValue) {
//             if (selectElementSelector === '#download_method' || selectElementSelector === '#download_methods') {
//                 const selectedValuesForDownloadMethod = [selectedValue];
//                 selectedValuesForDownloadMethod.forEach((selectedValue) => {
//                     $selectElement.append(`<option value="${selectedValue.id}" selected>${selectedValue.name}</option>`);
//                 });
//             } else {
//                 $selectElement.html(`<option value="${selectedValue.id}" selected>${selectedValue.name}</option>`);
//             }
//             $selectElement.trigger('change');
//         } else {
//             $selectElement.val('').trigger('change');
//         }
//     }
    
// }

