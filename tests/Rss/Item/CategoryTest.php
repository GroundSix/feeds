<?php

namespace Jmsfwk\Feeds\Tests\Rss\Item;

use Jmsfwk\Feeds\Rss\Item\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function test_it_can_be_initialised()
    {
        $category = new Category('category');

        $this->assertEquals('category', $category->getValue());
        $this->assertNull($category->getDomain());
    }

    public function test_it_can_be_initialised_with_an_optional_domain()
    {
        $category = new Category('category', 'domain');

        $this->assertEquals('domain', $category->getDomain());
    }
}
