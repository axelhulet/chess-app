<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    private $name;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    private $city;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private $date;

    #[ORM\Column(type: 'boolean', nullable: true, options: ['default'=>1] )]
    private $classed;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $eloMin;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $eloMax;

    #[ORM\Column(type: 'json')]
    private $ageCategories;

    #[ORM\Column(type: 'json')]
    private $genderCategories;

    #[ORM\Column(type: 'string',nullable: true, enumType: TypeCategory::class)]
    private $typeCategory;

    #[ORM\Column(type: 'integer')]
    private $roundsNumber;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $minPlayers;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $maxPlayers;

    #[ORM\Column(type: 'boolean', options: ['default'=>1] )]
    private $active;

    /**
     * @return mixed
     */
    public function getAgeCategories()
    {
        return $this->ageCategories;
    }

    /**
     * @param mixed $ageCategories
     * @return Tournament
     */
    public function setAgeCategories($ageCategories)
    {
        $this->ageCategories = $ageCategories;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenderCategories()
    {
        return $this->genderCategories;
    }

    /**
     * @param mixed $genderCategories
     * @return Tournament
     */
    public function setGenderCategories($genderCategories)
    {
        $this->genderCategories = $genderCategories;
        return $this;
    }


//    public function __construct() {
//        $this->ageCategory = [];
//    }



    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getClassed()
    {
        return $this->classed;
    }

    /**
     * @param mixed $classed
     */
    public function setClassed($classed): void
    {
        $this->classed = $classed;
    }

    /**
     * @return mixed
     */
    public function getEloMin()
    {
        return $this->eloMin;
    }

    /**
     * @param mixed $eloMin
     */
    public function setEloMin($eloMin): void
    {
        $this->eloMin = $eloMin;
    }

    /**
     * @return mixed
     */
    public function getEloMax()
    {
        return $this->eloMax;
    }

    /**
     * @param mixed $eloMax
     */
    public function setEloMax($eloMax): void
    {
        $this->eloMax = $eloMax;
    }


    /**
     * @return mixed
     */
    public function getTypeCategory()
    {
        return $this->typeCategory;
    }

    /**
     * @param mixed $typeCategory
     */
    public function setTypeCategory($typeCategory): void
    {
        $this->typeCategory = $typeCategory;
    }

    /**
     * @return mixed
     */
    public function getRoundsNumber()
    {
        return $this->roundsNumber;
    }

    /**
     * @param mixed $roundsNumber
     */
    public function setRoundsNumber($roundsNumber): void
    {
        $this->roundsNumber = $roundsNumber;
    }

    /**
     * @return mixed
     */
    public function getMinPlayers()
    {
        return $this->minPlayers;
    }

    /**
     * @param mixed $minPlayers
     */
    public function setMinPlayers($minPlayers): void
    {
        $this->minPlayers = $minPlayers;
    }

    /**
     * @return mixed
     */
    public function getMaxPlayers()
    {
        return $this->maxPlayers;
    }

    /**
     * @param mixed $maxPlayers
     */
    public function setMaxPlayers($maxPlayers): void
    {
        $this->maxPlayers = $maxPlayers;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }


    public function getId(): ?int
    {
        return $this->id;
    }
}
