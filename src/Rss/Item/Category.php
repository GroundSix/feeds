<?php

namespace GroundSix\Feeds\Rss\Item;

class Category
{
    /** @var string */
    private $domain;
    /** @var string */
    private $value;

    /**
     * @param string $value
     * @param string $domain
     */
    public function __construct(string $value, ?string $domain = null)
    {
        $this->value = $value;
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
