import {getLocalizedText} from '../../localization/getLocalizedText.js'

export function markupActionInConfirmed(dataActions,customDataTns) {
const url =window.location.origin;

    return dataActions.map(({id,name,address,time,tns},i)=>
    `<div class="action-with-tns border rounded mb-2 family" data-id=${id}>
    <div class="item-action  border-bottom p-1 px-2 parent" style="background-color: #F1F1F2">
        <div class="d-flex justify-content-between mb-1">
            <div class="d-flex align-items-center">
                <h4 class="m-0 "> ${i+1}. ${getNameAction(name) }</h4>
            </div>
            <div class="btns-in-action ">
                <div class="d-flex">
                   
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
${ tns.length> 0 ? customDataTns.filter((item)=>tns.includes(item.id)).map((item,index)=>`<div   class=" border-bottom  px-2 d-flex align-items-start child"   style="padding-bottom: 8px;padding-top:8px">
<div class="flex-grow-1" style="margin-left:5px">
    <div class="d-flex justify-content-between" style="margin-bottom: 4px">
        <p class="m-0 fw-5">${index+1}. ${getLocalizedText("cn")} №${item.number}</p>
        <div></div>
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




