<?php

namespace Payever\TestBundle\Services;

use Payever\TestBundle\Entity\Album;

class AlbumManagerService
{
    const MAX_IMAGES_PER_ALBUM = 10;
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    
    /**
     * @var \Knp\Component\Pager\Paginator
     */
    protected $paginator;  
    
    /**
     * @var \Symfony\Component\Serializer\Serializer
     */
    protected $serializer;

    public function __construct($em, $paginator, $serializer)
    {
        $this->em = $em;
        $this->paginator = $paginator;
        $this->serializer = $serializer;
    }

    /**
     *
     * @Return {JSON}
     *
     */
    public function getAllAlbums(){
        /** @var \Payever\TestBundle\Repository\AlbumRepository $albumRepository */
        $albumRepository = $this->em->getRepository('PayeverTestBundle:Album');
        foreach ($albumRepository->findAll() as $album){
            $result['items'][] = $album->toJson();
        }
        
        return $this->serializer->serialize($result, 'json');
    }

    /**
     * @Param  {Integer} $albumId album's id.
     * @Param  {Integer} $page album's images page.
     * 
     * @Return {JSON} 
     * 
     */
    public function getAlbumImages($albumId, $page = 1)
    {
        $result = [];
        
        /** @var \Payever\TestBundle\Repository\ImageRepository $imageRepository */
        $imageRepository = $this->em->getRepository('PayeverTestBundle:Image');
        $query = $imageRepository->getAlbumImagesQuery($albumId);

        /** @var \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination $pagination */
        $pagination = $this->paginator->paginate(
            $query,
            $page,
            Album::MAX_IMAGES_PER_PAGE
        );
        foreach ($pagination->getItems() as $item) {
            $result['items'][] = $item->toJson();
        }
        $result['paging']['albumId']     = $albumId;
        $result['paging']['pagesTotal']  = $pagination->getPageCount();
        $result['paging']['currentPage'] = $page;
        
        return $this->serializer->serialize( $result, 'json' );
    }

    /**
     * @Param  {Integer} $amount Max amount of images in album
     *
     * @Return {JSON}
     *
     */
    public function getByImagesCount($amount)
    {
        /** @var \Payever\TestBundle\Repository\AlbumRepository $albumRepository */
        $albumRepository = $this->em->getRepository('PayeverTestBundle:Album');
        $result = $albumRepository->getByImagesAmount($amount);
        foreach ($result as $item) {
            $items[] = $item["album"]->toJson();
        }
        
        return $this->serializer->serialize(array(
            'items' => $items
        ), 'json');
    }
}
