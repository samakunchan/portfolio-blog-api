<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    use Timestapable;
    use TraitSlug;
    /**
     * NUM_ITEMS sert à déterminer le nombre de post à afficher pour la pagination
     * Il est utiliser dans la méthode findBySearchQuery du BlogRepository
     */
    public const NUM_ITEMS = 10;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 3, minMessage: "Le titre doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private string $title;

    #[ORM\Column(type: "text", nullable: true)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 6, minMessage: "La contenu doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $content;

    #[Assert\Type("string")]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: "blogs")]
    private ?Category $category;

    #[Assert\Type("object")]
    #[Assert\NotNull]
    #[Assert\Valid]
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: "blogs", cascade: ["persist", "remove"])]
    private ArrayCollection $tags;

//    /**
//     * @Assert\Type("object")
//     * @Assert\Valid
//     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="blog")
//     */
//    private $user;

    #[Assert\Type("integer")]
    #[Assert\NotBlank(message: "Un problème est survenu lors de l'incrementation du nombre de vue.")]
    #[ORM\Column(type: "integer")]
    private ?int $view;

    #[ORM\OneToOne(targetEntity: Document::class, cascade: ["persist", "remove"])]
    #[Assert\Valid]
    #[Assert\Type("object")]
    private ?Document $mainImage;

    #[Assert\Type("object")]
    #[ORM\Column(type: "boolean")]
    private ?bool $status;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
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

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
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



//    public function getUser(): ?User
//    {
//        return $this->user;
//    }
//
//    public function setUser(?User $user): self
//    {
//        $this->user = $user;
//
//        return $this;
//    }

    public function getView(): ?int
    {
        return $this->view;
    }

    public function setView(?int $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getMainImage(): ?Document
    {
        return $this->mainImage;
    }

    public function setMainImage(?Document $mainImage): self
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

}
