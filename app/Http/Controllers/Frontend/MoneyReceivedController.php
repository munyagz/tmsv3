<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMoneyReceivedRequest;
use App\Http\Requests\StoreMoneyReceivedRequest;
use App\Http\Requests\UpdateMoneyReceivedRequest;
use App\Http\Requests\SearchReportRequest;
use App\Models\MoneyReceived;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MoneyReceivedController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('money_received_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user_id = Auth::user()->id;
        $moneyReceiveds = MoneyReceived::where('user_id', $user_id)->get();
        //$moneyReceiveds = MoneyReceived::with(['user'])->get();
        return view('frontend.moneyReceiveds.index', compact('moneyReceiveds'));
    }

    public function dataFilter(SearchReportRequest $request)
    {
        $user_id = Auth::user()->id;
        $moneyReceiveds = MoneyReceived::where('user_id', $user_id)
                                            ->whereBetween('date_received',[$request['date_from'],$request['date_to']])
                                            ->get();
          return view('frontend.moneyReceiveds.index',compact('moneyReceiveds'));
    }

    public function create()
    {
        abort_if(Gate::denies('money_received_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.moneyReceiveds.create');
    }

    public function store(StoreMoneyReceivedRequest $request)
    {
        $moneyReceived = MoneyReceived::create($request->all());

        return redirect()->route('frontend.money-receiveds.index');
    }

    public function edit(MoneyReceived $moneyReceived)
    {
        abort_if(Gate::denies('money_received_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $moneyReceived->load('user');

        return view('frontend.moneyReceiveds.edit', compact('moneyReceived'));
    }

    public function update(UpdateMoneyReceivedRequest $request, MoneyReceived $moneyReceived)
    {
        $moneyReceived->update($request->all());

        return redirect()->route('frontend.money-receiveds.index');
    }

    public function show(MoneyReceived $moneyReceived)
    {
        abort_if(Gate::denies('money_received_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $moneyReceived->load('user');

        return view('frontend.moneyReceiveds.show', compact('moneyReceived'));
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
