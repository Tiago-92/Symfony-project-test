<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
  /**
   * @Route("/category", name="index-category")
   */
  public function index(CategoryRepository $categoryRepository)
  {
    // listar as categorias do DB
    $data['categorys'] = $categoryRepository->findAll();
    $data['titulo'] = 'Gerenciar Categorias';

    return $this->render("category/index.html.twig", $data);
  }

  /**
   * @Route("/category/add", name="add-category")
   */

   public function add(Request $request, EntityManagerInterface $em)
   {
    $msg = "";
    $category = new Category;
    $form = $this->createForm(CategoryType::class, $category);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
      // salvar no DB
      $em->persist($category);
      $em->flush();
      $msg = "Categoria adicionada com sucesso!";
    }

    $data['titulo'] = 'Adicionar nova categoria';
    $data['form'] = $form;
    $data['msg'] = $msg;

    return $this->renderForm('category/form.html.twig', $data);
   }

   /**
   * @Route("/category/update/{id}", name="update-category")
   */

   public function update($id, Request $request, EntityManagerInterface $em, CategoryRepository $categoryRepository)
   {
    $msg = '';
    $category = $categoryRepository->find($id); // retorna categoria pelo id
    $form = $this->createForm(CategoryType::class, $category);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $em->flush();
      $msg = 'Categoria atualizada com sucesso';
    }

    $data['titulo'] = 'Editar categoria';
    $data['form'] = $form;
    $data['msg'] = $msg;

    return $this->renderForm('category/form.html.twig', $data);
   }

   /**
   * @Route("/category/delete/{id}", name="delete-category")
   */

   public function delete($id, EntityManagerInterface $em, CategoryRepository $categoryRepository)
   {
    $category = $categoryRepository->find($id);
    
    $em->remove($category);
    $em->flush();

    // redireciona para index-category
    return $this->redirectToRoute('index-category');
   }
}