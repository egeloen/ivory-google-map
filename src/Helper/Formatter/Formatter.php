<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source declaration.
 */

namespace Ivory\GoogleMap\Helper\Formatter;

use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Formatter
{
    /**
     * @var bool
     */
    private $debug;

    /**
     * @var int
     */
    private $indentationStep;

    /**
     * @param bool $debug
     * @param int  $indentationStep
     */
    public function __construct($debug = false, $indentationStep = 4)
    {
        $this->setDebug($debug);
        $this->setIndentationStep($indentationStep);
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @return int
     */
    public function getIndentationStep()
    {
        return $this->indentationStep;
    }

    /**
     * @param int $indentationStep
     */
    public function setIndentationStep($indentationStep)
    {
        $this->indentationStep = $indentationStep;
    }

    /**
     * @param string|null       $name
     * @param string|false|null $namespace
     *
     * @return string
     */
    public function renderClass($name = null, $namespace = null)
    {
        if ($namespace === null) {
            $namespace = $this->renderProperty('google', 'maps');
        }

        if (empty($namespace)) {
            return $name;
        }

        return $this->renderProperty($namespace, $name);
    }

    /**
     * @param string            $class
     * @param string            $value
     * @param string|false|null $namespace
     *
     * @return string
     */
    public function renderConstant($class, $value, $namespace = null)
    {
        return $this->renderClass($this->renderProperty($class, strtoupper($value)), $namespace);
    }

    /**
     * @param string            $class
     * @param string[]          $arguments
     * @param string|false|null $namespace
     * @param bool              $semicolon
     * @param bool              $newLine
     *
     * @return string
     */
    public function renderObject(
        $class,
        array $arguments = [],
        $namespace = null,
        $semicolon = false,
        $newLine = false
    ) {
        return $this->renderCall(
            'new '.$this->renderClass($class, $namespace),
            $arguments,
            $semicolon,
            $newLine
        );
    }

    /**
     * @param string      $object
     * @param string|null $property
     *
     * @return string
     */
    public function renderProperty($object, $property = null)
    {
        if (!empty($property)) {
            $property = '.'.$property;
        }

        return $object.$property;
    }

    /**
     * @param VariableAwareInterface $object
     * @param string                 $method
     * @param string[]               $arguments
     * @param bool                   $semicolon
     * @param bool                   $newLine
     *
     * @return string
     */
    public function renderObjectCall(
        VariableAwareInterface $object,
        $method,
        array $arguments = [],
        $semicolon = false,
        $newLine = false
    ) {
        return $this->renderCall(
            $this->renderProperty($object->getVariable(), $method),
            $arguments,
            $semicolon,
            $newLine
        );
    }

    /**
     * @param string|null $method
     * @param string[]    $arguments
     * @param bool        $semicolon
     * @param bool        $newLine
     *
     * @return string
     */
    public function renderCall($method, array $arguments = [], $semicolon = false, $newLine = false)
    {
        return $this->renderCode(
            $method.$this->renderArguments($arguments),
            $semicolon,
            $newLine
        );
    }

    /**
     * @param string|null $code
     * @param string[]    $arguments
     * @param string|null $name
     * @param bool        $semicolon
     * @param bool        $newLine
     *
     * @return string
     */
    public function renderClosure(
        $code = null,
        array $arguments = [],
        $name = null,
        $semicolon = false,
        $newLine = false
    ) {
        $separator = $this->renderSeparator();

        if ($name !== null) {
            $name = ' '.$name;
        }

        return $this->renderCode($this->renderLines([
            'function'.$name.$separator.$this->renderArguments($arguments).$separator.'{',
            $this->renderIndentation($code),
            '}',
        ], !empty($code), $newLine && !$semicolon), $semicolon, $newLine && $semicolon);
    }

    /**
     * @param VariableAwareInterface $object
     * @param string                 $declaration
     * @param bool                   $semicolon
     * @param bool                   $newLine
     *
     * @return string
     */
    public function renderObjectAssignment(
        VariableAwareInterface $object,
        $declaration,
        $semicolon = false,
        $newLine = false
    ) {
        return $this->renderAssignment($object->getVariable(), $declaration, $semicolon, $newLine);
    }

    /**
     * @param VariableAwareInterface      $root
     * @param string                      $declaration
     * @param string|null                 $propertyPath
     * @param VariableAwareInterface|null $object
     * @param bool                        $semicolon
     * @param bool                        $newLine
     *
     * @return string
     */
    public function renderContainerAssignment(
        VariableAwareInterface $root,
        $declaration,
        $propertyPath = null,
        VariableAwareInterface $object = null,
        $semicolon = true,
        $newLine = true
    ) {
        return $this->renderAssignment(
            $this->renderContainerVariable($root, $propertyPath, $object),
            $declaration,
            $semicolon,
            $newLine
        );
    }

    /**
     * @param VariableAwareInterface      $root
     * @param string|null                 $propertyPath
     * @param VariableAwareInterface|null $object
     *
     * @return string
     */
    public function renderContainerVariable(
        VariableAwareInterface $root,
        $propertyPath = null,
        VariableAwareInterface $object = null
    ) {
        $variable = $root->getVariable().'_container';

        if ($propertyPath !== null) {
            $variable = $this->renderProperty($variable, $propertyPath);
        }

        if ($object !== null) {
            $variable = $this->renderProperty($variable, $object->getVariable());
        }

        return $variable;
    }

    /**
     * @param string $variable
     * @param string $declaration
     * @param bool   $semicolon
     * @param bool   $newLine
     *
     * @return string
     */
    public function renderAssignment($variable, $declaration, $semicolon = false, $newLine = false)
    {
        $separator = $this->renderSeparator();

        return $this->renderCode($variable.$separator.'='.$separator.$declaration, $semicolon, $newLine);
    }

    /**
     * @param string      $statement
     * @param string      $code
     * @param string|null $condition
     * @param string|null $next
     * @param bool        $newLine
     *
     * @return string
     */
    public function renderStatement($statement, $code, $condition = null, $next = null, $newLine = true)
    {
        $separator = $this->renderSeparator();
        $statement .= $separator;

        if (!empty($condition)) {
            $statement .= $this->renderArguments([$condition]).$separator;
        }

        if (!empty($next)) {
            $next = $separator.$next;
        }

        return $this->renderLines([
            $statement.'{',
            $this->renderIndentation($code),
            '}'.$next,
        ], true, $newLine);
    }

    /**
     * @param string $code
     * @param bool   $semicolon
     * @param bool   $newLine
     *
     * @return string
     */
    public function renderCode($code, $semicolon = true, $newLine = true)
    {
        if ($semicolon) {
            $code .= ';';
        }

        return $this->renderLine($code, $newLine);
    }

    /**
     * @param string|null $code
     *
     * @return string
     */
    public function renderIndentation($code = null)
    {
        if ($this->debug && !empty($code)) {
            $indentation = str_repeat(' ', $this->indentationStep);
            $code = $indentation.str_replace("\n", "\n".$indentation, $code);
        }

        return (string) $code;
    }

    /**
     * @param string[] $codes
     * @param bool     $newLine
     * @param bool     $eolLine
     *
     * @return string
     */
    public function renderLines(array $codes, $newLine = true, $eolLine = true)
    {
        $result = '';
        $count = count($codes);

        for ($index = 0; $index < $count; ++$index) {
            $result .= $this->renderLine($codes[$index], $newLine && $index !== $count - 1);
        }

        return $this->renderLine($result, $eolLine);
    }

    /**
     * @param string|null $code
     * @param bool        $newLine
     *
     * @return string
     */
    public function renderLine($code = null, $newLine = true)
    {
        if ($newLine && !empty($code) && $this->debug) {
            $code .= "\n";
        }

        return (string) $code;
    }

    /**
     * @param string $argument
     *
     * @return string
     */
    public function renderEscape($argument)
    {
        return json_encode($argument, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return string
     */
    public function renderSeparator()
    {
        return $this->debug ? ' ' : '';
    }

    /**
     * @param string[] $arguments
     *
     * @return string
     */
    private function renderArguments(array $arguments)
    {
        return '('.implode(','.$this->renderSeparator(), $arguments).')';
    }
}
