<?php

namespace Payever\TestBundle\Tests\Services;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Payever\TestBundle\Services\AlbumManagerService;
use Payever\TestBundle\Entity\Album;
use Payever\TestBundle\Entity\Image;
use Payever\TestBundle\Repository\AlbumRepository;
use Payever\TestBundle\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\AbstractQuery;
use Knp\Component\Pager\Paginator;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;

class AlbumManagerTest extends WebTestCase
{
    public static $container;
    public static $paginator;
    public static $serializer;
    
    public static function setUpBeforeClass()
    {
        //start the symfony kernel
        $kernel = static::createKernel();
        $kernel->boot();

        //get the DI container
        self::$container = $kernel->getContainer();

        //now we can instantiate our service (if you want a fresh one for
        //each test method, do this in setUp() instead
        self::$paginator = self::$container->get('knp_paginator');
        self::$serializer = self::$container->get('serializer');
    }
    
    public function testGetAllAlbums()
    {
        for($i = 1; 5 >= $i; $i++){
            // First, mock the object to be used in the test
            $album = $this->createMock(Album::class);
            $albums[] = $album;
        }

        // Now, mock the repository so it returns the mock of the album
        $albumRepository = $this
            ->getMockBuilder(AlbumRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $albumRepository->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue($albums));

        // Last, mock the EntityManager to return the mock of the repository
        $entityManager = $this
            ->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($albumRepository));

        $albumFatsManager = new AlbumManagerService($entityManager, self::$paginator, self::$serializer);

        $result = json_decode( $albumFatsManager->getAllAlbums(), true);
        $this->assertArrayHasKey('items', $result);
    }

    public function testGetAlbumImages($albumId = 1, $page = 1)
    {
        for($i = 1; 25 >= $i; $i++){
            // First, mock the object to be used in the test
            $image = $this->createMock(Image::class);
            $images[] = $image;
        }

        $paginatorEvent = $this
            ->getMockBuilder(SlidingPagination::class)
            ->setMethods(array('getPageCount', 'getItems'))
            ->disableOriginalConstructor()
            ->getMock();
        $paginatorEvent->expects($this->once())
            ->method('getPageCount')
            ->will($this->returnValue(count($images)/Album::MAX_IMAGES_PER_PAGE));
        $paginatorEvent->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue(array_slice($images, ($page-1)*Album::MAX_IMAGES_PER_PAGE, ($page-1)*Album::MAX_IMAGES_PER_PAGE+Album::MAX_IMAGES_PER_PAGE )));
        
        $paginator = $this
            ->getMockBuilder(Paginator::class)
            ->setMethods(array('paginate'))
            ->disableOriginalConstructor()
            ->getMock();
        $paginator->expects($this->once())
            ->method('paginate')
            ->will($this->returnValue($paginatorEvent));

        // Use the Abstract query, which has nearly all needed Methods as the Query.
        $query = $this
            ->getMockBuilder(AbstractQuery::class)
            ->setMethods(array('setParameter', 'getResult'))
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $imageRepository = $this
            ->getMockBuilder(ImageRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $imageRepository->expects($this->once())
            ->method('getAlbumImagesQuery')
            ->will($this->returnValue($query));
        
        $entityManager = $this
            ->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($imageRepository));

        $albumFatsManager = new AlbumManagerService($entityManager, $paginator, self::$serializer);
        $result = json_decode( $albumFatsManager->getAlbumImages($albumId, $page), true);
        
        $this->assertArrayHasKey('items', $result);
        $this->assertArrayHasKey('paging', $result);
    }
    
    
}
