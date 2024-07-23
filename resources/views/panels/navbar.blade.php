<nav
    class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center border border-bottom-2 navbar-brand-left"
    data-nav="brand-left">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav" style="margin-left: 28px">
            <li class="nav-item row ">
                <div class="d-flex gap-1">
                    <div class=" align-self-center">
                        <a class="navbar-brand me-0 d-flex" href="/"><img width="25px"
                                                                          src="{{asset('assets/icons/nav-logo-consolid.svg')}}"
                                                                          alt="nav-logo">
                            <p class="h5 fw-bolder my-auto ms-25">CONSOLID</p>
                        </a>
                    </div>
                    <div class="workspace-profile">
                        <div class="btn-group ps-0">
                            <button class="btn btn-flat-primary fw-bolder logo-in-navbar dropdown-toggle" type="button"
                                    id="dropdownMenuButton100" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="color: #4B465C; padding:5px;">
                            </button>
                            <div class="dropdown-menu" id="drw" aria-labelledby="dropdownMenuButton100"
                                 style="padding: 20px;">
                                <span class="fw-bolder js-workspace-title"
                                      style="color: #4B465C80;">{{__('localization.nav_my_workspaces')}}</span>
                                <div id="workspaces-list"></div>
                                <hr class="js-separator-workspace-dropdown-item">
                                <a class="dropdown-item workspace-dropdown-item"
                                   href="{{route('workspace.create-company')}}"><span style="color: #A8AAAE;"><i
                                            data-feather='plus' style="margin-right: 5px;"></i>{{__('localization.nav_add_workspace')}}</span></a>
                                <a class="dropdown-item workspace-dropdown-item"
                                   href="{{route('workspace.index')}}"><span style="color: #A8AAAE;"><i
                                            data-feather='grid'
                                            style="margin-right: 5px;"></i> Переглянути усі</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class=" d-xl-none mb-0 ps-1">
                <li id="open-mobile-menu-js" class=" list-s-none"><a class="nav-link  menu-toggle nav-link-burger-c"
                                                                     href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>

        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            {{--             id="dropdown-flag" на a все ламає --}}
            <li class="nav-item dropdown ">
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon "></i>
                    <span class="selected-language" data-i18n=""></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="#" data-language="ua">
                        <i class="flag-icon flag-icon-ua"></i> <span data-i18n="LangTitleUA">Українська</span>
                    </a>
                    <a class="dropdown-item" href="#" data-language="en">
                        <i class="flag-icon flag-icon-us"></i> <span data-i18n="LangTitleEN">Англійська</span>
                    </a>
                    <a class="dropdown-item" href="#" data-language="en">
                        <i class="flag-icon flag-icon-de"></i> <span data-i18n="LangTitleGE">Німецька</span>
                    </a>
                    <a class="dropdown-item" href="#" data-language="en">
                        <i class="flag-icon flag-icon-pl"></i> <span data-i18n="LangTitlePL">Польська</span>
                    </a>
                </div>
            </li>

            {{--            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style">--}}
            {{--                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"--}}
            {{--                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                         class="feather feather-moon ficon">--}}
            {{--                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>--}}
            {{--                    </svg>--}}
            {{--                </a></li>--}}

            {{--            <li class="nav-item nav-search"><a class="nav-link nav-link-grid">--}}
            {{--                    <img src="{{asset('assets/icons/grid.svg')}}" alt="grid">--}}
            {{--                </a>--}}
            {{--            </li>--}}
            <li class="nav-item nav-search bookmarks-btn px-50"><a id="offCanvasToggleLink"
                                                                   class="p-0 nav-link nav-link-grid"
                                                                   data-bs-toggle="offcanvas"
                                                                   data-bs-target="#offcanvasEnd"
                                                                   aria-controls="offcanvasEnd">
                    <img class="nav-img-bookmarks" src="{{asset('assets/icons/bookmarks.svg')}}" alt="bookmarks">
                </a>
            </li>


            <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#"
                                                                         data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-bell ficon">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <span class="badge rounded-pill bg-danger badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">Сповіщення</h4>
                            <div class="badge rounded-pill badge-light-primary">6 Нових</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list ps"><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar"><img src="{{asset('images/portrait/small/avatar-s-15.jpg')}}"
                                                             alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Congratulation Sam 🎉</span>winner!
                                    </p><small class="notification-text"> Won the monthly best seller badge.</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar"><img src="{{asset('images/portrait/small/avatar-s-3.jpg')}}"
                                                             alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">New message</span>&nbsp;received
                                    </p><small class="notification-text"> You have 10 unread messages</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">MD</div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Revised Order
                                            👋</span>&nbsp;checkout
                                    </p><small class="notification-text"> MD Inc. order updated</small>
                                </div>
                            </div>
                        </a>
                        <div class="list-item d-flex align-items-center">
                            <h6 class="fw-bolder me-auto mb-0">Системні сповіщення</h6>
                            <div class="form-check form-check-primary form-switch">
                                <input class="form-check-input" id="systemNotification" type="checkbox" checked="">
                                <label class="form-check-label" for="systemNotification"></label>
                            </div>
                        </div>
                        <a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-x avatar-icon">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Server down</span>&nbsp;registered
                                    </p><small class="notification-text"> USA Server is down due to height CPU
                                        usage</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-success">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-check avatar-icon">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Sales report</span>&nbsp;generated
                                    </p><small class="notification-text"> Last month sales report generated</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-warning">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-alert-triangle avatar-icon">
                                                <path
                                                    d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                                                </path>
                                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">High memory</span>&nbsp;usage</p>
                                    <small class="notification-text"> BLR Server using high memory</small>
                                </div>
                            </div>
                        </a>
                        <div class="ps__rail-x" style="left: 0; bottom: 0;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0; width: 0;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0; right: 0;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0; height: 0;"></div>
                        </div>
                    </li>
                    <li class="dropdown-menu-footer"><a
                            class="btn btn-primary w-100 waves-effect waves-float waves-light" href="#">Прочитати всі
                            сповіщення</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user" style="z-index: 999">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
                   data-bs-toggle="dropdown" aria-haspopup="true">

                    <span class="avatar">
                        <img class="round" src="{{ Auth::user()->avatar_type ? '/file/uploads/user/avatars/'.Auth::id().'.'.Auth::user()->avatar_type
        : asset('assets/images/avatar_empty.png') }}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdown-user">
                    <h6 class="dropdown-header">Керування профілем</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('user.show',['user'=>auth()->id()])}}">
                        <i class="me-50" data-feather="user"></i> Профіль
                    </a>

                    <a class="dropdown-item" href="{{route('document-type.index')}}">
                        <i class="me-50" data-feather="settings"></i> Налаштування
                    </a>

                    @if (Auth::User())
                        <div class="dropdown-divider"></div>
                    @endif
                    @if (Auth::check())
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="me-50" data-feather="power"></i> Вийти
                        </a>
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    @else
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="btn-link dropdown-item"><i class="me-50"
                                                                                    data-feather="log-out"></i> Вийти
                            </button>
                        </form>

                    @endif
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- BEGIN: Main Menu-->
<div class="horizontal-menu-wrapper">
    <div
        class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border nav-width-100"
        role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav" style="margin: 0; width: 295px">
        <div class="navbar-header px-2 h-auto" style="width: 295px">
            <ul class="nav navbar-nav ms-50">
                <li class="nav-item d-flex flex-row justify-content-between">
                    <div class="nav-item me-auto">
                        <a class="navbar-brand" href="/">
                            <span class="brand-logo">
                                <img width="25px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}" alt="nav-logo">
                            </span>
                            <h2 class="brand-text mb-0" style="color: #5e5873">CONSOLID</h2>
                        </a>
                    </div>
                    <div class="nav-item nav-toggle">
                        <a class="nav-link modern-nav-toggle pe-0" style="margin-top: 26px;margin-bottom: 0;"
                           data-bs-toggle="collapse">
                            <i class="d-block d-xl-none text-dark toggle-icon font-medium-4" data-feather="x"></i>
                        </a>
                    </div>
                </li>

                <li class="workspace-profile mt-1 сss-main-cont-workspace-mobile" id="main-cont-workspace-mobile">

                </li>
            </ul>

        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <!-- include ../../../includes/mixins-->
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

                <!-- <li class=" nav-item">
                    <a class="nav-link d-flex align-items-center custom-padding" href="/analytic">
                        <img class="type-svg" src="{{asset('assets/icons/chart-pie.svg')}}" alt="chart-pie">
                        <span class="nav-title" data-i18n="Analytic">Аналітика</span>
                    </a>
                </li> -->

                <li class="dropdown nav-item " data-menu="dropdown" onclick="toggleClassOpen(this)"><a
                        class="dropdown-toggle nav-link d-flex align-items-center custom-padding" href="#"
                        data-bs-toggle="dropdown">
                        <img class="type-svg" src="{{asset('assets/icons/cha.svg')}}" alt="cha">
                        <span class="nav-title"
                              data-i18n="Reference books">{{__('localization.nav_directories')}}</span>
                    </a>

                    <ul class="dropdown-menu" data-bs-popper="none">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('company.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal" data-i18n="Company">{{__('localization.nav_companies')}}</span></a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('warehouse.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal" data-i18n="Location">{{__('localization.nav_locations')}}</span></a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal" data-i18n="Users">{{__('localization.nav_users')}}</span></a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('transport.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal" data-i18n="Transport">{{__('localization.nav_vehicle')}}</span></a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                               href="{{route('transport-equipment.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal"
                                      data-i18n="TransportEquipment">{{__('localization.nav_add_equipment')}}</span></a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('sku.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal" data-i18n="Goods">{{__('localization.nav_goods')}}</span></a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('containers.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal" data-i18n="Container">{{__('localization.nav_tare')}}</span></a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('services.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal" data-i18n="Services">{{__('localization.nav_services')}}</span></a>
                        </li>

                    </ul>
                </li>

                <li class="dropdown nav-item" data-menu="dropdown" onclick="toggleClassOpen(this)"><a
                        class="dropdown-toggle nav-link d-flex align-items-center custom-padding" href="#"
                        data-bs-toggle="dropdown">
                        <img class="type-svg" src="{{asset('assets/icons/truck.svg')}}" alt="truck">
                        <span class="nav-title"
                              data-i18n="User Interface">{{__('localization.nav_trans_logistic')}}</span></a>
                    <ul class="dropdown-menu" data-bs-popper="none">
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                               href="{{route('transport-planning.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal"
                                      data-i18n=Transport-planing-1">{{__('localization.nav_trans_planning')}}</span></a>
                        </li>
                    </ul>
                </li>


                <li class="dropdown nav-item" data-menu="dropdown" onclick="toggleClassOpen(this)"><a
                        class="dropdown-toggle nav-link d-flex align-items-center custom-padding" href="#"
                        data-bs-toggle="dropdown">
                        <img class="type-svg" src="{{asset('assets/icons/building.svg')}}" alt="building">
                        <span class="nav-title"
                              data-i18n="User Interface">{{__('localization.nav_warehouse_logistic')}}</span></a>
                    <ul class="dropdown-menu" data-bs-popper="none">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('leftovers.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal"
                                      data-i18n="Leftovers">{{__('localization.nav_leftovers')}}</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                               href="{{route('residue-control.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal"
                                      data-i18n="Template-42">{{__('localization.nav_inventory_control')}}</span></a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"><a
                        class="nav-link d-flex align-items-center custom-padding" href="/contracts">
                        <img class="type-svg" src="{{asset('assets/icons/book.svg')}}" alt="book">
                        <span class="nav-title" data-i18n="Misc">{{__('localization.nav_contracts')}}</span></a>
                </li>

                <li class="dropdown nav-item" data-menu="dropdown" onclick="toggleClassOpen(this)"><a
                        class="dropdown-toggle nav-link d-flex align-items-center custom-padding" href="#"
                        data-bs-toggle="dropdown">
                        <img class="type-svg" src="{{asset('assets/icons/book-2.svg')}}" alt="book-2">
                        <span class="nav-title"
                              data-i18n="User Interface">{{__('localization.nav_documents')}}</span></a>
                    <ul class="dropdown-menu" data-bs-popper="none">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('document.index')}}">
                                <img class="type-svg" src="{{asset('assets/icons/book-2.svg')}}" alt="book-2">

                                <span class="fw-normal"
                                      data-i18n="Template-1">{{__('localization.nav_all_documents')}}</span></a>
                        </li>

                        @foreach($doctypes as $doctype)
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                   href="/document/table/{{$doctype->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="6"></circle>
                                    </svg>
                                    <span class="fw-normal titles-doctypes"
                                          data-i18n="Template-1">{{$doctype->name}}</span></a>
                            </li>
                        @endforeach

                    </ul>
                </li>

                <li class="dropdown nav-item" data-menu="dropdown" onclick="toggleClassOpen(this)"><a
                        class="dropdown-toggle nav-link d-flex align-items-center custom-padding" href="#"
                        data-bs-toggle="dropdown">
                        <img class="type-svg" src="{{asset('assets/icons/book-2.svg')}}" alt="book-2">
                        <span class="nav-title" data-i18n="Register">{{__('localization.nav_registers')}}</span></a>
                    <ul class="dropdown-menu" data-bs-popper="none">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('register.storekeeper')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal"
                                      data-i18n="Storekeeper">{{__('localization.nav_storekeepers')}}</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/register/guard">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="6"></circle>
                                </svg>
                                <span class="fw-normal" data-i18n="Guard">{{__('localization.nav_guard')}}</span></a>
                        </li>


                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- END: Main Menu-->

