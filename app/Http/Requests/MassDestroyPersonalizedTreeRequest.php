<?php

namespace App\Http\Requests;

use App\Models\PersonalizedTree;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPersonalizedTreeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('personalized_tree_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:personalized_trees,id',
        ];
    }
}
