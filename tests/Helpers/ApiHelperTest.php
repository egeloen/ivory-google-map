<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers;

use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\ApiHelper;

/**
 * Api helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiHelperTest extends AbstractHelperTest
{
    /** @var \Ivory\GoogleMap\Helpers\ApiHelper */
    private $apiHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->apiHelper = new ApiHelper($this->eventDispatcher);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->apiHelper);
    }

    public function testRender()
    {
        $this->eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->identicalTo(ApiEvents::JAVASCRIPT),
                $this->createApiEventCallbackConstraint(
                    $items = array($this->createMapMock(), $this->createAutocompleteMock()),
                    $code = 'code'
                )
            );

        $this->assertSame($code, $this->apiHelper->render($items));
    }

    /**
     * Creates an api event callback constraint.
     *
     * @param array  $items The items.
     * @param string $code  The code.
     *
     * @return \PHPUnit_Framework_Constraint_Callback The api event callback constraint.
     */
    private function createApiEventCallbackConstraint(array $items, $code)
    {
        return $this->callback(function ($apiEvent) use ($items, $code) {
            $result = $apiEvent instanceof ApiEvent && $apiEvent->getItems() === $items;

            if ($result) {
                $apiEvent->addCode($code);
            }

            return $result;
        });
    }
}
