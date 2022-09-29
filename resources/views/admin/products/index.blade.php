@extends('layouts.admin')
@section('content')
@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header bg-primary text-white justify-content-between">
        <span class=""> <icon class="fa fa-list text-md"></icon>  Products lists</span>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Product">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.product.fields.id') }}
                    </th>

                    <th>
                        {{ trans('cruds.product.fields.thumb') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.short_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.user_create') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.user_update') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.price_new') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.expired_date') }}
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
@can('product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
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
    scrollX: true,
    aaSorting: [],
    ajax: "{{ route('admin.products.index') }}",
    columns: [
        { data: 'id', name: 'id', width: '1%',sortable: false, searchable: false, className: 'text-center' },
        { data: 'thumb', name: 'thumb', sortable: false, searchable: false },
        { data: 'name', name: 'name', width: '10%',sortable: false, searchable: false, className: 'text-left' },
        { data: 'price', name: 'price', width: '8%',sortable: false, searchable: false, className: 'text-left' },
        { data: 'category', name: 'categories.name', width: '10%',sortable: false, searchable: false, className: 'text-left' },
        { data: 'short_description', name: 'short_description', width: '15%',sortable: false, searchable: false, className: 'text-left' },
        { data: 'user_create_name', name: 'user_create.name', width: '6%',sortable: false, searchable: false, className: 'text-left' },
        { data: 'user_update_name', name: 'user_update.name', width: '6%',sortable: false, searchable: false, className: 'text-left' },
        { data: 'price_new', name: 'price_new', width: '6%',sortable: false, searchable: false, className: 'text-left' },
        { data: 'discount', name: 'discount', width: '',sortable: false, searchable: false, className: 'text-center' },
        { data: 'expired_date', name: 'expired_date', width: '8%',sortable: false, searchable: false, className: 'text-left' },
        { data: 'actions', name: '{{ trans('global.actions') }}', width: '15%',sortable: false, searchable: false, className: 'text-left' }
    ],
    orderCellsTop: true,
    pageLength: 100,
  };
  let table = $('.datatable-Product').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection