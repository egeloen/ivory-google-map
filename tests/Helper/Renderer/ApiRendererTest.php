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
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\ApiInitRenderer;
use Ivory\GoogleMap\Helper\Renderer\ApiRenderer;
use Ivory\GoogleMap\Helper\Renderer\LoaderRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementLoaderRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\SourceRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ApiRenderer
     */
    private $apiRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->apiRenderer = new ApiRenderer(
            $formatter = new Formatter(),
            new ApiInitRenderer($formatter),
            new LoaderRenderer($formatter, new JsonBuilder()),
            new RequirementLoaderRenderer($formatter),
            new SourceRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->apiRenderer);
    }

    public function testApiInitRenderer()
    {
        $this->apiRenderer->setApiInitRenderer($apiInitRenderer = $this->createApiInitRendererMock());

        $this->assertSame($apiInitRenderer, $this->apiRenderer->getApiInitRenderer());
    }

    public function testLoaderRenderer()
    {
        $this->apiRenderer->setLoaderRenderer($loaderRenderer = $this->createLoaderRendererMock());

        $this->assertSame($loaderRenderer, $this->apiRenderer->getLoaderRenderer());
    }

    public function testRequirementLoaderRenderer()
    {
        $requirementLoaderRenderer = $this->createRequirementLoaderRendererMock();
        $this->apiRenderer->setRequirementLoaderRenderer($requirementLoaderRenderer);

        $this->assertSame($requirementLoaderRenderer, $this->apiRenderer->getRequirementLoaderRenderer());
    }

    public function testSourceRenderer()
    {
        $this->apiRenderer->setSourceRenderer($sourceRenderer = $this->createSourceRendererMock());

        $this->assertSame($sourceRenderer, $this->apiRenderer->getSourceRenderer());
    }

    public function testRender()
    {
        $this->assertSame(
            'function ivory_google_map_load(){google.load("maps","3",{"other_params":"language=en&libraries=library1,library2","callback":ivory_google_map_init})};function ivory_google_map_init_source(src){var script=document.createElement("script");script.type="text/javascript";script.async=true;script.src=src;document.getElementsByTagName("head")[0].appendChild(script);};function ivory_google_map_init_requirement(c,r){if(r()){c();}else{var i=setInterval(function(){if(r()){clearInterval(i);c();}},100);}};function ivory_google_map_init(){ivory_google_map_init_source("source1");ivory_google_map_init_source("source2");ivory_google_map_init_requirement(main_callback,function(){return requirement1&&requirement2;});};ivory_google_map_init_source("https://www.google.com/jsapi?callback=ivory_google_map_load");',
            $this->apiRenderer->render(
                $this->createCallbacks($object = new \stdClass()),
                $this->createRequirements($object),
                ['source1', 'source2'],
                ['library1', 'library2']
            )
        );
    }

    public function testRenderWithDebug()
    {
        $this->apiRenderer->getFormatter()->setDebug(true);

        $expected = <<<'EOF'
function ivory_google_map_load () {
    google.load("maps", "3", {
        "other_params": "language=en&libraries=library1,library2",
        "callback": ivory_google_map_init
    })
};
function ivory_google_map_init_source (src) {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.async = true;
    script.src = src;
    document.getElementsByTagName("head")[0].appendChild(script);
};
function ivory_google_map_init_requirement (c, r) {
    if (r()) {
        c();
    } else {
        var i = setInterval(function () {
            if (r()) {
                clearInterval(i);
                c();
            }
        }, 100);
    }
};
function ivory_google_map_init () {
    ivory_google_map_init_source("source1");
    ivory_google_map_init_source("source2");
    ivory_google_map_init_requirement(main_callback, function () {
        return requirement1 && requirement2;
    });
};
ivory_google_map_init_source("https://www.google.com/jsapi?callback=ivory_google_map_load");
EOF;

        $this->assertSame($expected, $this->apiRenderer->render(
            $this->createCallbacks($object = new \stdClass()),
            $this->createRequirements($object),
            ['source1', 'source2'],
            ['library1', 'library2']
        ));
    }

    /**
     * @param object $object
     *
     * @return \SplObjectStorage
     */
    private function createCallbacks($object)
    {
        $callbacks = new \SplObjectStorage();
        $callbacks[$object] = 'main_callback';

        return $callbacks;
    }

    /**
     * @param object $object
     *
     * @return \SplObjectStorage
     */
    private function createRequirements($object)
    {
        $requirements = new \SplObjectStorage();
        $requirements[$object] = ['requirement1', 'requirement2'];

        return $requirements;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ApiInitRenderer
     */
    private function createApiInitRendererMock()
    {
        return $this->createMock(ApiInitRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|LoaderRenderer
     */
    private function createLoaderRendererMock()
    {
        return $this->createMock(LoaderRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RequirementLoaderRenderer
     */
    private function createRequirementLoaderRendererMock()
    {
        return $this->createMock(RequirementLoaderRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|SourceRenderer
     */
    private function createSourceRendererMock()
    {
        return $this->createMock(SourceRenderer::class);
    }
}
