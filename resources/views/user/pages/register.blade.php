@extends('user.layouts.authorization')
@section('content')
    <link href = {{ asset("custom/user/css/authorization.css") }} rel="stylesheet" />
    <div class="container">
        <div id="login-box" style="top:10%!important;">
            <div class="logo">
                <!-- <img src={{ asset("images/public/sager_logo.png") }} class="img img-responsive"/> -->
                <h1 class="logo-caption"><span class="tweak">Us</span>er <span class="tweak">Regi</span>ster</h1>
            </div>
            <div class="controls">
                <form  action="{{ url('Register')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="inputs-label">Email</label>
                        <input type="text" id="email"  name="email" value="{{old('email')}}" placeholder="Email" class="user-data form-control" required />
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                    <div class="form-group">
                        <label for="first_name" class="inputs-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{old('first_name')}}" placeholder="First Name" class="user-data form-control" required />
                    </div> 
                    @if ($errors->has('first_name'))
                        <span class="text-danger text-left">{{ $errors->first('first_name') }}</span>
                    @endif
                    <div class="form-group">
                        <label for="last_name" class="inputs-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}" placeholder="Last Name" class="user-data form-control" required />
                    </div>
                    @if ($errors->has('last_name'))
                        <span class="text-danger text-left">{{ $errors->first('last_name') }}</span>
                    @endif
                    <div class="form-group">
                        <label for="password" class="inputs-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="user-data form-control" required />
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                    <div class="form-group">
                        <label for="password_confirmation" class="inputs-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="user-data form-control" required />
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                    <div class="d-flex justify-content-center">
                        <button type="submit" id="login-register-btn" class="btn btn-default btn-block btn-custom w-50">Register</button> 
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <p class="text-light h5"><small>Have an account <a href="{{ url('/')}}">login!</a></small></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
    <script type="text/javascript" src={{ asset("custom/user/js/authorization.js") }}></script> 
@endsection