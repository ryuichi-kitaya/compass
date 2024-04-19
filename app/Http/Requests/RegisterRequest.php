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
    
    public function getValidatorInstance()
    {
        $date = [
            $this->input('old_year'),
            $this->input('old_month'),
            $this->input('old_day')
        ];
        $date_validate = implode('-', $date);
        //↑文字列を連結させるための記述。＄dateをハイフンでつなげる
        $this->merge(['date' => $date_validate,]);
        //連結の時に使った$date_validate変数をdateとして扱う。
        return parent::getValidatorInstance();
        //このメソッドを実行します。先に合体を走らせることで後のバリデーションが生きる
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
            'over_name_kana.regex' =>'カタカナで入力してください。',
            'under_name_kana.required' =>'名(カナ)は入力必須です。',
            'under_name_kana.max' =>'名(カナ)は30文字以内で入力してください。',
            'under_name_kana.regex' =>'カタカナで入力してください。',
            'mail_address.required' =>'メールアドレスは入力必須です。',
            'mail_address.email' =>'メール形式で入力してください。',
            'mail_address.max' =>'メールアドレスは100文字以内で入力してください。',
            'mail_address.unique' =>'既に登録済みのメールアドレスは使えません。',
            'sex.required' =>'性別は入力必須です。',
            'sex.regex' =>'性別は男またはその他で登録してください。',
            'date.required' =>'生年月日は入力必須です。',
            'date.date' =>'正しい日付で入力してください。',
            'date.after_or_equal' =>'2000年1月1日以降で登録してください。',
            'date.after_or_before' =>'未来日の登録はできません。',
            'role.required' =>'役職は入力必須です。',
            'password.required' =>'パスワードは入力必須です。',
            'password.confirmed' =>'入力と確認用が相違しています。',
            'password.min' =>'8文字以上で登録してください。',
            'password.max' =>'30文字以内で登録してください。',
        ];
    }
}
