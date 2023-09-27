<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
  /**
   * @Route("/product", name="index-product")
   */
  public function index(EntityManagerInterface $em, CategoryRepository $categoryRepository)
  {
    $categoryId = 1;
    $category = $categoryRepository->find($categoryId); // categoria "computing"
    $product = new Product();
    $product->setName("Notebook");
    $product->setValue(3000);
    $product->setCategory($category);
    $product->setNo("N/A");

    $msg = "";

  try {
      $em->persist($product); // salvar persist em memória
      $em->flush(); // executa no banco de dados
      $msg = "Produto cadastrado com sucesso!";
  } catch(\Doctrine\DBAL\Exception $e) {
      // Captura exceções relacionadas ao banco de dados
      $msg = "Erro no banco de dados: " . $e->getMessage();
  } catch(\Exception $e) {
      // Captura exceções gerais
      $msg = "Erro ao cadastrar produto: " . $e->getMessage();
  }

    return new Response("<h1>" .$msg . "<h1>");
  }

  /**
   * @Route("/product/add", name="add-product")
   */

   public function add()
   {
    $form = $this->createForm(ProductType::class);
    $data['titulo'] = 'Adicionar novo produto';
    $data['form'] = $form;

    return $this->renderForm('product/form.html.twig', $data);
   }

} 
