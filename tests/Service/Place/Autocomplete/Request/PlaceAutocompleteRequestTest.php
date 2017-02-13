<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Autocomplete\Request;

use Ivory\GoogleMap\Place\AutocompleteComponentType;
use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\AbstractPlaceAutocompleteRequest;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceAutocompleteRequest
     */
    private $request;

    /**
     * @var string
     */
    private $input;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new PlaceAutocompleteRequest($this->input = 'input');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractPlaceAutocompleteRequest::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->input, $this->request->getInput());
        $this->assertFalse($this->request->hasOffset());
        $this->assertNull($this->request->getOffset());
        $this->assertFalse($this->request->hasLocation());
        $this->assertNull($this->request->getLocation());
        $this->assertFalse($this->request->hasRadius());
        $this->assertNull($this->request->getRadius());
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
        $this->assertFalse($this->request->hasTypes());
        $this->assertEmpty($this->request->getTypes());
        $this->assertFalse($this->request->hasComponents());
        $this->assertEmpty($this->request->getComponents());
    }

    public function testSetTypes()
    {
        $this->request->setTypes($types = [$type = AutocompleteType::ESTABLISHMENT]);
        $this->request->setTypes($types);

        $this->assertTrue($this->request->hasTypes());
        $this->assertTrue($this->request->hasType($type));
        $this->assertSame($types, $this->request->getTypes());
    }

    public function testAddTypes()
    {
        $this->request->setTypes($firstTypes = [AutocompleteType::ESTABLISHMENT]);
        $this->request->addTypes($secondTypes = [AutocompleteType::CITIES]);

        $this->assertTrue($this->request->hasTypes());
        $this->assertSame(array_merge($firstTypes, $secondTypes), $this->request->getTypes());
    }

    public function testAddType()
    {
        $this->request->addType($type = AutocompleteType::ESTABLISHMENT);

        $this->assertTrue($this->request->hasTypes());
        $this->assertTrue($this->request->hasType($type));
        $this->assertSame([$type], $this->request->getTypes());
    }

    public function testRemoveType()
    {
        $this->request->addType($type = AutocompleteType::ESTABLISHMENT);
        $this->request->removeType($type);

        $this->assertFalse($this->request->hasTypes());
        $this->assertFalse($this->request->hasType($type));
        $this->assertEmpty($this->request->getTypes());
    }

    public function testSetComponents()
    {
        $components = [$type = AutocompleteComponentType::COUNTRY => $value = 'fr'];

        $this->request->setComponents($components);
        $this->request->setComponents($components);

        $this->assertTrue($this->request->hasComponents());
        $this->assertTrue($this->request->hasComponent($type));
        $this->assertSame($components, $this->request->getComponents());
        $this->assertSame($value, $this->request->getComponent($type));
    }

    public function testAddComponent()
    {
        $this->request->setComponents($firstComponents = [AutocompleteComponentType::COUNTRY => 'fr']);
        $this->request->addComponents($secondComponents = [AutocompleteComponentType::COUNTRY => 'en']);

        $this->assertTrue($this->request->hasComponents());
        $this->assertSame(
            array_merge($firstComponents, $secondComponents),
            $this->request->getComponents()
        );
    }

    public function testSetComponent()
    {
        $this->request->setComponent($type = AutocompleteComponentType::COUNTRY, $value = 'fr');

        $this->assertTrue($this->request->hasComponents());
        $this->assertTrue($this->request->hasComponent($type));
        $this->assertSame([$type => $value], $this->request->getComponents());
        $this->assertSame($value, $this->request->getComponent($type));
    }

    public function testRemoveComponent()
    {
        $this->request->setComponent($type = AutocompleteComponentType::COUNTRY, 'fr');
        $this->request->removeComponent($type);

        $this->assertFalse($this->request->hasComponents());
        $this->assertFalse($this->request->hasComponent($type));
        $this->assertEmpty($this->request->getComponents());
        $this->assertNull($this->request->getComponent($type));
    }

    public function testBuildQueryWithTypes()
    {
        $this->request->setTypes([$type = AutocompleteType::ESTABLISHMENT]);

        $this->assertSame([
            'input' => $this->input,
            'types' => $type,
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithComponents()
    {
        $this->request->setComponents([$component = AutocompleteComponentType::COUNTRY => $value = 'fr']);

        $this->assertSame([
            'input'      => $this->input,
            'components' => $component.':'.$value,
        ], $this->request->buildQuery());
    }
}
