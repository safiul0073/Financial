<?php

namespace App\Http\Controllers;

use App\Exports\IncomeExport;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\User;
use App\Models\Invest;
use App\Services\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
class ReportController extends Controller
{

    public function expenseIndex () {

        return view('content.report.expense.index');
    }
    public function incomeIndex () {
        return view('content.report.incame.index');
    }
    public function partnerRepotIndex () {
        return view('content.report.partner.index');
    }


    // expense Report methods....
    public function expenseReport (Request $request) {

        $expenses = null;
        $report = new Report();
        $expenses = $report->exponseReport(
                    $request->start_date,
                    $request->end_date,
                    $request->category);
            return view('content.report.expense.index', compact('expenses'));
    }
       // income Report methods....
       public function incomeReport (Request $request) {
        $incomes = null;
        $report = new Report();
        $incomes = $report->incomeReport(
                    $request->start_date,
                    $request->end_date,
                    $request->category);
            return view('content.report.incame.index', compact('incomes'));
    }
    public function partnerRepot (Request $request, Report $report) {

        $partnerReports = [];
        $invests = [];
        $profit = 0;
        if ($request->partnar_search_id) {

                $partnerReports = $report->partnerIdReport(
                                  $request->partnar_search_id,
                                  );
                $profit = $report->calculateProfit(
                                   floatval(calculatTotalAmount($partnerReports)));
        }else {
                $invests = $report->partnerDateReport(
                            $request->start_date,
                            $request->end_date
                            );
                $profit = $report->calculateProfit(
                                   floatval($invests->sum('amount'))
                                   );
                }

            return view('content.report.partner.index', [
                'partnerReports' => $partnerReports,
                'partnerOfDate' => $invests,
                'profits' => $profit

            ]);
    }

    public function exortIncame (Request $request) {
        return Excel::download(new IncomeExport(
                            $request->start_date,
                            $request->end_date,
                            $request->category
                    ),
                        'myexcel.xlsx');
    }
}
