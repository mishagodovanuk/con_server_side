// import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

// export function markupFtlModalInfo(
//     upload,
//     offload,
//     startDate,
//     endDate,
//     tnParticipants,
//     uploadingQuantity,
//     offloadingQuantity,
//     type,
//     totalPallets,
//     totalWeight,
// ) {
//     return `
//     <div class="">
//     <div class="">
//         <p class="fw-semibold match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_data_plan')}</p>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_type')} </p>
//         </div>
//         <div class="col-8">
//             <p class="match-modals-text-color">Top-up</p>
//         </div>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_route')}</p>
//         </div>
//         <div class="col-8">
//             <p class="match-modals-text-color">${upload} - ${offload}</p>
//         </div>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_date')} </p>
//         </div>
//         <div class="col-8">
//             <p class="match-modals-text-color">${startDate} - ${endDate}</p>
//         </div>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_participants')}</p>
//         </div>
//         <div class="col-8">
//             <div class="">
//             ${tnParticipants.map(
//                 (el) => `<p class="match-yellow-text">${el.suplier}</p>`
//             ).join('')}
//             </div>
//         </div>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_price')}</p>
//         </div>
//         <div class="col-8">
//             <div class="">
//                 ${tnParticipants.map(
//                     (el) =>
//                         `<p class="match-modals-text-color">${el.suplier} - ${el.price} UAH</p>`
//                 ).join('')}
//             </div>
//         </div>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_points')}</p>
//         </div>
//         <div class="col-8">
//             <p class="match-modals-text-color">${uploadingQuantity}</p>
//         </div>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_points_unload')}</p>
//         </div>
//         <div class="col-8">
//             <p class="match-modals-text-color">${offloadingQuantity}</p>
//         </div>
//     </div>
//     <div class="">
//         <p class="fw-semibold match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_cargo')}</p>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_cargo_type')}</p>
//         </div>
//         <div class="col-8">
//             <p class="match-modals-text-color">${type}</p>
//         </div>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_pallets')}</p>
//         </div>
//         <div class="col-8">
//             <p class="match-modals-text-color">${totalPallets}/33</p>
//         </div>
//     </div>
//     <div class="row">
//         <div class="col-4">
//             <p class="match-modals-text-color">${getLocalizedTextDispatcher('ftl_modal_weight')}</p>
//         </div>
//         <div class="col-8">
//             <p class="match-modals-text-color">${totalWeight}/20000 ${getLocalizedTextDispatcher('kg')}</p>
//         </div>
//     </div>
//     </div>
//     `;
// }
