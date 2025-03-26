<?php

namespace App\AaPageCmsBundle\Controller;

use App\AaPageCmsBundle\Entity\Page\Page;
use App\AaPageCmsBundle\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class PageController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em)
    {

    }

    public function index($slug):Response
    {
        $page = $this->em->getRepository(Page::class)->findOneBy(['slug' => $slug]);
            //findOneBy(array('slug' => $slug));
        if (is_null($page)) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $this->render('page.html.twig',
            array('page' => $page)
        );
    }
}
