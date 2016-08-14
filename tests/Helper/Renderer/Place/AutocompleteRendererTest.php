<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Place;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Place\Autocomplete;
use Ivory\GoogleMap\Place\AutocompleteComponentType;
use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteRendererTest extends\PHPUnit_Framework_TestCase
{
    /**
     * @var AutocompleteRenderer
     */
    private $autocompleteRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocompleteRenderer = new AutocompleteRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new RequirementRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->autocompleteRenderer);
    }

    public function testRequirementRenderer()
    {
        $requirementRenderer = $this->createRequirementRendererMock();
        $this->autocompleteRenderer->setRequirementRenderer($requirementRenderer);

        $this->assertSame($requirementRenderer, $this->autocompleteRenderer->getRequirementRenderer());
    }

    public function testRender()
    {
        $bound = new Bound();
        $bound->setVariable('bound');

        $autocomplete = new Autocomplete();
        $autocomplete->setTypes([AutocompleteType::CITIES]);
        $autocomplete->setBound($bound);
        $autocomplete->setComponents([AutocompleteComponentType::COUNTRY => 'fr']);
        $autocomplete->setVariable('autocomplete');

        $this->assertSame(
            'autocomplete=new google.maps.places.Autocomplete(document.getElementById("place_input"),{"types":["(cities)"],"bounds":bound,"componentRestrictions":{"country":"fr"}})',
            $this->autocompleteRenderer->render($autocomplete)
        );
    }

    public function testRenderWithoutOptions()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setVariable('autocomplete');

        $this->assertSame(
            'autocomplete=new google.maps.places.Autocomplete(document.getElementById("place_input"),{})',
            $this->autocompleteRenderer->render($autocomplete)
        );
    }

    public function testRenderRequirement()
    {
        $this->assertSame(
            'typeof google.maps.places!==typeof undefined',
            $this->autocompleteRenderer->renderRequirement()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RequirementRenderer
     */
    private function createRequirementRendererMock()
    {
        return $this->createMock(RequirementRenderer::class);
    }
}
