<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    use TraitSlug;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 3, minMessage: "Le type doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $type;

    #[ORM\Column(type: "text", nullable: true)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 6, minMessage: "La description doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private string $description;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Environnement", inversedBy: "categories")]
    #[Assert\Valid]
    #[Assert\Type("object")]
    private ?Environnement $environnement = null;

    #[ORM\OneToMany(mappedBy: "category", targetEntity: Portfolio::class, cascade: ["persist", "remove"], orphanRemoval: true)]
    #[Assert\Valid]
    #[Assert\Type("object")]
    private ArrayCollection $portfolios;

    #[ORM\OneToMany(mappedBy: "category", targetEntity: Blog::class)]
    #[Assert\Valid]
    #[Assert\Type("object")]
    private ArrayCollection $blogs;

    #[ORM\OneToMany(mappedBy: "categories", targetEntity: Contact::class)]
    #[Assert\Valid]
    #[Assert\Type("object")]
    private ArrayCollection $contacts;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Assert\Length(min: 6, minMessage: "Le code de l'icone doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $icone;

    public function __construct()
    {
        $this->portfolios = new ArrayCollection();
        $this->blogs = new ArrayCollection();
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        $this->setSlug($this->type);
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEnvironnement(): Environnement
    {
        return $this->environnement;
    }

    public function setEnvironnement(Environnement $environnement): self
    {
        $this->environnement = $environnement;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPortfolios(): Collection
    {
        return $this->portfolios;
    }

    public function addPortfolio(Portfolio $portfolio): self
    {
        if (!$this->portfolios->contains($portfolio)) {
            $this->portfolios[] = $portfolio;
            $portfolio->setCategory($this);
        }

        return $this;
    }

    public function removePortfolio(Portfolio $portfolio): self
    {
        if ($this->portfolios->contains($portfolio)) {
            $this->portfolios->removeElement($portfolio);
            // set the owning side to null (unless already changed)
            if ($portfolio->getCategory() === $this) {
                $portfolio->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getBlogs(): Collection
    {
        return $this->blogs;
    }

    public function addBlog(Blog $blog): self
    {
        if (!$this->blogs->contains($blog)) {
            $this->blogs[] = $blog;
            $blog->setCategory($this);
        }

        return $this;
    }

    public function removeBlog(Blog $blog): self
    {
        if ($this->blogs->contains($blog)) {
            $this->blogs->removeElement($blog);
            // set the owning side to null (unless already changed)
            if ($blog->getCategory() === $this) {
                $blog->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setCategory($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getCategory() === $this) {
                $contact->setCategory(null);
            }
        }

        return $this;
    }

    public function getIcone(): ?string
    {
        return $this->icone;
    }

    public function setIcone(?string $icone): self
    {
        $this->icone = $icone;

        return $this;
    }
}
