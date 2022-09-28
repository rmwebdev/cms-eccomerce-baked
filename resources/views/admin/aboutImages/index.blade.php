@extends('layouts.admin')
@section('content')
@can('about_image_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.about-images.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.aboutImage.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.aboutImage.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AboutImage">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.aboutImage.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.aboutImage.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.aboutImage.fields.sub_tittle') }}
                    </th>
                    <th>
                        {{ trans('cruds.aboutImage.fields.img_one') }}
                    </th>
                    <th>
                        {{ trans('cruds.aboutImage.fields.img_two') }}
                    </th>
                    <th>
                        {{ trans('cruds.aboutImage.fields.img_tree') }}
                    </th>
                    <th>
                        {{ trans('cruds.aboutImage.fields.img_four') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('about_image_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.about-images.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.about-images.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'sub_tittle', name: 'sub_tittle' },
{ data: 'img_one', name: 'img_one', sortable: false, searchable: false },
{ data: 'img_two', name: 'img_two', sortable: false, searchable: false },
{ data: 'img_tree', name: 'img_tree', sortable: false, searchable: false },
{ data: 'img_four', name: 'img_four', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AboutImage').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection