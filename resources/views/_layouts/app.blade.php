<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta content="strict-origin-when-cross-origin" name="referrer">
    <title>@yield('pageTitle', 'Home') | {{ config('app.name') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- endbootstrap css -->
    <!-- data table cdn -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css" />
    <!-- end data table cdn -->
</head>

<!-- Body -->

<body class="with-welcome-text">
    <div class="container-scroller">
        @include('_layouts.header')
        <div class="container-fluid page-body-wrapper">
            @include('_layouts.sidebar')

            {{-- start Main content --}}
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                        aria-labelledby="overview">
                                        {{-- <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <p class="statistics-title">Bounce Rate</p>
                                                            <h3 class="rate-percentage">32.53%</h3>
                                                            <p class="text-danger d-flex"><i
                                                                    class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                                                        </div>
                                                        <div>
                                                            <p class="statistics-title">Page Views</p>
                                                            <h3 class="rate-percentage">7,682</h3>
                                                            <p class="text-success d-flex"><i
                                                                    class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                                                        </div>
                                                        <div>
                                                            <p class="statistics-title">New Sessions</p>
                                                            <h3 class="rate-percentage">68.8</h3>
                                                            <p class="text-danger d-flex"><i
                                                                    class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                                        </div>
                                                        <div class="d-none d-md-block">
                                                            <p class="statistics-title">Avg. Time on Site</p>
                                                            <h3 class="rate-percentage">2m:35s</h3>
                                                            <p class="text-success d-flex"><i
                                                                    class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                                                        </div>
                                                        <div class="d-none d-md-block">
                                                            <p class="statistics-title">New Sessions</p>
                                                            <h3 class="rate-percentage">68.8</h3>
                                                            <p class="text-danger d-flex"><i
                                                                    class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                                        </div>
                                                        <div class="d-none d-md-block">
                                                            <p class="statistics-title">Avg. Time on Site</p>
                                                            <h3 class="rate-percentage">2m:35s</h3>
                                                            <p class="text-success d-flex"><i
                                                                    class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                @include('_layouts.footer')
            </div>
            {{-- end Main content  --}}
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    @include('_layouts.script')
</body>

</html>
