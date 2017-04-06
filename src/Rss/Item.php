<?php

namespace GroundSix\Feeds\Rss;

use DateTimeInterface;
use DOMElement;
use InvalidArgumentException;
use GroundSix\Feeds\DOMBuilder;
use GroundSix\Feeds\Rss\Item\Enclosure;
use GroundSix\Feeds\Rss\Item\Guid;
use GroundSix\Feeds\Rss\Item\Source;

class Item implements ItemBuilder
{
    /** @var string */
    private $author;
    /** @var string */
    private $comments;
    /** @var string */
    private $description;
    /** @var Enclosure */
    private $enclosure;
    /** @var Guid */
    private $guid;
    /** @var string */
    private $link;
    /** @var DateTimeInterface */
    private $pubDate;
    /** @var Source */
    private $source;
    /** @var string */
    private $title;

    /**
     * @param string      $title
     * @param string      $description
     * @param null|string $link
     */
    public function __construct(?string $title, ?string $description, ?string $link = null)
    {
        if (null === $title && null === $description) {
            throw new InvalidArgumentException("At least one of 'title' or 'description' is required.");
        }
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
    }

    public function addFields(DOMElement $item, DOMBuilder $builder)
    {
        $item->appendChild($builder->createElement('title', $this->title));
    }

    /**
     * @return string
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(?string $author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getComments(): ?string
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     */
    public function setComments(?string $comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @throws InvalidArgumentException if title is null and description is set to null
     */
    public function setDescription(?string $description)
    {
        if (null === $description && null === $this->title) {
            throw new InvalidArgumentException('Description cannot be set to null when title is null');
        }
        $this->description = $description;
    }

    /**
     * @return Enclosure
     */
    public function getEnclosure(): ?Enclosure
    {
        return $this->enclosure;
    }

    /**
     * @param Enclosure $enclosure
     */
    public function setEnclosure(?Enclosure $enclosure)
    {
        $this->enclosure = $enclosure;
    }

    /**
     * @return string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @throws InvalidArgumentException if description is null and title is set to null
     */
    public function setTitle(?string $title)
    {
        if (null === $title && null === $this->description) {
            throw new InvalidArgumentException('Title cannot be set to null when description is null');
        }
        $this->title = $title;
    }

    /**
     * @return Guid
     */
    public function getGuid(): ?Guid
    {
        return $this->guid;
    }

    /**
     * @param Guid $guid
     */
    public function setGuid(Guid $guid)
    {
        $this->guid = $guid;
    }

    /**
     * @return Source
     */
    public function getSource(): ?Source
    {
        return $this->source;
    }

    /**
     * @param Source $source
     */
    public function setSource(Source $source)
    {
        $this->source = $source;
    }

    /**
     * @return DateTimeInterface
     */
    public function getPubDate(): ?DateTimeInterface
    {
        return $this->pubDate;
    }

    /**
     * @param DateTimeInterface $pubDate
     */
    public function setPubDate(DateTimeInterface $pubDate)
    {
        $this->pubDate = $pubDate;
    }
}
