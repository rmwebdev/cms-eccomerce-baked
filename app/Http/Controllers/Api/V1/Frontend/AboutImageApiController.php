<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAboutImageRequest;
use App\Http\Requests\UpdateAboutImageRequest;
use App\Http\Resources\Admin\AboutImageResource;
use App\Models\AboutImage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AboutImageApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return new AboutImageResource(AboutImage::all());
    }
}
