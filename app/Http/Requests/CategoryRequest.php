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
            'main_category_name' => 'required|string|max:100|unique:main_categories,main_category',
            'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
        ];
    }

    public function messages(){
        return [
            'main_category_name.required' =>'入力は必須です。',
            'main_category_name.max' =>'100文字以内で登録をしてください。',
            'main_category_name.unique' =>'同じカテゴリーは登録できません。',
            'sub_category_name.required' =>'入力は必須です。',
            'sub_category_name.max' =>'100文字以内で登録をしてください。',
            'sub_category_name.unique' =>'同じサブカテゴリーは登録できません。',
        ];
    }
}
