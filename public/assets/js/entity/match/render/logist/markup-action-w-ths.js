import {getLocalizedText} from '../../localization/getLocalizedText.js'

export function markupActionWithTns(dataActions,customDataTns) {
const url =window.location.origin
    return dataActions.map(({id,name,address,time,tns},i)=>
    `<div class="action-with-tns border rounded mb-2 family" data-id=${id}>
    <div class="item-action  border-bottom p-1 px-2 parent" style="background-color: #F1F1F2">
        <div class="d-flex justify-content-between mb-1">
            <div class="d-flex align-items-center"> <img src="${url}/assets/icons/drag-drop.svg" alt="drag-drop">
                <h4 class="m-0 "> <span class="number-action"></span>. ${getNameAction(name) }</h4>
            </div>
            <div class="btns-in-action ">
                <div class="d-flex">
                    <div class="mr-1" id=""><i data-feather='copy' style="cursor: pointer; transform: scale(1.2);"></i> </div>
                    <div class="mr-1 update-action" data-id=${id}><i data-feather='edit' style="cursor: pointer; transform: scale(1.2);"></i> </div>
                    <div class="remove-action" data-id=${id}> <a class="text-danger" href="#"><i data-feather='trash-2'  style="cursor: pointer; transform: scale(1.2);"></i></a> </div>
                </div>
                <div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center"> <img src="${url}/assets/icons/direction-flight.svg" alt="direction">
                <p class=" fw-5 my-0 mx-1">${address}</p>
            </div>
            <div class="d-flex align-items-center"> <img src="${url}/assets/icons/calendar-chosen.svg" alt="">
                <p class=" fw-5 my-0" style="margin: 0 5px">${time.date}</p> <img src="${url}/assets/icons/clock.svg" alt="">
                <p class=" fw-5 my-0" style="margin: 0 5px">${time.period}</p>
            </div>
        </div>
    </div>
${ tns.length> 0 ? customDataTns.filter((item)=>tns.includes(item.id)).map((item,index)=>`<div   class="item-tn-in-action border-bottom  px-2 d-flex align-items-start child bg-white" data-idtn=${item.id}  style="padding-bottom: 8px;padding-top:8px">
<img class="flex-shrink-0 icon-drop" src="${url}/assets/icons/drag-drop.svg" alt="drag-drop">
<div class="flex-grow-1" style="margin-left:5px">
    <div class="d-flex justify-content-between" style="margin-bottom: 4px">
        <p class="m-0 fw-5"><span class="number-tn-in-action"></span>. ${getLocalizedText("cn")} №${item.number}</p>
        <div class="icon-delete remove-tn-in-action" data-idtn=${item.id} ><a class="text-danger" href="#"><i data-feather='trash-2'
                    style="cursor: pointer; transform: scale(1.2);"></i></a> </div>
    </div>
    <div class="">
        <p class="my-0 mx-1">${item.company}</p>
        <p class="my-0 mx-1">(${item.pallets}${getLocalizedText("pal")}/${item.weight}${getLocalizedText("kg")}) ${item.typeCargo}</p>
    </div>
</div>
</div>`).join('') : ''} 
    </div>`)
}

function getNameAction(name) {
    const selectedLanguage = localStorage.getItem('Language');
    let fullName = '';
    switch (name) {
        case 'loading':
            fullName = selectedLanguage==='ua' ? 'Завантаження' :"Loading";
            break;
        case 'moving':
            fullName = selectedLanguage==='ua' ? 'Переміщення' :"Moving";
            break;
        case 'unloading':
            fullName = selectedLanguage==='ua' ? 'Розвантаження' :"Unloading";
            break;
    }

    return fullName;
}



