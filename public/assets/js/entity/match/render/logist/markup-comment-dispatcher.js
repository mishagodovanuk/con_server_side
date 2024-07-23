export function markupCommentDispatcher(data) {
    const { created_by, comment } = data;
    const url = window.location.origin;
    return `<div class="d-flex gap-1 pe-4">
<img src=${created_by.image_link} alt="${created_by.name}"
    style="width:26px;height:26px;border-radius:50%">
<div> <a href=${url + "/user/show/" + created_by.id} class="text-capitalize">${
        created_by.name
    }</a>
    <p  class="text-capitalize">${comment}</p>
</div>
</div>`;
}
