@extends('layouts.master')
@section('content')
<body>
    @include('headers.login')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <form role="form" id="form-login" class="form-horizontal" action="">
                    <div class="form-group">
                        <h2 class="text-center text-info">Please Login</h2>
                    </div>
                    <div class="form-group">
                        <label for="company-name-input" class="col-lg-3 control-label text-info">
                            User Name
                        </label>
                        <div class="col-lg-8">
                            <input name="name" id ="company-name-input" type="text" placeholder="Company Name" class="form-control">
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
                        <label for="password-confirm" class="col-lg-3 control-label text-info">Confirm Password</label>
                        <div class="col-lg-8">
                            <input name = "password-confirm" type="password" id="password-confirm" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    <input type="button" id="login-button" class="btn  btn-block btn-lg btn-primary" value="Login">
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
</body>
@stop