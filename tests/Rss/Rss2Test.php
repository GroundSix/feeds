<?php

namespace GroundSix\Feeds\Tests\Rss;

use DOMDocument;
use GroundSix\Feeds\Rss\Channel;
use GroundSix\Feeds\Rss\Rss;
use GroundSix\Feeds\Rss\Rss2;
use PHPUnit\Framework\TestCase;

class Rss2Test extends TestCase
{
    /** @var DOMDocument */
    private $rss;

    public function test_it_is_version_2()
    {
        $rss = $this->rss->documentElement;

        $this->assertEquals('2.0', $rss->getAttribute('version'));
    }

    protected function setUp(): void
    {
        parent::setUp();
        // Make a feed
        $rss = new Rss2(new Channel('title', 'link', 'description'));
        $this->feed = $rss;
        // then put into a new dom to inspect it
        $this->rss = $this->inspectFeedXML($rss);
    }

    private function inspectFeedXML(Rss $rss): DOMDocument
    {
        $xml = $rss->saveXML();
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        return $dom;
    }
}
