import {getLocalizedText} from '../../localization/getLocalizedText.js'

export function markupTnChldForAction(item) {
    const url =window.location.origin
return `<div class="item-tn-in-action border-bottom  px-2 d-flex align-items-start child bg-white" data-idtn=${item.id} style="padding-bottom: 8px;padding-top:8px">
<img class="flex-shrink-0 icon-drop" src="${url}/assets/icons/drag-drop.svg" alt="drag-drop">
<div class="flex-grow-1" style="margin-left:5px">
    <div class="d-flex justify-content-between" style="margin-bottom: 4px">
        <p class="m-0 fw-5"><span class="number-tn-in-action"></span>. ${getLocalizedText("cn")} №${item.number}</p>
        <div class="icon-delete remove-tn-in-action" data-idtn=${item.id}><a class="text-danger" href="#"><i data-feather='trash-2'
                    style="cursor: pointer; transform: scale(1.2);"></i></a> </div>
    </div>
    <div class="">
        <p class="my-0 mx-1">${item.company}</p>
        <p class="my-0 mx-1">(${item.pallets}${getLocalizedText("pal")}/${item.weight}${getLocalizedText("kg")}) ${item.typeCargo}</p>
    </div>
</div>
</div>`

}
