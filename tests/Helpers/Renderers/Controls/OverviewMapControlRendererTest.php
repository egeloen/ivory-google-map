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

use Ivory\GoogleMap\Controls\OverviewMapControl;
use Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Overview map control renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer */
    private $overviewMapControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->overviewMapControlRenderer = new OverviewMapControlRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->overviewMapControlRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->overviewMapControlRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, OverviewMapControl $overviewMapControl)
    {
        $this->assertSame($expected, $this->overviewMapControlRenderer->render($overviewMapControl));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('{"opened":true}', $this->createOverviewMapControlMock()),
            array('{"opened":false}', $this->createOverviewMapControlMock(false)),
        );
    }

    protected function createOverviewMapControlMock($opened = true)
    {
        $overviewMapControl = parent::createOverviewMapControlMock();
        $overviewMapControl
            ->expects($this->any())
            ->method('isOpened')
            ->will($this->returnValue($opened));

        return $overviewMapControl;
    }
}
