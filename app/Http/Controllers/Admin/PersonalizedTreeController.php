<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPersonalizedTreeRequest;
use App\Http\Requests\StorePersonalizedTreeRequest;
use App\Http\Requests\UpdatePersonalizedTreeRequest;
use App\Models\PersonalizedTree;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PersonalizedTreeController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('personalized_tree_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PersonalizedTree::with(['products'])->select(sprintf('%s.*', (new PersonalizedTree())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'personalized_tree_show';
                $editGate = 'personalized_tree_edit';
                $deleteGate = 'personalized_tree_delete';
                $crudRoutePart = 'personalized-trees';

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

        return view('admin.personalizedTrees.index');
    }

    public function create()
    {
        abort_if(Gate::denies('personalized_tree_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.personalizedTrees.create', compact('products'));
    }

    public function store(StorePersonalizedTreeRequest $request)
    {
        $personalizedTree = PersonalizedTree::create($request->all());

        if ($request->input('image', false)) {
            $personalizedTree->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $personalizedTree->id]);
        }

        return redirect()->route('admin.personalized-trees.index');
    }

    public function edit(PersonalizedTree $personalizedTree)
    {
        abort_if(Gate::denies('personalized_tree_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $personalizedTree->load('products');

        return view('admin.personalizedTrees.edit', compact('personalizedTree', 'products'));
    }

    public function update(UpdatePersonalizedTreeRequest $request, PersonalizedTree $personalizedTree)
    {
        $personalizedTree->update($request->all());

        if ($request->input('image', false)) {
            if (!$personalizedTree->image || $request->input('image') !== $personalizedTree->image->file_name) {
                if ($personalizedTree->image) {
                    $personalizedTree->image->delete();
                }
                $personalizedTree->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($personalizedTree->image) {
            $personalizedTree->image->delete();
        }

        return redirect()->route('admin.personalized-trees.index');
    }

    public function show(PersonalizedTree $personalizedTree)
    {
        abort_if(Gate::denies('personalized_tree_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalizedTree->load('products');

        return view('admin.personalizedTrees.show', compact('personalizedTree'));
    }

    public function destroy(PersonalizedTree $personalizedTree)
    {
        abort_if(Gate::denies('personalized_tree_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalizedTree->delete();

        return back();
    }

    public function massDestroy(MassDestroyPersonalizedTreeRequest $request)
    {
        PersonalizedTree::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('personalized_tree_create') && Gate::denies('personalized_tree_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PersonalizedTree();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
