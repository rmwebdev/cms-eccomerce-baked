@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fludgyFlavor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fludgy-flavors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fludgyFlavor.fields.id') }}
                        </th>
                        <td>
                            {{ $fludgyFlavor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fludgyFlavor.fields.banner_tittle') }}
                        </th>
                        <td>
                            {{ $fludgyFlavor->banner_tittle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fludgyFlavor.fields.product') }}
                        </th>
                        <td>
                            {{ $fludgyFlavor->product->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fludgy-flavors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection