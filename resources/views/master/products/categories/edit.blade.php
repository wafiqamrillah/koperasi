<x-splade-modal :close-button="true" :close="false" :title="__('Edit').' '. __('category')">
    <x-splade-form dusk="edit-product-categories" method="PATCH" :action="route('master.products.categories.update', $category->id)" :default="$category">
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