<?php

namespace GroundSix\Feeds\Tests\Rss;

use DateTime;
use DOMCdataSection;
use DOMDocument;
use DOMElement;
use InvalidArgumentException;
use GroundSix\Feeds\DOMBuilder;
use GroundSix\Feeds\Rss\Item;
use GroundSix\Feeds\Rss\Item\Enclosure;
use GroundSix\Feeds\Rss\Item\Guid;
use GroundSix\Feeds\Rss\Item\Source;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /** @var Item */
    private $item;

    public function test_it_can_add_fields_to_an_item_element()
    {
        $dom = new DOMDocument();
        $item = $dom->createElement('item');
        $this->assertEquals(0, $item->childNodes->length);

        $this->item->addFields($item, new DOMBuilder($dom));

        $this->assertGreaterThan(0, $item->childNodes->length);
    }

    public function test_it_adds_the_value_of_description_as_a_cdata_section()
    {
        $dom = new DOMDocument();
        $item = $dom->createElement('item');

        $this->item->addFields($item, new DOMBuilder($dom));
        $description = $item->getElementsByTagName('description');

        $this->assertEquals(1, $description->length);
        $this->assertEquals(1, $description->item(0)->childNodes->length);
        $this->assertInstanceOf(DOMCdataSection::class, $description->item(0)->childNodes->item(0));
    }

    public function test_it_cannot_be_initialised_without_either_title_or_description()
    {
        $this->expectException(InvalidArgumentException::class);

        new Item(null, null);
    }

    public function test_description_cannot_be_set_to_null_if_title_is_null()
    {
        $item = new Item(null, '');

        $this->expectException(InvalidArgumentException::class);

        $item->setDescription(null);
    }

    public function test_title_cannot_be_set_to_null_if_description_is_null()
    {
        $item = new Item('', null);

        $this->expectException(InvalidArgumentException::class);

        $item->setTitle(null);
    }

    public function test_it_can_set_the_guid()
    {
        $guid = $this->createMock(Guid::class);

        $this->item->setGuid($guid);

        $this->assertEquals($guid, $this->item->getGuid());
    }

    public function test_it_can_set_the_source()
    {
        $source = $this->createMock(Source::class);

        $this->item->setSource($source);

        $this->assertEquals($source, $this->item->getSource());
    }

    public function test_it_can_set_the_pub_date()
    {
        $pubDate = $this->createMock(DateTime::class);

        $this->item->setPubDate($pubDate);

        $this->assertEquals($pubDate, $this->item->getPubDate());
    }

    public function test_it_can_set_the_enclosure()
    {
        $enclosure = $this->createMock(Enclosure::class);

        $this->item->setEnclosure($enclosure);

        $this->assertEquals($enclosure, $this->item->getEnclosure());
    }

    /**
     * @dataProvider fields
     *
     * @param $field
     */
    public function test_it_can_return_null_from_any_field($field)
    {
        $getter = 'get' . ucfirst($field);

        $this->assertNull($this->item->$getter());
    }

    /**
     * @dataProvider stringFields
     *
     * @param $field
     */
    public function test_string_fields_can_have_their_values_set($field)
    {
        $setter = 'set' . ucfirst($field);
        $getter = 'get' . ucfirst($field);

        $this->item->$setter($field);

        $this->assertEquals($field, $this->item->$getter());
    }

    /** @test */
    public function AddFields__GuidNotPermalink__isPermaLinkAttributeValueIsFalse()
    {
        $this->item->setGuid(new Guid('', false));

        $item = $this->buildItem();
        /** @var DOMElement $guid */
        $guid = $item->getElementsByTagName('guid')[0];
        $attribute = $guid->attributes->getNamedItem('isPermaLink');

        $this->assertEquals('false', $attribute->nodeValue, 'When Guid is not a permalink the `isPermaLink` attribute should have the value `false`.');
    }

    public function fields()
    {
        return [
            ['link'],
            ['author'],
            ['comments'],
            ['enclosure'],
            ['guid'],
            ['pubDate'],
            ['source'],
        ];
    }

    public function stringFields()
    {
        return [
            ['author'],
            ['comments'],
            ['description'],
            ['link'],
            ['title'],
        ];
    }

    protected function setUp()
    {
        parent::setUp();
        $this->item = new Item('', '');
    }

    private function buildItem(): DOMElement
    {
        $dom = new DOMDocument();
        $builder = new DOMBuilder($dom);
        $element = $dom->createElement('item');

        $this->item->addFields($element, $builder);

       return $element;
    }
}
