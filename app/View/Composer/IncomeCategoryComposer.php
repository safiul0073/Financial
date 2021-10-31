<?php
namespace App\View\Composer;

use App\Models\Category;
use Illuminate\View\View;

class IncomeCategoryComposer {

    public function compose(View $view) {

        $view->with('categorys', Category::all());
    }
}
