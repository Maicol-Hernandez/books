<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Order
 *
 * @property $id
 * @property $status
 * @property $created_at
 * @property $updated_at
 * 
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Order extends Model
{
    use HasFactory;

    protected $perPage = 10;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'user_id',
    ];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The products that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function books(): MorphToMany
    {
        return $this->morphToMany(Book::class, 'bookable')->withPivot('quantity');
    }

    /**
     * return sum total.
     * 
     * @return int $total
     */
    public function getTotalAttribute()
    {
        return $this->products()
            ->withoutGlobalScope(AvailableScope::class)
            ->get()
            ->pluck('total')
            ->sum();
    }
}
