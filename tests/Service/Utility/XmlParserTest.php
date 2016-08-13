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

use Ivory\GoogleMap\Service\Utility\XmlParser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var XmlParser
     */
    private $xmlParser;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->xmlParser = new XmlParser();
    }

    /**
     * @param string   $xml
     * @param mixed[]  $expected
     * @param string[] $rules
     *
     * @dataProvider parseProvider
     */
    public function testParse($xml, array $expected, array $rules = [], $snakeToCamelCase = false)
    {
        $this->assertSame($expected, $this->xmlParser->parse($xml, $rules, $snakeToCamelCase));
    }

    /**
     * @return mixed[]
     */
    public function parseProvider()
    {
        $xml = '<response><foo_foo>bar</foo_foo></response>';

        return [
            [$xml, ['foo_foo' => 'bar']],
            [$xml, ['baz' => ['bar']],  ['foo_foo' => 'baz']],
            [$xml, ['fooFoo' => 'bar'], [], true],
            [$xml, ['fooBaz' => ['bar']], ['foo_foo' => 'foo_baz'], true],
        ];
    }
}
