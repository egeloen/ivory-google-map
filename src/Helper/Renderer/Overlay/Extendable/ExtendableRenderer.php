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

use InvalidArgumentException;
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
    private array $renderers = [];

    public function hasRenderers(): bool
    {
        return !empty($this->renderers);
    }

    /**
     * @return ExtendableRendererInterface[]
     */
    public function getRenderers(): array
    {
        return $this->renderers;
    }

    /**
     * @param ExtendableRendererInterface[] $renderers
     */
    public function setRenderers(array $renderers): void
    {
        $this->renderers = [];
        $this->addRenderers($renderers);
    }

    /**
     * @param ExtendableRendererInterface[] $renderers
     */
    public function addRenderers(array $renderers): void
    {
        foreach ($renderers as $name => $renderer) {
            $this->setRenderer($name, $renderer);
        }
    }

    /**
     * @param string $name
     */
    public function hasRenderer($name): bool
    {
        return isset($this->renderers[$name]);
    }

    /**
     * @param string $name
     */
    public function getRenderer($name): ?ExtendableRendererInterface
    {
        return $this->hasRenderer($name) ? $this->renderers[$name] : null;
    }

    /**
     * @param string                      $name
     */
    public function setRenderer($name, ExtendableRendererInterface $renderer): void
    {
        $this->renderers[$name] = $renderer;
    }

    /**
     * @param string $name
     */
    public function removeRenderer($name): void
    {
        unset($this->renderers[$name]);
    }

    public function render(ExtendableInterface $extendable, Bound $bound): string
    {
        $renderer = $this->getRenderer(get_class($extendable));

        if ($renderer === null) {
            throw new InvalidArgumentException(sprintf(
                'The extendable renderer for "%s" could not be found.',
                get_class($extendable)
            ));
        }

        return $renderer->render($extendable, $bound);
    }
}
