<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <div class="flex items-center justify-center">
                <Link href="/">
                    @if (config('app.logo'))
                        <img src="{{ asset('storage/' . config('app.logo')) }}" alt="{{ config('app.name', 'Laravel') }} Logo" style="width: 75px; ">
                    @else
                        <x-application-logo style="width: 75px; " />
                    @endif
                </Link>
            </div>
        </div>
        
        
        <div class="card">
            <div class="card-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" />
                
                <x-splade-form action="{{ route('login') }}" class="space-y-4">
                    <!-- Email Address -->
                    <x-splade-input
                        id="email"
                        type="email"
                        name="email"
                        :label="__('Email')"
                        :placeholder="__('Email')"
                        required
                        autofocus
                        prepend='<span class="input-group-text">@</span>' />

                    <!-- Password -->
                    <x-splade-input
                        id="password"
                        type="password"
                        name="password"
                        :label="__('Password')"
                        :placeholder="__('Password')"
                        required
                        autocomplete="current-password"
                        prepend='<span class="input-group-text"><i class="fa-solid fa-lock" /></span>' />

                    <div class="row">
                        <div class="col-8">
                            <x-splade-checkbox id="remember_me" name="remember" :label="__('Remember me')" class="checkbox-primary checkbox-xs" />
                        </div>
                        <div class="col-4">
                            <x-splade-submit class="ml-3" :label="__('Log in')" />
                        </div>
                    </div>
                    
                    <p class="mb-1">
                        @if (Route::has('password.request'))
                        <Link class="text-sm" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </Link>
                        @endif
                    </p>
                </x-splade-form>
            </div>
        </div>
    </div>
</div>
