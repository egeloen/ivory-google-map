<?php

namespace Ivory\GoogleMap\Serializer\Normalizer\Place;

use DateTime;
use Ivory\GoogleMap\Service\Place\Base\Review;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ReviewNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): Review
    {
        $place = new Review();

        $place->setText($data['text']);
        $place->setAuthorName($data['author_name']);
        $place->setAuthorUrl($data['author_url']);
        $place->setLanguage($data['language']);
        $place->setRating(floatval($data['rating']));
        $place->setTime(new DateTime('@'.$data['time']));

        return $place;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Review::class === $type;
    }
}