<?php

namespace App\Entity;

use App\Repository\ChessMatchRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ChessMatchRepository::class)]
class ChessMatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Player')]
    #[ORM\JoinColumn(onDelete: 'NO ACTION', nullable: false)]
    private $player1;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Player')]
    #[ORM\JoinColumn(onDelete: 'NO ACTION', nullable: false)]
    private $player2;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Tournament')]
    #[ORM\JoinColumn(onDelete: 'NO ACTION', nullable: false)]
    private $tournament;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    private $round;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Player')]
    #[ORM\JoinColumn(onDelete: 'NO ACTION', nullable: true)]
    private $result;

    /**
     * @return mixed
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * @param mixed $player1
     * @return ChessMatch
     */
    public function setPlayer1($player1)
    {
        $this->player1 = $player1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * @param mixed $player2
     * @return ChessMatch
     */
    public function setPlayer2($player2)
    {
        $this->player2 = $player2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * @param mixed $tournament
     * @return ChessMatch
     */
    public function setTournament($tournament)
    {
        $this->tournament = $tournament;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * @param mixed $round
     * @return ChessMatch
     */
    public function setRound($round)
    {
        $this->round = $round;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     * @return ChessMatch
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
