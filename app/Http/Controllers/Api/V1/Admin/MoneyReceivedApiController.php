<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMoneyReceivedRequest;
use App\Http\Requests\UpdateMoneyReceivedRequest;
use App\Http\Resources\Admin\MoneyReceivedResource;
use App\Models\MoneyReceived;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MoneyReceivedApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('money_received_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MoneyReceivedResource(MoneyReceived::with(['user'])->get());
    }

    public function store(StoreMoneyReceivedRequest $request)
    {
        $moneyReceived = MoneyReceived::create($request->all());

        return (new MoneyReceivedResource($moneyReceived))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MoneyReceived $moneyReceived)
    {
        abort_if(Gate::denies('money_received_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MoneyReceivedResource($moneyReceived->load(['user']));
    }

    public function update(UpdateMoneyReceivedRequest $request, MoneyReceived $moneyReceived)
    {
        $moneyReceived->update($request->all());

        return (new MoneyReceivedResource($moneyReceived))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MoneyReceived $moneyReceived)
    {
        abort_if(Gate::denies('money_received_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $moneyReceived->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
