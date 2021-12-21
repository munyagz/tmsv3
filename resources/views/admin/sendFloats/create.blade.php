@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sendFloat.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.send-floats.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date_sent">{{ trans('cruds.sendFloat.fields.date_sent') }}</label>
                <input class="form-control date {{ $errors->has('date_sent') ? 'is-invalid' : '' }}" type="text" name="date_sent" id="date_sent" value="{{ old('date_sent') }}" required>
                @if($errors->has('date_sent'))
                    <span class="text-danger">{{ $errors->first('date_sent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sendFloat.fields.date_sent_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.sendFloat.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sendFloat.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transaction_ref">{{ trans('cruds.sendFloat.fields.transaction_ref') }}</label>
                <input class="form-control {{ $errors->has('transaction_ref') ? 'is-invalid' : '' }}" type="text" name="transaction_ref" id="transaction_ref" value="{{ old('transaction_ref', '') }}" required>
                @if($errors->has('transaction_ref'))
                    <span class="text-danger">{{ $errors->first('transaction_ref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sendFloat.fields.transaction_ref_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sent_to_id">{{ trans('cruds.sendFloat.fields.sent_to') }}</label>
                <select class="form-control select2 {{ $errors->has('sent_to') ? 'is-invalid' : '' }}" name="sent_to_id" id="sent_to_id" required>
                    @foreach($sent_tos as $id => $entry)
                        <option value="{{ $id }}" {{ old('sent_to_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sent_to'))
                    <span class="text-danger">{{ $errors->first('sent_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sendFloat.fields.sent_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sent_by_id">{{ trans('cruds.sendFloat.fields.sent_by') }}</label>
                <select class="form-control select2 {{ $errors->has('sent_by') ? 'is-invalid' : '' }}" name="sent_by_id" id="sent_by_id" required>
                    @foreach($sent_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('sent_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sent_by'))
                    <span class="text-danger">{{ $errors->first('sent_by') }}</span>
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



@endsection