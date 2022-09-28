<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNewsRequest;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('news_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newss = News::with(['categories', 'tags', 'author', 'media'])->get();

        return view('admin.newss.index', compact('newss'));
    }

    public function create()
    {
        abort_if(Gate::denies('news_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = NewsCategory::pluck('name', 'id');

        $tags = NewsTag::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.newss.create', compact('authors', 'categories', 'tags'));
    }

    public function store(StoreNewsRequest $request)
    {
        $news = News::create($request->all());
        $news->categories()->sync($request->input('categories', []));
        if ($request->input('thumb', false)) {
            $news->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb'))))->toMediaCollection('thumb');
        }

        foreach ($request->input('images', []) as $file) {
            $news->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $news->id]);
        }

        return redirect()->route('admin.newss.index');
    }

    public function edit(News $news)
    {
        abort_if(Gate::denies('news_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = NewsCategory::pluck('name', 'id');

        $tags = NewsTag::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $news->load('categories', 'tags', 'author');

        return view('admin.newss.edit', compact('authors', 'categories', 'news', 'tags'));
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $news->update($request->all());
        $news->categories()->sync($request->input('categories', []));
        if ($request->input('thumb', false)) {
            if (!$news->thumb || $request->input('thumb') !== $news->thumb->file_name) {
                if ($news->thumb) {
                    $news->thumb->delete();
                }
                $news->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb'))))->toMediaCollection('thumb');
            }
        } elseif ($news->thumb) {
            $news->thumb->delete();
        }

        if (count($news->images) > 0) {
            foreach ($news->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $news->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $news->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.newss.index');
    }

    public function show(News $news)
    {
        abort_if(Gate::denies('news_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $news->load('categories', 'tags', 'author');

        return view('admin.newss.show', compact('news'));
    }

    public function destroy(News $news)
    {
        abort_if(Gate::denies('news_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $news->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewsRequest $request)
    {
        News::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('news_create') && Gate::denies('news_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new News();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
