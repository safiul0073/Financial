<?php
namespace App\View\Composer;

use App\Models\Category;
use App\Models\ExpenseCategory;
use Illuminate\View\View;

class ExpenseCategoryComposer {

    public function compose(View $view) {

        $view->with('expenseCategorys', ExpenseCategory::all());
    }
}
