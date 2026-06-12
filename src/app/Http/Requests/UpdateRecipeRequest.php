<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRecipeRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:recipes,name,' . $this->route('recipe')->id,
            'material_ids' => 'required|array',
            'material_ids.*' => 'required|exists:materials,id',
            'materials' => 'required|array',
            'materials.*' => 'required|numeric|min:0',
            // 新材料のバリデーション（両方指定されている場合のみ）
            'new_material_name' => 'nullable|string|max:255',
            'new_material_unit' => 'nullable|string|max:255',
            'new_material_quantity' => 'nullable|numeric|min:0',
        ];
    }
}
