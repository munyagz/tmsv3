@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.moneyReceived.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.money-receiveds.update", [$moneyReceived->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="date_received">{{ trans('cruds.moneyReceived.fields.date_received') }}</label>
                            <input class="form-control date" type="text" name="date_received" id="date_received" value="{{ old('date_received', $moneyReceived->date_received) }}" required>
                            @if($errors->has('date_received'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_received') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.moneyReceived.fields.date_received_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.moneyReceived.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $moneyReceived->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.moneyReceived.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="transaction_ref">{{ trans('cruds.moneyReceived.fields.transaction_ref') }}</label>
                            <input class="form-control" type="text" name="transaction_ref" id="transaction_ref" value="{{ old('transaction_ref', $moneyReceived->transaction_ref) }}">
                            @if($errors->has('transaction_ref'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transaction_ref') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.moneyReceived.fields.transaction_ref_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                            <a class="btn btn-default" href="{{ route('frontend.money-receiveds.index') }}">
                                {{ trans('global.cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection