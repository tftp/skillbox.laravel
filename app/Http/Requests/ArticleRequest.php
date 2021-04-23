<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $method = request('_method');
        $validteData = [
            'title' => 'required|between:5,100',
            'body' => 'required',
            'annotation' => 'required|max:255',
        ];

        $validteData['code'] = ($method == 'PATCH' ? 'required|alpha_dash' : 'required|unique:articles|alpha_dash');

        return $validteData;
    }
}
