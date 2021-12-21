<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySendFloatRequest;
use App\Http\Requests\StoreSendFloatRequest;
use App\Http\Requests\UpdateSendFloatRequest;
use App\Http\Requests\SearchReportRequest;
use App\Models\SendFloat;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SendFloatController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('send_float_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sendFloats = SendFloat::with(['sent_to', 'sent_by'])->get();

        return view('frontend.sendFloats.index', compact('sendFloats'));
    }

    public function dataFilter(SearchReportRequest $request)
    {
        $sendFloats = SendFloat::whereBetween('date_sent',[$request['date_from'],$request['date_to']])->get();
          return view('frontend.sendFloats.index',compact('sendFloats'));
    }


    public function create()
    {
        abort_if(Gate::denies('send_float_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sent_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sent_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.sendFloats.create', compact('sent_tos', 'sent_bies'));
    }

    public function store(StoreSendFloatRequest $request)
    {
        $sendFloat = SendFloat::create($request->all());

        return redirect()->route('frontend.send-floats.index');
    }

    public function edit(SendFloat $sendFloat)
    {
        abort_if(Gate::denies('send_float_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sent_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sent_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sendFloat->load('sent_to', 'sent_by');

        return view('frontend.sendFloats.edit', compact('sent_tos', 'sent_bies', 'sendFloat'));
    }

    public function update(UpdateSendFloatRequest $request, SendFloat $sendFloat)
    {
        $sendFloat->update($request->all());

        return redirect()->route('frontend.send-floats.index');
    }

    public function show(SendFloat $sendFloat)
    {
        abort_if(Gate::denies('send_float_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sendFloat->load('sent_to', 'sent_by');

        return view('frontend.sendFloats.show', compact('sendFloat'));
    }

    public function destroy(SendFloat $sendFloat)
    {
        abort_if(Gate::denies('send_float_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sendFloat->delete();

        return back();
    }

    public function massDestroy(MassDestroySendFloatRequest $request)
    {
        SendFloat::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
