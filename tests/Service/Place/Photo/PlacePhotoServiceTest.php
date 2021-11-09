<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Photo;

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\Place\Photo\PlacePhotoService;
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequest;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacePhotoServiceTest extends TestCase
{
    private PlacePhotoService $service;

    private ?string $key = null;

    protected function setUp(): void
    {
        $this->service = new PlacePhotoService();
        $this->service->setKey($this->key = 'foo');
    }

    public function testProcessWithMaxWidth()
    {
        $request = $this->createRequest();
        $request->setMaxWidth(400);

        $this->assertSame(
            'https://maps.googleapis.com/maps/api/place/photo?photoreference='.$request->getReference().'&maxwidth=400&key='.$this->key,
            $this->service->process($request)
        );
    }

    public function testProcessWithMaxHeight()
    {
        $request = $this->createRequest();
        $request->setMaxHeight(400);

        $this->assertSame(
            'https://maps.googleapis.com/maps/api/place/photo?photoreference='.$request->getReference().'&maxheight=400&key='.$this->key,
            $this->service->process($request)
        );
    }

    public function testProcessWithBusinessAccount()
    {
        $request = $this->createRequest();

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->identicalTo(
                $url = 'https://maps.googleapis.com/maps/api/place/photo?photoreference='.$request->getReference().'&key='.$this->key
            ))
            ->will($this->returnValue($signedUrl = $url.'&signature=signature'));

        $this->service->setBusinessAccount($businessAccount);

        $this->assertSame($signedUrl, $this->service->process($request));
    }

    /**
     * @return PlacePhotoRequest
     */
    private function createRequest()
    {
        return new PlacePhotoRequest('bar');
    }

    /**
     * @return MockObject|BusinessAccount
     */
    private function createBusinessAccountMock()
    {
        return $this->createMock(BusinessAccount::class);
    }
}
