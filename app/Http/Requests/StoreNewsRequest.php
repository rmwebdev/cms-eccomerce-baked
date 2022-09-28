<?php

namespace App\Http\Requests;

use App\Models\News;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNewsRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('news_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:3',
                'required',
            ],
            'short_body' => [
                'required',
            ],
            'body' => [
                'required',
            ],
            'thumb' => [
                'required',
            ],
            'images' => [
                'array',
            ],
            'publish_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'required',
                'array',
            ],
            'tags_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
