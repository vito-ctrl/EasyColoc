<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'date',
        'payer_id',
        'colocation_id',
        'category_id',
    ];

    public function maker () {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function colocation () {
        return $this->belongsTo(Colocation::class, 'colocation_id');
    }

    public function category () {
        return $this->belongsTo(Category::class);
    }
}
