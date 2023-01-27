<x-splade-modal :close-button="true" :close="false" :title="__('Import').' '. __('member')">
    <x-splade-form method="POST" :action="route('master.members.importing')">
        <div class="modal-body">
            <x-splade-file accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" id="file" name="file" :label="__('File') . ' (XLS/XLSX)'" :placeholder="__('Import new member(s) data from excel')" />
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" @click.prevent="modal.close">
                {{ __('Close') }}
            </button>

            <button type="submit" class="btn btn-success float-right">
                {{ __('Upload') }}
            </button>
        </div>
    </x-splade-form>
</x-splade-modal>