<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Utility;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\CallbackRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CallbackRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CallbackRenderer
     */
    private $callbackRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->callbackRenderer = new CallbackRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->callbackRenderer);
    }

    public function testRender()
    {
        $this->assertSame('ivory_google_map_name', $this->callbackRenderer->render('name'));
    }
}
