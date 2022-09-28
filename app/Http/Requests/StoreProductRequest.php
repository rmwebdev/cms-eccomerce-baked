<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:products',
            ],
            'price' => [
                'required',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'short_description' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:products',
            ],
            'thumb' => [
                'required',
            ],
            'images' => [
                'array',
            ],
            'discount' => [
                'nullable',
                'integer',
                'min:0',
                'max:99',
            ],
            'stock' => [
                'nullable',
                'integer',
                'min:0',
                'max:1000000',
            ],
            'expired_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
