<?php

namespace Payever\TestBundle\Services;

class ImageManagerService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }
}
