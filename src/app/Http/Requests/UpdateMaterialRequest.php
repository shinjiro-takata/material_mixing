<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateMaterialRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:materials,name,' . $this->route('material')->id,
            'unit' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '材料名は必須です',
            'name.unique' => 'この材料名は既に登録されています',
            'name.max' => '材料名は255文字以内で入力してください',
            'unit.required' => '単位は必須です',
            'unit.max' => '単位は255文字以内で入力してください',
        ];
    }
}
