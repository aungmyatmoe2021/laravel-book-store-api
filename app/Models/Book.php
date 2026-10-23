<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title','cover_image_url','description','category_id'])]
class Book extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
