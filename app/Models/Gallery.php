<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'icon', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/galleries/' . $this->image);
        }
        return null;
    }
}
