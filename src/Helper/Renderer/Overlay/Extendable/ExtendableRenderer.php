<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\ExtendableInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableRenderer implements ExtendableRendererInterface
{
    /**
     * @var ExtendableRendererInterface[]
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
     * @return ExtendableRendererInterface[]
     */
    public function getRenderers()
    {
        return $this->renderers;
    }

    /**
     * @param ExtendableRendererInterface[] $renderers
     */
    public function setRenderers(array $renderers)
    {
        $this->renderers = [];
        $this->addRenderers($renderers);
    }

    /**
     * @param ExtendableRendererInterface[] $renderers
     */
    public function addRenderers(array $renderers)
    {
        foreach ($renderers as $name => $renderer) {
            $this->setRenderer($name, $renderer);
        }
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasRenderer($name)
    {
        return isset($this->renderers[$name]);
    }

    /**
     * @param string $name
     *
     * @return ExtendableRendererInterface|null
     */
    public function getRenderer($name)
    {
        return $this->hasRenderer($name) ? $this->renderers[$name] : null;
    }

    /**
     * @param string                      $name
     * @param ExtendableRendererInterface $renderer
     */
    public function setRenderer($name, ExtendableRendererInterface $renderer)
    {
        $this->renderers[$name] = $renderer;
    }

    /**
     * @param string $name
     */
    public function removeRenderer($name)
    {
        unset($this->renderers[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function render(ExtendableInterface $extendable, Bound $bound)
    {
        $renderer = $this->getRenderer(get_class($extendable));

        if ($renderer === null) {
            throw new \InvalidArgumentException(sprintf(
                'The extendable renderer for "%s" could not be found.',
                get_class($extendable)
            ));
        }

        return $renderer->render($extendable, $bound);
    }
}
