<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers;

use Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer;
use Ivory\GoogleMap\MapTypeId;

/**
 * Map type id renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer */
    private $mapTypeIdRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeIdRenderer = new MapTypeIdRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeIdRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, $mapTypeId)
    {
        $this->assertSame($expected, $this->mapTypeIdRenderer->render($mapTypeId));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('google.maps.MapTypeId.HYBRID', MapTypeId::HYBRID),
            array('google.maps.MapTypeId.ROADMAP', MapTypeId::ROADMAP),
            array('google.maps.MapTypeId.SATELLITE', MapTypeId::SATELLITE),
            array('google.maps.MapTypeId.TERRAIN', MapTypeId::TERRAIN),
        );
    }
}
