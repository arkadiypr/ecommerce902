<?php

namespace App\Service;


use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderService
{
    const CART_SESSION_KEY = 'cart';

    private $session;

    private $orderRepository;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session, OrderRepository $orderRepository)
    {
        $this->session = $session;
        $this->orderRepository = $orderRepository;
        $this->entityManager = $entityManager;
    }


    public function getOrderFromCart()
    {
        $order = null;
        $orderID = $this->session->get(self::CART_SESSION_KEY);

        if ($orderID) {
            $order = $this->orderRepository->find($orderID);
        }

        if (!$order) {
            $order = new Order();
        }

        return $order;
    }

    public function addToCart(Product $product, $count = 1)
    {
        $order = $this->getOrderFromCart();
        $orderItem = null;

        foreach ($order->getOrderItems() as $item) {
            if ($item->getProduct() === $product) {
                $orderItem = $item;
            }
        }

        if (!$orderItem) {
            $orderItem = new OrderItem();
            $orderItem->setProduct($product);
            $order->addOrderItem($orderItem);
        }

        $orderItem->setCount($orderItem->getCount() + $count);
        $this->entityManager->persist($order);
        $this->entityManager->flush();
        $this->session->set(self::CART_SESSION_KEY, $order->getId());

        return $order;
    }

}