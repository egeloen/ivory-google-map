<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Utils;

use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Json builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonBuilder
{
    /** @var \Symfony\Component\PropertyAccess\PropertyAccessor */
    protected $accesor;

    /** @var array */
    protected $values;

    /** @var array */
    protected $escapes;

    /** @var integer */
    protected $jsonEncodeOptions;

    /**
     * Creates a json builder.
     */
    public function __construct()
    {
        $this->accessor = new PropertyAccessor();

        $this->reset();
    }

    /**
     * Gets the json encode options.
     *
     * @return integer The json encode options.
     */
    public function getJsonEncodeOptions()
    {
        return $this->jsonEncodeOptions;
    }

    /**
     * Sets the json encode options.
     *
     * @param integer $jsonEncodeOptions The json encode options.
     *
     * @return \Ivory\GoogleMap\Helper\Utils\JsonBuilder The json builder.
     */
    public function setJsonEncodeOptions($jsonEncodeOptions)
    {
        $this->jsonEncodeOptions = $jsonEncodeOptions;

        return $this;
    }

    /**
     * Checks if the json builder has values.
     *
     * @return boolean TRUE if the json builder has values else FALSE.
     */
    public function hasValues()
    {
        return !empty($this->values);
    }

    /**
     * Gets the json builder values.
     *
     * @return array The json builder values.
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Sets values without control on the escaping.
     *
     * @param array $values The values.
     *
     * @return \Ivory\GoogleMap\Helper\Utils\JsonBuilder The json builder.
     */
    public function setValues(array $values, $pathPrefix = null)
    {
        foreach ($values as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $this->setValues($value, sprintf('[%s]', $key));
            } else {
                $this->setValue(sprintf('%s[%s]', $pathPrefix, $key), $value);
            }
        }

        return $this;
    }

    /**
     * Sets a value according to a path & an escape flag. If the escape flag is set to false,
     * the value is render as it is given (without escaping).
     *
     * @param string  $path The property path.
     * @param mixed   $value The value.
     * @param boolean $escape The escape flag.
     *
     * @return \Ivory\GoogleMap\Helper\Utils\JsonBuilder The json builder.
     */
    public function setValue($path, $value, $escape = true)
    {
        if (!$escape) {
            $placeholder = uniqid('ivory', true);
            $this->escapes[sprintf('"%s"', $placeholder)] = $value;

            $value = $placeholder;
        }

        $this->values[$path] = $value;

        return $this;
    }

    /**
     * Removes a value according to a property path.
     *
     * @param string $path The property path.
     *
     * @return \Ivory\GoogleMap\Helper\Utils\JsonBuilder The json builder.
     */
    public function removeValue($path)
    {
        unset($this->values[$path]);
        unset($this->escapes[$path]);

        return $this;
    }

    /**
     * Resets the builder.
     *
     * @return \Ivory\GoogleMap\Helper\Utils\JsonBuilder The json builder.
     */
    public function reset()
    {
        $this->values = array();
        $this->escapes = array();
        $this->jsonEncodeOptions = 0;

        return $this;
    }

    /**
     * Builds the json.
     *
     * @return string The builded json.
     */
    public function build()
    {
        $json = array();

        foreach ($this->values as $path => $value) {
            $this->accessor->setValue($json, $path, $value);
        }

        return str_replace(
            array_keys($this->escapes),
            array_values($this->escapes),
            json_encode($json, $this->jsonEncodeOptions)
        );
    }
}
