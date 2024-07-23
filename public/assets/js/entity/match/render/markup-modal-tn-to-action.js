import {getLocalizedText} from '../localization/getLocalizedText.js'
export function markupModalTnToAction(item,customDataActions) {
    function isSequenceValid(tnId, actionName) {

        const actions = customDataActions.reduce((acc, action) => {
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

    const {id,
        number,
        company,
        price,
        pallets,
        weight,
        typeCargo,
        startPoint,
        endPoint,action
    } = item
    return `<div >
    <h2 class=" text-center">${getLocalizedText("cn")} № ${number}
 ${getLocalizedText("adding_cn_to_step")}</h2>
                    <p class="mb-2 text-center">${getLocalizedText("ading_cn_choose_action")}</p>
    
    
                    <div class="d-flex flex-column  mb-1 border rounded p-1" style="background-color:#F8F8F9">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="fw-5 mb-0"> ${getLocalizedText("add_cn_cn")} № ${number}</p>
                            <div class="d-flex">
                                <span class="alert-${action.loading.length === 0 ? 'danger' : ( !isSequenceValid(id, 'loading') ? 'primary'  : 'success')} rounded" style="padding:8px 9px;margin-right:8px">
                                    <img src="${window.location.origin}/assets/icons/direction-flight-${action.loading.length === 0 ? 'danger' : ( !isSequenceValid(id, 'loading') ? 'primary'  : 'success')}.svg" alt="drag-drop"></span>
                                <span class="alert-${action.moving.length === 0 ? 'danger' : ( !isSequenceValid(id, 'moving') ? 'primary'  : 'success')} rounded" style="padding:8px 9px;margin-right:8px">
                                    <i data-feather="truck"></i></span>
                                <span class="alert-${action.unloading.length === 0 ? 'danger' : ( !isSequenceValid(id, 'unloading') ? 'primary'  : 'success')} rounded" style="padding:8px 9px;margin-right:8px">
                                    <img style="transform: rotatey(180deg)"
                                    src="${window.location.origin}/assets/icons/direction-flight-${action.unloading.length === 0 ? 'danger' : ( !isSequenceValid(id, 'unloading') ? 'primary'  : 'success')}.svg" alt="drag-drop"></span>
    
                            </div>
                        </div>
                        <p class="mt-0">
                        ${company} ${price} ${getLocalizedText("uah")}
                        </p>
                        <p class="mt-0">
                            (${pallets} ${getLocalizedText("pal")}/ ${weight}
                            ${getLocalizedText("kg")}) ${typeCargo}
                        </p>
                        <div class="d-flex gap-1">
                            <div class=" d-flex flex-column  justify-content-between">
                                <p class="m-0" style="#A5A3AE">${startPoint.date}</p>
                                <p class="m-0" style="#A5A3AE">${endPoint.date}</p>
                            </div>
                            <div class="d-flex"><img src="${window.location.origin}/assets/icons/timeline3.svg" alt=""></div>
                            <div class="d-flex flex-column justify-content-between">
                                <p class="m-0">${startPoint.address}</p>
                                <p class="m-0">${endPoint.address}</p>
                            </div>
                        </div>
                    </div>
    </div>
    `
}