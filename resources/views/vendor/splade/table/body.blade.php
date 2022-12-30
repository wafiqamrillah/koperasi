<tbody class="tw-divide-y tw-divide-gray-200 tw-bg-white">
    @foreach($table->resource as $itemKey => $item)
        @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp

        <tr
            @if($table->rowLinks->has($itemKey))
                class="tw-cursor-pointer"
                @click="(event) => table.visit(@js($table->rowLinks->get($itemKey)), @js($table->rowLinkType), event)"
            @endif
            :class="{
                'tw-bg-gray-50': table.striped && @js($itemKey) % 2,
                'hover:tw-bg-gray-100': table.striped,
                'hover:tw-bg-gray-50': !table.striped
            }"
        >
            @if($hasBulkActions = $table->hasBulkActions())
                <td width="64" class="tw-text-xs tw-px-6 tw-py-4">
                    <input
                        @change="(e) => table.setSelectedItem(@js($itemPrimaryKey), e.target.checked)"
                        :checked="table.itemIsSelected(@js($itemPrimaryKey))"
                        :disabled="table.allItemsFromAllPagesAreSelected"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50"
                        name="table-row-bulk-action"
                        type="checkbox"
                        value="{{ $itemPrimaryKey }}"
                    />
                </td>
            @endif

            @foreach($table->columns() as $column)
                <td
                    v-show="table.columnIsVisible(@js($column->key))"
                    class="tw-whitespace-nowrap tw-text-sm {{ $loop->first && $hasBulkActions ? 'tw-pr-6' : 'tw-px-6' }} tw-py-4 {{ $column->highlight ? 'tw-text-gray-900 tw-font-medium' : 'tw-text-gray-500' }}"
                >
                    @isset(${'spladeTableCell' . $column->keyHash()})
                        {{ ${'spladeTableCell' . $column->keyHash()}($item, $itemKey) }}
                    @else
                        {!! nl2br(e($getColumnDataFromItem($item, $column))) !!}
                    @endisset
                </td>
            @endforeach
        </tr>
    @endforeach
</tbody>