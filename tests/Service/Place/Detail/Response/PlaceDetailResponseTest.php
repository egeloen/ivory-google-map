<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Detail\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailResponse;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailStatus;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceDetailResponse
     */
    private $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->response = new PlaceDetailResponse();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
        $this->assertFalse($this->response->hasRequest());
        $this->assertNull($this->response->getRequest());
        $this->assertFalse($this->response->hasResult());
        $this->assertNull($this->response->getResult());
        $this->assertFalse($this->response->hasHtmlAttributions());
        $this->assertEmpty($this->response->getHtmlAttributions());
    }

    public function testStatus()
    {
        $this->response->setStatus($status = PlaceDetailStatus::OK);

        $this->assertTrue($this->response->hasStatus());
        $this->assertSame($status, $this->response->getStatus());
    }

    public function testRequest()
    {
        $this->response->setRequest($request = $this->createRequestMock());

        $this->assertTrue($this->response->hasRequest());
        $this->assertSame($request, $this->response->getRequest());
    }

    public function testResult()
    {
        $this->response->setResult($result = $this->createPlaceMock());

        $this->assertTrue($this->response->hasResult());
        $this->assertSame($result, $this->response->getResult());
    }

    public function testSetHtmlAttributions()
    {
        $this->response->setHtmlAttributions($htmlAttributions = [$htmlAttribution = 'attribution']);
        $this->response->setHtmlAttributions($htmlAttributions);

        $this->assertTrue($this->response->hasHtmlAttributions());
        $this->assertTrue($this->response->hasHtmlAttribution($htmlAttribution));
        $this->assertSame($htmlAttributions, $this->response->getHtmlAttributions());
    }

    public function testAddHtmlAttributions()
    {
        $this->response->setHtmlAttributions($firstHtmlAttributions = ['attribution1']);
        $this->response->addHtmlAttributions($secondHtmlAttributions = ['attribution2']);

        $this->assertTrue($this->response->hasHtmlAttributions());
        $this->assertSame(
            array_merge($firstHtmlAttributions, $secondHtmlAttributions),
            $this->response->getHtmlAttributions()
        );
    }

    public function testAddHtmlAttribution()
    {
        $this->response->addHtmlAttribution($htmlAttribution = 'attribution');

        $this->assertTrue($this->response->hasHtmlAttributions());
        $this->assertTrue($this->response->hasHtmlAttribution($htmlAttribution));
        $this->assertSame([$htmlAttribution], $this->response->getHtmlAttributions());
    }

    public function testRemoveHtmlAttribution()
    {
        $this->response->addHtmlAttribution($htmlAttribution = 'attribution');
        $this->response->removeHtmlAttribution($htmlAttribution);

        $this->assertFalse($this->response->hasHtmlAttributions());
        $this->assertFalse($this->response->hasHtmlAttribution($htmlAttribution));
        $this->assertEmpty($this->response->getHtmlAttributions());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceDetailRequestInterface
     */
    private function createRequestMock()
    {
        return $this->createMock(PlaceDetailRequestInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Place
     */
    private function createPlaceMock()
    {
        return $this->createMock(Place::class);
    }
}
