<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Base;

use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Size renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer */
    private $sizeRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->sizeRenderer = new SizeRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->sizeRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, Size $size)
    {
        $this->assertSame($expected, $this->sizeRenderer->render($size));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        $emptySize = $this->createSizeMock();
        $widthUnitSize = $this->createSizeMock('px', null);
        $heightUnitSize = $this->createSizeMock(null, 'px');
        $fullSize = $this->createSizeMock('px', 'pt');

        return array(
            array('new google.maps.Size(1.234,5.678,null,null)', $emptySize),
            array('new google.maps.Size(1.234,5.678,"px",null)', $widthUnitSize),
            array('new google.maps.Size(1.234,5.678,null,"px")', $heightUnitSize),
            array('new google.maps.Size(1.234,5.678,"px","pt")', $fullSize),
        );
    }

    /**
     * Creates a size mock.
     *
     * @param string|null $widthUnit  The width unit.
     * @param string|null $heightUnit The height unit.
     *
     * @return \Ivory\GoogleMap\Base\Size|\PHPUnit_Framework_MockObject_MockObject The size mock.
     */
    protected function createSizeMock($widthUnit = null, $heightUnit = null)
    {
        $size = parent::createSizeMock();

        $size
            ->expects($this->any())
            ->method('getWidth')
            ->will($this->returnValue(1.234));

        $size
            ->expects($this->any())
            ->method('getHeight')
            ->will($this->returnValue(5.678));

        if ($widthUnit !== null) {
            $size
                ->expects($this->any())
                ->method('hasWidthUnit')
                ->will($this->returnValue(true));

            $size
                ->expects($this->any())
                ->method('getWidthUnit')
                ->will($this->returnValue($widthUnit));
        }

        if ($heightUnit !== null) {
            $size
                ->expects($this->any())
                ->method('hasHeightUnit')
                ->will($this->returnValue(true));

            $size
                ->expects($this->any())
                ->method('getHeightUnit')
                ->will($this->returnValue($heightUnit));
        }

        return $size;
    }
}
