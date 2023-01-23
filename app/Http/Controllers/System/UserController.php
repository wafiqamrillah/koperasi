<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\{ Splade, Toast };

// Models
use App\Models\User;
use App\Models\Master\Member\Member;
use Spatie\Permission\Models\{ Role, Permission };

// Table
use App\Tables\System\User\UserTable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserTable::class;

        return view('system.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = null;
        $members = collect([]);
        $roles = collect([]);
        $permissions = collect([]);

        try {
            $user = User::with('roles', 'permissions')->findOrFail($id);
            $members = Member::get();
            $roles = Role::select('id', 'name')->get()
                ->map(function($data) {
                    $data->name = ucwords(__($data->name));
                    return $data;
                });
            $permissions = Permission::select('id', 'name')->get()
                ->map(function($data) {
                    $data->name = ucwords(__($data->name));
                    return $data;
                });
        } catch (\Exception $e) {
            switch (get_class($e)) {
                case \Illuminate\Database\Eloquent\ModelNotFoundException::class:
                    $message = __("Data not found");
                    $title = "Whoops!";
                    break;
                default:
                    $message = $e->getMessage();
                    $title = "Whoops!";
                    break;
            }

            Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();
        }
    
        return view('system.users.edit', compact('user', 'members', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\System\User\UpdateUserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            dd($request->validated());
            
            return Toast::title("tEST")
                ->message("Success")
                ->danger()
                ->center();
    
            return redirect()->route('settings.users.index');
        } catch (\Exception $e) {
            switch (get_class($e)) {
                case \Illuminate\Database\Eloquent\ModelNotFoundException::class:
                    $message = __("Data not found");
                    $title = "Whoops!";
                    break;
                default:
                    $message = $e->getMessage();
                    $title = "Whoops!";
                    break;
            }

            Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
