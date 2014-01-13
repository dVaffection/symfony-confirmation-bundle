<?php

namespace dVAffection\SymfonyConfirmationBundle\Mapper\Confirmation;

use dVAffection\AbstractConfirmation\Mapper\Confirmation\ConfirmationInterface as MapperInterface;
use dVAffection\AbstractConfirmation\Model\Confirmation\ConfirmationInterface as ModelInterface;
use Doctrine\Common\Persistence\ObjectManager;

abstract class AbstractDoctrine implements MapperInterface
{

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ModelInterface
     */
    protected $modelPrototype;


    public function __construct(ObjectManager $objectManager, ModelInterface $modelPrototype)
    {
        $this->objectManager  = $objectManager;
        $this->modelPrototype = $modelPrototype;
    }

    /**
     * {@inheritDoc}
     */
    public function create($callback, array $params = array())
    {
        $model = clone $this->modelPrototype;
        $model->setCallback($callback);
        $model->setParams($params);

        $this->objectManager->persist($model);
        $this->objectManager->flush();

        return $model;
    }

    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        $className = get_class($this->modelPrototype);

        $model = $this->objectManager->find($className, $id);
        if (!$model instanceof $className) {
            $model = false;
        }

        return $model;
    }

    /**
     * {@inheritDoc}
     */
    public function delete($idOrModel)
    {
        if ($idOrModel instanceof ModelInterface) {
            $model = $idOrModel;
        } else {
            $model = $this->find($idOrModel);
        }

        if ($model instanceof ModelInterface) {
            $this->objectManager->remove($model);
            $this->objectManager->flush();
        }
    }

} 
