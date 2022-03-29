<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class Player implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 180, min: 5)]
    private $username;

    #[ORM\ManyToMany(targetEntity: Role::class)]
    private $roles;

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 50, min: 2)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 50, min: 2)]
    private $firstName;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private $birthDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $elo;

    #[ORM\Column(type: 'string', enumType: Gender::class)]
    private $gender;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $picture;

    #[ORM\Column(type: 'boolean', options: ['default'=>1] )]
    private $active;

//    #[ORM\ManyToMany(targetEntity: Tournament::class)]
//    private $tournaments;
//
//    public function __construct() {
//        $this->tournaments = new ArrayCollection();
//    }

//    /**
//     * @return mixed
//     */
//    public function getTournaments()
//    {
//        return $this->tournaments;
//    }
//
//    /**
//     * @param mixed $tournaments
//     * @return Player
//     */
//    public function addTournament($tournament)
//    {
//        $this->tournaments->add($tournament);
//        return $this;
//    }

    #[ORM\Column(type: 'string', enumType: AgeCategory::class)]
    private $ageCategory;

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
    public function setAgeCategory(): void
    {
        if ($this->birthDate != null)
        {
            $today = new \DateTime();
            $age = $today->diff($this->birthDate, true)->y;
            if ( $age < 18 )
            {
                $this->ageCategory = AgeCategory::Junior;
            }elseif ( $age < 60 )
            {
                $this->ageCategory = AgeCategory::Senior;
            }else
            {
                $this->ageCategory = AgeCategory::Veteran;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getElo()
    {
        return $this->elo;
    }

    /**
     * @param mixed $elo
     */
    public function setElo($elo): void
    {
        $this->elo = $elo;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture): void
    {
        $this->picture = $picture;
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = [];
        /** @var Role $role */
        foreach ($this->roles as $role) {
            $roles[] = $role->getLabel();
        }
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function __toString()
    {
        return $this->id;
    }

}
