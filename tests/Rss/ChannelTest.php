<?php
namespace GroundSix\Feeds\Tests\Rss;

use GroundSix\Feeds\Rss\Channel;
use GroundSix\Feeds\Rss\Image;
use PHPUnit\Framework\TestCase;
use Traversable;

class ChannelTest extends TestCase
{
    /** @var Channel */
    private $channel;

    protected function setUp()
    {
        parent::setUp();
        $this->channel = new Channel('', '', '');
    }

    /**
     * @test
     */
    public function it_can_be_initialised()
    {
        $channel = new Channel('title', 'link', 'description');

        $this->assertEquals('title', $channel->getTitle());
        $this->assertEquals('link', $channel->getLink());
        $this->assertEquals('description', $channel->getDescription());
    }

    /**
     * @test
     */
    public function it_is_traversible()
    {
        $this->assertInstanceOf(Traversable::class, $this->channel);
    }

    /**
     * @test
     */
    public function it_iterates_over_the_required_fields()
    {
        $channel = new Channel('', '', '');
        $expected = ['title' => '', 'link' => '', 'description' => ''];

        $this->assertEquals($expected, iterator_to_array($channel));
    }

    /**
     * @test
     * @dataProvider optionalFields
     */
    public function it_iterates_over_the_non_null_optional_fields($field, $value)
    {
        $channel = new Channel('', '', '');
        $channel->{"set$field"}($value);
        $expected = ['title' => '', 'link' => '', 'description' => '', $field => $value];

        $this->assertEquals($expected, iterator_to_array($channel));
    }

    /**
     * @test
     */
    public function it_will_report_if_it_has_an_image()
    {
        $this->assertFalse($this->channel->hasImage());

        $this->channel->setImage($this->createMock(Image::class));

        $this->assertTrue($this->channel->hasImage());
    }

    /**
     * @test
     */
    public function it_will_get_the_image()
    {
        $image = $this->createMock(Image::class);

        $this->channel->setImage($image);

        $this->assertEquals($image, $this->channel->getImage());
    }

    public function optionalFields()
    {
        return [
            ['ttl', 15],
        ];
    }
}
