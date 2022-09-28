@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productBannerTwo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-banner-twos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productBannerTwo.fields.id') }}
                        </th>
                        <td>
                            {{ $productBannerTwo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBannerTwo.fields.tittle_banner') }}
                        </th>
                        <td>
                            {{ $productBannerTwo->tittle_banner }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBannerTwo.fields.products') }}
                        </th>
                        <td>
                            {{ $productBannerTwo->products->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBannerTwo.fields.discount') }}
                        </th>
                        <td>
                            {{ $productBannerTwo->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBannerTwo.fields.image') }}
                        </th>
                        <td>
                            @if($productBannerTwo->image)
                                <a href="{{ $productBannerTwo->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $productBannerTwo->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-banner-twos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection