<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncameTitle extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function incame_category(){
        return $this->belongsTo(IncomeCategory::class,'incame_category_id',"id");
    }
}
