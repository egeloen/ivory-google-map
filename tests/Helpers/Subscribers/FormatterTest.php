<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers;

use Ivory\GoogleMap\Assets\AbstractVariableAsset;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Formatter test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class FormatterTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Formatter */
    private $formatter;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->formatter = new Formatter();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->formatter);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->formatter->isDebug());
        $this->assertSame(4, $this->formatter->getIndentation());
    }

    public function testInitialState()
    {
        $this->formatter = new Formatter(true, $indentation = 2);

        $this->assertTrue($this->formatter->isDebug());
        $this->assertSame($indentation, $this->formatter->getIndentation());
    }

    public function testSetDebug()
    {
        $this->formatter->setDebug(true);

        $this->assertTrue($this->formatter->isDebug());
    }

    public function testSetIndentation()
    {
        $this->formatter->setIndentation($indentation = 2);

        $this->assertSame($indentation, $this->formatter->getIndentation());
    }

    /**
     * @dataProvider formatSeparatorProvider
     */
    public function testFormatSeparator($expected, $debug)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->formatSeparator());
    }

    /**
     * @dataProvider formatLineProvider
     */
    public function testFormatLine($expected, $debug)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->formatLine('line'));
    }

    /**
     * @dataProvider formatIndentationProvider
     */
    public function testFormatIndentation($expected, $code, $debug, $indentation = 4)
    {
        $this->formatter->setDebug($debug);
        $this->formatter->setIndentation($indentation);

        $this->assertSame($expected, $this->formatter->formatIndentation($code));
    }

    /**
     * @dataProvider formatTagProvider
     */
    public function testFormatTag(
        $expected,
        $debug,
        $indentation = 4,
        $content = null,
        array $attributes = array(),
        $inline = false
    ) {
        $this->formatter->setDebug($debug);
        $this->formatter->setIndentation($indentation);

        $this->assertSame($expected, $this->formatter->formatTag('name', $content, $attributes, $inline));
    }

    /**
     * @dataProvider formatStylesheetProvider
     */
    public function testFormatStylesheet($expected, $debug, $indentation = 4)
    {
        $this->formatter->setDebug($debug);
        $this->formatter->setIndentation($indentation);

        $this->assertSame($expected, $this->formatter->formatStylesheet('#id', array('foo' => 'bar', 'baz' => 'bat')));
    }

    /**
     * @dataProvider formatJavascriptProvider
     */
    public function testFormatJavascript($expected, $debug, $indentation = 4)
    {
        $this->formatter->setDebug($debug);
        $this->formatter->setIndentation($indentation);

        $this->assertSame($expected, $this->formatter->formatJavascript('code'));
    }

    /**
     * @dataProvider formatCodeProvider
     */
    public function testFormatCode($expected, $debug, $semicolon = true, $format = true)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->formatCode('code', $semicolon, $format));
    }

    /**
     * @dataProvider formatTernaryProvider
     */
    public function testFormatTernary($expected, $debug, $semicolon = true, $format = true)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame(
            $expected,
            $this->formatter->formatTernary('condition', 'value1', 'value2', $semicolon, $format)
        );
    }

    /**
     * @dataProvider formatIfProvider
     */
    public function testFormatIf($expected, $debug, $indentation = 4, array $elseIfs = array(), $elseCode = null)
    {
        $this->formatter->setDebug($debug);
        $this->formatter->setIndentation($indentation);

        $this->assertSame($expected, $this->formatter->formatIf('condition', 'code', $elseIfs, $elseCode));
    }

    /**
     * @dataProvider formatSourceProvider
     */
    public function testFormatSource($expected, $debug, $indentation = 4, $callback = null)
    {
        $this->formatter->setDebug($debug);
        $this->formatter->setIndentation($indentation);

        $this->assertSame($expected, $this->formatter->formatSource('source', $callback));
    }

    /**
     * @dataProvider formatFunctionProvider
     */
    public function testFormatFunction(
        $expected,
        $debug,
        $indentation = 4,
        array $arguments = array(),
        $name = null,
        $semicolon = true,
        $formatStart = true,
        $formatEnd = true
    ) {
        $this->formatter->setDebug($debug);
        $this->formatter->setIndentation($indentation);

        $this->assertSame(
            $expected,
            $this->formatter->formatFunction('code', $arguments, $name, $semicolon, $formatStart, $formatEnd)
        );
    }

    /**
     * @dataProvider formatFunctionCallProvider
     */
    public function testFormatFunctionCall(
        $expected,
        $debug,
        array $arguments = array(),
        $semicolon = true,
        $format = true
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->formatFunctionCall('name', $arguments, $semicolon, $format));
    }

    /**
     * @dataProvider formatAssignmentProvider
     */
    public function testFormatAssignment($expected, $debug, $semicolon = true, $format = true, $operator = '=')
    {
        $this->formatter->setDebug($debug);

        $this->assertSame(
            $expected,
            $this->formatter->formatAssignment('variable', 'code', $semicolon, $format, $operator)
        );
    }

    public function testFormatCallback()
    {
        $this->assertSame('variable_callback', $this->formatter->formatCallback('variable'));
    }

    public function testFormatAssetCallback()
    {
        $this->assertSame('variable_callback', $this->formatter->formatAssetCallback($this->createVariableAssetMock()));
    }

    /**
     * @dataProvider formatAssetAssignmentProvider
     */
    public function testFormatAssetAssignment($expected, $debug, $semicolon = true, $format = true, $operator = '=')
    {
        $this->formatter->setDebug($debug);

        $this->assertSame(
            $expected,
            $this->formatter->formatAssetAssignment(
                $this->createVariableAssetMock(),
                'code',
                $semicolon,
                $format,
                $operator
            )
        );
    }

    /**
     * @dataProvider formatContainerVariableProvider
     */
    public function testFormatVariableAssignment($expected, $level = null, AbstractVariableAsset $asset = null)
    {
        $this->assertSame(
            $expected,
            $this->formatter->formatContainerVariable($this->createVariableAssetMock('base'), $level, $asset)
        );
    }

    /**
     * @dataProvider formatContainerAssignmentProvider
     */
    public function testFormatContainerAssignment(
        $expected,
        $debug = false,
        AbstractVariableAsset $asset = null,
        $level = null,
        $append = true,
        $semicolon = true,
        $format = true
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame(
            $expected,
            $this->formatter->formatContainerAssignment(
                $this->createVariableAssetMock('base'),
                'code',
                $level,
                $asset,
                $append,
                $semicolon,
                $format
            )
        );
    }

    /**
     * Gets the format seperator provider.
     *
     * @return array The format separator provider.
     */
    public function formatSeparatorProvider()
    {
        return array(
            array('', false),
            array(' ', true),
        );
    }

    /**
     * Gets the format line provider.
     *
     * @return array The format line provider.
     */
    public function formatLineProvider()
    {
        return array(
            array('line', false),
            array(
                'line
',
                true,
            ),
        );
    }

    /**
     * Gets the format indentation provider.
     *
     * @return array The format indentation provider.
     */
    public function formatIndentationProvider()
    {
        return array(
            array('', '', false),
            array('', '', true),
            array('', '', false, 2),
            array('', '', true, 2),
            array('code', 'code', false),
            array('    code', 'code', true),
            array('code', 'code', false, 2),
            array('  code', 'code', true, 2),
            array('code'.PHP_EOL, 'code'.PHP_EOL, false),
            array('    code'.PHP_EOL, 'code'.PHP_EOL, true),
            array('code'.PHP_EOL, 'code'.PHP_EOL, false, 2),
            array('  code'.PHP_EOL, 'code'.PHP_EOL, true, 2),
            array('code1'.PHP_EOL.'code2', 'code1'.PHP_EOL.'code2', false),
            array('    code1'.PHP_EOL.'    code2', 'code1'.PHP_EOL.'code2', true),
            array('code1'.PHP_EOL.'code2', 'code1'.PHP_EOL.'code2', false, 2),
            array('  code1'.PHP_EOL.'  code2', 'code1'.PHP_EOL.'code2', true, 2),
        );
    }

    /**
     * Gets the format tag provider.
     *
     * @return array The format tag provider.
     */
    public function formatTagProvider()
    {
        return array(
            array('<name></name>', false),
            array(
                '<name></name>
',
                true,
            ),
            array('<name>content</name>', false, 4, 'content'),
            array(
                '<name>
    content</name>
',
                true,
                4,
                'content',
            ),
            array(
                '<name>
  content</name>
',
                true,
                2,
                'content',
            ),
            array('<name foo="bar">content</name>', false, 4, 'content', array('foo' => 'bar')),
            array(
                '<name foo="bar">
    content</name>
',
                true,
                4,
                'content',
                array('foo' => 'bar'),
            ),
            array(
                '<name foo="bar">
  content</name>
',
                true,
                2,
                'content',
                array('foo' => 'bar'),
            ),
            array('<name foo="bar" />', false, 4, null, array('foo' => 'bar'), true),
            array(
                '<name foo="bar" />
',
                true,
                4,
                null,
                array('foo' => 'bar'),
                true,
            ),
            array('<name foo="bar">content</name>', false, 4, 'content', array('foo' => 'bar'), true),
            array(
                '<name foo="bar">
    content</name>
',
                true,
                4,
                'content',
                array('foo' => 'bar'),
                true,
            ),
            array(
                '<name foo="bar">
  content</name>
',
                true,
                2,
                'content',
                array('foo' => 'bar'),
                true,
            ),
        );
    }

    /**
     * Gets the format stylesheet provider.
     *
     * @return array The format stylesheet provider.
     */
    public function formatStylesheetProvider()
    {
        return array(
            array('<style type="text/css">#id{foo:bar;baz:bat;}</style>', false),
            array(
                '<style type="text/css">
    #id {
        foo: bar;
        baz: bat;
    }
</style>
',
                true,
            ),
            array(
                '<style type="text/css">
  #id {
    foo: bar;
    baz: bat;
  }
</style>
',
                true,
                2,
            ),
        );
    }

    /**
     * Gets the format javascript provider.
     *
     * @return array The format javascript provider.
     */
    public function formatJavascriptProvider()
    {
        return array(
            array('<script type="text/javascript">code</script>', false),
            array(
                '<script type="text/javascript">
    code</script>
',
                true,
            ),
            array(
                '<script type="text/javascript">
  code</script>
',
                true,
                2,
            ),
        );
    }

    /**
     * Gets the format code provider.
     *
     * @return array The format code provider.
     */
    public function formatCodeProvider()
    {
        return array(
            array('code;', false),
            array(
                'code;
',
                true,
            ),
            array('code', false, false),
            array(
                'code
',
                true,
                false,
            ),
            array('code;', false, true, false),
            array('code;', true, true, false),
        );
    }

    /**
     * Gets the format ternary provider.
     *
     * @return array The format ternary provider.
     */
    public function formatTernaryProvider()
    {
        return array(
            array('condition?value1:value2;', false),
            array(
                'condition ? value1 : value2;
',
                true,
            ),
            array('condition?value1:value2', false, false),
            array(
                'condition ? value1 : value2
',
                true,
                false,
            ),
            array('condition?value1:value2', false, false, false),
            array('condition ? value1 : value2', true, false, false),
        );
    }

    /**
     * Gets the if provider.
     *
     * @return array The if provider.
     */
    public function formatIfProvider()
    {
        return array(
            array('if(condition){code}', false),
            array(
                'if (condition) {
    code}
',
                true,
            ),
            array('if(condition){code}', false, 2),
            array(
                'if (condition) {
  code}
',
                true,
                2,
            ),
            array('if(condition){code}elseif(foo){bar}', false, 4, array('foo' => 'bar')),
            array(
                'if (condition) {
    code} elseif (foo) {
    bar}
