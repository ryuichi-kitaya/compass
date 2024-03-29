<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
        ];
    }

    public function messages(){
        return [
            'sub_category_name.required' =>'入力は必須です。',
            'sub_category_name.max' =>'100文字以内で登録をしてください。',
            'sub_category_name.unique' =>'同じサブカテゴリーは登録できません。',
        ];
    }
}
