<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers;

use Ivory\GoogleMap\Assets\AbstractVariableAsset;

/**
 * Formatter.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Formatter
{
    /** @var boolean */
    private $debug;

    /** @var integer */
    private $indentation;

    /**
     * Creates a formatter.
     *
     * @param boolean $debug       The debug flag.
     * @param inteer  $indentation The indentation.
     */
    public function __construct($debug = false, $indentation = 4)
    {
        $this->setDebug($debug);
        $this->setIndentation($indentation);
    }

    /**
     * Checks the debug flag.
     *
     * @return boolean The debug flag.
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * Sets the debug flag.
     *
     * @param boolean $debug The debug flag.
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * Gets the indentation.
     *
     * @return integer The indentation.
     */
    public function getIndentation()
    {
        return $this->indentation;
    }

    /**
     * Sets the indentation.
     *
     * @param integer $indentation The indentation.
     */
    public function setIndentation($indentation)
    {
        $this->indentation = $indentation;
    }

    /**
     * Formats a container assignment.
     *
     * @param \Ivory\GoogleMap\Assets\AbstractVariableAsset      $container The container.
     * @param string|null                                        $code      The code.
     * @param string|null                                        $level     The level.
     * @param \Ivory\GoogleMap\Assets\AbstractVariableAsset|null $asset     The asset.
     * @param boolean                                            $append    TRUE if the asset variable should be appended to the base variable.
     * @param boolean                                            $semicolon TRUE if the semicolon should be appended else FALSE.
     * @param boolean                                            $format    TRUE if the code should be formatted else FALSE.
     *
     * @return string The formatted container assignment.
     */
    public function formatContainerAssignment(
        AbstractVariableAsset $container,
        $code,
        $level = null,
        AbstractVariableAsset $asset = null,
        $append = true,
        $semicolon = true,
        $format = true
    ) {
        return $this->formatAssignment(
            $this->formatContainerVariable($container, $level, $append ? $asset : null),
            $asset !== null ? $this->formatAssetAssignment($asset, $code, false, false) : $code,
            $semicolon,
            $format
        );
    }

    /**
     * Formats a container variable.
     *
     * @param \Ivory\GoogleMap\Assets\AbstractVariableAsset      $container The base.
     * @param string|null                                        $level     The level.
     * @param \Ivory\GoogleMap\Assets\AbstractVariableAsset|null $asset     The asset.
     *
     * @return string The formatted container variable.
     */
    public function formatContainerVariable(
        AbstractVariableAsset $container,
        $level = null,
        AbstractVariableAsset $asset = null
    ) {
        $variable = $container->getVariable().'_container';

        if ($level !== null) {
            $variable .= '.'.$level;
        }

        if ($asset !== null) {
            $variable .= '.'.$asset->getVariable();
        }

        return $variable;
    }

    /**
     * Formats an asset assignmment.
     *
     * @param \Ivory\GoogleMap\Assets\AbstractVariableAsset $variable  The variable.
     * @param string                                        $code      The code.
     * @param boolean                                       $semicolon TRUE if the semicolon should be appended else FALSE.
     * @param boolean                                       $format    TRUE if the code should be formatted else FALSE.
     * @param string                                        $operator  The operator.
     *
     * @return string The formatted asset assignment.
     */
    public function formatAssetAssignment(
        AbstractVariableAsset $variable,
        $code,
        $semicolon = true,
        $format = true,
        $operator = '='
    ) {
        return $this->formatAssignment($variable->getVariable(), $code, $semicolon, $format, $operator);
    }

    /**
     * Formats an asset callback.
     *
     * @param \Ivory\GoogleMap\Assets\AbstractVariableAsset $variable The variable.
     *
     * @return string The formatted asset callback.
     */
    public function formatAssetCallback(AbstractVariableAsset $variable)
    {
        return $this->formatCallback($variable->getVariable());
    }

    /**
     * Formats a callback.
     *
     * @param string $variable The variable.
     *
     * @return string The formatted callback.
     */
    public function formatCallback($variable)
    {
        return $variable.'_callback';
    }

    /**
     * Formats an assignment.
     *
     * @param string  $variable  The variable.
     * @param string  $code      The code.
     * @param boolean $semicolon TRUE if the semicolon should be appended else FALSE.
     * @param boolean $format    TRUE if the code should be formatted else FALSE.
     * @param string  $operator  The operator.
     *
     * @return string The formatted assignment.
     */
    public function formatAssignment($variable, $code, $semicolon = true, $format = true, $operator = '=')
    {
        $separator = $this->formatSeparator();

        return $this->formatCode($variable.$separator.$operator.$separator.$code, $semicolon, $format);
    }

    /**
     * Formats a function call.
     *
     * @param string  $name      The name.
     * @param array   $arguments The arguments.
     * @param boolean $semicolon TRUE if the semicolon should be appended else FALSE.
     * @param boolean $format    TRUE if the code should be formatted else FALSE.
     *
     * @return string The formatted function call.
     */
    public function formatFunctionCall($name, array $arguments = array(), $semicolon = true, $format = true)
    {
        return $this->formatCode(
            $name.'('.implode(','.$this->formatSeparator(), $arguments).')',
            $semicolon,
            $format
        );
    }

    /**
     * Formats a function.
     *
     * @param string      $code      The code.
     * @param array       $arguments The arguments.
     * @param string|null $name      The name.
     *
     * @return string The formatted function.
     */
    public function formatFunction(
        $code,
        array $arguments = array(),
        $name = null,
        $semicolon = true,
        $formatStart = true,
        $formatEnd = true
    ) {
        $separator = $this->formatSeparator();

        $prototype = 'function'.($name !== null ? ' '.$name : $separator).'('.implode(','.$separator, $arguments).')';
        $prototype .= $separator.'{';

        $function = $this->formatCode($prototype, false, $formatStart);
        $function .= $formatStart ? $this->formatIndentation($code) : $code;
        $function .= '}';

        return $this->formatCode($function, $semicolon, $formatEnd);
    }

    /**
     * Formats a source.
     *
     * @param string      $source   The source.
     * @param string|null $callback The callback.
     *
     * @return string The formatted source.
     */
    public function formatSource($source, $callback = null)
    {
        if ($callback === null) {
            return $this->formatJavascript(null, array('src' => $source));
        }

        $code = $this->formatAssignment(
            'var s',
            $this->formatFunctionCall('document.createElement', array('"script"'), false, false)
        );

        $code .= $this->formatAssignment('s.type', '"text/javascript"');
        $code .= $this->formatAssignment('s.async', 'true');
        $code .= $this->formatAssignment('s.src', '"'.$source.'"');

        if ($callback !== null) {
            $attachEvent = 's.attachEvent';
            $addEventListener = 's.addEventListener';

            $code .= $this->formatIf(
                $attachEvent,
                $this->formatFunctionCall(
                    $attachEvent,
                    array(
                        '"onreadystatechange"',
                        $this->formatFunction(
                            $this->formatIf(
                                $this->formatAssignment('s.readyState', '"complete"', false, false, '==='),
                                $this->formatFunctionCall($callback)
                            ),
                            array(),
                            null,
                            false,
                            true,
                            false
                        ),
                    )
                ),
                array(),
                $this->formatFunctionCall(
                    $addEventListener,
                    array('"load"', $callback, 'false')
                )
            );
        }

        $code .= $this->formatFunctionCall(
            $this->formatFunctionCall('document.getElementsByTagName', array('"head"'), false, false).'[0].appendChild',
            array('s')
        );

        return $code;
    }

    /**
     * Formats a ternary.
     *
     * @param string  $condition The condition.
     * @param string  $value1    The first value.
     * @param string  $value2    The second value.
     * @param boolean $semicolon TRUE if the semicolon is appended else FALSE.
     * @param boolean $format    TRUE if the code should be formatted else FALSE.
     *
     * @return string The formatted ternary.
     */
    public function formatTernary($condition, $value1, $value2, $semicolon = true, $format = true)
    {
        $separator = $this->formatSeparator();

        return $this->formatCode(
            $condition.$separator.'?'.$separator.$value1.$separator.':'.$separator.$value2,
            $semicolon,
            $format
        );
    }

    /**
     * Formats a if.
     *
     * @param string      $ifCondition The if condition.
     * @param string      $ifCode      The if code.
     * @param array       $elseIfs     The else ifs.
     * @param string|null $elseCode    The else code.
     *
     * @return strig The formatted if.
     */
    public function formatIf($ifCondition, $ifCode, array $elseIfs = array(), $elseCode = null)
    {
        $separator = $this->formatSeparator();

        $code = $this->formatLine('if'.$separator.'('.$ifCondition.')'.$separator.'{');
        $code .= $this->formatIndentation($ifCode).'}';

        foreach ($elseIfs as $elseIfCondition => $elseIfCode) {
            $code .= $this->formatLine(sprintf($separator.'elseif'.$separator.'('.$elseIfCondition.')'.$separator.'{'));
            $code .= $this->formatIndentation($elseIfCode).'}';
        }

        if ($elseCode !== null) {
            $code .= $this->formatLine($separator.'else'.$separator.'{').$this->formatIndentation($elseCode).'}';
        }

        return $this->formatLine($code);
    }

    /**
     * Formats a code.
     *
     * @param string  $code      The code.
     * @param boolean $semicolon TRUE if the semicolon is appended else FALSE.
     * @param boolean $format    TRUE if the code should be formatted else FALSE.
     *
     * @return string The formatted code.
     */
    public function formatCode($code, $semicolon = true, $format = true)
    {
        if ($semicolon) {
            $code .= ';';
        }

        return $format ? $this->formatLine($code) : $code;
    }

    /**
     * Formats a javascript.
     *
     * @param string $code       The code.
     * @param array  $attributes The attributes.
     *
     * @return string The formatted javascript.
     */
    public function formatJavascript($code, array $attributes = array())
    {
        return $this->formatTag('script', $code, array_merge(array('type' => 'text/javascript'), $attributes));
    }

    /**
     * Formats a stylesheet.
     *
     * @param string $name  The node.
     * @param array  $items The items.
     *
     * @return string The formatted stylesheet.
     */
    public function formatStylesheet($name, array $items)
    {
        $separator = $this->formatSeparator();

        $stylesheet = null;
        foreach ($items as $item => $value) {
            $stylesheet .= $this->formatCode($item.':'.$separator.$value);
        }

        $code = $this->formatLine($name.$separator.'{');
        $code .= $this->formatIndentation($stylesheet);
        $code .= $this->formatLine('}');

        return $this->formatTag('style', $code, array('type' => 'text/css'));
    }

    /**
     * Formats a tag.
     *
     * @param string      $name       The name.
     * @param string|null $content    The content.
     * @param array       $attributes The attributes.
     * @param boolean     $inline     TRUE if the tag is inlined else FALSE.
     *
     * @return string The formatted tag.
     */
    public function formatTag($name, $content = null, array $attributes = array(), $inline = false)
    {
        $tag = $name;
        foreach ($attributes as $attribute => $value) {
            $tag .= ' '.$attribute.'="'.$value.'"';
        }

        if ($content === null) {
            if ($inline) {
                return $this->formatLine('<'.$tag.' />');
            }

            return $this->formatLine('<'.$tag.'></'.$name.'>');
        }

        return $this->formatLine('<'.$tag.'>').$this->formatIndentation($content).$this->formatLine('</'.$name.'>');
    }

    /**
     * Formats an indentation.
     *
     * @param string $code The code.
     *
     * @return string The indented code.
     */
    public function formatIndentation($code)
    {
        if (empty($code)) {
            return $code;
        }

        if ($this->debug) {
            $indentation = str_repeat(' ', $this->indentation);

            return $indentation.preg_replace('/\n([^$])/', PHP_EOL.$indentation.'$1', $code);
        }

        return $code;
    }

    /**
     * Formats a line.
     *
     * @param string $line The line.
     *
     * @return string The formatted line.
     */
    public function formatLine($line)
    {
        return $this->debug ? $line.PHP_EOL : $line;
    }

    /**
     * Formats a separator.
     *
     * @return string The formatted separator.
     */
    public function formatSeparator()
    {
        return $this->debug ? ' ' : '';
    }
}
