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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiInitRendererTest extends\PHPUnit_Framework_TestCase
{
    /**
     * @var ApiInitRenderer
     */
    private $apiInitRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->apiInitRenderer = new ApiInitRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->apiInitRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'function name(){source_callback("source1");source_callback("source2");requirement_callback(main_callback,function(){return requirement1&&requirement2;});};',
            $this->apiInitRenderer->render(
                'name',
                $this->createCallbacks($object = new \stdClass()),
                $this->createRequirements($object),
                ['source1', 'source2'],
                'source_callback',
                'requirement_callback'
            )
        );
    }

    public function testRenderWithDebug()
    {
        $this->apiInitRenderer->getFormatter()->setDebug(true);

        $expected = <<<'EOF'
function name () {
    source_callback("source1");
    source_callback("source2");
    requirement_callback(main_callback, function () {
        return requirement1 && requirement2;
    });
};

EOF;

        $this->assertSame($expected, $this->apiInitRenderer->render(
            'name',
            $this->createCallbacks($object = new \stdClass()),
            $this->createRequirements($object),
            ['source1', 'source2'],
            'source_callback',
            'requirement_callback'
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
}
