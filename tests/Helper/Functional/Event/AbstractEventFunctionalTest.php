<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Event\MouseEvent;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractEventFunctionalTest extends AbstractMapFunctionalTest
{
    /**
     * @var string
     */
    private $spyCount;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->spyCount = 'spy_count';
    }

    /**
     * @param int $count
     */
    protected function assertSpyCount($count)
    {
        $this->assertSameVariable($count, $this->spyCount);
    }

    /**
     * @param string $instance
     *
     * @return Event
     */
    protected function createEvent($instance)
    {
        return new Event(
            $instance,
            MouseEvent::CLICK,
            <<<EOF
function () { 
    if (typeof {$this->spyCount} === typeof undefined) { 
        {$this->spyCount} = 1; 
    } else { 
        {$this->spyCount}++; 
    }
}
EOF
        );
    }
}
