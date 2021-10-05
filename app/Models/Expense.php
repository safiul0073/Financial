<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expense_category(){
        return $this->belongsTo(ExpenseCategory::class, 'expense_categorie_id', 'id');
    }

    public function expense_title(){
        return $this->belongsTo(ExpenseTitle::class, 'expense_title_id', 'id');
    }
}
