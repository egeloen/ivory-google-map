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
use Ivory\GoogleMap\Helper\Renderer\Utility\ObjectToArrayRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ObjectToArrayRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectToArrayRenderer
     */
    private $objectToArrayRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->objectToArrayRenderer = new ObjectToArrayRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->objectToArrayRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'function(o){var a=[];for(var k in o){a.push(o[k]);}return a;}',
            $this->objectToArrayRenderer->render()
        );
    }

    public function testRenderWithVariables()
    {
        $this->assertSame(
            'function(object){var array=[];for(var key in object){array.push(object[key]);}return array;}',
            $this->objectToArrayRenderer->render('array', 'object', 'key')
        );
    }

    public function testRenderWithDebug()
    {
        $this->objectToArrayRenderer->getFormatter()->setDebug(true);

        $this->assertSame(
            'function (o) {'.PHP_EOL.'    var a = [];'.PHP_EOL.'    for (var k in o) {'.PHP_EOL.'        a.push(o[k]);'.PHP_EOL.'    }'.PHP_EOL.'    return a;'.PHP_EOL.'}',
            $this->objectToArrayRenderer->render()
        );
    }
}
