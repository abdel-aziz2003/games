<x-log-template>
    <x-slot:title>Register</x-slot:title>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Name" name='name' required value='{{ old('name') }}'>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Enter email" name='email' required value='{{ old('email') }}'>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" required value='{{ old('password') }}'>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required value='{{ old('password_confirmation') }}'>
        </div>
        @if(config('settings.g_site_key') != '' && config('settings.g_secret_key') != '')
        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="{{ config('settings.g_site_key') }}"></div>
        </div>
        @endif

        <div class="account-dialog-actions mb-3">
            <button type="submit" class="btn btn-primary">Sign up</button>
        </div>
        Already registered? <a href="{{ route('login') }}"><small>Login</small></a>
    </form>
</x-log-template>