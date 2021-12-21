@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.floatManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.float-managements.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="transaction_type">{{ trans('cruds.floatManagement.fields.transaction_type') }}</label>
                <input class="form-control {{ $errors->has('transaction_type') ? 'is-invalid' : '' }}" type="text" name="transaction_type" id="transaction_type" value="{{ old('transaction_type', '') }}" required>
                @if($errors->has('transaction_type'))
                    <span class="text-danger">{{ $errors->first('transaction_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.floatManagement.fields.transaction_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transactio_ref">{{ trans('cruds.floatManagement.fields.transactio_ref') }}</label>
                <input class="form-control {{ $errors->has('transactio_ref') ? 'is-invalid' : '' }}" type="text" name="transactio_ref" id="transactio_ref" value="{{ old('transactio_ref', '') }}">
                @if($errors->has('transactio_ref'))
                    <span class="text-danger">{{ $errors->first('transactio_ref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.floatManagement.fields.transactio_ref_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.floatManagement.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.floatManagement.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.floatManagement.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.floatManagement.fields.user_helper') }}</span>
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