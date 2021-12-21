<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOtherExpenseRequest;
use App\Http\Requests\StoreOtherExpenseRequest;
use App\Http\Requests\UpdateOtherExpenseRequest;
use App\Http\Requests\SearchReportRequest;
use App\Models\ExpenseCategory;
use App\Models\OtherExpense;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtherExpensesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('other_expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otherExpenses = OtherExpense::with(['expense', 'user'])->get();

        return view('frontend.otherExpenses.index', compact('otherExpenses'));
    }

    public function dataFilter(SearchReportRequest $request)
    {
        $otherExpenses = OtherExpense::whereBetween('date_spent',[$request['date_from'],$request['date_to']])->get();
          return view('frontend.otherExpenses.index',compact('otherExpenses'));
    }


    public function create()
    {
        abort_if(Gate::denies('other_expense_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenses = ExpenseCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.otherExpenses.create', compact('expenses', 'users'));
    }

    public function store(StoreOtherExpenseRequest $request)
    {
        $otherExpense = OtherExpense::create($request->all());

        return redirect()->route('frontend.other-expenses.index');
    }

    public function edit(OtherExpense $otherExpense)
    {
        abort_if(Gate::denies('other_expense_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenses = ExpenseCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $otherExpense->load('expense', 'user');

        return view('frontend.otherExpenses.edit', compact('expenses', 'users', 'otherExpense'));
    }

    public function update(UpdateOtherExpenseRequest $request, OtherExpense $otherExpense)
    {
        $otherExpense->update($request->all());

        return redirect()->route('frontend.other-expenses.index');
    }

    public function show(OtherExpense $otherExpense)
    {
        abort_if(Gate::denies('other_expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otherExpense->load('expense', 'user');

        return view('frontend.otherExpenses.show', compact('otherExpense'));
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
