<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemCategory;

class ItemCreateService
{
    /** @var string */
    private $name;

    /** @var float */
    private $price;

    /** @var array|null */
    private $categories;

    /**
     * @param array $itemProperties
     */
    public function __construct(array $itemProperties)
    {
        $this->name = $itemProperties['name'];
        $this->price = $itemProperties['price'];
        $this->categories = $itemProperties['categories'] ?? null;
    }

    /**
     * @return Item
     */
    public function create(): Item
    {
        $item = new Item();
        $item->name = $this->name;
        $item->price = $this->price;
        $item->save();

        $this->addItemCategories($item->id);

        return $item;
    }

    /**
     * @param int $itemId
     * @return void
     */
    private function addItemCategories(int $itemId)
    {
        if ($this->categories === null) {
            return;
        }

        if (!count($this->categories)) {
            return;
        }

        foreach ($this->categories as $categoryName) {
            $category = Category::firstOrCreate(
                [
                    'name' => trim($categoryName)
                ]
            );

            $itemCategory = new ItemCategory();
            $itemCategory->category_id = $category->id;
            $itemCategory->item_id = $itemId;
            $itemCategory->save();
        }
    }
}
