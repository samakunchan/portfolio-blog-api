<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use App\Traits\TraitSlug;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    use TraitSlug;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, unique: true)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 3, minMessage: "Le titre doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private string $title;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 6, minMessage: "La description doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private string $description;

    #[ORM\OneToOne(targetEntity: Document::class, cascade: ["persist", "remove"])]
    #[Assert\Type("object")]
    private ?Document $icone;

    #[ORM\OneToOne(targetEntity: Document::class, cascade: ["persist", "remove"])]
    #[Assert\Type("object")]
    private ?Document $image;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        $this->setSlug($this->title);
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIcone(): ?Document
    {
        return $this->icone;
    }

    public function setIcone(?Document $icone): self
    {
        $this->icone = $icone;

        return $this;
    }

    public function getImage(): ?Document
    {
        return $this->image;
    }

    public function setImage(?Document $image): self
    {
        $this->image = $image;

        return $this;
    }
}
