<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncameCategory extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function income_title(){
        return $this->hasMany(IncameTitle::class,'income_title_id',"id");
    }
}
