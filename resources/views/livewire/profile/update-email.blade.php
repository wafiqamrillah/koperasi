<form method="POST" wire:submit.prevent="submit" x-show="show" x-transition:enter="fade">
    @csrf

    <x-inputs.email required="required" placeholder="Email" autofocus />

    <x-inputs.password key="currentPassword" :placeholder="ucfirst(__('validation.attributes.current_password'))" />

    <div class="row">
        <div class="offset-4 col-4">
            <x-inputs.button :text="__('Save')" class="btn-success" />
        </div>

        <div class="col-4">
            <button type="button" class="btn btn-outline-secondary btn-block" x-on:click="show = false">
                {{ __('Cancel') }}
            </button>
        </div>
    </div>
</form>
