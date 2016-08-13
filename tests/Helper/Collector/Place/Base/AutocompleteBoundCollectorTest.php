<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Place\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Collector\Place\Base\AutocompleteBoundCollector;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteBoundCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AutocompleteBoundCollector
     */
    private $autocompleteBoundCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocompleteBoundCollector = new AutocompleteBoundCollector();
    }

    public function testCollect()
    {
        $this->assertEmpty($this->autocompleteBoundCollector->collect(new Autocomplete()));
    }

    public function testCollectBound()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setBound($bound = new Bound());

        $this->assertSame([$bound], $this->autocompleteBoundCollector->collect($autocomplete));
    }
}
