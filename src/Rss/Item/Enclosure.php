<?php

namespace Jmsfwk\Feeds\Rss\Item;

class Enclosure
{
    /** @var int */
    private $length;
    /** @var string */
    private $type;
    /** @var string */
    private $url;

    /**
     * @param string $url
     * @param int    $length
     * @param string $type
     */
    public function __construct(string $url, int $length, string $type)
    {
        $this->url = $url;
        $this->length = $length;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
