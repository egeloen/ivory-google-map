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

    public function testDefaultState()
    {
        $this->assertSame(
            '//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js',
            $this->infoBoxExtensionHelper->getSource()
        );

        $this->assertSame('load_ivory_google_map_info_box', $this->infoBoxExtensionHelper->getCallback());
    }

    public function testInitialState()
    {
        $this->infoBoxExtensionHelper = new InfoBoxExtensionHelper('foo', 'bar');

        $this->assertSame('foo', $this->infoBoxExtensionHelper->getSource());
        $this->assertSame('bar', $this->infoBoxExtensionHelper->getCallback());
    }

    public function testRenderLibrariesWithSyncMap()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $expected = <<<EOF
<script type="text/javascript" src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js"></script>

EOF;

        $this->assertSame($expected, $this->infoBoxExtensionHelper->renderLibraries($map));
    }

    public function testRenderBeforeWithSyncMap()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->assertNull($this->infoBoxExtensionHelper->renderBefore($map));
    }

    public function testRenderAfterWithSyncMap()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->assertNull($this->infoBoxExtensionHelper->renderAfter($map));
    }

    public function testRenderLibrariesWithAsyncMap()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('isAsync')
            ->will($this->returnValue(true));

        $this->assertNull($this->infoBoxExtensionHelper->renderLibraries($map));
    }

    public function testRenderBeforeWithAsyncMap()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('isAsync')
            ->will($this->returnValue(true));

        $expected = <<<EOF
function load_ivory_google_map_info_box () {

EOF;

        $this->assertSame($expected, $this->infoBoxExtensionHelper->renderBefore($map));
    }

    public function testRenderAfterWithAsyncMap()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('isAsync')
            ->will($this->returnValue(true));

        $expected = <<<EOF
}
var s = document.createElement("script");
s.type = "text/javascript";
s.async = true;
s.src = "//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js";
s.addEventListener("load", function () { load_ivory_google_map_info_box(); }, false);
document.getElementsByTagName("head")[0].appendChild(s);

EOF;

        $this->assertSame($expected, $this->infoBoxExtensionHelper->renderAfter($map));
    }
}
