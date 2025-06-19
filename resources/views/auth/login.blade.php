@extends("frontend.master")

@section("title", "Log In - ".config("app.name"))
@section("content")
<style>


    @media (min-width: 768px) {
        .login {
            padding-top: 0%;
            padding-bottom: 0px;
        }
    }

    .login-content {
        background: rgba(58, 43, 110, 0.25);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        padding: 20px;
        z-index: 1;
        position: relative;
        overflow: hidden;
        margin: 0 15px;
    }

    @media (min-width: 768px) {
        .login-content {
            padding: 30px;
            margin: 0;
        }
    }

    @media (min-width: 992px) {
        .login-content {
            padding: 40px;
        }
    }

    .login-content h4 {
        color: #FFFFFF;
        text-align: center;
        margin-bottom: 20px;
        font-weight: 600;
        font-size: 20px;
    }

    @media (min-width: 768px) {
        .login-content h4 {
            font-size: 22px;
            margin-bottom: 25px;
        }
    }

    @media (min-width: 992px) {
        .login-content h4 {
            font-size: 24px;
            margin-bottom: 30px;
        }
    }

    .form-group {
        margin-bottom: 15px;
    }

    @media (min-width: 768px) {
        .form-group {
            margin-bottom: 20px;
        }
    }

    .form-control {
        background: rgba(74, 59, 126, 0.5) !important;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #FFFFFF !important;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s ease;
        font-size: 14px;
        height: 45px;
    }

    @media (min-width: 768px) {
        .form-control {
            padding: 12px 20px;
            font-size: 15px;
            height: 48px;
        }
    }

    .btn-custom {
        padding: 10px;
        font-size: 14px;
        margin-top: 10px;
    }

    @media (min-width: 768px) {
        .btn-custom {
            padding: 12px;
            font-size: 15px;
            margin-top: 15px;
        }
    }

    .sign-controls {
        margin-bottom: 10px !important;
    }

    .text-muted {
        font-size: 13px;
        margin-top: 15px;
    }

    @media (min-width: 768px) {
        .text-muted {
            font-size: 14px;
            margin-top: 20px;
        }
    }

    /* Tetap pertahankan style lainnya yang sudah ada */
    .login-content::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(108, 77, 246, 0.1) 0%, rgba(108, 77, 246, 0) 70%);
        z-index: -1;
    }

    .form-control:focus {
        background: rgba(74, 59, 126, 0.7) !important;
        border-color: rgba(108, 77, 246, 0.5);
        box-shadow: 0 0 0 0.2rem rgba(108, 77, 246, 0.25);
    }

    .form-control::placeholder {
        color: rgba(184, 181, 199, 0.7) !important;
    }

    .btn-custom {
        background: linear-gradient(135deg, #6C4DF6 0%, #5A3EE4 100%);
        color: #FFFFFF;
        border: none;
        width: 100%;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(108, 77, 246, 0.3);
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 77, 246, 0.4);
    }

    .btn-link {
        color: #B8B5C7 !important;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-link:hover {
        color: #6C4DF6 !important;
        text-decoration: none;
    }

    .custom-control-label {
        color: #E0DDF2;
        cursor: pointer;
    }

    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
        background-color: #6C4DF6;
        border-color: #6C4DF6;
    }

    .alert-danger {
        background: rgba(255, 62, 62, 0.2);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 62, 62, 0.3);
        color: #FFFFFF;
        padding: 10px 15px;
        font-size: 13px;
        margin-bottom: 15px;
    }

    @media (min-width: 768px) {
        .alert-danger {
            padding: 12px 20px;
            font-size: 14px;
            margin-bottom: 20px;
        }
    }

    .forgot-password {
        color: #B8B5C7;
        font-size: 13px;
    }

    @media (min-width: 768px) {
        .forgot-password {
            font-size: 14px;
        }
    }
</style>

<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-5 m-auto">
                <div class="login-content">
                    <h4>Welcome Back</h4>
                    @if ($errors->any())
                    <div class="alert alert-danger rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('auth.login') }}" class="sign-form widget-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email or Username" name="email_or_username" value="{{ old('email_or_username') }}"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password"/>
                        </div>
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" value="1" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember me</label>
                            </div>
                            <a href="#" class="forgot-password">Forgot password?</a>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Log In</button>
                        </div>
                        <p class="text-center text-muted">Don't have an account? <a href="{{ route('auth.signup') }}" class="btn-link">Sign up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
