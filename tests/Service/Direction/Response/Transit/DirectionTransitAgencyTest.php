<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction\Response\Transit;

use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitAgency;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitAgencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionTransitAgency
     */
    private $transitAgency;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->transitAgency = new DirectionTransitAgency();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->transitAgency->hasName());
        $this->assertNull($this->transitAgency->getName());
        $this->assertFalse($this->transitAgency->hasPhone());
        $this->assertNull($this->transitAgency->getPhone());
        $this->assertFalse($this->transitAgency->hasUrl());
        $this->assertNull($this->transitAgency->getUrl());
    }

    public function testName()
    {
        $this->transitAgency->setName($name = 'name');

        $this->assertTrue($this->transitAgency->hasName());
        $this->assertSame($name, $this->transitAgency->getName());
    }

    public function testPhone()
    {
        $this->transitAgency->setPhone($phone = 'phone');

        $this->assertTrue($this->transitAgency->hasPhone());
        $this->assertSame($phone, $this->transitAgency->getPhone());
    }

    public function testUrl()
    {
        $this->transitAgency->setUrl($url = 'url');

        $this->assertTrue($this->transitAgency->hasUrl());
        $this->assertSame($url, $this->transitAgency->getUrl());
    }
}
