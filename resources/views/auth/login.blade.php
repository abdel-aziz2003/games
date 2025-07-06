<x-log-template>
    <x-slot:title>Login</x-slot:title>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name='email'>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="remember" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember me</label>
            </div>
        </div>
        <div class="account-dialog-actions mb-3">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
       
    </form>
</x-log-template>