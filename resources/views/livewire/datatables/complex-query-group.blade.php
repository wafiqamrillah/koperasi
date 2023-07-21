<div class="d-flex flex-column">
    @foreach($rules as $index => $rule)
        @php $key = $parentIndex !== null ? $parentIndex . '.' . $index : $index; @endphp
        <div wire:key="{{ $key }}">
            @if($rule['type'] === 'rule')
                @include('datatables::complex-query-rule', ['parentIndex' => $key, 'rule' => $rule])
            @elseif($rule['type'] === 'group')
                <div
                    x-data="{
                        key: '{{ collect(explode('.', $key))->join(".content.") . ".content" }}',
                        source: () => document.querySelector('[dragging]'),
                        dragstart: (e, key) => {
                            e.target.setAttribute('dragging', key)
                            e.target.classList.add('bg-opacity-20', 'bg-white')
                        },
                        dragend: (e) => {
                            e.target.removeAttribute('dragging')
                            e.target.classList.remove('bg-opacity-20', 'bg-white')
                        },
                        dragenter(e) {
                            if (e.target.closest('[drag-target]') !== this.source().closest('[drag-target]')) {
                                console.log(this.$refs.placeholder)
                                this.$refs.placeholder.appendChild(this.source())
                            }
                        },
                        drop(e) {
                            $wire.call('moveRule', this.source().getAttribute('dragging'), this.key)
                        },
                    }"
                    drag-target
                    x-on:dragenter.prevent="dragenter"
                    x-on:dragleave.prevent
                    x-on:dragover.prevent
                    x-on:drop="drop"
                    class="p-4 border rounded-lg"
                >
                    <span class="d-flex justify-content-center">
                        <button wire:click="addRule('{{ collect(explode('.', $key))->join(".content.") . ".content" }}')" class="btn btn-sm btn-default mr-2">
                            {{ __('Add') .' '. __('Rule') }}
                        </button>
                        <button wire:click="addGroup('{{ collect(explode('.', $key))->join(".content.") . ".content" }}')" class="btn btn-sm btn-default mr-2">
                            {{ __('Add') .' '. __('Group') }}
                        </button>
                        @unless($key === 0)
                            <button wire:click="removeRule('{{ collect(explode('.', $key))->join(".content.") . ".content" }}')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> {{ __('Remove') }}
                            </button>
                        @endunless
                    </span>

                    <div class="row">
                        <div class="col-12">
                            @if(count($rule['content']) > 1)
                                <div class="mr-8">
                                    <label class="form-label">Logic</label>
                                    <select
                                        wire:model="rules.{{ collect(explode('.', $key))->join(".content.") }}.logic"
                                        class="form-control form-control-sm"
                                    >
                                        <option value="and">AND</option>
                                        <option value="or">OR</option>
                                    </select>
                                </div>
                            @endif
                        </div>
                        <div x-ref="placeholder" class="col-12">
                            <div>
                                @include('datatables::complex-query-group', [
                                    'parentIndex' => $key,
                                    'rules' => $rule['content'],
                                    'logic' => $rule['logic']
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>
