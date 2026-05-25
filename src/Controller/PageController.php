<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/home', name: 'app_home_page')]
    public function home(CategoryRepository $categoryRepository): Response
    {
        return $this->render('home.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/categories', name: 'app_categories')]
    public function categories(CategoryRepository $categoryRepository): Response
    {
        return $this->render('browse_categories.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/products-by-category/{id}', name: 'app_products_by_category')]
    public function productsByCategory(Category $category): Response
    {
        return $this->render('products_by_category.html.twig', [
            'category' => $category,
            'products' => $category->getProducts(),
        ]);
    }

    #[Route('/product-details/{id}', name: 'app_product_details')]
    public function productDetails(Product $product): Response
    {
        return $this->render('product_details.html.twig', [
            'product' => $product,
        ]);
    }



    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('profile.html.twig');
    }


}
