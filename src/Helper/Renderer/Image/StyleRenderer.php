<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Image;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StyleRenderer
{
    /**
     * @param mixed[] $style
     *
     * @return string
     */
    public function render(array $style)
    {
        $result = [];

        if (isset($style['feature'])) {
            $result[] = $this->renderStyle('feature', $style['feature']);
        }

        if (isset($style['element'])) {
            $result[] = $this->renderStyle('element', $style['element']);
        }

        foreach ($style['rules'] as $rule => $value) {
            $result[] = $this->renderStyle($rule, $value);
        }

        return implode('|', $result);
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return string
     */
    private function renderStyle($name, $value)
    {
        return $name.':'.$value;
    }
}
