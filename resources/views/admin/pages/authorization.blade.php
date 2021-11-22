@extends('admin.layouts.authorization')
@section('content')
    <link href = {{ asset("custom/admin/css/authorization.css") }} rel="stylesheet" />
    <div class="container">
        <div id="login-box">
            <div class="logo">
                <img src={{ asset("images/public/sager_logo.png") }} class="img img-responsive"/>
                <h1 class="logo-caption"><span class="tweak">Ad</span>min <span class="tweak">Lo</span>gin</h1>
            </div>
            <div class="controls">
                <form action="login_admin" method="post">
                    <div class="form-group">
                        <label for="email_username" class="inputs-label">Email/Username</label>
                        <input type="text" id="email_username" value=""name="email_username" placeholder="Email/Username" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="password" class="inputs-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control" required />
                    </div>
                    <button type="submit" class="btn btn-default btn-block btn-custom">Login</button> 
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
    <script type="text/javascript" src={{ asset("custom/admin/js/authorization.js") }}></script> 
@endsection