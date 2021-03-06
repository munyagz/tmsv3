@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#user_fleet_datas" role="tab" data-toggle="tab">
                {{ trans('cruds.fleetData.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#sent_to_send_floats" role="tab" data-toggle="tab">
                {{ trans('cruds.sendFloat.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#sent_by_send_floats" role="tab" data-toggle="tab">
                {{ trans('cruds.sendFloat.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_other_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.otherExpense.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_fleet_datas">
            @includeIf('admin.users.relationships.userFleetDatas', ['fleetDatas' => $user->userFleetDatas])
        </div>
        <div class="tab-pane" role="tabpanel" id="sent_to_send_floats">
            @includeIf('admin.users.relationships.sentToSendFloats', ['sendFloats' => $user->sentToSendFloats])
        </div>
        <div class="tab-pane" role="tabpanel" id="sent_by_send_floats">
            @includeIf('admin.users.relationships.sentBySendFloats', ['sendFloats' => $user->sentBySendFloats])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_other_expenses">
            @includeIf('admin.users.relationships.userOtherExpenses', ['otherExpenses' => $user->userOtherExpenses])
        </div>
    </div>
</div>

@endsection