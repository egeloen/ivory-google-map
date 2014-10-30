<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Info box renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer */
    private $infoBoxRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoBoxRenderer = new InfoBoxRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->infoBoxRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, InfoWindow $infoWindow)
    {
        $this->assertSame($expected, $this->infoBoxRenderer->render($infoWindow));
    }

    public function testRenderSource()
    {
        $this->assertSame(
            '//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js',
            $this->infoBoxRenderer->renderSource()
        );
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('new InfoBox({"content":"content"})', $this->createInfoWindowMock()),
            array(
                'new InfoBox({"position":coordinate,"content":"content"})',
                $this->createInfoWindowMock($this->createCoordinateMock()),
            ),
            array(
                'new InfoBox({"pixelOffset":size,"content":"content"})',
                $this->createInfoWindowMock(null, $this->createSizeMock()),
            ),
            array(
                'new InfoBox({"position":coordinate,"pixelOffset":size,"content":"content"})',
                $this->createInfoWindowMock($this->createCoordinateMock(), $this->createSizeMock()),
            ),
            array(
                'new InfoBox({"position":coordinate,"pixelOffset":size,"content":"content","foo":"bar"})',
                $this->createInfoWindowMock(
                    $this->createCoordinateMock(),
                    $this->createSizeMock(),
                    array('foo' => 'bar')
                ),
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createCoordinateMock()
    {
        $coordinate = parent::createCoordinateMock();
        $coordinate
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('coordinate'));

        return $coordinate;
    }

    /**
     * Creates an info window mock.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $position    The position.
     * @param \Ivory\GoogleMap\Base\Size|null       $pixelOffset The pixel offset.
     * @param array                                 $options     The options.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow|\PHPUnit_Framework_MockObject_MockObject The info window mock.
     */
    protected function createInfoWindowMock(
        Coordinate $position = null,
        Size $pixelOffset = null,
        array $options = array()
    ) {
        $infoWindow = parent::createInfoWindowMock();
        $infoWindow
            ->expects($this->any())
            ->method('getContent')
            ->will($this->returnValue('content'));

        $infoWindow
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue($options));

        if ($position !== null) {
            $infoWindow
                ->expects($this->any())
                ->method('hasPosition')
                ->will($this->returnValue(true));

            $infoWindow
                ->expects($this->any())
                ->method('getPosition')
                ->will($this->returnValue($position));
        }

        if ($pixelOffset !== null) {
            $infoWindow
                ->expects($this->any())
                ->method('hasPixelOffset')
                ->will($this->returnValue(true));

            $infoWindow
                ->expects($this->any())
                ->method('getPixelOffset')
                ->will($this->returnValue($pixelOffset));
        }

        return $infoWindow;
    }

    /**
     * {@inheritdoc}
     */
    protected function createSizeMock()
    {
        $size = parent::createSizeMock();
        $size
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('size'));

        return $size;
    }
}
