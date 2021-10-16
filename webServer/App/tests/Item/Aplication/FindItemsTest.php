<?php
namespace App\tests\Item\Aplication;

use App\Item\Aplication\FindItems;

use App\Item\Domain\Item;
use App\Tests\Item\Infrastructure\FakeItemRepo;
use PHPUnit\Framework\TestCase;

class FindItemsTest extends TestCase
{

    public function testSetupCase(): FindItems
    {
        $repoItems = new FakeItemRepo();
        $findItems = new FindItems($repoItems);
        $this->assertInstanceOf(FindItems::class, $findItems);
        return $findItems;
    }

    /**
     * @depends testSetupCase
     * @param FindItems $finder
     */
    public function testShouldReturnAnArrayOfItems(FindItems $finder): void
    {
        $count = $_ENV['DEFAULT_QUERY_LIMIT'];
        $offset = $_ENV['DEFAULT_QUERY_OFFSET'];
        $itemsList = $finder($count, $offset);
        $this->assertIsArray($itemsList);
        foreach ($itemsList as $item)
        {
            $this->assertInstanceOf(Item::class, $item);
        }
    }
}