<x-splade-modal :close-button="true" :title="__('Delete').' '. __('unit')">
    <x-splade-form dusk="delete-unit" method="DELETE" :action="route('master.units.destroy', $unit->id)">
        <div class="modal-body">
            <span>
                @if (!$unit->trashed())
                    {{ __("Are you sure you want to delete this data") }}?
                @else
                    {{ __("Do you want permanently delete this data") }}?
                @endif
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