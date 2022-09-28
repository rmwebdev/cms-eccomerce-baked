@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-primary text-white justify-content-between">
        <span class=""> <icon class="fa fa-pencil text-md"></icon>  Edit product</span>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data" class="row g-3">
            @method('PUT')
            @csrf
            <div class="form-group col-6">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required" for="slug">{{ trans('cruds.product.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" required readonly>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.slug_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required" for="short_description">{{ trans('cruds.product.fields.short_description') }}</label>
                <input class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}" type="text" name="short_description" id="short_description" value="{{ old('short_description', $product->short_description) }}" required>
                @if($errors->has('short_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.short_description_helper') }}</span>
            </div>
            <div class="form-group col-2">
                <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
            </div>
            <div class="form-group col-1">
                <label for="stock">{{ trans('cruds.product.fields.stock') }}</label>
                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" step="1">
                @if($errors->has('stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.stock_helper') }}</span>
            </div>
            <div class="form-group col-3">
                <label for="expired_date">{{ trans('cruds.product.fields.expired_date') }}</label>
                <input class="form-control date {{ $errors->has('expired_date') ? 'is-invalid' : '' }}" type="text" name="expired_date" id="expired_date" value="{{ old('expired_date', $product->expired_date) }}">
                @if($errors->has('expired_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expired_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.expired_date_helper') }}</span>
            </div>
            <div class="form-group col-1">
                <label for="discount">{{ trans('cruds.product.fields.discount') }}(%)</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', $product->discount) }}" step="1">
                @if($errors->has('discount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.discount_helper') }}</span>
            </div>
            <div class="form-group col-2">
                <label for="price_new">{{ trans('cruds.product.fields.price_new') }}</label>
                <input class="form-control {{ $errors->has('price_new') ? 'is-invalid' : '' }}" type="number" name="price_new" id="price_new" value="{{ old('price_new', $product->price_new) }}" step="0.01" readonly>
                @if($errors->has('price_new'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_new') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_new_helper') }}</span>
            </div>
            <div class="form-group col-9"></div>
            <div class="form-group col-6">
                <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="8" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>
            
            <div class="form-group col-3">
                <label for="categories">{{ trans('cruds.product.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $product->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div>
            <div class="form-group col-3">
                <label for="tags">{{ trans('cruds.product.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $product->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.tag_helper') }}</span>
            </div>
            <div class="form-group col-2">
                <label class="required" for="thumb">{{ trans('cruds.product.fields.thumb') }}&nbsp;(Primary image)</label>
                <div class="needsclick dropzone {{ $errors->has('thumb') ? 'is-invalid' : '' }}" id="thumb-dropzone">
                </div>
                @if($errors->has('thumb'))
                    <div class="invalid-feedback">
                        {{ $errors->first('thumb') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.thumb_helper') }}</span>
            </div>
            <div class="form-group col-10">
                <label for="images">{{ trans('cruds.product.fields.images') }}&nbsp; (Slider images)</label>
                <div class="needsclick dropzone {{ $errors->has('images') ? 'is-invalid' : '' }}" id="images-dropzone">
                </div>
                @if($errors->has('images'))
                    <div class="invalid-feedback">
                        {{ $errors->first('images') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.images_helper') }}</span>
            </div>
            <input name="user_update_id" value="{{ Auth::user()->id }}" type="hidden">
            <div class="form-group">
                <button class="btn btn-primary mr-2" type="submit">
                    Update Product
                </button>
                <a class="btn btn-danger" href="{{ route('admin.products.index') }}">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>

    // slug function
    $('#name').change(function(e){
        $.get("{{ route('admin.products.checkSlug')}}",
            { 'name' : $(this).val() },
            function( data ) {
                $('#slug').val(data.slug);
            })
    })

    // discount calculate function
    $('#discount').change(function(e){
        let price = 0
        let discount = parseInt($(this).val())
        let old_price = parseInt($('#price').val())
        price = old_price - (discount * old_price / 100)
        
        $('#price_new').val(price);
            
    })


    Dropzone.options.thumbDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="thumb"]').remove()
      $('form').append('<input type="hidden" name="thumb" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="thumb"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->thumb)
      var file = {!! json_encode($product->thumb) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="thumb" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($product) && $product->images)
      var files = {!! json_encode($product->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection