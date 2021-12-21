<?php

namespace App\Http\Controllers\Frontend;

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

public function profitlossReport()
    {

        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        
            $Profitlosses = DB::table('profit_loss_report')->get();   
            return view('frontend.reports.profitloss', compact('Profitlosses'));
                
    }
    public function profitLossReportSearch(SearchReportRequest $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $Profitlosses = DB::table('profit_loss_report')
                                        ->whereDate('Date', '>=',$request['date_from'])
                                        ->whereDate('Date', '<=', $request['date_to'])                                        
                                        ->get();   
            return view('frontend.reports.profitloss', compact('Profitlosses'));
        
    }

    public function floatReport()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $floats = DB::table('float_summary_report')->get();       

        return view('frontend.reports.floats', compact('floats'));
    }
}