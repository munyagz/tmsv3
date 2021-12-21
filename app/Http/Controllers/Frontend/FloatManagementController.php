<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFloatManagementRequest;
use App\Http\Requests\StoreFloatManagementRequest;
use App\Http\Requests\UpdateFloatManagementRequest;
use App\Models\FloatManagement;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FloatManagementController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('float_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $floatManagements = FloatManagement::with(['user'])->get();

        return view('frontend.floatManagements.index', compact('floatManagements'));
    }

    public function create()
    {
        abort_if(Gate::denies('float_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.floatManagements.create', compact('users'));
    }

    public function store(StoreFloatManagementRequest $request)
    {
        $floatManagement = FloatManagement::create($request->all());

        return redirect()->route('frontend.float-managements.index');
    }

    public function edit(FloatManagement $floatManagement)
    {
        abort_if(Gate::denies('float_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $floatManagement->load('user');

        return view('frontend.floatManagements.edit', compact('users', 'floatManagement'));
    }

    public function update(UpdateFloatManagementRequest $request, FloatManagement $floatManagement)
    {
        $floatManagement->update($request->all());

        return redirect()->route('frontend.float-managements.index');
    }

    public function show(FloatManagement $floatManagement)
    {
        abort_if(Gate::denies('float_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $floatManagement->load('user');

        return view('frontend.floatManagements.show', compact('floatManagement'));
    }

    public function destroy(FloatManagement $floatManagement)
    {
        abort_if(Gate::denies('float_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $floatManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyFloatManagementRequest $request)
    {
        FloatManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
