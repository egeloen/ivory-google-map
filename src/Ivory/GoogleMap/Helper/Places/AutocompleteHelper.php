<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Places;

use Ivory\GoogleMap\Exception\HelperException;
use Ivory\GoogleMap\Helper\ApiHelper;
use Ivory\GoogleMap\Helper\Base\CoordinateHelper;
use Ivory\GoogleMap\Helper\Base\BoundHelper;
use Ivory\GoogleMap\Places\Autocomplete;

/**
 * Places autocomplete helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteHelper
{
    /** @var \Ivory\GoogleMap\Helper\ApiHelper */
    protected $apiHelper;

    /** @var \Ivory\GoogleMap\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /** @var \Ivory\GoogleMap\Helper\Base\BoundHelper */
    protected $boundHelper;

    /**
     * Creates an autocomplete helper.
     *
     * @param \Ivory\GoogleMap\Helper\ApiHelper             $apiHelper        The API helper.
     * @param \Ivory\GoogleMap\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     * @param \Ivory\GoogleMap\Helper\Base\BoundHelper      $boundHelper      The bound helper.
     */
    public function __construct(
        ApiHelper $apiHelper = null,
        CoordinateHelper $coordinateHelper = null,
        BoundHelper $boundHelper = null
    )
    {
        if ($apiHelper === null) {
            $apiHelper = new ApiHelper();
        }

        if ($coordinateHelper === null) {
            $coordinateHelper = new CoordinateHelper();
        }

        if ($boundHelper === null) {
            $boundHelper = new BoundHelper();
        }

        $this->setApiHelper($apiHelper);
        $this->setCoordinateHelper($coordinateHelper);
        $this->setBoundHelper($boundHelper);
    }

    /**
     * Gets the API helper.
     *
     * @return \Ivory\GoogleMap\Helper\ApiHelper The API helper.
     */
    public function getApiHelper()
    {
        return $this->apiHelper;
    }

    /**
     * Sets the API helper.
     *
     * @param \Ivory\GoogleMap\Helper\ApiHelper $apiHelper The API helper.
     */
    public function setApiHelper(ApiHelper $apiHelper)
    {
        $this->apiHelper = $apiHelper;
    }

    /**
     * Gets the coordinate helper.
     *
     * @return \Ivory\GoogleMap\Helper\Base\CoordinateHelper The coordinate helper.
     */
    public function getCoordinateHelper()
    {
        return $this->coordinateHelper;
    }

    /**
     * Sets the coordinate helper.
     *
     * @param \Ivory\GoogleMap\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     */
    public function setCoordinateHelper(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Gets the bound helper.
     *
     * @return \Ivory\GoogleMap\Helper\Base\BoundHelper The bound helper.
     */
    public function getBoundHelper()
    {
        return $this->boundHelper;
    }

    /**
     * Sets the bound helper.
     *
     * @param \Ivory\GoogleMap\Helper\Base\BoundHelper $boundHelper The bound helper.
     */
    public function setBoundHelper(BoundHelper $boundHelper)
    {
        $this->boundHelper = $boundHelper;
    }

    /**
     * Renders the autocomplete HTML container.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @return string The HTML output.
     */
    public function renderHtmlContainer(Autocomplete $autocomplete)
    {
        $inputAttributes = $autocomplete->getInputAttributes();

        $inputAttributes['id'] = $autocomplete->getInputId();

        if ($autocomplete->hasValue()) {
            $inputAttributes['value'] = $autocomplete->getValue();
        }

        $htmlAttributes = array();
        foreach ($inputAttributes as $attribute => $value) {
            $htmlAttributes[] = sprintf('%s="%s"', $attribute, $value);
        }

        return sprintf('<input %s />'.PHP_EOL, implode(' ', $htmlAttributes));
    }

    /**
     * Renders the autocomplete javascripts.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @throws \Ivory\GoogleMap\Exception\HelperException if the autocomplete bound does not have coordinates.
     *
     * @return string The HTML output.
     */
    public function renderJavascripts(Autocomplete $autocomplete)
    {
        $output = array();

        if (!$this->apiHelper->isLoaded() && !$autocomplete->isAsync()) {
            $output[] = $this->apiHelper->render($autocomplete->getLanguage(), array('places'));
        }

        $output[] = '<script type="text/javascript">'.PHP_EOL;

        if ($autocomplete->isAsync()) {
            $output[] = 'function load_ivory_google_place () {'.PHP_EOL;
        }

        if ($autocomplete->hasBound()) {
            if (!$autocomplete->getBound()->hasCoordinates()) {
                throw HelperException::invalidAutocompleteBound();
            }

            $output[] = $this->coordinateHelper->render($autocomplete->getBound()->getSouthWest());
            $output[] = $this->coordinateHelper->render($autocomplete->getBound()->getNorthEast());
            $output[] = $this->boundHelper->render($autocomplete->getBound());
        }

        $output[] = $this->renderAutocomplete($autocomplete);

        if ($autocomplete->isAsync()) {
            $output[] = '}'.PHP_EOL;
        }

        $output[] = '</script>'.PHP_EOL;

        if (!$this->apiHelper->isLoaded() && $autocomplete->isAsync()) {
            $output[] = $this->apiHelper->render(
                $autocomplete->getLanguage(),
                array('places'),
                'load_ivory_google_place'
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the autocomplete.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @return string The JS output.
     */
    public function renderAutocomplete(Autocomplete $autocomplete)
    {
        $types = $autocomplete->getTypes();

        if (!empty($types)) {
            $jsonOptions = substr(json_encode(array('types' => $types)), 0, -1);
        } else {
            $jsonOptions = '{';
        }

        if ($autocomplete->hasBound()) {
            if (!empty($types)) {
                $jsonOptions .= ', ';
            }

            $jsonOptions .= sprintf('"bounds": %s}', $autocomplete->getBound()->getJavascriptVariable());
        } else {
            $jsonOptions .= '}';
        }

        return sprintf(
            '%s = new google.maps.places.Autocomplete(document.getElementById(\'%s\', %s));'.PHP_EOL,
            $autocomplete->getJavascriptVariable(),
            $autocomplete->getInputId(),
            $jsonOptions
        );
    }
}
