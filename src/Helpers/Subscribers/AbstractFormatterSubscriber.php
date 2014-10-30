<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Abstract formatter.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractFormatterSubscriber implements EventSubscriberInterface
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Formatter */
    private $formatter;

    /**
     * Creates a formatter subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null $formatter The formatter.
     */
    public function __construct(Formatter $formatter = null)
    {
        $this->setFormatter($formatter ?: new Formatter());
    }

    /**
     * Gets the formatter.
     *
     * @return \Ivory\GoogleMap\Helpers\Subscribers\Formatter The formatter.
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * Sets the formatter.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter $formatter The formatter.
     */
    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }
}
