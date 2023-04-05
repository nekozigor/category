<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class CategoryLang extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function parentCategory()
    {
        // return $this->belongTo()
    }

    public function parentCategoryLang()
    {
        return $this->hasOneThrough(
            self::class,
            Category::class,
            'id',
            'category_id',
            'category_id',
            'parent_id'
        )->where('lang_id', $this->lang_id);
    }
}
