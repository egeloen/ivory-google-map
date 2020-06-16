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
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementLoaderRenderer;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RequirementLoaderRendererTest extends TestCase
{
    /**
     * @var RequirementLoaderRenderer
     */
    private $requirementLoaderRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->requirementLoaderRenderer = new RequirementLoaderRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->requirementLoaderRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'function name(c,r){if(r()){c();}else{var i=setInterval(function(){if(r()){clearInterval(i);c();}},10);}};',
            $this->requirementLoaderRenderer->render('name')
        );
    }

    public function testRenderWithVariables()
    {
        $this->assertSame(
            'function name(callback,requirement){if(requirement()){callback();}else{var interval=setInterval(function(){if(requirement()){clearInterval(interval);callback();}},10);}};',
            $this->requirementLoaderRenderer->render('name', 'interval', 'callback', 'requirement')
        );
    }

    public function testRenderWithDebug()
    {
        $this->requirementLoaderRenderer->getFormatter()->setDebug(true);

        $this->assertSame(
            'function name (c, r) {'."\n".'    if (r()) {'."\n".'        c();'."\n".'    } else {'."\n".'        var i = setInterval(function () {'."\n".'            if (r()) {'."\n".'                clearInterval(i);'."\n".'                c();'."\n".'            }'."\n".'        }, 10);'."\n".'    }'."\n".'};'."\n",
            $this->requirementLoaderRenderer->render('name')
        );
    }
}
