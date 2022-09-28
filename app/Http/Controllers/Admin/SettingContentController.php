<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySettingContentRequest;
use App\Http\Requests\StoreSettingContentRequest;
use App\Http\Requests\UpdateSettingContentRequest;
use App\Models\SettingContent;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SettingContentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('setting_content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settingContents = SettingContent::with(['media'])->get();

        return view('admin.settingContents.index', compact('settingContents'));
    }

    public function create()
    {
        abort_if(Gate::denies('setting_content_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settingContents.create');
    }

    public function store(StoreSettingContentRequest $request)
    {
        $settingContent = SettingContent::create($request->all());

        if ($request->input('product_image', false)) {
            $settingContent->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_image'))))->toMediaCollection('product_image');
        }

        if ($request->input('thumbnail_video', false)) {
            $settingContent->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumbnail_video'))))->toMediaCollection('thumbnail_video');
        }

        if ($request->input('video', false)) {
            $settingContent->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $settingContent->id]);
        }

        return redirect()->route('admin.setting-contents.index');
    }

    public function edit(SettingContent $settingContent)
    {
        abort_if(Gate::denies('setting_content_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settingContents.edit', compact('settingContent'));
    }

    public function update(UpdateSettingContentRequest $request, SettingContent $settingContent)
    {
        $settingContent->update($request->all());

        if ($request->input('product_image', false)) {
            if (!$settingContent->product_image || $request->input('product_image') !== $settingContent->product_image->file_name) {
                if ($settingContent->product_image) {
                    $settingContent->product_image->delete();
                }
                $settingContent->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_image'))))->toMediaCollection('product_image');
            }
        } elseif ($settingContent->product_image) {
            $settingContent->product_image->delete();
        }

        if ($request->input('thumbnail_video', false)) {
            if (!$settingContent->thumbnail_video || $request->input('thumbnail_video') !== $settingContent->thumbnail_video->file_name) {
                if ($settingContent->thumbnail_video) {
                    $settingContent->thumbnail_video->delete();
                }
                $settingContent->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumbnail_video'))))->toMediaCollection('thumbnail_video');
            }
        } elseif ($settingContent->thumbnail_video) {
            $settingContent->thumbnail_video->delete();
        }

        if ($request->input('video', false)) {
            if (!$settingContent->video || $request->input('video') !== $settingContent->video->file_name) {
                if ($settingContent->video) {
                    $settingContent->video->delete();
                }
                $settingContent->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($settingContent->video) {
            $settingContent->video->delete();
        }

        return redirect()->route('admin.setting-contents.index');
    }

    public function show(SettingContent $settingContent)
    {
        abort_if(Gate::denies('setting_content_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settingContents.show', compact('settingContent'));
    }

    public function destroy(SettingContent $settingContent)
    {
        abort_if(Gate::denies('setting_content_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settingContent->delete();

        return back();
    }

    public function massDestroy(MassDestroySettingContentRequest $request)
    {
        SettingContent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('setting_content_create') && Gate::denies('setting_content_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SettingContent();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
