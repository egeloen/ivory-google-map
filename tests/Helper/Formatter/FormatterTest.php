<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Formatter;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class FormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Formatter
     */
    private $formatter;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->formatter = new Formatter();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->formatter->isDebug());
        $this->assertSame(4, $this->formatter->getIndentationStep());
    }

    public function testInitialState()
    {
        $this->formatter = new Formatter(true, $indentationStep = 2);

        $this->assertTrue($this->formatter->isDebug());
        $this->assertSame($indentationStep, $this->formatter->getIndentationStep());
    }

    /**
     * @param string      $expected
     * @param string|null $name
     * @param string|null $namespace
     *
     * @dataProvider classProvider
     */
    public function testRenderClass($expected, $name = null, $namespace = null)
    {
        $this->assertSame($expected, $this->formatter->renderClass($name, $namespace));
    }

    /**
     * @param string      $expected
     * @param string      $class
     * @param string      $value
     * @param string|null $namespace
     *
     * @dataProvider constantProvider
     */
    public function testRenderConstant($expected, $class, $value, $namespace = null)
    {
        $this->assertSame($expected, $this->formatter->renderConstant($class, $value, $namespace));
    }

    /**
     * @param string      $expected
     * @param string      $class
     * @param string[]    $arguments
     * @param string|null $namespace
     * @param bool        $semicolon
     * @param bool        $newLine
     * @param bool        $debug
     *
     * @dataProvider objectProvider
     */
    public function testRenderObject(
        $expected,
        $class,
        array $arguments = [],
        $namespace = null,
        $semicolon = false,
        $newLine = false,
        $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderObject(
            $class,
            $arguments,
            $namespace,
            $semicolon,
            $newLine
        ));
    }

    /**
     * @param string      $expected
     * @param string      $object
     * @param string|null $property
     *
     * @dataProvider propertyProvider
     */
    public function testRenderProperty($expected, $object, $property = null)
    {
        $this->assertSame($expected, $this->formatter->renderProperty($object, $property));
    }

    /**
     * @param string                 $expected
     * @param VariableAwareInterface $object
     * @param string                 $method
     * @param string[]               $arguments
     * @param bool                   $semicolon
     * @param bool                   $newLine
     * @param bool                   $debug
     *
     * @dataProvider objectCallProvider
     */
    public function testRenderObjectCall(
        $expected,
        VariableAwareInterface $object,
        $method,
        array $arguments = [],
        $semicolon = false,
        $newLine = false,
        $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderObjectCall(
            $object,
            $method,
            $arguments,
            $semicolon,
            $newLine
        ));
    }

    /**
     * @param string   $expected
     * @param string   $method
     * @param string[] $arguments
     * @param bool     $semicolon
     * @param bool     $newLine
     * @param bool     $debug
     *
     * @dataProvider callProvider
     */
    public function testRenderCall(
        $expected,
        $method,
        array $arguments = [],
        $semicolon = false,
        $newLine = false,
        $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderCall(
            $method,
            $arguments,
            $semicolon,
            $newLine
        ));
    }

    /**
     * @param string      $expected
     * @param string|null $code
     * @param string[]    $arguments
     * @param string|null $name
     * @param bool        $semicolon
     * @param bool        $newLine
     * @param bool        $debug
     *
     * @dataProvider closureProvider
     */
    public function testRenderClosure(
        $expected,
        $code = null,
        array $arguments = [],
        $name = null,
        $semicolon = false,
        $newLine = false,
        $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderClosure(
            $code,
            $arguments,
            $name,
            $semicolon,
            $newLine
        ));
    }

    /**
     * @param string                 $expected
     * @param VariableAwareInterface $object
     * @param string                 $declaration
     * @param bool                   $semicolon
     * @param bool                   $newLine
     * @param bool                   $debug
     *
     * @dataProvider objectAssignmentProvider
     */
    public function testRenderObjectAssignment(
        $expected,
        VariableAwareInterface $object,
        $declaration,
        $semicolon = false,
        $newLine = false,
        $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderObjectAssignment(
            $object,
            $declaration,
            $semicolon,
            $newLine
        ));
    }

    /**
     * @param string                      $expected
     * @param VariableAwareInterface      $root
     * @param string                      $declaration
     * @param string|null                 $propertyPath
     * @param VariableAwareInterface|null $object
     * @param bool                        $semicolon
     * @param bool                        $newLine
     * @param bool                        $debug
     *
     * @dataProvider  containerAssignmentProvider
     */
    public function testRenderContainerAssignment(
        $expected,
        VariableAwareInterface $root,
        $declaration,
        $propertyPath = null,
        VariableAwareInterface $object = null,
        $semicolon = true,
        $newLine = true,
        $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderContainerAssignment(
            $root,
            $declaration,
            $propertyPath,
            $object,
            $semicolon,
            $newLine
        ));
    }

    /**
     * @param string                      $expected
     * @param VariableAwareInterface      $root
     * @param string|null                 $propertyPath
     * @param VariableAwareInterface|null $object
     * @param bool                        $debug
     *
     * @dataProvider containerVariableProvider
     */
    public function testRenderContainerVariable(
        $expected,
        VariableAwareInterface $root,
        $propertyPath = null,
        VariableAwareInterface $object = null,
        $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderContainerVariable($root, $propertyPath, $object));
    }

    /**
     * @param string $expected
     * @param string $variable
     * @param string $declaration
     * @param bool   $semicolon
     * @param bool   $newLine
     * @param bool   $debug
     *
     * @dataProvider assignmentProvider
     */
    public function testRenderAssignment(
        $expected,
        $variable,
        $declaration,
        $semicolon = false,
        $newLine = false,
        $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderAssignment(
            $variable,
            $declaration,
            $semicolon,
            $newLine
        ));
    }

    /**
     * @param string      $expected
     * @param string      $statement
     * @param string      $code
     * @param string|null $condition
     * @param string|null $next
     * @param bool        $newLine
     * @param bool        $debug
     *
     * @dataProvider statementProvider
     */
    public function testRenderStatement(
        $expected,
        $statement,
        $code,
        $condition = null,
        $next = null,
        $newLine = true,
        $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderStatement(
            $statement,
            $code,
            $condition,
            $next,
            $newLine
        ));
    }

    /**
     * @param string $expected
     * @param string $code
     * @param bool   $semicolon
     * @param bool   $newLine
     * @param bool   $debug
     *
     * @dataProvider codeProvider
     */
    public function testRenderCode($expected, $code, $semicolon = true, $newLine = true, $debug = false)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderCode($code, $semicolon, $newLine));
    }

    /**
     * @param string      $expected
     * @param string|null $code
     * @param bool        $debug
     *
     * @dataProvider indentationProvider
     */
    public function testRenderIndentation($expected, $code = null, $debug = false)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderIndentation($code));
    }

    /**
     * @param string   $expected
     * @param string[] $codes
     * @param bool     $newLine
     * @param bool     $eolLine
     * @param bool     $debug
     *
     * @dataProvider linesProvider
     */
    public function testRenderLines($expected, array $codes = [], $newLine = true, $eolLine = true, $debug = false)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderLines($codes, $newLine, $eolLine));
    }

    /**
     * @param string      $expected
     * @param string|null $code
     * @param bool        $newLine
     * @param bool        $debug
     *
     * @dataProvider lineProvider
     */
    public function testRenderLine($expected, $code = null, $newLine = true, $debug = false)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderLine($code, $newLine));
    }

    /**
     * @param string $expected
     * @param string $argument
     *
     * @dataProvider escapeProvider
     */
    public function testRenderEscape($expected, $argument)
    {
        $this->assertSame($expected, $this->formatter->renderEscape($argument));
    }

    /**
     * @param string $expected
     * @param bool   $debug
     *
     * @dataProvider separatorProvider
     */
    public function testRenderSeparator($expected, $debug = false)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderSeparator());
    }

    /**
     * @return mixed[][]
     */
    public function classProvider()
    {
        return [
            ['google.maps'],
            ['google.maps.name', 'name'],
            ['namespace', null, 'namespace'],
            ['name', 'name', false],
            ['namespace.name', 'name', 'namespace'],
        ];
    }

    /**
     * @return string[][]
     */
    public function constantProvider()
    {
        return [
            ['google.maps.class.VALUE', 'class', 'value'],
            ['namespace.class.VALUE', 'class', 'value', 'namespace'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function objectProvider()
    {
        return [
            // Debug disabled
            ['new google.maps.class()', 'class'],
            ['new google.maps.class(arg1,arg2)', 'class', ['arg1', 'arg2']],
            ['new namespace.class()', 'class', [], 'namespace'],
            ['new google.maps.class();', 'class', [], null, true],
            ['new google.maps.class()', 'class', [], null, false, true],
            ['new namespace.class(arg1,arg2);', 'class', ['arg1', 'arg2'], 'namespace', true, true],

            // Debug enabled
            ['new google.maps.class()', 'class', [], null, false, false, true],
            ['new google.maps.class(arg1, arg2)', 'class', ['arg1', 'arg2'], null, false, false, true],
            ['new namespace.class()', 'class', [], 'namespace', false, false, true],
            ['new google.maps.class();', 'class', [], null, true, false, true],
            ['new google.maps.class()'.PHP_EOL, 'class', [], null, false, true, true],
            ['new namespace.class(arg1, arg2);'.PHP_EOL, 'class', ['arg1', 'arg2'], 'namespace', true, true, true],
        ];
    }

    /**
     * @return string[][]
     */
    public function propertyProvider()
    {
        return [
            ['object', 'object'],
            ['object.property', 'object', 'property'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function objectCallProvider()
    {
        return [
            // Debug disabled
            ['variable.method()', $this->createVariableAwareMock(), 'method'],
            ['variable.method(arg1,arg2)', $this->createVariableAwareMock(), 'method', ['arg1', 'arg2']],
            ['variable.method();', $this->createVariableAwareMock(), 'method', [], true],
            ['variable.method()', $this->createVariableAwareMock(), 'method', [], false, true],
            ['variable.method(arg1,arg2);', $this->createVariableAwareMock(), 'method', ['arg1', 'arg2'], true, true],

            // Debug enabled
            ['variable.method()', $this->createVariableAwareMock(), 'method', [], false, false, true],
            ['variable.method(arg1, arg2)', $this->createVariableAwareMock(), 'method', ['arg1', 'arg2'], false, false, true],
            ['variable.method();', $this->createVariableAwareMock(), 'method', [], true, false, true],
            ['variable.method()'.PHP_EOL, $this->createVariableAwareMock(), 'method', [], false, true, true],
            ['variable.method(arg1, arg2);'.PHP_EOL, $this->createVariableAwareMock(), 'method', ['arg1', 'arg2'], true, true, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function callProvider()
    {
        return [
            // Debug disabled
            ['method()', 'method'],
            ['method(arg1,arg2)', 'method', ['arg1', 'arg2']],
            ['method();', 'method', [], true],
            ['method()', 'method', [], false, true],
            ['method(arg1,arg2);', 'method', ['arg1', 'arg2'], true, true],

            // Debug enabled
            ['method()', 'method', [], false, false, true],
            ['method(arg1, arg2)', 'method', ['arg1', 'arg2'], false, false, true],
            ['method();', 'method', [], true, false, true],
            ['method()'.PHP_EOL, 'method', [], false, true, true],
            ['method(arg1, arg2);'.PHP_EOL, 'method', ['arg1', 'arg2'], true, true, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function closureProvider()
    {
        return [
            ['function(){}'],
            ['function(){code}', 'code'],
            ['function(arg1,arg2){}', null, ['arg1', 'arg2']],
            ['function name(){}', null, [], 'name'],
            ['function(){};', null, [], null, true],
            ['function(){}', null, [], null, false, true],
            ['function name(arg1,arg2){code};', 'code', ['arg1', 'arg2'], 'name', true, true],

            ['function () {}', null, [], null, false, false, true],
            ['function () {'.PHP_EOL.'    code'.PHP_EOL.'}', 'code', [], null, false, false, true],
            ['function (arg1, arg2) {}', null, ['arg1', 'arg2'], null, false, false, true],
            ['function name () {}', null, [], 'name', false, false, true],
            ['function () {};', null, [], null, true, false, true],
            ['function () {}'.PHP_EOL, null, [], null, false, true, true],
            ['function name (arg1, arg2) {'.PHP_EOL.'    code'.PHP_EOL.'};'.PHP_EOL, 'code', ['arg1', 'arg2'], 'name', true, true, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function objectAssignmentProvider()
    {
        return [
            // Debug disabled
            ['variable=declaration', $this->createVariableAwareMock(), 'declaration'],
            ['variable=declaration;', $this->createVariableAwareMock(), 'declaration', true],
            ['variable=declaration', $this->createVariableAwareMock(), 'declaration', false, true],
            ['variable=declaration;', $this->createVariableAwareMock(), 'declaration', true, true],

            // Debug enabled
            ['variable = declaration', $this->createVariableAwareMock(), 'declaration', false, false, true],
            ['variable = declaration;', $this->createVariableAwareMock(), 'declaration', true, false, true],
            ['variable = declaration'.PHP_EOL, $this->createVariableAwareMock(), 'declaration', false, true, true],
            ['variable = declaration;'.PHP_EOL, $this->createVariableAwareMock(), 'declaration', true, true, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function containerAssignmentProvider()
    {
        return [
            // Debug disabled
            ['root_container=declaration;', $this->createVariableAwareMock('root'), 'declaration'],
            ['root_container.path=declaration;', $this->createVariableAwareMock('root'), 'declaration', 'path'],
            ['root_container.variable=declaration;', $this->createVariableAwareMock('root'), 'declaration', null, $this->createVariableAwareMock()],
            ['root_container=declaration', $this->createVariableAwareMock('root'), 'declaration', null, null, false],
            ['root_container=declaration;', $this->createVariableAwareMock('root'), 'declaration', null, null, true, false],
            ['root_container.path.variable=declaration', $this->createVariableAwareMock('root'), 'declaration', 'path', $this->createVariableAwareMock(), false, false],

            // Debug enabled
            ['root_container = declaration;'.PHP_EOL, $this->createVariableAwareMock('root'), 'declaration', null, null, true, true, true],
            ['root_container.path = declaration;'.PHP_EOL, $this->createVariableAwareMock('root'), 'declaration', 'path', null, true, true, true],
            ['root_container.variable = declaration;'.PHP_EOL, $this->createVariableAwareMock('root'), 'declaration', null, $this->createVariableAwareMock(), true, true, true],
            ['root_container = declaration'.PHP_EOL, $this->createVariableAwareMock('root'), 'declaration', null, null, false, true, true],
            ['root_container = declaration;', $this->createVariableAwareMock('root'), 'declaration', null, null, true, false, true],
            ['root_container.path.variable = declaration', $this->createVariableAwareMock('root'), 'declaration', 'path', $this->createVariableAwareMock(), false, false, true],
        ];
    }

    /**
     * @return mixed[]
     */
    public function containerVariableProvider()
    {
        return [
            ['root_container', $this->createVariableAwareMock('root')],
            ['root_container.path', $this->createVariableAwareMock('root'), 'path'],
            ['root_container.variable', $this->createVariableAwareMock('root'), null, $this->createVariableAwareMock()],
            ['root_container.path.variable', $this->createVariableAwareMock('root'), 'path', $this->createVariableAwareMock()],
        ];
    }

    /**
     * @return mixed[]
     */
    public function assignmentProvider()
    {
        return [
            // Debug disabled
            ['variable=declaration', 'variable', 'declaration'],
            ['variable=declaration;', 'variable', 'declaration', true],
            ['variable=declaration', 'variable', 'declaration', false, true],
            ['variable=declaration;', 'variable', 'declaration', true, true],

            // Debug enabled
            ['variable = declaration', 'variable', 'declaration', false, false, true],
            ['variable = declaration;', 'variable', 'declaration', true, false, true],
            ['variable = declaration'.PHP_EOL, 'variable', 'declaration', false, true, true],
            ['variable = declaration;'.PHP_EOL, 'variable', 'declaration', true, true, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function statementProvider()
    {
        return [
            // Debug disabled
            ['else{code}', 'else', 'code'],
            ['if(condition){code}', 'if', 'code', 'condition'],
            ['if(condition){code}else{}', 'if', 'code', 'condition', 'else{}', false],

            // Debug enabled
            ['else {'.PHP_EOL.'    code'.PHP_EOL.'}'.PHP_EOL, 'else', 'code', null, null, true, true],
            ['if (condition) {'.PHP_EOL.'    code'.PHP_EOL.'}'.PHP_EOL, 'if', 'code', 'condition', null, true, true],
            ['if (condition) {'.PHP_EOL.'    code'.PHP_EOL.'} else {}', 'if', 'code', 'condition', 'else {}', false, true],
        ];
    }

    /**
     * @return mixed[]
     */
    public function codeProvider()
    {
        return [
            // Debug disabled
            ['code;', 'code'],
            ['code', 'code', false],
            ['code;', 'code', true, false],

            // Debug enabled
            ['code;'.PHP_EOL, 'code', true, true, true],
            ['code'.PHP_EOL, 'code', false, true, true],
            ['code;', 'code', true, false, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function indentationProvider()
    {
        return [
            // Debug disabled
            [''],
            ['code', 'code'],

            // Debug enabled
            ['', null, true],
            ['    code', 'code', true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function linesProvider()
    {
        return [
            // Debug disabled
            [''],
            ['line1;line2;', ['line1;', 'line2;']],
            ['line1;line2;', ['line1;', 'line2;'], false],
            ['line1;line2;', ['line1;', 'line2;'], true, false],
            ['line1;line2;', ['line1;', 'line2;'], false, false],

            // Debug enabled
            ['', [], true, true, true],
            ['line1;'.PHP_EOL.'line2;'.PHP_EOL, ['line1;', 'line2;'], true, true, true],
            ['line1;line2;'.PHP_EOL, ['line1;', 'line2;'], false, true, true],
            ['line1;'.PHP_EOL.'line2;', ['line1;', 'line2;'], true, false, true],
            ['line1;line2;', ['line1;', 'line2;'], false, false, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function lineProvider()
    {
        return [
            // Debug disabled
            [''],
            ['line', 'line'],
            ['line', 'line', false],

            // Debug enabled
            ['', null, true, true],
            ['line'.PHP_EOL, 'line', true, true],
            ['line', 'line', false, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function escapeProvider()
    {
        return [
            ['null', null],
            ['true', true],
            ['false', false],
            ['"foo"', 'foo'],
            ['"/"', '/'],
            ['"\'"', '\''],
            ['"\\""', '"'],
            ['"Dakar, Sénégal"', 'Dakar, Sénégal'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function separatorProvider()
    {
        return [
            [''],
            [' ', true],
        ];
    }

    /**
     * @param string $variable
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|VariableAwareInterface
     */
    private function createVariableAwareMock($variable = 'variable')
    {
        $variableAware = $this->createMock(VariableAwareInterface::class);
        $variableAware
            ->expects($this->once())
            ->method('getVariable')
            ->will($this->returnValue($variable));

        return $variableAware;
    }
}
