<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    /**
     * @Route("/news/", name="newsList")
     */
    public function listAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:NewsItem');
        $newsItems = $repository->findAll();
        return $this->render('news/list.html.twig', [
            'newsItems' => $newsItems,
        ]);
    }
    
    /**
     * @Route("/news/{urlName}", name="viewNewsItem")
     */
    public function viewItemAction(Request $request, $urlName)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:NewsItem');
        $newsItem = $repository->findOneByUrlName($urlName);
        return $this->render('news/view-item.html.twig', [
            'newsItem' => $newsItem,
        ]);
    }
}
