<?php

namespace App\Http\Requests;

use App\Models\SocialMedium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSocialMediumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('social_medium_edit');
    }

    public function rules()
    {
        return [
            'phone' => [
                'string',
                'min:8',
                'max:14',
                'nullable',
            ],
            'facebook' => [
                'string',
                'nullable',
            ],
            'instagram' => [
                'string',
                'nullable',
            ],
            'twitter' => [
                'string',
                'nullable',
            ],
            'tiktok' => [
                'string',
                'nullable',
            ],
            'linkind' => [
                'string',
                'nullable',
            ],
        ];
    }
}
