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

use Ivory\GoogleMap\Service\Place\Photo\PlacePhotoService;
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequest;
use Ivory\Tests\GoogleMap\Service\AbstractFunctionalServiceTest;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacePhotoServiceTest extends AbstractFunctionalServiceTest
{
    /**
     * @var PlacePhotoService
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

        $this->service = new PlacePhotoService($this->client, $this->messageFactory);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    public function testProcessWithMaxWidth()
    {
        $request = $this->createRequest();
        $request->setMaxWidth(400);

        $stream = $this->service->process($request);

        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertSame(file_get_contents(__DIR__.'/Fixture/max_width.jpg'), (string) $stream);
    }

    public function testProcessWithMaxHeight()
    {
        $request = $this->createRequest();
        $request->setMaxHeight(400);

        $stream = $this->service->process($request);

        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertSame(file_get_contents(__DIR__.'/Fixture/max_height.jpg'), (string) $stream);
    }

    /**
     * @return PlacePhotoRequest
     */
    private function createRequest()
    {
        return new PlacePhotoRequest('CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU');
    }
}
