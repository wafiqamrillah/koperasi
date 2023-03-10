<?php

namespace App\Tables\Master\Unit;

use App\Models\Master\Unit\UnitType;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class UnitTypeTable extends AbstractTable
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
        return UnitType::query()->withCount([
            'units' => fn($q) => $q->withTrashed()
        ]);
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
                label: __('Name'),
                searchable: true,
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'total_units',
                label: __('Total') . ' ' . __('Unit')
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
