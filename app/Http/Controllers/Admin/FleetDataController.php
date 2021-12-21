<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFleetDataRequest;
use App\Http\Requests\StoreFleetDataRequest;
use App\Http\Requests\UpdateFleetDataRequest;
use App\Models\FleetData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FleetDataController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('fleet_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FleetData::with(['user'])->select(sprintf('%s.*', (new FleetData())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fleet_data_show';
                $editGate = 'fleet_data_edit';
                $deleteGate = 'fleet_data_delete';
                $crudRoutePart = 'fleet-datas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('order_number', function ($row) {
                return $row->order_number ? $row->order_number : '';
            });

            $table->editColumn('vehicle_reg_no', function ($row) {
                return $row->vehicle_reg_no ? $row->vehicle_reg_no : '';
            });
            $table->editColumn('destination', function ($row) {
                return $row->destination ? $row->destination : '';
            });
            $table->editColumn('customer_name', function ($row) {
                return $row->customer_name ? $row->customer_name : '';
            });
            $table->editColumn('invoice_number', function ($row) {
                return $row->invoice_number ? $row->invoice_number : '';
            });
            $table->editColumn('amount_paid_out', function ($row) {
                return $row->amount_paid_out ? $row->amount_paid_out : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.fleetDatas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fleet_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fleetDatas.create');
    }

    public function store(StoreFleetDataRequest $request)
    {
        $fleetData = FleetData::create($request->all());

        return redirect()->route('admin.fleet-datas.index');
    }

    public function edit(FleetData $fleetData)
    {
        abort_if(Gate::denies('fleet_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fleetData->load('user');

        return view('admin.fleetDatas.edit', compact('fleetData'));
    }

    public function update(UpdateFleetDataRequest $request, FleetData $fleetData)
    {
        $fleetData->update($request->all());

        return redirect()->route('admin.fleet-datas.index');
    }

    public function show(FleetData $fleetData)
    {
        abort_if(Gate::denies('fleet_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fleetData->load('user');

        return view('admin.fleetDatas.show', compact('fleetData'));
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
