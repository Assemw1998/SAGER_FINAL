@extends('user.layouts.authorization')
@section('content')
    <link href = {{ asset("custom/user/css/authorization.css") }} rel="stylesheet" />
    <div class="container">
        <div id="login-box">
            <div class="logo">
                <!-- <img src={{ asset("images/public/sager_logo.png") }} class="img img-responsive"/> -->
                <h1 class="logo-caption"><span class="tweak">Foget</span> The <span class="tweak">Password</span></h1>
                
            </div>
            <div class="controls">
                @include('user.layouts.partials.message')
                <form  action="{{ url('FogetThePasswordAu')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="inputs-label">Email</label>
                        <input type="text" id="email"  name="email" value="{{old('email')}}" placeholder="Email" class="user-data form-control" required />
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" id="foget-the-password" class="btn btn-default btn-block btn-custom w-50">Send The Password</button>
                        
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <a class="forget-the-password mr-2" href="{{ url('login')}}">Login</a>
                        <a class="forget-the-password" href="{{ url('register')}}" >Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
    <script type="text/javascript" src={{ asset("custom/user/js/authorization.js") }}></script> 
@endsection