<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Log In | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('hyper/saas/assets/images/favicon.ico')}}">

    <!-- Theme Config Js -->
    <script src="{{asset('hyper/saas/assets/js/hyper-config.js')}}"></script>

    <!-- App css -->
    <link href="{{asset('hyper/saas/assets/css/app-saas.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

    <link rel="stylesheet" href="{{asset('hyper/saas/assets/vendor/jquery-toast-plugin/jquery.toast.min.css')}}">

    <!-- Icons css -->
    <link href="{{asset('hyper/saas/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
</head>

<body class="authentication-bg pb-0">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="card-body d-flex flex-column h-100 gap-3">

            <!-- Logo -->
            <div class="auth-brand text-center text-lg-start">
                <a href="index.html" class="logo-dark">
                    <span><img src="{{asset('hyper/saas/assets/images/logo-dark.png')}}" alt="dark logo"
                               height="22"></span>
                </a>
                <a href="index.html" class="logo-light">
                    <span><img src="{{asset('hyper/saas/assets/images/logo.png')}}" alt="logo" height="22"></span>
                </a>
            </div>

            <div class="my-auto">
                <!-- title-->
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-4">Enter your email address and password to access account.</p>

                <!-- form -->
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email address</label>
                        <input name="userName" required value="{{old('userName')}}" class="form-control" type="email"
                               id="emailaddress" placeholder="Enter your email">
                        {{$errors->has('userName') ? $errors->first('userName') : '' }}
                    </div>
                    <div class="mb-3">
                        <a href="pages-recoverpw-2.html" class="text-muted float-end"><small>Forgot your
                                password?</small></a>
                        <label for="password" class="form-label">Password</label>
                        <input name="password" required true value="{{old('password')}}" class="form-control"
                               type="password"
                               id="password" placeholder="Enter your password">
                        {{$errors->has('password') ? $errors->first('password') : '' }}
                    </div>
                    {{-- <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signin">
                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                        </div> --}}

                    <div class="d-grid mb-0 text-center">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Log In</button>
                    </div>
                    <!-- social-->
                    <div class="text-center mt-4">
                        <p class="text-muted font-16">Sign in with</p>
                        <ul class="social-list list-inline mt-3">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                        class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                        class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                        class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                        class="mdi mdi-github"></i></a>
                            </li>
                        </ul>
                    </div>
                </form>
            @if(isset($erro) and !empty($erro)) {{$erro}} @else '' @endif
            </div>
            <!-- Footer-->
            <footer class="footer footer-alt">
                <p class="text-muted">Don't have an account? <a href="pages-register-2.html" class="text-muted ms-1"><b>Sign
                            Up</b></a></p>
            </footer>

        </div> <!-- end .card-body -->
    </div>
    <!-- end auth-fluid-form-box-->

    <!-- Auth fluid right content -->
    <div class="auth-fluid-right text-center">
        <div class="auth-user-testimonial">
            <h2 class="mb-3">I love the color!</h2>
            <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a elegent templete. I love it very much! . <i
                    class="mdi mdi-format-quote-close"></i>
            </p>
            <p>
                - Hyper Admin User
            </p>
        </div> <!-- end auth-user-testimonial-->
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->
<!-- Vendor js -->
<script src="{{asset('hyper/saas/assets/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('hyper/saas/assets/js/app.min.js')}}"></script>
<script src="{{asset('hyper/saas/assets/js/app.min.js')}}"></script>

<script src="{{asset('hyper/saas/assets/vendor/jquery-toast-plugin/jquery.toast.min.js')}}"></script>

<!-- Toastr Demo js -->
<script src="{{asset('hyper/saas/assets/js/pages/demo.toastr.js')}}"></script>


</body>

</html>