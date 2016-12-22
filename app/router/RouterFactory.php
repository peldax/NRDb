<?php

namespace App;

use Nette,
    Nette\Application\Routers\RouteList,
    Nette\Application\Routers\Route;

/**
 * Router factory.
 */
class RouterFactory
{

    /**
     * @return \Nette\Application\IRouter
     */
    public static function createRouter()
    {
        $router = new RouteList();

        $router[] = $adminRouter = new RouteList('Admin');
        $adminRouter[] = new Route('admin/<presenter>/<action>[/<id>]', 'Default:default');

        $router[] = $frontRouter = new RouteList();
        $frontRouter[] = new Route('sitemap.xml', 'Default:sitemap');
        $frontRouter[] = new Route('settings', 'Default:settings');
        $frontRouter[] = new Route('credits', 'Default:credits');
        $frontRouter[] = new Route('logout', 'Default:logout');
        $frontRouter[] = new Route('login', 'Default:login');

        $frontRouter[] = new Route('<presenter>/<action>[/<id>]', 'Default:default');

        return $router;
    }

}
