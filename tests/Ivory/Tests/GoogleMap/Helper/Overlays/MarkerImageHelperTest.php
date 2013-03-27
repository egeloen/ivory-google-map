<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Overlays;

use Ivory\GoogleMap\Overlays\MarkerImage;
use Ivory\GoogleMap\Helper\Overlays\MarkerImageHelper;

/**
 * Marker image helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerImageHelper */
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

    public function testRender()
    {
        $markerImage = new MarkerImage();
        $markerImage->setJavascriptVariable('markerImage');
        $markerImage->setUrl('url');

        $markerImage->setSize(1, 2);
        $markerImage->getSize()->setJavascriptVariable('size');

        $markerImage->setOrigin(3, 4);
        $markerImage->getOrigin()->setJavascriptVariable('origin');

        $markerImage->setAnchor(5, 6);
        $markerImage->getAnchor()->setJavascriptVariable('anchor');

        $markerImage->setScaledSize(7, 8);
        $markerImage->getScaledSize()->setJavascriptVariable('scaled_size');

        $expected = <<<EOF
markerImage = new google.maps.MarkerImage("url", size, origin, anchor, scaled_size);

EOF;

        $this->assertSame($expected, $this->markerImageHelper->render($markerImage));
    }
}
