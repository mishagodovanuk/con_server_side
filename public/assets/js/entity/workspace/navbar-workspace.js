$(document).ready(async function () {

    let url = window.location.origin;
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    let workspaces = await fetch(url + '/workspace/list', {
        method: 'GET',
        headers: {
            "X-CSRF-Token": csrf
        },
    }).then(async response => {
        return (await response.json()).data;
    });

    let selected = workspaces.find(val => val.current);
    workspaces = workspaces.filter(val => !val.current);

    let selectedContainer = $('#dropdownMenuButton100');

    let selectedHtml = '';

    let listContainer = $('#workspaces-list');

    let listHtml = '';

    //set selected workspace
    if (selected.avatar_type) {
        selectedHtml = `<img src="${url}/uploads/workspace/avatars/${selected.id}.${selected.avatar_type}" style="padding-right: 5px;width: 32px;height: 32px;"> ${selected.name}`;
    } else {
        selectedHtml = `
            <div style="width: 32px;height: 32px;padding-right: 5px;border-radius: 50%;display: inline-block;vertical-align: middle;background: ${selected.avatar_color};position: relative">
                <span style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: white;font-size: 13px;line-height: 20px;font-family: 'Montserrat';font-weight: 600;">
                    ${selected.name[0]}
                </span>
            </div>
            ${selected.name}`;

    }

    selectedContainer.html(selectedHtml);


    Object.values(workspaces).forEach(workspace => {
        let avatar;

        if (workspace.avatar_type) {
            avatar = `<img src="${url}/uploads/workspace/avatars/${workspace.id}.${workspace.avatar_type}" style="padding-right: 5px;width: 18px;height: 18px;">`;
        } else {
            avatar = `
                <div style="width: 18px;height: 18px;padding-right: 5px;border-radius: 50%;display: inline-block;vertical-align: middle;background: ${workspace.avatar_color};position: relative">
                    <span style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: white;font-size: 11px;line-height: 14px;font-family: 'Montserrat';font-weight: 600;">
                        ${workspace.name[0]}
                    </span>
                </div>`;
        }

        listHtml += `
            <a id="workspace-change-link-${workspace.id}" class="dropdown-item workspace-dropdown-item" data-id="${workspace.id}" href="#" style="margin-top: 15px; font-weight: 500;">
                ${avatar} <span style="color: #4B4B4B;">${workspace.name}</span>
            </a>`;
    });


    listContainer.html(listHtml);


    var contentMobileWorkspace = `
                    <div class="btn-group ps-0">
                        <button class="btn btn-flat-primary fw-bolder logo-in-navbar dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color: #4B465C; padding:5px;">
                            ${selectedHtml}
                        </button>
                        <div class="dropdown-menu" id="drw" aria-labelledby="dropdownMenuButton100-mobile"
                             style="padding: 20px;">
                            <span class="fw-bolder js-workspace-title"
                                      style="color: #4B465C80;">Мої середовища</span>
                            <div id="workspaces-list">${listHtml}</div>
                            <hr class="js-separator-workspace-dropdown-item">
                            <a class="dropdown-item workspace-dropdown-item" href="${url}/workspace/create-company">
                                <span style="color: #A8AAAE;"><i data-feather='plus' style="margin-right: 5px;"></i> Додати середовище</span>
                            </a>
                            <a class="dropdown-item workspace-dropdown-item" href="${url}/workspace"><span
                                    style="color: #A8AAAE;"><i data-feather='grid' style="margin-right: 5px;"></i> Переглянути усі</span></a>
                        </div>
                    </div>`


    $('#open-mobile-menu-js').click(function (e) {
        $('#main-cont-workspace-mobile').empty()
        $('#main-cont-workspace-mobile').html(contentMobileWorkspace)
    });

    $('*[id*=workspace-change-link-]').on('click', async function (e) {
        e.preventDefault();

        let id = $(this).data('id');

        await fetch(url + '/workspace/change-selected-workspace', {
            method: 'POST',
            body: JSON.stringify({
                _token: csrf,
                workspace_id: id
            }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        }).then(() => {
            location.reload();
        });
    })

    $('body').on('click', '*[id*=workspace-change-link-]', async function (e) {
            e.preventDefault();

            let id = $(this).data('id');

            await fetch(url + '/workspace/change-selected-workspace', {
                method: 'POST',
                body: JSON.stringify({
                    _token: csrf,
                    workspace_id: id
                }),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            }).then(() => {
                location.reload();
            });
        }
    )

    function updateWorkspaceDisplay() {
        var workspaceList = $('#workspaces-list');
        if (workspaceList.children().length === 0) {
            $('.js-workspace-title').hide();
            $('.js-separator-workspace-dropdown-item').hide();
        } else {
            $('.js-workspace-title').show();
            $('.js-separator-workspace-dropdown-item').show();
        }
    }

    updateWorkspaceDisplay();

});
