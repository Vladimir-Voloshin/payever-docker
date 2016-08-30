<?php

namespace Payever\TestBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AlbumController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('PayeverTestBundle:Default:index.html.twig', []);
    }
    
    /**
     * @Route("/albums/", name="get_albums")
     */
    public function getAlbumsAction(Request $request)
    {
        return new Response($this->get('payever.album_manager')->getAllAlbums());
    }   
    
    /**
     * @Route("/albums/count_images/{amount}", name="get_albums_by_images_count")
     */
    public function getByImagesCountAction(Request $request, $amount)
    {
        return new Response($this->get('payever.album_manager')->getByImagesCount($amount));
    }

    /**
     * @Route("/album/{albumId}/page/{page}", name="get_album_images_paged")
     * @Route("/album/{albumId}", name="get_album_images")
     */
    public function getAlbumImagesAction(Request $request, $albumId, $page = 1)
    {
        return new Response($this->get('payever.album_manager')->getAlbumImages($albumId, $page));
    }
}
