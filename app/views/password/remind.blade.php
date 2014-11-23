
@extends('layouts.master')
@section('content')
    @include('headers.logo_bar')
        
        @if(Session::has('error'))
            @include("modals.passwordRemindError")
        @endif

        @if(Session::has('status'))
             @include("modals.passwordRemindConfirm")
        @endif
        <div class="container-fluid">
            <!-- <form action="{{ action('RemindersController@postRemind') }}" method="POST">
                {{ Form::token() }}
                <input type="email" name="email">
                <input type="submit" value="Send Reminder">

            </form> -->
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <form id="password-reminder-form" action="{{ action('RemindersController@postRemind') }}" method="POST">
                        {{ Form::token() }}
                        <div class="form-group">
                            <h2 class="text-center text-info">Enter Your Email</h2>
                        </div>
                        <div class="form-group">
                            <label for="send-reminder" class="control-label text-info">
                                Email
                            </label>
                            
                                <input name="email" id ="send-reminder" type="email" placeholder="yourmail@gmail.com" class="form-control">
                        </div>  
                        
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="submit" value="Send Reminder" class="btn  btn-block btn-lg btn-primary">
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