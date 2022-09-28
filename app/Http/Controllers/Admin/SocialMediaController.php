<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySocialMediumRequest;
use App\Http\Requests\StoreSocialMediumRequest;
use App\Http\Requests\UpdateSocialMediumRequest;
use App\Models\SocialMedium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SocialMediaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('social_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialMedia = SocialMedium::all();

        return view('admin.socialMedia.index', compact('socialMedia'));
    }

    public function create()
    {
        abort_if(Gate::denies('social_medium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socialMedia.create');
    }

    public function store(StoreSocialMediumRequest $request)
    {
        $socialMedium = SocialMedium::create($request->all());

        return redirect()->route('admin.social-media.index');
    }

    public function edit(SocialMedium $socialMedium)
    {
        abort_if(Gate::denies('social_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socialMedia.edit', compact('socialMedium'));
    }

    public function update(UpdateSocialMediumRequest $request, SocialMedium $socialMedium)
    {
        $socialMedium->update($request->all());

        return redirect()->route('admin.social-media.index');
    }

    public function show(SocialMedium $socialMedium)
    {
        abort_if(Gate::denies('social_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socialMedia.show', compact('socialMedium'));
    }

    public function destroy(SocialMedium $socialMedium)
    {
        abort_if(Gate::denies('social_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialMedium->delete();

        return back();
    }

    public function massDestroy(MassDestroySocialMediumRequest $request)
    {
        SocialMedium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
