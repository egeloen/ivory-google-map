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

use Ivory\GoogleMap\Service\Utility\JsonParser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var JsonParser
     */
    private $jsonParser;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->jsonParser = new JsonParser();
    }

    /**
     * @param string  $data
     * @param string  $expected
     * @param mixed[] $options
     *
     * @dataProvider parseProvider
     */
    public function testParse($data, $expected, array $options = [])
    {
        $this->assertSame($expected, $this->jsonParser->parse($data, $options));
    }

    /**
     * @return mixed[][]
     */
    public function parseProvider()
    {
        return [
            ['[]', []],
            ['{}', []],
            ['[1, 2, 3]', [1, 2, 3]],
            ['{"foo": "bar", "baz": ["bat"]}', ['foo' => 'bar', 'baz' => ['bat']]],
        ];
    }
}