',
                true,
                4,
                array('foo' => 'bar'),
            ),
            array(
                'if (condition) {
  code} elseif (foo) {
  bar}
',
                true,
                2,
                array('foo' => 'bar'),
            ),
            array('if(condition){code}elseif(foo){bar}else{baz}', false, 4, array('foo' => 'bar'), 'baz'),
            array(
                'if (condition) {
    code} elseif (foo) {
    bar} else {
    baz}
',
                true,
                4,
                array('foo' => 'bar'),
                'baz',
            ),
            array(
                'if (condition) {
  code} elseif (foo) {
  bar} else {
  baz}
',
                true,
                2,
                array('foo' => 'bar'),
                'baz',
            ),
        );
    }

    /**
     * Gets the format source provider.
     *
     * @return array The format source provider.
     */
    public function formatSourceProvider()
    {
        return array(
            array('<script type="text/javascript" src="source"></script>', false),
            array(
                '<script type="text/javascript" src="source"></script>
',
                true,
            ),
            array(
                'var s=document.createElement("script");s.type="text/javascript";s.async=true;s.src="source";if(s.attachEvent){s.attachEvent("onreadystatechange",function(){if(s.readyState==="complete"){callback();}});}else{s.addEventListener("load",callback,false);}document.getElementsByTagName("head")[0].appendChild(s);',
                false,
                4,
                'callback',
            ),
            array(
                'var s = document.createElement("script");
s.type = "text/javascript";
s.async = true;
s.src = "source";
if (s.attachEvent) {
    s.attachEvent("onreadystatechange", function () {
        if (s.readyState === "complete") {
            callback();
        }
    });
} else {
    s.addEventListener("load", callback, false);
}
document.getElementsByTagName("head")[0].appendChild(s);
',
                true,
                4,
                'callback',
            ),
            array(
                'var s = document.createElement("script");
s.type = "text/javascript";
s.async = true;
s.src = "source";
if (s.attachEvent) {
  s.attachEvent("onreadystatechange", function () {
    if (s.readyState === "complete") {
      callback();
    }
  });
} else {
  s.addEventListener("load", callback, false);
}
document.getElementsByTagName("head")[0].appendChild(s);
',
                true,
                2,
                'callback',
            ),
        );
    }

    /**
     * Gets the format function provider.
     *
     * @return array The format function provider.
     */
    public function formatFunctionProvider()
    {
        return array(
            array('function(){code};', false),
            array(
                'function () {
    code};
',
                true,
            ),
            array('function(foo,bar){code};', false, 4, array('foo', 'bar')),
            array(
                'function (foo, bar) {
    code};
',
                true,
                4,
                array('foo', 'bar'),
            ),
            array(
                'function (foo, bar) {
  code};
