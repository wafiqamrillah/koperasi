<x-splade-modal :close-button="true" :close="false" :title="__('Edit').' '. __('unit')">
    <x-splade-form dusk="edit-unit" method="PATCH" :action="route('master.units.update', $unit->id)" :default="$unit">
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <x-splade-input id="name" name="name" type="text" :label="__('Name')" :placeholder="__('Name')" required />
                </div>
                <div class="col-6">
                    <x-splade-input id="code" name="code" type="text" :label="__('Code')" :placeholder="__('Code')" required />
                </div>
                <div class="col-12">
                    <x-splade-textarea id="description" name="description" :label="__('Description')" :placeholder="__('Description')" />
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