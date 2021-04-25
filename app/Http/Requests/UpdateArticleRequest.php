<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
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
    public function rules(): array
    {
        $article = $this->route('article');
        $data = Validator::make(request()->all(), [
                'code' => [
                'required',
                Rule::unique('articles')->ignore($article),
                'alpha_dash',
            ],
            'title' => ['required', 'between:5,100'],
            'body' => ['required'],
            'annotation' => ['required','max:255'],
        ]);

        return $data->getRules();
    }
}
