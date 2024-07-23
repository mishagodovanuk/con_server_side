export function markupRvItemRoute(route) {
    return route.map(({type,city,date,max_points,radius},i)=>`    
    <div class="row">
        <div class="col-1">
            <div class="">
                <div class=""><img src="${window.location.origin}/assets/icons/${i !== route.length - 1 ? 'timeline2':'timeline' }.svg" /></div>
            </div>
        </div>
        <div class="col-7" style="display: flex; flex-direction: column; gap: 8px;">
            <div class="fw-5 text-black"><span>${city} (${type})</span></div>
            <div class=""><span>${city}</span></div>
            <div class=""><span>${date}</span></div>
        </div>
        <div class="col-4">
            <p class="fw-5 color-l-gray text-end">+${radius} km (max ${max_points} points)</p>
        </div>
    </div>
`)
}
  