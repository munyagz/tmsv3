@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.moneyReceived.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.money-receiveds.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.moneyReceived.fields.date_received') }}
                                    </th>
                                    <td>
                                        {{ $moneyReceived->date_received }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.moneyReceived.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $moneyReceived->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.moneyReceived.fields.transaction_ref') }}
                                    </th>
                                    <td>
                                        {{ $moneyReceived->transaction_ref }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.moneyReceived.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $moneyReceived->user->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.money-receiveds.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection