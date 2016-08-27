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
use Ivory\GoogleMap\Service\AbstractParsableService;
use Ivory\GoogleMap\Service\Utility\Parser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractPlaceParsableService extends AbstractParsableService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param Parser|null    $parser
     * @param string|null    $context
     */
    public function __construct(
        HttpClient $client,
        MessageFactory $messageFactory,
        Parser $parser = null,
        $context = null
    ) {
        if ($context !== null) {
            $context = '/'.$context;
        }

        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/place'.$context, $parser);
    }
}
