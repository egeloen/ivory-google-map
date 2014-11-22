<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Controls;

use Ivory\GoogleMap\Controls\ScaleControlStyle;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Scale control style renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyleRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer */
    private $scaleControlStyleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControlStyleRenderer = new ScaleControlStyleRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControlStyleRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'google.maps.ScaleControlStyle.DEFAULT',
            $this->scaleControlStyleRenderer->render(ScaleControlStyle::DEFAULT_)
        );
    }
}
