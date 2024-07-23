@extends('layouts.admin')
@section('title','Користувачі')
@section('before-style')

    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/css/intlTelInput.css"/>
@endsection

@section('table-js')
    @include('layouts.table-scripts')
    <script type="module" src="{{asset('assets/js/grid/user/all-table.js')}}"></script>
    {{--    <script src="{{asset('assets/js/utils/loader-for-table.js')}}"></script>--}}
    {{--    TODO Loader--}}

@endsection

@section('content')
    @if(count($usersAll))
        {{--        <div id="jqxLoader"></div>--}}
        <div class="card mx-2">
            <div class="card-header border-bottom row mx-0 gap-1">
                <h4 class="card-title col-auto fw-bolder" data-i18n="UsersTitle">Користувачі</h4>
                <div class="col-auto d-flex  flex-grow-1 justify-content-start justify-content-sm-end pe-0">
                    <a class="btn btn-green" data-bs-toggle="modal" data-bs-target="#modalAddUser">
                        <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}" alt="plus">
                        Додати користувача
                    </a>
                </div>
            </div>
            {{--            invisible--}}
            <div class="card-grid " id="table-loader" style="position: relative;">

                <div id="offcanvas-end-example">
                    <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="settingTable"
                         aria-labelledby="settingTableLabel"
                         style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;"
                         data-bs-scroll="true">
                        <div class="offcanvas-header">
                            <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                            <div class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                                 style="list-style: none;"><a class="nav-link nav-link-grid">
                                    <img src="{{asset('assets/icons/close-button.svg')}}" alt="close-button"></a>
                            </div>
                        </div>
                        <div class="offcanvas-body p-0">
                            <div class="" id="body-wrapper">
                                <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                    <div class="form-check-label f-15">Змінити висоту рядка:</div>
                                    <div class="form-check form-check-warning form-switch d-flex align-items-center"
                                         style="">
                                        <button class="changeMenu-3">
                                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <button class="changeMenu-2 active-row-table ">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>

                                    </div>
                                </div>
                                <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                    <label class="form-check-label f-15" for="changeFonts">Збільшити шрифт</label>
                                    <div class="form-check form-check-warning form-switch">
                                        <input type="checkbox" class="form-check-input checkbox" id="changeFonts"/>
                                    </div>
                                </div>
                                <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                    <label class="form-check-label f-15" for="changeCol">Зміна розміру колонок</label>
                                    <div class="form-check form-check-warning form-switch">
                                        <input type="checkbox" class="form-check-input checkbox" id="changeCol"/>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div>
                                        <div style="float: left;" id="jqxlistbox"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="table-block " id="usersDataTable"></div>

            </div>
        </div>

        <div class="toast basic-toast position-fixed top-0 end-0 mt-5 me-3 fade show"
             style="background: rgb(255,255,255);display: none">
            <div class="toast-header pt-2">
                <img src="{{asset('assets/icons/check.svg')}}" class="me-1" alt="Toast image" height="18" width="25">
                <strong style="font-weight: 600;font-size: 15px;" class="me-auto">Користувача успішно додано</strong>
                <button type="button" class="ms-0 btn-close p-0" style="width: 45px" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
            <div id="alert-body" style="margin-left: 50px; font-size: 14px; margin-top: 5px">

            </div>
            <div class="mt-1 mb-1 d-flex justify-content-between gap-1 pe-2 ps-5 flex-grow-1">
                <button id="send_email" class="btn send_email  py-0  px-1 btn-primary"><img class="me-1"
                                                                                            src="{{asset('assets/icons/mail-forward.svg')}}"
                                                                                            alt="mail-forward">Відправити
                </button>
                <button type="button" id="copy" class="btn copy px-1 py-0 btn-outline-primary"><i class="me-1"
                                                                                                  data-feather='copy'></i>Копіювати
                </button>
            </div>
        </div>
        <textarea style="position: absolute;left: -999999999px;" name="temp" tabindex="-1" id="temp"></textarea>

    @else
        <div style="margin-top: 253px">
            <div class="empty-company text-center">
                У вас ще немає жодного користувача!
            </div>
            <div class="empty-company-title empty-company-title-m text-center">
                Як тільки користувача буде додано він буде відображатися тут
            </div>
            <div class="text-center mt-2">
                <a class="btn btn-green" data-bs-toggle="modal" data-bs-target="#modalAddUser">
                    <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}" alt="plus">
                    Додати користувача
                </a>
            </div>
        </div>
    @endif

    <!-- Add user modal -->
    <div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="addUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex flex-column justify-content-center pt-4">
                    <h3 class="modal-title pb-1" id="exampleModalCenterTitle">Додайте людей до CONSOLID</h3>
                    <p class="text-center px-2">Введіть електронну пошту або номер телефону щоб додати
                        користувача.</p>
                </div>
                <div class="modal-body px-2 pb-4">
                    <form id="add-user-form" class="w-100 h-100 d-flex flex-column px-2" action="/user/create"
                          method="GET">
                        <div class="mb-2 input-email-group-modal">
                            <label class="form-label" for="addUserEmailInp">Електронна адреса</label>
                            <input class="form-control" id="addUserEmailInp" type="email" name="login"
                                   placeholder="example@email.com" aria-describedby="addUserEmailInp" autofocus=""
                                   tabindex="1" style="margin-bottom:5px;"/>
                            <a href="#" class="text-secondary text-decoration-underline link-to-numberInputModal">Використати
                                номер телефону</a>
                        </div>
                        <!-- КАСТОМІЗОВАНИЙ ІНПУТ для номеру телефону різних країн -->
                        <div class="input-number-group-modal inpSelectNumCountry"
                             style="padding-top: 2px; margin-bottom : 7px;">
                            <div class="mb-1 d-flex flex-column ">
                                <label class="form-label" for="addUserNumberInp">Телефон</label>
                                <input class="form-control input-number-country" id="feedBackNumberInp2"
                                       name="login" aria-describedby="feedBackNumberInp2" autofocus=""/>
                                <a href="#" class="text-secondary text-decoration-underline link-to-emailInputModal"
                                   style="margin-top:5px;">Увійти використовуючи e-mail</a>
                            </div>
                        </div>
                        <div class="">
                            <div class="d-flex gap-1 align-items-center"
                                 style="background-color: rgba(217, 180, 20, 0.2); color: rgba(217, 180, 20, 1); padding: 12px 14px; border-radius: 6px;">
                                <img src="{{asset('assets/icons/alert-circle.svg')}}" alt="">
                                <span>Якщо користувач вже зареєстрований в CONSOLID просто виберіть його з списку.</span>
                            </div>
                        </div>
                        <!-- end input -->
                        <div class="col-12 mt-3">
                            <div class="d-flex float-end">
                                <button type="button" class="btn btn-link cancel-btn" data-bs-dismiss="modal">
                                    Скасувати
                                </button>
                                <button id="nextStepAuth" class="btn btn-primary float-end " type="submit" disabled>
                                    <span class="me-50">Добавити</span>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/js/intlTelInput.min.js"></script>
    <script type="module">
        import {inputSelectCountry} from '{{asset('assets/js/utils/inputSelectCountry.js')}}';

        inputSelectCountry('#feedBackNumberInp2');
    </script>

    <script>
        $($('.inpSelectNumCountry').hide())
        $($('.link-to-numberInputModal').click(function () {
            $($('.inpSelectNumCountry').show());
            $($('.input-email-group-modal').hide())
        }))
        $($('.link-to-emailInputModal').click(function () {
            $($('.inpSelectNumCountry').hide());
            $($('.input-email-group-modal').show());
        }))
    </script>

    <script>
        function deleteUser(user_id) {
            console.log(user_id)
            $.ajax({
                url: '/user/delete/' + user_id,
                type: 'POST',
                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    _method: 'DELETE',
                },
                success: function () {
                    $('#usersDataTable').jqxGrid('updatebounddata')
                }
            })
        }
    </script>
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        tableSetting($('#usersDataTable'));
    </script>
    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        offCanvasByBorder($('#usersDataTable'));
    </script>

    {{-- For new users--}}
    <script src="{{asset('assets/js/entity/user/user-toast.js')}}"></script>

    <script>
        // Add user modal
        $(document).ready(function () {
            $('#addUserEmailInp, #feedBackNumberInp2').on('input', function () {
                if ($('#addUserEmailInp').val() === '' && $('#feedBackNumberInp2').val().length < 13) {
                    $('#nextStepAuth').prop('disabled', true);
                } else {
                    $('#nextStepAuth').prop('disabled', false);
                }
            });

            $('#add-user-form').submit(function (event) {
                event.preventDefault();
                let email = $('#addUserEmailInp').val();
                let phone = $('#feedBackNumberInp2').val();
                let url = '';
                if (email) {
                    url = '/user/create?email=' + encodeURIComponent(email);
                } else if (phone) {
                    url = '/user/create?phone=' + encodeURIComponent(phone);
                }
                window.location.href = url;
            });
        });
    </script>

@endsection
