<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Tools\Pagination\Paginator;

class NewsController extends Controller
{
    /**
     * @Route("/feed/{page}", name="newsList")
     */
    public function listAction($page = 1)
    {
        if ($page < 1) {
            throw new NotFoundHttpException();
        }
        $repository = $this->getDoctrine()->getRepository('AppBundle:NewsItem');
        $limit = 5;
        $query = $repository->createQueryBuilder('p')
                ->getQuery()
                ->setFirstResult($limit * ($page - 1))
                ->setMaxResults($limit);
        
        $newsItems = new Paginator($query, $fetchJoinCollection = false);
        $pageCount = ceil(count($newsItems) / $limit);
        return $this->render('news/list.html.twig', [
            'newsItems' => $newsItems,
            'pageCount' => $pageCount,
        ]);
    }
    
    /**
     * @Route("/news/{urlName}", name="viewNewsItem")
     */
    public function viewItemAction($urlName)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:NewsItem');
        $newsItem = $repository->findOneByUrlName($urlName);
        return $this->render('news/view-item.html.twig', [
            'newsItem' => $newsItem,
        ]);
    }
}
