<?php

namespace App\Http\Requests\Master\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Master\Product\Product;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('edit product');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $table = (new Product)->getTable();

        return [
            'number' => 'nullable|string|unique:' . $table . ',number' . ($this->route('product') ? ','.$this->route('product')->id : ''),
            'name' => 'required|string',
            'description' => 'nullable|string',
            'brand' => 'nullable|string',
            'is_active' => 'boolean',
            'barcode' => 'nullable|string',
        ];
    }
}
