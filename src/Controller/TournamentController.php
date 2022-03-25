<?php

namespace App\Controller;

use App\Entity\AgeCategory;
use App\Entity\ChessMatch;
use App\Entity\Gender;
use App\Entity\Tournament;
use App\Form\AddTournamentType;
use App\Repository\ChessMatchRepository;
use App\Repository\PlayerRepository;
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
    public function add(Request $request, EntityManagerInterface $em, TournamentRepository $repo, PlayerRepository $repo2, ChessMatchRepository $repo3): Response
    {
        $tournament = new Tournament();
        $form = $this->createForm(AddTournamentType::class, $tournament);
        $form->handleRequest($request);
//        $player1 = array_shift($players);

        if ($form->isSubmitted() && $form->isValid()){
            $playerCount = $repo2->countBySearch($tournament->getGenderCategories(), $tournament->getAgeCategories());
            $players = $repo2->findByAgeAndGender($tournament->getGenderCategories(), $tournament->getAgeCategories());
            if ($playerCount > 1) {
                $tournament->setMaxPlayers($playerCount);
                $tournament->setRoundsNumber(ceil($playerCount - 1));
            }elseif ($playerCount = 1){
                $tournament->setMaxPlayers($playerCount);
                $tournament->setRoundsNumber(1);

            }else{
                $this->addFlash('error', "Il n'y a pas assez de joueurs pour créer le tournoi");
                return $this->redirectToRoute('app_tournament');
            }
            $tournament->setActive('1');
            $tournament->addPlayer($players);

            $em->persist($tournament);
            $em->flush();

            shuffle($players);
//            dump($players);
            for ($i = 1; $i < $playerCount ; $i++)
            {
                for ($j = 0; $j < $playerCount/2; $j++)
                {
                    $chessMatch = new ChessMatch();
                    $chessMatch->setPlayer1($players[$j]);
                    $chessMatch->setPlayer2($players[$playerCount-1-$j]);
                    $chessMatch->setRound($i);
                    $chessMatch->setTournament($tournament);
                    $em->persist($chessMatch);
//                    dump($chessMatch);
                }
                $p1 = array_shift($players);
                $pl = array_pop($players);
                array_unshift($players, $pl);
                array_unshift($players, $p1);
//                dump($players);
            }

            $em->flush();


            return $this->redirectToRoute('app_tournament');

        }
        return $this->render('tournament/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/tournament/start/{id}', name: 'tournament_start')]
    public function startTournament($id, TournamentRepository $repo, PlayerRepository $repo2, ChessMatchRepository $repo3) {

        $tournament = $repo->find($id);
        $players = $tournament->getPlayer();
        $matches = $repo3->findBy(array('tournament' => $tournament));

        return $this->render('tournament/start.html.twig', [
            'tournament' => $tournament,
            'players' => $players,
            'matches' => $matches
        ]);
    }
}
