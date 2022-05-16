<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'etudiant.list')]
    public function showAll(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Etudiant::class);
        $etudiants = $repository->findAll();
        $this->addFlash('info', 'Liste des étudiants');

        return $this->render('etudiant/index.html.twig', [
            'etudiants'=>$etudiants,
        ]);
    }
    #[Route('/add',name: 'etudiant.add')]
    public function add(ManagerRegistry $doctrine, \Symfony\Component\HttpFoundation\Request $request):Response
    {
        $manager = $doctrine->getManager();
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $etudiant = $form->getData();
            $manager->persist($etudiant);
            $manager->flush();
            $this->addFlash('success', 'Etudiant ajouté avec succès');
            return $this->redirectToRoute('etudiant.list');
        }else{
//            $this->addFlash('error', 'Etudiant non ajouté');
            return $this->render('etudiantform/index.html.twig',[
                'form' => $form->createView(),
            ]);
        }
    }


    #[Route('/delete/{id}',name: 'etudiant.delete')]
public function delete(ManagerRegistry $docrine,Etudiant $etudiant = null)
    {
        $manager = $docrine->getManager();
        $manager->remove($etudiant);
        $manager->flush();
        $this->addFlash('success', 'Etudiant supprimé avec succès');
        return $this->redirectToRoute('etudiant.list');
    }


}
