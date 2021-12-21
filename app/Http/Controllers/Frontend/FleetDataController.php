<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFleetDataRequest;
use App\Http\Requests\StoreFleetDataRequest;
use App\Http\Requests\UpdateFleetDataRequest;
use App\Http\Requests\SearchReportRequest;
use App\Models\FleetData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FleetDataController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('fleet_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fleetDatas = FleetData::with(['user'])->get();

        return view('frontend.fleetDatas.index', compact('fleetDatas'));
    }

    public function dataFilter(SearchReportRequest $request)
    {
        $fleetDatas = FleetData::whereBetween('journey_date',[$request['date_from'],$request['date_to']])->get();
          return view('frontend.fleetDatas.index',compact('fleetDatas'));
    }



    public function create()
    {
        abort_if(Gate::denies('fleet_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.fleetDatas.create');
    }

    public function store(StoreFleetDataRequest $request)
    {
        $request['profit_loss'] = $request['amount_paid_in'] - $request['amount_paid_out'];
        $fleetData = FleetData::create($request->all());
        return redirect()->route('frontend.fleet-datas.index');
    }

    public function edit(FleetData $fleetData)
    {
        abort_if(Gate::denies('fleet_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fleetData->load('user');

        return view('frontend.fleetDatas.edit', compact('fleetData'));
    }

    public function update(UpdateFleetDataRequest $request, FleetData $fleetData)
    {
        $request['profit_loss'] = $request['amount_paid_in'] - $request['amount_paid_out'];
        $fleetData->update($request->all());

        return redirect()->route('frontend.fleet-datas.index');
    }

    public function show(FleetData $fleetData)
    {
        abort_if(Gate::denies('fleet_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fleetData->load('user');

        return view('frontend.fleetDatas.show', compact('fleetData'));
    }

    public function destroy(FleetData $fleetData)
    {
        abort_if(Gate::denies('fleet_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fleetData->delete();

        return back();
    }

    public function massDestroy(MassDestroyFleetDataRequest $request)
    {
        FleetData::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
