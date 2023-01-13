<?php

namespace Tests\Unit;

use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_list_all_existing_categories()
    {
        // call route to rettrieve all products
        $response = $this->get('/api/categories');
        // test response satus
        $response->assertOk();
    }
}
