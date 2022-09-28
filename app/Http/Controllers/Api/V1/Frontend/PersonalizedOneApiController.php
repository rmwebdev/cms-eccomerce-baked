<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePersonalizedOneRequest;
use App\Http\Requests\UpdatePersonalizedOneRequest;
use App\Http\Resources\Admin\PersonalizedOneResource;
use App\Models\PersonalizedOne;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonalizedOneApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        return new PersonalizedOneResource(PersonalizedOne::with(['products'])->get());
    }

    public function show(PersonalizedOne $personalizedOne)
    {

        return new PersonalizedOneResource($personalizedOne->load(['products']));
    }

}
