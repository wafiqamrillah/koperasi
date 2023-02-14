<?php

namespace App\Tables\Master\Unit;

use App\Models\Master\Unit\Unit;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class UnitTable extends AbstractTable
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
        return Unit::query()->withTrashed();
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
            ->withGlobalSearch(columns: ['name', 'code'])
            ->defaultSort('name')
            ->column(
                key: 'name',
                searchable: true,
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'code',
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
                label: __('Active')
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
