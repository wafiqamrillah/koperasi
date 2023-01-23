<?php

namespace App\Http\Controllers\Master\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Master\Member\{ StoreMemberRequest, UpdateMemberRequest };
use ProtoneMedia\Splade\Facades\{ Splade, Toast };

// Models
use App\Models\Master\Member\Member;

// Table
use App\Tables\Master\Member\MemberTable;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = MemberTable::class;

        return view('master.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
        try {            
            $form = $request->validated();

            $data = \DB::transaction(function() use($form) {
                $member = new Member();

                $member->fill($form);
        
                $employee = $form['employee_id'] ? \App\Models\Hris\Employee::find($form['employee_id']) : null;
        
                if ($employee) {
                    $member->employee()->associate($employee);
                }
                
                $member->save();

                return $member;
            });

            return redirect()->route('master.members.index')->with('success', __('Data has been saved successfully.'));
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

            return Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Member\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('master.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Member\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('master.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberRequest  $request
     * @param  \App\Models\Master\Member\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        try {
            $form = $request->validated();

            $data = \DB::transaction(function() use($form, $member) {
                $member->fill($form);

                $employee = $form['employee_id'] ? \App\Models\Hris\Employee::find($form['employee_id']) : null;

                if ($employee) {
                    $member->employee()->associate($employee);
                } else {
                    $member->employee()->dissociate();
                }

                $member->save();

                return $member;
            });

            return redirect()->route('master.members.index')->with('success', __('Data has been saved successfully.'));
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

            return Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();
        }
    }

    /**
     * Show the modal for deleting the specified resource.
     *
     * @param  \App\Models\Master\Member\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function delete(Member $member)
    {
        return view('master.members.delete', compact('member'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Member\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        try {
            $data = \DB::transaction(function() use($member) {
                $member->delete();

                return $member;
            });

            return redirect()->route('master.members.index')->with('success', __('Data has been deleted successfully.'));
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

            return Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();
        }
    }
}
