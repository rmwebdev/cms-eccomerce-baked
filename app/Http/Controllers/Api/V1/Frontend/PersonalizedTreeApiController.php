<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePersonalizedTreeRequest;
use App\Http\Requests\UpdatePersonalizedTreeRequest;
use App\Http\Resources\Admin\PersonalizedTreeResource;
use App\Models\PersonalizedTree;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonalizedTreeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('personalized_tree_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PersonalizedTreeResource(PersonalizedTree::with(['products'])->get());
    }

  
    public function show(PersonalizedTree $personalizedTree)
    {
        abort_if(Gate::denies('personalized_tree_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PersonalizedTreeResource($personalizedTree->load(['products']));
    }

}
