<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncameTitle extends Model
{
    use HasFactory;
    protected $table='incame_titles';
    protected $fillable = [
        'title',
        'incame_categorie_id'
    ];

    public function income_category(){
        return $this->belongsTo(IncameCategory::class, 'incame_categorie_id', 'id');
    }

}
