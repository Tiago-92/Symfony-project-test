<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
  /**
   * @Route("/product", name="index-product")
   */
  public function index(Request $request, ProductRepository $productRepository)
  {
    $productName = $request->query->get('product');
    // busca dos produtos cadastrados
    $data['products'] = is_null($productName) 
                          ? $productRepository->findAll()
                          : $productRepository->findProductByLikeName($productName);
    $data['productName'] = $productName;
    $data['titulo'] = "Gerenciar Produtos";

    return $this->render('product/index.html.twig', $data);
  }

  /**
   * @Route("/product/add", name="add-product")
   */

   public function add(Request $request, EntityManagerInterface $em)
   {
    $msg = '';
    $product = new Product();
    $form = $this->createForm(ProductType::class, $product);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em->persist($product);
      $em->flush();
      $msg = "Produto cadastrado com sucesso";
    }

    $data['titulo'] = 'Adicionar novo produto';
    $data['form'] = $form;
    $data['msg'] = $msg;

    return $this->renderForm('product/form.html.twig', $data);
   }

    /**
   * @Route("/product/update/{id}", name="update-product")
   */

   public function update($id, Request $request, EntityManagerInterface $em, ProductRepository $productRepository)
   {
    $msg = '';
    $product = $productRepository->find($id);
    $form = $this->createForm(ProductType::class, $product);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
      $em->flush();
      $msg = 'Produto atualizado com sucesso';    
    }

    $data['titulo'] = 'Editar produto';
    $data['form'] = $form;
    $data['msg'] = $msg;

    return $this->renderForm('product/form.html.twig', $data);
   }

    /**
   * @Route("/product/delete/{id}", name="delete-product")
   */

   public function delete($id, EntityManagerInterface $em, ProductRepository $productRepository)
   {
    $product = $productRepository->find($id);

    $em->remove($product);
    $em->flush();

    return $this->redirectToRoute('index-product');
   }
} 
