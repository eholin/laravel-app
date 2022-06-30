<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemCategory;

class ItemEditService
{
    /** @var int */
    private $itemId;

    /** @var string|null */
    private $name;

    /** @var float|null */
    private $price;

    /** @var boolean|null */
    private $published;

    /** @var array|null */
    private $categories;

    /**
     * @param array $itemProperties
     */
    public function __construct(array $itemProperties)
    {
        $this->itemId = $itemProperties['id'];
        $this->name = $itemProperties['name'] ?? null;
        $this->price = $itemProperties['price'] ?? null;
        $this->categories = $itemProperties['categories'] ?? null;
        $this->published = $itemProperties['published'] ?? null;
    }

    /**
     * @return Item
     */
    public function edit()
    {
        $item = Item::whereId($this->itemId)->first();

        if ($this->name !== null) {
            $item->name = $this->name;
        }

        if ($this->price !== null) {
            $item->price = $this->price;
        }

        if ($this->published !== null) {
            $item->price = $this->price;
        }

        $item->save();

        $this->editItemCategories();

        return $item;
    }

    /**
     * @return void
     */
    private function editItemCategories()
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

            $itemCategory = ItemCategory::where('category_id', $category->id)
                ->where('item_id', $this->itemId);

            if (!$itemCategory->exists()) {
                $itemCategory = new ItemCategory();
                $itemCategory->category_id = $category->id;
                $itemCategory->item_id = $this->itemId;
                $itemCategory->save();
            }
        }
    }
}
