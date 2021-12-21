@extends('layouts.frontend')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Float Report
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-floatReport">
                            <thead>
                                <tr>
                                    <th>
                                    User
                                    </th>
                                    <th>
                                        Role
                                    </th>
                                    <th>
                                        Float Balance
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($floats as $key => $float)
                                    <tr data-entry-id="test1">
                                        <td>
                                            {{ $float->user ?? '' }}
                                        </td>
                                        <td>
                                            {{ $float->Role ?? '' }}
                                        </td>
                                        <td>
                                            {{ $float->running_balance ?? '' }}
                                        </td>
                                
                                    </tr>
                                
                                @endforeach
                                <tr> 
                                    <td>  <strong> Total Float Balance</strong> </td>
                                    <td>&nbsp;</td>
                                    <td> <strong>
                                        @php
                                        $sum = 0;                          
                                        foreach($floats as $key => $float){
                                            $sum += $float->running_balance;
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
let table = $('.datatable-floatReport:not(.ajaxTable)').DataTable({ buttons: dtButtons })
$('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
  $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust();
});

})

</script>



@endsection