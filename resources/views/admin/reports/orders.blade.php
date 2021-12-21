@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       Orders Report
    </div>

    <div class="card-body">
        <form action="{{ route('admin.reports.search') }}" method="POST">
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
  
        <hr>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-FleetData">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
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
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach($fleetDatas as $key => $fleetData)
                        <tr data-entry-id="{{ $fleetData->id }}">
                            <td>&nbsp;</td>
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
                                {{ $fleetData->amount_paid_in ?? '' }}
                            </td>
                            <td>
                                {{ $fleetData->amount_paid_out ?? '' }}
                            </td>
                            <td>
                                {{ $fleetData->amount_paid_in - $fleetData->amount_paid_out }}
                            </td>
                            <td>
                                {{ $fleetData->user->name ?? '' }}
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
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        
                    </tr>
                    <tr> 
                        <td>&nbsp;</td>
                        <td>  <strong> Totals </strong> </td>
                       
                        
                        
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td> <strong>
                            @php
                            $sum = 0;                          
                            foreach($fleetDatas as $key => $fleetData){
                                $sum += $fleetData->amount_paid_in;
                            }
                            echo number_format($sum, 2);
         
                            @endphp
                        </strong></td>
                        <td> <strong>
                            @php
                            $sum = 0;                          
                            foreach($fleetDatas as $key => $fleetData){
                                $sum += $fleetData->amount_paid_out;
                            }
                            echo number_format($sum, 2);
         
                            @endphp
                        </strong></td>
                        <td> <strong>
                            @php
                            $sum = 0;                          
                            foreach($fleetDatas as $key => $fleetData){
                                $sum += ($fleetData->amount_paid_in - $fleetData->amount_paid_out);
                            }
                            echo number_format($sum, 2);
         
                            @endphp
                        </strong></td>
                        <td>&nbsp;</td>
                        
                        
                    </tr>
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





// function load_data(from_date = '', to_date = '')
//     {
//         $('.datatable-FleetData').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: {
//             url:"{{ route('admin.reports.search') }}",
//             data:{date_from:from_date, date_to:to_date}
//         },
//         columns:[
//                 { data: 'placeholder', name: 'placeholder' },
//                 { data: 'order_number', name: 'order_number' },
//                 { data: 'journey_date', name: 'journey_date' },
//                 { data: 'vehicle_reg_no', name: 'vehicle_reg_no' },
//                 { data: 'destination', name: 'destination' },
//                 { data: 'customer_name', name: 'customer_name' },
//                 { data: 'invoice_number', name: 'invoice_number' },
//                 { data: 'amount_paid_in', name: 'amount_paid_in' },
//                 { data: 'amount_paid_out', name: 'amount_paid_out' },
//                 { data: 'profit_loss', name: 'profit_loss' },
//                 { data: 'user_name', name: 'user.name' }
//             ],
//             orderCellsTop: true,
//             order: [[ 1, 'desc' ]],
//             pageLength: 10,
//         });

//     }


//   $('#filter').click(function(e){
//       e.preventDefault();
//   var from_date = $('#date_from').val();
//   var to_date = $('#date_to').val();
//   if(from_date != '' &&  to_date != '')
//   {
//    $('.datatable-FleetData').DataTable().destroy();
//    load_data(from_date, to_date);
//   }
//   else
//   {
//    alert('Both dates are required!');
//   }
//  });

// });


</script>

@endsection