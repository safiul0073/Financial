<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTitle extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'expense_categorie_id'
    ];

    public function expense_category(){
        return $this->belongsTo(ExpenseCategory::class, 'expense_categorie_id', 'id');
    }
}
