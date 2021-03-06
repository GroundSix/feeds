<?php

namespace GroundSix\Feeds;

use DOMCdataSection;
use DOMDocument;
use DOMElement;

final class DOMBuilder
{
    /** @var DOMDocument */
    private $dom;

    /**
     * @param DOMDocument $dom
     */
    public function __construct(DOMDocument $dom)
    {
        $this->dom = $dom;
    }

    public function createElement(string $name, string $value = null): DOMElement
    {
        $element = $this->dom->createElement($name);

        if (null !== $value) {
            $element->appendChild($this->dom->createTextNode($value));
        }

        return $element;
    }

    public function createCDATASection(string $data): DOMCdataSection
    {
        return $this->dom->createCDATASection($data);
    }
}
