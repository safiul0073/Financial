<?php
namespace App\Services;

use App\Models\Expense;
use App\Models\Incame;
use App\Models\Invest;
use App\Models\User;
use Illuminate\View\View;

class Calculation {

    public function TotalInvestAmount() {
        $amount = Invest::sum('amount');
        return $amount;
    }
    public function TotalPartners() {
        $partner = User::count('id');
        return $partner;
    }
    public function TotalIncomeAmount() {
        $incame = Incame::sum('amount');
        return $incame;
    }
    public function TotalExpensAmount() {
        $expense = Expense::sum('amount');
        return $expense;
    }
}
