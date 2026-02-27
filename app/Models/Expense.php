<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'payer_id',
        'colocation_id',
        'category_id',
    ];

    public function maker () {
        return $this->belongsTo(Categorie::class, 'payer_id');
    }

    public function colocation () {
        retrun $this->belongsTo(colocation::class, 'colocation_id');
    }
}
