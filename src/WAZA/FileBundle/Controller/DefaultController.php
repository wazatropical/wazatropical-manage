<?php

namespace WAZA\FileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WAZAFileBundle:Default:index.html.twig');
    }
}
