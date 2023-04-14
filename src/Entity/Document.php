<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DocumentRepository;
use App\Traits\Timestapable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    use Timestapable;

    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Assert\Length(min: 3, minMessage: "Le type doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Length(min: 50)]
    #[Assert\Type("string")]
    private ?string $completeUrl;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Assert\Choice(["images", "pdf", "non-repertorier"], message: "Veuillez choisir parmis les valeurs autorisés: {{ choices }}")]
    #[Assert\Type("string")]
    private ?string $folder;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Assert\Length(min: 3, minMessage: "Le titre doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $title;

    #[ORM\ManyToOne(targetEntity: Contact::class, inversedBy: "document")]
    #[Assert\Valid]
    #[Assert\Type("string")]
    private ?Contact $contact;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\Length(min: 3, minMessage: "L'extension doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    private ?string $ext;

    /**
     * @var UploadedFile $file
     */
    #[Assert\File(
        maxSize: "1800k",
        mimeTypes: ["image/png", "image/jpeg", "image/jpg, application/pdf", "application/x-pdf", "text/plain"],
        maxSizeMessage: "La taille du fichier est élévé: {{ size }} {{ suffix }}. Maximum: {{ limit }} {{ suffix }}",
        mimeTypesMessage: "Seul les fichiers de type {{ types }} sont autorisés."
    )]
    private UploadedFile $file;

    private ?string $tempFileName;

    /**
     * @return mixed
     */
    public function getFile(): mixed
    {
        return $this->file;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     * @return Document
     */
    public function setFile(UploadedFile $file): static
    {
        $this->file = $file;
        if (isset($this->completeUrl)) {
            $this->tempFileName = $this->completeUrl;
            $this->completeUrl = null;
        }
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompleteUrl(): ?string
    {
        return $this->completeUrl;
    }

    public function setCompleteUrl(string $completeUrl): self
    {
        $this->completeUrl = $completeUrl;

        return $this;
    }

    public function getFolder(): ?string
    {
        return $this->folder;
    }

    public function setFolder(?string $folder): self
    {
        $this->folder = $folder;

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

    public function getTempFileName(): ?string
    {
        return $this->tempFileName;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getExt(): ?string
    {
        return $this->ext;
    }

    public function setExt(string $ext): self
    {
        $this->ext = $ext;

        return $this;
    }
}
