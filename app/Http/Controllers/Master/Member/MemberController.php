<?php

namespace App\Http\Controllers\Master\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Master\Member\{ StoreMemberRequest, UpdateMemberRequest };

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

            return \Toast::title($title)
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

            \Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();

            return back();
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
        try {
            return view('master.members.delete', compact('member'));
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

            \Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();

            return redirect()->back();
        }
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

            \Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();

            return back();
        }
    }
    
    /**
     * Show the modal for importing new resources in storage.
     *
     * @param  \App\Models\Master\Member\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('master.members.import');
    }
    
    /**
     * Store new resources created in storage.
     *
     * @param  \App\Models\Master\Member\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function importing(Request $request)
    {
        try {
            if (!$request->hasFile('file')) throw new \Exception(__("There is no file uploaded") . '.');
            
            $file = $request->file('file');
            
            $data = \DB::transaction(function () use($file) {
                $imports = (new \App\Imports\ExcelImport)->toArray($file);
                if (!isset($imports[0])) throw new \Exception(__("There is no data inputted") . '.');

                // Import
                $imports = collect($imports[0]);

                // Header
                $header = $imports->splice(0, 1)->first();

                // Datas
                $datas = $imports->map(function($data) use($header) {
                    return collect($data)->mapWithKeys(function($d, $i) use($header) {
                        return [$header[$i] => $d];
                    });
                });
                
                // Store into database
                $datas = $datas->map(function($data, $index) {
                    $current_data = $data->toArray();
                    $current_data['birth_date'] = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($current_data['birth_date']));

                    // Validator
                    $validator = \Validator::make($current_data, (new StoreMemberRequest)->rules());
                    
                    try {
                        $validator->validate();
                    } catch (\Exception $e) {
                        throw new \Exception('Validation at row-' . ($index + 1) . ' : ' . $e->getMessage());
                    }
                    
                    $member = new Member($validator->validated());
                    $member->save();

                    return $member;
                });

                return $datas;
            });
            
            return redirect()->route('master.members.index')->with('success', __('Data has been imported successfully') .'. Total data : '.$data->count());
        } catch (\Exception $e) {
            \Toast::title("Whoops!")
                ->message($e->getMessage())
                ->danger()
                ->center()
                ->backdrop();

            return back();
        }
    }
}
