<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{    private $entityManager;

     public function __construct(EntityManagerInterface $entityManager)
     {
         $this->entityManager = $entityManager
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {   
        
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        return $this->render('product/index.html.twig', [

            'products' => $products
        ]);
    }
}
