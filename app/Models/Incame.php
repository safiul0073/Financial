<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incame extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function income_category(){
        return $this->belongsTo(IncameCategory::class, 'incame_categorie_id', 'id');
    }

    public function income_title(){
        return $this->belongsTo(IncameTitle::class, 'incame_title_id', 'id');
    }
}
