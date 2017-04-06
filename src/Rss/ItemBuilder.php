<?php

namespace Jmsfwk\Feeds\Rss;

use DOMElement;
use Jmsfwk\Feeds\DOMBuilder;

interface ItemBuilder
{
    /**
     *
     *
     * @param DOMElement $item
     * @param DOMBuilder $builder
     *
     * @return void
     */
    public function addFields(DOMElement $item, DOMBuilder $builder);
}
