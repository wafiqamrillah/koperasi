<SpladeTable {{ $attributes->except('class') }}
    :striped="@js($striped)"
    :columns="@js($table->columns())"
    :search-debounce="@js($searchDebounce)"
    :default-visible-toggleable-columns="@js($table->defaultVisibleToggleableColumns())"
    :items-on-this-page="@js($table->totalOnThisPage())"
    :items-on-all-pages="@js($table->totalOnAllPages())"
>
    <template #default="{!! $scope !!}">
        <div {{ $attributes->only('class') }} :style="{ 'opacity: 0.5;': table.isLoading }">
            @if($hasControls())
                @include('splade::table.controls')
            @endif

            @foreach($table->searchInputs() as $searchInput)
                @includeUnless($searchInput->key === 'global', 'splade::table.search-row')
            @endforeach

            <x-splade-component is="table-wrapper">
                <table class="table table-hover table-bordered table-nowrap" :class="{ 'table-striped' : table.striped }">
                    @unless($headless)
                        @isset($head)
                            {{ $head }}
                        @else
                            @include('splade::table.head')
                        @endisset
                    @endunless

                    @isset($body)
                        {{ $body }}
                    @else
                        @include('splade::table.body')
                    @endisset
                </table>
            </x-splade-component>

            @if($showPaginator())
                {{ $table->resource->links($paginationView, ['table' => $table, 'hasPerPageOptions' => $hasPerPageOptions()]) }}
            @endif
        </div>
    </template>
</SpladeTable>