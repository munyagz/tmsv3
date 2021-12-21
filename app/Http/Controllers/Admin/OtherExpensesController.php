<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOtherExpenseRequest;
use App\Http\Requests\StoreOtherExpenseRequest;
use App\Http\Requests\UpdateOtherExpenseRequest;
use App\Models\ExpenseCategory;
use App\Models\OtherExpense;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OtherExpensesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('other_expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OtherExpense::with(['expense', 'user'])->select(sprintf('%s.*', (new OtherExpense())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'other_expense_show';
                $editGate = 'other_expense_edit';
                $deleteGate = 'other_expense_delete';
                $crudRoutePart = 'other-expenses';

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
            $table->addColumn('expense_name', function ($row) {
                return $row->expense ? $row->expense->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'expense', 'user']);

            return $table->make(true);
        }

        return view('admin.otherExpenses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('other_expense_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenses = ExpenseCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.otherExpenses.create', compact('expenses', 'users'));
    }

    public function store(StoreOtherExpenseRequest $request)
    {
        $otherExpense = OtherExpense::create($request->all());

        return redirect()->route('admin.other-expenses.index');
    }

    public function edit(OtherExpense $otherExpense)
    {
        abort_if(Gate::denies('other_expense_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenses = ExpenseCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $otherExpense->load('expense', 'user');

        return view('admin.otherExpenses.edit', compact('expenses', 'users', 'otherExpense'));
    }

    public function update(UpdateOtherExpenseRequest $request, OtherExpense $otherExpense)
    {
        $otherExpense->update($request->all());

        return redirect()->route('admin.other-expenses.index');
    }

    public function show(OtherExpense $otherExpense)
    {
        abort_if(Gate::denies('other_expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otherExpense->load('expense', 'user');

        return view('admin.otherExpenses.show', compact('otherExpense'));
    }

    public function destroy(OtherExpense $otherExpense)
    {
        abort_if(Gate::denies('other_expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otherExpense->delete();

        return back();
    }

    public function massDestroy(MassDestroyOtherExpenseRequest $request)
    {
        OtherExpense::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
