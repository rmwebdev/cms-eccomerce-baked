<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSocialMediumRequest;
use App\Http\Requests\UpdateSocialMediumRequest;
use App\Http\Resources\Admin\SocialMediumResource;
use App\Models\SocialMedium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SocialMediaApiController extends Controller
{
    public function index()
    {

        return new SocialMediumResource(SocialMedium::all());
    }

}
