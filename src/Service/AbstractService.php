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
use Ivory\GoogleMap\Service\Utility\JsonParser;
use Ivory\GoogleMap\Service\Utility\Parser;
use Ivory\GoogleMap\Service\Utility\XmlParser;
use Psr\Http\Message\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractService
{
    const FORMAT_JSON = Parser::FORMAT_JSON;
    const FORMAT_XML = Parser::FORMAT_XML;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var Parser
     */
    private $parser;

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
     * @var string|null
     */
    private $key;

    /**
     * @var BusinessAccount|null
     */
    private $businessAccount;

    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param string         $url
     * @param Parser|null    $parser
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory, $url, Parser $parser = null)
    {
        if ($parser === null) {
            $parser = new Parser([
                self::FORMAT_JSON => new JsonParser(),
                self::FORMAT_XML  => new XmlParser(),
            ]);
        }

        $this->setClient($client);
        $this->setMessageFactory($messageFactory);
        $this->setUrl($url);
        $this->setParser($parser);
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
     * @return Parser
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     * @param Parser $parser
     */
    public function setParser(Parser $parser)
    {
        $this->parser = $parser;
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
     * @return bool
     */
    public function hasKey()
    {
        return $this->key !== null;
    }

    /**
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey($key)
    {
        $this->key = $key;
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
        if ($this->hasKey()) {
            $query['key'] = $this->key;
        }

        $url = $this->getUrl().'/'.$this->getFormat().'?'.http_build_query($query, '', '&');

        if ($this->hasBusinessAccount()) {
            $url = $this->businessAccount->signUrl($url);
        }

        return $this->messageFactory->createRequest('GET', $url);
    }

    /**
     * @param string  $data
     * @param mixed[] $options
     *
     * @return mixed[]
     */
    protected function parse($data, array $options = [])
    {
        return $this->parser->parse($data, $this->getFormat(), $options);
    }
}
