<?php

namespace App\Tables\Master\Member;

use App\Models\Master\Member\Member;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\{ Splade, Toast };

class MemberTable extends AbstractTable
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
        return Member::query();
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
            // ->bulkAction('Touch timestamp',
            //     each: fn ($member) => $collectible->push($member),
            //     after: fn () => dd($collectible)
            // )
            ->withGlobalSearch(columns: ['name', 'id_card_number'])
            ->defaultSort('name')
            ->column(
                key: 'name',
                searchable: true,
                sortable: true,
                canBeHidden: true
            )
            ->column(
                key: 'id_card_number',
                label: __('ID Card Number'),
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
                key: 'birthPlaceDate',
                label: __('Birth Place, Date'),
                searchable: true,
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
