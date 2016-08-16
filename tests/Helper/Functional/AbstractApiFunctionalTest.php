<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\ApiHelper;
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractApiFunctionalTest extends AbstractFunctionalTest
{
    /**
     * @var ApiHelper
     */
    private $apiHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->apiHelper = $this->createApiHelper();
    }

    /**
     * @param object[] $objects
     *
     * @return string
     */
    protected function renderApi(array $objects)
    {
        return $this->apiHelper->render($objects);
    }

    /**
     * @param string[] $libraries
     */
    protected function assertLibraries(array $libraries)
    {
        foreach ($libraries as $library) {
            $this->assertVariableExists('google.maps.'.$library);
        }
    }

    /**
     * @param VariableAwareInterface $object
     * @param Bound                  $bound
     * @param string|null            $expected
     */
    protected function assertBound(VariableAwareInterface $object, Bound $bound, $expected = null)
    {
        $this->assertSameContainerVariable(
            $object,
            'base.bounds',
            $bound,
            $expected,
            function ($expected, $variable) {
                $formatter = function ($expected, $variable, $method) {
                    return $expected.'.contains('.$variable.'.'.$method.'())';
                };

                return implode(' && ', [
                    call_user_func($formatter, $expected, $variable, 'getSouthWest'),
                    call_user_func($formatter, $expected, $variable, 'getNorthEast'),
                ]);
            }
        );

        if (!empty($expected)) {
            return;
        }

        if ($bound->hasSouthWest()) {
            $this->assertCoordinate($object, $bound->getSouthWest(), $bound->getVariable().'.getSouthWest()');
        }

        if ($bound->hasNorthEast()) {
            $this->assertCoordinate($object, $bound->getNorthEast(), $bound->getVariable().'.getNorthEast()');
        }
    }

    /**
     * @param VariableAwareInterface $object
     * @param Coordinate             $coordinate
     * @param string|null            $expected
     */
    protected function assertCoordinate(VariableAwareInterface $object, Coordinate $coordinate, $expected = null)
    {
        $this->assertSameContainerVariable($object, 'base.coordinates', $coordinate, $expected);
        $this->assertSameVariable($coordinate->getVariable().'.lat()', $coordinate->getLatitude());
        $this->assertSameVariable($coordinate->getVariable().'.lng()', $coordinate->getLongitude());
    }

    /**
     * @param VariableAwareInterface $object
     * @param Point                  $point
     * @param string|null            $expected
     */
    protected function assertPoint(VariableAwareInterface $object, Point $point, $expected = null)
    {
        $this->assertSameContainerVariable($object, 'base.points', $point, $expected);
        $this->assertSameVariable($point->getVariable().'.x', $point->getX());
        $this->assertSameVariable($point->getVariable().'.y', $point->getY());
    }

    /**
     * @param VariableAwareInterface $object
     * @param Size                   $size
     * @param string|null            $expected
     */
    protected function assertSize(VariableAwareInterface $object, Size $size, $expected = null)
    {
        $this->assertSameContainerVariable($object, 'base.sizes', $size, $expected);
        $this->assertSameVariable($size->getVariable().'.width', $size->getWidth());
        $this->assertSameVariable($size->getVariable().'.height', $size->getHeight());
    }

    /**
     * @param VariableAwareInterface $root
     * @param string|null            $propertyPath
     */
    protected function assertContainerVariableExists(VariableAwareInterface $root, $propertyPath = null)
    {
        $this->assertVariableExists($this->getContainer($root, $propertyPath));
    }

    /**
     * @param VariableAwareInterface      $root
     * @param string                      $propertyPath
     * @param VariableAwareInterface|null $object
     * @param string|null                 $expected
     * @param callable|null               $formatter
     */
    protected function assertSameContainerVariable(
        VariableAwareInterface $root,
        $propertyPath,
        VariableAwareInterface $object = null,
        $expected = null,
        $formatter = null
    ) {
        $this->assertSameObject($this->getContainer($root, $propertyPath, $object), $object ?: $root);

        if (!empty($expected)) {
            $this->assertSameObject($expected, $object ?: $root, $formatter);
        }
    }

    /**
     * @param VariableAwareInterface $object
     */
    protected function assertObjectExists(VariableAwareInterface $object)
    {
        $this->assertVariableExists($object->getVariable());
    }

    /**
     * @param string                 $expected
     * @param VariableAwareInterface $object
     * @param callable|null          $formatter
     */
    protected function assertSameObject($expected, VariableAwareInterface $object, $formatter = null)
    {
        $this->assertSameVariable($expected, $object->getVariable(), $formatter);
    }

    /**
     * @return ApiHelper
     */
    protected function createApiHelper()
    {
        return ApiHelperBuilder::create()->build();
    }

    /**
     * @param VariableAwareInterface      $root
     * @param string|null                 $propertyPath
     * @param VariableAwareInterface|null $object
     *
     * @return string
     */
    private function getContainer(
        VariableAwareInterface $root,
        $propertyPath = null,
        VariableAwareInterface $object = null
    ) {
        $variable = $root->getVariable().'_container';

        if (!empty($propertyPath)) {
            $variable .= '.'.$propertyPath;
        }

        if ($object !== null) {
            $variable .= '.'.$object->getVariable();
        }

        return $variable;
    }
}
