<?php

namespace dVAffection\SymfonyConfirmationBundle\Tests\Mapper\Confirmation;

use dVAffection\SymfonyConfirmationBundle\Tests\TestCase;
use dVAffection\SymfonyConfirmationBundle\Mapper\Confirmation\DoctrineODM as Mapper;
use dVAffection\SymfonyConfirmationBundle\Document\Confirmation as Model;

class DoctrineODMTest extends TestCase
{

    /**
     * @var Mapper
     */
    private static $mapper;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $documentManager = self::getDm();
        $modelPrototype  = new Model;

        self::$mapper = new Mapper($documentManager, $modelPrototype);
    }

    public function testCRUD()
    {
        $expected = self::$mapper->create('does not matter');
        $this->assertInstanceOf('dVAffection\SymfonyConfirmationBundle\Document\Confirmation', new Model);

        $actual = self::$mapper->find($expected->getId());
        $this->assertSame($expected, $actual);

        self::$mapper->delete($actual);
        $actual = self::$mapper->find($expected->getId());
        $this->assertSame(false, $actual);
    }

} 
