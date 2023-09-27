<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends AbstractController
{
  public function index()
  {
    return $this->render('test/index.html.twig');

  }

  public function helloname($name)
  {
    return new Response('<h1>Hello ' . $name .'<h1>');
  }
}

  

  

