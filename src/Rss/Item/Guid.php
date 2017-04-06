<?php

namespace GroundSix\Feeds\Rss\Item;

class Guid
{
    /** @var string */
    private $guid;
    /** @var bool */
    private $permaLink;

    /**
     * @param string $guid
     * @param bool   $permaLink
     */
    public function __construct(string $guid, bool $permaLink = true)
    {
        $this->guid = $guid;
        $this->permaLink = $permaLink;
    }

    /**
     * @return string
     */
    public function getGuid(): string
    {
        return $this->guid;
    }

    /**
     * @return bool
     */
    public function isPermaLink(): bool
    {
        return $this->permaLink;
    }
}
