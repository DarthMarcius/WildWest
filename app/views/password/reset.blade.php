
@if(Session::has('error'))
    @include("modals.loginModals")
@endif


<form action="{{ action('RemindersController@postReset') }}" method="POST">
    {{ Form::token() }}
    <input type="hidden" name="token" value="{{ $token }}">
    Email: <input type="email" name="email">
    Password: <input type="password" name="password">
    Confirm password: <input type="password" name="password_confirmation">
    <input type="submit" value="Reset Password">
</form>