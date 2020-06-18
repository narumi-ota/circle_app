<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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
            'image' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(){
        return [
            'image.required' => '画像が選択されていません',
            'image.max' => '画像の容量が大きすぎます',
        ];
    }
}