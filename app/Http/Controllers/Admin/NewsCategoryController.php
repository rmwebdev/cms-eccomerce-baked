<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNewsCategoryRequest;
use App\Http\Requests\StoreNewsCategoryRequest;
use App\Http\Requests\UpdateNewsCategoryRequest;
use App\Models\NewsCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NewsCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('news_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NewsCategory::query()->select(sprintf('%s.*', (new NewsCategory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'news_category_show';
                $editGate = 'news_category_edit';
                $deleteGate = 'news_category_delete';
                $crudRoutePart = 'news-categories';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
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

        return view('admin.newsCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('news_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsCategories.create');
    }

    public function store(StoreNewsCategoryRequest $request)
    {
        $newsCategory = NewsCategory::create($request->all());

        if ($request->input('thumb', false)) {
            $newsCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb'))))->toMediaCollection('thumb');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $newsCategory->id]);
        }

        return redirect()->route('admin.news-categories.index');
    }

    public function edit(NewsCategory $newsCategory)
    {
        abort_if(Gate::denies('news_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsCategories.edit', compact('newsCategory'));
    }

    public function update(UpdateNewsCategoryRequest $request, NewsCategory $newsCategory)
    {
        $newsCategory->update($request->all());

        if ($request->input('thumb', false)) {
            if (!$newsCategory->thumb || $request->input('thumb') !== $newsCategory->thumb->file_name) {
                if ($newsCategory->thumb) {
                    $newsCategory->thumb->delete();
                }
                $newsCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb'))))->toMediaCollection('thumb');
            }
        } elseif ($newsCategory->thumb) {
            $newsCategory->thumb->delete();
        }

        return redirect()->route('admin.news-categories.index');
    }

    public function show(NewsCategory $newsCategory)
    {
        abort_if(Gate::denies('news_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsCategories.show', compact('newsCategory'));
    }

    public function destroy(NewsCategory $newsCategory)
    {
        abort_if(Gate::denies('news_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewsCategoryRequest $request)
    {
        NewsCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('news_category_create') && Gate::denies('news_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new NewsCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
