@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.fleetData.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.fleet-datas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.order_number') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->order_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.journey_date') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->journey_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.vehicle_reg_no') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->vehicle_reg_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.destination') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->destination }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.customer_name') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->customer_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.invoice_number') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->invoice_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.quantity') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->quantity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.amount_paid_in') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->amount_paid_in }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.amount_paid_out') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->amount_paid_out }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.profit_loss') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->profit_loss }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fleetData.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $fleetData->user->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.fleet-datas.index') }}">
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