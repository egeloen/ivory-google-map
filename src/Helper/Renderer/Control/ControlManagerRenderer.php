<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Control;

use Ivory\GoogleMap\Control\ControlManager;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlManagerRenderer
{
    /**
     * @var ControlRendererInterface[]
     */
    private $renderers = [];

    /**
     * @return bool
     */
    public function hasRenderers()
    {
        return !empty($this->renderers);
    }

    /**
     * @return ControlRendererInterface[]
     */
    public function getRenderers()
    {
        return $this->renderers;
    }

    /**
     * @param ControlRendererInterface[] $renderers
     */
    public function setRenderers(array $renderers)
    {
        $this->renderers = [];
        $this->addRenderers($renderers);
    }

    /**
     * @param ControlRendererInterface[] $renderers
     */
    public function addRenderers(array $renderers)
    {
        foreach ($renderers as $renderer) {
            $this->addRenderer($renderer);
        }
    }

    /**
     * @param ControlRendererInterface $renderer
     *
     * @return bool
     */
    public function hasRenderer(ControlRendererInterface $renderer)
    {
        return in_array($renderer, $this->renderers, true);
    }

    /**
     * @param ControlRendererInterface $renderer
     */
    public function addRenderer(ControlRendererInterface $renderer)
    {
        if (!$this->hasRenderer($renderer)) {
            $this->renderers[] = $renderer;
        }
    }

    /**
     * @param ControlRendererInterface $renderer
     */
    public function removeRenderer(ControlRendererInterface $renderer)
    {
        unset($this->renderers[array_search($renderer, $this->renderers, true)]);
        $this->renderers = empty($this->renderers) ? [] : array_values($this->renderers);
    }

    /**
     * @param ControlManager $controlManager
     * @param JsonBuilder    $jsonBuilder
     *
     * @return string
     */
    public function render(ControlManager $controlManager, JsonBuilder $jsonBuilder)
    {
        foreach ($this->renderers as $renderer) {
            $control = get_class($renderer);

            if (($position = strrpos($control, '\\')) !== false) {
                $control = substr($control, ++$position, -8);
            }

            if ($controlManager->{'has'.$control}()) {
                $lcControl = lcfirst($control);

                $jsonBuilder
                    ->setValue('['.$lcControl.']', true)
                    ->setValue('['.$lcControl.'Options]', $renderer->render($controlManager->{'get'.$control}()), false);
            }
        }
    }
}
