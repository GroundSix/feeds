<?php

namespace GroundSix\Feeds\Tests\Rss\Item;

use GroundSix\Feeds\Rss\Item\Guid;
use PHPUnit\Framework\TestCase;

class GuidTest extends TestCase
{
    public function test_it_defaults_to_a_permalink()
    {
        $guid = new Guid('');

        $this->assertTrue($guid->isPermaLink());
    }

    public function test_it_initialises_the_value()
    {
        $value = 'http://example.com';
        $guid = new Guid($value);

        $this->assertEquals($value, $guid->getGuid());
    }

    public function test_it_can_initialise_as_not_a_permaLink()
    {
        $guid = new Guid('', false);

        $this->assertFalse($guid->isPermaLink());
    }
}
