<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Builder;

use Ivory\GoogleMap\Helper\ApiHelper;
use Ivory\GoogleMap\Helper\Builder\AbstractJavascriptHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiHelperBuilderTest extends TestCase
{
    /**
     * @var ApiHelperBuilder
     */
    private $apiHelperBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->apiHelperBuilder = ApiHelperBuilder::create();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJavascriptHelperBuilder::class, $this->apiHelperBuilder);
    }

    public function testDefaultState()
    {
        $this->assertSame('en', $this->apiHelperBuilder->getLanguage());
        $this->assertFalse($this->apiHelperBuilder->hasKey());
        $this->assertNull($this->apiHelperBuilder->getKey());
    }

    public function testLanguage()
    {
        $this->assertSame($this->apiHelperBuilder, $this->apiHelperBuilder->setLanguage($language = 'fr'));
        $this->assertSame($language, $this->apiHelperBuilder->getLanguage());
    }

    public function testKey()
    {
        $this->assertSame($this->apiHelperBuilder, $this->apiHelperBuilder->setKey($key = 'key'));
        $this->assertTrue($this->apiHelperBuilder->hasKey());
        $this->assertSame($key, $this->apiHelperBuilder->getKey());
    }

    public function testBuild()
    {
        $this->assertInstanceOf(ApiHelper::class, $this->apiHelperBuilder->build());
    }
}
