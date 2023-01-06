<tbody>
    @foreach($table->resource as $itemKey => $item)
        @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp

        <tr
            @if($table->rowLinks->has($itemKey))
                style="cursor: pointer;"
                @click="(event) => table.visit(@js($table->rowLinks->get($itemKey)), @js($table->rowLinkType), event)"
            @endif
        >
            @if($hasBulkActions = $table->hasBulkActions())
                <td class="text-center">
                    <input
                        type="checkbox"
                        name="table-row-bulk-action"
                        value="{{ $itemPrimaryKey }}"
                        @change="(e) => table.setSelectedItem(@js($itemPrimaryKey), e.target.checked)"
                        :checked="table.itemIsSelected(@js($itemPrimaryKey))"
                        :disabled="table.allItemsFromAllPagesAreSelected"/>
                </td>
            @endif

            @foreach($table->columns() as $column)
                <td
                    v-show="table.columnIsVisible(@js($column->key))"
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