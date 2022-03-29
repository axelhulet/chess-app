<?php

namespace App\Entity;

use App\Repository\ResultsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultsRepository::class)]
class Results
{
    protected  $results;

    /**
     * @return Collection
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    /**
     * @param $results
     */
    public function __construct()
    {
        $this->results = new ArrayCollection();
    }
}
