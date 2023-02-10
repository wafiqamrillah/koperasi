<x-splade-modal :close-button="true" :title="__('Delete').' '. __('product')">
    <x-splade-form dusk="delete-product" method="DELETE" :action="route('master.products.destroy', $product->id)">
        <div class="modal-body">
            <span>
                {{ __("Are you sure you want to delete this data") }}?
            </span>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" @click.prevent="modal.close">
                {{ __('Cancel') }}
            </button>

            <button type="submit" class="btn btn-danger float-right">
                {{ __('Confirm') }}
            </button>
        </div>
    </x-splade-form>
</x-splade-modal>