<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Events;

use Ivory\GoogleMap\Events\MouseEvent;

/**
 * Mouse event test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MouseEventTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Events\MouseEvent');
    }

    public function testConstants()
    {
        $this->assertSame('click', MouseEvent::CLICK);
        $this->assertSame('dblclick', MouseEvent::DBLCLICK);
        $this->assertSame('mouseup', MouseEvent::MOUSEUP);
        $this->assertSame('mousedown', MouseEvent::MOUSEDOWN);
        $this->assertSame('mouseover', MouseEvent::MOUSEOVER);
        $this->assertSame('mouseout', MouseEvent::MOUSEOUT);
    }
}
