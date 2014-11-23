
<!-- @if(Session::has('error'))
    @include("modals.loginModals")
@endif -->


<!-- <form action="{{ action('RemindersController@postReset') }}" method="POST">
    {{ Form::token() }}
    <input type="hidden" name="token" value="{{ $token }}">
    Email: <input type="email" name="email">
    Password: <input type="password" name="password">
    Confirm password: <input type="password" name="password_confirmation">
    <input type="submit" value="Reset Password">
</form> -->

@extends('layouts.master')
@section('content')
    @include('headers.logo_bar')
        
        @if(Session::has('error'))
            @include("modals.passwordRemindError")
        @endif
        <div class="container-fluid">
            <!-- <form action="{{ action('RemindersController@postRemind') }}" method="POST">
                {{ Form::token() }}
                <input type="email" name="email">
                <input type="submit" value="Send Reminder">

            </form> -->
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <form action="{{ action('RemindersController@postReset') }}" method="POST">
                        {{ Form::token() }}
    					<input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <h2 class="text-center text-info">Enter Your Email and new password</h2>
                        </div>
                        <div class="form-group">
                            <label for="user-email" class="control-label text-info">
                                Email
                            </label>
                            <input name="email" id ="user-email" type="email" placeholder="yourmail@some.com" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="new-password" class="control-label text-info">
                                Password
                            </label>
                            <input name="password" id ="new-password" type="password" placeholder="your new password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="new-password-confirm" class="control-label text-info">
                                Confirm Password
                            </label>
                            <input name="password_confirmation" id ="new-password-confirm" type="password" placeholder="password confirm" class="form-control">
                        </div> 
                        
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="submit" value="Reset Password" class="btn  btn-block btn-lg btn-primary">
                                    </div>
                                </div>
                        </div>
                        
                    </form> 
                    
                </div>
            </div>
        </div>
    @include('footers.index')
    @include('js_footers.index')
@stop