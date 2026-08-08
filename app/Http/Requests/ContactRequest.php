<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules()
    {
        //フォームバリデーションを定義
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        //各バリデーションルールに対するエラーメッセージを定義
        return [
            'name.required' => '名前は必須です。',
            'name.max' => '名前は255文字以内で入力してください。',
            'email.required' => 'Eメールは必須です。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'message.required' => '内容は必須です。',
        ];
    }
}
