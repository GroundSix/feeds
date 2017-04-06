<?php

namespace GroundSix\Feeds\Tests\Rss\Item;

use GroundSix\Feeds\Rss\Item\Enclosure;
use PHPUnit\Framework\TestCase;

class EnclosureTest extends TestCase
{
    public function test_it_can_be_initialised()
    {
        $enclosure = new Enclosure('url', 1234, 'mime');

        $this->assertEquals('url', $enclosure->getUrl());
        $this->assertEquals(1234, $enclosure->getLength());
        $this->assertEquals('mime', $enclosure->getType());
    }
}
