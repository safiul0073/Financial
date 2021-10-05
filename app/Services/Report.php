<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Incame;
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
}
