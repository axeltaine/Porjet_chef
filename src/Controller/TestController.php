<?php

namespace App\Controller;


use Faker;
use App\Entity\Chat;
use App\Entity\User;
use App\Entity\Projet;
use App\Form\ChatType;
use App\Form\EditType;
use App\Entity\Company;
use App\Form\ProfilType;
use App\Form\ProjetType;
use App\Form\CompanyType;
use App\Form\EditUserType;
use App\Form\EditcompanyType;
use App\Repository\ChatRepository;
use App\Repository\UserRepository;
use App\Repository\ProjetRepository;
use App\Repository\CompanyRepository;
use Doctrine\Migrations\Version\Factory;
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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @Route("/dashboard/{id}", name="dashboard")
     */
    public function dashboard(Request $request, Projet $projet, ValidatorInterface $validator, ObjectManager $manager, ProjetRepository $repo, CompanyRepository $repocomp): Response
    {
        return $this->render('test/dashboard.html.twig',[
            'projet' => $projet,
            'projets' => $repo->findAll(),
            'companys' => $repocomp->findAll()
            
        ]);
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
    public function todolist(Projet $projet, Request $request, ObjectManager $manager)
    {
  
        $chat = new Chat();
        $form = $this->createForm(ChatType::class, $chat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chat->setAuteur($this->getUser()->getUsername());
            $chat->setProjet($projet);
            $manager->persist($chat);
            $manager->flush(); 
            
        }
        
        return $this->render('test/todolist.html.twig', [

            'projet' => $projet,
            'chat' => $chat,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Projet $projet, Request $request, ObjectManager $manager)
{
    $this->denyAccessUnlessGranted('ROLE_ADMIN');
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
     * @Route("/editCompany/{id}", name="editCompany")
     */
    public function editCompany(Company $company, Request $request, ObjectManager $manager)
{
    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    $form = $this->createForm(EditcompanyType::class, $company);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $manager->flush();
        return $this->redirectToRoute('create_projet');
    }
    return $this->render('test/editCompany.html.twig', [
        'company' => $company,
        'form' => $form->createView()
    ]);
}
     /**
     * @Route("/accueil/{page<\d+>?1}", name="create_projet")
     */
    public function createProjet(Request $request, ValidatorInterface $validator, ObjectManager $manager, ProjetRepository $repo, CompanyRepository $repocomp, UserRepository $repouser, $page): Response
    {

        
        $limit = 8;
        $start = $page * $limit - $limit;

        $totalProjet = count($repo->findAll());

        $pages = ceil($totalProjet / $limit);
        
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
            'projets' => $repo->findBy([], [], $limit, $start),
            'companys' => $repocomp->findAll(),
            'users' => $repouser->findAll(),
            'pages' => $pages,
            'page' => $page
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
     * @Route("/createProfil", name="createProfil")
     * 
     */
    public function createProfil(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $passwordEncoder)
{
    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    $user = new User();
    
    $form = $this->createForm(ProfilType::class, $user);
    $form->handleRequest($request);
    $user->setMdpUser($passwordEncoder->encodePassword($user,
    $form->get('mdp_user')->getData()));

    if ($form->isSubmitted() && $form->isValid()) {
        $uploadedFile = $form['avatar']->getData();
        if ($uploadedFile) {
            $destination = $this->getParameter('kernel.project_dir').'/public/img/';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
            $uploadedFile->move(
                $destination,
                $newFilename
            );
                $user->setAvatar($newFilename);
                $manager->persist($user);
                $manager->flush();
    }}
                return $this->render('test/createProfil.html.twig',[
                'users' => $user,
                'form' => $form->createView()
    ]);
}
 
    /**
     * @Route("/accueil/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $projet = $this->getDoctrine()->getRepository(Projet::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        foreach($projet->getChats() as $chat){
            $manager->remove($chat);
        }

        $manager->remove($projet);
        
        $manager->flush();
        $response = new Response();
        return $response;
      }
       
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }
  /**
     * @Route("/assign/{id}/{user}", name="assign")
     */
    public function assign(Projet $projet, User $user, ObjectManager $manager)
    {
        $user->addAssignedProjet($projet);
        $manager->persist($user);
        $manager->flush();

        return new Response();
    }
    /**
     * @Route("/desassign/{id}/{user}", name="desassign")
     */
    public function desassign(Projet $projet, User $user, ObjectManager $manager)
    {
        $user->removeAssignedProjet($projet);
        $manager->persist($user);
        $manager->flush();

        return new Response();
    }
      /**
     * @Route("/editProfil/{id}", name="editProfil")
     */
    public function editUser(User $user, Request $request, ObjectManager $manager)
{
    $this->denyAccessUnlessGranted('ROLE_USER');
    $form = $this->createForm(EditUserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $manager->flush();
        return $this->redirectToRoute('create_projet');
    }
    return $this->render('test/editProfil.html.twig', [
        'user' => $user,
        'form' => $form->createView()
    ]);
}
/**
     * @Route("/position/{id}/{position}", name="position")
     */
    public function position(Projet $projet,string $position, ObjectManager $manager)
    {
        $projet->setPosition(intval($position));
        $manager->persist($projet);
        $manager->flush();

        return new Response();
    }
  

}
