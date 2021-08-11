<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Search;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Place\Base\PlaceType;
use Ivory\GoogleMap\Service\Place\Base\PriceLevel;
use Ivory\GoogleMap\Service\Place\Search\PlaceSearchService;
use Ivory\GoogleMap\Service\Place\Search\Request\NearbyPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\PageTokenPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRankBy;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;
use Ivory\GoogleMap\Service\Place\Search\Request\TextPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponse;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponseIterator;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchStatus;
use Ivory\Tests\GoogleMap\Service\Place\AbstractPlaceSerializableServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchServiceTest extends AbstractPlaceSerializableServiceTest
{
    private ?PlaceSearchService $service = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        if (isset($_SERVER['CACHE_RESET']) && $_SERVER['CACHE_RESET']) {
            sleep(5);
        }

        $this->service = new PlaceSearchService($this->client, $this->messageFactory);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     *
     */
    public function testProcessWithNearbyRequest()
    {
        $request = $this->createNearbyRequest();

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithNearbyRequestAndKeyword()
    {
        $request = $this->createNearbyRequest(300);
        $request->setKeyword('Bank');

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithNearbyRequestAndMinPrice()
    {
        $request = $this->createNearbyRequest(100);
        $request->setMinPrice(PriceLevel::FREE);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithNearbyRequestAndMaxPrice()
    {
        $request = $this->createNearbyRequest(100);
        $request->setMaxPrice(PriceLevel::MODERATE);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithNearbyRequestAndOpenNow()
    {
        $request = $this->createNearbyRequest(20);
        $request->setOpenNow(true);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithNearbyRequestAndType()
    {
        $request = $this->createNearbyRequest(500);
        $request->setType(PlaceType::BANK);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithNearbyRequestAndLanguage()
    {
        $request = $this->createNearbyRequest();

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithTextRequest()
    {
        $request = $this->createTextRequest();

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithTextRequestWithLocation()
    {
        $request = $this->createTextRequest();
        $request->setLocation(new Coordinate(50.637133, 3.063657));

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithTextRequestWithRadius()
    {
        $request = $this->createTextRequest();
        $request->setLocation(new Coordinate(50.637133, 3.063657));
        $request->setRadius(1000);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithTextRequestWithMinPrice()
    {
        $request = $this->createTextRequest('Restaurants in Lille');
        $request->setMinPrice(PriceLevel::EXPENSIVE);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithTextRequestWithMaxPrice()
    {
//        $this->markTestSkipped('Unable to get this working with multiple pages: JSON is 3 pages, XML first page asserting against JSON last page');

        $request = $this->createTextRequest('Pizza in Lille');
        $request->setMaxPrice(PriceLevel::MODERATE);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithTextRequestWithOpenNow()
    {
        $request = $this->createTextRequest();
        $request->setOpenNow(true);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithTextRequestWithType()
    {
        $request = $this->createTextRequest();
        $request->setType(PlaceType::CASINO);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testProcessWithTextRequestWithLanguage()
    {
        $request = $this->createTextRequest();

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    public function testIteratorWithNearbyRequest()
    {
        $request = $this->createNearbyRequest(5000);
        $request->setType(PlaceType::HOSPITAL);

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     *
     */
    public function testIteratorWithTextRequest()
    {
        $request = $this->createTextRequest('Church in Lille');

        $iterator = $this->service->process($request);

        $this->assertPlaceSearchIterator($iterator, $request);
    }

    /**
     * @expectedException \Http\Client\Common\Exception\ClientErrorException
     * @expectedExceptionMessage REQUEST_DENIED
     */
    public function testErrorRequest()
    {
        $this->service->setKey('invalid');

        $this->service->process($this->createNearbyRequest());
    }

    /**
     * @param int $radius
     *
     * @return NearbyPlaceSearchRequest
     */
    private function createNearbyRequest($radius = 10)
    {
        return new NearbyPlaceSearchRequest(
            new Coordinate(-33.8670522, 151.1957362),
            PlaceSearchRankBy::PROMINENCE,
            $radius
        );
    }

    /**
     * @param string $query
     *
     * @return TextPlaceSearchRequest
     */
    private function createTextRequest($query = 'Casino in Lille')
    {
        return new TextPlaceSearchRequest($query);
    }

    /**
     * @param PlaceSearchResponseIterator $iterator
     * @param PlaceSearchRequestInterface $request
     */
    private function assertPlaceSearchIterator($iterator, $request)
    {
        $this->assertInstanceOf(PlaceSearchResponseIterator::class, $iterator);

        foreach ($iterator as $key => $response) {
            $this->assertPlaceSearchResponse($response, $key === 0 ? $request : null);

            if (isset($_SERVER['CACHE_RESET']) && $_SERVER['CACHE_RESET']) {
                sleep(5);
            }
        }
    }

    /**
     * @param PlaceSearchResponse              $response
     * @param PlaceSearchRequestInterface|null $request
     */
    private function assertPlaceSearchResponse($response, $request)
    {
        $options = array_merge([
            'status'            => PlaceSearchStatus::OK,
            'results'           => [],
            'html_attributions' => [],
            'next_page_token'   => null,
        ], self::$journal->getData());

        $this->assertInstanceOf(PlaceSearchResponse::class, $response);

        if ($request !== null) {
            $this->assertSame($request, $response->getRequest());
        } else {
            $this->assertInstanceOf(PageTokenPlaceSearchRequest::class, $response->getRequest());
        }

        $this->assertSame($options['status'], $response->getStatus());
        $this->assertSame($options['html_attributions'], $response->getHtmlAttributions());

        if ($options['next_page_token'] !== null) {
            $this->assertNotEmpty($options['next_page_token']);
        } else {
            $this->assertNull($options['next_page_token']);
        }

        $expectedResults = $options['results'];
        $actualResults   = $response->getResults();

        $this->assertCount(count($expectedResults), $actualResults);

        foreach ($expectedResults as $key => $expectedResult) {
            $this->assertArrayHasKey($key, $actualResults);
            $this->assertPlace($actualResults[$key], $expectedResult);
        }
    }
}
