<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function expense_title(){
        return $this->hasMany(ExpenseTitle::class,'expense_title_id',"id");
    }
}
