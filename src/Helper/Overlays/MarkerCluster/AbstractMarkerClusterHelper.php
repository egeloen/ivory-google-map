<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays\MarkerCluster;

use Ivory\GoogleMap\Helper\AbstractHelper;
use Ivory\GoogleMap\Helper\Overlays\MarkerHelper;

/**
 * Abstract marker cluster helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractMarkerClusterHelper extends AbstractHelper implements MarkerClusterHelperInterface
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerHelper */
    protected $markerHelper;

    /**
     * Creates a default marker cluster helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerHelper $markerHelper The marker helper.
     */
    public function __construct(MarkerHelper $markerHelper = null)
    {
        parent::__construct();

        if ($markerHelper === null) {
            $markerHelper = new MarkerHelper();
        }

        $this->setMarkerHelper($markerHelper);
    }

    /**
     * Gets the marker helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\MarkerHelper The marker helper.
     */
    public function getMarkerHelper()
    {
        return $this->markerHelper;
    }

    /**
     * Sets the marker helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerHelper $markerHelper The marker helper.
     */
    public function setMarkerHelper(MarkerHelper $markerHelper)
    {
        $this->markerHelper = $markerHelper;
    }
}
