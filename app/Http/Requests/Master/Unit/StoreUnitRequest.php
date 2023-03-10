<?php

namespace App\Http\Requests\Master\Unit;

use Illuminate\Foundation\Http\FormRequest;

// Models
use App\Models\Master\Unit\{ Unit, UnitType };

class StoreUnitRequest extends FormRequest
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
        $table = (new Unit)->getTable();
        $type_table = (new UnitType)->getTable();

        return [
            'name' => 'required|string|unique:' . $table . ',name',
            'code' => 'required|string|unique:' . $table . ',code',
            'description' => 'nullable|string',
            'type_id' => 'nullable|exists:' . $type_table . ',id'
        ];
    }
}
