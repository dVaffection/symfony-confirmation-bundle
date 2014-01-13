<?php

namespace dVAffection\SymfonyConfirmationBundle\Mapper\Confirmation;

use dVAffection\AbstractConfirmation\Model\Confirmation\ConfirmationInterface as ModelInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

class DoctrineODM extends AbstractDoctrine
{

    public function __construct(DocumentManager $documentManager, ModelInterface $modelPrototype)
    {
        parent::__construct($documentManager, $modelPrototype);
    }

} 
