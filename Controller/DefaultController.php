<?php

namespace Cordoval\BernardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CordovalBernardBundle:Default:index.html.twig', array('name' => $name));
    }
}
