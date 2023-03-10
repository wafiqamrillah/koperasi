<x-splade-modal :close-button="true" :close="false" :title="__('Create').' '. __('unit type')">
    <x-splade-form dusk="create-unit-type" method="POST" :action="route('master.units.types.store')">
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <x-splade-input id="name" name="name" type="text" :label="__('Name')" :placeholder="__('Name')" required />
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" @click.prevent="modal.close">
                {{ __('Cancel') }}
            </button>

            <button type="submit" class="btn btn-success float-right">
                {{ __('Save') }}
            </button>
        </div>
    </x-splade-form>
</x-splade-modal>