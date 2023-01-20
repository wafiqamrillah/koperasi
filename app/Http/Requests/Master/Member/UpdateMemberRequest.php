<?php

namespace App\Http\Requests\System\Member;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('edit member');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $table = (new Member)->getTable();
        
        return [
            'name' => 'required|string',
            'id_card_number' => 'required|numeric|unique:'. $table .',id_card_number',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'is_married' => 'boolean',
            'phone_number' => 'nullable|numeric',
            'account_number' => 'nullable|numeric',
            'is_active' => 'boolean',
            'employee_id' => 'nullable|numeric|unique:' . $table . ',employee_id'
        ];
    }
}
