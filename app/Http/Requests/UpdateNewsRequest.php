<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image-news-item' => 'file|image|max:512',
            'title' => 'required|between:5,100',
            'body' => 'required',
        ];
    }
}
