<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property int $published
 * @property string|null $name
 * @property numeric|null $price
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Item whereId($value)
 */
class Item extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var mixed
     */
    protected $dates = ['deleted_at'];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'item_categories', 'item_id', 'category_id');
    }

    /**
     * @param Builder $query
     * @param $price
     * @return Builder
     */
    public function scopePriceBetween(Builder $query, ...$price): Builder
    {
        return $query->whereBetween('price', $price);
    }
}