',
                true,
                2,
                array('foo', 'bar'),
            ),
            array('function baz(foo,bar){code};', false, 4, array('foo', 'bar'), 'baz'),
            array(
                'function baz(foo, bar) {
    code};
',
                true,
                4,
                array('foo', 'bar'),
                'baz',
            ),
            array(
                'function baz(foo, bar) {
  code};
',
                true,
                2,
                array('foo', 'bar'),
                'baz',
            ),
            array('function baz(foo,bar){code}', false, 4, array('foo', 'bar'), 'baz', false),
            array(
                'function baz(foo, bar) {
    code}
',
                true,
                4,
                array('foo', 'bar'),
                'baz',
                false,
            ),
            array(
                'function baz(foo, bar) {
  code}
',
                true,
                2,
                array('foo', 'bar'),
                'baz',
                false,
            ),
            array('function baz(foo,bar){code}', false, 4, array('foo', 'bar'), 'baz', false, false),
            array(
                'function baz(foo, bar) {code}
',
                true,
                4,
                array('foo', 'bar'),
                'baz',
                false,
                false,
            ),
            array('function baz(foo,bar){code}', false, 4, array('foo', 'bar'), 'baz', false, false, false),
            array('function baz(foo, bar) {code}', true, 4, array('foo', 'bar'), 'baz', false, false, false),
        );
    }

    /**
     * Gets the format function call provider.
     *
     * @return array The format function call provider.
     */
    public function formatFunctionCallProvider()
    {
        return array(
            array('name();', false),
            array(
            'name();
',
                true,
            ),
            array('name(argument);', false, array('argument')),
            array(
                'name(argument);
',
                true,
                array('argument'),
            ),
            array('name(argument1,argument2)', false, array('argument1', 'argument2'), false),
            array(
                'name(argument1, argument2)
',
                true,
                array('argument1', 'argument2'),
                false,
            ),
            array('name(argument1,argument2)', false, array('argument1', 'argument2'), false, false),
            array('name(argument1, argument2)', true, array('argument1', 'argument2'), false, false),
        );
    }

    /**
     * Gets the format assignment provider.
     *
     * @return array The format assignment provider.
     */
    public function formatAssignmentProvider()
    {
        return array(
            array('variable=code;', false),
            array(
                'variable = code;
',
                true,
            ),
            array('variable=code', false, false),
            array(
                'variable = code
',
                true,
                false,
            ),
            array('variable=code;', false, true, false),
            array('variable = code;', true, true, false),
            array('variable:code;', false, true, true, ':'),
            array(
                'variable : code;
',
                true,
                true,
                true,
                ':',
            ),
        );
    }

    /**
     * Gets the format asset assignment provider.
     *
     * @return array The format asset assignment provider.
     */
    public function formatAssetAssignmentProvider()
    {
        return array(
            array('variable=code;', false),
            array(
                'variable = code;
',
                true,
            ),
            array('variable=code', false, false),
            array(
                'variable = code
',
                true,
                false,
            ),
            array('variable=code;', false, true, false),
            array('variable = code;', true, true, false),
            array('variable:code;', false, true, true, ':'),
            array(
                'variable : code;
',
                true,
                true,
                true,
                ':',
            ),
        );
    }

    /**
     * Gets the format container variable provider.
     *
     * @return array The format container variable provider.
     */
    public function formatContainerVariableProvider()
    {
        return array(
            array('base_container'),
            array('base_container.level', 'level'),
            array('base_container.variable', null, $this->createVariableAssetMock()),
            array('base_container.level.variable', 'level', $this->createVariableAssetMock()),
        );
    }

    /**
     * Gets the format container assignment provider.
     *
     * @return array The format container assignment provider.
     */
    public function formatContainerAssignmentProvider()
    {
        return array(
            array('base_container=code;'),
            array(
                'base_container = code;
',
                true,
            ),
            array('base_container.variable=variable=code;', false, $this->createVariableAssetMock()),
            array(
                'base_container.variable = variable = code;
',
                true,
                $this->createVariableAssetMock(),
            ),
            array('base_container.level=code;', false, null, 'level'),
            array(
                'base_container.level = code;
',
                true,
                null,
                'level',
            ),
            array('base_container.level.variable=variable=code;', false, $this->createVariableAssetMock(), 'level'),
            array(
                'base_container.level.variable = variable = code;
',
                true,
                $this->createVariableAssetMock(),
                'level',
            ),
            array('base_container=variable=code;', false, $this->createVariableAssetMock(), null, false),
            array(
                'base_container = variable = code;
',
                true,
                $this->createVariableAssetMock(),
                null,
                false,
            ),
            array('base_container.level=variable=code;', false, $this->createVariableAssetMock(), 'level', false),
            array(
                'base_container.level = variable = code;
',
                true,
                $this->createVariableAssetMock(),
                'level',
                false,
            ),
            array(
                'base_container.level.variable=variable=code',
                false,
                $this->createVariableAssetMock(),
                'level',
                true,
                false,
            ),
            array(
                'base_container.level.variable = variable = code
',
                true,
                $this->createVariableAssetMock(),
                'level',
                true,
                false,
            ),
            array(
                'base_container.level.variable = variable = code;',
                true,
                $this->createVariableAssetMock(),
                'level',
                true,
                true,
                false,
            ),
        );
    }

    /**
     * Creates a variable asset mock.
     *
     * @param string $variable The variable.
     *
     * @return \Ivory\GoogleMap\Assets\AbstractVariableAsset|\PHPUnit_Framework_MockObject_MockObject The variable asset mock.
     */
    protected function createVariableAssetMock($variable = 'variable')
    {
        $variableAsset = parent::createVariableAssetMock();
        $variableAsset
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue($variable));

        return $variableAsset;
    }
}
