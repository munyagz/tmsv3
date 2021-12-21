<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMoneyReceivedRequest;
use App\Http\Requests\StoreMoneyReceivedRequest;
use App\Http\Requests\UpdateMoneyReceivedRequest;
use App\Models\MoneyReceived;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MoneyReceivedController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('money_received_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MoneyReceived::with(['user'])->select(sprintf('%s.*', (new MoneyReceived())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'money_received_show';
                $editGate = 'money_received_edit';
                $deleteGate = 'money_received_delete';
                $crudRoutePart = 'money-receiveds';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('transaction_ref', function ($row) {
                return $row->transaction_ref ? $row->transaction_ref : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.moneyReceiveds.index');
    }

    public function create()
    {
        abort_if(Gate::denies('money_received_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.moneyReceiveds.create');
    }

    public function store(StoreMoneyReceivedRequest $request)
    {
        $moneyReceived = MoneyReceived::create($request->all());

        return redirect()->route('admin.money-receiveds.index');
    }

    public function edit(MoneyReceived $moneyReceived)
    {
        abort_if(Gate::denies('money_received_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $moneyReceived->load('user');

        return view('admin.moneyReceiveds.edit', compact('moneyReceived'));
    }

    public function update(UpdateMoneyReceivedRequest $request, MoneyReceived $moneyReceived)
    {
        $moneyReceived->update($request->all());

        return redirect()->route('admin.money-receiveds.index');
    }

    public function show(MoneyReceived $moneyReceived)
    {
        abort_if(Gate::denies('money_received_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $moneyReceived->load('user');

        return view('admin.moneyReceiveds.show', compact('moneyReceived'));
    }

    public function destroy(MoneyReceived $moneyReceived)
    {
        abort_if(Gate::denies('money_received_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $moneyReceived->delete();

        return back();
    }

    public function massDestroy(MassDestroyMoneyReceivedRequest $request)
    {
        MoneyReceived::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
