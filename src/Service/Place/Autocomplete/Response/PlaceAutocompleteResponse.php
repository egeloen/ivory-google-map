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
    private ?string $status = null;

    private ?PlaceAutocompleteRequestInterface $request = null;

    /**
     * @var PlaceAutocompletePrediction[]
     */
    private array $predictions = [];

    public function hasStatus(): bool
    {
        return $this->status !== null;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return $this->request !== null;
    }

    public function getRequest(): ?PlaceAutocompleteRequestInterface
    {
        return $this->request;
    }

    /**
     * @param PlaceAutocompleteRequestInterface|null $request
     */
    public function setRequest(PlaceAutocompleteRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasPredictions(): bool
    {
        return !empty($this->predictions);
    }

    /**
     * @return PlaceAutocompletePrediction[]
     */
    public function getPredictions(): array
    {
        return $this->predictions;
    }

    /**
     * @param PlaceAutocompletePrediction[] $predictions
     */
    public function setPredictions(array $predictions): void
    {
        $this->predictions = [];
        $this->addPredictions($predictions);
    }

    /**
     * @param PlaceAutocompletePrediction[] $predictions
     */
    public function addPredictions(array $predictions): void
    {
        foreach ($predictions as $prediction) {
            $this->addPrediction($prediction);
        }
    }

    public function hasPrediction(PlaceAutocompletePrediction $prediction): bool
    {
        return in_array($prediction, $this->predictions, true);
    }

    public function addPrediction(PlaceAutocompletePrediction $prediction): void
    {
        if (!$this->hasPrediction($prediction)) {
            $this->predictions[] = $prediction;
        }
    }

    public function removePrediction(PlaceAutocompletePrediction $prediction): void
    {
        unset($this->predictions[array_search($prediction, $this->predictions, true)]);
        $this->predictions = empty($this->predictions) ? [] : array_values($this->predictions);
    }
}
