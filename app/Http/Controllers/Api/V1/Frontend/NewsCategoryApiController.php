<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreNewsCategoryRequest;
use App\Http\Requests\UpdateNewsCategoryRequest;
use App\Http\Resources\Admin\NewsCategoryResource;
use App\Models\NewsCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return new NewsCategoryResource(NewsCategory::all());
    }

}
