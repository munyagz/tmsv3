@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.sendFloat.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.send-floats.update", [$sendFloat->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="date_sent">{{ trans('cruds.sendFloat.fields.date_sent') }}</label>
                            <input class="form-control date" type="text" name="date_sent" id="date_sent" value="{{ old('date_sent', $sendFloat->date_sent) }}" required>
                            @if($errors->has('date_sent'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_sent') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sendFloat.fields.date_sent_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.sendFloat.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $sendFloat->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sendFloat.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="transaction_ref">{{ trans('cruds.sendFloat.fields.transaction_ref') }}</label>
                            <input class="form-control" type="text" name="transaction_ref" id="transaction_ref" value="{{ old('transaction_ref', $sendFloat->transaction_ref) }}" required>
                            @if($errors->has('transaction_ref'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transaction_ref') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sendFloat.fields.transaction_ref_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="sent_to_id">{{ trans('cruds.sendFloat.fields.sent_to') }}</label>
                            <select class="form-control select2" name="sent_to_id" id="sent_to_id" required>
                                @foreach($sent_tos as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('sent_to_id') ? old('sent_to_id') : $sendFloat->sent_to->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('sent_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sent_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sendFloat.fields.sent_to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="sent_by_id">{{ trans('cruds.sendFloat.fields.sent_by') }}</label>
                            <select class="form-control select2" name="sent_by_id" id="sent_by_id" required>
                                @foreach($sent_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('sent_by_id') ? old('sent_by_id') : $sendFloat->sent_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('sent_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sent_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.sendFloat.fields.sent_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection