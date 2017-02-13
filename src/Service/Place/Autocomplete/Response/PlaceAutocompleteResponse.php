<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Response;

use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteResponse
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var PlaceAutocompleteRequestInterface|null
     */
    private $request;

    /**
     * @var PlaceAutocompletePrediction[]
     */
    private $predictions = [];

    /**
     * @return bool
     */
    public function hasStatus()
    {
        return $this->status !== null;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function hasRequest()
    {
        return $this->request !== null;
    }

    /**
     * @return PlaceAutocompleteRequestInterface|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param PlaceAutocompleteRequestInterface|null $request
     */
    public function setRequest(PlaceAutocompleteRequestInterface $request = null)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function hasPredictions()
    {
        return !empty($this->predictions);
    }

    /**
     * @return PlaceAutocompletePrediction[]
     */
    public function getPredictions()
    {
        return $this->predictions;
    }

    /**
     * @param PlaceAutocompletePrediction[] $predictions
     */
    public function setPredictions(array $predictions)
    {
        $this->predictions = [];
        $this->addPredictions($predictions);
    }

    /**
     * @param PlaceAutocompletePrediction[] $predictions
     */
    public function addPredictions(array $predictions)
    {
        foreach ($predictions as $prediction) {
            $this->addPrediction($prediction);
        }
    }

    /**
     * @param PlaceAutocompletePrediction $prediction
     *
     * @return bool
     */
    public function hasPrediction(PlaceAutocompletePrediction $prediction)
    {
        return in_array($prediction, $this->predictions, true);
    }

    /**
     * @param PlaceAutocompletePrediction $prediction
     */
    public function addPrediction(PlaceAutocompletePrediction $prediction)
    {
        if (!$this->hasPrediction($prediction)) {
            $this->predictions[] = $prediction;
        }
    }

    /**
     * @param PlaceAutocompletePrediction $prediction
     */
    public function removePrediction(PlaceAutocompletePrediction $prediction)
    {
        unset($this->predictions[array_search($prediction, $this->predictions, true)]);
        $this->predictions = array_values($this->predictions);
    }
}
