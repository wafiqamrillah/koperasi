<x-splade-component is="dropdown" dusk="select-rows-dropdown" close-on-click>
    <x-slot:trigger>
        <input
            type="checkbox"
            class="tw-rounded tw-border-gray-300 tw-text-indigo-600 tw-shadow-sm focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 disabled:tw-opacity-50"
            :checked="table.allVisibleItemsAreSelected"
        />
    </x-slot:trigger>

    <div class="tw-mt-2 tw-min-w-max tw-rounded-md tw-shadow-lg tw-bg-white tw-ring-1 tw-ring-black tw-ring-opacity-5">
        <div class="tw-flex tw-flex-col">
            <button
                class="tw-text-left tw-w-full tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100 hover:tw-text-gray-900 tw-font-normal"
                @click="table.setSelectedItems(@js($table->getPrimaryKeys()))"
                dusk="select-all-on-this-page">
                {{ __('Select all on this page') }} ({{ $table->totalOnThisPage() }})
            </button>

            @if($showPaginator())
                <button
                    class="tw-text-left tw-w-full tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100 hover:tw-text-gray-900 tw-font-normal"
                    @click="table.setSelectedItems(['*'])"
                    dusk="select-all-results">
                    {{ __('Select all results') }} ({{ $table->totalOnAllPages() }})
                </button>
            @endif

            <button
                v-if="table.hasSelectedItems"
                class="tw-text-left tw-w-full tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-100 hover:tw-text-gray-900 tw-font-normal"
                @click="table.setSelectedItems([])"
                dusk="select-none">
                {{ __('Clear selection') }}
            </button>
        </div>
    </div>
</x-splade-component>