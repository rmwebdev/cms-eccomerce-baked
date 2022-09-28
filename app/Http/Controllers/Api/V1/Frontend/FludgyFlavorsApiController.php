<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFludgyFlavorRequest;
use App\Http\Requests\UpdateFludgyFlavorRequest;
use App\Http\Resources\Admin\FludgyFlavorResource;
use App\Models\FludgyFlavor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FludgyFlavorsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fludgy_flavor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FludgyFlavorResource(FludgyFlavor::with(['product'])->get());
    }


    public function show(FludgyFlavor $fludgyFlavor)
    {
        abort_if(Gate::denies('fludgy_flavor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FludgyFlavorResource($fludgyFlavor->load(['product']));
    }

}
