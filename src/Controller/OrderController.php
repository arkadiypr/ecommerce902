<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
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

        if ($request->isXmlHttpRequest()) {
            return $this->headerCart($orderService);
        }

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

    /**
     * @Route("/cart/update-count/{id}", name="order_update_count")
     */
    public function updateCount(OrderItem $orderItem, OrderService $orderService, Request $request)
    {
        $order = $orderService->getOrderFromCart();

        if ($orderItem->getOrder() !== $order) {
            return $this->createAccessDeniedException('Invalid order item');
        }

        $count = $request->request->getInt('count');

        $orderService->setCount($orderItem, $count);

        return $this->render('order/cartTable.html.twig', [
            'order' => $order,
        ]);

    }

    /**
     * @Route("/cart/delete-item/{id}", name="order_delete_item"))
     */
    public function deleteItem(OrderItem $orderItem, OrderService $orderService, Request $request)
    {
        $order = $orderService->getOrderFromCart();

        if ($orderItem->getOrder() !== $order) {
            return $this->createAccessDeniedException('Invalid order item');
        }

        $orderService->deleteItem($orderItem);

        if ($request->isXmlHttpRequest()) {
            return $this->render('order/cartTable.html.twig', [
                'order' => $order
            ]);
        }

        return $this->redirectToRoute('order_cart');
    }
}
