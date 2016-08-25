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
     * @param string  $data
     * @param mixed[] $expected
     * @param mixed[] $options
     *
     * @dataProvider parseProvider
     */
    public function testParse($data, array $expected, array $options = [])
    {
        $this->assertSame($expected, $this->xmlParser->parse($data, $options));
    }

    /**
     * @return mixed[]
     */
    public function parseProvider()
    {
        $data = '<response><foo_foo>bar</foo_foo></response>';

        return [
            [$data, ['foo_foo' => 'bar']],
            [$data, ['baz' => ['bar']],  ['pluralization_rules' => ['foo_foo' => 'baz']]],
            [$data, ['fooFoo' => 'bar'], ['snake_to_camel' => true]],
            [
                $data,
                ['fooBaz' => ['bar']],
                [
                    'pluralization_rules' => ['foo_foo' => 'foo_baz'],
                    'snake_to_camel'      => true,
                ],
            ],
        ];
    }
}
