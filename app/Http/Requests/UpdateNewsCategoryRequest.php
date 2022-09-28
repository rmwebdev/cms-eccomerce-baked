<?php

namespace App\Http\Requests;

use App\Models\NewsCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNewsCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('news_category_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'required',
                'unique:news_categories,name,' . request()->route('news_category')->id,
            ],
            'slug' => [
                'string',
                'required',
                'unique:news_categories,slug,' . request()->route('news_category')->id,
            ],
        ];
    }
}
