<!doctype html>
<html>
<head>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('hyper/saas/assets/images/favicon.ico')}}">

    <!-- Theme Config Js -->
    <script src="{{asset('hyper/saas/assets/js/hyper-config.js')}}"></script>

    <!-- App css -->
    <link href="{{asset('hyper/saas/assets/css/app-saas.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

    <!-- Apex charts -->
    <script src="{{asset('hyper/saas/assets/js/charts/apexcharts.min.js')}}"/>

    <!-- Icons css -->
    <link href="{{asset('hyper/saas/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{asset('hyper/saas/assets/vendor/daterangepicker/daterangepicker.css')}}"
          type="text/css"/>


    <meta name="csrf-token" content="{{ csrf_token() }}">


    @include('includes.head')
</head>
<body>
@include('includes.header')
<div class="content-page">
    <div class="content">
    </div>
    <div id="content" class="col page">
        <div class="page-title-box">
            <span class="page-title"> @yield('tittle','Default')</span>
        </div>
        @yield('content')
    </div>
</div>

{{--<!-- Vendor js -->--}}
<script src="{{asset('hyper/saas/assets/js/vendor.min.js')}}"></script>

<!-- Code Highlight js -->
<script src="{{asset('hyper/saas/assets/vendor/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('hyper/saas/assets/js/hyper-syntax.js')}}"></script>
<!-- Daterangepicker js -->
<script src="{{asset('hyper/saas/assets/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('hyper/saas/assets/vendor/daterangepicker/daterangepicker.js')}}"></script>

<!-- App js -->
<script src="{{asset('hyper/saas/assets/js/app.min.js')}}"></script>

{{--<!-- Apex Chart js -->--}}
{{--<script src="{{asset('hyper/saas/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>--}}

{{--<!-- Apex Chart Pie Demo js -->--}}
{{--<script src="{{asset('hyper/saas/assets/js/pages/demo.apex-pie.js')}}"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>--}}
</body>

</html>
