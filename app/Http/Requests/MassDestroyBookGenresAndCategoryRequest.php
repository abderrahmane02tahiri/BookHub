<?php

namespace App\Http\Requests;

use App\Models\BookGenresAndCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBookGenresAndCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('book_genres_and_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:book_genres_and_categories,id',
        ];
    }
}
