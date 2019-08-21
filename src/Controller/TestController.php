<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Projet;
use App\Form\ChatType;
use App\Form\EditType;
use App\Entity\Company;
use App\Form\ProjetType;
use App\Form\CompanyType;
use App\Repository\ChatRepository;
use App\Repository\ProjetRepository;
use App\Repository\CompanyRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->redirectToRoute('index');
    }


    /**
     * @Route("/index", name="index")
     */
    public function index(AuthenticationUtils $helper)
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            // dernier username saisi (si il y en a un)
            'last_username' => $helper->getLastUsername(),
            // La derniere erreur de connexion (si il y en a une)
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }

    /**
     * @Route("/todolist/{id}", name="todolist")
     */
    public function todolist(Projet $projet, Request $request)
    {
        $chat = new Chat();
        
        $form = $this->createForm(ChatType::class, $chat);
        $form->handleRequest($request);
        
        return $this->render('test/todolist.html.twig', [
            'controller_name' => 'TestController',
            'form' => $form->createView(),
            'projet' => $projet
        ]);
    }
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Projet $projet, Request $request, ObjectManager $manager)
{
    $form = $this->createForm(EditType::class, $projet);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $manager->flush();
        return $this->redirectToRoute('create_projet');
    }
    return $this->render('test/edit.html.twig', [
        'projet' => $projet,
        'form' => $form->createView()
    ]);
}
     /**
     * @Route("/accueil", name="create_projet")
     */
    public function createProjet(Request $request, ValidatorInterface $validator, ObjectManager $manager, ProjetRepository $repo, CompanyRepository $repocomp): Response
    {
        $projet = new Projet();
        $company = new Company();
        // relates this product to the category
        $projet->setCompany($company);
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
                $manager->persist($company);
                $manager->flush();
            
        }}

    }}
        return $this->render('test/accueil.html.twig',[
            'form' => $form->createView(),
            'projets' => $repo->findAll(),
            'companys' => $repocomp->findAll()
        ]);
    }
    /**
     * @Route("/accueil", name="create_company")
     */
    public function createCompany(Request $request, ValidatorInterface $validator, ObjectManager $manager, ProjetRepository $repo): Response
    {
        $company = new Company();
       
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
      

        if($form->isSubmitted() && $form->isValid()){
           
            
                $manager->persist($projet);
                $manager->flush();
            
        }

    
        return $this->render('test/accueil.html.twig',[
            'form' => $form->createView(),
            
        ]);
    }
 
    /**
     * @Route("/accueil/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $projet = $this->getDoctrine()->getRepository(Projet::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($projet);
        $manager->flush();
        $response = new Response();
        $response->send();
      }
       
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }
  

}
