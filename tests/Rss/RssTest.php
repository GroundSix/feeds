<?php

namespace Jmsfwk\Feeds\Tests\Rss;

use DOMDocument;
use DOMElement;
use Jmsfwk\Feeds\DOMBuilder;
use Jmsfwk\Feeds\Rss\Channel;
use Jmsfwk\Feeds\Rss\Image;
use Jmsfwk\Feeds\Rss\Item;
use Jmsfwk\Feeds\Rss\Rss;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_Constraint_IsInstanceOf as IsInstanceOf;

class RssX extends Rss {
    const VERSION ='x';
}

class RssTest extends TestCase
{
    /** @var Rss */
    private $feed;
    /** @var DOMDocument */
    private $rss;

    public function test_it_has_a_rss_root_element()
    {
        $rss = $this->rss->documentElement;

        $this->assertEquals('rss', $rss->tagName);
        $this->assertTrue($rss->hasAttribute('version'));
    }

    public function test_it_has_a_single_channel_element()
    {
        $rss = $this->rss->documentElement;

        $this->assertEquals(1, $rss->childNodes->length);
        $this->assertEquals('channel', $rss->childNodes->item(0)->tagName);
    }

    public function test_the_channel_has_a_single_link_element()
    {
        $channel = $this->rss->getElementsByTagName('channel')->item(0);
        $link = $channel->getElementsByTagName('link');

        $this->assertEquals(1, $link->length);
        $this->assertEquals('link', $link->item(0)->nodeValue);
    }

    public function test_the_channel_has_a_single_title_element()
    {
        $channel = $this->rss->getElementsByTagName('channel')->item(0);
        $title = $channel->getElementsByTagName('title');

        $this->assertEquals(1, $title->length);
        $this->assertEquals('title', $title->item(0)->nodeValue);
    }

    public function test_the_channel_has_a_single_description_element()
    {
        $channel = $this->rss->getElementsByTagName('channel')->item(0);
        $description = $channel->getElementsByTagName('description');

        $this->assertEquals(1, $description->length);
        $this->assertEquals('description', $description->item(0)->nodeValue);
    }

    public function test_it_calls_addFields_on_an_item()
    {
        $item = $this->createMock(Item::class);
        $item->expects($this->once())
            ->method('addFields')
            ->with(
                new IsInstanceOf(DOMElement::class),
                new IsInstanceOf(DOMBuilder::class)
            );

        $this->feed->addItem($item);
    }

    public function test_it_adds_items_to_the_feed()
    {
        $rss = new RssX(new Channel('title', 'link', 'description'));
        $rss->addItem(new Item('title', null));

        $dom = $this->inspectFeedXML($rss);
        $items = $dom->getElementsByTagName('item');

        $this->assertEquals(1, $items->length);
        $this->assertInstanceOf(DOMElement::class, $items->item(0));
        $this->assertEquals(1, $items->item(0)->childNodes->length);
    }

    public function test_it_can_add_a_image_element()
    {
        $channel = new Channel('title', 'link', 'description');
        $channel->setImage(new Image('url', 'title', 'link'));
        $dom = $this->inspectFeedXML(new RssX($channel));

        $images = $dom->getElementsByTagName('image');

        $this->assertEquals(1, $images->length);
        $this->assertInstanceOf(DOMElement::class, $images->item(0));
        $this->assertEquals('image', $images->item(0)->tagName);
        $this->assertEquals(3, $images->item(0)->childNodes->length);
    }

    protected function setUp()
    {
        parent::setUp();
        // Make a feed
        $rss = new RssX(new Channel('title', 'link', 'description'));
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
