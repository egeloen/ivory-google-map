<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Templating\Helper\Overlays;

use Ivory\GoogleMap\Overlays\MarkerImage,
    Ivory\GoogleMap\Templating\Helper\Overlays\MarkerImageHelper;

/**
 * Marker image helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerImageHelper */
    protected $markerImageHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerImageHelper = new MarkerImageHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerImageHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Base\PointHelper',
            $this->markerImageHelper->getPointHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Base\SizeHelper',
            $this->markerImageHelper->getSizeHelper()
        );
    }

    public function testInitialState()
    {
        $pointHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Base\PointHelper');
        $sizeHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Base\SizeHelper');

        $this->markerImageHelper = new MarkerImageHelper($pointHelper, $sizeHelper);

        $this->assertSame($pointHelper, $this->markerImageHelper->getPointHelper());
        $this->assertSame($sizeHelper, $this->markerImageHelper->getSizeHelper());
    }

    public function testRender()
    {
        $markerImage = new MarkerImage();
        $markerImage->setJavascriptVariable('markerImage');
        $markerImage->setUrl('url');
        $markerImage->setSize(1, 2);
        $markerImage->setOrigin(3, 4);
        $markerImage->setAnchor(5, 6);
        $markerImage->setScaledSize(7, 8);

        $expected = <<<EOF
var markerImage = new google.maps.MarkerImage("url");
markerImage.size = new google.maps.Size(1, 2);
markerImage.origin = new google.maps.Point(3, 4);
markerImage.anchor = new google.maps.Point(5, 6);
markerImage.scaledSize = new google.maps.Size(7, 8);

EOF;

        $this->assertSame($expected, $this->markerImageHelper->render($markerImage));
    }
}
