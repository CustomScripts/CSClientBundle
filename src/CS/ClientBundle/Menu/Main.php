<?php

/*
 * This file is part of the CSClientBundle package.
 *
 * (c) Pierre du Plessis <info@customscripts.co.za>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CS\ClientBundle\Menu;

use Knp\Menu\ItemInterface;

class Main
{
    /**
     * @param ItemInterface $menu
     * @param array         $options
     */
    public function sidebarMenu(ItemInterface $menu, array $parameters)
    {
        $menu->addChild('List Clients', array('route' => '_client_index'));
        $menu->addChild('Add Client', array('route' => '_client_add'));

        return $menu;
    }
}
