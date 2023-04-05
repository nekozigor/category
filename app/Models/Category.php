<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryLang;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function langs()
    {
        return $this->hasMany(CategoryLang::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }
}
