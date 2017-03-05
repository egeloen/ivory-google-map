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
    /**
     * @var PlaceAutocompleteService
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service = new PlaceAutocompleteService($this->client, $this->messageFactory);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteRequest($format)
    {
        $request = $this->createPlaceAutocompleteRequest();

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteRequestAndOffset($format)
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setInput('Paris, Madrid');
        $request->setOffset(5);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteRequestAndLocation($format)
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteRequestAndRadius($format)
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));
        $request->setRadius(1000);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteRequestAndTypes($format)
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setTypes([AutocompleteType::CITIES]);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteRequestAndComponents($format)
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setComponents([AutocompleteComponentType::COUNTRY => 'fr']);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteRequestAndLanguage($format)
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setLanguage('fr');

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteQueryRequest($format)
    {
        $request = $this->createPlaceAutocompleteQueryRequest();

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteQueryRequestAndOffset($format)
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setInput('Paris, Madrid');
        $request->setOffset(5);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteQueryRequestAndLocation($format)
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteQueryRequestAndRadius($format)
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));
        $request->setRadius(1000);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAutocompleteQueryRequestAndLanguage($format)
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setLanguage('fr');

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceAutocompleteResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     *
     * @expectedException \Http\Client\Common\Exception\ClientErrorException
     * @expectedExceptionMessage REQUEST_DENIED
     */
    public function testErrorRequest($format)
    {
        $this->service->setFormat($format);
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

    /**
     * @param PlaceAutocompleteResponse         $response
     * @param PlaceAutocompleteRequestInterface $request
     */
    private function assertPlaceAutocompleteResponse($response, $request)
    {
        $options = array_merge(['predictions' => []], self::$journal->getData());
        $options['status'] = PlaceAutocompleteStatus::OK;

        $this->assertInstanceOf(PlaceAutocompleteResponse::class, $response);

        $this->assertSame($request, $response->getRequest());
        $this->assertCount(count($options['predictions']), $predictions = $response->getPredictions());

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

        $this->assertCount(count($options['terms']), $terms = $prediction->getTerms());

        foreach ($options['terms'] as $key => $term) {
            $this->assertArrayHasKey($key, $terms);
            $this->assertPlaceAutocompleteTerm($terms[$key], $term);
        }

        $this->assertCount(count($options['matched_substrings']), $matches = $prediction->getMatches());

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
