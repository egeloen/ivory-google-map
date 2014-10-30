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

use Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Animation renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer */
    private $animationRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->animationRenderer = new AnimationRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->animationRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, $animation)
    {
        $this->assertSame($expected, $this->animationRenderer->render($animation));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('google.maps.Animation.BOUNCE', Animation::BOUNCE),
            array('google.maps.Animation.DROP', Animation::DROP),
        );
    }
}
