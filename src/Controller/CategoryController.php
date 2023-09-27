<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
  /**
   * @Route("/category", name="index-category")
   */
  public function index(EntityManagerInterface $em)
  {
    // $em é um objeto que vai auxiliar a execução de acões do DB (criar, editar, ecluir)
    $category = new Category();
    $category->setDescription("computing"); // para criar uma nova categoria nova categoria
    $msg = "";



    return new Response("<h1>" .$msg . "<h1>");
  }

  /**
   * @Route("/category/add", name="add-category")
   */

   public function add()
   {
    $form = $this->createForm(CategoryType::class);
    $data['titulo'] = 'Adicionar nova categoria';
    $data['form'] = $form;

    return $this->renderForm('category/form.html.twig', $data);
   }
}