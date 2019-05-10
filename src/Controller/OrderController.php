<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order/add-to-cart/{id}", name="order_add_to_cart")
     */
    public function addToCart(Product $product, OrderService $orderService, Request $request)
    {
        $orderService->addToCart($product);
        $referer = $request->headers->get('Referer');

        return $this->redirect($referer);
    }
}
