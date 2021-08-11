<?php

namespace Ivory\GoogleMap\Serializer\Normalizer;

use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Place\Base\Photo;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PhotoNormalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $type, $format = null, array $context = []): Photo
    {
        $photo = new Photo();


        $photo->setHeight($data['height']);
        $photo->setWidth($data['width']);
        $photo->setHtmlAttributions($data['html_attributions']);
        $photo->setReference($data['photo_reference']);

        return $photo;
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Photo::class === $type;
    }
}