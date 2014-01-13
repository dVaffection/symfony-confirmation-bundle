<?php

if (!file_exists($file = __DIR__ . '/../vendor/autoload.php')) {
    throw new RuntimeException('Install dependencies to run test suite.');
}

require $file;


// -------------- Doctrine ODM -------------------

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

$connection = new Connection();

$config = new Configuration();
$config->setProxyDir(__DIR__ . '/../cache/Proxies');
$config->setProxyNamespace('Proxies');
$config->setHydratorDir(__DIR__ . '/../cache/Hydrators');
$config->setHydratorNamespace('Hydrators');
$config->setDefaultDB('symfony_confirmation_bundle');
$config->setMetadataDriverImpl(AnnotationDriver::create(__DIR__ . '/../Document'));

AnnotationDriver::registerAnnotationClasses();

$dm = DocumentManager::create($connection, $config);
dVAffection\SymfonyConfirmationBundle\Tests\TestCase::setDm($dm);
unset($dm);


// -------------- Doctrine ORM -------------------


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths     = array(__DIR__ . '/../Entity');
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'symfony_confirmation_bundle',
);

$config        = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);
dVAffection\SymfonyConfirmationBundle\Tests\TestCase::setEm($entityManager);
unset($entityManager);
