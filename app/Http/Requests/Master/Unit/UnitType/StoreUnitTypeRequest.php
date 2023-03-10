<?php

namespace App\Http\Requests\Master\Unit\UnitType;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Master\Unit\UnitType;

class StoreUnitTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $table = (new UnitType)->getTable();
        
        return [
            'name' => 'required|string|unique:'. $table .',name'
        ];
    }
}
