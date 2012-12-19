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
     * @Route("/", name="_client_index")
     * @Template()
     */
    public function indexAction()
    {
        $grid = $this->get('grid')->create(new Grid);

        return array('grid' => $grid);
    }

    /**
     * @Route("/add", name="_client_add")
     * @Template()
     */
    public function addAction()
    {
        $client = new Client;

        $form = $this->createForm(new ClientType, $client);

        $request = $this->getRequest();

        if ($request->getMethod() === 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getEm();

                $em->persist($client);
                $em->flush();

                $this->redirectFlash('_client_index', "Client Successfully Saved!", "success");
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/edit", name="_client_edit")
     * @Template()
     */
    public function editAction()
    {
        return array();
    }
}
