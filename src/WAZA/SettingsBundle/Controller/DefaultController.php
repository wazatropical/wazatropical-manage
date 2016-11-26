<?php

namespace WAZA\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WAZASettingsBundle:Default:index.html.twig');
    }
}
