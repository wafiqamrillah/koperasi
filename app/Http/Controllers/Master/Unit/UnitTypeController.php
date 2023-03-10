<?php

namespace App\Http\Controllers\Master\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{ DB };
use ProtoneMedia\Splade\Facades\Toast;

// Model
use App\Models\Master\Unit\{ Unit, UnitType };

// Requests
use App\Http\Requests\Master\Unit\UnitType\{ StoreUnitTypeRequest, UpdateUnitTypeRequest };

// Table
use App\Tables\Master\Unit\UnitTypeTable;

class UnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = UnitTypeTable::class;

        return view('master.units.types.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.units.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitTypeRequest $request)
    {
        try {
            $form = $request->validated();

            $data = DB::transaction(function () use($form) {
                $type = new UnitType;
                $type->fill($form);

                $type->save();
                
                return $type;
            });

            return redirect()->route('master.units.types.index')->with('success', __('Data has been saved successfully.'));
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

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Unit\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(UnitType $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Unit\UnitType  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitType $type)
    {
        return view('master.units.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Unit\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitTypeRequest $request, UnitType $type)
    {
        try {
            $form = $request->validated();

            $data = DB::transaction(function () use($form, $type) {
                $type->fill($form);

                $type->save();
                
                return $type;
            });

            return redirect()->route('master.units.types.index')->with('success', __('Data has been saved successfully.'));
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

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the modal for deleting the specified resource.
     *
     * @param  \App\Models\Master\Unit\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function delete(Unit $unit)
    {
        try {
            return view('master.units.delete', compact('unit'));
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

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Unit\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($unit)
    {
        try {
            $unit = Unit::withTrashed()->findOrFail($unit);

            $data = DB::transaction(function () use($unit) {
                if (!$unit->trashed()) {
                    $unit->delete();
                } else {
                    $unit->forceDelete();
                }

                return $unit;
            });

            return redirect()->route('master.units.types.index')->with('success', __('Data has been deleted successfully.'));
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

            return redirect()->back();
        }
    }
}
