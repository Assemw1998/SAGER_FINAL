@extends('user.layouts.authorization')
@section('content')
    <link href = {{ asset("custom/user/css/authorization.css") }} rel="stylesheet" />
    <div class="container">
        <div id="login-box">
            <div class="logo">
                <!-- <img src={{ asset("images/public/sager_logo.png") }} class="img img-responsive"/> -->
                <h1 class="logo-caption"><span class="tweak">Us</span>er <span class="switch-caption">Login</span></h1>
            </div>
            <div class="controls">
                <form id="submit_form" action="/SignIn" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="user_email" class="inputs-label">Email</label>
                        <input type="text" id="user_email"  name="user_email" value="{{old('user_email')}}" placeholder="Email" class="user-data form-control" required />
                    </div>

                    <div class="first-last-name-area"></div>
                    <div class="form-group">
                        <label for="user_password" class="inputs-label">Password</label>
                        <input type="password" id="user_password" name="user_password" placeholder="Password" class="user-data form-control" required />
                    </div>
       
                    <div class="confirm-password"></div>
                    <div class="d-flex justify-content-center">
                        <button type="button" id="login-register-btn" class="btn btn-default btn-block btn-custom w-50">Login</button> 
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <p class="text-light h5"><small><span class="have-account-switch">Doesn't have an account</span> <a id="register-anchor" href="Register">register</a></small></p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="forget-the-password" href="{{ url('FogetThePassword')}}" >Forget The Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
    <script type="text/javascript" src={{ asset("custom/user/js/authorization.js") }}></script> 
@endsection