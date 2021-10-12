<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractSerializableService extends AbstractHttpService
{
    const FORMAT_JSON = 'json';
    const FORMAT_XML  = 'xml';

    private SerializerInterface $serializer;

    /**
     * @param string                   $url
     * @param SerializerInterface|null $serializer
     */
    public function __construct(
        $url,
        HttpClient $client,
        MessageFactory $messageFactory,
        SerializerInterface $serializer = null
    )
    {
        parent::__construct($url, $client, $messageFactory);

        $this->setSerializer($serializer ?: SerializerBuilder::create());
    }

    public function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    protected function createBaseUrl(RequestInterface $request): string
    {
        return parent::createBaseUrl($request) . '/json';
    }

    /**
     * @return object
     */
    protected function deserialize(ResponseInterface $response, string $type, ?array $context = null)
    {
        return $this->serializer->deserialize((string)$response->getBody(), $type, 'json', $context);
    }
}
