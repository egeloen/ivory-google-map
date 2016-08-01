<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Base;

use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Base\SizeRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SizeRenderer
     */
    private $sizeRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->sizeRenderer = new SizeRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->sizeRenderer);
    }

    public function testRender()
    {
        $size = new Size(1.2, 2.3);
        $size->setVariable('size');

        $this->assertSame(
            'size=new google.maps.Size(1.2,2.3)',
            $this->sizeRenderer->render($size)
        );
    }

    public function testRenderWithUnits()
    {
        $size = new Size(1.2, 2.3, 'px', 'pt');
        $size->setVariable('size');

        $this->assertSame(
            'size=new google.maps.Size(1.2,2.3,"px","pt")',
            $this->sizeRenderer->render($size)
        );
    }
}
