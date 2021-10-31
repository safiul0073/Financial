<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTitle extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'categorie_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'categorie_id', 'id');
    }
}
