@extends('layouts.auth-master')

@section('title', 'Log In')

@section('content')
<!-- Log In page -->
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                            <h3 class="login-heading mb-4">Welcome back!</h3>
                            <form action="{{route('logIn')}}" method="POST">
                                @csrf
                                @if( Session::has('response') )
                                <div class="alert alert-{{Session::get('response')['class']}}" role="alert">
                                    {{Session::get('response')['message']}}
                                </div>
                                @endif
                                <div class="form-label-group">
                                    <input type="text" id="username" class="form-control @if($errors->has('username')) {{'is-invalid'}} @endif" placeholder="username" value="{{old('username')}}" autocomplete="off" name="username">
                                    <label for="username">Email address / Mobile</label>
                                </div>
                                @if($errors->has('username'))
                                <small class="d-block text-danger mb-3">
                                    {{ $errors->first('username') }}
                                </small>
                                @endif
                                <div class="form-label-group">
                                    <input type="password" id="password" class="form-control  @if($errors->has('password')) {{'is-invalid'}} @endif" placeholder="Password" value="{{old('password')}}" autocomplete="off" name="password">
                                    <label for="password">Password</label>
                                </div>
                                @if($errors->has('password'))
                                <small class="d-block text-danger mb-3">
                                    {{ $errors->first('password') }}
                                </small>
                                @endif
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember password</label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign in</button>
                                </form>
                                <div class="text-center pt-3">
                                    Don’t have an account? <a class="font-weight-bold" href="{{route('signUpForm')}}">Sign Up</a>
                                </div>
                                <div class="text-center pt-3">
                                   <a class="font-weight-bold" href="{{route('forgotPasswordForm')}}">Forgot Password</a>
                                </div>
                            <!-- <hr class="my-4">
                            <p class="text-center">LOGIN WITH</p>
                            <div class="row">
                                <div class="col pr-2">
                                    <button class="btn pl-1 pr-1 btn-lg btn-google font-weight-normal text-white btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Google</button>
                                </div>
                                <div class="col pl-2">
                                    <button class="btn pl-1 pr-1 btn-lg btn-facebook font-weight-normal text-white btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Facebook</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection