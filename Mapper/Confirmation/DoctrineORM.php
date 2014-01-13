<?php

namespace dVAffection\SymfonyConfirmationBundle\Mapper\Confirmation;

use dVAffection\AbstractConfirmation\Model\Confirmation\ConfirmationInterface as ModelInterface;
use Doctrine\ORM\EntityManager;

class DoctrineORM extends AbstractDoctrine
{

    public function __construct(EntityManager $entityManager, ModelInterface $modelPrototype)
    {
        parent::__construct($entityManager, $modelPrototype);
    }

} 
