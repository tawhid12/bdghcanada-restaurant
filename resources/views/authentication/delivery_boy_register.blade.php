@extends('layouts.auth-master')

@section('title', 'Sign Up | Delivery Boy Register')

@section('content')

<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                            <h3 class="login-heading mb-4">Welcome! <br><strong>Registration For Delivery Boy</strong></h3>
                            <form action="{{ route('signUpregistrationStore') }}" method="POST">
                                @csrf
                                @if( Session::has('response') )
                                <div class="alert alert-{{Session::get('response')['class']}}" role="alert">
                                    {{Session::get('response')['message']}}
                                </div>
                                @endif
                                <div class="form-label-group">
                                    <input type="email" id="inputEmail" name="email" class="form-control @if($errors->has('email')) {{'is-invalid'}} @endif" placeholder="Email address" value="{{old('email')}}">
                                    <label for="inputEmail">Email address <!--/ Mobile--></label>
                                    @if($errors->has('email'))
                                    <small class="d-block text-danger mb-3">
                                        {{ $errors->first('email') }}
                                    </small>
                                    @endif
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" name="password" class="form-control @if($errors->has('password')) {{'is-invalid'}} @endif" placeholder="Password">
                                    <label for="inputPassword">Password</label>
                                    @if($errors->has('password'))
                                    <small class="d-block text-danger mb-3">
                                        {{ $errors->first('password') }}
                                    </small>
                                    @endif
                                </div>
                                <div class="form-label-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @if($errors->has('password_confirmation')) {{'is-invalid'}} @endif">
                                    <label for="password_confirmation">Confrim Password</label>
                                    @if($errors->has('password_confirmation'))
                                    <small class="d-block text-danger mb-3">
                                        {{ $errors->first('password_confirmation') }}
                                    </small>
                                    @endif
                                </div> 
                                <!-- <div class="form-label-group mb-4">
                                    <input type="text" id="ptext" class="form-control" placeholder="Promocode">
                                    <label for="ptext">Promocode</label>
                                </div> -->
                                <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign Up</button>
                                <div class="text-center pt-3">
                                    Already have an Account? <a class="font-weight-bold" href="{{route('signInForm')}}">Sign In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Log In page -->
@endsection