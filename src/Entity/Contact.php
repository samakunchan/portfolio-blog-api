<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ContactRepository;
use App\Traits\Timestapable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    use Timestapable;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 6, minMessage: "Le nom doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private string $name;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Email(message: "La valeur indiqué n'est pas un email valide.")]
    #[Assert\Type("string")]
    private string $email;


    #[Assert\Type("object")]
    #[Assert\Valid]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: "contacts")]
    private ?Category $categories;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Assert\Length(min: 10, minMessage: "Le numéro de téléphone doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $phone;

    #[ORM\OneToMany(mappedBy: "contact", targetEntity: Document::class, cascade: ["persist", "remove"])]
    #[Assert\Type("object")]
    private Collection $document;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Length(min: 10, minMessage: "Votre message doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private string $message;

    #[Assert\Type("bool")]
    #[ORM\Column(type: "boolean")]
    private bool $readed;

    public function __construct()
    {
        $this->document = new ArrayCollection();
        $this->readed = false;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->categories;
    }

    public function setCategory(?Category $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getDocument(): Collection
    {
        return $this->document;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->document->contains($document)) {
            $this->document[] = $document;
            $document->setContact($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->document->contains($document)) {
            $this->document->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getContact() === $this) {
                $document->setContact(null);
            }
        }

        return $this;
    }


    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getReaded(): ?bool
    {
        return $this->readed;
    }

    public function setReaded(bool $readed): self
    {
        $this->readed = $readed;

        return $this;
    }

    public function isReaded(): ?bool
    {
        return $this->readed;
    }

    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function setCategories(?Category $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
