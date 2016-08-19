<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Control;

use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\CustomControl;
use Ivory\GoogleMap\Map;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class CustomControlFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getControlManager()->addCustomControl(new CustomControl(
            ControlPosition::RIGHT_CENTER,
            $this->getControl()
        ));

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return string
     */
    private function getControl()
    {
        return <<<'EOF'
var container = document.createElement('div');
container.style.backgroundColor = '#fff';
container.style.border = '2px solid #fff';
container.style.marginBottom = '22px';
container.style.textAlign = 'center';

var text = document.createElement('div');
text.style.color = 'rgb(25,25,25)';
text.style.fontFamily = 'Arial,sans-serif';
text.style.fontSize = '16px';
text.style.lineHeight = '38px';
text.style.paddingLeft = '5px';
text.style.paddingRight = '5px';
text.innerHTML = 'Legend';

var control = document.createElement('div');
control.appendChild(container);
container.appendChild(text);

return control;
EOF;
    }
}
