<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $table = 'products';

    public function Category() {
        return $this->belongsTo(Category::class);   //relasi tabel post ke tabel category. satu postingan memiliki satu kategori
    }

   public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeUniqueData($query)
    {
        return $query->select('status')->distinct();
    }
}
