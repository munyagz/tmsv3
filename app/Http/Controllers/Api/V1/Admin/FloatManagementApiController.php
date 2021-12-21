<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFloatManagementRequest;
use App\Http\Requests\UpdateFloatManagementRequest;
use App\Http\Resources\Admin\FloatManagementResource;
use App\Models\FloatManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FloatManagementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('float_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FloatManagementResource(FloatManagement::with(['user'])->get());
    }

    public function store(StoreFloatManagementRequest $request)
    {
        $floatManagement = FloatManagement::create($request->all());

        return (new FloatManagementResource($floatManagement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FloatManagement $floatManagement)
    {
        abort_if(Gate::denies('float_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FloatManagementResource($floatManagement->load(['user']));
    }

    public function update(UpdateFloatManagementRequest $request, FloatManagement $floatManagement)
    {
        $floatManagement->update($request->all());

        return (new FloatManagementResource($floatManagement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FloatManagement $floatManagement)
    {
        abort_if(Gate::denies('float_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $floatManagement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
