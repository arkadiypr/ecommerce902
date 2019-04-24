<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();

        return $this->render('default/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/{id}", name="product")
     */
    public function product($id, ProductRepository $productRepository)
    {
        $product = $productRepository->find($id);

        if (!$product) {
            return $this->createNotFoundException('Product #'.$id.' not found.');
        }

        return $this->render('default/product.html.twig', [
            'product' => $product,
        ]);
    }
}
