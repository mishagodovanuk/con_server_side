<!DOCTYPE html>
<html lang="{{ (app()->getLocale() == 'ua')?'uk': app()->getLocale()}}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('images/ico/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- END: Vendor CSS-->
    @yield('before-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}"/>
    <link rel="stylesheet" href="{{ asset(mix('css/base/themes/dark-layout.css')) }}"/>
    <link rel="stylesheet" href="{{ asset(mix('css/base/themes/bordered-layout.css')) }}"/>
    <link rel="stylesheet" href="{{ asset(mix('css/base/themes/semi-dark-layout.css')) }}"/>

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}"/>

    <link rel="stylesheet" href="{{ asset(mix('css/base/core/menu/menu-types/horizontal-menu.css')) }}"/>

    <!-- laravel style -->
    <link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}"/>

    <link rel="stylesheet" href="{{ asset('css/style.css')}}"/>

    @yield('page-style')
</head>
@php
    $currentLang = App\Http\Middleware\LocaleMiddleware::getLocale();
    $arrayLang = App\Http\Middleware\LocaleMiddleware::$languages;
    $languageTitles = \App\Http\Middleware\LocaleMiddleware::$languageTitles;
@endphp
<body class="horizontal-layout horizontal-menu  navbar-floating footer-static" data-open="hover"
      data-menu="horizontal-menu" data-col="" data-framework="laravel" data-asset-path="{{ asset('/')}}">

<!-- BEGIN: Header-->
@include('panels.navbar', ['doctypes' => \App\Models\DocumentType::whereNotNull('key')->get(['id', 'name'])])
<!-- END: Header-->

<!-- BEGIN: Bookmarks -->
<x-bookmark/>
<!-- END: Bookmarks -->

<!-- BEGIN: Content-->
<div class="content">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-area-wrapper container-xxl p-0">

        <div class="content-wrapper">
            <div class="content-body admin-body">
                {{-- Include Page Content --}}
                @yield('content')
            </div>
        </div>
    </div>

</div>
<!-- End: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>

<script src="{{ asset(mix('js/core/app.js')) }}"></script>

@yield('table-js')

<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>

<script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>

<script src="{{ asset('assets/js/entity/panels/bookmarks.js')}}"></script>
<script src="{{asset('assets/js/entity/workspace/navbar-workspace.js')}}"></script>
<script src="{{asset('assets/js/utils/validationInputs.js')}}"></script>
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
<script src="{{asset(mix('js/scripts/forms/form-select2.js'))}}"></script>

{{--Це для іконок--}}
<script>
// переклад документ нейм ТИМЧАСОВЕ РІШЕННЯ ЗА ГОДИНУ ДО ДЕМКИ !!!!
function translateDoctypes() {

    const selectedLanguage = localStorage.getItem('Language');

    const translations = {
        'Товарна накладна': 'Invoices',
        'Замовлення': 'Order',
        'Прихід від постачальника': 'Supplier Arrival',
        'Списання': 'Write-Off',
        'Внутрішнє переміщення': 'Internal Transfer',
        'Запит на транспорт': 'Request for tranportation',
        'Запит на вантаж': 'Cargo Request',
        'Заявки на прийом': 'Applications for cargo',
        'Заявка на відвантаження': 'Shipping Request',
        'ТТН': 'E-Waybill',
        'Замовлення': 'Order',
        'Списання': "Debiting"
    };

    $('.titles-doctypes').each(function() {
        const currentText = $(this).text();
        const newText = selectedLanguage === 'ua' ? currentText : translations[currentText];

        $(this).text(newText);
    });
};

setTimeout(() => {
    translateDoctypes()
}, 2000);

    function toggleClassOpen(element) {
        translateDoctypes()
        var loadedScripts = document.scripts;
        var isJqxInDocument = false;
        for (var i = 0; i < loadedScripts.length; i++) {
            if (loadedScripts[i].src.includes('jqxgrid.filter.js')) {
                isJqxInDocument = true;
                break;
            }
        }

        if (window.innerWidth < 1200 && isJqxInDocument) {
            $(element).toggleClass("open");
        }
    }

    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })

    $(document).on('click ', function (event) {
        feather.replace({
            width: 14,
            height: 14
        });
    });
</script>

<script type="module">
    import {selectDictionaries} from '{{asset('assets/js/utils/selectDictionaries.js')}}';

    selectDictionaries()
</script>

<script>
    if (!localStorage.getItem("Language")) {
        localStorage.setItem("Language", "en");
    }
    const {pathname}= window.location;

    if (pathname.includes('/uk')) {
        $('#dropdown-flag').find('i').addClass('flag-icon-ua')
        $('#dropdown-flag .selected-language').attr('data-i18n', 'LangTitleUA').text("Українська");
        localStorage.setItem("Language", 'ua');
    } else  {
        $('#dropdown-flag').find('i').addClass('flag-icon-us')
        $('#dropdown-flag .selected-language').attr('data-i18n', 'LangTitleEN').text("English");
        localStorage.setItem("Language", 'en');
    }
</script>

{{--<script type="module" src="{{asset('assets/libs/darkReader/darkReader.js')}}"></script>--}}

{{--<script type="module" src="{{asset('assets/js/utils/darkReader.js')}}"></script>--}}

@yield('page-script')

</body>

</html>

