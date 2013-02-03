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

class DefaultController extends Controller
{
    /**
     * List all the clients
     *
     * @return Response
     */
    public function indexAction()
    {
        $grid = $this->get('cs_data_grid.grid')->create(new Grid);

        return $this->render('CSClientBundle:Default:index.html.twig', array('grid' => $grid));
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

                $this->flash($this->trans('client_saved'));

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
        return $this->render('CSClientBundle:Default:edit.html.twig', array());
    }
}
