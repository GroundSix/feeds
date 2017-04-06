<?php

namespace Jmsfwk\Feeds\Rss;

use DOMDocument;
use DOMElement;
use Jmsfwk\Feeds\DOMBuilder;

abstract class Rss
{
    /** @var DOMDocument */
    protected $dom;
    /** @var DOMElement */
    protected $channel;

    /**
     * @param Channel    $channel
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
        $this->dom = new DOMDocument('1.0', 'UTF-8');
        $this->createRoot();
        $this->channel = $this->createChannel($channel);
    }

    /**
     * @param bool $format
     */
    public function formatOutput(bool $format)
    {
        $this->dom->formatOutput = $format;
    }

    public function saveXML(): string
    {
        return $this->dom->saveXML();
    }

    public function addItem(ItemBuilder ...$items)
    {
        $builder = new DOMBuilder($this->dom);

        foreach ($items as $itemBuilder) {
            $item = $this->dom->createElement('item');
            $itemBuilder->addFields($item, $builder);
            $this->channel->appendChild($item);
        }
    }

    private function createRoot()
    {
        $rss = $this->dom->createElement('rss');
        $rss->setAttribute('version', static::VERSION);

        $this->dom->appendChild($rss);
    }

    private function createChannel(Channel $channel): DOMElement
    {
        $element = $this->dom->createElement('channel');
        $this->dom->documentElement->appendChild($element);
        $builder = new DOMBuilder($this->dom);

        foreach ($channel as $name => $value) {
            $element->appendChild($builder->createElement($name, $value));
        }

        if ($channel->hasImage()) {
            $image = $this->dom->createElement('image');
            foreach ($channel->getImage() as $name => $value) {
                $image->appendChild($builder->createElement($name, $value));
            }
            $element->appendChild($image);
        }

        return $element;
    }
}
