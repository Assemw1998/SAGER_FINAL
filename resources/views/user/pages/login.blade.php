@extends('user.layouts.authorization')
@section('content')
    <link href = {{ asset("custom/user/css/authorization.css") }} rel="stylesheet" />
    <div class="container">
        <div id="login-box">
            <div class="logo">
                <!-- <img src={{ asset("images/public/sager_logo.png") }} class="img img-responsive"/> -->
                <h1 class="logo-caption"><span class="tweak">Us</span>er <span class="tweak">Lo</span>gin</h1>
               
            </div>
            <div class="controls">
                @include('user.layouts.partials.message')
                <form  action="{{ url('LogInAu')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="inputs-label">Email</label>
                        <input type="text" id="email"  name="email" value="{{old('email')}}" placeholder="Email" class="user-data form-control" required />
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif

                    <div class="form-group">
                        <label for="password" class="inputs-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="user-data form-control" required />
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{$errors->first('password') }}</span>
                    @endif
                    <div class="d-flex justify-content-center">
                        <button type="submit" id="login-register-btn" class="btn btn-default btn-block btn-custom w-50">Login</button> 
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <p class="text-light h5"><small>Doesn't have an account <a href="{{ url('register')}}">register</a></small></p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="forget-the-password" href="{{ url('foget_the_password')}}" >Forget The Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
    <script type="text/javascript" src={{ asset("custom/user/js/authorization.js") }}></script> 
@endsection