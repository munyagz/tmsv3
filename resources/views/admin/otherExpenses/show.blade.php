@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.otherExpense.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.other-expenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.otherExpense.fields.id') }}
                        </th>
                        <td>
                            {{ $otherExpense->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otherExpense.fields.expense') }}
                        </th>
                        <td>
                            {{ $otherExpense->expense->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otherExpense.fields.amount') }}
                        </th>
                        <td>
                            {{ $otherExpense->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otherExpense.fields.date_spent') }}
                        </th>
                        <td>
                            {{ $otherExpense->date_spent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otherExpense.fields.description') }}
                        </th>
                        <td>
                            {{ $otherExpense->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otherExpense.fields.user') }}
                        </th>
                        <td>
                            {{ $otherExpense->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.other-expenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection