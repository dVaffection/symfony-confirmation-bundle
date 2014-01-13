<?php

namespace dVAffection\SymfonyConfirmationBundle\Entity;

use dVAffection\AbstractConfirmation\Model\Confirmation\AbstractConfirmation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="confirmations")
 */
class Confirmation extends AbstractConfirmation
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="array")
     */
    protected $callback;

    /**
     * @ORM\Column(type="array")
     */
    protected $params;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $now = new \DateTime;

        $this->setCreatedAt($now);
    }

} 
