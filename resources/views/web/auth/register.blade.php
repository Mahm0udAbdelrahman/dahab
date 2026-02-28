<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ __('Login - Dahab') }}</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/slick-theme.css') }}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/nouislider.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome.min.css') }}" />

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/style.css') }}" />

    @stack('css')

    <style>
        /* تسجيل دخول ستايل مخصص */
        .auth-section {
            padding: 60px 0;
            background: #f8f8f8;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .auth-box {
            background: #fff;
            border-radius: 10px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            max-width: 450px;
            margin: auto;
            width: 100%;
        }

        .auth-box h3 {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .auth-box p {
            color: #777;
            margin-bottom: 25px;
        }

        .auth-box .form-control {
            height: 45px;
            border-radius: 5px;
            font-size: 14px;
        }

        .auth-box .btn-login {
            width: 100%;
            height: 45px;
            background: #d10024;
            color: #fff;
            font-weight: 600;
            border-radius: 5px;
            border: none;
            transition: background 0.3s ease;
        }

        .auth-box .btn-login:hover {
            background: #b8001f;
        }

        .auth-links {
            margin-top: 20px;
            text-align: center;
        }

        .auth-links a {
            color: #d10024;
            font-weight: 500;
            text-decoration: none;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>


    <!-- LOGIN SECTION -->
    <section class="auth-section">
        <div class="container">
            <div class="auth-box">
                <h3>{{ __('Register') }}</h3>
                <p>{{ __('Create account') }}</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Phone') }}</label>
                        <input type="text" name="phone" class="form-control" placeholder="{{ __('Phone') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Password') }}</label>
                        <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Confirmed Password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="{{ __('Confirm Password') }}" required>

                    </div>
                    <button type="submit" class="btn-login btn">{{ __('Register') }}</button>
                </form>

                <div class="auth-links">
                    <p>
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('view_login') }}">{{ __('Login') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /LOGIN SECTION -->

    <!-- FOOTER -->
    @include('web.layouts.fooder')
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="{{ asset('web/js/jquery.min.js') }}"></script>
    <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/js/slick.min.js') }}"></script>
    <script src="{{ asset('web/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('web/js/main.js') }}"></script>
    @stack('js')

    <!-- toastr js & notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if (session()->has('message'))
        <script>
            toastr["{{ session('message.type') }}"]("{!! session('message.text') !!}");
        </script>
    @endif

    @if ($errors->any())
        <script>
            toastr.error("{{ $errors->first() }}");
        </script>
    @endif

</body>

</html>
