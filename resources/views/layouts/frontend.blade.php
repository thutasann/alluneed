<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title class='title'>
        AllUNeed | @yield('title')
    </title>

    <meta name="description" content="@yield('meta_desc')">
    <meta name="keywords" content="@yield('meta_keyword')">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png')}}">

    <!-- Material Design Bootstrap -->
    <link href="{{ asset('assets/css/mdb.min.css')}}" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="{{ asset('assets/css/customstyle.css')}}" rel="stylesheet">

    <!--  Alertify CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/alertify.min.css')}}"/>

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin|Herr+Von+Muellerhoff|Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Rubik:wght@300;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sedgwick+Ave+Display" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    {{-- autocomplete jquery UI --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

<body>


    <!---------------------------------------- START INCLUDES  -------------------------------------->

    <!-- Start Page Loading -->
    {{-- <div id="loader-wrapper">
        <div id="loader">
        <div id="loader-logo">      
            <img src="{{ asset('assets/img/logo.png')}}" width='80px'>
        </div>
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div> --}}

    @include('layouts.inc.front-navbar')

    <main>
        @yield('content')
    </main>

    <span onclick="topFunction()" id="downToTop" title="Go to top" class="shadow">
        <i class="fas fa-chevron-up"></i>
    </span>

    @include('layouts.inc.front-footer')




    <!----------------------------------------- JAVA SCRIPT SECTION  -------------------------------------->

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    
    <!-- Custom JS -->
    <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>

    <!-- Alertify JS -->
    <script src="{{ asset('assets/js/alertify.min.js') }} "></script>

    <!-- Autocomplete Country JS -->
    <script type="text/javascript" src="{{ asset('assets/js/auto-complete.js') }} "></script>

    {{-- autocomplete jquery UI --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- progress bar (review) -->
    <script type="text/javascript" src="{{ asset('assets/js/progress-bar/progress_review.js') }} "></script>

    <!-- Like Unlike (product_view) -->
    <script type="text/javascript" src="{{ asset('assets/js/progress-bar/like_unlike.js') }} "></script>

    <!-- progress bar (profile) -->
    <script type="text/javascript" src="{{ asset('assets/js/progress-bar/progress_profile.js') }} "></script>


    @yield('scripts')

</body>

</html>