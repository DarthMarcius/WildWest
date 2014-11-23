
@extends('layouts.master')
@section('content')
    @include('headers.logo_bar')
    	
		@if(Session::has('error'))
		    @include("modals.loginModals")
		@endif

		@if(Session::has('status'))
		    <div class="alert-box status">
		        <p>{{ Session::get('status') }}</p>
		    </div>
		@endif

		<form action="{{ action('RemindersController@postRemind') }}" method="POST">
		    {{ Form::token() }}
		    <input type="email" name="email">
		    <input type="submit" value="Send Reminder">
		</form>
    @include('footers.index')
    @include('js_footers.index')
@stop