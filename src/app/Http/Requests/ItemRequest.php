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
            'image' => 'required|string|max:50',
            'name' => 'required|string|max:128',
            'maker' => 'required|string|max:50',
            'content' => 'required|string|max:512',
        ];
    }
}
