<x-splade-form method="patch" :action="route('profile.update')" :default="$user" class="form-horizontal">
    <!-- Name -->
    <x-splade-input id="name" name="name" type="text" :label="__('Name')" required autofocus autocomplete="name" />

    <!-- Email -->
    <x-splade-input id="email" name="email" type="email" :label="__('Email')" required autocomplete="email" />
    
    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div>
            <p class="text-sm mt-2 text-muted">
                {{ __('Your email address is unverified.') }}

                <Link method="post" href="{{ route('verification.send') }}" class="text-sm text-mute">
                    <u>{{ __('Click here to re-send the verification email.') }}</u>
                </Link>
            </p>

            @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-success">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
        </div>
    @endif
    <div class="form-group row">
        <x-splade-submit :label="__('Save')" />

        @if (session('status') === 'profile-updated')
            <p class="text-sm text-success">
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</x-splade-form>
