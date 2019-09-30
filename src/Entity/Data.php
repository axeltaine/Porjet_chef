<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DataRepository")
 */
class Data
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $visitor;

    /**
     * @ORM\Column(type="integer")
     */
    private $page;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keyword1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keyword2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keyword3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keyword4;

    /**
     * @ORM\Column(type="text")
     */
    private $advice;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Projet", inversedBy="data", cascade={"persist", "remove"})
     */
    private $dataprojet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisitor(): ?int
    {
        return $this->visitor;
    }

    public function setVisitor(int $visitor): self
    {
        $this->visitor = $visitor;

        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getKeyword1(): ?string
    {
        return $this->keyword1;
    }

    public function setKeyword1(string $keyword1): self
    {
        $this->keyword1 = $keyword1;

        return $this;
    }

    public function getKeyword2(): ?string
    {
        return $this->keyword2;
    }

    public function setKeyword2(string $keyword2): self
    {
        $this->keyword2 = $keyword2;

        return $this;
    }

    public function getKeyword3(): ?string
    {
        return $this->keyword3;
    }

    public function setKeyword3(string $keyword3): self
    {
        $this->keyword3 = $keyword3;

        return $this;
    }

    public function getKeyword4(): ?string
    {
        return $this->keyword4;
    }

    public function setKeyword4(string $keyword4): self
    {
        $this->keyword4 = $keyword4;

        return $this;
    }

    public function getAdvice(): ?string
    {
        return $this->advice;
    }

    public function setAdvice(string $advice): self
    {
        $this->advice = $advice;

        return $this;
    }

    public function getDataprojet(): ?Projet
    {
        return $this->dataprojet;
    }

    public function setDataprojet(?Projet $dataprojet): self
    {
        $this->dataprojet = $dataprojet;

        return $this;
    }
}
