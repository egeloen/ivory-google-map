<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Base;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Base\PointHelper;

/**
 * Point helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Base\PointHelper */
    protected $pointHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pointHelper = new PointHelper();
    }

    public function testRender()
    {
        $point = new Point(1.1, 2.1);
        $point->setJavascriptVariable('foo');

        $this->assertSame('foo = new google.maps.Point(1.1, 2.1);'.PHP_EOL, $this->pointHelper->render($point));
    }
}
