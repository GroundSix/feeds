<?php

namespace Jmsfwk\Feeds\Rss;

use ArrayIterator;
use IteratorAggregate;

class Channel implements IteratorAggregate
{
    /** @var string */
    private $title;
    /** @var string */
    private $link;
    /** @var string */
    private $description;
    /** @var Image */
    private $image;
    /** @var null|int */
    private $ttl = null;

    /**
     * @param string $title The title of the feed, equivalent to a html <title>
     * @param string $link The link to the html corresponding to the channel
     * @param string $description A longer description of the content of the feed
     */
    public function __construct($title, $link, $description)
    {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
    }

    public function getIterator()
    {
        $array = [
            'title' => $this->getTitle(),
            'link' => $this->getLink(),
            'description' => $this->getDescription(),
        ];

        foreach (['ttl'] as $key) {
            if ($this->{"get$key"}() !== null) {
                $array[$key] = $this->{"get$key"}();
            }
        }

        return new ArrayIterator($array);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @return bool
     */
    public function hasImage(): bool
    {
        return null !== $this->image;
    }

    /**
     * @return int|null
     */
    public function getTtl(): ?int
    {
        return $this->ttl;
    }

    /**
     * @param int|null $ttl
     */
    public function setTtl(?int $ttl)
    {
        $this->ttl = $ttl;
    }
}
