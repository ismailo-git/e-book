<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends AbstractController
{   
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/product', name: 'products')]
    public function index(): Response
    {   
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        return $this->render('product/index.html.twig',[

            'products' => $products
        ]);
    }

    
      #[Route('/product/{slug}', name: 'product')]
    public function show($slug, EntityManagerInterface $entityManager)
    {   
        
        $repository = $entityManager->getRepository(Product::class);
        $product = $repository->findOneBy(['slug' => $slug]);

        if (!$product) {
            
            return $this->redirectToRoute('products');
        }

        return $this->render('product/show.html.twig',[

            'product' => $product
        ]);
    }
}
