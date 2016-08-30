<?php

namespace Payever\TestBundle\Entity;

use Payever\TestBundle\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Album
 */
class Album extends BaseEntity
{
    const MAX_IMAGES_PER_PAGE = 10;
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $albumName;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;
    
    /**
     * @var Image[]|\Doctrine\Common\Collections\ArrayCollection
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }
    
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
     * Set albumName
     *
     * @param string $albumName
     *
     * @return Album
     */
    public function setAlbumName($albumName)
    {
        $this->albumName = $albumName;

        return $this;
    }

    /**
     * Get albumName
     *
     * @return string
     */
    public function getAlbumName()
    {
        return $this->albumName;
    }


    /**
     * @return ArrayCollection|Image[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param ArrayCollection|Image[] $images
     * @return Album
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Add image
     *
     * @param \Payever\TestBundle\Entity\Image $image
     * @return Album
     */
    public function addImage(\Payever\TestBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Payever\TestBundle\Entity\Image $image
     */
    public function removeImage(\Payever\TestBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }
    
    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Album
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
     * @return Album
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
            'albumName' => $this->albumName,
        );
    }
}

