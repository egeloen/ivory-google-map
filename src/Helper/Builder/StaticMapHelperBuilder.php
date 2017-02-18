<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Builder;

use Ivory\GoogleMap\Helper\Collector\Image\EncodedPolylineCollector;
use Ivory\GoogleMap\Helper\Collector\Image\ExtendableCollector;
use Ivory\GoogleMap\Helper\Collector\Image\MarkerCollector;
use Ivory\GoogleMap\Helper\Collector\Image\PolylineCollector;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\CoordinateRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\PointRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\EncodedPolylineRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\EncodedPolylineStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\EncodedPolylineValueRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\ExtendableRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerLocationRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\PolylineLocationRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\PolylineRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\PolylineStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\SizeRenderer;
use Ivory\GoogleMap\Helper\StaticMapHelper;
use Ivory\GoogleMap\Helper\Subscriber\Image\CenterSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\EncodedPolylineSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\ExtendableSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\FormatSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\KeySubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\MarkerSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\PolylineSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\ScaleSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\SizeSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\StaticSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\TypeSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Image\ZoomSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticMapHelperBuilder extends AbstractHelperBuilder
{
    /**
     * @var string|null
     */
    private $key;

    /**
     * @var string|null
     */
    private $secret;

    /**
     * @var string|null
     */
    private $clientId;

    /**
     * @var string|null
     */
    private $channel;

    /**
     * @param string|null $key
     * @param string|null $secret
     * @param string|null $clientId
     * @param string|null $channel
     */
    public function __construct($key = null, $secret = null, $clientId = null, $channel = null)
    {
        $this->setKey($key);
        $this->setSecret($secret);
        $this->setClientId($clientId);
        $this->setChannel($channel);
    }

    /**
     * @return bool
     */
    public function hasKey()
    {
        return $this->key !== null;
    }

    /**
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     *
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasSecret()
    {
        return $this->secret !== null;
    }

    /**
     * @return string|null
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string|null $secret
     *
     * @return $this
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasClientId()
    {
        return $this->clientId !== null;
    }

    /**
     * @return string|null
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string|null $clientId
     *
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasChannel()
    {
        return $this->channel !== null;
    }

    /**
     * @return string|null
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string|null $channel
     *
     * @return $this
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @return StaticMapHelper
     */
    public function build()
    {
        return new StaticMapHelper(
            $this->createEventDispatcher(),
            $this->getSecret(),
            $this->getClientId(),
            $this->getChannel()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createSubscribers()
    {
        // Pre-loaded Renderers
        $pointRenderer = new PointRenderer();
        $markerStyleRenderer = new MarkerStyleRenderer($pointRenderer);

        // Collectors
        $encodedPolylineCollector = new EncodedPolylineCollector();
        $extendableCollector = new ExtendableCollector();
        $markerCollector = new MarkerCollector($markerStyleRenderer);
        $polylineCollector = new PolylineCollector();

        // Renderers
        $coordinateRenderer = new CoordinateRenderer();
        $sizeRenderer = new SizeRenderer();
        $encodedPolylineValueRenderer = new EncodedPolylineValueRenderer();
        $encodedPolylineStyleRenderer = new EncodedPolylineStyleRenderer();
        $encodedPolylineRenderer = new EncodedPolylineRenderer($encodedPolylineStyleRenderer, $encodedPolylineValueRenderer);
        $markerLocationRenderer = new MarkerLocationRenderer($coordinateRenderer);
        $markerRenderer = new MarkerRenderer($markerStyleRenderer, $markerLocationRenderer);
        $polylineLocationRenderer = new PolylineLocationRenderer($coordinateRenderer);
        $polylineStyleRenderer = new PolylineStyleRenderer();
        $polylineRenderer = new PolylineRenderer($polylineStyleRenderer, $polylineLocationRenderer);
        $extendableRenderer = new ExtendableRenderer(
            $coordinateRenderer,
            $markerLocationRenderer,
            $polylineLocationRenderer
        );

        return array_merge([
            new CenterSubscriber($coordinateRenderer),
            new EncodedPolylineSubscriber($encodedPolylineCollector, $encodedPolylineRenderer),
            new ExtendableSubscriber($extendableCollector, $extendableRenderer),
            new FormatSubscriber(),
            new KeySubscriber($this->key),
            new MarkerSubscriber($markerCollector, $markerRenderer),
            new PolylineSubscriber($polylineCollector, $polylineRenderer),
            new ScaleSubscriber(),
            new SizeSubscriber($sizeRenderer),
            new StaticSubscriber(),
            new TypeSubscriber(),
            new ZoomSubscriber(),
        ], parent::createSubscribers());
    }
}
