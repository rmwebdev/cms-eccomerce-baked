@extends('layouts.admin')
@section('content')
@can('social_medium_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.social-media.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.socialMedium.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.socialMedium.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SocialMedium">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.socialMedium.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialMedium.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialMedium.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialMedium.fields.facebook') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialMedium.fields.instagram') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialMedium.fields.twitter') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialMedium.fields.tiktok') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialMedium.fields.linkind') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($socialMedia as $key => $socialMedium)
                        <tr data-entry-id="{{ $socialMedium->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $socialMedium->id ?? '' }}
                            </td>
                            <td>
                                {{ $socialMedium->email ?? '' }}
                            </td>
                            <td>
                                {{ $socialMedium->phone ?? '' }}
                            </td>
                            <td>
                                {{ $socialMedium->facebook ?? '' }}
                            </td>
                            <td>
                                {{ $socialMedium->instagram ?? '' }}
                            </td>
                            <td>
                                {{ $socialMedium->twitter ?? '' }}
                            </td>
                            <td>
                                {{ $socialMedium->tiktok ?? '' }}
                            </td>
                            <td>
                                {{ $socialMedium->linkind ?? '' }}
                            </td>
                            <td>
                                @can('social_medium_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.social-media.show', $socialMedium->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('social_medium_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.social-media.edit', $socialMedium->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('social_medium_delete')
                                    <form action="{{ route('admin.social-media.destroy', $socialMedium->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('social_medium_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.social-media.massDestroy') }}",
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
  let table = $('.datatable-SocialMedium:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection