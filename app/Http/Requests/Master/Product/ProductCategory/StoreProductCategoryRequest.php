<?php

namespace App\Http\Requests\Master\Product\ProductCategory;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Master\Product\ProductCategory;

class StoreProductCategoryRequest extends FormRequest
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
        $table = (new ProductCategory)->getTable();

        return [
            'name' => 'required|string|unique:' . $table . ',name'
        ];
    }
}
