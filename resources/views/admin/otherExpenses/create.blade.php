@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.otherExpense.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.other-expenses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="expense_id">{{ trans('cruds.otherExpense.fields.expense') }}</label>
                <select class="form-control select2 {{ $errors->has('expense') ? 'is-invalid' : '' }}" name="expense_id" id="expense_id" required>
                    @foreach($expenses as $id => $entry)
                        <option value="{{ $id }}" {{ old('expense_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('expense'))
                    <span class="text-danger">{{ $errors->first('expense') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.otherExpense.fields.expense_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.otherExpense.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.otherExpense.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_spent">{{ trans('cruds.otherExpense.fields.date_spent') }}</label>
                <input class="form-control date {{ $errors->has('date_spent') ? 'is-invalid' : '' }}" type="text" name="date_spent" id="date_spent" value="{{ old('date_spent') }}" required>
                @if($errors->has('date_spent'))
                    <span class="text-danger">{{ $errors->first('date_spent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.otherExpense.fields.date_spent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.otherExpense.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.otherExpense.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.otherExpense.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.otherExpense.fields.user_helper') }}</span>
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