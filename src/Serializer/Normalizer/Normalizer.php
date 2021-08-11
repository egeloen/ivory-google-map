<?php


namespace Ivory\GoogleMap\Serializer\Normalizer;


use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

abstract class Normalizer implements DenormalizerAwareInterface, DenormalizerInterface
{
    use DenormalizerAwareTrait;

    protected function getFirstAvailableKey(array $keys, array $data): ?string
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $data)) {
                return $key;
            }
        }

        return null;
    }


    protected function setIfPresent(string $string, array $data, callable $setter)
    {
        if (array_key_exists($string, $data)) {
            $setter($data[$string]);
        }
    }

    protected function setIfPresentFloat(string $string, array $data, callable $setter)
    {
        if (array_key_exists($string, $data)) {
            $setter(floatval($data[$string]));
        }
    }

    protected function setIfPresentDenormalize(string $key, array $data, callable $setter, string $type, string $format, array $context)
    {
        if (array_key_exists($key, $data)) {
            $setter($this->denormalizer->denormalize($data[$key], $type, $format, $context));
        }
    }
}