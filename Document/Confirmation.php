<?php

namespace dVAffection\SymfonyConfirmationBundle\Document;

use dVAffection\AbstractConfirmation\Model\Confirmation\AbstractConfirmation;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="confirmations", requireIndexes=true)
 * @ODM\HasLifecycleCallbacks
 */
class Confirmation extends AbstractConfirmation
{

    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @ODM\Hash
     */
    protected $callback;

    /**
     * @ODM\Hash
     */
    protected $params;

    /**
     * @ODM\Date
     */
    protected $createdAt;

    /**
     * @ODM\PrePersist
     */
    public function prePersist()
    {
        $now = new \DateTime;

        $this->setCreatedAt($now);
    }

} 
