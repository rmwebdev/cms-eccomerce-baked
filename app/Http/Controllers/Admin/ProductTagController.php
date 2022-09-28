<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductTagRequest;
use App\Http\Requests\StoreProductTagRequest;
use App\Http\Requests\UpdateProductTagRequest;
use App\Models\ProductTag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductTagController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductTag::with(['user_create', 'user_update'])->select(sprintf('%s.*', (new ProductTag())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_tag_show';
                $editGate = 'product_tag_edit';
                $deleteGate = 'product_tag_delete';
                $crudRoutePart = 'product-tags';

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
            $table->addColumn('user_create_name', function ($row) {
                return $row->user_create ? $row->user_create->name : '';
            });

            $table->addColumn('user_update_name', function ($row) {
                return $row->user_update ? $row->user_update->name : '';
            });

            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'thumb', 'user_create', 'user_update']);

            return $table->make(true);
        }

        return view('admin.productTags.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_creates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_updates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productTags.create', compact('user_creates', 'user_updates'));
    }

    public function store(StoreProductTagRequest $request)
    {
        $productTag = ProductTag::create($request->all());

        if ($request->input('thumb', false)) {
            $productTag->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb'))))->toMediaCollection('thumb');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productTag->id]);
        }

        return redirect()->route('admin.product-tags.index');
    }

    public function edit(ProductTag $productTag)
    {
        abort_if(Gate::denies('product_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_creates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_updates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productTag->load('user_create', 'user_update');

        return view('admin.productTags.edit', compact('productTag', 'user_creates', 'user_updates'));
    }

    public function update(UpdateProductTagRequest $request, ProductTag $productTag)
    {
        $productTag->update($request->all());

        if ($request->input('thumb', false)) {
            if (!$productTag->thumb || $request->input('thumb') !== $productTag->thumb->file_name) {
                if ($productTag->thumb) {
                    $productTag->thumb->delete();
                }
                $productTag->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb'))))->toMediaCollection('thumb');
            }
        } elseif ($productTag->thumb) {
            $productTag->thumb->delete();
        }

        return redirect()->route('admin.product-tags.index');
    }

    public function show(ProductTag $productTag)
    {
        abort_if(Gate::denies('product_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productTag->load('user_create', 'user_update');

        return view('admin.productTags.show', compact('productTag'));
    }

    public function destroy(ProductTag $productTag)
    {
        abort_if(Gate::denies('product_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductTagRequest $request)
    {
        ProductTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_tag_create') && Gate::denies('product_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductTag();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
