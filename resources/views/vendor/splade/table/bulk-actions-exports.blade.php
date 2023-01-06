<div class="btn-group">
    <div style="position: relative;">
        <x-splade-toggle>
            <button v-if="table.hasSelectedItems" type="button" class="btn btn-default btn-flat" data-toggle="dropdown" aria-expanded="false" @click.prevent="toggle">
                {{ __('Actions') }} <span v-text="table.totalSelectedItems" class="badge bg-info" />
            </button>
            <div class="dropdown-menu dropdown-menu-right" :class="{ 'show' : toggled }" @click.prevent="setToggle(false)" role="menu" aria-orientation="horizontal">
                <div class="dropdown-header">
                    <span v-text="table.totalSelectedItems" /> {{ __('Item(s) selected') }}
                </div>
    
                @foreach($table->getBulkActions() as $bulkAction)
                    <a
                        href="#"
                        v-if="table.hasSelectedItems"
                        @click.prevent="table.performBulkAction(
                            @js($bulkAction->getUrl()),
                            @js($bulkAction->confirm),
                            @js($bulkAction->confirmText),
                            @js($bulkAction->confirmButton),
                            @js($bulkAction->cancelButton)
                        )"
                        dusk="action.{{ $bulkAction->getSlug() }}"
                        class="dropdown-item">
                        {{ $bulkAction->label }}
                    </a>
                @endforeach
            </div>
        </x-splade-toggle>
    </div>
    <div style="position: relative;">
        <x-splade-toggle>
            <button v-if="@js($table->hasExports())" type="button" class="btn btn-default btn-flat" data-toggle="dropdown" aria-expanded="false" @click.prevent="toggle">
                <i class="fa-solid fa-file-excel"></i> {{ __('Export') }}
            </button>
        
            <div class="dropdown-menu dropdown-menu-right" :class="{ 'show' : toggled }" @click="toggle" role="menu" aria-orientation="horizontal">
                @foreach($table->getExports() as $export)
                    <a
                        download
                        href="{{ $export->getUrl() }}"
                        dusk="action.{{ $export->getSlug() }}"
                        class="dropdown-item">
                        {{ $export->label }}
                    </a>
                @endforeach
            </div>
        </x-splade-toggle>
    </div>
</div>