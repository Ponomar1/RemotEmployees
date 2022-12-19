<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Lots extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->hasOne(Categories::class);
    }
    
}
