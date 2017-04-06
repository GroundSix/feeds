<?php

namespace Jmsfwk\Feeds\Tests\Rss\Item;

use Jmsfwk\Feeds\Rss\Item\Source;
use PHPUnit\Framework\TestCase;

class SourceTest extends TestCase
{
    public function test_it_initialises_the_url()
    {
        $url = 'https://example.com';

        $source = new Source('', $url);

        $this->assertEquals($url, $source->getUrl());
    }

    public function test_it_initialises_the_name()
    {
        $name = 'Example';

        $source = new Source($name, '');

        $this->assertEquals($name, $source->getName());
    }
}
