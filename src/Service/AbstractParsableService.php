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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractParsableService extends AbstractService
{
    const FORMAT_JSON = Parser::FORMAT_JSON;
    const FORMAT_XML = Parser::FORMAT_XML;

    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var string
     */
    private $format = self::FORMAT_JSON;

    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param string         $url
     * @param Parser|null    $parser
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory, $url, Parser $parser = null)
    {
        parent::__construct($client, $messageFactory, $url);

        if ($parser === null) {
            $parser = new Parser([
                self::FORMAT_JSON => new JsonParser(),
                self::FORMAT_XML  => new XmlParser(),
            ]);
        }

        $this->setParser($parser);
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
     * {@inheritdoc}
     */
    protected function createUrl(RequestInterface $request)
    {
        return parent::createUrl($request).'/'.$this->format;
    }

    /**
     * @param string  $data
     * @param mixed[] $options
     *
     * @return mixed[]
     */
    protected function parse($data, array $options = [])
    {
        return $this->parser->parse($data, $this->format, $options);
    }
}
