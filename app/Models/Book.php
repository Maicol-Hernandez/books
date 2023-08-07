<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Scopes\AvailableScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Book
 * 
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $description 
 * @property string $status 
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * 
 * @package \App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

// $seller_id (foreign key referencing User model)
class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $perPage = 10;

    protected $table = 'books';

    protected $with = [
        'images',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'status',
        'category_id'
    ];

    /** 
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * The "booted" method of the model.
     * 
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new AvailableScope);

        static::updated(function (Book $book): void {
            if ($book->status == 'available') {
                $book->status == 'unavailable';

                $book->save();
            }
        });
    }

    /**
     * The Reservations that belong to the Books
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reservations()
    {
        return $this->morphedByMany(Reservation::class, 'bookable')->withPivot(['start_date', 'end_date']);
    }

    /**
     * Get the categories that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The images that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Makes a query where the status is available.
     * 
     * @param mixed $query
     */
    public function scopeAvailable($query)
    {
        $query->where('status', 'available');
    }

    /**
     * Makes a query where the status is unavailable.
     * 
     * @param mixed $query
     */
    public function scopeUnavailable($query)
    {
        $query->where('status', 'unavailable');
    }


    /**
     * Return total, quantity.
     * 
     * @return int
     */
    public function getTotalAttribute()
    {
        return $this->pivot->book_id;
    }
}
