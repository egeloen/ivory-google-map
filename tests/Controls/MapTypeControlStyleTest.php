<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Controls;

use Ivory\GoogleMap\Controls\MapTypeControlStyle;

/**
 * Map type control style test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Controls\MapTypeControlStyle');
    }

    public function testConstants()
    {
        $this->assertSame('default', MapTypeControlStyle::DEFAULT_);
        $this->assertSame('dropdown_menu', MapTypeControlStyle::DROPDOWN_MENU);
        $this->assertSame('horizontal_bar', MapTypeControlStyle::HORIZONTAL_BAR);
    }
}
