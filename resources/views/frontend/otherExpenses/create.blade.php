@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.otherExpense.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.other-expenses.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="expense_id">{{ trans('cruds.otherExpense.fields.expense') }}</label>
                            <select class="form-control select2" name="expense_id" id="expense_id" required>
                                @foreach($expenses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('expense_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('expense'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('expense') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.otherExpense.fields.expense_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.otherExpense.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.otherExpense.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date_spent">{{ trans('cruds.otherExpense.fields.date_spent') }}</label>
                            <input class="form-control date" type="text" name="date_spent" id="date_spent" value="{{ old('date_spent') }}" required>
                            @if($errors->has('date_spent'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_spent') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.otherExpense.fields.date_spent_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.otherExpense.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.otherExpense.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <input  type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                            <a class="btn btn-default" href="{{ route('frontend.other-expenses.index') }}">
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