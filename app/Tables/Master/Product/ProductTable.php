<?php

namespace App\Tables\Master\Product;

use App\Models\Master\Product\Product;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class ProductTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Product::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['number', 'name', 'brand', 'barcode'])
            ->defaultSort('number')
            ->column(
                key: 'number',
                searchable: true,
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'name',
                searchable: true,
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'description',
                searchable: true,
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'active',
                label: __('Active'),
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'brand',
                searchable: true,
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'action',
                label: __('Action')
            )
            ->paginate(15)
            // ->hidePaginationWhenResourceContainsOnePage()
            ;
    }
}
