<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 */
class Document
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $doi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modification_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contributor", mappedBy="document", cascade="all", orphanRemoval=true)
     */
    private $contributors;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoi(): ?string
    {
        return $this->doi;
    }

    public function setDoi(string $doi): self
    {
        $this->doi = $doi;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function __construct()
    {
        $this->modification_date = new \DateTime();
        $this->contributors = new ArrayCollection();
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modification_date;
    }

    public function setModificationDate(?\DateTimeInterface $modification_date): self
    {
        $this->modification_date = $modification_date;

        return $this;
    }

    /**
     * @return Collection|Contributor[]
     */
    public function getContributors(): Collection
    {
        return $this->contributors;
    }

    public function addContributor(Contributor $contributor): self
    {
        if (!$this->contributors->contains($contributor)) {
            $this->contributors[] = $contributor;
            $contributor->setDocument($this);
        }

        return $this;
    }

    public function removeContributor(Contributor $contributor): self
    {
        if ($this->contributors->contains($contributor)) {
            $this->contributors->removeElement($contributor);
            // set the owning side to null (unless already changed)
            if ($contributor->getDocument() === $this) {
                $contributor->setDocument(null);
            }
        }

        return $this;
    }

    public function getUser1(): ?string
    {
        return $this->user1;
    }

    public function setUser1(?string $user1): self
    {
        $this->user1 = $user1;

        return $this;
    }

    public function getUser2(): ?string
    {
        return $this->user2;
    }

    public function setUser2(?string $user2): self
    {
        $this->user2 = $user2;

        return $this;
    }
}
