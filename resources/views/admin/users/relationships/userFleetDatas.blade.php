<div class="m-3">
    @can('fleet_data_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.fleet-datas.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.fleetData.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.fleetData.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userFleetDatas">
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
                                {{ trans('cruds.fleetData.fields.amount_paid_out') }}
                            </th>
                            <th>
                                {{ trans('cruds.fleetData.fields.user') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fleetDatas as $key => $fleetData)
                            <tr data-entry-id="{{ $fleetData->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $fleetData->order_number ?? '' }}
                                </td>
                                <td>
                                    {{ $fleetData->journey_date ?? '' }}
                                </td>
                                <td>
                                    {{ $fleetData->vehicle_reg_no ?? '' }}
                                </td>
                                <td>
                                    {{ $fleetData->destination ?? '' }}
                                </td>
                                <td>
                                    {{ $fleetData->customer_name ?? '' }}
                                </td>
                                <td>
                                    {{ $fleetData->invoice_number ?? '' }}
                                </td>
                                <td>
                                    {{ $fleetData->quantity ?? '' }}
                                </td>
                                <td>
                                    {{ $fleetData->amount_paid_out ?? '' }}
                                </td>
                                <td>
                                    {{ $fleetData->user->name ?? '' }}
                                </td>
                                <td>
                                    @can('fleet_data_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.fleet-datas.show', $fleetData->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('fleet_data_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.fleet-datas.edit', $fleetData->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('fleet_data_delete')
                                        <form action="{{ route('admin.fleet-datas.destroy', $fleetData->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('fleet_data_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fleet-datas.massDestroy') }}",
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
  let table = $('.datatable-userFleetDatas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection