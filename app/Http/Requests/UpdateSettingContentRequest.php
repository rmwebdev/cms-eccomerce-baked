<?php

namespace App\Http\Requests;

use App\Models\SettingContent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSettingContentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('setting_content_edit');
    }

    public function rules()
    {
        return [
            'tag_line_product' => [
                'string',
                'nullable',
            ],
            'url_video' => [
                'string',
                'nullable',
            ],
        ];
    }
}
