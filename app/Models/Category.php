<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    use HasFactory;

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The products that belong to the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function books(): MorphToMany
    {
        return $this->morphToMany(PanelBook::class, 'bookable');
    }
}
