<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePersonalizedTwoRequest;
use App\Http\Requests\UpdatePersonalizedTwoRequest;
use App\Http\Resources\Admin\PersonalizedTwoResource;
use App\Models\PersonalizedTwo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonalizedTwoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        return new PersonalizedTwoResource(PersonalizedTwo::with(['products'])->get());
    }

    public function show(PersonalizedTwo $personalizedTwo)
    {
        return new PersonalizedTwoResource($personalizedTwo->load(['products']));
    }

}
