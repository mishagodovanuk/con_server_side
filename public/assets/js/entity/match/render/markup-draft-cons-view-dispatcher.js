// import {getLocalizedTextDispatcher} from '../localization/getLocalizedText_dispatcher.js'

// export function markupDraftConsolidationViewDispatcher(
//     number,
//     createdDate,
//     createdTime,
//     status,
//     startPoint,
//     endPoint,
//     sendingDate,
//     deliveryDate,
//     dispatcher
// ) {
//     return `<div class="d-flex gap-1 align-items-center pb-2">
//     <div class="">
//         <h5 class="mb-0">${getLocalizedTextDispatcher('draft_view_cons')} № <span id="tn-number-value">${number}</span></h5>
//     </div>
// </div>
// <div class="">
//     <p class="fw-semibold">${getLocalizedTextDispatcher('draft_view_data_plan')}</p>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_status')}</p>
//     </div>
//     <div class="col-7">
//         <span class="alert alert-secondary" style="padding : 2px 10px !important;">${status}</span>
//     </div>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_create')}</p>
//     </div>
//     <div class="col-7">
//         <p class="">${createdDate} о ${createdTime} <span class="match-yellow-text">${dispatcher}</span></p>
//     </div>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_type')}</p>
//     </div>
//     <div class="col-7">
//         <p class="match-yellow-text">Top-up
//         </p>
//     </div>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_route')}</p>
//     </div>
//     <div class="col-7">
//         <p>${startPoint} - ${endPoint}</p>
//     </div>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_duration')}</p>
//     </div>
//     <div class="col-7">
//         <p class="">${sendingDate} - ${deliveryDate}</p>
//     </div>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_participants')}</p>
//     </div>
//     <div class="col-7">
//         <p class="match-yellow-text">LLC "Kormotech"</p>
//         <p class="match-yellow-text">LLC "Svitoch"</p>
//     </div>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_points')}</p>
//     </div>
//     <div class="col-7">
//         <p class="">2</p>
//     </div>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_unload_points')}</p>
//     </div>
//     <div class="col-7">
//         <p class="">2</p>
//     </div>
// </div>
// <div class="">
//     <p class="fw-semibold">${getLocalizedTextDispatcher('draft_view_cargo')}</p>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_cargo_type')}</p>
//     </div>
//     <div class="col-7">
//         <p>Food</p>
//     </div>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_pallets')}</p>
//     </div>
//     <div class="col-7">
//         <p>35/33</p>
//     </div>
// </div>
// <div class="row">
//     <div class="col-5">
//         <p>${getLocalizedTextDispatcher('draft_view_weight')}</p>
//     </div>
//     <div class="col-7">
//         <p>23 400/20 000 ${getLocalizedTextDispatcher('kg')}</p>
//     </div>
// </div>
// <div>
//     <p class="fw-semibold">${getLocalizedTextDispatcher('draft_view_comment')}</p>
// </div>
// <div class="row">
// <div class="col-1">
// <img src=${window.location.origin}/assets/images/match-avatar.svg alt=""
//     style="width:26px;height:26px;border-radius:50%">
// </div>
// <div class="col-11">
//     <p class="match-yellow-text">Mark Doe</p>
//     <p class="">Yarych asked for top-up, we need to deliver the cookies to ATB in time, the deadline is coming up!</p>
// </div>
// </div>
// `;
// }
