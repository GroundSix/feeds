<?php

namespace GroundSix\Feeds\Rss;

use DOMElement;
use GroundSix\Feeds\DOMBuilder;

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
