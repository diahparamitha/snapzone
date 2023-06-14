<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $table = 'categories';

    public function product()
    {
        return $this->hasMany(Product::class);    //satu kategori memiliki banyak postingan
    }

      public function user()
    {
        return $this->belongsTo(User::class);
    }

       public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}
