<section>
    <p>
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>

    <div class="row">
        <Link href="#confirm-user-deletion" dusk="open-delete-modal" class="btn btn-danger">
            {{ __('Delete Account') }}
        </Link>
    </div>

    <x-splade-modal name="confirm-user-deletion">
        <x-splade-form dusk="confirm-user-deletion" method="delete" :action="route('profile.destroy')">
            <div class="modal-header">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" dusk="close-modal-button" @click="modal.close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
                <x-splade-input id="password" name="password" type="password"  :placeholder="__('Password')" />
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" @click.prevent="modal.close" class="btn btn-default">
                    {{ __('Cancel') }}
                </button>

                <button dusk="confirm-delete-account" type="submit" class="btn btn-danger">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </x-splade-form>
    </x-splade-modal>
</section>
