<?php

namespace Payever\TestBundle\Entity;

use Payever\TestBundle\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Image
 */
class Image extends BaseEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $imageName;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var \Payever\TestBundle\Entity\Album
     */
    private $album;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Image
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Get album
     *
     * @return \Payever\TestBundle\Entity\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set album
     *
     * @param \Payever\TestBundle\Entity\Album $album
     * @return Image
     */
    public function setAlbum(\Payever\TestBundle\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Image
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Image
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    public function toJson(){
        return array(
            'id' => $this->id,
            'fileName' => $this->imageName,
        );
    }
}

