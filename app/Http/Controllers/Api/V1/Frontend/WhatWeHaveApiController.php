<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWhatWeHaveRequest;
use App\Http\Requests\UpdateWhatWeHaveRequest;
use App\Http\Resources\Admin\WhatWeHaveResource;
use App\Models\WhatWeHave;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WhatWeHaveApiController extends Controller
{
    public function index()
    {

        return new WhatWeHaveResource(WhatWeHave::all());
    }

}
