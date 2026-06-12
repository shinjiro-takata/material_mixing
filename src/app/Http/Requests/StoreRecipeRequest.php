<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('admin-only'); // 管理者のみ許可
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:recipes,name',
            'material_ids' => 'required|array',
            'material_ids.*' => 'required|exists:materials,id',
            'materials' => 'required|array',
            'materials.*' => 'required|numeric|min:0',
        ];
    }
}
