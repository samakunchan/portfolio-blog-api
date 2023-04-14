<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CGVRepository;
use App\Traits\TraitSlug;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: CGVRepository::class)]
class CGV
{
    use TraitSlug;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\IdenticalTo("Conditions générales de vente", message: "Le champ doit être identique à {{ compared_value_type }} {{ compared_value }}.")]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 6, minMessage: "Le titre doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $title;

    #[ORM\Column(type: "text", nullable: true)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 6, minMessage: "La contenu doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $content;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
