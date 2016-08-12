<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Html;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StylesheetRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StylesheetRenderer
     */
    private $stylesheetRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->stylesheetRenderer = new StylesheetRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->stylesheetRenderer);
    }

    public function testRender()
    {
        $this->assertSame('stylesheet:value;', $this->stylesheetRenderer->render('stylesheet', 'value'));
    }

    public function testRenderWithDebug()
    {
        $this->stylesheetRenderer->getFormatter()->setDebug(true);

        $this->assertSame('stylesheet: value;', $this->stylesheetRenderer->render('stylesheet', 'value'));
    }
}
