// export function geoSetting(url, selector, selectedValue = null) {
//     console.log('1', selectedValue)

//     // Виконуємо початковий запит із завантаженням опцій
//     initialLoad(url, selector);

//     function initialLoad(url, selectElementSelector) {
//         fetch(url)
//             .then(response => response.json())
//             .then(data => {
//                 const selectElement = document.querySelector(selectElementSelector);
//                 selectElement.innerHTML = ''; // Очищуємо список опцій перед додаванням нових

//                 data.data.forEach(item => {
//                     const option = document.createElement('option');
//                     option.value = item.id;
//                     option.text = item.name;
//                     selectElement.appendChild(option);
//                 });

//                 // Ініціалізуємо Select2 після завантаження початкових опцій
//                 initSelect2(selectElementSelector, selectedValue);
//             })
//             .catch(error => {
//                 console.error('Помилка при отриманні даних: ', error);
//             });
//     }

//     function initSelect2(selectElementSelector, selectedValue) {
//         const $selectElement = $(selectElementSelector);
//         // console.log(selectedValue)

//         $selectElement.select2({
//             ajax: {
//                 url: function () {
//                     if (selectElementSelector === '#street') {
//                         return `${window.location.origin}/address/street`
//                     } else if (selectElementSelector === '[data-dictionary="street"]') {
//                         return `${window.location.origin}/address/street`
//                     } else if (selectElementSelector === '#street_2') {
//                         return `${window.location.origin}/address/street`
//                     } else if (selectElementSelector === '#u_street') {
//                         return `${window.location.origin}/address/street`
//                     } else {
//                         return `${window.location.origin}/address/settlement`
//                     }
//                 },
//                 dataType: 'json',
//                 delay: 250,
//                 data: function (params) {
//                     return {
//                         query: params.term, // пошуковий запит
//                         page: params.page
//                     };
//                 },
//                 processResults: function (data, params) {
//                     params.page = params.page || 1;

//                     return {
//                         results: data.data.map(item => ({
//                             id: item.id,
//                             text: item.name,
//                         })),
//                         pagination: {
//                             more: params.page * 30 < data.total_count
//                         }
//                     };
//                 },
//                 cache: true
//             },
//             placeholder: 'Пошук...',
//         })

//         if (selectedValue !== null) {
//             console.log('selectedValue', selectedValue)
//             $selectElement.html(`<option value="${selectedValue.id}" selected>${selectedValue.name}</option>`);
//             // Trigger the change event to update Select2
//             $selectElement.trigger('change');
//         } else {
//             $selectElement.val("").trigger('change');
//         }

//     }
// }
