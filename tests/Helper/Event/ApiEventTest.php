<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Event;

use Ivory\GoogleMap\Helper\Event\AbstractEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ApiEvent
     */
    private $apiEvent;

    /**
     * @var object[]
     */
    private $objects;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->objects = [new \stdClass(), new \stdClass()];
        $this->apiEvent = new ApiEvent($this->objects);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractEvent::class, $this->apiEvent);
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->apiEvent->hasObjects());
        $this->assertSame($this->objects, $this->apiEvent->getObjects());
        $this->assertFalse($this->apiEvent->hasSources());
        $this->assertEmpty($this->apiEvent->getSources());
        $this->assertFalse($this->apiEvent->hasLibraries());
        $this->assertEmpty($this->apiEvent->getLibraries());
        $this->assertFalse($this->apiEvent->hasCallbacks());
        $this->assertEmpty($this->apiEvent->getCallbacks());
        $this->assertFalse($this->apiEvent->hasRequirements());
        $this->assertEmpty($this->apiEvent->getRequirements());
    }

    public function testObjects()
    {
        $this->assertTrue($this->apiEvent->hasObjects(\stdClass::class));
        $this->assertSame($this->objects, $this->apiEvent->getObjects(\stdClass::class));

        $this->assertFalse($this->apiEvent->hasObjects(Map::class));
        $this->assertEmpty($this->apiEvent->getObjects(Map::class));
    }

    public function testSetSources()
    {
        $this->apiEvent->setSources($sources = [$source = 'source']);
        $this->apiEvent->setSources($sources);

        $this->assertTrue($this->apiEvent->hasSources());
        $this->assertTrue($this->apiEvent->hasSource($source));
        $this->assertSame($sources, $this->apiEvent->getSources());
    }

    public function testAddSources()
    {
        $this->apiEvent->setSources($firstSources = ['source1']);
        $this->apiEvent->addSources($secondSources = ['source2']);

        $this->assertTrue($this->apiEvent->hasSources());
        $this->assertSame(array_merge($firstSources, $secondSources), $this->apiEvent->getSources());
    }

    public function testAddSource()
    {
        $this->apiEvent->addSource($source = 'source');

        $this->assertTrue($this->apiEvent->hasSources());
        $this->assertTrue($this->apiEvent->hasSource($source));
        $this->assertSame([$source], $this->apiEvent->getSources());
    }

    public function testRemoveSource()
    {
        $this->apiEvent->addSource($source = 'source');
        $this->apiEvent->removeSource($source);

        $this->assertFalse($this->apiEvent->hasSources());
        $this->assertFalse($this->apiEvent->hasSource($source));
        $this->assertEmpty($this->apiEvent->getSources());
    }

    public function testSetLibraries()
    {
        $this->apiEvent->setLibraries($libraries = [$library = 'library']);
        $this->apiEvent->setLibraries($libraries);

        $this->assertTrue($this->apiEvent->hasLibraries());
        $this->assertTrue($this->apiEvent->hasLibrary($library));
        $this->assertSame($libraries, $this->apiEvent->getLibraries());
    }

    public function testAddLibraries()
    {
        $this->apiEvent->setLibraries($firstLibraries = ['library1']);
        $this->apiEvent->addLibraries($secondLibraries = ['library2']);

        $this->assertTrue($this->apiEvent->hasLibraries());
        $this->assertSame(array_merge($firstLibraries, $secondLibraries), $this->apiEvent->getLibraries());
    }

    public function testAddLibrary()
    {
        $this->apiEvent->addLibrary($library = 'library');

        $this->assertTrue($this->apiEvent->hasLibraries());
        $this->assertTrue($this->apiEvent->hasLibrary($library));
        $this->assertSame([$library], $this->apiEvent->getLibraries());
    }

    public function testRemoveLibrary()
    {
        $this->apiEvent->addLibrary($library = 'library');
        $this->apiEvent->removeLibrary($library);

        $this->assertFalse($this->apiEvent->hasLibraries());
        $this->assertFalse($this->apiEvent->hasLibrary($library));
        $this->assertEmpty($this->apiEvent->getLibraries());
    }

    public function testAddCallback()
    {
        $this->apiEvent->addCallback(new \stdClass(), 'callback1');
        $this->apiEvent->addCallback($object = new \stdClass(), $callback = 'callback2');

        $this->assertTrue($this->apiEvent->hasCallbacks());
        $this->assertTrue($this->apiEvent->hasCallback($callback));
        $this->assertTrue($this->apiEvent->hasCallback($callback, $object));
        $this->assertTrue($this->apiEvent->hasCallbackObject($object));
        $this->assertTrue($this->apiEvent->hasCallbackObject($object, $callback));
        $this->assertSame($callback, $this->apiEvent->getCallback($object));
        $this->assertSame($object, $this->apiEvent->getCallbackObject($callback));
    }

    public function testRemoveCallback()
    {
        $this->apiEvent->addCallback($object = new \stdClass(), $callback = 'callback');
        $this->apiEvent->removeCallback($callback);

        $this->assertFalse($this->apiEvent->hasCallbacks());
        $this->assertFalse($this->apiEvent->hasCallback($callback));
        $this->assertFalse($this->apiEvent->hasCallback($callback, $object));
        $this->assertFalse($this->apiEvent->hasCallbackObject($object));
        $this->assertFalse($this->apiEvent->hasCallbackObject($object, $callback));
        $this->assertNull($this->apiEvent->getCallback($object));
        $this->assertNull($this->apiEvent->getCallbackObject($callback));
    }

    public function testSetRequirements()
    {
        $this->apiEvent->setRequirements($object = new \stdClass(), $requirements = [$requirement = 'requirement']);
        $this->apiEvent->setRequirements($object, $requirements);

        $this->assertTrue($this->apiEvent->hasRequirements());
        $this->assertTrue($this->apiEvent->hasRequirements($object));
        $this->assertTrue($this->apiEvent->hasRequirement($object));
        $this->assertTrue($this->apiEvent->hasRequirement($object, $requirement));
        $this->assertSame($requirements, $this->apiEvent->getRequirementsObject($object));
    }

    public function testAddRequirements()
    {
        $this->apiEvent->setRequirements($object = new \stdClass(), $firstRequirements = ['requirement1']);
        $this->apiEvent->addRequirements($object, $secondRequirements = ['requirement2']);

        $this->assertTrue($this->apiEvent->hasRequirements());
        $this->assertTrue($this->apiEvent->hasRequirements($object));
        $this->assertTrue($this->apiEvent->hasRequirement($object));
        $this->assertSame(
            array_merge($firstRequirements, $secondRequirements),
            $this->apiEvent->getRequirementsObject($object)
        );
    }

    public function testAddRequirement()
    {
        $this->apiEvent->addRequirement($object = new \stdClass(), $requirement = 'requirement');

        $this->assertTrue($this->apiEvent->hasRequirements());
        $this->assertTrue($this->apiEvent->hasRequirements($object));
        $this->assertTrue($this->apiEvent->hasRequirement($object));
        $this->assertTrue($this->apiEvent->hasRequirement($object, $requirement));
        $this->assertSame([$requirement], $this->apiEvent->getRequirementsObject($object));
    }

    public function testRemoveRequirement()
    {
        $this->apiEvent->addRequirement($object = new \stdClass(), $requirement1 = 'requirement1');
        $this->apiEvent->addRequirement($object, $requirement2 = 'requirement2');
        $this->apiEvent->removeRequirement($object, $requirement2);

        $this->assertTrue($this->apiEvent->hasRequirements());
        $this->assertTrue($this->apiEvent->hasRequirements($object));
        $this->assertTrue($this->apiEvent->hasRequirement($object));
        $this->assertTrue($this->apiEvent->hasRequirement($object, $requirement1));
        $this->assertFalse($this->apiEvent->hasRequirement($object, $requirement2));
        $this->assertSame([$requirement1], $this->apiEvent->getRequirementsObject($object));

        $this->apiEvent->removeRequirement($object, $requirement1);

        $this->assertFalse($this->apiEvent->hasRequirements());
        $this->assertFalse($this->apiEvent->hasRequirements($object));
        $this->assertFalse($this->apiEvent->hasRequirement($object));
        $this->assertFalse($this->apiEvent->hasRequirement($object, $requirement1));
        $this->assertEmpty($this->apiEvent->getRequirementsObject($object));
    }
}
