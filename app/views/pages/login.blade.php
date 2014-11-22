@extends('layouts.master')
@section('content')
    @include('headers.logo_bar')
    <div class="container-fluid">
        
        @if(Session::has('error'))
            @include("modals.loginModals")
        @endif
        
        
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                {{ Form::open(array('url' => 'login', 'role' => 'form', 'id' => 'form-login', 'class' => 'form-horizontal')) }}
                    <div class="form-group">
                        <h2 class="text-center text-info">Please Login</h2>
                    </div>
                    <div class="form-group">
                        <label for="user-name-input" class="col-lg-3 control-label text-info">
                            User Name
                        </label>
                        <div class="col-lg-8">
                            <input name="name" id ="user-name-input" type="text" placeholder="Company Name" class="form-control" value="{{ $visitor_data['name'] }}">
                        </div>
                    </div>  
                    <br>
                    <div class="form-group">
                        <label for="password" class="col-lg-3 control-label text-info">Password</label>
                        <div class="col-lg-8">
                            <input name = "password" type="password" id="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <br>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    <input type="submit" id="login-button" class="btn  btn-block btn-lg btn-primary" value="Login">
                                </div>
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