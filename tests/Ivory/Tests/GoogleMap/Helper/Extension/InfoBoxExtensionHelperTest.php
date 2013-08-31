<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Extension;

use Ivory\GoogleMap\Helper\Extension\InfoBoxExtensionHelper;

/**
 * InfoBox extension helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxExtensionHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Extension\InfoBoxExtensionHelper */
    protected $infoBoxExtensionHelper;

    /**
     * {@ineritdoc}
     */
    protected function setUp()
    {
        $this->infoBoxExtensionHelper = new InfoBoxExtensionHelper();
    }

    /**
     * {@ineritdoc}
     */
    protected function tearDown()
    {
        unset($this->infoBoxExtensionHelper);
    }

    public function testRenderLibraries()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $expected = <<<EOF
<script type="text/javascript" src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js"></script>

EOF;

        $this->assertSame($expected, $this->infoBoxExtensionHelper->renderLibraries($map));
    }

    public function testRenderBefore()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->assertNull($this->infoBoxExtensionHelper->renderBefore($map));
    }

    public function testRenderAfterr()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->assertNull($this->infoBoxExtensionHelper->renderAfter($map));
    }
}
