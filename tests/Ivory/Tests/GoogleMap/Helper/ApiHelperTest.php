<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper;

use Ivory\GoogleMap\Helper\ApiHelper;

/**
 * Api helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\ApiHelper */
    protected $apiHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->apiHelper = new ApiHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->apiHelper);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->apiHelper->isLoaded());
    }

    public function testRenderWithDefaultValues()
    {
        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"en","other_params":"sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->apiHelper->render());
    }

    public function testRenderWithLanguage()
    {
        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"fr","other_params":"sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->apiHelper->render('fr'));
    }

    public function testRenderWithoutLibraries()
    {
        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"en","other_params":"sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->apiHelper->render('en', array()));
    }

    public function testRenderWithLibraries()
    {
        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"en","other_params":"libraries=geometry,places&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->apiHelper->render('en', array('geometry', 'places')));
    }

    public function testRenderWithCallback()
    {
        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"en","other_params":"sensor=false", "callback": callback}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->apiHelper->render('en', array(), 'callback'));
    }

    public function testRenderWithSensor()
    {
        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"language":"en","other_params":"sensor=true"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->apiHelper->render('en', array(), null, true));
    }
}
