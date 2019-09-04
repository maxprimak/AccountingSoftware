<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
</head>

<body>
    <div class="auth-layout-wrap" style="background-image: url({{asset('assets/images/photo-wide-4.jpg')}})">
        <div class="auth-content">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-6 text-center " style="background-size: cover;background-image: url({{asset('assets/images/photo-long-3.jpg')}})">
                        <div class="pl-3 auth-right">
                            <div class="auth-logo text-center mt-4">
                                <img src="{{asset('assets/images/logo.png')}}" alt="">
                            </div>
                            <div class="flex-grow-1"></div>
                            <div class="w-100 mb-4">
                                <a class="btn btn-outline-primary btn-outline-google btn-block btn-icon-text btn-rounded">
                                    <i class="i-Google-Plus"></i> Sign up with Google
                                </a>
                                <a class="btn btn-outline-primary btn-outline-facebook btn-block btn-icon-text btn-rounded">
                                    <i class="i-Facebook-2"></i> Sign up with Facebook
                                </a>
                            </div>
                            <div class="flex-grow-1"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4">               
                            <h1 class="mb-3 text-18">Sign Up</h1>
                            <form action="/register" method="POST">
                            @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input required name="username" minlength="6" id="username" class="form-control form-control-rounded" value="{{ old('username') }}" type="text">
                                    @if ($errors->has('username'))
                                        <p class="help-block">{{ $errors->first('username') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input required name="email" id="email" class="form-control form-control-rounded" type="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <p class="help-block">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input required name="password" minlength="8" id="password" class="form-control form-control-rounded" type="password" value="{{ old('password') }}">
                                    @if ($errors->has('password'))
                                        <p class="help-block">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="repassword">Retype password</label>
                                    <input required name="repassword" id="repassword" class="form-control form-control-rounded" type="password" value="{{ old('repassword') }}">
                                    @if ($errors->has('repassword'))
                                        <p class="help-block">{{ $errors->first('repassword') }}</p>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-rounded mt-3">Sign Up</button>
                                <div class="mt-3 text-center">
                                    <a href="/login" class="text-muted"><u>Already have an account? Log in</u></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/common-bundle-script.js')}}"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
