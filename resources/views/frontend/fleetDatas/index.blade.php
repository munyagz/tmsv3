@extends('layouts.frontend')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('fleet_data_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.fleet-datas.create') }}">
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
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                        {{-- Start Form --}}
                        <form action="{{ route('frontend.fleet-datas.report') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="From">Date From</label>
                                        <input class="form-control date" type="text" name="date_from" id="date_from" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="To">Date To</label>
                                        <input class="form-control date" type="text" name="date_to" id="date_to" required>
                                    </div>
                                </div>
                                <div class="col-lg 4">
                                    <input style="margin-top: 30px" type="submit" id="filter" value="Search" class="btn btn-success ml-4">                           
                                </div>
                            </div>
                        </form>
                    {{-- End Form --}}
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-FleetData">
                            <thead>
                                <tr>
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
                                    @can('fleet_data_edit')
                                    <th>
                                        {{ trans('cruds.fleetData.fields.amount_paid_in') }}
                                    </th>
                                    @endcan
                                    <th>
                                        {{ trans('cruds.fleetData.fields.amount_paid_out') }}
                                    </th>
                                    @can('fleet_data_edit')
                                    <th>
                                        {{ trans('cruds.fleetData.fields.profit_loss') }}
                                    </th>
                                    @endcan
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
                                        @can('fleet_data_edit')
                                        <td>
                                            {{ $fleetData->amount_paid_in ?? '' }}
                                        </td>
                                        @endcan
                                        <td>
                                            {{ $fleetData->amount_paid_out ?? '' }}
                                        </td>
                                        @can('fleet_data_edit')
                                        <td>
                                            {{ $fleetData->profit_loss ?? '' }}
                                        </td>
                                        @endcan
                                        <td>
                                            {{ $fleetData->user->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('fleet_data_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.fleet-datas.show', $fleetData->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('fleet_data_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.fleet-datas.edit', $fleetData->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('fleet_data_delete')
                                                <form action="{{ route('frontend.fleet-datas.destroy', $fleetData->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    @can('fleet_data_edit')
                                    <td>&nbsp;</td>
                                    @endcan
                                    @can('fleet_data_edit')
                                    <td>&nbsp;</td>
                                    @endcan
                                </tr>
                                <tr> 
                                    <td>  <strong> Totals</strong> </td>
                                   
                                    
                                    
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    @can('fleet_data_edit')
                                    <td> <strong>
                                        @php
                                        $sum = 0;                          
                                        foreach($fleetDatas as $key => $fleetData){
                                            $sum += $fleetData->amount_paid_in;
                                        }
                                        echo number_format($sum, 2);
                     
                                        @endphp
                                    </strong></td>
                                    @endcan
                                    
                                    <td> <strong>
                                        @php
                                        $sum = 0;                          
                                        foreach($fleetDatas as $key => $fleetData){
                                            $sum += $fleetData->amount_paid_out;
                                        }
                                        echo number_format($sum, 2);
                     
                                        @endphp
                                    </strong></td>
                                    
                                    @can('fleet_data_edit')
                                    <td> <strong>
                                        @php
                                        $sum = 0;                          
                                        foreach($fleetDatas as $key => $fleetData){
                                            $sum += $fleetData->profit_loss;
                                        }
                                        echo number_format($sum, 2);
                     
                                        @endphp
                                    </strong></td>
                                    @endcan
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('fleet_data_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.fleet-datas.massDestroy') }}",
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
  let table = $('.datatable-FleetData:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection