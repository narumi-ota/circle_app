<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'content' => 'required',
            'due_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '本文を入力してください!!',
            'due_date.required' => '期日を入力してください!!',
        ];
    }
}