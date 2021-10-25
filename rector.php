<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;
use Rector\TypeDeclaration\Rector\Property\CompleteVarDocTypePropertyRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_74);
    $parameters->set(Option::PATHS, [
//        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);
    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

//    $containerConfigurator->import(SetList::DEAD_CODE);
//    $containerConfigurator->import(LevelSetList::UP_TO_PHP_74);
//    $containerConfigurator->import(SymfonySetList::SYMFONY_44);
    $containerConfigurator->import(PHPUnitSetList::PHPUNIT_80);

    $services = $containerConfigurator->services();
//    $services->set(CompleteVarDocTypePropertyRector::class);
};
