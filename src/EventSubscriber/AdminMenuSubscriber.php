<?php

declare(strict_types=1);

namespace Aality\SyliusCMSBundle\EventSubscriber;

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
        $configurationMenu = $menu->getChild('configuration');
        $supportMenu = $menu->getChild('official_support');

        $menu->removeChild('configuration');
        $menu->removeChild('official_support');

        $menu
            ->addChild('cmsPage')
            ->setLabel('Page CMS')
            ->setLabelAttribute('icon', 'tabler:file-description')
        ;

        $menu->addChild($configurationMenu);
        $menu->addChild($supportMenu);

        $menuPage = $menu->getChild('cmsPage');

        $menuPage->addChild('cmsPageIndex', ['route' => 'app_admin_page_index'])
        ->setLabel('Pages');

        $menuPage->addChild('cmsPageCreate', ['route' => 'app_admin_page_create'])
        ->setLabel('New Page');

    }
}
