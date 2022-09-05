<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductTestController extends AbstractController
{
    #[Route('/product/test', name: 'app_product_test')]
    public function index(): Response
    {
        return $this->render('product_test/index.html.twig', [
            'controller_name' => 'ProductTestController',
        ]);
    }
}
