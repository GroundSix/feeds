<?php

namespace Jmsfwk\Feeds\Rss;

use ArrayIterator;
use InvalidArgumentException;
use IteratorAggregate;

class Image implements IteratorAggregate
{
    /** @var string */
    private $url;
    /** @var string */
    private $title;
    /** @var string */
    private $link;
    /** @var string */
    private $description = null;
    /** @var int */
    private $width = null;
    /** @var int */
    private $height = null;

    /**
     * @param string $url
     * @param string $title
     * @param string $link
     */
    public function __construct(string $url, string $title, string $link)
    {
        $this->setUrl($url);
        $this->setTitle($title);
        $this->setLink($link);
    }

    public function getIterator()
    {
        $array = [
            'url' => $this->getUrl(),
            'title' => $this->getTitle(),
            'link' => $this->getLink(),
        ];
        foreach (['description', 'width', 'height'] as $field) {
            if (null !== $this->{"get$field"}()) {
                $array[$field] = $this->{"get$field"}();
            }
        }
        return new ArrayIterator($array);
    }

    /**
     * Set the url of the image
     *
     * Must be a GIF, JPEG or PNG image that represents the channel.
     *
     * @param string $url
     *
     * @throws InvalidArgumentException if the url is an empty string
     */
    private function setUrl(string $url)
    {
        if ('' === $url) {
            throw new InvalidArgumentException('The url must not be an empty string');
        }
        $this->url = $url;
    }

    /**
     * Set the title of the image
     *
     * The title is used in the ALT attribute of the HTML <img> tag when the channel is rendered in HTML
     *
     * @param string $title
     */
    private function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Set the url for the image to link to
     *
     * Link is the URL of the site, when the channel is rendered, the
     * image is a link to the site.
     *
     * @param string $link
     */
    private function setLink(string $link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the description of the image
     *
     * Description contains text that is included in the TITLE attribute of
     * the link formed around the image in the HTML rendering.
     *
     * @param string $description
     */
    public function setDescription(?string $description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * Set the width of the image in pixels
     *
     * Maximum value is 144, default value is 88.
     *
     * @param int $width
     *
     * @throws InvalidArgumentException if the width is greater than 144
     */
    public function setWidth(?int $width)
    {
        if ($width < 0) {
            throw new InvalidArgumentException('The image width must be greater than 0');
        }
        if ($width > 144) {
            throw new InvalidArgumentException('The maximum image height is 144');
        }
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * Set the height of the image in pixels
     *
     * Maximum value is 400, default value is 31.
     *
     * @param int $height
     *
     * @throws InvalidArgumentException if the height is greater than 400
     */
    public function setHeight(?int $height)
    {
        if ($height < 0) {
            throw new InvalidArgumentException('The image height must be greater than 0');
        }
        if ($height > 400) {
            throw new InvalidArgumentException('The maximum image height is 400');
        }
        $this->height = $height;
    }
}
