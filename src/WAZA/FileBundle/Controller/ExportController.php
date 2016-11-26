<?php

namespace WAZA\FileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ExportController extends Controller
{
    public function exportAction()
    {
        return new Response("200");
    }
}