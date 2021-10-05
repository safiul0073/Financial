<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Services\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function expenseIndex () {

        return view('content.report.expense.index');
    }
    public function incomeIndex () {
        return view('content.report.incame.index');
    }


    // expense Report methods....
    public function expenseReport (Request $request) {
        $expenses = null;
        $report = new Report();
        $expenses = $report->exponseReport(
                    $request->start_date,
                    $request->end_date,
                    $request->category);
            return view('content.report.rxpense.index', compact('expenses'));
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
}
