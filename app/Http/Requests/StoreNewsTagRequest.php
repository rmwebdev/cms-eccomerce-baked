<?php

namespace App\Http\Requests;

use App\Models\NewsTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNewsTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('news_tag_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:3',
                'max:20',
                'required',
                'unique:news_tags',
            ],
            'slug' => [
                'string',
                'required',
                'unique:news_tags',
            ],
        ];
    }
}
