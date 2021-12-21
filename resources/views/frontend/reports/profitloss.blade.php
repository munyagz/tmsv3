@extends('layouts.frontend')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Profit/loss report
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                        <form action="{{ route('frontend.reports.postprofitloss') }}" method="POST">
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
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-profitLoss">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>
                                    Date
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        Amount Paid In
                                    </th>
                                    <th>
                                        Amount Paid Out
                                    </th>
                                    <th>
                                        Margin
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Profitlosses as $key => $profitLoss)
                                    <tr data-entry-id="Pl3456">
                                        <td>&nbsp;</td>
                                        <td>
                                            {{ $profitLoss->Date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $profitLoss->Description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $profitLoss->Type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $profitLoss->amount_paid_in ?? '' }}
                                        </td>
                                        <td>
                                            {{ $profitLoss->amount_paid_out ?? '' }}

                                        </td>
                                        <td>
                                            {{ $profitLoss->Margin ?? '' }}

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
                                </tr>
                                <tr> 
                                    <td>&nbsp;</td>
                                    <td>  <strong> Totals </strong> </td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    
                                    <td> <strong>
                                        @php
                                        $sum = 0;                          
                                        foreach($Profitlosses as $key => $profitLoss){
                                            $sum += $profitLoss->amount_paid_in;
                                        }
                                        echo number_format($sum, 2);
                    
                                        @endphp
                                    </strong></td>
                                    <td> <strong>
                                        @php
                                        $sum = 0;                          
                                        foreach($Profitlosses as $key => $profitLoss){
                                            $sum += $profitLoss->amount_paid_out;
                                        }
                                        echo number_format($sum, 2);
                    
                                        @endphp
                                    </strong></td>
                                    <td> <strong>
                                        @php
                                        $sum = 0;                          
                                        foreach($Profitlosses as $key => $profitLoss){
                                            $sum += $profitLoss->Margin;
                                        }
                                        echo number_format($sum, 2);
                    
                                        @endphp
                                    </strong></td>
                                
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-profitLoss:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>

@endsection