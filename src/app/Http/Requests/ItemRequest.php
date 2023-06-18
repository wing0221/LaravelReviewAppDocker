<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|string|max:128',
            'maker' => 'required|string|max:50',
            'image' => 'required',
            'content' => 'required|string|max:255',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'アイテム名',
            'maker' => 'メーカー',
            'image' => 'サムネイル',
            'content' => '詳細',
        ];
    }
}
