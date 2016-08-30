<?php

namespace Payever\TestBundle\Entity;

/**
 * BaseEntity
 */
class BaseEntity
{
    public function setCreatedValue()
    {
        $this->setCreated(new \DateTime());
    }

    public function setUpdatedValue()
    {
        $this->setUpdated(new \DateTime());
    }
}

