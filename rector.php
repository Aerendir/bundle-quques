<?php

declare(strict_types=1);

/*
 * This file is part of the Serendipity HQ Commands Queues Bundle.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_74);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $parameters->set(Option::BOOTSTRAP_FILES, [__DIR__ . '/vendor-bin/phpunit/vendor/autoload.php']);

    $containerConfigurator->import(SetList::ACTION_INJECTION_TO_CONSTRUCTOR_INJECTION);
    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(SetList::CODING_STYLE);
    $containerConfigurator->import(SetList::MONOLOG_20);
    $containerConfigurator->import(SetList::FRAMEWORK_EXTRA_BUNDLE_40);
    $containerConfigurator->import(SetList::FRAMEWORK_EXTRA_BUNDLE_50);
    $containerConfigurator->import(SetList::PHP_52);
    $containerConfigurator->import(SetList::PHP_53);
    $containerConfigurator->import(SetList::PHP_54);
    $containerConfigurator->import(SetList::PHP_56);
    $containerConfigurator->import(SetList::PHP_70);
    $containerConfigurator->import(SetList::PHP_71);
    $containerConfigurator->import(SetList::PHP_72);
    $containerConfigurator->import(SetList::PHP_73);
    $containerConfigurator->import(SetList::UNWRAP_COMPAT);
    $containerConfigurator->import(SetList::SAFE_07);
    $containerConfigurator->import(SetList::TYPE_DECLARATION);

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);
    $parameters->set(Option::IMPORT_DOC_BLOCKS, true);
    $parameters->set(Option::IMPORT_SHORT_CLASSES, false);

    $parameters->set(
        Option::SKIP,
        [
            __DIR__ . '/src/Admin/Sonata',
            __DIR__ . '/src/Command/AbstractQueuesCommand.php',
            __DIR__ . '/src/Command/InternalMarkAsCancelledCommand.php',
            __DIR__ . '/src/Command/RunCommand.php',
            __DIR__ . '/src/Command/TestRandomJobsCommand.php',
            __DIR__ . '/src/Repository/DaemonRepository.php',
            __DIR__ . '/src/Entity/Job.php',
            __DIR__ . '/src/Repository/JobRepository.php',
            __DIR__ . '/src/Service/JobsManager.php',
            __DIR__ . '/src/Service/QueuesDaemon.php',
            __DIR__ . '/src/Util/JobsMarker.php',
            __DIR__ . '/src/Util/Profiler.php',
            Rector\CodeQuality\Rector\Catch_\ThrowWithPreviousExceptionRector::class,
            Rector\CodeQuality\Rector\Concat\JoinStringConcatRector::class,
            Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector::class,
            Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector::class,
            Rector\CodingStyle\Rector\ClassMethod\NewlineBeforeNewAssignSetRector::class,
            Rector\CodingStyle\Rector\ClassMethod\RemoveDoubleUnderscoreInMethodNameRector::class,
            Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector::class,
            Rector\CodingStyle\Rector\Switch_\BinarySwitchToIfElseRector::class,
            Rector\Php56\Rector\FunctionLike\AddDefaultValueForUndefinedVariableRector::class, // Maybe good one day
            Rector\PHPUnit\Rector\Class_\AddSeeTestAnnotationRector::class,
            Rector\PHPUnit\Rector\ClassMethod\AddDoesNotPerformAssertionToNonAssertingTestRector::class,
            Rector\Privatization\Rector\MethodCall\PrivatizeLocalGetterToPropertyRector::class,
            Rector\TypeDeclaration\Rector\ClassMethod\AddArrayParamDocTypeRector::class,
            Rector\TypeDeclaration\Rector\ClassMethod\AddArrayReturnDocTypeRector::class,
            \Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector::class,

            // Temporarily disabled
            Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector::class, // See src/Service/QueuesDaemon

            // Bugged
            Rector\TypeDeclaration\Rector\Property\PropertyTypeDeclarationRector::class,
            Rector\PHPUnit\Rector\MethodCall\GetMockBuilderGetMockToCreateMockRector::class,
        ]
    );
};
