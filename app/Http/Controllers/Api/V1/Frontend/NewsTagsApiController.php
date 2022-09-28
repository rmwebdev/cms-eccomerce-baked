<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreNewsTagRequest;
use App\Http\Requests\UpdateNewsTagRequest;
use App\Http\Resources\Admin\NewsTagResource;
use App\Models\NewsTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsTagsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
     return new NewsTagResource(NewsTag::all());
    }

}
