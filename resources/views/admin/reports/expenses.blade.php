@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Expenses Report
    </div>

    <div class="card-body">
        <form action="{{ route('admin.reports.postexpenses') }}" method="POST">
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
            <table class=" table table-bordered table-striped table-hover datatable datatable-OtherExpense">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                      
                        <th>
                            {{ trans('cruds.otherExpense.fields.expense') }}
                        </th>
                        <th>
                            {{ trans('cruds.otherExpense.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.otherExpense.fields.date_spent') }}
                        </th>
                        <th>
                            {{ trans('cruds.otherExpense.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.otherExpense.fields.user') }}
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($otherExpenses as $key => $otherExpense)
                        <tr data-entry-id="{{ $otherExpense->id }}">
                            <td>&nbsp;</td>
                          
                            <td>
                                {{ $otherExpense->expense->name ?? '' }}
                            </td>
                            <td>
                                {{ $otherExpense->amount ?? '' }}
                            </td>
                            <td>
                                {{ $otherExpense->date_spent ?? '' }}
                            </td>
                            <td>
                                {{ $otherExpense->description ?? '' }}
                            </td>
                            <td>
                                {{ $otherExpense->user->name ?? '' }}
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
                        
                    </tr>
                    <tr> 
                        <td>&nbsp;</td>
                        <td>  <strong> Total Expenses</strong> </td>
                       
                        
                        
                       <td> <strong>
                            @php
                            $sum = 0;                          
                            foreach($otherExpenses as $key => $otherExpense){
                                $sum += $otherExpense->amount;
                            }
                            echo number_format($sum, 2);
         
                            @endphp
                        </strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
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
  let table = $('.datatable-OtherExpense:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>

@endsection