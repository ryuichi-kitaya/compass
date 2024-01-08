<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    protected function passedValidation()
    {
    $date = Date::createMidnightDate($this->input('old_year'), $this->input('old_month'), $this->input('old_day'));

    $this->merge([
        'date' => Date::parse($this->input('date')),
    ]);
    }

    public function rules()
    {
        return [
          'over_name' => 'required|string|max:10',
          'under_name' => 'required|string|max:10',
          'over_name_kana' => 'required|string|regex:/[ァ-ヴー]+/u|max:30',
          'under_name_kana' => 'required|string|regex:/[ァ-ヴー]+/u|max:30',
          'mail_address' => 'required|email|unique:users,mail_address|max:100',
          'sex' => 'required|in:1,2,3',
          'date' => 'required|date|before:today|after_or_equal:2000-01-01',
          'role' => 'required|in:1,2,3,4',
          'password' => 'required|min:8|max:30|confirmed',
        ];
    }

    public function messages(){
        return [
            'over_name.required' =>'姓は入力必須です。',
            'over_name.max' =>'姓は10文字以内で入力してください。',
            'under_name.required' =>'名は入力必須です。',
            'under_name.max' =>'名は10文字以内で入力してください。',
            'over_name_kana.required' =>'姓(カナ)は入力必須です。',
            'over_name_kana.max' =>'姓(カナ)は30文字以内で入力してください。',
            'under_name_kana.required' =>'名(カナ)は入力必須です。',
            'under_name_kana.max' =>'名(カナ)は30文字以内で入力してください。',
            'mail_address.required' =>'メールアドレスは入力必須です。',
            'mail_address.max' =>'メールアドレスは100文字以内で入力してください。',
            'mail_address.unique' =>'既に登録済みのメールアドレスは使えません。',
            'sex.required' =>'性別は入力必須です。',
            'sex.regex' =>'性別は男または女で登録してください。',
            'date.required' =>'年は入力必須です。',
            'date.after_or_equal' =>'2000年1月1日以降で登録してください。',
            'date.after_or_before' =>'未来日の登録はできません。',
            'role.required' =>'役職は入力必須です。',
            'password' =>'パスワードは入力必須です。',
            'password.min' =>'8文字以上で登録してください。',
            'password.max' =>'30文字以内で登録してください。',
        ];
    }
}
