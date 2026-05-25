<?php

namespace App\Controller;

use App\Cart\CartHandler;
use App\Dto\CartItem;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart/add/{id}', name: 'app_cart_add', methods: ['POST'])]
    public function add(
        int $id,
        Request $request,
        ProductRepository $productRepository,
        CartHandler $cartHandler
    ): Response {
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        $quantity = (int) $request->request->get('quantity', 1);

        if ($quantity < 1) {
            $quantity = 1;
        }

        $cartItem = new CartItem(
            productId: $product->getId(),
            name: $product->getName(),
            price: $product->getPrice(),
            quantity: $quantity,
            image: $product->getImage()
        );

        $cartHandler->addToCart($cartItem);

        return $this->redirectToRoute('app_cart_show');
    }

    #[Route('/cart', name: 'app_cart_show', methods: ['GET'])]
    public function show(CartHandler $cartHandler): Response
    {
        return $this->render('cart.html.twig', [
            'items' => $cartHandler->getCartItems(),
            'total' => $cartHandler->getTotal(),
        ]);
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove', methods: ['POST'])]
    public function remove(int $id, CartHandler $cartHandler): Response
    {
        $cartHandler->removeFromCart($id);

        return $this->redirectToRoute('app_cart_show');
    }

    #[Route('/cart/clear', name: 'app_cart_clear', methods: ['POST'])]
    public function clear(CartHandler $cartHandler): Response
    {
        $cartHandler->clearCart();

        return $this->redirectToRoute('app_cart_show');
    }
}
