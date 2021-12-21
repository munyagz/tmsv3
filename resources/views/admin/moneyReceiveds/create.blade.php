@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.moneyReceived.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.money-receiveds.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date_received">{{ trans('cruds.moneyReceived.fields.date_received') }}</label>
                <input class="form-control date {{ $errors->has('date_received') ? 'is-invalid' : '' }}" type="text" name="date_received" id="date_received" value="{{ old('date_received') }}" required>
                @if($errors->has('date_received'))
                    <span class="text-danger">{{ $errors->first('date_received') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.moneyReceived.fields.date_received_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.moneyReceived.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.moneyReceived.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transaction_ref">{{ trans('cruds.moneyReceived.fields.transaction_ref') }}</label>
                <input class="form-control {{ $errors->has('transaction_ref') ? 'is-invalid' : '' }}" type="text" name="transaction_ref" id="transaction_ref" value="{{ old('transaction_ref', '') }}">
                @if($errors->has('transaction_ref'))
                    <span class="text-danger">{{ $errors->first('transaction_ref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.moneyReceived.fields.transaction_ref_helper') }}</span>
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