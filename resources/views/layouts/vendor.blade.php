<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>
        @yield('title') | Vendor Dashboard
    </title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png')}}">

    <!-- Your custom styles (optional) -->
    <link href="{{ asset('assets/css/adminstyle.css')}}" rel="stylesheet">

    <!-- Data Table Css -->
    <link href="{{ asset('assets/sb/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- summernote text editor css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    {{-- Start bootstarp --}}
    <link href="{{ asset('assets/sb/css/sb-admin-2.min.css')}}" rel="stylesheet">

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top">

    <!----------------------------------------- START INCLUDES  -------------------------------------->

    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader">
        <div id="loader-logo">
            <img src="{{ asset('assets/img/logo.png')}}" width='80px'>
        </div>
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    <div id="wrapper">

        @include('layouts.inc.vendorsidebar')

        <!-- main layout -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('layouts.inc.vendornavbar')

                <div class="">
                    @yield('content')
                </div>

                <span onclick="topFunction()" id="downToTop" title="Go to top" class="shadow">
                    <i class="fas fa-chevron-up"></i>
                </span>

                @include('layouts.inc.vendorfooter')

            </div>

        </div>

    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are sure you want to Logout.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!----------------------------------------- JAVA SCRIPT SECTION  -------------------------------------->

    {{-- Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    {{-- Custom JS --}}
    <script type="text/javascript" src="{{ asset('assets/js/admincustom.js') }}"></script>

    {{-- Start bootstarp core javascript --}}
    <script type="text/javascript" src="{{ asset('assets/sb/vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/sb/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    {{-- Start bootstarp core plugin Javascript --}}
    <script type="text/javascript" src="{{ asset('assets/sb/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    {{-- Start bootstarp custom scripts for all pages --}}
    <script type="text/javascript" src="{{ asset('assets/sb/js/sb-admin-2.min.js')}}"></script>

    <!-- Summer note JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <!-- Auto Slug JS -->
    <script type="text/javascript" src="{{ asset('assets/js/auto_slug.js') }}"></script>

    <!-- Text editor JS -->
    <script type="text/javascript" src="{{ asset('assets/js/text_editor.js') }}"></script>

    <!-- 404 svg -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js"></script>

    <!-- Data Tables CDN JS -->
    <script type="text/javascript" src="{{ asset('assets/sb/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/sb/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Datatable JS -->
    <script type="text/javascript" src="{{ asset('assets/js/data_table.js') }}"></script>

    {{-- Select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-products').select2();
        });
    </script>

    @yield('scripts')

</body>

</html>
