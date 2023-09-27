<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
  /**
  * @Route("test", name="test")
  */

  public function index()
  {
    $data['title'] = 'Page Test';
    $data['pharse'] = 'Aprendendo Templates';
    $data['fruits'] = [
      [ 
        'name' => 'banana',
        'price' => '1.99'
      ],
      [
        'name' => 'orange',
        'price' => '2.99'
      ],
      [
        'name' => 'apple',
        'price' => '4.99'
      ]
    ];

    return $this->render('test/index.html.twig', $data);
  }

  /**
   * @Route("test/detail/{id}")
   */

  public function Detail($id)
  {
    return new Response('<h1> UserId=' . $id .'<h1>');
  }

}