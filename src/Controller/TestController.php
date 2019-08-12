<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Company;
use App\Form\ProjetType;
use App\Form\CompanyType;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
                $uploadedDoc = $form['doc_projet']->getData();
                if ($uploadedDoc) {
                    $destination = $this->getParameter('kernel.project_dir').'/public/doc/';
                    $originalDocname = pathinfo($uploadedDoc->getClientOriginalName(), PATHINFO_FILENAME);
                    $newDocname = $originalDocname.'-'.uniqid().'.'.$uploadedDoc->guessExtension();
                    $uploadedDoc->move(
                        $destination,
                        $newDocname
                    );
                    $uploadedLogo = $form['logo_projet']->getData();
                if ($uploadedLogo) {
                    $destination = $this->getParameter('kernel.project_dir').'/public/img/';
                    $originalLogoname = pathinfo($uploadedLogo->getClientOriginalName(), PATHINFO_FILENAME);
                    $newLogoname = $originalLogoname.'-'.uniqid().'.'.$uploadedLogo->guessExtension();
                    $uploadedLogo->move(
                        $destination,
                        $newLogoname
                    );
                $projet->setLogoProjet($newLogoname);
                $projet->setImgProjet($newFilename);
                $projet->setDocProjet($newDocname);
                $manager->persist($projet);
                $manager->flush();
            
        }}

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