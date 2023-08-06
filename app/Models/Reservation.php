<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Reservation extends Model
{
    use HasFactory;


    /**
     * The products that belong to the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function books(): MorphToMany
    {
        return $this->morphToMany(Book::class, 'bookable');
    }

    /**
     * Return sum total.
     * 
     * @return int
     */
    public function getTotalAttribute()
    {
        return $this->books->pluck('total')->sum();
    }
}
