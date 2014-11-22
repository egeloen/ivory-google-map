<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services;

use Ivory\GoogleMap\Services\XmlParser;

/**
 * Xml parser test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlParserTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\XmlParser */
    private $xmlParser;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->xmlParser = new XmlParser();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->xmlParser);
    }

    /**
     * @dataProvider parseProvider
     */
    public function testParse($xml, $pluralizationRules, $expected)
    {
        $this->assertSame($expected, $this->xmlParser->parse($xml, $pluralizationRules));
    }

    /**
     * Gets the parse provider.
     *
     * @return array The parse provider.
     */
    public function parseProvider()
    {
        return array(
            array('<response><foo>bar</foo></response>', array(), array('foo' => 'bar')),
            array('<response><foo>bar</foo><foo>baz</foo></response>', array(), array('foo' => array('bar', 'baz'))),
            array('<response><foo>bar</foo></response>', array('foo' => 'foos'), array('foos' => array('bar'))),
            array(
                '<response><foo>bar</foo><foo>baz</foo></response>',
                array('foo' => 'foos'),
                array('foos' => array('bar', 'baz')),
            ),
        );
    }
}
