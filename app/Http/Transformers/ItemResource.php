<?php

namespace App\Http\Transformers;

use App\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Item
 */
class ItemResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'published' => $this->published,
            'categories' => $this->categories()->pluck('categories.title')->toArray(),
        ];
    }
}
