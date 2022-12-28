<x-splade-form method="put" :action="route('password.update')" class="mt-6 space-y-6">
    <!-- Input Current Password -->
    <x-splade-input id="current_password" name="current_password" type="password" :label="__('Current Password')" autocomplete="current-password" />

    <!-- Input New Password -->
    <x-splade-input id="password" name="password" type="password" :label="__('New Password')" autocomplete="new-password" />

    <!-- Confirm New Password -->
    <x-splade-input id="password_confirmation" name="password_confirmation" type="password" :label="__('Confirm Password')" autocomplete="new-password" />

    <div class="form-group row">
        <div class="col-6">
            <x-splade-submit :label="__('Save')" />
        </div>
        <div class="col-6 d-flex" style="align-items: center;">
            @if (session('status') === 'password-updated')
                <span class="text-sm text-success">
                    {{ __('Saved.') }}
                </span>
            @endif
        </div>
    </div>
</x-splade-form>