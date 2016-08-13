<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Place\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\Tests\GoogleMap\Helper\Functional\Place\AbstractAutocompleteFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractEventFunctionalTest extends AbstractAutocompleteFunctionalTest
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

    protected function selectAutocomplete()
    {
        $this->keys(\PHPUnit_Extensions_Selenium2TestCase_Keys::DOWN);
        $this->keys(\PHPUnit_Extensions_Selenium2TestCase_Keys::ENTER);
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
            'place_changed',
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
