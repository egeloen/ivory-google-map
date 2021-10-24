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

use Ivory\GoogleMap\Helper\Builder\AbstractJavascriptHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
use Ivory\GoogleMap\Helper\MapHelper;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelperBuilderTest extends TestCase
{
    /**
     * @var MapHelperBuilder
     */
    private $mapHelperBuilder;

    protected function setUp(): void
    {
        $this->mapHelperBuilder = MapHelperBuilder::create();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJavascriptHelperBuilder::class, $this->mapHelperBuilder);
    }

    public function testBuild()
    {
        $this->assertInstanceOf(MapHelper::class, $this->mapHelperBuilder->build());
    }
}
