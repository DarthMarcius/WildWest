
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