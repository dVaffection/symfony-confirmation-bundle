<?php

namespace dVAffection\SymfonyConfirmationBundle\Tests;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\EntityManager;

class TestCase extends \PHPUnit_Framework_TestCase
{

    public static function setUpBeforeClass()
    {
        $sm = self::getDm()->getSchemaManager();
        $sm->dropCollections();
        $sm->createCollections();
        $sm->ensureIndexes();


        $tool    = new \Doctrine\ORM\Tools\SchemaTool(self::getEm());
        $classes = array(
            self::getEm()->getClassMetadata('dVAffection\SymfonyConfirmationBundle\Entity\Confirmation'),
        );
        try {
            $tool->createSchema($classes);
        } catch (\Doctrine\ORM\Tools\ToolsException $e) {
            echo $e->getMessage(), PHP_EOL;
        }
    }


    public static function tearDownAfterClass()
    {
        $sm = self::getDm()->getSchemaManager();
        $sm->dropCollections();


        $tool = new \Doctrine\ORM\Tools\SchemaTool(self::getEm());
        $tool->dropDatabase();
    }


    /**
     * @var DocumentManager
     */
    private static $dm;

    /**
     * @var EntityManager
     */
    private static $em;

    /**
     * @param \Doctrine\ODM\MongoDB\DocumentManager $dm
     */
    public static function setDm(DocumentManager $dm)
    {
        self::$dm = $dm;
    }

    /**
     * @return \Doctrine\ODM\MongoDB\DocumentManager
     */
    public static function getDm()
    {
        return self::$dm;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $em
     */
    public static function setEm(EntityManager $em)
    {
        self::$em = $em;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public static function getEm()
    {
        return self::$em;
    }

} 
