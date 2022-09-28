@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bestSeller.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.best-sellers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bestSeller.fields.id') }}
                        </th>
                        <td>
                            {{ $bestSeller->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bestSeller.fields.description') }}
                        </th>
                        <td>
                            {{ $bestSeller->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bestSeller.fields.product') }}
                        </th>
                        <td>
                            {{ $bestSeller->product->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.best-sellers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection