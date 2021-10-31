<?php
namespace App\View\Composer;

use App\Models\IncameCategory;
use App\Models\User;
use Illuminate\View\View;

class PartnerComposer {

    public function compose(View $view) {

        $view->with('partners', User::all());
    }
}
