<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'evaluation' => 'required|integer',
            'title' => 'required|min:5|max:100',
            'content' => 'required|min:50|max:1024',
        ];
    }
    public function attributes()
    {
        return [
            'evaluation' => '評価',
            'title' => 'タイトル',
            'content' => '詳細',
        ];
    }
}
