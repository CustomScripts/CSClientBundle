<?php

/*
 * This file is part of the CSClientBundle package.
 *
 * (c) Pierre du Plessis <info@customscripts.co.za>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CS\ClientBundle\DataGrid;

use CS\DataGridBundle\Grid\Base;
use CS\DataGridBundle\Grid\Column\ColumnCollection;
use CS\DataGridBundle\Grid\Column\Column;
use CS\DataGridBundle\Grid\Action\ActionCollection;
use CS\DataGridBundle\Grid\Action\Action;

class Grid extends Base
{
    /**
     * returns the entity name for the cliets
     *
     * @see CS\DataGridBundle\Grid.BaseGrid::getSource()
     * @return string
     */
    public function getSource()
    {
        return 'CSClientBundle:Client';
    }

    /**
     * @return string The name of the current grid
     */
    public function getName()
    {
        return 'clients';
    }

    /**
     * Manupulate the columns for the clients grid
     *
     * @param  ColumnCollection $collection
     * @return void
     */
    public function getColumns(ColumnCollection $collection)
    {
        $collection->remove(array('deleted', 'updated'));

        $collection['id']->setLabel('#');

        $container = $this->getContainer();

        $collection->add('view', function($client) use ($container) {
        	$router = $container->get('router');

			return '<a href="'.$router->generate('_clients_view', array('id' => $client->getId())).'" class="btn"><i class="icon-eye-open"></i> View</a>';
        });
    }

    /**
     * Adds the default CRUD actions for clients
     *
     * @param  ActionCollection $actions
     * @return void
     */
    public function getActions(ActionCollection $actions)
    {
        $add = new Action('add_client');

        $add->setAction('_clients_add')
            ->attributes(array('class' => 'btn btn-primary'));

        /*$edit = new Action('Edit Client');

        $edit->setAction('_client_edit')
            ->requireRow()
            ->confirm('Are you sure you want to edit the selected Client(s)?')
            ->onClick('do something cool')
            ->attributes(array('class' => 'btn btn-info'))
            ->icon('filter icon-white')
            ->showWhenEmpty(false);*/

        $actions->add($add);
        //$actions->add($edit);
    }

    /**
     * Get attributes for datagrid
     *
     * @return array
     */
    public function getAttributes()
    {
    	return array(
    					'table' => array(
    										'class' => 'table table-bordered table-striped table-hover'
    									)
    			);
    }
}
