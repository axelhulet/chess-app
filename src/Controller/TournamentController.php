<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\AddTournamentType;
use App\Repository\TournamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TournamentController extends AbstractController
{
    #[Route('/tournament', name: 'app_tournament')]
    public function index(TournamentRepository $repo): Response
    {
        $tournaments = $repo->findAll();
        return $this->render('tournament/index.html.twig', [
            'tournaments' => $tournaments,
        ]);
    }

    #[Route('/add', name: 'add_tournament')]
    public function add(Request $request, EntityManagerInterface $em, TournamentRepository $repo): Response
    {
        $tournament = new Tournament();
        $form = $this->createForm(AddTournamentType::class, $tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $tournament->setActive('1');
            $em->persist($tournament);
            $em->flush();

            return $this->redirectToRoute('app_tournament');

        }
        return $this->render('tournament/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
