<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class saving extends Model
{
   protected $table = 'saving';
    protected $fillable = [
         'amount',
         'category_id',
         'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
