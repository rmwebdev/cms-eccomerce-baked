<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPersonalizedOneRequest;
use App\Http\Requests\StorePersonalizedOneRequest;
use App\Http\Requests\UpdatePersonalizedOneRequest;
use App\Models\PersonalizedOne;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PersonalizedOneController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('personalized_one_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PersonalizedOne::with(['products'])->select(sprintf('%s.*', (new PersonalizedOne())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'personalized_one_show';
                $editGate = 'personalized_one_edit';
                $deleteGate = 'personalized_one_delete';
                $crudRoutePart = 'personalized-ones';

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
            $table->editColumn('tittle_banner', function ($row) {
                return $row->tittle_banner ? $row->tittle_banner : '';
            });
            $table->addColumn('products_name', function ($row) {
                return $row->products ? $row->products->name : '';
            });

            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'products', 'image']);

            return $table->make(true);
        }

        return view('admin.personalizedOnes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('personalized_one_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.personalizedOnes.create', compact('products'));
    }

    public function store(StorePersonalizedOneRequest $request)
    {
        $personalizedOne = PersonalizedOne::create($request->all());

        if ($request->input('image', false)) {
            $personalizedOne->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $personalizedOne->id]);
        }

        return redirect()->route('admin.personalized-ones.index');
    }

    public function edit(PersonalizedOne $personalizedOne)
    {
        abort_if(Gate::denies('personalized_one_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $personalizedOne->load('products');

        return view('admin.personalizedOnes.edit', compact('personalizedOne', 'products'));
    }

    public function update(UpdatePersonalizedOneRequest $request, PersonalizedOne $personalizedOne)
    {
        $personalizedOne->update($request->all());

        if ($request->input('image', false)) {
            if (!$personalizedOne->image || $request->input('image') !== $personalizedOne->image->file_name) {
                if ($personalizedOne->image) {
                    $personalizedOne->image->delete();
                }
                $personalizedOne->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($personalizedOne->image) {
            $personalizedOne->image->delete();
        }

        return redirect()->route('admin.personalized-ones.index');
    }

    public function show(PersonalizedOne $personalizedOne)
    {
        abort_if(Gate::denies('personalized_one_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalizedOne->load('products');

        return view('admin.personalizedOnes.show', compact('personalizedOne'));
    }

    public function destroy(PersonalizedOne $personalizedOne)
    {
        abort_if(Gate::denies('personalized_one_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalizedOne->delete();

        return back();
    }

    public function massDestroy(MassDestroyPersonalizedOneRequest $request)
    {
        PersonalizedOne::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('personalized_one_create') && Gate::denies('personalized_one_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PersonalizedOne();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
