<?php

namespace App\tests\Item\Domain;

use App\Item\Domain\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testSetupCase(): Item
    {
        $item = new Item('123ashdgj-asdas', 'link/otr', 'title');
        $this->assertInstanceOf(Item::class, $item);
        return $item;
    }

    /**
     * @depends testSetupCase
     * @param Item $item
     * @return void
     */
    public function testShouldReturnItemLikeArray(Item $item): void
    {
        $itemArray = $item->getItemAsArray();
        $this->assertIsArray($itemArray);
    }


}
