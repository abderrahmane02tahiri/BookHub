<?php

namespace App\Http\Requests;

use App\Models\BookGenresAndCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookGenresAndCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('book_genres_and_category_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
