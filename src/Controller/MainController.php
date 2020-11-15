<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/categories", name="show_categories")
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function categoryList(CategoryRepository $categoryRepository) {
        $categories = $categoryRepository->findAll();
        return $this->render('main/categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/categories/{id}", name="show_category")
     * @param $id
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function categoryDetail($id, CategoryRepository $categoryRepository) {
        $category = $categoryRepository->find($id);
        return $this->render('main/category.html.twig', [
            'category' => $category
        ]);
    }

    /**
     * @Route("/product/{id}", name="show_product")
     * @param $id
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function productDetail($id, ProductRepository $productRepository){
        $product = $productRepository->find($id);
        return $this->render('main/product.html.twig', [
            'product' => $product
        ]);
    }


    /**
     * @Route("/search", name="recherche")
     * @param Request $request
     * @param ProductRepository $repository
     * @return Response
     */
    public function searchProduct(Request $request, ProductRepository $repository) {
        $searchForm = $this->createForm(ProductType::class);
        $searchForm->handleRequest($request);
        $product = [];
        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            $criteria = $searchForm->getData();
            $product = $repository->search($criteria);
        }
        return $this->render('search/search.html.twig', [
            'searchForm' => $searchForm->createView(),
            'product' => $product
        ]);
    }
}
