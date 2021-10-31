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
            $report = Expense::whereBetween('expense_date', [$startDate,$endDate])->with('category', 'expense_title')->get();
            return $report;
        }else if ($startDate) {
            $report = Expense::whereDate('expense_date', $startDate)->with('category', 'expense_title')->get();
            return $report;
        }else if ($endDate) {
            $report = Expense::whereDate('expense_date', $endDate)->with('category', 'expense_title')->get();
            return $report;
        }else {
            $report = Expense::where('categorie_id', $category)->with('category', 'expense_title')->get();
            return $report;
        }

    }
    public function incomeReport($startDate, $endDate, $category) {
        $report = [];

        if ($startDate && $endDate) {
            $report = Incame::whereBetween('incame_date', [$startDate,$endDate])->with('category', 'income_title')->get();
            return $report;
        }else if ($startDate) {
            $report = Incame::whereDate('incame_date', $startDate)->with('category', 'income_title')->get();
            return $report;
        }else if ($endDate) {
            $report = Incame::whereDate('incame_date', $endDate)->with('category', 'income_title')->get();
            return $report;
        }else {
            $report = Incame::where('categorie_id', $category)->with('category', 'income_title')->get();
            return $report;
        }

    }
    public function partnerIdReport($partnerId) {
        $report = [];

        if ($partnerId == "All") {

            $report = User::with('invests')->get();
            return $report;
        }
        $report = User::where('id', $partnerId)->with('invests')->get();
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
