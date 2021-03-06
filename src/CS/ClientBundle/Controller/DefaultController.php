<?php

/*
 * This file is part of the CSClientBundle package.
 *
 * (c) Pierre du Plessis <info@customscripts.co.za>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CS\ClientBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use CS\CoreBundle\Controller\Controller;
use CS\ClientBundle\DataGrid\Grid;
use CS\ClientBundle\Entity\Client;
use CS\ClientBundle\Form\Type\ClientType;

use APY\DataGridBundle\Grid\Source\Entity;

class DefaultController extends Controller
{
    /**
     * List all the clients
     *
     * @return Response
     */
    public function indexAction()
    {
    	$source = new Entity('CSClientBundle:Client');

    	// Get a Grid instance
    	$grid = $this->get('grid');

    	// Attach the source to the grid
    	$grid->setSource($source);

    	// Return the response of the grid to the template
    	return $grid->getGridResponse('CSClientBundle:Default:index.html.twig');

    }

    /**
     * Adds a new client
     *
     * @return Response
     */
    public function addAction()
    {
        $client = new Client;

        $form = $this->createForm(new ClientType, $client);

        $request = $this->getRequest();

        if ($request->getMethod() === 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');

                $em->persist($client);
                $em->flush();

                $this->flash($this->trans('client_saved'), 'success');

                return $this->redirect($this->generateUrl('_clients_index'));
            }
        }

        return $this->render('CSClientBundle:Default:add.html.twig', array('form' => $form->createView()));
    }

    /**
     * Edit a client
     *
     * @return Response
     */
    public function editAction(Client $client)
    {
    	$form = $this->createForm(new ClientType, $client);

        return $this->render('CSClientBundle:Default:add.html.twig', array('form' => $form->createView()));
    }

    /**
     * View a client
     *
     * @return Response
     */
    public function viewAction(Client $client)
    {
    	return $this->render('CSClientBundle:Default:view.html.twig', array('client' => $client));
    }
}
