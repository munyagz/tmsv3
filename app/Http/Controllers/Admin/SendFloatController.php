<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySendFloatRequest;
use App\Http\Requests\StoreSendFloatRequest;
use App\Http\Requests\UpdateSendFloatRequest;
use App\Models\SendFloat;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SendFloatController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('send_float_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SendFloat::with(['sent_to', 'sent_by'])->select(sprintf('%s.*', (new SendFloat())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'send_float_show';
                $editGate = 'send_float_edit';
                $deleteGate = 'send_float_delete';
                $crudRoutePart = 'send-floats';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('transaction_ref', function ($row) {
                return $row->transaction_ref ? $row->transaction_ref : '';
            });
            $table->addColumn('sent_to_name', function ($row) {
                return $row->sent_to ? $row->sent_to->name : '';
            });

            $table->addColumn('sent_by_name', function ($row) {
                return $row->sent_by ? $row->sent_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'sent_to', 'sent_by']);

            return $table->make(true);
        }

        return view('admin.sendFloats.index');
    }

    public function create()
    {
        abort_if(Gate::denies('send_float_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sent_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sent_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sendFloats.create', compact('sent_tos', 'sent_bies'));
    }

    public function store(StoreSendFloatRequest $request)
    {
        $sendFloat = SendFloat::create($request->all());

        return redirect()->route('admin.send-floats.index');
    }

    public function edit(SendFloat $sendFloat)
    {
        abort_if(Gate::denies('send_float_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sent_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sent_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sendFloat->load('sent_to', 'sent_by');

        return view('admin.sendFloats.edit', compact('sent_tos', 'sent_bies', 'sendFloat'));
    }

    public function update(UpdateSendFloatRequest $request, SendFloat $sendFloat)
    {
        $sendFloat->update($request->all());

        return redirect()->route('admin.send-floats.index');
    }

    public function show(SendFloat $sendFloat)
    {
        abort_if(Gate::denies('send_float_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sendFloat->load('sent_to', 'sent_by');

        return view('admin.sendFloats.show', compact('sendFloat'));
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
