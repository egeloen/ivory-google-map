<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlay;

use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MarkerShape
     */
    private $markerShape;

    /**
     * @var string
     */
    private $type;

    /**
     * @var float[]
     */
    private $coordinates;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerShape = new MarkerShape(
            $this->type = MarkerShapeType::CIRCLE,
            $this->coordinates = [1.2, 2.3, 3.2]
        );
    }

    public function testDefaultState()
    {
        $this->assertSame($this->type, $this->markerShape->getType());
        $this->assertTrue($this->markerShape->hasCoordinates());
        $this->assertSame($this->coordinates, $this->markerShape->getCoordinates());
    }

    /**
     * @param string  $type
     * @param float[] $coordinates
     *
     * @dataProvider coordinatesProvider
     */
    public function testCoordinates($type, array $coordinates)
    {
        $this->markerShape->setType($type);
        $this->markerShape->setCoordinates($coordinates);

        $this->assertSame($type, $this->markerShape->getType());
        $this->assertTrue($this->markerShape->hasCoordinates());
        $this->assertSame($coordinates, $this->markerShape->getCoordinates());

        foreach ($coordinates as $coordinate) {
            $this->assertTrue($this->markerShape->hasCoordinate($coordinate));
        }
    }

    /**
     * @return mixed[][]
     */
    public function coordinatesProvider()
    {
        return [
            [MarkerShapeType::RECTANGLE, [1.2, 2.3]],
            [MarkerShapeType::CIRCLE, [1.2, 2.3, 3.3]],
            [MarkerShapeType::POLY, [1.2, 2.3, 3.4, 4.5, 5.5, 6.7]],
        ];
    }
}
