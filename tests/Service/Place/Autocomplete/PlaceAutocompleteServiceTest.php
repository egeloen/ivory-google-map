<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Autocomplete;

use Http\Client\Common\Exception\ClientErrorException;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Place\AutocompleteComponentType;
use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\GoogleMap\Service\Place\Autocomplete\PlaceAutocompleteService;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteQueryRequest;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequest;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequestInterface;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteMatch;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompletePrediction;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteResponse;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteStatus;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteTerm;
use Ivory\Tests\GoogleMap\Service\Place\AbstractPlaceSerializableServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteServiceTest extends AbstractPlaceSerializableServiceTest
{
    private PlaceAutocompleteService $service;

    protected function setUp(): void
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service = new PlaceAutocompleteService($this->client, $this->messageFactory);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     * 
     */
    public function testProcessWithAutocompleteRequest()
    {
        $request = $this->createPlaceAutocompleteRequest();
        
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * 
     */
    public function testProcessWithAutocompleteRequestAndOffset()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setInput('Paris, Madrid');
        $request->setOffset(5);

        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteRequestAndLocation()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));

        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteRequestAndRadius()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));
        $request->setRadius(1000);

        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteRequestAndTypes()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setTypes([AutocompleteType::CITIES]);

        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteRequestAndComponents()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setComponents([AutocompleteComponentType::COUNTRY => 'fr']);

        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteRequestAndLanguage()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteQueryRequest()
    {
        $request = $this->createPlaceAutocompleteQueryRequest();

        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteQueryRequestAndOffset()
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setInput('Paris, Madrid');
        $request->setOffset(5);

        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteQueryRequestAndLocation()
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));

        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteQueryRequestAndRadius()
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));
        $request->setRadius(1000);

        
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     */
    public function testProcessWithAutocompleteQueryRequestAndLanguage()
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setLanguage('fr');

        
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    public function testErrorRequest()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage('REQUEST_DENIED');
        $this->service->setKey('invalid');

        $this->service->process($this->createPlaceAutocompleteRequest());
    }

    /**
     * @return PlaceAutocompleteRequest
     */
    private function createPlaceAutocompleteRequest()
    {
        return new PlaceAutocompleteRequest('Paris');
    }

    /**
     * @return PlaceAutocompleteQueryRequest
     */
    private function createPlaceAutocompleteQueryRequest()
    {
        return new PlaceAutocompleteQueryRequest('Paris');
    }

    private function assertPlaceAutocompleteResponse(PlaceAutocompleteResponse $response, PlaceAutocompleteRequestInterface $request)
    {
        $options = array_merge(['predictions' => []], self::$journal->getData());
        $options['status'] = PlaceAutocompleteStatus::OK;

        $this->assertInstanceOf(PlaceAutocompleteResponse::class, $response);

        $this->assertSame($request, $response->getRequest());
        $this->assertCount(is_countable($options['predictions']) ? count($options['predictions']) : 0, $predictions = $response->getPredictions(), sprintf("Difference in number of predictions"));

        foreach ($options['predictions'] as $key => $prediction) {
            $this->assertArrayHasKey($key, $predictions);
            $this->assertPlaceAutocompletePrediction($predictions[$key], $prediction);
        }
    }

    /**
     * @param PlaceAutocompletePrediction $prediction
     * @param mixed[]                     $options
     */
    private function assertPlaceAutocompletePrediction($prediction, array $options = [])
    {
        $options = array_merge([
            'place_id'           => null,
            'description'        => null,
            'types'              => [],
            'terms'              => [],
            'matched_substrings' => [],
        ], $options);

        $this->assertInstanceOf(PlaceAutocompletePrediction::class, $prediction);

        $this->assertSame($options['place_id'], $prediction->getPlaceId());
        $this->assertSame($options['description'], $prediction->getDescription());
        $this->assertSame($options['types'], $prediction->getTypes());

        $this->assertCount(is_countable($options['terms']) ? count($options['terms']) : 0, $terms = $prediction->getTerms());

        foreach ($options['terms'] as $key => $term) {
            $this->assertArrayHasKey($key, $terms);
            $this->assertPlaceAutocompleteTerm($terms[$key], $term);
        }

        $this->assertCount(is_countable($options['matched_substrings']) ? count($options['matched_substrings']) : 0, $matches = $prediction->getMatches());

        foreach ($options['matched_substrings'] as $key => $match) {
            $this->assertArrayHasKey($key, $matches);
            $this->assertPlaceAutocompleteMatch($matches[$key], $match);
        }
    }

    /**
     * @param PlaceAutocompleteTerm $term
     * @param mixed[]               $options
     */
    private function assertPlaceAutocompleteTerm($term, array $options = [])
    {
        $options = array_merge([
            'value'  => null,
            'offset' => null,
        ], $options);

        $this->assertInstanceOf(PlaceAutocompleteTerm::class, $term);

        $this->assertSame($options['value'], $term->getValue());
        $this->assertSame($options['offset'], $term->getOffset());
    }

    /**
     * @param PlaceAutocompleteMatch $match
     * @param mixed[]                $options
     */
    private function assertPlaceAutocompleteMatch($match, array $options = [])
    {
        $options = array_merge([
            'length' => null,
            'offset' => null,
        ], $options);

        $this->assertInstanceOf(PlaceAutocompleteMatch::class, $match);

        $this->assertSame($options['length'], $match->getLength());
        $this->assertSame($options['offset'], $match->getOffset());
    }
}
