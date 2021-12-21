@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('send_float_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.send-floats.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.sendFloat.title_singular') }}
                        </a>
                        {{-- <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'SendFloat', 'route' => 'admin.send-floats.parseCsvImport']) --}}
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.sendFloat.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                        {{-- Start Form --}}
                        <form action="{{ route('frontend.send-floats.report') }}" method="POST">
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
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SendFloat">
                            <thead>
                                <tr>
                                    
                                    <th>
                                        {{ trans('cruds.sendFloat.fields.date_sent') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.sendFloat.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.sendFloat.fields.transaction_ref') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.sendFloat.fields.sent_to') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.sendFloat.fields.sent_by') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sendFloats as $key => $sendFloat)
                                    <tr data-entry-id="{{ $sendFloat->id }}">
                                        
                                        <td>
                                            {{ $sendFloat->date_sent ?? '' }}
                                        </td>
                                        <td>
                                            {{ $sendFloat->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $sendFloat->transaction_ref ?? '' }}
                                        </td>
                                        <td>
                                            {{ $sendFloat->sent_to->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $sendFloat->sent_by->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('send_float_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.send-floats.show', $sendFloat->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('send_float_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.send-floats.edit', $sendFloat->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('send_float_delete')
                                                <form action="{{ route('frontend.send-floats.destroy', $sendFloat->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                                </tr>
                                <tr> 
                                    <td>  <strong> Total Float Sent</strong> </td>
                                   
                                    
                                    <td> <strong>
                                        @php
                                        $sum = 0;                          
                                        foreach($sendFloats as $key => $sendFloat){
                                            $sum += $sendFloat->amount;
                                        }
                                        echo number_format($sum, 2);
                     
                                        @endphp
                                    </strong></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
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
@can('send_float_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.send-floats.massDestroy') }}",
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
  let table = $('.datatable-SendFloat:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection