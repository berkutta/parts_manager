<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Component;
use App\Storage;

class ComponentTest extends TestCase
{
    /**
     * Test Stock update to value
     *
     * @return void
     */
    public function testStockSet()
    {
        // Given I have a component in the database
        $storage = new Storage;
        $storage->name = 'teststorage';
        $storage->save();

        $component = new Component;
        $component->name = 'testcomponent';
        $component->category = 'testcategory';
        $component->stock = '42';
        $component->stock_flag = false;
        $storage->components()->save($component);


        // When I update the stock
        $component->updateStock(50);

        // Then the stock should be updated
        $this->assertEquals(50, $component->stock);

        // Cleanup
        $storage->components()->delete();
        $storage->delete();
    }

    /**
     * Test Stock increase update
     *
     * @return void
     */
    public function testStockIncrease()
    {
        // Given I have a component in the database
        $storage = new Storage;
        $storage->name = 'teststorage';
        $storage->save();

        $component = new Component;
        $component->name = 'testcomponent';
        $component->category = 'testcategory';
        $component->stock = '42';
        $component->stock_flag = false;
        $storage->components()->save($component);


        // When I update the stock
        $component->updateStock('+5');

        // Then the stock should be updated
        $this->assertEquals(47, $component->stock);

        // Cleanup
        $storage->components()->delete();
        $storage->delete();
    }

    /**
     * Test Stock decrease update
     *
     * @return void
     */
    public function testStockDecrease()
    {
        // Given I have a component in the database
        $storage = new Storage;
        $storage->name = 'teststorage';
        $storage->save();

        $component = new Component;
        $component->name = 'testcomponent';
        $component->category = 'testcategory';
        $component->stock = '42';
        $component->stock_flag = false;
        $storage->components()->save($component);


        // When I update the stock
        $component->updateStock('-5');

        // Then the stock should be updated
        $this->assertEquals(37, $component->stock);

        // Cleanup
        $storage->components()->delete();
        $storage->delete();
    }
}
