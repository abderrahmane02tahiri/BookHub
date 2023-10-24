<?php

namespace App\Http\Requests;

use App\Models\Rating;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRatingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rating_edit');
    }

    public function rules()
    {
        return [
            'book_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
