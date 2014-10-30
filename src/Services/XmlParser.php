<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services;

/**
 * Xml parser.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlParser
{
    /**
     * Parses the xml.
     *
     * @param string $xml   The xml.
     * @param array  $rules The rules.
     *
     * @return array The parsed xml.
     */
    public function parse($xml, array $rules = array())
    {
        return $this->pluralize($this->decode($xml), $rules);
    }

    /**
     * Decodes the xml.
     *
     * @param string $xml The xml.
     *
     * @return array The decoded xml.
     */
    private function decode($xml)
    {
        return json_decode(json_encode(new \SimpleXMLElement($xml)), true);
    }

    /**
     * Pluralizes the xml.
     *
     * @param array $xml   The xml.
     * @param array $rules The rules.
     *
     * @return array The pluralized xml.
     */
    private function pluralize(array $xml, array $rules)
    {
        foreach ($xml as $attribute => $value) {
            if (isset($rules[$attribute])) {
                $xml[$rules[$attribute]] = $value;
                unset($xml[$attribute]);

                $attribute = $rules[$attribute];

                if (!is_array($value) || is_string(key($value))) {
                    $xml[$attribute] = array($value);
                }
            }

            if (is_array($xml[$attribute])) {
                $xml[$attribute] = $this->pluralize($xml[$attribute], $rules);
            }
        }

        return $xml;
    }
}
