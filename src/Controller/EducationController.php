<?php

namespace App\Controller;

use App\Entity\Education;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EducationController extends AbstractController
{

//    /**
//     * @Route("/", name="app_")
//     */
//    public function index(): Response
//    {
//            $educations=$this->getDoctrine()->getRepository(Education::class)->findAll();
//
//        return $this->render('home/index.html.twig', [
//            'educations' =>$educations,
//        ]);
//    }
}
