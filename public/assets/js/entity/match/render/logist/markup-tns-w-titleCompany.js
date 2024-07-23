import {getLocalizedText} from '../../localization/getLocalizedText.js'

export function markupTnsWithTitleCompany(groupByCompany,dataActions) {

const url =window.location.origin
    function isSequenceValid(tnId, actionName) {

        const actions = dataActions.reduce((acc, action) => {
            if (action.tns.includes(tnId)) {
                acc.push(action.name);
            }
            return acc;
        }, []);
      
        if (actionName === 'loading') {
            return actions[0] === 'loading';
        } else if (actionName === 'unloading') {
            return actions[actions.length - 1] === 'unloading';
        } else if (actionName === 'moving') {
            if (actions.length < 3) {
                return false;
            }
            return actions[0] === 'loading' && actions[actions.length - 1] === 'unloading';
        }
    
        return false;
    }
    return groupByCompany.map(
        ({ name, arr,idCompany }) => `<div class="pb-2 border-bottom mb-1">
    <h5 class="mt-0 fw-semibold">${name} (${arr.length}) </h5>
    <div style="" class="accordion family-other" id="accordion-parent-${idCompany}">
     ${arr.map(
         ({
             id,
             number,
             company,
             price,
             pallets,
             weight,
             typeCargo,
             startPoint,
             endPoint,
             action,
         },i) =>`<div class="accordion-item item-tns-w-company border-0 child-other" data-id="${id}">
     <div class="accordion-header rounded" id="accordion-parent-${idCompany}">
         <div class="accordion-button rounded bg-c-transparent fs-5" style="padding: 6px 10px 6px 0  !important"
             type="button" data-bs-toggle="collapse" data-bs-target="#accordion-tn-${id}" aria-expanded="true" aria-controls="accordion-tn-${id}">
             <div class="w-100 mr-1 d-flex  align-items-center justify-content-between accordion-header-content">
                 <div><img class="icon-drop" style="margin:7px" src="${url}/assets/icons/drag-drop.svg" alt="drag-drop"> ${i+1}. ${getLocalizedText("cn")} №${number} </div>
                 <div class="data-w-status d-flex">
                     <span class="alert-${action.loading.length === 0 ? 'danger' : ( !isSequenceValid(id, 'loading') ? 'primary'  : 'success')} rounded pop-parent" style="padding:8px 9px;margin-right:8px">
                         <span class="pop-child">
                       <p class="fw-semibold">${getLocalizedText("loading")} </p>
                       ${action.loading.length>0 ? `<p class="mb-1 text-secondary">${getLocalizedText("step_carrier_location")}</p>
                       ${action.loading.map((idAction,i)=>` <p class="mb-0 text-secondary"><span class="fw-semibold text-body">${parseFloat(dataActions.findIndex(({id}) => id === idAction)) + 1}.</span> ${dataActions.find((item)=>item.id==idAction).address}</p> `).join('')} `:`<p>${getLocalizedText("not_actions")} </p>`}
                               </span> <img src="${url}/assets/icons/direction-flight-${action.loading.length === 0 ? 'danger' : ( !isSequenceValid(id, 'loading') ? 'primary'  : 'success')}.svg" alt="drag-drop"></span>
                     <span class="alert-${action.moving.length === 0 ? 'danger' : ( !isSequenceValid(id, 'moving') ? 'primary'  : 'success')} rounded pop-parent" style="padding:8px 9px;margin-right:8px">
                         <span class="pop-child">
                             <p class="fw-semibold">${getLocalizedText("moving")}</p>
                             ${action.moving.length>0 ? `<p class="mb-1 text-secondary">
                             ${getLocalizedText("step_carrier_carrier")}</p>
                                 ${action.moving.map((idAction,i)=>` <p class="mb-0 text-secondary"><span class="fw-semibold text-body">${parseFloat(dataActions.findIndex(({id}) => id === idAction)) + 1}.</span> ${dataActions.find((item)=>item.id==idAction).address}</p> `).join('')} `:`<p>${getLocalizedText("not_actions")} </p>`}
                                  </span> <i data-feather="truck"></i></span>
                     <span class="alert-${action.unloading.length === 0 ? 'danger' : ( !isSequenceValid(id, 'unloading') ? 'primary'  : 'success')} rounded pop-parent" style="padding:8px 9px;margin-right:8px">
                         <span class="pop-child">
                             <p class="fw-semibold">${getLocalizedText("unloading")}  </p>
                             ${action.unloading.length>0 ? ` <p class="mb-1 text-secondary">${getLocalizedText("step_carrier_location")}</p>
                             ${action.unloading.map((idAction,i)=>` <p class="mb-0  text-secondary"><span class="fw-semibold text-body">${parseFloat(dataActions.findIndex(({id}) => id === idAction)) + 1}.</span> ${dataActions.find((item)=>item.id==idAction).address}</p> `).join('')} `:`<p>${getLocalizedText("not_actions")} </p>`}
                               </span> <img style="transform: rotatey(180deg)" src="${url}/assets/icons/direction-flight-${action.unloading.length === 0 ? 'danger' : ( !isSequenceValid(id, 'unloading') ? 'primary'  : 'success')}.svg" alt="drag-drop"></span>
                     <button type="button" class="d-inline btn btn-icon btn-flat-primary m-0 icon-plus" data-idtn=${id}> <i class="text-primary" data-feather="plus"></i>  </button>
                 </div>
             </div>
         </div>
     </div>
     <div id="accordion-tn-${id}" class="accordion-collapse collapse " aria-labelledby="headingOne"  data-bs-parent="#accordion-tn-${id}">
         <div class="accordion-body px-3 py-0">
             <p style="margin-bottom:4px">${company} ${price} ${getLocalizedText("uah")}  </p>
             <p>(${pallets} ${getLocalizedText("pal")} / ${weight} ${getLocalizedText("kg")}) ${typeCargo} </p>
             <div class="d-flex">
                 <div class="mr-1" style="margin-top:6px"><img src="${url}/assets/icons/timeline5.svg"alt=""></div>
                 <div class="">
                     <div>
                         <p class="my-0">${startPoint.address}</p>
                         <p style="color:#A5A3AE;margin-bottom:4px"> ${startPoint.date}</p>
                     </div>
                     <div>
                         <p class="my-0">${endPoint.address}</p>
                         <p style="color:#A5A3AE;">${endPoint.date}</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>`
     ).join('')}
    </div>
    </div>`
    );
}



