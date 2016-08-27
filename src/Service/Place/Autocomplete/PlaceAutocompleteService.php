<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete;

use Ivory\GoogleMap\Service\Place\AbstractPlaceParsableService;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequestInterface;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteMatch;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompletePrediction;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteResponse;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteTerm;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteService extends AbstractPlaceParsableService
{
    /**
     * {@inheritdoc}
     */
    public function setHttps($https)
    {
        if (!$https) {
            throw new \InvalidArgumentException('The http scheme is not supported.');
        }

        parent::setHttps($https);
    }

    /**
     * @param PlaceAutocompleteRequestInterface $request
     *
     * @return PlaceAutocompleteResponse
     */
    public function process(PlaceAutocompleteRequestInterface $request)
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $data = $this->parse((string) $httpResponse->getBody(), [
            'pluralization_rules' => [
                'matched_substring' => 'matched_substrings',
                'prediction'        => 'predictions',
                'term'              => 'terms',
                'type'              => 'types',
            ],
        ]);

        $response = $this->buildResponse($data);
        $response->setRequest($request);

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return PlaceAutocompleteResponse
     */
    private function buildResponse(array $data)
    {
        $response = new PlaceAutocompleteResponse();
        $response->setStatus($data['status']);
        $response->setPredictions($this->buildPredictions($data['predictions']));

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return PlaceAutocompletePrediction[]
     */
    private function buildPredictions(array $data)
    {
        $predictions = [];

        foreach ($data as $prediction) {
            $predictions[] = $this->buildPrediction($prediction);
        }

        return $predictions;
    }

    /**
     * @param mixed[] $data
     *
     * @return PlaceAutocompletePrediction
     */
    private function buildPrediction(array $data)
    {
        $prediction = new PlaceAutocompletePrediction();
        $prediction->setDescription($data['description']);
        $prediction->setTerms($this->buildTerms($data['terms']));
        $prediction->setMatches($this->buildMatches($data['matched_substrings']));

        if (isset($data['place_id'])) {
            $prediction->setPlaceId($data['place_id']);
        }

        if (isset($data['types'])) {
            $prediction->setTypes($data['types']);
        }

        return $prediction;
    }

    /**
     * @param mixed[] $data
     *
     * @return PlaceAutocompleteTerm[]
     */
    private function buildTerms(array $data)
    {
        $terms = [];

        foreach ($data as $term) {
            $terms[] = $this->buildTerm($term);
        }

        return $terms;
    }

    /**
     * @param mixed[] $data
     *
     * @return PlaceAutocompleteTerm
     */
    private function buildTerm(array $data)
    {
        $term = new PlaceAutocompleteTerm();
        $term->setValue($data['value']);
        $term->setOffset($data['offset']);

        return $term;
    }

    /**
     * @param mixed[] $data
     *
     * @return PlaceAutocompleteMatch[]
     */
    private function buildMatches(array $data)
    {
        $matches = [];

        foreach ($data as $match) {
            $matches[] = $this->buildMatch($match);
        }

        return $matches;
    }

    /**
     * @param mixed[] $data
     *
     * @return PlaceAutocompleteMatch
     */
    private function buildMatch(array $data)
    {
        $match = new PlaceAutocompleteMatch();
        $match->setLength($data['length']);
        $match->setOffset($data['offset']);

        return $match;
    }
}
