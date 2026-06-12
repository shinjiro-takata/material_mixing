<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'name.string' => '名前は文字列である必要があります。',
            'name.max' => '名前は255文字以下である必要があります。',
            'email.required' => 'メールアドレスは必須です。',
            'email.string' => 'メールアドレスは文字列である必要があります。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以下である必要があります。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'password.required' => 'パスワードは必須です。',
            'password.string' => 'パスワードは文字列である必要があります。',
            'password.min' => 'パスワードは8文字以上である必要があります。',
            'password.confirmed' => 'パスワードの確認が一致しません。',
            'is_admin.boolean' => '管理者フラグは真偽値である必要があります。',
        ];
    }
}
