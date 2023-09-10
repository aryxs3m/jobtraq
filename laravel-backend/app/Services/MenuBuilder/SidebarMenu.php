<?php

namespace App\Services\MenuBuilder;

class SidebarMenu extends BaseMenu
{
    public function menuItems(): array
    {
        return [
            MenuItem::make()
                ->setLabel('Dashboard')
                ->setIcon('fas fa-gauge-simple-high')
                ->setUrl(route('dashboard')),
            MenuItem::make()
                ->setLabel('Naplók')
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Scraper naplók')
                        ->setIcon('fas fa-file-text')
                        ->setUrl(route('scraper-logs.index'))
                        ->setPermission('view scraper-logs')
                ),
            MenuItem::make()
                ->setLabel('Tartalom')
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Hírek')
                        ->setIcon('fas fa-newspaper')
                        ->setUrl(route('articles.index'))
                        ->setPermission('view articles')
                )
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Hozzászólások')
                        ->setIcon('fas fa-comment')
                        ->setUrl(route('comments.index'))
                        ->setPermission('view comments')
                )
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Képek')
                        ->setIcon('fas fa-image')
                        ->setUrl(route('images.index'))
                        ->setPermission('view images')
                ),
            MenuItem::make()
                ->setLabel('Hirdetések')
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Álláshirdetések')
                        ->setIcon('fas fa-building')
                        ->setUrl(route('job-listings.index'))
                        ->setPermission('view job-listings')
                ),
            MenuItem::make()
                ->setLabel('Scraper beállítások')
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Scraper kulcsszavak')
                        ->setIcon('fas fa-cloud')
                        ->setUrl(route('scraper-keywords.index'))
                        ->setPermission('view scraper-keywords')
                )
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Pozíciók')
                        ->setIcon('fas fa-briefcase')
                        ->setUrl(route('job-positions.index'))
                        ->setPermission('view job-positions')
                )
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Pozíció szintek')
                        ->setIcon('fas fa-level-up')
                        ->setUrl(route('job-levels.index'))
                        ->setPermission('view job-levels')
                )
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Stackek')
                        ->setIcon('fas fa-code')
                        ->setUrl(route('job-stacks.index'))
                        ->setPermission('view job-stacks')
                ),
            MenuItem::make()
                ->setLabel('Törzsadatok')
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Helyek')
                        ->setIcon('fas fa-map-location')
                        ->setUrl(route('locations.index'))
                        ->setPermission('view locations')
                )
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Országok')
                        ->setIcon('fas fa-map')
                        ->setUrl(route('countries.index'))
                        ->setPermission('view countries')
                ),
            MenuItem::make()
                ->setLabel('Rendszer')
                ->addChild(
                    MenuItem::make()
                        ->setLabel('Felhasználók')
                        ->setIcon('fas fa-user')
                        ->setUrl(route('users.index'))
                        ->setPermission('view users')
                ),
        ];
    }
}
