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
use Ivory\GoogleMap\Service\Utility\XmlParser;
use Psr\Http\Message\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractService
{
    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var string
     */
    private $url;

    /**
     * @var bool
     */
    private $https = true;

    /**
     * @var string
     */
    private $format = self::FORMAT_JSON;

    /**
     * @var XmlParser
     */
    private $xmlParser;

    /**
     * @var BusinessAccount|null
     */
    private $businessAccount;

    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param string         $url
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory, $url)
    {
        $this->setClient($client);
        $this->setMessageFactory($messageFactory);
        $this->setUrl($url);
        $this->setXmlParser(new XmlParser());
    }

    /**
     * @return HttpClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param HttpClient $client
     */
    public function setClient(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return MessageFactory
     */
    public function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * @param MessageFactory $messageFactory
     */
    public function setMessageFactory(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        if ($this->isHttps()) {
            return str_replace('http://', 'https://', $this->url);
        }

        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function isHttps()
    {
        return $this->https;
    }

    /**
     * @param bool $https
     */
    public function setHttps($https)
    {
        $this->https = $https;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return XmlParser
     */
    public function getXmlParser()
    {
        return $this->xmlParser;
    }

    /**
     * @param XmlParser $xmlParser
     */
    public function setXmlParser(XmlParser $xmlParser)
    {
        $this->xmlParser = $xmlParser;
    }

    /**
     * @return bool
     */
    public function hasBusinessAccount()
    {
        return $this->businessAccount !== null;
    }

    /**
     * @return BusinessAccount
     */
    public function getBusinessAccount()
    {
        return $this->businessAccount;
    }

    /**
     * @param BusinessAccount $businessAccount
     */
    public function setBusinessAccount(BusinessAccount $businessAccount = null)
    {
        $this->businessAccount = $businessAccount;
    }

    /**
     * @param string[] $query
     *
     * @return RequestInterface
     */
    protected function createRequest(array $query)
    {
        $url = $this->getUrl().'/'.$this->getFormat().'?'.http_build_query($query, '', '&');

        if ($this->hasBusinessAccount()) {
            $url = $this->businessAccount->signUrl($url);
        }

        return $this->messageFactory->createRequest('GET', $url);
    }
}
