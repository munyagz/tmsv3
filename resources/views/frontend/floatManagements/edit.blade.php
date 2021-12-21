@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.floatManagement.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.float-managements.update", [$floatManagement->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="transaction_type">{{ trans('cruds.floatManagement.fields.transaction_type') }}</label>
                            <input class="form-control" type="text" name="transaction_type" id="transaction_type" value="{{ old('transaction_type', $floatManagement->transaction_type) }}" required>
                            @if($errors->has('transaction_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transaction_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.floatManagement.fields.transaction_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="transactio_ref">{{ trans('cruds.floatManagement.fields.transactio_ref') }}</label>
                            <input class="form-control" type="text" name="transactio_ref" id="transactio_ref" value="{{ old('transactio_ref', $floatManagement->transactio_ref) }}">
                            @if($errors->has('transactio_ref'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transactio_ref') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.floatManagement.fields.transactio_ref_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.floatManagement.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $floatManagement->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.floatManagement.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.floatManagement.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $floatManagement->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection