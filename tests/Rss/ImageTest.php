<?php
namespace Jmsfwk\Feeds\Tests\Rss;

use InvalidArgumentException;
use Jmsfwk\Feeds\Rss\Image;
use PHPUnit\Framework\TestCase;
use Traversable;

class ImageTest extends TestCase
{
    /** @var Image */
    private $image;

    protected function setUp()
    {
        parent::setUp();
        $this->image = new Image('some url', '', '');
    }

    /**
     * @test
     */
    public function it_cannot_set_the_url_to_an_empty_string()
    {
        $this->expectException(InvalidArgumentException::class);

        new Image('', '', '');
    }

    /**
     * @test
     * @dataProvider validHeights
     */
    public function it_can_set_the_height(int $height)
    {
        $this->image->setHeight($height);

        $this->assertEquals($height, $this->image->getHeight());
    }

    /**
     * @test
     * @dataProvider invalidHeights
     */
    public function it_can_stop_invalid_heights_being_set($height)
    {
        $this->expectException(InvalidArgumentException::class);

        $this->image->setHeight($height);
    }

    /**
     * @test
     */
    public function it_can_unset_the_height()
    {
        $this->image->setHeight(null);

        $this->assertNull($this->image->getHeight());
    }

    /**
     * @test
     * @dataProvider validWidths
     */
    public function it_can_set_the_width(int $width)
    {
        $this->image->setWidth($width);

        $this->assertEquals($width, $this->image->getWidth());
    }

    /**
     * @test
     * @dataProvider invalidWidths
     */
    public function it_can_stop_invalid_widths_being_set($width)
    {
        $this->expectException(InvalidArgumentException::class);

        $this->image->setWidth($width);
    }

    /**
     * @test
     */
    public function it_can_unset_the_width()
    {
        $this->image->setWidth(null);

        $this->assertNull($this->image->getWidth());
    }

    /**
     * @test
     */
    public function it_can_set_the_description()
    {
        $description = 'description';

        $this->image->setDescription($description);

        $this->assertEquals($description, $this->image->getDescription());
    }

    /**
     * @test
     */
    public function it_can_unset_the_description()
    {
        $this->image->setDescription('');

        $this->image->setDescription(null);

        $this->assertNull($this->image->getDescription());
    }

    /**
     * @test
     */
    public function it_is_traversible()
    {
        $this->assertInstanceOf(Traversable::class, $this->image);
    }

    /**
     * @test
     */
    public function it_iterates_over_the_required_fields()
    {
        $image = new Image('some url', '', '');
        $expected = ['url' => 'some url', 'link' => '', 'title' => ''];

        $this->assertEquals($expected, iterator_to_array($image));
    }

    /**
     * @test
     * @dataProvider optionalFields
     */
    public function it_iterates_over_the_non_null_optional_fields($field, $value)
    {
        $image = new Image('some url', '', '');
        $image->{"set$field"}($value);
        $expected = ['url' => 'some url', 'link' => '', 'title' => '', $field => $value];

        $this->assertInstanceOf(Traversable::class, $image);
        $this->assertEquals($expected, iterator_to_array($image));
    }

    public function validHeights()
    {
        return [
            [0],
            [50],
            [400],
        ];
    }

    public function invalidHeights()
    {
        return [
            [-1],
            [401],
        ];
    }

    public function validWidths()
    {
        return [
            [0],
            [50],
            [144],
        ];
    }

    public function invalidWidths()
    {
        return [
            [-1],
            [145],
        ];
    }

    public function optionalFields()
    {
        return [
            ['description', ''],
            ['width', 50],
            ['height', 50],
        ];
    }
}
