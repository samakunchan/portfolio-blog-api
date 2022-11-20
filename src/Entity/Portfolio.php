<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PortfolioRepository;
use App\Traits\TraitSlug;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: PortfolioRepository::class)]
class Portfolio
{
    use TraitSlug;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, unique: true)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 3, minMessage: "Le titre doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $title;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 6, minMessage: "La description doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $description;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: "portfolios")]
    #[Assert\Type("object")]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: "portfolios", cascade: ["persist", "remove"])]
    #[Assert\Type("object")]
    private Collection $tags;

    #[ORM\OneToOne(targetEntity: Document::class, cascade: ["persist", "remove"])]
    #[Assert\Type("object")]
    private ?Document $image;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

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
