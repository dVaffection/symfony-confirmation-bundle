<?php

namespace dVAffection\SymfonyConfirmationBundle\Tests\Entity;

use dVAffection\SymfonyConfirmationBundle\Tests\TestCase;
use dVAffection\SymfonyConfirmationBundle\Mapper\Confirmation\DoctrineORM as Mapper;
use dVAffection\SymfonyConfirmationBundle\Entity\Confirmation as Model;

class ConfirmationTest extends TestCase
{

    /**
     * @var Mapper
     */
    private static $mapper;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $entityManager  = self::getEm();
        $modelPrototype = new Model;

        self::$mapper = new Mapper($entityManager, $modelPrototype);
    }

    public function testMapping()
    {
        $callback = 'function';
        $params   = array('param' => 'test');

        $model = self::$mapper->create($callback, $params);
        $model = self::$mapper->find($model->getId());

        $this->assertSame($callback, $model->getCallback());
        $this->assertSame($params, $model->getParams());
        $this->assertInstanceOf('DateTime', $model->getCreatedAt());
    }

    public function testCallbackMixedTypeMapping()
    {
        $callbacks = array(
            'function',
            array('class', 'function'),
        );

        foreach ($callbacks as $callback) {
            $model = self::$mapper->create($callback);
            $model = self::$mapper->find($model->getId());

            $this->assertSame($callback, $model->getCallback());
        }
    }

} 
