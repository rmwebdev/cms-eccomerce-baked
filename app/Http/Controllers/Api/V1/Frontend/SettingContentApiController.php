<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSettingContentRequest;
use App\Http\Requests\UpdateSettingContentRequest;
use App\Http\Resources\Admin\SettingContentResource;
use App\Models\SettingContent;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingContentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        return new SettingContentResource(SettingContent::all());
    }

}
