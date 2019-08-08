<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function index()
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/todolist", name="todolist")
     */
    public function todolist()
    {
        return $this->render('test/todolist.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
     /**
     * @Route("/accueil", name="create_projet")
     */
    public function createProjet(Request $request, ValidatorInterface $validator, ObjectManager $manager, ProjetRepository $repo): Response
    {
        $projet = new Projet();
       
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($projet);
            $manager->flush();
        }


        return $this->render('test/accueil.html.twig',[
            'form' => $form->createView(),
            'projets' => $repo->findAll()
        ]);

}

        

}

