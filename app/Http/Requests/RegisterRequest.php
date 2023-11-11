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
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'over_name' => 'required|string|max:10',
          'under_name' => 'required|string|max:10',
          'over_name_kane' => 'required|string|/\A[ァ-ヴー]+\z/u|max:30',
          'under_name_kana' => 'required|string|/\A[ァ-ヴー]+\z/u|max:30',
          'mail_address' => 'required|mail|unique:users,mail_address|max:100',
          'sex' => 'required|regex:/^[男|女]+$/u',
          'old_year' => 'required',
          'old_month' => 'required|between:1,12',
          'old_day' => 'required|between:1,31',
          'role' => 'required',
          'password' => 'required|min:8|max:30|password_confirmation',
        ];
    }
}
