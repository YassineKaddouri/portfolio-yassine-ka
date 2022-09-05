<?php

namespace App\Controller;

use App\Entity\Education;
use App\Entity\Person;

use App\Form\AddEducationType;

use App\Form\AddPersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
class HomeController extends AbstractController
{
//    /**
//     * @Route("/", name="app_home")
//     */
//    public function index(): Response
//    {
//        $persons=$this->getDoctrine()->getRepository(Person::class)->findAll();
//
//        return $this->render('home/index.html.twig', [
//            'persons' => $persons,
//
//        ]);
//    }
    /**
     * @Route("/", name="app_")
     */
    public function index(): Response
    {
        $persons=$this->getDoctrine()->getRepository(Person::class)->findAll();

        return $this->render('home/index.html.twig', [
            'persons' =>$persons,
        ]);
    }
    /**
     * @Route("/listeEducation", name="list_education")
     */
    public function listPerson(): Response
    {
        $persons=$this->getDoctrine()->getRepository(Person::class)->findAll();

        return $this->render('home/list.html.twig', [
            'persons' =>$persons,
        ]);
    }
    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request,ManagerRegistry $managerRegistry)
    {
        $person = new Person();
        $form = $this->createForm(AddPersonType::class, $person);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $person->setImage($newFilename);
            }
            $em = $managerRegistry->getManager();
            $em->persist($person);
            $em->flush();


        }
        return $this->render('home/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
//    /**
//     * @Route("/addEducation", name="addEd")
//     */
//    public function addEducation(Request $request,ManagerRegistry $managerRegistry)
//    {
//        $education = new Education();
//        $form = $this->createForm(AddEducationType::class, $education);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $managerRegistry->getManager();
//            $em->persist($education);
//            $em->flush();
//        }
//        return $this->render('home/add.html.twig', [
//            'form' => $form->createView()
//        ]);
//    }

    /**
     * Permet d'afficher le formulaire d'edition
     * @Route("/person/{id}/edit",name="person_edit")
     * @return Response
     */
    public function edit(Request $request,ManagerRegistry $managerRegistry,int $id)
    {
        $person = new Person();
        $person = $managerRegistry->getRepository(Person::class)->find($id);
        $form =$this->createForm(AddPersonType::class,$person);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $person->setImage($newFilename);
            }
            $em = $managerRegistry->getManager();
            $em->persist($person);
            $em->flush();


        }
        return $this->render('home/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * Permet d'afficher une seule annoce
     * @Route("/ads/{id}",name="ads_show")
     * @return Response
     */
    // public function show($slug,AdRepository $repo){
    public function show(Person $person){
        //$ad =$repo->findOneBySlug($slug);
        return $this->render('home/show.html.twig',[
            'person'=> $person
        ]);

    }

    /**
     * Permet d'afficher une seule annoce
     * @Route("/persone/{id}/delete",name="delete_show")
     * @return Response
     */
    public function deletePerson(int $id){

        $entityManager = $this->getDoctrine()->getManager();
        $person= $entityManager->getRepository(Person::class)->find($id);
        $entityManager->remove($person);
        $entityManager->flush();
        return $this->redirectToRoute("list_education");

    }

}
