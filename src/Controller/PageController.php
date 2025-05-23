<?php

namespace Aality\SyliusCMSBundle\Controller;

use Aality\SyliusCMSBundle\Entity\Page\Page;
use Aality\SyliusCMSBundle\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class PageController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em, private ChannelContextInterface $channelContext)
    {

    }

    public function index($slug):Response
    {

        $channel = $this->channelContext->getChannel();
        $page = $this->em->getRepository(Page::class)->findOneBy(['slug' => $slug]);

        if (is_null($page)) {
            throw new NotFoundHttpException('Page not found.');
        }

        if ($page->getChannel() && $page->getChannel() !== $channel) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $this->render('@SyliusCMSBundle/page.html.twig',
            array('page' => $page)
        );
    }
}
