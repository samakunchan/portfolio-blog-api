<?php

namespace App\Traits;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait TraitSlug
{
    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le slug n'a pas pu être effectuer.")]
    #[Assert\Length(min: 3, minMessage: "Le titre doit avoir au moins {{ limit }} caractères.")]
    #[Assert\Type("string")]
    #[ApiProperty(identifier: true)]
    private string $slug;

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $cleanText = preg_replace('/\W+/', '-', $slug);
        $cleanText = strtolower(trim($cleanText, '-'));
        $this->slug = $cleanText;

        return $this;
    }
}
