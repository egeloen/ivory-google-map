<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place;

use Http\Client\HttpClient;
use Ivory\GoogleMap\Service\AbstractSerializableService;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractPlaceSerializableService extends AbstractSerializableService
{
    public function __construct(HttpClient $client, SerializerInterface $serializer = null, ?string $context = null)
    {
        if ($context !== null) {
            $context = '/' . $context;
        }

        parent::__construct('https://maps.googleapis.com/maps/api/place' . $context, $client, $serializer);
    }
}
