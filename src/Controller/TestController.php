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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
     * @Route("/todolist/{id}", name="todolist")
     */
    public function todolist(Projet $projet)
    {
        return $this->render('test/todolist.html.twig', [
            'controller_name' => 'TestController',
            'projet' => $projet
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
            $uploadedFile = $form['img_projet']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/img/';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $projet->setImgProjet($newFilename);
                $manager->persist($projet);
                $manager->flush();
            
        }}


        return $this->render('test/accueil.html.twig',[
            'form' => $form->createView(),
            'projets' => $repo->findAll()
        ]);

}
 /**
     * @Route("/accueil/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $projet = $this->getDoctrine()->getRepository(Projet::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($projet);
        $entityManager->flush();
        $response = new Response();
        $response->send();
      }

        

}

