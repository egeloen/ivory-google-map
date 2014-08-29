<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Utils;

/**
 * Xml parser.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlParser
{
    /**
     * Parses xml according to pluralization rules.
     *
     * @param string  $xml                The xml.
     * @param array   $pluralizationRules The pluralization rules.
     *
     * @return \stdClass The parsed & pluralized xml.
     */
    public function parse($xml, array $pluralizationRules = array())
    {
        $parsedXml = json_decode(json_encode(new \SimpleXMLElement($xml)), true);

        return $this->pluralize($parsedXml, $pluralizationRules);
    }

    /**
     * Pluralizes xml.
     *
     * @param array $xml   The xml.
     * @param array $rules The pluralization rules.
     *
     * @return \stdClass The pluralized xml.
     */
    protected function pluralize(array $xml, array $rules)
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

        return $this->normalize($xml);
    }

    /**
     * Normalizes xml.
     *
     * @param array $xml The xml.
     *
     * @return array|\stdClass The normalized xml.
     */
    protected function normalize(array $xml)
    {
        if (is_string(key($xml))) {
            return (object) $xml;
        }

        return $xml;
    }
}
