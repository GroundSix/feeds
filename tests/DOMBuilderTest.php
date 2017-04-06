<?php

namespace GroundSix\Feeds\Tests;

use DOMDocument;
use DOMElement;
use GroundSix\Feeds\DOMBuilder;
use PHPUnit\Framework\TestCase;

class DOMBuilderTest extends TestCase
{
    /** @var DOMBuilder */
    private $builder;

    public function test_it_can_make_a_new_element()
    {
        $element = $this->builder->createElement('name');

        $this->assertInstanceOf(DOMElement::class, $element);
        $this->assertEquals('name', $element->tagName);
    }

    public function test_it_can_make_a_new_element_with_a_value()
    {
        $element = $this->builder->createElement('name', 'value');

        $this->assertEquals('value', $element->nodeValue);
    }

    public function test_it_automatically_escapes_the_value_of_new_elements()
    {
        $element = $this->builder->createElement('name', '&');

        $this->assertEquals('&', $element->nodeValue);
    }

    public function setUp()
    {
        parent::setUp();
        $this->builder = new DOMBuilder(new DOMDocument());
    }
}
