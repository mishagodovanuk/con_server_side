<!-- @extends('layouts.app') -->
@section('title','Авторизація')
@section('content')

    <!-- сторінка авторизації (входу в акаунт) -->
    <div class="auth auth_content  container px-0 px-md-0  h-100 mx-2  ">
        <div class="row mx-0  h-100 add_shadow">
            <!-- контейнер з заголовком та формою  -->
            <div class="main-cont col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 d-flex flex-column py-3 ">
                <div class="px-2">
                    <div class="cont-logo d-flex mb-2 ">
                        <img width="25px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}" alt="logo">
                        <p class="h5 fw-bolder my-auto ms-25">CONSOLID</p>
                    </div>
                    <h2 class="h1 fw-bolder mb-2">Увійдіть в акаунт</h2>
                </div>

                <form id="login-form" class="auth-login-form w-100 h-100 d-flex flex-column px-2">

                    <div class="mb-1 input-email-group">
                        <label class="form-label" for="login-email-auth">Електронна адреса</label>
                        <input class="form-control" style="margin-bottom:5px;" id="login-email-auth" type="email"
                               name="login"
                               placeholder="example@email.com" aria-describedby="login-email"
                               autofocus="" tabindex="1"/>
                        <a href="#" class="text-secondary text-decoration-underline link-to-numberInput">Увійти
                            використовуючи номер телефону</a>
                    </div>
                    <!-- КАСТОМІЗОВАНИЙ ІНПУТ для номеру телефону різних країн -->

                    <div class="input-number-group inpSelectNumCountry" style="padding-top: 2px;">
                        <div class="mb-1 d-flex flex-column ">
                            <label class="form-label" for="authNumberInp">Телефон</label>
                            <input class="form-control input-number-country" id="authNumberInp" name="login"
                                   aria-describedby="authNumberInp"
                                   autofocus=""/>
                            <a href="#" class="text-secondary text-decoration-underline link-to-emailInput"
                               style="margin-top:5px;">Увійти використовуючи e-mail</a>
                        </div>
                    </div>
                    <!-- end input -->
                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="login-password">Пароль</label>

                        </div>

                        <div class="input-group input-group-merge form-password-toggle mb-1">
                            <input class="form-control form-control-merge" id="login-password" type="password"
                                   name="password" placeholder="Вкажіть ваш пароль" aria-describedby="login-password"
                                   minlength="8"
                                   tabindex="2"/>
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>


                        </div>
                    </div>
                    <div id="login-errors" class="mb-1 alert alert-danger alert-register-form d-none" role="alert">
                        текст помилки
                    </div>

                    <div class=" d-flex flex-wrap justify-content-between ">
                        <div class="form-check">
                            <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3"
                                   name="remember"/>
                            <label class="form-check-label " for="remember-me">Запам'ятати мене</label>
                        </div>

                        <a href="#" class="text-secondary text-decoration-underline link-to-passRecovery"><small>Забули
                                пароль?</small></a>
                    </div>
                    <div class="h-100 w-100 d-flex justify-content-between justify-content-lg-end align-items-end">
                        <p class="mb-0 d-md-block d-lg-none">Немає акаунту? <a href="#"
                                                                               class="fw-bold link-to-register">Зареєструватись</a>
                        </p>
                        <button type="submit"
                                class="btn btn-primary disabled btnDisabled" tabindex="4">Увійти
                        </button>
                    </div>
                </form>

            </div>
            <!-- фоновий контейнер  -->
            <div
                class="auth__imgContainer col-4 d-none d-sm-none d-md-none d-lg-flex col-sm-4 col-md-4 col-lg-4 col-xxl-4 d-flex flex-column justify-content-center  p-3">
                <div class=" px-4 py-3 "><img class="" src="{{asset('assets/icons/auth_laptop_sign_in.svg')}}"
                                              alt="logo">
                </div>
                <p>З поверненням до CONSOLID! <br> Введіть дані за допомогою яких ви створювали акаунт</p>
                <p>Немає акаунту? <a href="#" class="fw-bold link-to-register">Зареєструватись</a></p>

            </div>
        </div>
    </div>
    <!-- кінець сторінки авторизації -->

    <!-- Візард з сторінками реєстрації -->
    <div
        class="register mx-2 d-none auth_content container h-100">

        <!-- всередині змінюється контент (декілька різних div ) по кнопках далі та назад  -->
        <div class="w-100 h-100">

            <!-- перша сторінка візарда реєстрації  -->
            <div class=" h-100" id="register_page">

                <div class="row h-100 add_shadow">
                    <!-- контейнер з заголовком та формою  -->
                    <div
                        class="main-cont  col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8   d-flex flex-column py-3 ">
                        <div class="px-2">
                            <div class="cont-logo d-flex mb-2 ">
                                <img width="25px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}" alt="logo">
                                <p class="h5 fw-bolder my-auto ms-25">CONSOLID</p>
                            </div>
                            <h2 class="h1 fw-bolder mb-2">Реєстрація акаунту</h2>
                        </div>

                        <form id="register-login-form" class="register-form w-100 h-100 d-flex flex-column px-2">
                            <div class="mb-1 input-email-group">
                                <label class="form-label" for="registerEmailInp">Електронна адреса</label>
                                <input class="form-control" id="registerEmailInp" type="email" name="login"
                                       placeholder="example@email.com" style="margin-bottom:5px;"
                                       aria-describedby="registerEmailInp" autofocus="" tabindex="1"/>
                                <a href="#" class="text-secondary text-decoration-underline link-to-numberInput">Увійти
                                    використовуючи номер телефону</a>
                            </div>

                            <!-- КАСТОМІЗОВАНИЙ ІНПУТ для номеру телефону різних країн -->
                            <div class="input-number-group inpSelectNumCountry" style="padding-top: 2px;">
                                <div class="mb-1 d-flex flex-column ">
                                    <label class="form-label" for="registerNumberInp">Телефон</label>
                                    <input class="form-control input-number-country" id="registerNumberInp"
                                           name="login"
                                           aria-describedby="registerNumberInp"
                                           autofocus=""/>
                                    <a href="#" class="text-secondary text-decoration-underline link-to-emailInput"
                                       style="margin-top:5px;">Увійти використовуючи e-mail</a>
                                </div>
                            </div>
                            <!-- end input -->
                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="registerPassword">Пароль</label>

                                </div>

                                <div class="input-group input-group-merge form-password-toggle">
                                    <input class="form-control form-control-merge" id="registerPassword" type="password"
                                           name="password" placeholder="Придумайте пароль" minlength="8"
                                           aria-describedby="registerPassword"
                                           tabindex="2"/>
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="registerPasswordRepeat">Повторіть пароль</label>

                                </div>

                                <div class=" container-confirmPass-and-alert">
                                    <div class="input-group input-group-merge form-password-toggle mb-1">
                                        <input class="form-control form-control-merge" id="registerPasswordRepeat"
                                               type="password" name="confirmPassword"
                                               placeholder="Введіть пароль повторно" minlength="8"
                                               data-form="register-form" aria-describedby="registerPasswordRepeat"
                                               tabindex="2"/>
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                    <div id="register-errors" class="alert alert-danger alert-register-form d-none"
                                         role="alert">
                                        Паролі мають повторюватись
                                    </div>
                                </div>

                            </div>

                            <div
                                class="h-100 w-100 d-flex justify-content-between justify-content-lg-end align-items-end">
                                <p class="d-md-block mb-0 d-lg-none">Вже є акаунт? <a href="#"
                                                                                      class="fw-bold link-to-auth">Увійти</a>
                                </p>
                                <button type="submit"
                                        class="btn btn-primary disabled btnDisabled" tabindex="4"
                                        id="register-send-code-button"> <span
                                        class="align-middle d-sm-inline-block ">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i></button>
                            </div>
                        </form>

                    </div>
                    <!-- фоновий контейнер  -->
                    <div
                        class="auth__imgContainer col-4 d-none d-sm-none d-md-none d-lg-flex col-sm-4 col-md-4 col-lg-4 col-xxl-4 d-flex flex-column justify-content-center  p-3">
                        <div class=" px-4 py-3 "><img class="" src="{{asset('assets/icons/auth_laptop_signup.svg')}}"
                                                      alt="logo"></div>
                        <p>Реєструючись ви погоджуєтесь з
                            <a class="text-secondary text-decoration-underline" href="#">умовами використання</a> та <a
                                class="text-secondary text-decoration-underline" href="#">політикою
                                конфіденційності</a>.
                        </p>
                        <p>Вже є акаунт? <a href="#" class="fw-bold link-to-auth">Увійти</a></p>
                    </div>
                </div>
            </div>
            <!-- друга сторінка візарда реєстрації  -->
            <div class=" h-100 d-none" id="register_code">
                <!-- контент регістер перевірка коду по емейлу -->
                <div class="row h-100 add_shadow   register-code-by-email-content d-none">
                    <!-- контейнер з заголовком та формою  -->
                    <div
                        class="main-cont col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8  d-flex flex-column py-3 ">
                        <div class="px-2">
                            <div class="cont-logo d-flex mb-2 ">
                                <img width="25px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}" alt="logo">
                                <p class="h5 fw-bolder my-auto ms-25">CONSOLID</p>
                            </div>
                            <h2 class="h1 fw-bolder mb-2">Реєстрація акаунту</h2>

                        </div>

                        <form id="register-send-email-code"
                              class="register-code-by-email-form w-100 h-100 d-flex flex-column px-2">
                            <div class="mb-1">
                                <label class="form-label mb-1" for="login-email">На електронну адресу <span
                                        class="fw-medium-c" id="writeCurrentMail">example@gmail.com</span> відправлено
                                    лист з кодом
                                    підтвердження.</label>
                                <div id="otp-register-code-by-email" data-formclassname=".register-code-by-email-form"
                                     class="inputs d-flex justify-content-start">
                                    <input class=" mr-1 text-center form-control otp__input " type="number"
                                           id="first-byEmail-reg" maxlength="1"/>
                                    <input disabled class=" mr-1 text-center form-control otp__input " type="number"
                                           id="second-byEmail-reg" maxlength="1"/>
                                    <input disabled class=" mr-1 text-center form-control  otp__input" type="number"
                                           id="third-byEmail-reg" maxlength="1"/>
                                    <input disabled class=" text-center form-control otp__input" type="number"
                                           id="fourth-byEmail-reg" maxlength="1"/>


                                </div>
                                <div class="alert alert-danger d-none mt-2 mb-1" role="alert">text error</div>
                            </div>


                            <a id="refresh-email-code" href="#" class="text-secondary text-decoration-underline"><small>Відправити
                                    код
                                    повторно</small></a>
                            <div class="h-100 w-100 d-flex justify-content-between align-items-end">
                                <button type='button' class="btn btn-to-registerPage" tabindex="4"><i
                                        data-feather="arrow-left"
                                        class="align-middle ms-sm-25 ms-0 "></i> <span
                                        class="align-middle d-sm-inline-block text-secondary">назад</span>
                                </button>
                                <button type='submit' class="btn btn-primary disabled btnDisabled" tabindex="4">
                                    <span class="align-middle d-sm-inline-block">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i></button>
                            </div>
                        </form>

                    </div>
                    <!-- фоновий контейнер  -->
                    <div
                        class="auth__imgContainer col-4 d-none d-sm-none d-md-none d-lg-flex col-sm-4 col-md-4 col-lg-4 col-xxl-4 d-flex flex-column justify-content-center  p-3">
                        <div class=" px-4 py-3 "><img class=""
                                                      src="{{asset('assets/icons/auth_laptop_signup_code.svg')}}"
                                                      alt="logo"></div>
                        <p>Реєструючись ви погоджуєтесь з
                            <a class="text-secondary text-decoration-underline" href="#">умовами використання</a> та <a
                                class="text-secondary text-decoration-underline" href="#">політикою
                                конфіденційності</a>.
                        </p>
                        <p>Вже є акаунт? <a href="#" class="fw-bold link-to-auth">Увійти</a></p>
                    </div>
                </div>
                <!-- =контент регістер перевірка коду по телефоні  -->
                <div class="row h-100 add_shadow register-code-by-phone-content d-none">
                    <!-- контейнер з заголовком та формою  -->
                    <div
                        class="main-cont col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8    d-flex flex-column py-3 ">
                        <div class="px-2">
                            <div class="cont-logo d-flex mb-2 ">
                                <img width="25px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}" alt="logo">
                                <p class="h5 fw-bolder my-auto ms-25">CONSOLID</p>
                            </div>
                            <h2 class="h1 fw-bolder mb-2">Реєстрація акаунту</h2>

                        </div>

                        <form id="register-send-phone-code"
                              class="register-code-by-phone-form w-100 h-100 d-flex flex-column px-2">
                            <div class="mb-1">
                                <label class="form-label mb-1" for="login-email">На номер телефону <span
                                        class="fw-medium-c" id="showWriteNumberRegister">+38 (088) 888 88 88</span>
                                    відправлено смс повідомлення з
                                    кодом
                                    підтвердження.</label>
                                <div id="otp-register-code-by-phone" data-formclassname=".register-code-by-phone-form"
                                     class="inputs d-flex justify-content-start">
                                    <input class=" mr-1 text-center form-control otp__input " type="number"
                                           id="first-byPhone-reg" maxlength="1"/>
                                    <input disabled class=" mr-1 text-center form-control otp__input " type="number"
                                           id="second-byPhone-reg" maxlength="1"/>
                                    <input disabled class=" mr-1 text-center form-control  otp__input" type="number"
                                           id="third-byPhone-reg" maxlength="1"/>
                                    <input disabled class=" text-center form-control otp__input" type="number"
                                           id="fourth-byPhone-reg" maxlength="1"/>


                                </div>
                                <div class="alert alert-danger d-none mt-2 mb-1" role="alert">text error</div>
                            </div>


                            <a id="refresh-phone-code" href="#" class="text-secondary text-decoration-underline"><small>Відправити
                                    код
                                    повторно</small></a>
                            <div class="h-100 w-100 d-flex justify-content-between align-items-end">
                                <button type='button' class="btn btn-to-registerPage" tabindex="4"><i
                                        data-feather="arrow-left"
                                        class="align-middle ms-sm-25 ms-0 "></i> <span
                                        class="align-middle d-sm-inline-block text-secondary">назад</span>
                                </button>
                                <button type='submit' class="btn btn-primary disabled btnDisabled" tabindex="4">
                                    <span class="align-middle d-sm-inline-block">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i></button>
                            </div>
                        </form>

                    </div>
                    <!-- фоновий контейнер  -->
                    <div
                        class="auth__imgContainer col-4 d-none d-sm-none d-md-none d-lg-flex col-sm-4 col-md-4 col-lg-4 col-xxl-4 d-flex flex-column justify-content-center  p-3">
                        <div class=" px-4 py-3 "><img class=""
                                                      src="{{asset('assets/icons/auth_laptop_signup_code.svg')}}"
                                                      alt="logo"></div>
                        <p>Реєструючись ви погоджуєтесь з
                            <a class="text-secondary text-decoration-underline" href="#">умовами використання</a> та <a
                                class="text-secondary text-decoration-underline" href="#">політикою
                                конфіденційності</a>.
                        </p>
                        <p>Вже є акаунт? <a href="#" class="fw-bold link-to-auth">Увійти</a></p>
                    </div>
                </div>

            </div>

            <!-- нижче дів закінчення контейнера bs-stepper-content -->
        </div>


    </div>

    <!-- сторінки ВІДНОВЛЕННЯ ПАРОЛЮ -->
    <div
        class="passRecovery d-none auth_content container mx-2 h-100 ">

        <!-- всередині змінюється контент (декілька різних div ) по кнопках далі та назад  -->
        <div class="w-100 h-100 ">

            <!-- перша сторінка візарда ВІДНОВЛЕННЯ ПАРОЛЮ  -->
            <div class="  h-100  " id="passRecovery_page"
            >

                <div class="row h-100 add_shadow">
                    <!-- контейнер з заголовком та формою  -->
                    <div
                        class="main-cont col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8   d-flex flex-column py-3 ">
                        <div class="px-2">
                            <div class="cont-logo d-flex mb-2 ">
                                <img width="25px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}" alt="logo">
                                <p class="h5 fw-bolder my-auto ms-25">CONSOLID</p>
                            </div>
                            <h2 class="h1 fw-bolder mb-2">Відновлення паролю</h2>
                            <p class="mb-2">Введіть електронну адресу або номер телефону на який було зареєстровано ваш
                                акаунт і ми надішлемо вам інструкцію по відновленню паролю</p>
                        </div>

                        <form id="reset-password-form" class="passRecovery-form w-100 h-100 d-flex flex-column px-2">

                            <div class="mb-1 input-email-group">
                                <label class="form-label" for="passRecoveryEmailInp">Електронна адреса</label>
                                <input class="form-control" id="passRecoveryEmailInp" type="email"
                                       name="login" placeholder="example@email.com"
                                       aria-describedby="passRecoveryEmailInp" autofocus="" tabindex="1"
                                       style="margin-bottom:5px;"/>
                                <a href="#" class="text-secondary text-decoration-underline link-to-numberInput">Увійти
                                    використовуючи номер телефону</a>
                            </div>
                            <!-- КАСТОМІЗОВАНИЙ ІНПУТ для номеру телефону різних країн -->
                            <div class="input-number-group inpSelectNumCountry" style="padding-top: 2px;">
                                <div class="mb-1 d-flex flex-column ">
                                    <label class="form-label" for="passRecoveryNumberInp">Телефон</label>
                                    <input class="form-control input-number-country" id="passRecoveryNumberInp"
                                           name="login"
                                           aria-describedby="passRecoveryNumberInp"
                                           autofocus=""/>
                                    <a href="#" class="text-secondary text-decoration-underline link-to-emailInput"
                                       style="margin-top:5px;">Увійти використовуючи e-mail</a>
                                </div>
                            </div>
                            <!-- end input -->
                            <div class="my-2 alert alert-danger d-none" role="alert">
                                текст помилки
                            </div>

                            <div
                                class="h-100 w-100 d-flex justify-content-between justify-content-lg-end align-items-end">
                                <p class="mb-0 d-md-block d-lg-none">Я пам'ятаю свій пароль. <a href="#"
                                                                                                class="fw-bold link-to-auth"
                                    >
                                        Увійти</a></p>
                                <button type="submit"
                                        class="btn btn-primary disabled btnDisabled" tabindex="4"> <span
                                        class="align-middle d-sm-inline-block">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i></button>
                            </div>
                        </form>

                    </div>
                    <!-- фоновий контейнер  -->
                    <div
                        class="auth__imgContainer col-4 d-none d-sm-none d-md-none d-lg-flex col-sm-4 col-md-4 col-lg-4 col-xxl-4 d-flex flex-column justify-content-center  p-3">
                        <div class=" px-4 py-3 "><img class="" src="{{asset('assets/icons/auth_laptop_tools.svg')}}"
                                                      alt="logo"></div>
                        <p>Якщо вам не вдається змінити пароль, можете <a
                                class="text-secondary text-decoration-underline"
                                data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#">звʼязатись з
                                адміністратором </a>
                            для вирішення цієї проблеми.

                        </p>
                        <p>Я пам'ятаю свій пароль. <a href="#" class="fw-bold link-to-auth"
                            > Увійти</a></p>
                    </div>
                </div>
            </div>

            <!-- друга сторінка візарда ВІДНОВЛЕННЯ ПАРОЛЮ  -->
            <div class=" h-100 d-none" id="passRecovery_code">

                <!-- контент для коду у СТОРІНКА ПЕРЕВІРКА Кодом по ЕМЕйлу -->
                <div class="row h-100 add_shadow   passRecovery-code-by-email-content d-none">
                    <!-- контейнер з заголовком та формою  -->
                    <div
                        class="main-cont col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8   d-flex flex-column py-3 ">
                        <div class="px-2">
                            <div class="cont-logo d-flex mb-2 ">
                                <img width="25px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}" alt="logo">
                                <p class="h5 fw-bolder my-auto ms-25">CONSOLID</p>
                            </div>
                            <h2 class="h1 fw-bolder mb-2">Відновлення паролю</h2>
                        </div>

                        <form id="reset-password-code-email-form"
                              class="passRecovery-code-by-email-form w-100 h-100 d-flex flex-column px-2">
                            <div class="mb-1">
                                <label class="form-label mb-1" for="passRecovery-by-email">На електронну адресу <span
                                        class="fw-medium-c" id="writeCurrentMailRestore">example@gmail.com</span>
                                    відправлено лист з кодом
                                    підтвердження.</label>
                                <div id="otp-passRecovery-code-by-email"
                                     data-formclassname=".passRecovery-code-by-email-form"
                                     class="inputs d-flex justify-content-start">
                                    <input class=" mr-1 text-center form-control otp__input " type="number"
                                           id="first-byEmail-pass" maxlength="1"/>
                                    <input disabled class=" mr-1 text-center form-control otp__input " type="number"
                                           id="second-byEmail-pass" maxlength="1"/>
                                    <input disabled class=" mr-1 text-center form-control  otp__input" type="number"
                                           id="third-byEmail-pass" maxlength="1"/>
                                    <input disabled class=" text-center form-control otp__input" type="number"
                                           id="fourth-byEmail-pass" maxlength="1"/>

                                </div>
                                <div class="my-2 alert alert-danger d-none" role="alert">
                                    текст помилки
                                </div>

                            </div>


                            <a id="refresh-password-phone-code" href="#"
                               class="text-secondary text-decoration-underline"><small>Відправити код
                                    повторно</small></a>
                            <div class="h-100 w-100 d-flex justify-content-between align-items-end">
                                <button type='button' class="btn btn-to-passRecoveryPage" tabindex="4"><i
                                        data-feather="arrow-left"
                                        class="align-middle ms-sm-25 ms-0 "></i> <span
                                        class="align-middle d-sm-inline-block text-secondary">назад</span>
                                </button>
                                <button type='submit' class="btn btn-primary  disabled btnDisabled" tabindex="4">
                                    <span class="align-middle d-sm-inline-block">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i></button>
                            </div>
                        </form>

                    </div>
                    <!-- фоновий контейнер  -->
                    <div
                        class="auth__imgContainer col-4 d-none d-sm-none d-md-none d-lg-flex col-sm-4 col-md-4 col-lg-4 col-xxl-4 d-flex flex-column justify-content-center  p-3">
                        <div class=" px-4 py-3 "><img class=""
                                                      src="{{asset('assets/icons/auth_laptop_signup_code.svg')}}"
                                                      alt="logo"></div>
                        <p>Якщо вам не вдається змінити пароль, можете <a
                                class="text-secondary text-decoration-underline"
                                data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#">звʼязатись з
                                адміністратором </a>
                            для вирішення цієї проблеми.

                        </p>


                        <p>Я пам'ятаю свій пароль. <a href="#" class="fw-bold link-to-auth"
                            > Увійти</a></p>
                    </div>
                </div>

                <!-- контент для коду СТОРІНКА ПЕРЕВІРКА Кодом по НОМЕРУ -->
                <div class="row h-100 add_shadow  passRecovery-code-by-phone-content d-none">
                    <!-- контейнер з заголовком та формою  -->
                    <div
                        class="main-cont col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8   d-flex flex-column py-3 ">
                        <div class="px-2">
                            <div class="cont-logo d-flex mb-2 ">
                                <img width="25px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}" alt="logo">
                                <p class="h5 fw-bolder my-auto ms-25">CONSOLID</p>
                            </div>
                            <h2 class="h1 fw-bolder mb-2">Відновлення паролю</h2>
                        </div>

                        <form id="reset-password-code-phone-form"
                              class="passRecovery-code-by-phone-form w-100 h-100 d-flex flex-column px-2">
                            <div class="mb-1">
                                <label class="form-label mb-1" for="passRecovery-by-phone">На номер телефону <span
                                        class="fw-medium-c" id="showWriteNumber">+38 (088) 888 88 88</span> відправлено
                                    смс повідомлення з
                                    кодом
                                    підтвердження.</label>
                                <div id="otp-passRecovery-code-by-phone"
                                     data-formclassname=".passRecovery-code-by-phone-form"
                                     class="inputs d-flex justify-content-start">
                                    <input class=" mr-1 text-center form-control otp__input " type="number"
                                           id="first-byPhone-pass" maxlength="1"/>
                                    <input disabled class=" mr-1 text-center form-control otp__input " type="number"
                                           id="second-byPhone-pass" maxlength="1"/>
                                    <input disabled class=" mr-1 text-center form-control  otp__input" type="number"
                                           id="third-byPhone-pass" maxlength="1"/>
                                    <input disabled class=" text-center form-control otp__input" type="number"
                                           id="fourth-byPhone-pass" maxlength="1"/>


                                </div>
                                <div class="my-2 alert alert-danger d-none" role="alert">
                                    текст помилки
                                </div>
                            </div>

                            <a id="refresh-password-phone-code" href="#"
                               class="text-secondary text-decoration-underline"><small>Відправити код
                                    повторно</small></a>
                            <div class="h-100 w-100 d-flex justify-content-between align-items-end">
                                <button type='button' class="btn btn-to-passRecoveryPage" tabindex="4"><i
                                        data-feather="arrow-left"
                                        class="align-middle ms-sm-25 ms-0 "></i> <span
                                        class="align-middle d-sm-inline-block text-secondary">назад</span>
                                </button>
                                <button type='submit' class="btn btn-primary disabled btnDisabled" tabindex="4">
                                    <span class="align-middle d-sm-inline-block">Далі</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i></button>
                            </div>
                        </form>

                    </div>
                    <!-- фоновий контейнер  -->
                    <div
                        class="auth__imgContainer col-4 d-none d-sm-none d-md-none d-lg-flex col-sm-4 col-md-4 col-lg-4 col-xxl-4 d-flex flex-column justify-content-center  p-3">
                        <div class=" px-4 py-3 "><img class=""
                                                      src="{{asset('assets/icons/auth_laptop_signup_code.svg')}}"
                                                      alt="logo"></div>
                        <p>Якщо вам не вдається змінити пароль, можете <a
                                class="text-secondary text-decoration-underline"
                                data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#">звʼязатись з
                                адміністратором </a>
                            для вирішення цієї проблеми.

                        </p>
                        <p>Я пам'ятаю свій пароль. <a href="#" class="fw-bold link-to-auth"
                            > Увійти</a></p>
                    </div>
                </div>
            </div>


            <!-- четверта сторінка відновлення паролю  -->

            <div class=" h-100  d-none" id="passRecovery_page_writeNew"
            >

                <div class="row h-100 add_shadow">
                    <!-- контейнер з заголовком та формою  -->
                    <div
                        class="main-cont col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8  d-flex flex-column py-3 ">
                        <div class="px-2">
                            <div class="cont-logo d-flex mb-2 ">
                                <img width="25px" src="{{asset('assets/icons/nav-logo-consolid.svg')}}" alt="logo">
                                <p class="h5 fw-bolder my-auto ms-25">CONSOLID</p>
                            </div>
                            <h2 class="h1 fw-bolder mb-2">Відновлення паролю</h2>
                            <p class="mb-2">Придумайте новий пароль</p>
                        </div>

                        <form id="reset-new-password-form"
                              class="passRecovery-writeNew-form w-100 h-100 d-flex flex-column px-2">
                            <div class="mb-1">
                                <div class="">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="passRecovery-password">Пароль</label>

                                    </div>

                                    <div class="input-group input-group-merge form-password-toggle mb-1">
                                        <input class="form-control form-control-merge" id="passRecovery-password"
                                               type="password" name="password" placeholder="Придумайте пароль"
                                               minlength="8"
                                               aria-describedby="passRecovery-password" tabindex="2"/>
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>


                                    </div>
                                </div>
                                <div class="">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="passRecovery-password-repeat">Повторіть
                                            пароль</label>

                                    </div>
                                    <div class="container-confirmPass-and-alert">
                                        <div class="input-group input-group-merge form-password-toggle mb-1">
                                            <input class="form-control form-control-merge"
                                                   id="passRecovery-password-repeat"
                                                   data-form="passRecovery-writeNew-form" type="password" minlength="8"
                                                   name="confirmPassword" placeholder="Введіть пароль повторно"
                                                   aria-describedby="passRecovery-password-repeat" tabindex="2"/>
                                            <span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"></i></span>


                                        </div>
                                        <div class="alert alert-danger alert-passRecovery-writeNew-form d-none"
                                             role="alert">
                                            Пароль мають повторюватись
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="h-100 w-100 d-flex justify-content-between align-items-end">
                                <button type='button' class="btn btn-to-passRecoveryPage-two" tabindex="4"><i
                                        data-feather="arrow-left"
                                        class="align-middle ms-sm-25 ms-0 "></i> <span
                                        class="align-middle d-sm-inline-block text-secondary">назад</span>
                                </button>
                                <button type='submit' class="btn btn-primary disabled btnDisabled" tabindex="4">
                                    <span class="align-middle d-sm-inline-block">Підтвердити та увійти</span>
                                </button>
                            </div>
                        </form>

                    </div>
                    <!-- фоновий контейнер  -->
                    <div
                        class="auth__imgContainer col-4 d-none d-sm-none d-md-none d-lg-flex col-sm-4 col-md-4 col-lg-4 col-xxl-4 d-flex flex-column justify-content-center  p-3">
                        <div class=" px-4 py-3 "><img class="" src="{{asset('assets/icons/auth_laptop_tools.svg')}}"
                                                      alt="logo"></div>
                        <p>Якщо вам не вдається змінити пароль, можете <a
                                class="text-secondary text-decoration-underline"
                                data-bs-toggle="modal" data-bs-target="#modalForSendSupport" href="#">звʼязатись з
                                адміністратором </a>
                            для вирішення цієї проблеми.

                        </p>
                        <p>Я пам'ятаю свій пароль. <a href="#" class="fw-bold link-to-auth"
                            > Увійти</a></p>
                    </div>
                </div>
            </div>

            <!-- нижче дів закінчення контейнера bs-stepper-content -->
        </div>

    </div>

    <!--  модалка "зв'язатись з адміністратором" -->
    <div class="modal fade" id="modalForSendSupport" tabindex="-1" aria-labelledby="twoFactorAuthTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg two-factor-auth">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 mx-50">
                    <form id="feedback-form" class="auth-login-form w-100 h-100 d-flex flex-column px-2">
                        <h3 class=" mb-1" id="twoFactorAuthTitle">Звʼязатись з адміністратором</h3>
                        <p class=" mb-1">
                            Вкажіть електронну адресу або номер телефону за якими ми зможемо звʼязатись з вами
                            найближчим часом.
                        </p>
                        <div class="mb-2 input-email-group-modal">
                            <label class="form-label" for="feedBackEmailInp">Електронна адреса</label>
                            <input class="form-control" id="feedBackEmailInp" type="email" name="login"
                                   placeholder="example@email.com" aria-describedby="feedBackEmailInp"
                                   autofocus="" tabindex="1" style="margin-bottom:5px;"/>
                            <a href="#" class="text-secondary text-decoration-underline link-to-numberInputModal">Увійти
                                використовуючи номер телефону</a>
                        </div>
                        <!-- КАСТОМІЗОВАНИЙ ІНПУТ для номеру телефону різних країн -->

                        <div class="input-number-group-modal inpSelectNumCountry"
                             style="padding-top: 2px; margin-bottom : 7px;">
                            <div class="mb-1 d-flex flex-column ">
                                <label class="form-label" for="feedBackNumberInp">Телефон</label>
                                <input class="form-control input-number-country" id="feedBackNumberInp"
                                       name="login"
                                       aria-describedby="feedBackNumberInp"
                                       autofocus=""/>
                                <a href="#" class="text-secondary text-decoration-underline link-to-emailInputModal"
                                   style="margin-top:5px;">Увійти використовуючи e-mail</a>
                            </div>
                        </div>
                        <!-- end input -->
                        <div class="">
                            <p class="m-0">Або звʼяжіться самостійно</p>
                            <ul class="">
                                <li>
                                    <p class="m-0"> Номер телефону: <a class="fw-medium-c text-secondary "
                                                                       href="tel:+38000000 тут ввести коректний номер">+38
                                            (088) 888 88 88</a></p>
                                </li>
                                <li>
                                    <p class="m-0"> Електронна адреса: <a class="fw-medium-c text-secondary"
                                                                          href="mailto: abc@example.com тут ввести коректний мейл">example@email.com</a>
                                    </p>
                                </li>
                            </ul>
                        </div>


                        <div class="col-12 mt-3">
                            <div class="d-flex float-end">
                                <button type="button" class="btn btn-link cancel-btn"
                                        data-dismiss="modal">Скасувати
                                </button>
                                <button id="nextStepAuth" class="btn btn-primary float-end " type="submit">
                                    <span class="me-50">Надіслати</span>

                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- = -->



    <!-- toast -->
    <div id="toastContainer" class=" d-none position-fixed  py-1 px-2 alert alert-success" role="alert"
         style="top: 30px;right:50px">
        text toast
    </div>

@endsection
