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
class XmlParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse($data, array $options = [])
    {
        return $this->process(
            json_decode(json_encode(new \SimpleXMLElement($data)), true),
            isset($options['pluralization_rules']) ? $options['pluralization_rules'] : [],
            isset($options['snake_to_camel']) ? $options['snake_to_camel'] : false
        );
    }

    /**
     * @param mixed[]  $data
     * @param string[] $pluralizationRules
     * @param bool     $snakeToCamel
     *
     * @return mixed[]
     */
    private function process(array $data, array $pluralizationRules, $snakeToCamel)
    {
        foreach ($data as $attribute => $value) {
            if (isset($pluralizationRules[$attribute])) {
                $data[$pluralizationRules[$attribute]] = $value;
                unset($data[$attribute]);

                $attribute = $pluralizationRules[$attribute];

                if (!is_array($value) || is_string(key($value))) {
                    $data[$attribute] = [$value];
                }
            }

            if (is_array($data[$attribute])) {
                $data[$attribute] = $this->process($data[$attribute], $pluralizationRules, $snakeToCamel);
            }

            if ($snakeToCamel && is_string($attribute)
                && ($newAttribute = $this->snakeToCamel($attribute)) !== $attribute
            ) {
                $data[$newAttribute] = $data[$attribute];
                unset($data[$attribute]);
            }
        }

        return $data;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    private function snakeToCamel($data)
    {
        return lcfirst(implode('', array_map(function ($word) {
            return ucfirst($word);
        }, explode('_', $data))));
    }
}
