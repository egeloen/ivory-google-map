<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Elevation\Request;

use Ivory\GoogleMap\Service\Base\Location\LocationInterface;
use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;
use Ivory\GoogleMap\Service\Elevation\Request\PathElevationRequest;
use Ivory\GoogleMap\Service\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PathElevationRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PathElevationRequest
     */
    private $request;

    /**
     * @var LocationInterface[]|\PHPUnit_Framework_MockObject_MockObject[]
     */
    private $paths;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->paths = [$this->createLocationMock('first'), $this->createLocationMock('second')];

        $this->request = new PathElevationRequest($this->paths);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ElevationRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->request->hasPaths());
        $this->assertSame($this->paths, $this->request->getPaths());
        $this->assertSame(3, $this->request->getSamples());
    }

    public function testInitialState()
    {
        $this->request = new PathElevationRequest($this->paths, $samples = 10);

        $this->assertTrue($this->request->hasPaths());
        $this->assertSame($this->paths, $this->request->getPaths());
        $this->assertSame($samples, $this->request->getSamples());
    }

    public function testSetPaths()
    {
        $this->request->setPaths($paths = [$path = $this->createLocationMock()]);
        $this->request->setPaths($paths);

        $this->assertTrue($this->request->hasPaths());
        $this->assertTrue($this->request->hasPath($path));
        $this->assertSame($paths, $this->request->getPaths());
    }

    public function testAddPaths()
    {
        $this->request->setPaths($firstPaths = [$this->createLocationMock()]);
        $this->request->addPaths($secondPaths = [$this->createLocationMock()]);

        $this->assertTrue($this->request->hasPaths());
        $this->assertSame(array_merge($firstPaths, $secondPaths), $this->request->getPaths());
    }

    public function testAddPath()
    {
        $this->request->addPath($path = $this->createLocationMock());

        $this->assertTrue($this->request->hasPaths());
        $this->assertTrue($this->request->hasPath($path));
        $this->assertSame(array_merge($this->paths, [$path]), $this->request->getPaths());
    }

    public function testRemovePath()
    {
        $this->request->addPath($path = $this->createLocationMock());
        $this->request->removePath($path);

        $this->assertTrue($this->request->hasPaths());
        $this->assertFalse($this->request->hasPath($path));
        $this->assertSame($this->paths, $this->request->getPaths());
    }

    public function testSamples()
    {
        $this->request->setSamples($samples = 10);

        $this->assertSame($samples, $this->request->getSamples());
    }

    public function testBuildQuery()
    {
        $this->assertSame([
            'path'    => 'first|second',
            'samples' => 3,
        ], $this->request->buildQuery());
    }

    /**
     * @param string $value
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|LocationInterface
     */
    private function createLocationMock($value = 'value')
    {
        $location = $this->createMock(LocationInterface::class);
        $location
            ->expects($this->any())
            ->method('buildQuery')
            ->will($this->returnValue($value));

        return $location;
    }
}
