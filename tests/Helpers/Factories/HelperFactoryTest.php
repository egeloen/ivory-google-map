<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Factories;

use Ivory\GoogleMap\Helpers\Factories\HelperFactory;

/**
 * Helper factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class HelperFactoryTest extends AbstractHelperFactoryTest
{
    public function testDefaultState()
    {
        $this->assertFalse($this->helperFactory->isDebug());
        $this->assertSame(4, $this->helperFactory->getIndentation());
        $this->assertJsonBuilderInstance($this->helperFactory->getJsonBuilder());
        $this->assertFormatterInstance($this->helperFactory->getFormatter());
        $this->assertAggregators();
        $this->assertRenderers();
        $this->assertSubscribers();
    }

    public function testInitialState()
    {
        $this->helperFactory = new HelperFactory(false, $indentation = 2);

        $this->assertFalse($this->helperFactory->isDebug());
        $this->assertSame($indentation, $this->helperFactory->getIndentation());
    }

    public function testSetJsonBuilder()
    {
        $this->helperFactory->setJsonBuilder($jsonBuilder = $this->createJsonBuilderMock());

        $this->assertSame($jsonBuilder, $this->helperFactory->getJsonBuilder());

        foreach ($this->getJsonBuilders() as $item) {
            $this->assertSame($item, $jsonBuilder);
        }
    }

    public function testSetFormatter()
    {
        $this->helperFactory->setFormatter($formatter = $this->createFormatterMock());

        $this->assertSame($formatter, $this->helperFactory->getFormatter());

        foreach ($this->getFormatters() as $item) {
            $this->assertSame($item, $formatter);
        }
    }

    /**
     * @dataProvider aggregatorsProvider
     */
    public function testSetAggregators(array $aggregators, $assertion = null)
    {
        $this->helperFactory->setAggregators($aggregators);

        $this->assertAggregators($aggregators);

        if ($assertion !== null) {
            foreach ($aggregators as $aggregator) {
                call_user_func($assertion, $this, $aggregator);
            }
        }
    }

    /**
     * @dataProvider aggregatorsProvider
     */
    public function testAddAggregators(array $aggregators, $assertion = null)
    {
        $this->helperFactory->addAggregators($aggregators);

        $this->assertAggregators($aggregators);

        if ($assertion !== null) {
            foreach ($aggregators as $aggregator) {
                call_user_func($assertion, $this, $aggregator);
            }
        }
    }

    /**
     * @dataProvider aggregatorsProvider
     */
    public function testRemoveAggregators(array $aggregators)
    {
        $this->helperFactory->setAggregators($aggregators);
        $this->helperFactory->removeAggregators(array_keys($aggregators));

        $this->assertAggregators();
    }

    /**
     * @dataProvider aggregatorsProvider
     */
    public function testResetAggregators(array $aggregators)
    {
        $this->helperFactory->setAggregators($aggregators);
        $this->helperFactory->resetAggregators();

        $this->assertAggregators();
    }

    /**
     * @dataProvider aggregatorProvider
     */
    public function testSetAggregator($name, $aggregator, $assertion = null)
    {
        $this->helperFactory->setAggregator($name, $aggregator);

        $this->assertAggregator($name, $aggregator);

        if ($assertion !== null) {
            call_user_func($assertion, $this, $aggregator);
        }
    }

    /**
     * @dataProvider aggregatorProvider
     */
    public function testRemoveAggregator($name, $aggregator)
    {
        $this->helperFactory->setAggregator($name, $aggregator);
        $this->helperFactory->removeAggregator($name);

        $this->assertAggregators();
    }

    /**
     * @dataProvider renderersProvider
     */
    public function testSetRenderers(array $renderers, $assertion = null)
    {
        $this->helperFactory->setRenderers($renderers);

        $this->assertRenderers($renderers);

        if ($assertion !== null) {
            foreach ($renderers as $renderer) {
                call_user_func($assertion, $this, $renderer);
            }
        }
    }

    /**
     * @dataProvider renderersProvider
     */
    public function testAddRenderers(array $renderers, $assertion = null)
    {
        $this->helperFactory->addRenderers($renderers);

        $this->assertRenderers($renderers);

        if ($assertion !== null) {
            foreach ($renderers as $renderer) {
                call_user_func($assertion, $this, $renderer);
            }
        }
    }

    /**
     * @dataProvider renderersProvider
     */
    public function testRemoveRenderers(array $renderers)
    {
        $this->helperFactory->setRenderers($renderers);
        $this->helperFactory->removeRenderers(array_keys($renderers));

        $this->assertRenderers();
    }

    /**
     * @dataProvider renderersProvider
     */
    public function testResetRenderers(array $renderers)
    {
        $this->helperFactory->setRenderers($renderers);
        $this->helperFactory->resetRenderers();

        $this->assertRenderers();
    }

    /**
     * @dataProvider rendererProvider
     */
    public function testSetRenderer($name, $renderer, $assertion = null)
    {
        $this->helperFactory->setRenderer($name, $renderer);

        $this->assertRenderer($name, $renderer);

        if ($assertion !== null) {
            call_user_func($assertion, $this, $renderer);
        }
    }

    /**
     * @dataProvider rendererProvider
     */
    public function testRemoveRenderer($name, $renderer)
    {
        $this->helperFactory->setRenderer($name, $renderer);
        $this->helperFactory->removeRenderer($name);

        $this->assertRenderers();
    }

    /**
     * @dataProvider subscribersProvider
     */
    public function testSetSubscribers(array $subscribers)
    {
        $this->helperFactory->setSubscribers($subscribers);

        $this->assertSubscribers($subscribers);
    }

    /**
     * @dataProvider subscribersProvider
     */
    public function testAddSubscribers(array $subscribers)
    {
        $this->helperFactory->addSubscribers($subscribers);

        $this->assertSubscribers($subscribers);
    }

    /**
     * @dataProvider subscribersProvider
     */
    public function testRemoveSubscribers(array $subscribers)
    {
        $this->helperFactory->setSubscribers($subscribers);
        $this->helperFactory->removeSubscribers($names = array_keys($subscribers));

        foreach ($names as $name) {
            $this->assertNoSubscriber($name);
        }
    }

    /**
     * @dataProvider subscribersProvider
     */
    public function testResetSubscribers(array $subscribers)
    {
        $this->helperFactory->setSubscribers($subscribers);
        $this->helperFactory->resetSubscribers();

        $this->assertSubscribers();
    }

    /**
     * @dataProvider subscriberProvider
     */
    public function testSetSubscriber($name)
    {
        $this->helperFactory->setSubscriber($name, $subscriber = $this->createSymfonyEventSubscriberMock());

        $this->assertSubscriber($name, $subscriber);
    }

    /**
     * @dataProvider subscriberProvider
     */
    public function testRemoveSubscriber($name)
    {
        $this->helperFactory->setSubscriber($name, $this->createSymfonyEventSubscriberMock());
        $this->helperFactory->removeSubscriber($name);

        $this->assertNoSubscriber($name);
    }

    /**
     * Gets the aggregator provider.
     *
     * @return array The aggregator provider.
     */
    public function aggregatorProvider()
    {
        return array(
            array(
                'bound',
                $this->createBoundAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('bound'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getAggregator('coordinate')->getBoundAggregator(),
                        $aggregator
                    );

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('bound')->getBoundAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'circle',
                $this->createCircleAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('circle'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getAggregator('coordinate')->getCircleAggregator(),
                        $aggregator
                    );

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('circle')->getCircleAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'coordinate',
                $this->createCoordinateAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('coordinate'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('coordinate')->getCoordinateAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'dom_event',
                $this->createDomEventAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('dom_event'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('dom_event')->getDomEventAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'dom_event_once',
                $this->createDomEventOnceAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('dom_event_once'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('dom_event_once')->getDomEventOnceAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'encoded_polyline',
                $this->createEncodedPolylineAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('encoded_polyline'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('encoded_polyline')->getEncodedPolylineAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'event',
                $this->createEventAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('event'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('event')->getEventAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'event_once',
                $this->createEventOnceAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('event_once'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('event_once')->getEventOnceAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'extendable',
                $this->createExtendableAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('extendable'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('extendable')->getExtendableAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'ground_overlay',
                $this->createGroundOverlayAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('ground_overlay'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getAggregator('bound')->getGroundOverlayAggregator(),
                        $aggregator
                    );

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('ground_overlay')->getGroundOverlayAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'icon',
                $this->createIconAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('icon'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getAggregator('size')->getIconAggregator(),
                        $aggregator
                    );

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('icon')->getIconAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'info_window',
                $this->createInfoWindowAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('info_window'), $aggregator);

                    foreach (array('coordinate', 'size') as $value) {
                        $test->assertSame(
                            $test->getHelperFactory()->getAggregator($value)->getInfoWindowAggregator(),
                            $aggregator
                        );
                    }

                    foreach (array('info_window_close', 'info_window_open', 'info_window') as $value) {
                        $test->assertSame(
                            $test->getHelperFactory()->getSubscriber($value)->getInfoWindowAggregator(),
                            $aggregator
                        );
                    }
                },
            ),
            array(
                'kml_layer',
                $this->createKmlLayerAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('kml_layer'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('kml_layer')->getKmlLayerAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'marker',
                $this->createMarkerAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('marker'), $aggregator);

                    foreach (array('coordinate', 'icon', 'info_window', 'marker_shape', 'point') as $value) {
                        $test->assertSame(
                            $test->getHelperFactory()->getAggregator($value)->getMarkerAggregator(),
                            $aggregator
                        );
                    }

                    foreach (array('marker_open_event', 'marker') as $value) {
                        $test->assertSame(
                            $test->getHelperFactory()->getSubscriber($value)->getMarkerAggregator(),
                            $aggregator
                        );
                    }
                },
            ),
            array(
                'marker_shape',
                $this->createMarkerShapeAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('marker_shape'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('marker_shape')->getMarkerShapeAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'point',
                $this->createPointAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('point'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('point')->getPointAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'size',
                $this->createSizeAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('size'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('size')->getSizeAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'polygon',
                $this->createPolygonAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('polygon'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getAggregator('coordinate')->getPolygonAggregator(),
                        $aggregator
                    );

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('polygon')->getPolygonAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'polyline',
                $this->createPolylineAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('polyline'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getAggregator('coordinate')->getPolylineAggregator(),
                        $aggregator
                    );

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('polyline')->getPolylineAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'rectangle',
                $this->createRectangleAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('rectangle'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getAggregator('bound')->getRectangleAggregator(),
                        $aggregator
                    );

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('rectangle')->getRectangleAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'autocomplete_bound',
                $this->createAutocompleteBoundAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('autocomplete_bound'), $aggregator);

                    $test->assertSame(
                        $test->getHelperFactory()->getAggregator('autocomplete_coordinate')->getBoundAggregator(),
                        $aggregator
                    );

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('autocomplete_bound')->getBoundAggregator(),
                        $aggregator
                    );
                },
            ),
            array(
                'autocomplete_coordinate',
                $this->createAutocompleteCoordinateAggregatorMock(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($test->getHelperFactory()->getAggregator('autocomplete_coordinate'), $aggregator);
                },
            ),
            array(
                'custom',
                new \stdClass(),
                function (\PHPUnit_Framework_TestCase $test, $aggregator) {
                    $test->assertSame($aggregator, $test->getHelperFactory()->getAggregator('custom'));
                },
            ),
        );
    }

    /**
     * Gets the aggregators provider.
     *
     * @return array The aggregators provider.
     */
    public function aggregatorsProvider()
    {
        $aggregators = array();

        foreach ($this->aggregatorProvider() as $provider) {
            $aggregators[] = array(array($provider[0] => $provider[1]), $provider[2]);
        }

        return $aggregators;
    }

    /**
     * Gets the renderer provider.
     *
     * @return array The renderer provider.
     */
    public function rendererProvider()
    {
        return array(
            array(
                'animation',
                $this->createAnimationRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('animation'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('marker')->getAnimationRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'autocomplete',
                $this->createAutocompleteRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('autocomplete'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('autocomplete')->getAutocompleteRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'autocomplete_container',
                $this->createAutocompleteContainerRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('autocomplete_container'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('autocomplete_container')->getContainerRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'bound',
                $this->createBoundRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('bound'), $renderer);

                    foreach (array('bound', 'autocomplete_bound') as $value) {
                        $test->assertSame(
                            $test->getHelperFactory()->getSubscriber($value)->getBoundRenderer(),
                            $renderer
                        );
                    }
                },
            ),
            array(
                'circle',
                $this->createCircleRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('circle'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('circle')->getCircleRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'coordinate',
                $this->createCoordinateRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('coordinate'), $renderer);

                    foreach (array('coordinate', 'autocomplete_coordinate') as $value) {
                        $test->assertSame(
                            $test->getHelperFactory()->getSubscriber($value)->getCoordinateRenderer(),
                            $renderer
                        );
                    }
                },
            ),
            array(
                'controls',
                $this->createControlsRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('controls'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('map')->getControlsRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'control_position',
                $this->createControlPositionRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('control_position'), $renderer);

                    $values = array(
                        'map_type_control',
                        'pan_control',
                        'rotate_control',
                        'street_view_control',
                        'zoom_control',
                    );

                    foreach ($values as $value) {
                        $test->assertSame(
                            $test->getHelperFactory()->getRenderer($value)->getControlPositionRenderer(),
                            $renderer
                        );
                    }
                },
            ),
            array(
                'dom_event',
                $this->createDomEventRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('dom_event'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('dom_event')->getDomEventRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'dom_event_once',
                $this->createDomEventOnceRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('dom_event_once'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('dom_event_once')->getDomEventOnceRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'encoded_polyline',
                $this->createEncodedPolylineRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('encoded_polyline'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('encoded_polyline')->getEncodedPolylineRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'encoding',
                $this->createEncodingRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('encoding'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('encoded_polyline')->getEncodingRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'event',
                $this->createEventRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('event'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('event')->getEventRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'event_once',
                $this->createEventOnceRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('event_once'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('event_once')->getEventOnceRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'extendable',
                $this->createExtendableRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('extendable'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('extendable')->getExtendableRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'ground_overlay',
                $this->createGroundOverlayRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('ground_overlay'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('ground_overlay')->getGroundOverlayRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'icon',
                $this->createIconRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('icon'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('icon')->getIconRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'info_box',
                $this->createInfoBoxRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('info_box'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('info_window')->getInfoBoxRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'info_window',
                $this->createInfoWindowRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('info_window'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('info_window')->getInfoWindowRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'info_window_close',
                $this->createInfoWindowCloseRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('info_window_close'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('info_window_close')->getInfoWindowCloseRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'info_window_open',
                $this->createInfoWindowOpenRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('info_window_open'), $renderer);

                    foreach (array('info_window_open', 'marker_open_event') as $value) {
                        $test->assertSame(
                            $test->getHelperFactory()->getSubscriber($value)->getInfoWindowOpenRenderer(),
                            $renderer
                        );
                    }
                },
            ),
            array(
                'kml_layer',
                $this->createKmlLayerRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('kml_layer'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('kml_layer')->getKmlLayerRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'loader',
                $this->createLoaderRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('loader'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('api_javascript')->getLoaderRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'map',
                $this->createMapRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('map'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('map')->getMapRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'map_bound',
                $this->createMapBoundRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('map_bound'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('map_bound')->getMapBoundRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'map_center',
                $this->createMapCenterRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('map_center'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('map_center')->getMapCenterRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'map_container',
                $this->createMapContainerRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('map_container'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('map_container')->getContainerRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'map_type_control',
                $this->createMapTypeControlRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('map_type_control'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('controls')->getMapTypeControlRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'map_type_control_style',
                $this->createMapTypeControlStyleRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('map_type_control_style'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('map_type_control')->getMapTypeControlStyleRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'map_type_id',
                $this->createMapTypeIdRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('map_type_id'), $renderer);

                    foreach (array('map_type_control', 'map') as $value) {
                        $test->assertSame(
                            $test->getHelperFactory()->getRenderer($value)->getMapTypeIdRenderer(),
                            $renderer
                        );
                    }
                },
            ),
            array(
                'marker',
                $this->createMarkerRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('marker'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('marker')->getMarkerRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'marker_cluster',
                $this->createMarkerClusterRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('marker_cluster'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('marker_cluster')->getMarkerClusterRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'marker_shape',
                $this->createMarkerShapeRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('marker_shape'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('marker_shape')->getMarkerShapeRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'overview_map_control',
                $this->createOverviewMapControlRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('overview_map_control'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('controls')->getOverviewMapControlRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'pan_control',
                $this->createPanControlRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('pan_control'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('controls')->getPanControlRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'point',
                $this->createPointRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('point'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('point')->getPointRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'polygon',
                $this->createPolygonRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('polygon'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('polygon')->getPolygonRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'polyline',
                $this->createPolylineRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('polyline'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('polyline')->getPolylineRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'rectangle',
                $this->createRectangleRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('rectangle'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('rectangle')->getRectangleRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'rotate_control',
                $this->createRotateControlRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('rotate_control'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('controls')->getRotateControlRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'scale_control',
                $this->createScaleControlRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('scale_control'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('controls')->getScaleControlRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'scale_control_style',
                $this->createScaleControlStyleRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('scale_control_style'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('scale_control')->getScaleControlStyleRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'size',
                $this->createSizeRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('size'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getSubscriber('size')->getSizeRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'street_view_control',
                $this->createStreetViewControlRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('street_view_control'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('controls')->getStreetViewControlRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'zoom_control',
                $this->createZoomControlRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('zoom_control'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('controls')->getZoomControlRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'zoom_control_style',
                $this->createZoomControlStyleRendererMock(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('zoom_control_style'), $renderer);

                    $test->assertSame(
                        $test->getHelperFactory()->getRenderer('zoom_control')->getZoomControlStyleRenderer(),
                        $renderer
                    );
                },
            ),
            array(
                'custom',
                new \stdClass(),
                function (\PHPUnit_Framework_TestCase $test, $renderer) {
                    $test->assertSame($test->getHelperFactory()->getRenderer('custom'), $renderer);
                },
            ),
        );
    }

    /**
     * Gets the renderers provider.
     *
     * @return array The renderers provider.
     */
    public function renderersProvider()
    {
        $renderers = array();

        foreach ($this->rendererProvider() as $provider) {
            $renderers[] = array(array($provider[0] => $provider[1]), $provider[2]);
        }

        return $renderers;
    }

    /**
     * Gets the subscriber provider.
     *
     * @return array The subscriber provider.
     */
    public function subscriberProvider()
    {
        return array(
            array('base'),
            array('events'),
            array('layers'),
            array('overlays'),
            array('autocomplete_base'),
            array('bound'),
            array('coordinate'),
            array('point'),
            array('size'),
            array('dom_event_once'),
            array('dom_event'),
            array('event_once'),
            array('event'),
            array('kml_layer'),
            array('circle'),
            array('encoded_polyline'),
            array('extendable'),
            array('ground_overlay'),
            array('icon'),
            array('info_window_close'),
            array('info_window_open'),
            array('info_window'),
            array('marker_cluster'),
            array('marker_open_event'),
            array('marker_shape'),
            array('marker'),
            array('polygon'),
            array('polyline'),
            array('rectangle'),
            array('autocomplete_bound'),
            array('autocomplete_coordinate'),
            array('autocomplete_container'),
            array('autocomplete_html'),
            array('autocomplete_init'),
            array('autocomplete_javascript'),
            array('autocomplete'),
            array('api_javascript'),
            array('map_bound'),
            array('map_center'),
            array('map_container'),
            array('map_finish'),
            array('map_html'),
            array('map_init'),
            array('map_javascript'),
            array('map_stylesheet'),
            array('map'),
            array('custom'),
        );
    }

    /**
     * Gets the subscribers provider.
     *
     * @return array The subscribers provider.
     */
    public function subscribersProvider()
    {
        $subscribers = array();

        foreach ($this->subscriberProvider() as $provider) {
            $subscribers[] = array(array($provider[0] => $this->createSymfonyEventSubscriberMock()));
        }

        return $subscribers;
    }

    /**
     * Gets the helper factory.
     *
     * @return \Ivory\GoogleMap\Helpers\Factories\HelperFactoryInterface The helper factory.
     */
    public function getHelperFactory()
    {
        return $this->helperFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function createHelperFactory()
    {
        return new HelperFactory();
    }

    /**
     * Asserts the are aggregators.
     *
     * @param array $aggregators The aggregators.
     */
    private function assertAggregators($aggregators = array())
    {
        $aggregators = array_merge(
            array(
                'autocomplete_bound'      => 'Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator',
                'autocomplete_coordinate' => 'Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator',
                'marker'                  => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator',
                'circle'                  => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator',
                'encoded_polyline'        => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator',
                'extendable'              => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator',
                'ground_overlay'          => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator',
                'icon'                    => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator',
                'info_window'             => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator',
                'marker_shape'            => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator',
                'polygon'                 => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator',
                'polyline'                => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator',
                'rectangle'               => 'Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator',
                'kml_layer'               => 'Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator',
                'dom_event_once'          => 'Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator',
                'dom_event'               => 'Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator',
                'event_once'              => 'Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator',
                'event'                   => 'Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator',
                'bound'                   => 'Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator',
                'coordinate'              => 'Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator',
                'point'                   => 'Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator',
                'size'                    => 'Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator',
            ),
            $aggregators
        );

        $this->assertInternalType('array', $aggregators);

        $this->assertTrue($this->helperFactory->hasAggregators());
        $this->assertNotEmpty($this->helperFactory->getAggregators());

        foreach ($aggregators as $name => $aggregator) {
            $this->assertAggregator($name, $aggregator);
        }
    }

    /**
     * Asserts there is an aggregator.
     *
     * @param string $name       The name.
     * @param object $aggregator The aggregator.
     */
    private function assertAggregator($name, $aggregator)
    {
        $this->assertTrue($this->helperFactory->hasAggregator($name));

        if (is_string($aggregator)) {
            $this->assertInstanceOf($aggregator, $this->helperFactory->getAggregator($name));
        } else {
            $this->assertSame($aggregator, $this->helperFactory->getAggregator($name));
        }
    }

    /**
     * Asserts the are renderers.
     *
     * @param array $renderers The renderers.
     */
    private function assertRenderers($renderers = array())
    {
        $renderers = array_merge(
            array(
                'bound'                  => 'Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer',
                'coordinate'             => 'Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer',
                'point'                  => 'Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer',
                'size'                   => 'Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer',
                'dom_event_once'         => 'Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer',
                'dom_event'              => 'Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer',
                'event_once'             => 'Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer',
                'event'                  => 'Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer',
                'encoding'               => 'Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer',
                'kml_layer'              => 'Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer',
                'animation'              => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer',
                'circle'                 => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer',
                'encoded_polyline'       => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer',
                'extendable'             => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer',
                'ground_overlay'         => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer',
                'icon'                   => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer',
                'info_window_close'      => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer',
                'info_window_open'       => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer',
                'info_window'            => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer',
                'info_box'               => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer',
                'marker_cluster'         => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer',
                'marker_shape'           => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer',
                'marker'                 => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer',
                'polygon'                => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer',
                'polyline'               => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer',
                'rectangle'              => 'Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer',
                'autocomplete_container' => 'Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer',
                'autocomplete'           => 'Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer',
                'loader'                 => 'Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer',
                'map_bound'              => 'Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer',
                'map_center'             => 'Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer',
                'map_container'          => 'Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer',
                'map_type_id'            => 'Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer',
                'control_position'       => 'Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer',
                'map_type_control_style' => 'Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer',
                'overview_map_control'   => 'Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer',
                'pan_control'            => 'Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer',
                'rotate_control'         => 'Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer',
                'scale_control_style'    => 'Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer',
                'scale_control'          => 'Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer',
                'street_view_control'    => 'Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer',
                'zoom_control_style'     => 'Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer',
                'zoom_control'           => 'Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer',
                'map_type_control'       => 'Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer',
                'controls'               => 'Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer',
                'map'                    => 'Ivory\GoogleMap\Helpers\Renderers\MapRenderer',
            ),
            $renderers
        );

        $this->assertInternalType('array', $renderers);

        $this->assertTrue($this->helperFactory->hasRenderers());
        $this->assertNotEmpty($this->helperFactory->getRenderers());

        foreach ($renderers as $name => $renderer) {
            $this->assertRenderer($name, $renderer);
        }
    }

    /**
     * Asserts there is an renderer.
     *
     * @param string $name     The name.
     * @param object $renderer The renderer.
     */
    private function assertRenderer($name, $renderer)
    {
        $this->assertTrue($this->helperFactory->hasRenderer($name));

        if (is_string($renderer)) {
            $this->assertInstanceOf($renderer, $this->helperFactory->getRenderer($name));
        } else {
            $this->assertSame($renderer, $this->helperFactory->getRenderer($name));
        }
    }

    /**
     * Asserts the are subscribers.
     *
     * @param array $subscribers The subscribers.
     */
    private function assertSubscribers($subscribers = array())
    {
        $subscribers = array_merge(
            array(

            ),
            $subscribers
        );

        $this->assertInternalType('array', $subscribers);

        $this->assertTrue($this->helperFactory->hasSubscribers());
        $this->assertNotEmpty($this->helperFactory->getSubscribers());

        foreach ($subscribers as $name => $subscriber) {
            $this->assertSubscriber($name, $subscriber);
        }
    }

    /**
     * Asserts there is an subscriber.
     *
     * @param string $name       The name.
     * @param object $subscriber The subscriber.
     */
    private function assertSubscriber($name, $subscriber)
    {
        $this->assertTrue($this->helperFactory->hasSubscriber($name));

        if (is_string($subscriber)) {
            $this->assertInstanceOf($subscriber, $this->helperFactory->getSubscriber($name));
        } else {
            $this->assertSame($subscriber, $this->helperFactory->getSubscriber($name));
        }
    }

    /**
     * Asserts there is no subscriber.
     *
     * @param string $name The subscriber name.
     */
    private function assertNoSubscriber($name)
    {
        $this->assertFalse($this->helperFactory->hasSubscriber($name));
        $this->assertNull($this->helperFactory->getSubscriber($name));
    }
}
