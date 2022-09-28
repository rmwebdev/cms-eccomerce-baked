@extends('layouts.admin')
@section('content')
@can('setting_content_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.setting-contents.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.settingContent.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.settingContent.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SettingContent">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.settingContent.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.settingContent.fields.tag_line_product') }}
                        </th>
                        <th>
                            {{ trans('cruds.settingContent.fields.product_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.settingContent.fields.thumbnail_video') }}
                        </th>
                        <th>
                            {{ trans('cruds.settingContent.fields.url_video') }}
                        </th>
                        <th>
                            {{ trans('cruds.settingContent.fields.video') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($settingContents as $key => $settingContent)
                        <tr data-entry-id="{{ $settingContent->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $settingContent->id ?? '' }}
                            </td>
                            <td>
                                {{ $settingContent->tag_line_product ?? '' }}
                            </td>
                            <td>
                                @if($settingContent->product_image)
                                    <a href="{{ $settingContent->product_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $settingContent->product_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($settingContent->thumbnail_video)
                                    <a href="{{ $settingContent->thumbnail_video->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $settingContent->thumbnail_video->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $settingContent->url_video ?? '' }}
                            </td>
                            <td>
                                @if($settingContent->video)
                                    <a href="{{ $settingContent->video->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('setting_content_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.setting-contents.show', $settingContent->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('setting_content_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.setting-contents.edit', $settingContent->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('setting_content_delete')
                                    <form action="{{ route('admin.setting-contents.destroy', $settingContent->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('setting_content_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.setting-contents.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-SettingContent:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection