<?php

declare(strict_types=1);

namespace App\AaPageCmsBundle\EventSubscriber;

use App\Entity\User\AdminUser;
use Knp\Menu\MenuItem;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class AdminMenuSubscriber implements EventSubscriberInterface
{
    public function __construct(private Security $security)
    {

    }

    public static function getSubscribedEvents(): array
    {
        return [
            'sylius.menu.admin.main' => 'modifyAdminMenu',
        ];
    }

    public function modifyAdminMenu(MenuBuilderEvent $event): void
    {
        /** @var MenuItem $menu */
        $menu        = $event->getMenu();

        $menu
            ->addChild('jsd', ['route' => 'app_page'])
            ->setLabel('Page CMS')
            ->setLabelAttribute('icon', 'tabler:adjustments')
        ;
    }
}
