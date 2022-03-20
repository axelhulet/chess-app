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

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default'=>1] )]
    private $classed;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $eloMin;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $eloMax;

    #[ORM\Column(type: 'string', enumType: AgeCategory::class)]
    private $ageCategory;

    #[ORM\Column(type: 'string', enumType: Gender::class)]
    private $genderCategory;

    #[ORM\Column(type: 'string', enumType: TypeCategory::class)]
    private $typeCategory;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    private $roundsNumber;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $minPlayers;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $maxPlayers;

    #[ORM\Column(type: 'boolean', options: ['default'=>1] )]
    private $active;

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
    public function getAgeCategory()
    {
        return $this->ageCategory;
    }

    /**
     * @param mixed $ageCategory
     */
    public function setAgeCategory($ageCategory): void
    {
        $this->ageCategory = $ageCategory;
    }

    /**
     * @return mixed
     */
    public function getGenderCategory()
    {
        return $this->genderCategory;
    }

    /**
     * @param mixed $genderCategory
     */
    public function setGenderCategory($genderCategory): void
    {
        $this->genderCategory = $genderCategory;
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
