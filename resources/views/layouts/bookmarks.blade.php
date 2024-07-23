<div class="offcanvas-end-example">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel"
         style="z-index:5000; width: 400px; margin-top: 65px;">
        <div class="offcanvas-header">
            <h4 id="offcanvasEndLabel" class="fw-bolder offcanvas-title">Закладки</h4>
            <div class="nav-item nav-search bookmarks text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                 style="list-style: none;"><a class="nav-link nav-link-grid">
                    <img src="{{asset('assets/icons/close-button.svg')}}" alt="Close button"></a>
            </div>
        </div>
        <div class="offcanvas-body px-0">
            <div class="h-100" id="body-wrapper">
                <div class="d-flex flex-column justify-content-between h-100" id="list-bookmarks">
                    <div>
                        <div class="input-group input-group-merge mb-2 px-2">
                            <span class="input-group-text" id="basic-addon-search2"><i data-feather="search"></i></span>
                            <input type="text" class="form-control ps-1" id="searchBar" placeholder="Пошук закладки"
                                   aria-label="Search..." aria-describedby="basic-addon-search2"/>
                        </div>
                        <div id="list-wrapper">
                            <ul id="list">
                                @foreach($bookmarks as $bookmark)
                                    <li class="list-item">
                                        <a class="w-100" style="line-height: 32px;" href="{{URL::to('/').$bookmark->page_uri.'?bookmark='.$bookmark->key}}">{{$bookmark->name}}</a>
                                        <button class="delete-btn">
                                            <img src="{{asset('assets/icons/delete-button.svg')}}" alt="Delete Button">
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="noItemsMsg" style="{{count($bookmarks) ? 'display:none' : ''}}">
                            <h4 class="text-center mb-1 mt-2 fw-bolder">У вас ще немає жодних закладок</h4>
                            <p class="text-center">
                                Створіть нову закладку
                            </p>
                        </div>
                    </div>
                    <div class="px-2">
                        <button type="button"
                                class="d-flex gap-50 align-items-center justify-content-center btn btn-primary mb-1 w-100"
                                id="create-btn">
                            <img class="bookmark-icon" src="{{asset('assets/icons/bookmark.svg')}}" alt="Bookmark Icon">
                            Створити закладку
                        </button>
                    </div>
                </div>
            </div>
            <div class="px-2" id="create-bookmark">
                <input type="text" class="form-control" id="bookmarkInput" placeholder="Назва закладки"/>
                <div class="d-flex flex-row justify-content-between mt-2">
                    <button class="btn btn-link cancel-btn" type="button" id="cancel-btn"
                            style="border: solid 1px; width: 163px;">Скасувати
                    </button>
                    <button type="submit" class="btn btn-primary" id="add-bookmark" style="width: 163px;" disabled>
                        Добавити
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
