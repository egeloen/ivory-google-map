<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Places;

use Ivory\GoogleMap\Places\Autocomplete;
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Places\AutocompleteType;
use Ivory\Tests\GoogleMap\AbstractTestCase;

/**
 * Autocomplete test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Places\Autocomplete */
    private $autocomplete;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocomplete = new Autocomplete();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->autocomplete);
    }

    public function testInheritance()
    {
        $this->assertVariableAssetInstance($this->autocomplete);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('places_autocomplete_', $this->autocomplete->getVariable());
        $this->assertSame($this->autocomplete->getVariable(), $this->autocomplete->getInputId());
        $this->assertNoInputAttributes();
        $this->assertNoValue();
        $this->assertNoBound();
        $this->assertNoTypes();
        $this->assertNoComponentRestrictions();
        $this->assertSame('en', $this->autocomplete->getLanguage());
    }

    public function testSetInputId()
    {
        $this->autocomplete->setInputId($inputId = 'foo');

        $this->assertSame($inputId, $this->autocomplete->getInputId());
    }

    public function testSetInputAttributes()
    {
        $this->autocomplete->setInputAttributes($inputAttributes = array('foo' => 'bar'));

        $this->assertInputAttributes($inputAttributes);
    }

    public function testAddInputAttributes()
    {
        $this->autocomplete->setInputAttributes($inputAttributes = array('foo' => 'bar'));
        $this->autocomplete->addInputAttributes($newInputAttributes = array('baz' => 'bat'));

        $this->assertInputAttributes(array_merge($inputAttributes, $newInputAttributes));
    }

    public function testRemoveInputAttributes()
    {
        $this->autocomplete->setInputAttributes($inputAttributes = array('foo' => 'bar'));
        $this->autocomplete->removeInputAttributes(array_keys($inputAttributes));

        $this->assertNoInputAttributes();
    }

    public function testResetInputAttributes()
    {
        $this->autocomplete->setInputAttributes(array('foo' => 'bar'));
        $this->autocomplete->resetInputAttributes();

        $this->assertNoInputAttributes();
    }

    public function testSetInputAttribute()
    {
        $this->autocomplete->setInputAttribute($name = 'foo', $value = 'bar');

        $this->assertInputAttribute($name, $value);
    }

    public function testRemoveInputAttribute()
    {
        $this->autocomplete->setInputAttribute($name = 'foo', 'bar');
        $this->autocomplete->removeInputAttribute($name);

        $this->assertNoInputAttribute($name);
    }

    public function testValue()
    {
        $this->autocomplete->setValue($value = 'value');

        $this->assertValue($value);
    }

    public function testResetValue()
    {
        $this->autocomplete->setValue('value');
        $this->autocomplete->setValue(null);

        $this->assertNoValue();
    }

    public function testSetBound()
    {
        $this->autocomplete->setBound($bound = $this->createBoundMock());

        $this->assertBound($bound);
    }

    public function testResetBound()
    {
        $this->autocomplete->setBound($this->createBoundMock());
        $this->autocomplete->setBound(null);

        $this->assertNoBound();
    }

    public function testSetTypes()
    {
        $this->autocomplete->setTypes($types = array(AutocompleteType::CITIES));

        $this->assertTypes($types);
    }

    public function testAddTypes()
    {
        $this->autocomplete->setTypes($types = array(AutocompleteType::CITIES));
        $this->autocomplete->addTypes($newTypes = array(AutocompleteType::ESTABLISHMENT));

        $this->assertTypes(array_merge($types, $newTypes));
    }

    public function testRemoveTypes()
    {
        $this->autocomplete->setTypes($types = array(AutocompleteType::CITIES));
        $this->autocomplete->removeTypes($types);

        $this->assertNoTypes();
    }

    public function testResetTypes()
    {
        $this->autocomplete->setTypes(array(AutocompleteType::CITIES));
        $this->autocomplete->resetTypes();

        $this->assertNoTypes();
    }

    public function testAddType()
    {
        $this->autocomplete->addType($type = AutocompleteType::CITIES);

        $this->assertType($type);
    }

    public function testAddTypeUnicity()
    {
        $this->autocomplete->resetTypes();
        $this->autocomplete->addType($type = AutocompleteType::CITIES);
        $this->autocomplete->addType($type);

        $this->assertTypes(array($type));
    }

    public function testRemoveType()
    {
        $this->autocomplete->addType($type = AutocompleteType::CITIES);
        $this->autocomplete->removeType($type);

        $this->assertNoType($type);
    }

    public function testSetComponentRestrictions()
    {
        $this->autocomplete->setComponentRestrictions(
            $componentRestrictions = array(AutocompleteComponentRestriction::COUNTRY => 'france')
        );

        $this->assertComponentRestrictions($componentRestrictions);
    }

    public function testAddComponentRestrictions()
    {
        $this->autocomplete->setComponentRestrictions(
            $componentRestrictions = array(AutocompleteComponentRestriction::COUNTRY => 'france')
        );

        $this->autocomplete->addComponentRestrictions($newComponentRestrictions = array('bar' => 'baz'));

        $this->assertComponentRestrictions(array_merge($componentRestrictions, $newComponentRestrictions));
    }

    public function testRemoveComponentRestrictions()
    {
        $this->autocomplete->setComponentRestrictions(
            $componentRestrictions = array(AutocompleteComponentRestriction::COUNTRY => 'france')
        );

        $this->autocomplete->removeComponentRestrictions(array_keys($componentRestrictions));

        $this->assertNoComponentRestrictions();
    }

    public function testResetComponentRestrictions()
    {
        $this->autocomplete->setComponentRestrictions(array(AutocompleteComponentRestriction::COUNTRY => 'france'));
        $this->autocomplete->resetComponentRestrictions();

        $this->assertNoComponentRestrictions();
    }

    public function testSetComponentRestriction()
    {
        $this->autocomplete->setComponentRestriction($name = AutocompleteComponentRestriction::COUNTRY, $value = 'france');

        $this->assertComponentRestriction($name, $value);
    }

    public function testRemoveComponentRestriction()
    {
        $this->autocomplete->setComponentRestriction($name = AutocompleteComponentRestriction::COUNTRY, 'france');
        $this->autocomplete->removeComponentRestriction($name);

        $this->assertNoComponentRestriction($name);
    }

    public function testSetLanguage()
    {
        $this->autocomplete->setLanguage($language = 'fr');

        $this->assertSame($language, $this->autocomplete->getLanguage());
    }

    /**
     * Asserts there are input attributes.
     *
     * @param array $inputAttributes The input attributes.
     */
    private function assertInputAttributes($inputAttributes)
    {
        $this->assertInternalType('array', $inputAttributes);

        $this->assertTrue($this->autocomplete->hasInputAttributes());
        $this->assertSame($inputAttributes, $this->autocomplete->getInputAttributes());

        foreach ($inputAttributes as $name => $value) {
            $this->assertInputAttribute($name, $value);
        }
    }

    /**
     * Asserts there is an input attribute.
     *
     * @param string $name  The input attribute name.
     * @param string $value The input attribute value.
     */
    private function assertInputAttribute($name, $value)
    {
        $this->assertTrue($this->autocomplete->hasInputAttribute($name));
        $this->assertSame($value, $this->autocomplete->getInputAttribute($name));
    }

    /**
     * Asserts there is a value.
     *
     * @param string $value The value.
     */
    private function assertValue($value)
    {
        $this->assertTrue($this->autocomplete->hasValue());
        $this->assertSame($value, $this->autocomplete->getValue());
    }

    /**
     * Asserts there is a bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     */
    private function assertBound($bound)
    {
        $this->assertBoundInstance($bound);

        $this->assertTrue($this->autocomplete->hasBound());
        $this->assertSame($bound, $this->autocomplete->getBound());
    }

    /**
     * Asserts there are types.
     *
     * @param array $types The types.
     */
    private function assertTypes($types)
    {
        $this->assertInternalType('array', $types);

        $this->assertTrue($this->autocomplete->hasTypes());
        $this->assertSame($types, $this->autocomplete->getTypes());

        foreach ($types as $type) {
            $this->assertType($type);
        }
    }

    /**
     * Asserts there is a type.
     *
     * @param string $type The type.
     */
    private function assertType($type)
    {
        $this->assertTrue($this->autocomplete->hasType($type));
    }

    /**
     * Asserts there are component restrictions.
     *
     * @param array $componentRestrictions The component restrictions.
     */
    private function assertComponentRestrictions($componentRestrictions)
    {
        $this->assertInternalType('array', $componentRestrictions);

        $this->assertTrue($this->autocomplete->hasComponentRestrictions());
        $this->assertSame($componentRestrictions, $this->autocomplete->getComponentRestrictions());

        foreach ($componentRestrictions as $name => $value) {
            $this->assertComponentRestriction($name, $value);
        }
    }

    /**
     * Asserts there is a component restriction.
     *
     * @param string $name  The component restriction name.
     * @param string $value The component restriction value.
     */
    private function assertComponentRestriction($name, $value)
    {
        $this->assertTrue($this->autocomplete->hasComponentRestriction($name));
        $this->assertSame($value, $this->autocomplete->getComponentRestriction($name));
    }

    /**
     * Asserts there are no input attributes.
     */
    private function assertNoInputAttributes()
    {
        $this->assertFalse($this->autocomplete->hasInputAttributes());
        $this->assertEmpty($this->autocomplete->getInputAttributes());
    }

    /**
     * Asserts there is no input attribute.
     *
     * @param string $name The input attribute name.
     */
    private function assertNoInputAttribute($name)
    {
        $this->assertFalse($this->autocomplete->hasInputAttribute($name));
        $this->assertNull($this->autocomplete->getInputAttribute($name));
    }

    /**
     * Asserts there is no value.
     */
    private function assertNoValue()
    {
        $this->assertFalse($this->autocomplete->hasValue());
        $this->assertNull($this->autocomplete->getValue());
    }

    /**
     * Asserts there is no bound.
     */
    private function assertNoBound()
    {
        $this->assertFalse($this->autocomplete->hasBound());
        $this->assertNull($this->autocomplete->getBound());
    }

    /**
     * Asserts there are no types.
     */
    private function assertNoTypes()
    {
        $this->assertFalse($this->autocomplete->hasTypes());
        $this->assertEmpty($this->autocomplete->getTypes());
    }

    /**
     * Asserts there is no type.
     *
     * @param string $type The type.
     */
    private function assertNoType($type)
    {
        $this->assertFalse($this->autocomplete->hasType($type));
    }

    /**
     * Asserts there are no component restrictions.
     */
    private function assertNoComponentRestrictions()
    {
        $this->assertFalse($this->autocomplete->hasComponentRestrictions());
        $this->assertEmpty($this->autocomplete->getComponentRestrictions());
    }

    /**
     * Asserts there is no component restriction.
     *
     * @param string $name The component restriction name.
     */
    private function assertNoComponentRestriction($name)
    {
        $this->assertFalse($this->autocomplete->hasComponentRestriction($name));
        $this->assertNull($this->autocomplete->getComponentRestriction($name));
    }
}
