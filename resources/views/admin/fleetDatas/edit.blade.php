@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.fleetData.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fleet-datas.update", [$fleetData->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="order_number">{{ trans('cruds.fleetData.fields.order_number') }}</label>
                <input class="form-control {{ $errors->has('order_number') ? 'is-invalid' : '' }}" type="text" name="order_number" id="order_number" value="{{ old('order_number', $fleetData->order_number) }}" required>
                @if($errors->has('order_number'))
                    <span class="text-danger">{{ $errors->first('order_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fleetData.fields.order_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="journey_date">{{ trans('cruds.fleetData.fields.journey_date') }}</label>
                <input class="form-control date {{ $errors->has('journey_date') ? 'is-invalid' : '' }}" type="text" name="journey_date" id="journey_date" value="{{ old('journey_date', $fleetData->journey_date) }}" required>
                @if($errors->has('journey_date'))
                    <span class="text-danger">{{ $errors->first('journey_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fleetData.fields.journey_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="vehicle_reg_no">{{ trans('cruds.fleetData.fields.vehicle_reg_no') }}</label>
                <input class="form-control {{ $errors->has('vehicle_reg_no') ? 'is-invalid' : '' }}" type="text" name="vehicle_reg_no" id="vehicle_reg_no" value="{{ old('vehicle_reg_no', $fleetData->vehicle_reg_no) }}" required>
                @if($errors->has('vehicle_reg_no'))
                    <span class="text-danger">{{ $errors->first('vehicle_reg_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fleetData.fields.vehicle_reg_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="destination">{{ trans('cruds.fleetData.fields.destination') }}</label>
                <input class="form-control {{ $errors->has('destination') ? 'is-invalid' : '' }}" type="text" name="destination" id="destination" value="{{ old('destination', $fleetData->destination) }}" required>
                @if($errors->has('destination'))
                    <span class="text-danger">{{ $errors->first('destination') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fleetData.fields.destination_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="customer_name">{{ trans('cruds.fleetData.fields.customer_name') }}</label>
                <input class="form-control {{ $errors->has('customer_name') ? 'is-invalid' : '' }}" type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $fleetData->customer_name) }}" required>
                @if($errors->has('customer_name'))
                    <span class="text-danger">{{ $errors->first('customer_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fleetData.fields.customer_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="invoice_number">{{ trans('cruds.fleetData.fields.invoice_number') }}</label>
                <input class="form-control {{ $errors->has('invoice_number') ? 'is-invalid' : '' }}" type="text" name="invoice_number" id="invoice_number" value="{{ old('invoice_number', $fleetData->invoice_number) }}" required>
                @if($errors->has('invoice_number'))
                    <span class="text-danger">{{ $errors->first('invoice_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fleetData.fields.invoice_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.fleetData.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', $fleetData->quantity) }}" required>
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fleetData.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_paid_in">{{ trans('cruds.fleetData.fields.amount_paid_in') }}</label>
                <input class="form-control {{ $errors->has('amount_paid_in') ? 'is-invalid' : '' }}" type="number" name="amount_paid_in" id="amount_paid_in" value="{{ old('amount_paid_in', $fleetData->amount_paid_in) }}" step="0.01">
                @if($errors->has('amount_paid_in'))
                    <span class="text-danger">{{ $errors->first('amount_paid_in') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fleetData.fields.amount_paid_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount_paid_out">{{ trans('cruds.fleetData.fields.amount_paid_out') }}</label>
                <input class="form-control {{ $errors->has('amount_paid_out') ? 'is-invalid' : '' }}" type="number" name="amount_paid_out" id="amount_paid_out" value="{{ old('amount_paid_out', $fleetData->amount_paid_out) }}" step="0.01" required>
                @if($errors->has('amount_paid_out'))
                    <span class="text-danger">{{ $errors->first('amount_paid_out') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fleetData.fields.amount_paid_out_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection