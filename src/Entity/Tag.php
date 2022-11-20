<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag implements JsonSerializable
{
    /**
     * NUM_ITEMS sert à déterminer le nombre de post à afficher pour la pagination
     * Il est utiliser dans la méthode findBySearchQuery du BlogRepository
     */
    public const NUM_ITEMS = 10;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\Type("string")]
    private ?string $name;

    #[ORM\ManyToMany(targetEntity: Portfolio::class, mappedBy: "tags", cascade: ["persist", "remove"])]
    #[Assert\Valid]
    private Collection $portfolios;

    #[ORM\ManyToMany(targetEntity: Blog::class, mappedBy: "tags", cascade: ["persist", "remove"])]
    #[Assert\Valid]
    private Collection $blogs;

    public function __construct()
    {
        $this->portfolios = new ArrayCollection();
        $this->blogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $portfolio->addTag($this);
        }

        return $this;
    }

    public function removePortfolio(Portfolio $portfolio): self
    {
        if ($this->portfolios->contains($portfolio)) {
            $this->portfolios->removeElement($portfolio);
            $portfolio->removeTag($this);
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
            $blog->addTag($this);
        }

        return $this;
    }

    public function removeBlog(Blog $blog): self
    {
        if ($this->blogs->contains($blog)) {
            $this->blogs->removeElement($blog);
            $blog->removeTag($this);
        }

        return $this;
    }

    public function jsonSerialize(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
