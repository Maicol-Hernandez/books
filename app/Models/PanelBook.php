<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PanelBook extends Book
{
    use HasFactory;


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // static::addGlobalScope(new AvailableScope);
    }


    /**
     * return foreignkey
     * 
     * @return string
     */
    public function getForeignKey()
    {
        $parent = get_parent_class($this);

        return (new $parent)->getForeignKey();
    }

    /**
     * return Morph class
     * 
     * @return string
     */
    public function getMorphClass()
    {
        $parent = get_parent_class($this);

        return (new $parent)->getMorphClass();
    }
}
