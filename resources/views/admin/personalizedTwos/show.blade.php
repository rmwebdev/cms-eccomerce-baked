@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.personalizedTwo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.personalized-twos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.personalizedTwo.fields.id') }}
                        </th>
                        <td>
                            {{ $personalizedTwo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.personalizedTwo.fields.products') }}
                        </th>
                        <td>
                            {{ $personalizedTwo->products->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.personalizedTwo.fields.discount') }}
                        </th>
                        <td>
                            {{ $personalizedTwo->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.personalizedTwo.fields.image') }}
                        </th>
                        <td>
                            @if($personalizedTwo->image)
                                <a href="{{ $personalizedTwo->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $personalizedTwo->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.personalized-twos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection