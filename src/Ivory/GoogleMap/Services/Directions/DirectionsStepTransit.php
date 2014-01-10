<?php

namespace Ivory\GoogleMap\Services\Directions;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;
use Ivory\GoogleMap\Services\Base\TransitDetails;

class DirectionsStepTransit extends DirectionsStep
{
    /** @var TransitDetails */
    protected $transitDetails;

    /**
     * Creates a directions step.
     *
     * @param Distance $distance The distance.
     * @param Duration $duration The duration.
     * @param Coordinate $endLocation The end location.
     * @param string $instructions The instructions.
     * @param EncodedPolyline $encodedPolyline The encoded polyline.
     * @param Coordinate $startLocation The start location.
     * @param string $travelMode The travel mode.
     * @param TransitDetails $transitDetails Transit details.
     */
    public function __construct(
        Distance $distance,
        Duration $duration,
        Coordinate $endLocation,
        $instructions,
        EncodedPolyline $encodedPolyline,
        Coordinate $startLocation,
        $travelMode,
        TransitDetails $transitDetails
    ) {
        parent::__construct(
            $distance,
            $duration,
            $endLocation,
            $instructions,
            $encodedPolyline,
            $startLocation,
            $travelMode
        );
        $this->transitDetails = $transitDetails;
    }

    /**
     * @return TransitDetails
     */
    public function getTransitDetails()
    {
        return $this->transitDetails;
    }

    /**
     * @param TransitDetails $transitDetails
     */
    public function setTransitDetails(TransitDetails $transitDetails)
    {
        $this->transitDetails = $transitDetails;
    }
}
