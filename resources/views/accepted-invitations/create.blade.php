@section('title')
    {{ trans('Create New Account') }}
@endsection

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">
            {{ trans('Create New Account') }}
        </p>

        <form method="POST" wire:submit.prevent="submit">
            @csrf

            <x-inputs.password key="newPassword" :placeholder="ucfirst(trans('validation.attributes.newPassword'))" />

            <x-inputs.password key="newPasswordConfirmation" :placeholder="ucfirst(trans('validation.attributes.newPasswordConfirmation'))" />

            <div class="row">
                <div class="offset-4 col-4">
                    <x-inputs.button text="Save" class="btn-success" />
                </div>
            </div>
        </form>
    </div>
</div>
