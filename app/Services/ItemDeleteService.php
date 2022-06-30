<?php

namespace App\Services;

use App\Models\Item;

class ItemDeleteService
{
    /** @var int */
    private $itemId;

    public function __construct(int $itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return void
     */
    public function delete()
    {
        $item = Item::whereId($this->itemId)->first();
        $item->delete();
    }
}
