<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Place;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Event\EventManager;
use Ivory\GoogleMap\Place\Autocomplete;
use Ivory\GoogleMap\Place\AutocompleteComponentType;
use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Autocomplete
     */
    private $autocomplete;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocomplete = new Autocomplete();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(VariableAwareInterface::class, $this->autocomplete);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('place_autocomplete', $this->autocomplete->getVariable());
        $this->assertSame('place_input', $this->autocomplete->getHtmlId());
        $this->assertInstanceOf(EventManager::class, $this->autocomplete->getEventManager());
        $this->assertFalse($this->autocomplete->hasBound());
        $this->assertNull($this->autocomplete->getBound());
        $this->assertFalse($this->autocomplete->hasTypes());
        $this->assertEmpty($this->autocomplete->getTypes());
        $this->assertFalse($this->autocomplete->hasComponents());
        $this->assertEmpty($this->autocomplete->getComponents());
        $this->assertFalse($this->autocomplete->hasValue());
        $this->assertNull($this->autocomplete->getValue());
        $this->assertFalse($this->autocomplete->hasInputAttributes());
        $this->assertEmpty($this->autocomplete->getInputAttributes());
        $this->assertFalse($this->autocomplete->hasLibraries());
        $this->assertEmpty($this->autocomplete->getLibraries());
    }

    public function testInputId()
    {
        $this->autocomplete->setInputId($inputId = 'input');

        $this->assertSame($inputId, $this->autocomplete->getHtmlId());
    }

    public function testEventManager()
    {
        $this->autocomplete->setEventManager($eventManager = $this->createEventManagerMock());

        $this->assertSame($eventManager, $this->autocomplete->getEventManager());
    }

    public function testBound()
    {
        $this->autocomplete->setBound($bound = $this->createBoundMock());

        $this->assertTrue($this->autocomplete->hasBound());
        $this->assertSame($bound, $this->autocomplete->getBound());
    }

    public function testResetBound()
    {
        $this->autocomplete->setBound($this->createBoundMock());
        $this->autocomplete->setBound(null);

        $this->assertFalse($this->autocomplete->hasBound());
        $this->assertNull($this->autocomplete->getBound());
    }

    public function testSetTypes()
    {
        $this->autocomplete->setTypes($types = [$type = AutocompleteType::ESTABLISHMENT]);
        $this->autocomplete->setTypes($types);

        $this->assertTrue($this->autocomplete->hasTypes());
        $this->assertTrue($this->autocomplete->hasType($type));
        $this->assertSame($types, $this->autocomplete->getTypes());
    }

    public function testAddTypes()
    {
        $this->autocomplete->setTypes($firstTypes = [AutocompleteType::ESTABLISHMENT]);
        $this->autocomplete->addTypes($secondTypes = [AutocompleteType::CITIES]);

        $this->assertTrue($this->autocomplete->hasTypes());
        $this->assertSame(array_merge($firstTypes, $secondTypes), $this->autocomplete->getTypes());
    }

    public function testAddType()
    {
        $this->autocomplete->addType($type = AutocompleteType::ESTABLISHMENT);

        $this->assertTrue($this->autocomplete->hasTypes());
        $this->assertTrue($this->autocomplete->hasType($type));
        $this->assertSame([$type], $this->autocomplete->getTypes());
    }

    public function testRemoveType()
    {
        $this->autocomplete->addType($type = AutocompleteType::ESTABLISHMENT);
        $this->autocomplete->removeType($type);

        $this->assertFalse($this->autocomplete->hasTypes());
        $this->assertFalse($this->autocomplete->hasType($type));
        $this->assertEmpty($this->autocomplete->getTypes());
    }

    public function testSetComponents()
    {
        $components = [$type = AutocompleteComponentType::COUNTRY => $value = 'fr'];

        $this->autocomplete->setComponents($components);
        $this->autocomplete->setComponents($components);

        $this->assertTrue($this->autocomplete->hasComponents());
        $this->assertTrue($this->autocomplete->hasComponent($type));
        $this->assertSame($components, $this->autocomplete->getComponents());
        $this->assertSame($value, $this->autocomplete->getComponent($type));
    }

    public function testAddComponent()
    {
        $this->autocomplete->setComponents($firstComponents = [AutocompleteComponentType::COUNTRY => 'fr']);
        $this->autocomplete->addComponents($secondComponents = [AutocompleteComponentType::COUNTRY => 'en']);

        $this->assertTrue($this->autocomplete->hasComponents());
        $this->assertSame(
            array_merge($firstComponents, $secondComponents),
            $this->autocomplete->getComponents()
        );
    }

    public function testSetComponent()
    {
        $this->autocomplete->setComponent($type = AutocompleteComponentType::COUNTRY, $value = 'fr');

        $this->assertTrue($this->autocomplete->hasComponents());
        $this->assertTrue($this->autocomplete->hasComponent($type));
        $this->assertSame([$type => $value], $this->autocomplete->getComponents());
        $this->assertSame($value, $this->autocomplete->getComponent($type));
    }

    public function testRemoveComponent()
    {
        $this->autocomplete->setComponent($type = AutocompleteComponentType::COUNTRY, 'fr');
        $this->autocomplete->removeComponent($type);

        $this->assertFalse($this->autocomplete->hasComponents());
        $this->assertFalse($this->autocomplete->hasComponent($type));
        $this->assertEmpty($this->autocomplete->getComponents());
        $this->assertNull($this->autocomplete->getComponent($type));
    }

    public function testSetInputAttributes()
    {
        $this->autocomplete->setInputAttributes($inputAttributes = [$name = 'foo' => $value = 'bar']);
        $this->autocomplete->setInputAttributes($inputAttributes);

        $this->assertTrue($this->autocomplete->hasInputAttributes());
        $this->assertTrue($this->autocomplete->hasInputAttribute($name));
        $this->assertSame($inputAttributes, $this->autocomplete->getInputAttributes());
        $this->assertSame($value, $this->autocomplete->getInputAttribute($name));
    }

    public function testAddInputAttributes()
    {
        $this->autocomplete->setInputAttributes($firstInputAttributes = ['foo' => 'bar']);
        $this->autocomplete->addInputAttributes($secondInputAttributes = ['baz' => 'bat']);

        $this->assertTrue($this->autocomplete->hasInputAttributes());
        $this->assertSame(
            array_merge($firstInputAttributes, $secondInputAttributes),
            $this->autocomplete->getInputAttributes()
        );
    }

    public function testAddInputAttribute()
    {
        $this->autocomplete->setInputAttribute($name = 'foo', $value = 'bar');

        $this->assertTrue($this->autocomplete->hasInputAttributes());
        $this->assertTrue($this->autocomplete->hasInputAttribute($name));
        $this->assertSame([$name => $value], $this->autocomplete->getInputAttributes());
        $this->assertSame($value, $this->autocomplete->getInputAttribute($name));
    }

    public function testRemoveInputAttribute()
    {
        $this->autocomplete->setInputAttribute($name = 'foo', 'bar');
        $this->autocomplete->removeInputAttribute($name);

        $this->assertFalse($this->autocomplete->hasInputAttributes());
        $this->assertFalse($this->autocomplete->hasInputAttribute($name));
        $this->assertEmpty($this->autocomplete->getInputAttributes());
        $this->assertNull($this->autocomplete->getInputAttribute($name));
    }

    public function testSetLibraries()
    {
        $this->autocomplete->setLibraries($libraries = [$library = 'geometry']);
        $this->autocomplete->setLibraries($libraries);

        $this->assertTrue($this->autocomplete->hasLibraries());
        $this->assertTrue($this->autocomplete->hasLibrary($library));
        $this->assertSame($libraries, $this->autocomplete->getLibraries());
    }

    public function testAddLibraries()
    {
        $this->autocomplete->setLibraries($firstLibraries = ['geometry']);
        $this->autocomplete->addLibraries($secondLibraries = ['places']);

        $this->assertTrue($this->autocomplete->hasLibraries());
        $this->assertSame(array_merge($firstLibraries, $secondLibraries), $this->autocomplete->getLibraries());
    }

    public function testAddLibrary()
    {
        $this->autocomplete->addLibrary($library = 'geometry');

        $this->assertTrue($this->autocomplete->hasLibraries());
        $this->assertTrue($this->autocomplete->hasLibrary($library));
        $this->assertSame([$library], $this->autocomplete->getLibraries());
    }

    public function testRemoveLibrary()
    {
        $this->autocomplete->addLibrary($library = 'geometry');
        $this->autocomplete->removeLibrary($library);

        $this->assertFalse($this->autocomplete->hasLibraries());
        $this->assertFalse($this->autocomplete->hasLibrary($library));
        $this->assertEmpty($this->autocomplete->getLibraries());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EventManager
     */
    private function createEventManagerMock()
    {
        return $this->createMock(EventManager::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }
}
