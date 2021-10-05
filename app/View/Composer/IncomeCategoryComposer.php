<?php
namespace App\View\Composer;

use App\Models\IncameCategory;
use Illuminate\View\View;

class IncomeCategoryComposer {

    public function compose(View $view) {

        $view->with('incameCategorys', IncameCategory::all());
    }
}
