@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.fleetData.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.fleet-datas.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="order_number">{{ trans('cruds.fleetData.fields.order_number') }}</label>
                            <input class="form-control" type="text" name="order_number" id="order_number" value="{{ old('order_number', '') }}" required>
                            @if($errors->has('order_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fleetData.fields.order_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="journey_date">{{ trans('cruds.fleetData.fields.journey_date') }}</label>
                            <input class="form-control date" type="text" name="journey_date" id="journey_date" value="{{ old('journey_date') }}" required>
                            @if($errors->has('journey_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('journey_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fleetData.fields.journey_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="vehicle_reg_no">{{ trans('cruds.fleetData.fields.vehicle_reg_no') }}</label>
                            <input class="form-control" type="text" name="vehicle_reg_no" id="vehicle_reg_no" value="{{ old('vehicle_reg_no', '') }}" required>
                            @if($errors->has('vehicle_reg_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vehicle_reg_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fleetData.fields.vehicle_reg_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="destination">{{ trans('cruds.fleetData.fields.destination') }}</label>
                            <input class="form-control" type="text" name="destination" id="destination" value="{{ old('destination', '') }}" required>
                            @if($errors->has('destination'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('destination') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fleetData.fields.destination_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="customer_name">{{ trans('cruds.fleetData.fields.customer_name') }}</label>
                            <input class="form-control" type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', '') }}" required>
                            @if($errors->has('customer_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fleetData.fields.customer_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="invoice_number">{{ trans('cruds.fleetData.fields.invoice_number') }}</label>
                            <input class="form-control" type="text" name="invoice_number" id="invoice_number" value="{{ old('invoice_number', '') }}" required>
                            @if($errors->has('invoice_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoice_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fleetData.fields.invoice_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="quantity">{{ trans('cruds.fleetData.fields.quantity') }}</label>
                            <input class="form-control" type="text" name="quantity" id="quantity" value="{{ old('quantity', '') }}" required>
                            @if($errors->has('quantity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('quantity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fleetData.fields.quantity_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount_paid_out">{{ trans('cruds.fleetData.fields.amount_paid_out') }}</label>
                            <input class="form-control" type="number" name="amount_paid_out" id="amount_paid_out" value="{{ old('amount_paid_out', '') }}" step="0.01" required>
                            @if($errors->has('amount_paid_out'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount_paid_out') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fleetData.fields.amount_paid_out_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <input  type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger mr-10" type="submit">
                                {{ trans('global.save') }}
                            </button>
                            <a class="btn btn-default" href="{{ route('frontend.fleet-datas.index') }}">
                                {{ trans('global.cancel') }}
                            </a>
                        </div>
                        {{--  --}}
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection