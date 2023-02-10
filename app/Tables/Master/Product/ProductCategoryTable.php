<?php

namespace App\Tables\Master\Product;

use App\Models\Master\Product\ProductCategory;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class ProductCategoryTable extends AbstractTable
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
        return ProductCategory::query();
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
            ->withGlobalSearch(columns: ['name'])
            ->defaultSort('name')
            ->column(
                key: 'name',
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
