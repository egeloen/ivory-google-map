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

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Overlays\Icon;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Icon renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer */
    private $iconRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->iconRenderer = new IconRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->iconRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, Icon $icon)
    {
        $this->assertSame($expected, $this->iconRenderer->render($icon));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('{"url":"http:\/\/egeloen.fr"}', $this->createIconMock()),
            array('{"url":"http:\/\/egeloen.fr","size":size}', $this->createIconMock($this->createSizeMock())),
            array(
                '{"url":"http:\/\/egeloen.fr","origin":origin}',
                $this->createIconMock(null, $this->createPointMock('origin')),
            ),
            array(
                '{"url":"http:\/\/egeloen.fr","anchor":anchor}',
                $this->createIconMock(null, null, $this->createPointMock('anchor')),
            ),
            array(
                '{"url":"http:\/\/egeloen.fr","scaledSize":scaled_size}',
                $this->createIconMock(null, null, null, $this->createSizeMock('scaled_size')),
            ),
            array(
                '{"url":"http:\/\/egeloen.fr","size":size,"origin":origin,"anchor":anchor,"scaledSize":scaled_size}',
                $this->createIconMock(
                    $this->createSizeMock(),
                    $this->createPointMock('origin'),
                    $this->createPointMock('anchor'),
                    $this->createSizeMock('scaled_size')
                ),
            ),
        );
    }

    /**
     * Creates an icon mock.
     *
     * @param \Ivory\GoogleMap\Base\Size|null  $size       The size.
     * @param \Ivory\GoogleMap\Base\Point|null $origin     The origin.
     * @param \Ivory\GoogleMap\Base\Point|null $anchor     The anchor.
     * @param \Ivory\GoogleMap\Base\Size|null  $scaledSize The scaled size.
     *
     * @return \Ivory\GoogleMap\Overlays\Icon|\PHPUnit_Framework_MockObject_MockObject The icon mock.
     */
    protected function createIconMock(Size $size = null, Point $origin = null, Point $anchor = null, Size $scaledSize = null)
    {
        $icon = parent::createIconMock();
        $icon
            ->expects($this->any())
            ->method('getUrl')
            ->will($this->returnValue('http://egeloen.fr'));

        if ($size !== null) {
            $icon
                ->expects($this->any())
                ->method('hasSize')
                ->will($this->returnValue(true));

            $icon
                ->expects($this->any())
                ->method('getSize')
                ->will($this->returnValue($size));
        }

        if ($origin !== null) {
            $icon
                ->expects($this->any())
                ->method('hasOrigin')
                ->will($this->returnValue(true));

            $icon
                ->expects($this->any())
                ->method('getOrigin')
                ->will($this->returnValue($origin));
        }

        if ($anchor !== null) {
            $icon
                ->expects($this->any())
                ->method('hasAnchor')
                ->will($this->returnValue(true));

            $icon
                ->expects($this->any())
                ->method('getAnchor')
                ->will($this->returnValue($anchor));
        }

        if ($scaledSize !== null) {
            $icon
                ->expects($this->any())
                ->method('hasScaledSize')
                ->will($this->returnValue(true));

            $icon
                ->expects($this->any())
                ->method('getScaledSize')
                ->will($this->returnValue($scaledSize));
        }

        return $icon;
    }

    /**
     * Creates a point mock.
     *
     * @param string $variable The variable.
     *
     * @return \Ivory\GoogleMap\Base\Point|\PHPUnit_Framework_MockObject_MockObject The point mock.
     */
    protected function createPointMock($variable = 'point')
    {
        $point = parent::createPointMock();
        $point
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue($variable));

        return $point;
    }

    /**
     * Creates a size mock.
     *
     * @param string $variable The variable.
     *
     * @return \Ivory\GoogleMap\Base\Size|\PHPUnit_Framework_MockObject_MockObject The size mock.
     */
    protected function createSizeMock($variable = 'size')
    {
        $size = parent::createSizeMock();
        $size
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue($variable));

        return $size;
    }
}
