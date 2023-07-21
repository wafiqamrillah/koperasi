<div x-data="{
        {{-- rules: @if($persistKey) $persist('').as('{{ $persistKey }}') @else null @endif, --}}
        rules: null,
        collapsed : true,
        name: null,
        init() {
            Livewire.on('complexQuery', rules => this.rules = rules)
            if (this.rules && this.rules !== '') {
                $wire.set('rules', this.rules)
                $wire.runQuery()
            }
        },
        saveQuery() {
            $wire.call('saveQuery', this.name)
            this.name = null
        },
    }">
    @if($errors->any())
    <span>
        <div class="text-danger">You have missing values in your rules</div>
    </span>
    @endif

    @if(count($this->rules[0]['content']))
        <div class="mb-2 row">
            <div class="col-12">
                <label>{{ __('Condition') }}</label>
            </div>
            <div class="col-12">
                <div class="bg-black p-2 rounded text-xs @if($errors->any()) text-danger @else text-success @endif">
                    {{ $this->rulesString }}
                </div>
            </div>
            @if($errors->any())
            <div class="col-12">
                <span class="text-danger text-sm">
                    Invalid rules
                </span>
            </div>
            @endif
        </div>
    @endif

    <div class="card">
        <div
            x-on:click="collapsed = ! collapsed"
            class="card-header"
            style="cursor: pointer;">
            {{ __('Query') }}
        </div>
        <div
            x-bind:class="{ 'show' : collapsed }"
            class="collapse">
            <div class="card-body">
                @include('datatables::complex-query-group', ['rules' => $rules, 'parentIndex' => null])
            </div>
        </div>
    </div>

    @if(count($this->rules[0]['content']))
        @unless($errors->any())
            <div class="d-flex justify-content-end">
                <div class="btn-group">
                    <button class="btn btn-success" wire:click="runQuery">
                        <i class="fas fa-check"></i> Apply Query
                    </button>
                    <button x-show="rules" wire:click="resetQuery" class="btn btn-danger">
                        <i class="fas fa-times"></i> {{ __('Reset') }}
                    </button>
                </div>
                <div class="mt-2">
                    @isset($savedQueries)
                        <div class="input-group imput-group-sm" x-data="{
                            name: null,
                            saveQuery() {
                                $wire.call('saveQuery', this.name)
                                this.name = null
                            }
                        }">
                            <input x-model="name" wire:loading.attr="disabled" x-on:keydown.enter="saveQuery" placeholder="{{ __('Save as') }}..." class="form-control form-control-sm" />
                            <div class="input-group-append">
                                <button x-bind:disabled="! name" x-show="rules" x-on:click="saveQuery" class="btn btn-success">
                                    <span>{{ __('Save') }}</span>
                                    <span wire:loading.remove>
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span wire:loading>
                                        <i class="fas fa-alt-sync fa-spin"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        @endif
    @endif

    @if(count($savedQueries ?? []))
        <div>
            <div class="mt-8 my-4 text-xl uppercase tracking-wide font-medium leading-none">Saved Queries</div>
            <div class="grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-2">
                @foreach($savedQueries as $saved)
                    <div class="flex" wire:key="{{ $saved['id'] }}">
                        <button wire:click="loadRules({{ json_encode($saved['rules']) }})" wire:loading.attr="disabled" class="p-2 flex-grow flex items-center space-x-2 px-3 border border-r-0 border-blue-400 rounded-md rounded-r-none bg-white text-blue-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-200 focus:outline-none">{{ $saved['name'] }}</button>
                        <button wire:click="deleteRules({{ $saved['id'] }})" wire:loading.attr="disabled" class="p-2 flex items-center space-x-2 px-3 border border-red-400 rounded-md rounded-l-none bg-white text-red-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-red-200 focus:outline-none">
                            <x-icons.x-circle wire:loading.remove />
                            <x-icons.cog wire:loading class="h-6 w-6 animate-spin" />
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
