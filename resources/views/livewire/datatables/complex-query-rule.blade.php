<div class="w-full">
    @php $key = collect(explode('.', $parentIndex))->join(".content.") . ".content" @endphp
    <div
        draggable="true"
        x-on:dragstart="dragstart($event, '{{ $key }}')"
        x-on:dragend="dragend"
        key="{{ $key }}"
        class="px-3 py-2 -my-1"
    >
        <div class="row">
            <div class="col-xs-12 col-lg-4">
                <div class="form-group">
                    <lable class="form-label" for="selectedColumn">Column</lable>
                    <select wire:model="rules.{{ $key }}.column" name="selectedColumn" class="form-control">
                        <option value=""></option>
                        @foreach ($columns as $i => $column)
                            <option value="{{ $i }}">{{ Str::ucfirst($column['label']) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($options = $this->getOperands($key))
                <div class="col-xs-12 col-lg-4">
                    <div class="form-group">
                        <lable class="form-label" for="operand">Operand</lable>
                        <select name="operand" wire:model="rules.{{ $key }}.operand" class="form-control">
                            <option selected></option>
                            @foreach ($options as $operand)
                                <option value="{{ $operand }}">{{ $operand }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            @if (!in_array($rule['content']['operand'], ['is empty', 'is not empty']))
                <div class="col-xs-12 col-lg-4">
                    @if ($column = $this->getRuleColumn($key))
                        <div class="form-group">
                            <lable class="form-label" for="value">Value</lable>
                            @if (is_array($column['filterable']))
                                <select name="value" wire:model="rules.{{ $key }}.value" class="form-control">
                                    <option selected></option>
                                    @foreach ($column['filterable'] as $value => $label)
                                        @if (is_object($label))
                                            <option value="{{ $label->id }}">{{ $label->name }}</option>
                                        @elseif(is_array($label))
                                            <option value="{{ $label['id'] }}">{{ $label['name'] }}</option>
                                        @elseif(is_numeric($value))
                                            <option value="{{ $label }}">{{ $label }}</option>
                                        @else
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @elseif($column['type'] === 'boolean')
                                <select name="value" wire:model="rules.{{ $key }}.value" class="form-control">
                                    <option selected></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            @elseif($column['type'] === 'date')
                                <input type="date" name="value" wire:model.lazy="rules.{{ $key }}.value" class="form-control" />
                            @elseif($column['type'] === 'time')
                                <input type="time" name="value" wire:model.lazy="rules.{{ $key }}.value" class="form-control" />
                            @else
                                <input name="value" wire:model.lazy="rules.{{ $key }}.value" class="form-control" />
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center justify-content-lg-end">
            <button wire:click="duplicateRule('{{ $key }}')"
                class="btn btn-default btn-sm">
                <i class="fas fa-copy text-green"></i> <span class="d-none d-md-block">{{ __('Copy') }}</span>
            </button>
            <button wire:click="removeRule('{{ $key }}')"
                class="btn btn-default btn-sm">
                <i class="fas fa-trash text-danger"></i> <span class="d-none d-md-block">{{ __('Remove') }}</span>
            </button>
        </div>
    </div>
</div>
