<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="adminNewsList")
     */
    public function newsListAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:NewsItem');
        $newsItems = $repository->findAll();
        return $this->render('admin/news-list.html.twig', [
            'newsItems' => $newsItems,
        ]);
    }
    
    /**
     * @Route("/admin/view/{urlName}", name="adminViewNewsItem")
     */
    public function viewNewsItemAction($urlName)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:NewsItem');
        $newsItem = $repository->findOneByUrlName($urlName);
        return $this->render('admin/view-news-item.html.twig', [
            'newsItem' => $newsItem,
        ]);
    }
    
    /**
     * @Route("/admin/delete/{urlName}", name="adminDeleteNewsItem")
     * @Method({"DELETE", "POST"})
     */
    public function deleteNewsItemAction(Request $request, $urlName)
    {
        $em = $this->getDoctrine()->getManager();
        $newsItem = $em->getRepository('AppBundle:NewsItem')->findOneByUrlName($urlName);
        $em->remove($newsItem);
        $em->flush();

        if ($request->isXmlHttpRequest()) {
          return new Response('OK');
        }

        return $this->redirectToRoute('adminNewsList');
    }
}
