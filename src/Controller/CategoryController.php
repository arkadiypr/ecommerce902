<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function show($id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        if (!$category) {
            return $this->createNotFoundException('Category #'.$id.' not found.');
        }

        return $this->render('category/show.html.twig',[
            'category' => $category
        ]);
    }
}
