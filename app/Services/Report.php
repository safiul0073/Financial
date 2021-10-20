<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Incame;
use App\Models\Invest;
use App\Models\User;
use Illuminate\View\View;

class Report {


    public function exponseReport($startDate, $endDate, $category) {
        $report = [];

        if ($startDate && $endDate) {
            $report = Expense::whereBetween('expense_date', [$startDate,$endDate])->with('expense_category', 'expense_title')->get();
            return $report;
        }else if ($startDate) {
            $report = Expense::whereDate('expense_date', $startDate)->with('expense_category', 'expense_title')->get();
            return $report;
        }else if ($endDate) {
            $report = Expense::whereDate('expense_date', $endDate)->with('expense_category', 'expense_title')->get();
            return $report;
        }else {
            $report = Expense::where('expense_categorie_id', $category)->with('expense_category', 'expense_title')->get();
            return $report;
        }

    }
    public function incomeReport($startDate, $endDate, $category) {
        $report = [];

        if ($startDate && $endDate) {
            $report = Incame::whereBetween('incame_date', [$startDate,$endDate])->with('income_category', 'income_title')->get();
            return $report;
        }else if ($startDate) {
            $report = Incame::whereDate('incame_date', $startDate)->with('income_category', 'income_title')->get();
            return $report;
        }else if ($endDate) {
            $report = Incame::whereDate('incame_date', $endDate)->with('income_category', 'income_title')->get();
            return $report;
        }else {
            $report = Incame::where('incame_categorie_id', $category)->with('income_category', 'income_title')->get();
            return $report;
        }

    }
    public function partnerIdReport($partnerId) {
        $report = [];

        if ($partnerId == "All") {

            $report = User::where('role', 0)->with('invests')->get();
            return $report;
        }
        $report = User::where('role', 0)->where('id', $partnerId)->with('invests')->get();
        return $report;

    }
    public function partnerDateReport($startDate, $endDate) {
        $report = [];

        if ($startDate && $endDate) {

            $report = Invest::whereBetween('date', [$startDate,$endDate])->with('user')->get();
            return $report;
        }else if ($startDate) {

            $report = Invest::whereDate('date', $startDate)->with('user')->get();
            return $report;
        }else{

            $report = Invest::whereDate('date', $endDate)->with('user')->get();
            return $report;
        }

    }

    public function calculateProfit ($invetAmount) {
        if (!$invetAmount) {
            return 0;
        }

        $incomeAmount = Incame::sum('amount');

        $expensAmount = Expense::sum('amount');

        $totalInvestAmount = Invest::sum('amount');
        $profit = $incomeAmount - $expensAmount;
        $percentOfProfit = $totalInvestAmount / $invetAmount;

        if ($profit > 0) {

           return $profit / $percentOfProfit;
        }
        return $profit;
    }
}
