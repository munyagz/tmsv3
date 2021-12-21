<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\SearchReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\FleetData;
use App\Models\OtherExpense;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ReportsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reports.index');
    }

    public function floatReport()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       // $floats = DB::select (DB::raw('SELECT u.name as user,f.running_balance FROM users u INNER JOIN float_managements f ON u.id = f.user_id WHERE NOT EXISTS ( SELECT * FROM float_managements AS witness WHERE witness.`created_at` > f.`created_at` AND witness.`user_id` = f.`user_id` )'));
            $floats = DB::table('float_summary_report')->get();       

        return view('admin.reports.floats', compact('floats'));
    }
    public function ordersReport()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $fleetDatas = FleetData::with(['user'])->get();
        return view('admin.reports.orders',compact('fleetDatas'));
    }

    public function ordersReportSearch(SearchReportRequest $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $fleetDatas = FleetData::whereBetween('journey_date',[$request['date_from'],$request['date_to']])->get();
          return view('admin.reports.orders',compact('fleetDatas'));
        
    }
    public function expensesReport()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $otherExpenses = OtherExpense::with('user')->get();
        return view('admin.reports.expenses', compact('otherExpenses'));
    }

    public function expensesReportSearch(SearchReportRequest $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $otherExpenses = OtherExpense::whereBetween('date_spent',[$request['date_from'],$request['date_to']])->get();
          return view('admin.reports.expenses',compact('otherExpenses'));
        
    }
    public function profitlossReport()
    {

        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        
            $Profitlosses = DB::table('profit_loss_report')->get();   
            return view('admin.reports.profitloss', compact('Profitlosses'));
                
    }
    public function profitLossReportSearch(SearchReportRequest $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $Profitlosses = DB::table('profit_loss_report')
                                        ->whereDate('Date', '>=',$request['date_from'])
                                        ->whereDate('Date', '<=', $request['date_to'])                                        
                                        ->get();   
            return view('admin.reports.profitloss', compact('Profitlosses'));
        
    }

    public function create()
    {
        abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reports.create');
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reports.edit', compact('report'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        Report::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
