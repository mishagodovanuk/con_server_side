$(document).ready(function () {
    let url = window.location.origin;
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    $("#create-container").click(async function (e) {
        e.preventDefault();

        await fetch(url + `/containers`, {
            method: 'POST',
            body: getData(),
            headers: {
                "X-CSRF-Token": csrf
            },
        }).then(async (response) => {
            if (response.status === 200) {
            document.location.href = url + `/containers`;
            } else {
                let text = await response.text();
                addError(
                    $("#alert-error"),
                    $("form"),
                    text
                );
            }
      
        });
    });


    $("#create-container-draft").click(async function (e) {
        e.preventDefault();
        let formData = getData();
        formData.append('is_draft', 1);


        await fetch(url + `/containers`, {
            method: 'POST',
            body: formData,
            headers: {
                "X-CSRF-Token": csrf
            },
        }).then(async (response) => {
            if (response.status === 200) {
            document.location.href = url + `/containers`;
            } else {
                console.log('response', response)
                let text = await response.text();
     
                addError(
                    $("#alert-error"),
                    $("form"),
                    text
                );
            }
      
        });
    });

    $("#edit-container").click(async function (e) {
        e.preventDefault();
        let formData = getData();
        formData.append('_method', 'PUT');
        formData.append('is_draft', 0);

        await fetch(url + `/containers/${container.id}`, {
            method: 'POST',
            body: formData,
            headers: {
                "X-CSRF-Token": csrf
            },
        }).then(async (response) => {
            if (response.status === 200) {
            document.location.href = url + `/containers`;
            } else {
                let text = await response.text();
                addError(
                    $("#alert-error"),
                    $("form"),
                    text
                );
            }
      
        });
    });

    $("#edit-container-draft").click(async function (e) {
        e.preventDefault();
        let formData = getData();
        formData.append('_method', 'PUT');
        formData.append('is_draft', 1);


        await fetch(url + `/containers/${container.id}`, {
            method: 'POST',
            body: formData,
            headers: {
                "X-CSRF-Token": csrf
            },
        }).then(async (response) => {
            if (response.status === 200) {
            document.location.href = url + `/containers`;
            } else {
                let text = await response.text();
                addError(
                    $("#alert-error"),
                    $("form"),
                    text
                );
            }
      
        });
    });
});

function getData()
{
    let formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('uniq_id', $('#unique-number').val());
    formData.append('reversible', +$('#switch_container_num')[0].checked);
    formData.append('company_id', $('#company').val());
    formData.append('type_id', $('#type_container').val());
    formData.append('comment', $('#container-comment').val());
    formData.append('weight', $('#weight').val());
    formData.append('height', $('#height').val());
    formData.append('width', $('#width').val());
    formData.append('depth', $('#depth').val());

    return formData;
}

function addError(el, formEl, err) {
    el.text(err);
    el.removeClass('d-none');
    formEl.on("input ", function () {
        if (!el.hasClass('d-none')) {
            el.addClass('d-none');
        }
    });
}