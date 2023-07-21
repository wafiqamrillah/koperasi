<div class="row">
    @includeIf($beforeTableSlot)
    
    @if($complex)
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span>Query Builder</span>
                </div>
                <div class="card-body">
                    <livewire:complex-query :columns="$this->complexColumns" :persistKey="$this->persistKey" :savedQueries="method_exists($this, 'getSavedQueries') ? $this->getSavedQueries() : null" />
                </div>
            </div>
        </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    @if($this->searchableColumns()->count())
                    <div class="col-xs-12 col-lg-6">
                        <div class="input-group input-group-sm">
                            <input wire:loading.attr="disabled" wire:model.debounce.500ms="search" placeholder="{{__('Search in')}} {{ $this->searchableColumns()->map->label->join(', ') }}" class="form-control">
                            <div class="input-group-append">
                                <button wire:click="$set('search', null)" class="btn btn-default">
                                    <i wire:loading x-cloak class="fas fa-sync-alt fa-spin"></i>
                                    <i wire:loading.remove class="fas {{ $search ? 'fa-times text-danger' : 'fa-search text-default' }}"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div
                        @if($exportable)
                        x-data="{ init() {
                            window.livewire.on('startDownload', link => window.open(link, '_blank'))
                        } }"
                        x-init="init"
                        @endif
                        class="col-xs-12 col-lg-6 d-flex justify-content-end">
                        
                        @if(count($this->massActionsOptions))
                        <div class="form-group">
                            <label for="datatables_mass_actions" class="col-form-label">{{ __('With selected') }}:</label>
                            <div class="input-group">
                                <select wire:model="massActionOption" class="form-control" id="datatables_mass_actions">
                                    <option value="">{{ __('Choose...') }}</option>
                                    @foreach($this->massActionsOptions as $group => $items)
                                        @if(!$group)
                                            @foreach($items as $item)
                                                <option value="{{$item['value']}}">{{$item['label']}}</option>
                                            @endforeach
                                        @else
                                            <optgroup label="{{$group}}">
                                                @foreach($items as $item)
                                                    <option value="{{$item['value']}}">{{$item['label']}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button
                                        wire:click="massActionOptionHandler"
                                        class="btn btn-default" type="submit" title="{{ __('Submit') }}"
                                    >{{ __('Go') }}</button>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="btn-group" role="group">
                            @if($this->activeFilters)
                                <button wire:click="clearAllFilters" class="btn btn-danger">
                                    <i class="fas fa-times text-sm"></i> <span>{{ __('Reset') }}</span>
                                </button>
                            @endif
                
                            @if($hideable === 'select')
                                @include('datatables::hide-column-multiselect')
                            @endif
                
                            @foreach ($columnGroups as $name => $group)
                                <button wire:click="toggleGroup('{{ $name }}')" class="btn btn-default">
                                    {{ isset($this->groupLabels[$name]) ? __($this->groupLabels[$name]) : __('Toggle :group', ['group' => $name]) }}
                                </button>
                            @endforeach
                    
                            @if($exportable)
                                <button wire:click="export" class="btn btn-default">
                                    <i class="fas fa-file-excel"></i> <span>{{ __('Export') }}</span>
                                </button>
                            @endif
            
                            @if($hideable === 'buttons')
                                @foreach($this->columns as $index => $column)
                                    @if ($column['hideable'])
                                        <button wire:click.prefetch="toggle('{{ $index }}')" class="btn btn-primary {{ $column['hidden'] ? 'btn-outline' : '' }}">
                                            {{ $column['label'] }}
                                        </button>
                                    @endif
                                @endforeach
                            @endif

                            @includeIf($buttonsSlot)
                        </div>
                    </div>
                </div>
                @if($this->activeFilters)
                    <span class="text-sm">@lang('Filter active')</span>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-head-fixed text-nowrap">
                        <thead>
                            @unless($this->hideHeader)
                                <tr>
                                    @foreach($this->columns as $index => $column)
                                        @if($hideable === 'inline')
                                            {{-- @include('datatables::header-inline-hide', ['column' => $column, 'sort' => $sort]) --}}
                                        @elseif($column['type'] === 'checkbox')
                                            @unless($column['hidden'])
                                                <td>
                                                    <span class="badge badge-@if(count($selected)) warning @else default @endif">{{ count($visibleSelected) }}</span>
                                                </td>
                                            @endunless
                                        @else
                                            @include('datatables::header-no-hide', ['column' => $column, 'sort' => $sort])
                                        @endif
                                    @endforeach
                                </tr>
                            @endunless
                            <tr>
                                @foreach($this->columns as $index => $column)
                                    @if($column['hidden'])
                                        @if($hideable === 'inline')
                                            <td></td>
                                        @endif
                                    @elseif($column['type'] === 'checkbox')
                                        @include('datatables::filters.checkbox')
                                    @elseif($column['type'] === 'label')
                                        <td>
                                            {{ $column['label'] ?? '' }}
                                        </td>
                                    @else
                                        @isset($column['filterable'])
                                        <td>
                                            @if( is_iterable($column['filterable']) )
                                                <div wire:key="{{ $index }}">
                                                    @include('datatables::filters.select', ['index' => $index, 'name' => $column['label'], 'options' => $column['filterable']])
                                                </div>
                                            @else
                                                <div wire:key="{{ $index }}">
                                                    @include('datatables::filters.' . ($column['filterView'] ?? $column['type']), ['index' => $index, 'name' => $column['label']])
                                                </div>
                                            @endif
                                        </td>
                                        @endisset
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($this->results as $row)
                                <tr class="{{ $this->rowClasses($row, $loop) }}">
                                    @foreach($this->columns as $column)
                                        @if($column['hidden'])
                                            @if($hideable === 'inline')
                                                <td class="@unless($column['wrappable']) text-nowrap text-truncate @endunless align-top" style="overflow: hidden;"></td>
                                            @endif
                                        @elseif($column['type'] === 'checkbox')
                                            <td class="d-flex align-middle text-center">
                                                @include('datatables::checkbox', ['value' => $row->checkbox_attribute])
                                            </td>
                                        @elseif($column['type'] === 'label')
                                            <td class="d-flex align-middle text-center">
                                                @include('datatables::label')
                                            </td>
                                        @else
                                            <td class="@unless($column['wrappable']) text-nowrap text-truncate @endunless @if($column['contentAlign'] === 'right') text-right @elseif($column['contentAlign'] === 'center') text-center @else text-left @endif {{ $this->cellClasses($row, $column) }}">
                                                {!! $row->{$column['name']} !!}
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($this->columns) }}" class="text-center">
                                        {{ __('There\'s Nothing to show at the moment') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    
            @unless($this->hidePagination)
                <div class="card-footer clearfix">
                    <div class="row d-flex align-middle justify-content-between">
                        <div>
                            <select wire:model="perPage" class="form-control">
                                @foreach(config('livewire-datatables.per_page_options', [ 10, 25, 50, 100 ]) as $per_page_option)
                                    <option value="{{ $per_page_option }}">{{ $per_page_option }}</option>
                                @endforeach
                                <option value="99999999">{{__('All')}}</option>
                            </select>
                        </div>
                        <div>
                            <div class="d-lg-none">
                                {{ $this->results->links('datatables::tailwind-simple-pagination') }}
                            </div>
                            <div class="d-none d-lg-block">
                                {{ $this->results->links('datatables::tailwind-pagination') }}
                            </div>
                        </div>
                        <div>
                            {{__('Results')}} {{ $this->results->firstItem() }} - {{ $this->results->lastItem() }} {{__('of')}} {{ $this->results->total() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @includeIf($afterTableSlot)
</div>
