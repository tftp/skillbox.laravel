<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image-news-item' => 'required|file|image|max:512',
            'title' => 'required|between:5,100',
            'body' => 'required',
        ];
    }
}
