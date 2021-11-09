<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractEventRenderer extends AbstractRenderer
{
    public function render(Event $event): string
    {
        $formatter = $this->getFormatter();

        $arguments = [
            $event->getInstance(),
            $formatter->renderEscape($event->getTrigger()),
            $event->getHandle(),
        ];

        if ($this->hasCapture()) {
            $arguments[] = $formatter->renderEscape($event->isCapture());
        }

        return $formatter->renderObjectAssignment($event, $formatter->renderCall(
            $formatter->renderProperty($formatter->renderClass('event'), $this->getMethod()),
            $arguments
        ));
    }

    /**
     * @return string
     */
    abstract protected function getMethod();

    protected function hasCapture(): bool
    {
        return true;
    }
}
