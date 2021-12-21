<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFleetDataRequest;
use App\Http\Requests\UpdateFleetDataRequest;
use App\Http\Resources\Admin\FleetDataResource;
use App\Models\FleetData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FleetDataApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fleet_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FleetDataResource(FleetData::with(['user'])->get());
    }

    public function store(StoreFleetDataRequest $request)
    {
        $fleetData = FleetData::create($request->all());

        return (new FleetDataResource($fleetData))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FleetData $fleetData)
    {
        abort_if(Gate::denies('fleet_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FleetDataResource($fleetData->load(['user']));
    }

    public function update(UpdateFleetDataRequest $request, FleetData $fleetData)
    {
        $fleetData->update($request->all());

        return (new FleetDataResource($fleetData))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FleetData $fleetData)
    {
        abort_if(Gate::denies('fleet_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fleetData->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
