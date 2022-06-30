<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ItemCategory
 * @property int $id
 * @property int $category_id
 * @property int $item_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ItemCategory whereCategoryId($value)
 */
class ItemCategory extends Model
{
    use HasFactory;
}
