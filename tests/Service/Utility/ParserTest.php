<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Utility;

use Ivory\GoogleMap\Service\Utility\Parser;
use Ivory\GoogleMap\Service\Utility\ParserInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->parser = new Parser();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->parser->hasParsers());
        $this->assertEmpty($this->parser->getParsers());
    }

    public function testInitialState()
    {
        $this->parser = new Parser($parsers = [
            $format = Parser::FORMAT_JSON => $parser = $this->createParserMock(),
        ]);

        $this->assertTrue($this->parser->hasParsers());
        $this->assertTrue($this->parser->hasParser($format));
        $this->assertSame($parser, $this->parser->getParser($format));
        $this->assertSame($parsers, $this->parser->getParsers());
    }

    public function testSetParsers()
    {
        $this->parser->setParsers($parsers = [$format = Parser::FORMAT_JSON => $parser = $this->createParserMock()]);
        $this->parser->setParsers($parsers);

        $this->assertTrue($this->parser->hasParsers());
        $this->assertTrue($this->parser->hasParser($format));
        $this->assertSame($parser, $this->parser->getParser($format));
        $this->assertSame($parsers, $this->parser->getParsers());
    }

    public function testAddParsers()
    {
        $this->parser->setParsers($firstParsers = [Parser::FORMAT_JSON => $this->createParserMock()]);
        $this->parser->setParsers($secondParsers = [Parser::FORMAT_JSON => $this->createParserMock()]);

        $this->assertTrue($this->parser->hasParsers());
        $this->assertSame(array_merge($firstParsers, $secondParsers), $this->parser->getParsers());
    }

    public function testSetParser()
    {
        $this->parser->setParser($format = Parser::FORMAT_JSON, $parser = $this->createParserMock());

        $this->assertTrue($this->parser->hasParsers());
        $this->assertTrue($this->parser->hasParser($format));
        $this->assertSame($parser, $this->parser->getParser($format));
        $this->assertSame([$format => $parser], $this->parser->getParsers());
    }

    public function testRemoveParser()
    {
        $this->parser->setParser($format = Parser::FORMAT_JSON, $this->createParserMock());
        $this->parser->removeParser($format);

        $this->assertFalse($this->parser->hasParsers());
        $this->assertFalse($this->parser->hasParser($format));
        $this->assertNull($this->parser->getParser($format));
        $this->assertEmpty($this->parser->getParsers());
    }

    public function testParse()
    {
        $this->parser->setParser($format = Parser::FORMAT_JSON, $parser = $this->createParserMock());

        $parser
            ->expects($this->once())
            ->method('parse')
            ->with(
                $this->identicalTo($data = 'data'),
                $this->identicalTo($options = ['foo' => 'bar'])
            )
            ->will($this->returnValue($result = ['result']));

        $this->assertSame($result, $this->parser->parse($data, $format, $options));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The format "json" is not supported.
     */
    public function testParseWithInvalidFormat()
    {
        $this->parser->parse('data', Parser::FORMAT_JSON);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ParserInterface
     */
    public function createParserMock()
    {
        return $this->createMock(ParserInterface::class);
    }
}
