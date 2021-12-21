@extends('layouts.admin')
@section('content')
@can('fleet_data_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fleet-datas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.fleetData.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'FleetData', 'route' => 'admin.fleet-datas.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.fleetData.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-FleetData">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.order_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.journey_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.vehicle_reg_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.destination') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.customer_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.invoice_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.amount_paid_in') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.amount_paid_out') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.profit_loss') }}
                    </th>
                    <th>
                        {{ trans('cruds.fleetData.fields.user') }}
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
@can('fleet_data_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fleet-datas.massDestroy') }}",
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
    ajax: "{{ route('admin.fleet-datas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'order_number', name: 'order_number' },
{ data: 'journey_date', name: 'journey_date' },
{ data: 'vehicle_reg_no', name: 'vehicle_reg_no' },
{ data: 'destination', name: 'destination' },
{ data: 'customer_name', name: 'customer_name' },
{ data: 'invoice_number', name: 'invoice_number' },
{ data: 'quantity', name: 'quantity' },
{ data: 'amount_paid_in', name: 'amount_paid_in' },
{ data: 'amount_paid_out', name: 'amount_paid_out' },
{ data: 'profit_loss', name: 'profit_loss' },
{ data: 'user_name', name: 'user.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-FleetData').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection