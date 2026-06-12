<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeighingLogRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'recipe_id' => 'required|exists:recipes,id',
            'weighed_at' => 'required|date_format:Y-m-d\TH:i',
            'notes' => 'nullable|string',
            'materials.*' => 'required|numeric|min:0',
        ];
    }
}
