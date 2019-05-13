<?php

namespace App\Controller;

use App\Entity\Order;
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

    /**
     * @Route("/cart", name="order_cart")
     */
    public function cart(OrderService $orderService)
    {
        return $this->render('order/cart.html.twig', [
            'order' => $orderService->getOrderFromCart(),
        ]);
    }

    public function headerCart(OrderService $orderService)
    {
        return $this->render('order/headerCart.html.twig', [
            'order' => $orderService->getOrderFromCart(),
        ]);
    }
}
