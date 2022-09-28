@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productTag.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-tags.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productTag.fields.id') }}
                        </th>
                        <td>
                            {{ $productTag->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productTag.fields.name') }}
                        </th>
                        <td>
                            {{ $productTag->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productTag.fields.thumb') }}
                        </th>
                        <td>
                            @if($productTag->thumb)
                                <a href="{{ $productTag->thumb->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $productTag->thumb->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productTag.fields.user_create') }}
                        </th>
                        <td>
                            {{ $productTag->user_create->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productTag.fields.user_update') }}
                        </th>
                        <td>
                            {{ $productTag->user_update->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productTag.fields.slug') }}
                        </th>
                        <td>
                            {{ $productTag->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-tags.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection