<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Utility;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Parser
{
    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';

    /**
     * @var ParserInterface[]
     */
    private $parsers = [];

    /**
     * @param ParserInterface[] $parsers
     */
    public function __construct(array $parsers = [])
    {
        $this->setParsers($parsers);
    }

    /**
     * @return bool
     */
    public function hasParsers()
    {
        return !empty($this->parsers);
    }

    /**
     * @return ParserInterface[]
     */
    public function getParsers()
    {
        return $this->parsers;
    }

    /**
     * @param ParserInterface[] $parsers
     */
    public function setParsers(array $parsers)
    {
        $this->parsers = [];
        $this->addParsers($parsers);
    }

    /**
     * @param ParserInterface[] $parsers
     */
    public function addParsers(array $parsers)
    {
        foreach ($parsers as $format => $parser) {
            $this->setParser($format, $parser);
        }
    }

    /**
     * @param string $format
     *
     * @return bool
     */
    public function hasParser($format)
    {
        return isset($this->parsers[$format]);
    }

    /**
     * @param string $format
     *
     * @return ParserInterface|null
     */
    public function getParser($format)
    {
        return $this->hasParser($format) ? $this->parsers[$format] : null;
    }

    /**
     * @param string          $format
     * @param ParserInterface $parser
     */
    public function setParser($format, ParserInterface $parser)
    {
        $this->parsers[$format] = $parser;
    }

    /**
     * @param string $format
     */
    public function removeParser($format)
    {
        unset($this->parsers[$format]);
    }

    /**
     * @param string  $data
     * @param string  $format
     * @param mixed[] $options
     *
     * @return mixed[]
     */
    public function parse($data, $format, array $options = [])
    {
        $parser = $this->getParser($format);

        if ($parser === null) {
            throw new \InvalidArgumentException(sprintf('The format "%s" is not supported.', $format));
        }

        return $parser->parse($data, $options);
    }
}
