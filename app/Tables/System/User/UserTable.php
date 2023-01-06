<?php

namespace App\Tables\System\User;

use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\{ SpladeTable, AbstractTable };
use Maatwebsite\Excel\Excel;

class UserTable extends AbstractTable
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
        return User::query();
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
            ->withGlobalSearch(columns: ['name', 'email'])
            ->defaultSort('name')
            ->column(key: 'name', searchable: true, sortable: true, canBeHidden: true)
            ->column(key: 'email', searchable: true, sortable: true, canBeHidden: true)
            ->column(key: 'profile_photo_path', searchable: true, sortable: true, canBeHidden: true)
            ->bulkAction(
                label: 'Touch timestamp',
                each: fn (User $user) => $user->touch(),
                confirm: 'Touch projects',
                confirmText: 'Are you sure you want to touch the projects?',
                confirmButton: 'Yes, touch all selected rows!',
                cancelButton: 'No, do not touch!',
            )
            ->export(
                filename: 'projects.csv',
                type: Excel::CSV
            )
            ->paginate(15)
            ->hidePaginationWhenResourceContainsOnePage();

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
    }
}
