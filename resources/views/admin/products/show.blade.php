@extends('layouts.admin')
@section('styles')
<style>
    .dz-remove {
    display: none !important;
}
</style>
@endsection
@section('content')



<div class="card">
    <div class="card-header bg-primary text-white justify-content-between">
        <span class=""> <icon class="fa fa-barcode text-md"></icon>  Detail product</span>
    </div>

    <div class="card-body">
        <form class="row g-3">
            
            <div class="form-group col-6">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" readonly>
                
            </div>
            <div class="form-group col-6">
                <label class="required" for="slug">{{ trans('cruds.product.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" required readonly>
                
            </div>
            <div class="form-group col-6">
                <label class="required" for="short_description">{{ trans('cruds.product.fields.short_description') }}</label>
                <input class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}" type="text" name="short_description" id="short_description" value="{{ old('short_description', $product->short_description) }}" readonly>
            </div>
            <div class="form-group col-2">
                <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" readonly>
               
            </div>
            <div class="form-group col-1">
                <label for="stock">{{ trans('cruds.product.fields.stock') }}</label>
                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" readonly type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" step="1">
                
            </div>
            <div class="form-group col-3">
                <label for="expired_date">{{ trans('cruds.product.fields.expired_date') }}</label>
                <input class="form-control date {{ $errors->has('expired_date') ? 'is-invalid' : '' }}" readonly type="text" name="expired_date" id="expired_date" value="{{ old('expired_date', $product->expired_date) }}">
                
            </div>
            <div class="form-group col-1">
                <label for="discount">{{ trans('cruds.product.fields.discount') }}(%)</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" readonly type="number" name="discount" id="discount" value="{{ old('discount', $product->discount) }}" step="1">
               
            </div>
            <div class="form-group col-2">
                <label for="price_new">{{ trans('cruds.product.fields.price_new') }}</label>
                <input class="form-control {{ $errors->has('price_new') ? 'is-invalid' : '' }}" readonly type="number" name="price_new" id="price_new" value="{{ old('price_new', $product->price_new) }}" step="0.01" readonly>
                
            </div>
            <div class="form-group col-9"></div>
            <div class="form-group col-6">
                <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"readonly rows="8" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                
            </div>
            
            <div class="form-group col-3">
                <label for="categories">{{ trans('cruds.product.fields.category') }}</label>
                <br/>
                @foreach($product->categories as $key => $category)
                <span class="badge text-bg-dark">{{ $category->name }}</span>
                @endforeach
                
            </div>
            <div class="form-group col-3">
                <label for="tags">{{ trans('cruds.product.fields.tag') }}</label>
               <br/>
                @foreach($product->tags as $key => $tag)
                <span class="badge text-bg-dark">{{ $tag->name }}</span>
                @endforeach
            </div>
            <div class="form-group col-2">
                <label class="required" for="thumb">{{ trans('cruds.product.fields.thumb') }}&nbsp;(Primary image)</label>
                <div class="" >
                    @if($product->thumb)
                                <a href="{{ $product->thumb->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $product->thumb->getUrl('thumb') }}">
                                </a>
                            @endif
                </div>
            </div>
            <div class="form-group col-10">
                @if(count($product->images) > 1)
                <label for="images">{{ trans('cruds.product.fields.images') }}&nbsp; (Slider images)</label>
                <div class="" >
                    @foreach($product->images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                </div>
                @endif
                
            </div>
            <div class="form-group">
                <a class="btn btn-danger" href="{{ route('admin.products.index') }}">
                    Back to list
                </a>
            </div>
        </form>
    </div>
</div>
@endsection