<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\MapTypeIdRenderer;
use Ivory\GoogleMap\MapTypeId;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapTypeIdRenderer
     */
    private $mapTypeIdRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeIdRenderer = new MapTypeIdRenderer(new Formatter());
    }

    public function testRender()
    {
        $this->assertSame('google.maps.MapTypeId.HYBRID', $this->mapTypeIdRenderer->render(MapTypeId::HYBRID));
    }
}
