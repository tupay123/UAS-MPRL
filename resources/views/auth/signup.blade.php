@extends("frontend.master")

@section("title", "Sign Up - ".config("app.name"))
@section("content")
<style>

    .login-content {
        background: rgba(58, 43, 110, 0.25);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        padding: 40px;
        z-index: 1;
        position: relative;
        overflow: hidden;
    }
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
    .login-content h4 {
        color: #FFFFFF;
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
        font-size: 24px;
    }
    .form-control {
        background: rgba(74, 59, 126, 0.5) !important;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #FFFFFF !important;
        border-radius: 8px;
        padding: 12px 20px;
        transition: all 0.3s ease;
        margin-bottom: 15px;
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
        padding: 14px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(108, 77, 246, 0.3);
        margin-top: 10px;
    }
    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 77, 246, 0.4);
    }
    .btn-link {
        color: #6C4DF6 !important;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-link:hover {
        text-decoration: underline;
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
    }
    .terms-link {
        color: #B8B5C7;
        transition: all 0.3s ease;
    }
    .terms-link:hover {
        color: #6C4DF6;
        text-decoration: none;
    }
    .registration-disabled {
        text-align: center;
        padding: 30px;
    }
</style>

<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-8 m-auto">
                <div class="login-content">
                    @if ($enable_registration)
                    <h4>Create Your Account</h4>
                    @if ($errors->any())
                    <div class="alert alert-danger rounded-lg mb-4">
                        @foreach ($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('auth.signup') }}" class="sign-form widget-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Full Name*" name="name" value="{{ old('name') }}"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username*" name="username" value="{{ old('username') }}"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address*" name="email" value="{{ old('email') }}"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value=""/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password*" name="password_confirmation" value=""/>
                        </div>
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                                <input name="agree" value="1" type="checkbox" class="custom-control-input" id="agreeTerms"/>
                                <label class="custom-control-label" for="agreeTerms">I agree to the <a href="#" class="terms-link">Terms & Conditions</a></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center mt-4 mb-0 text-muted">Already have an account? <a href="{{ route('auth.login') }}" class="btn-link">Log In</a></p>
                    </form>
                    @else
                    <div class="registration-disabled">
                        <div class="alert alert-danger rounded-lg">
                            <span>User registration is currently disabled</span>
                        </div>
                        <p class="text-muted mt-3">Please contact support if you believe this is an error</p>
                        <a href="{{ route('auth.login') }}" class="btn-custom mt-3">Back to Login</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
