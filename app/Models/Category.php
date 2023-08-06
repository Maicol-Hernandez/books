<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;


    /**
     * Get all of the books for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
