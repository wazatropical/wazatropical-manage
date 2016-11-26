<?php

namespace WAZAGestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WAZAGestionBundle:Default:index.html.twig');
    }
}
