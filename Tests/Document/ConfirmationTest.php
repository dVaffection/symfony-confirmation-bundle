<?php

namespace dVAffection\SymfonyConfirmationBundle\Tests\Document;

use dVAffection\SymfonyConfirmationBundle\Tests\TestCase;
use dVAffection\SymfonyConfirmationBundle\Mapper\Confirmation\DoctrineODM as Mapper;
use dVAffection\SymfonyConfirmationBundle\Document\Confirmation as Model;

class ConfirmationTest extends TestCase
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
