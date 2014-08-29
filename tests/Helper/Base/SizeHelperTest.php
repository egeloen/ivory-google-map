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

use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\Base\SizeHelper;

/**
 * Size helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Base\SizeHelper */
    protected $sizeHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->sizeHelper = new SizeHelper();
    }

    public function testRenderWithoutUnits()
    {
        $size = new Size(1.1, 2.1);
        $size->setJavascriptVariable('foo');

        $this->assertSame('foo = new google.maps.Size(1.1, 2.1);'.PHP_EOL, $this->sizeHelper->render($size));
    }

    public function testRenderWithUnits()
    {
        $size = new Size(1.1, 2.1, 'px', '%');
        $size->setJavascriptVariable('foo');

        $this->assertSame('foo = new google.maps.Size(1.1, 2.1, "px", "%");'.PHP_EOL, $this->sizeHelper->render($size));
    }
}
