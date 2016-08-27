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
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\AbstractService;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractPlaceService extends AbstractService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param string         $context
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory, $context)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/place/'.$context);
    }
}
