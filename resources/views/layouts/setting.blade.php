<div class="card-header">
    <h2 class="card-title fw-bolder">Налаштування</h2>
</div>
<div class="card-body mt-1">
    <div class="col-md-3 col-sm-12">
        <ul class="nav nav-pills flex-column" style="width: 208px;">
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link {{ Request::is('general') ? 'active' : '' }} d-flex justify-content-start align-items-start"--}}
            {{--                   id="stacked-pill-1"--}}
            {{--                   {{ Request::is('general') ? 'data-bs-toggle=pill href=#vertical-pill-1' : 'href=/general' }}--}}
            {{--            aria-expanded="false">--}}
            {{--             Загальне--}}
            {{--         </a>--}}
            {{--     </li>--}}

            <li class="nav-item">
                <a class="nav-link {{ Request::is('document-type') ? 'active' : '' }} d-flex justify-content-start align-items-start"
                   id="stacked-pill-2"
                   {{ Request::is('document-type') ? 'data-bs-toggle=pill href=#vertical-pill-2' : 'href=/document-type' }}
                   aria-expanded="false">
                    Типи документів
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('type-goods') ? 'active' : '' }} d-flex justify-content-start align-items-start"
                   id="stacked-pill-3"
                   {{ Request::is('type-goods') ? 'data-bs-toggle=pill href=#vertical-pill-3' : 'href=/type-goods' }}
                   aria-expanded="false">
                    Категорія товару
                </a>
            </li>

            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link {{ Request::is('type-container') ? 'active' : '' }} d-flex justify-content-start align-items-start"--}}
            {{--                   id="stacked-pill-3"--}}
            {{--                   {{ Request::is('type-container') ? 'data-bs-toggle=pill href=#vertical-pill-3' : 'href=/type-container' }}--}}
            {{--                   aria-expanded="false">--}}
            {{--                    Типи контейнерів--}}
            {{--                </a>--}}
            {{--            </li>--}}

            <li class="nav-item">
                <a class="nav-link {{ Request::is('workspace/'.Auth::user()->current_workspace_id.'/edit') ? 'active' : '' }} d-flex justify-content-start align-items-start"
                   id="stacked-pill-4"
                   {{ Request::is('workspace/'.Auth::user()->current_workspace_id.'/edit') ? 'data-bs-toggle=pill href=#vertical-pill-4' : "href=/workspace/".Auth::user()->current_workspace_id."/edit" }}
                   aria-expanded="false">
                    Робоче середовище
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('regulations') ? 'active' : '' }} d-flex justify-content-start align-items-start"
                   id="stacked-pill-5"
                   {{ Request::is('regulations') ? 'data-bs-toggle=pill href=#vertical-pill-5' : 'href=/regulations' }}
                   aria-expanded="false">
                    Регламенти
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('residue-control/create') ? 'active' : '' }} d-flex justify-content-start align-items-start"
                   id="stacked-pill-6"
                   {{ Request::is('residue-control/create') ? 'data-bs-toggle=pill href=#vertical-pill-6' : 'href=/residue-control/create' }}
                   aria-expanded="false">
                    Правила проведення
                </a>
            </li>
        </ul>
    </div>
</div>
