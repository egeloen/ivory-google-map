<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Utility;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlParser
{
    /**
     * @param string   $xml
     * @param string[] $rules
     * @param bool     $snakeToCamelCase
     *
     * @return mixed[]
     */
    public function parse($xml, array $rules = [], $snakeToCamelCase = false)
    {
        return $this->pluralize(
            json_decode(json_encode(new \SimpleXMLElement($xml)), true),
            $rules,
            $snakeToCamelCase
        );
    }

    /**
     * @param mixed[]  $xml
     * @param string[] $rules
     * @param bool     $snakeToCamelCase
     *
     * @return mixed[]
     */
    private function pluralize(array $xml, array $rules, $snakeToCamelCase)
    {
        foreach ($xml as $attribute => $value) {
            if (isset($rules[$attribute])) {
                $xml[$rules[$attribute]] = $value;
                unset($xml[$attribute]);

                $attribute = $rules[$attribute];

                if (!is_array($value) || is_string(key($value))) {
                    $xml[$attribute] = [$value];
                }
            }

            if (is_array($xml[$attribute])) {
                $xml[$attribute] = $this->pluralize($xml[$attribute], $rules, $snakeToCamelCase);
            }

            if ($snakeToCamelCase
                && is_string($attribute)
                && ($newAttribute = $this->convertSnakeToCamelCase($attribute)) !== $attribute
            ) {
                $xml[$newAttribute] = $xml[$attribute];
                unset($xml[$attribute]);
            }
        }

        return $xml;
    }

    /**
     * @param string $value
     *
     * @return string
     */
    private function convertSnakeToCamelCase($value)
    {
        return lcfirst(implode('', array_map(function ($word) {
            return ucfirst($word);
        }, explode('_', $value))));
    }
}
