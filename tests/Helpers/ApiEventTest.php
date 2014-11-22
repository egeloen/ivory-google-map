<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers;

use Ivory\GoogleMap\Helpers\ApiEvent;

/**
 * Api event test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiEventTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\ApiEvent */
    private $apiEvent;

    /** @var \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject */
    private $map;

    /** @var \Ivory\GoogleMap\Places\Autocomplete|\PHPUnit_Framework_MockObject_MockObject */
    private $autocomplete;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->apiEvent = new ApiEvent(array(
            $this->map = $this->createMapMock(),
            $this->autocomplete = $this->createAutocompleteMock(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->autocomplete);
        unset($this->map);
        unset($this->apiEvent);
    }

    public function testInheritance()
    {
        $this->assertSymfonyEventInstance($this->apiEvent);
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->apiEvent->hasItems());
        $this->assertSame(array($this->map, $this->autocomplete), $this->apiEvent->getItems());

        $this->assertSame('en', $this->apiEvent->getLanguage());
        $this->assertFalse($this->apiEvent->hasSources());
        $this->assertFalse($this->apiEvent->hasLibraries());
        $this->assertFalse($this->apiEvent->hasCallbacks());
    }

    public function testGetItems()
    {
        $this->assertTrue($this->apiEvent->hasItems(ApiEvent::MAP));
        $this->assertSame(array($this->map), $this->apiEvent->getItems(ApiEvent::MAP));

        $this->assertTrue($this->apiEvent->hasItems(ApiEvent::PLACES_AUTOCOMPLETE));
        $this->assertSame(array($this->autocomplete), $this->apiEvent->getItems(ApiEvent::PLACES_AUTOCOMPLETE));

        $this->assertFalse($this->apiEvent->hasItems('foo'));
        $this->assertEmpty($this->apiEvent->getItems('foo'));
    }

    public function testSetLanguage()
    {
        $this->apiEvent->setLanguage($language = 'fr');

        $this->assertSame($language, $this->apiEvent->getLanguage());
    }

    public function testSetSources()
    {
        $this->apiEvent->setSources($sources = array('foo'));

        $this->assertSources($sources);
    }

    public function testAddSources()
    {
        $this->apiEvent->setSources($sources = array('foo'));
        $this->apiEvent->addSources($newSources = array('bar'));

        $this->assertSources(array_merge($sources, $newSources));
    }

    public function testRemoveSources()
    {
        $this->apiEvent->setSources($sources = array('foo'));
        $this->apiEvent->removeSources($sources);

        $this->assertNoSources();
    }

    public function testResetSources()
    {
        $this->apiEvent->setSources(array('foo'));
        $this->apiEvent->resetSources();

        $this->assertNoSources();
    }

    public function testAddSource()
    {
        $this->apiEvent->addSource($source = 'foo');

        $this->assertSource($source);
    }

    public function testAddSourceUnicity()
    {
        $this->apiEvent->resetSources();
        $this->apiEvent->addSource($source = 'foo');
        $this->apiEvent->addSource($source);

        $this->assertSources(array($source));
    }

    public function testRemoveSource()
    {
        $this->apiEvent->addSource($source = 'foo');
        $this->apiEvent->removeSource($source);

        $this->assertNoSource($source);
    }

    public function testSetLibraries()
    {
        $this->apiEvent->setLibraries($libraries = array('foo'));

        $this->assertLibraries($libraries);
    }

    public function testAddLibraries()
    {
        $this->apiEvent->setLibraries($libraries = array('foo'));
        $this->apiEvent->addLibraries($newLibraries = array('bar'));

        $this->assertLibraries(array_merge($libraries, $newLibraries));
    }

    public function testRemoveLibraries()
    {
        $this->apiEvent->setLibraries($libraries = array('foo'));
        $this->apiEvent->removeLibraries($libraries);

        $this->assertNoLibraries();
    }

    public function testResetLibraries()
    {
        $this->apiEvent->setLibraries(array('foo'));
        $this->apiEvent->resetLibraries();

        $this->assertNoLibraries();
    }

    public function testAddLibrary()
    {
        $this->apiEvent->addLibrary($library = 'foo');

        $this->assertLibrary($library);
    }

    public function testAddLibraryUnicity()
    {
        $this->apiEvent->resetLibraries();
        $this->apiEvent->addLibrary($library = 'foo');
        $this->apiEvent->addLibrary($library);

        $this->assertLibraries(array($library));
    }

    public function testRemoveLibrary()
    {
        $this->apiEvent->addLibrary($library = 'foo');
        $this->apiEvent->removeLibrary($library);

        $this->assertNoLibrary($library);
    }

    public function testSetCallbacks()
    {
        $this->apiEvent->setCallbacks($callbacks = array('foo'));

        $this->assertCallbacks($callbacks);
    }

    public function testAddCallbacks()
    {
        $this->apiEvent->setCallbacks($callbacks = array('foo'));
        $this->apiEvent->addCallbacks($newCallbacks = array('bar'));

        $this->assertCallbacks(array_merge($callbacks, $newCallbacks));
    }

    public function testRemoveCallbacks()
    {
        $this->apiEvent->setCallbacks($callbacks = array('foo'));
        $this->apiEvent->removeCallbacks($callbacks);

        $this->assertNoCallbacks();
    }

    public function testResetCallbacks()
    {
        $this->apiEvent->setCallbacks(array('foo'));
        $this->apiEvent->resetCallbacks();

        $this->assertNoCallbacks();
    }

    public function testAddCallback()
    {
        $this->apiEvent->addCallback($callback = 'foo');

        $this->assertCallback($callback);
    }

    public function testAddCallbackUnicity()
    {
        $this->apiEvent->resetCallbacks();
        $this->apiEvent->addCallback($callback = 'foo');
        $this->apiEvent->addCallback($callback);

        $this->assertCallbacks(array($callback));
    }

    public function testRemoveCallback()
    {
        $this->apiEvent->addCallback($callback = 'foo');
        $this->apiEvent->removeCallback($callback);

        $this->assertNoCallback($callback);
    }

    /**
     * Asserts there are sources.
     *
     * @param array $sources The sources.
     */
    private function assertSources($sources)
    {
        $this->assertInternalType('array', $sources);

        $this->assertTrue($this->apiEvent->hasSources());
        $this->assertSame($sources, $this->apiEvent->getSources());

        foreach ($sources as $source) {
            $this->assertSource($source);
        }
    }

    /**
     * Asserts there is a source.
     *
     * @param string $source The source.
     */
    private function assertSource($source)
    {
        $this->assertTrue($this->apiEvent->hasSource($source));
    }

    /**
     * Asserts there are no sources.
     */
    private function assertNoSources()
    {
        $this->assertFalse($this->apiEvent->hasSources());
        $this->assertEmpty($this->apiEvent->getSources());
    }

    /**
     * Asserts there is no source.
     *
     * @param string $source The source.
     */
    private function assertNoSource($source)
    {
        $this->assertFalse($this->apiEvent->hasSource($source));
    }

    /**
     * Asserts there are libraries.
     *
     * @param array $libraries The libraries.
     */
    private function assertLibraries($libraries)
    {
        $this->assertInternalType('array', $libraries);

        $this->assertTrue($this->apiEvent->hasLibraries());
        $this->assertSame($libraries, $this->apiEvent->getLibraries());

        foreach ($libraries as $library) {
            $this->assertLibrary($library);
        }
    }

    /**
     * Asserts there is a library.
     *
     * @param string $library The library.
     */
    private function assertLibrary($library)
    {
        $this->assertTrue($this->apiEvent->hasLibrary($library));
    }

    /**
     * Asserts there are no libraries.
     */
    private function assertNoLibraries()
    {
        $this->assertFalse($this->apiEvent->hasLibraries());
        $this->assertEmpty($this->apiEvent->getLibraries());
    }

    /**
     * Asserts there is no library.
     *
     * @param string $library The library.
     */
    private function assertNoLibrary($library)
    {
        $this->assertFalse($this->apiEvent->hasLibrary($library));
    }

    /**
     * Asserts there are callbacks.
     *
     * @param array $callbacks The callbacks.
     */
    private function assertCallbacks($callbacks)
    {
        $this->assertInternalType('array', $callbacks);

        $this->assertTrue($this->apiEvent->hasCallbacks());
        $this->assertSame($callbacks, $this->apiEvent->getCallbacks());

        foreach ($callbacks as $callback) {
            $this->assertCallback($callback);
        }
    }

    /**
     * Asserts there is a callback.
     *
     * @param string $callback The callback.
     */
    private function assertCallback($callback)
    {
        $this->assertTrue($this->apiEvent->hasCallback($callback));
    }

    /**
     * Asserts there are no callbacks.
     */
    private function assertNoCallbacks()
    {
        $this->assertFalse($this->apiEvent->hasCallbacks());
        $this->assertEmpty($this->apiEvent->getCallbacks());
    }

    /**
     * Asserts there is no callback.
     *
     * @param string $callback The callback.
     */
    private function assertNoCallback($callback)
    {
        $this->assertFalse($this->apiEvent->hasCallback($callback));
    }
}
