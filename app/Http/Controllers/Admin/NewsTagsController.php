<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNewsTagRequest;
use App\Http\Requests\StoreNewsTagRequest;
use App\Http\Requests\UpdateNewsTagRequest;
use App\Models\NewsTag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NewsTagsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('news_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NewsTag::query()->select(sprintf('%s.*', (new NewsTag())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'news_tag_show';
                $editGate = 'news_tag_edit';
                $deleteGate = 'news_tag_delete';
                $crudRoutePart = 'news-tags';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('thumb', function ($row) {
                if ($photo = $row->thumb) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'thumb']);

            return $table->make(true);
        }

        return view('admin.newsTags.index');
    }

    public function create()
    {
        abort_if(Gate::denies('news_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsTags.create');
    }

    public function store(StoreNewsTagRequest $request)
    {
        $newsTag = NewsTag::create($request->all());

        if ($request->input('thumb', false)) {
            $newsTag->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb'))))->toMediaCollection('thumb');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $newsTag->id]);
        }

        return redirect()->route('admin.news-tags.index');
    }

    public function edit(NewsTag $newsTag)
    {
        abort_if(Gate::denies('news_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsTags.edit', compact('newsTag'));
    }

    public function update(UpdateNewsTagRequest $request, NewsTag $newsTag)
    {
        $newsTag->update($request->all());

        if ($request->input('thumb', false)) {
            if (!$newsTag->thumb || $request->input('thumb') !== $newsTag->thumb->file_name) {
                if ($newsTag->thumb) {
                    $newsTag->thumb->delete();
                }
                $newsTag->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb'))))->toMediaCollection('thumb');
            }
        } elseif ($newsTag->thumb) {
            $newsTag->thumb->delete();
        }

        return redirect()->route('admin.news-tags.index');
    }

    public function show(NewsTag $newsTag)
    {
        abort_if(Gate::denies('news_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsTags.show', compact('newsTag'));
    }

    public function destroy(NewsTag $newsTag)
    {
        abort_if(Gate::denies('news_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewsTagRequest $request)
    {
        NewsTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('news_tag_create') && Gate::denies('news_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new NewsTag();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
