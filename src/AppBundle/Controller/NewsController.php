<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {
        return $this->redirectToRoute('newsList');
    }

    /**
     * @Route("/feed/{page}", name="newsList")
     */
    public function listAction($page = 1) {
        if ($page < 1) {
            throw $this->createNotFoundException();
        }
        $newsItems = $this->getDoctrine()
                ->getRepository('AppBundle:NewsItem')
                ->findByPage($page, $newsPerPage = 5);
        $pageCount = ceil(count($newsItems) / $newsPerPage);

        return $this->render('news/list.html.twig', [
                    'newsItems' => $newsItems,
                    'currentPage' => $page,
                    'pageCount' => $pageCount,
        ]);
    }

    /**
     * @Route("/news/{urlName}", name="viewNewsItem")
     */
    public function viewItemAction($urlName) {
        $newsItem = $this->getDoctrine()
                ->getRepository('AppBundle:NewsItem')
                ->findOneByUrlName($urlName);

        return $this->render('news/view-item.html.twig', [
                    'newsItem' => $newsItem,
        ]);
    }

}
